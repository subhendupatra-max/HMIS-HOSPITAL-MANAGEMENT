<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\State;
use App\Models\District;
use App\Models\Prefix;
use App\Models\Country;
use App\Models\ChargeType;
use App\Models\Charge;
use Illuminate\Support\Facades\DB;
use App\Imports\PatientImport;
use App\Models\PatientPhysicalDetails;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\OpdDetails;
use App\Models\EmgDetails;
use App\Models\IpdDetails;
use App\Models\Billing;
use App\Models\ChargesCatagory;
use App\Models\Discount;
use App\Models\DiscountDetails;
use App\Models\Payment;
use App\Models\PatientCharge;
use App\Models\BillDetails;
use Auth;
use Validator;

use function PHPSTORM_META\type;

class PatientController extends Controller
{
    public function patient_details(Request $request)
    {
        $request_data = $request->all();
        $trimmedString = str_replace(' ', '', $request->patient_first_name);
        if($request_data != null){
             $all_patient =  Patient::where(function ($query) use ($request,$trimmedString) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->patient_phone_no != '') {
                $query->where('phone', '=', $request->patient_phone_no);
            }
            if ($request->patient_uhid != '') {
                $query->where('id', '=', $request->patient_uhid);
            }
            if ($request->patient_first_name != '') {
                $query->where(DB::raw("CONCAT(
                    TRIM(CONCAT_WS('', prefix, ' ')),
                    TRIM(CONCAT_WS('', first_name, ' ')),
                    TRIM(CONCAT_WS('', middle_name, ' ')),
                    TRIM(last_name)
                  )"), 'like', '%'.$trimmedString.'%');
            }
        })
        ->where('is_active', 1)
        ->orderBy('id', 'DESC')
        ->paginate(10); 
        }
        else{
            $all_patient =  Patient::where(function ($query) {
                if (!auth()->user()->can('False Generation')) {
                    $query->where('ins_by', 'ori');
                }
            })
            ->where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10); 
        }
      
        return view('setup.patient.patient_list', compact('all_patient','request_data'));
    }

    public function add_new_patient()
    {
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $country = Country::all();
        return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'country'));
    }
    public function add_new_patient_in_ipd()
    {
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $country = Country::all();
        $type = 'IPD';
        return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'country','type'));
    }
    public function add_new_patient_in_appointment()
    {
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $country = Country::all();
        $type = 'Appointment';
        return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'country','type'));
    }

    public function submit_new_patient_details(Request $request)
    {
        $patient_prefix = Prefix::where('name', 'patient')->first();
        $request->validate([
            'prefix'                     => 'required',
            'first_name'                 => "required",
            'last_name'                  => "required",
            'guardian_name'              => "required",
            'gender'                     => "required",
            'date_of_birth'              => "required",
            'date_of_birth_year'         => "numeric|max:130|required",
            'date_of_birth_month'        => "numeric|max:13|required",
            'date_of_birth_day'          => "numeric|max:32|required",
            'phone'                      => "max:9999999999|required",
            'address'                    => "required",
            'pin_no'                     => "required|max:999999",
            'district'                   => "required",
            'state'                      => "required",
            'local_guardian_contact_no'  => "max:9999999999",
            'guardian_contact_no'        => "max:9999999999",
            'local_guardian_name'        => "required",
        ]);
        try {
            DB::beginTransaction();
            $patient = new Patient();
            $patient->patient_prefix =  $patient_prefix->prefix;
            $patient->prefix = $request->prefix;
            $patient->first_name = $request->first_name;
            $patient->middle_name = $request->middle_name;
            $patient->last_name = $request->last_name;
            $patient->guardian_name = $request->guardian_name;
            $patient->guardian_contact_no = $request->guardian_contact_no;
            $patient->marital_status = $request->marital_status;
            $patient->blood_group = $request->blood_group;
            $patient->gender = $request->gender;
            $patient->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $patient->year = $request->date_of_birth_year;
            $patient->month = $request->date_of_birth_month;
            $patient->day = $request->date_of_birth_day;
            $patient->local_guardian_name = $request->local_guardian_name;
            $patient->local_guardian_contact_no = $request->local_guardian_contact_no;
            $patient->phone = $request->phone;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->state = $request->state;
            $patient->country = $request->country;
            $patient->district = $request->district;
            $patient->pin_no = $request->pin_no;
            $patient->identification_name = $request->identification_name;
            $patient->identification_number = $request->identification_number;
            if (isset($request->localaddress_and_address_are_same)) {
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            } else {
                $patient->local_address = $request->local_address;
                $patient->country_local = $request->country_local;
                $patient->state_local = $request->state_local;
                $patient->district_local = $request->district_local;
                $patient->local_pin_no = $request->local_pin_no;
            }
            $patient->save();

            DB::commit();
            if ($request->type == "opd") {
                return redirect()->route('opd-registration', base64_encode($patient->id))->with('success', 'Patient Created Sucessfully');
            } elseif ($request->type == "emg") {
                return redirect()->route('emg-registation', base64_encode($patient->id))->with('success', 'Patient Created Sucessfully');
            }
            elseif ($request->type == "ipd") {
                return redirect()->route('direct-ipd-admission',$patient->id)->with('success', 'Patient Created Successfully');
            }
            elseif ($request->type == "Appointment") {
                return redirect()->route('add-appointments-details',base64_encode($patient->id))->with('success', 'Patient Created Successfully');
            } else {
                return redirect()->route('patient_details')->with('success', 'Patient Created Sucessfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('add_new_patient')->with('error', $th->getMessage());
        }
    }

    public function find_fr_district_by_state(Request $request)
    {
        $district_by_state = District::where('state_id', $request->state_id)->get();

        return response()->json($district_by_state);
    }
    public function find_state_by_country(Request $request)
    {
        $country_by_state = State::where('country_id', $request->countries_id)->get();

        return response()->json($country_by_state);
    }

    public function find_local_district_by_state(Request $request)
    {
        $district_by_state_local = District::where('state_id', $request->state_ids)->get();

        return response()->json($district_by_state_local);
    }
    public function find_local_state_by_country(Request $request)
    {
        $country_by_state_local = State::where('country_id', $request->country_id_local)->get();

        return response()->json($country_by_state_local);
    }

    public function delete($id)
    {
        $p_id = base64_decode($id);
        Patient::where('id', $p_id)->update(['is_active' => '0', 'is_delete' => '1']);
        return redirect()->back()->with('success', 'Patient Delected Successfully...');
    }
    public function search_patient(Request $req)
    {

        $patient_id = $req->post('patient__id');
        $patient_serch_res = Patient::where('patients.id', $patient_id)
            ->orwhere('patients.first_name', 'like', '%' . $patient_id . '%')
            ->orwhere('patients.middle_name', 'like', '%' . $patient_id . '%')
            ->orwhere('patients.last_name', 'like', '%' . $patient_id . '%')
            ->orwhere('patients.phone', 'like', '%' . $patient_id . '%')
            ->orwhere('patients.identification_number', 'like', '%' . $patient_id . '%')
            ->take(10)->get();

        return response()->json($patient_serch_res);
    }

    public function view_new_patient($id, Request $request)
    {
        $id = base64_decode($id);
        $patient = Patient::where('id', '=', $id)->first();
        return view('setup.patient.view-patient', compact('patient'));
    }

    public function view_patient_details($patient_id, Request $request)
    {
        $id = base64_decode($patient_id);
        $patient_details = Patient::where('id', $id)->first();
        $emg_registaion_list = EmgDetails::where('ins_by', 'ori')->where('patient_id', $id)->orderBy('id', 'desc')->get();
        $opd_registaion_list = OpdDetails::where('ins_by', 'ori')->where('patient_id', $id)->orderBy('id', 'desc')->get();
        $ipd_patient_list = IpdDetails::where('is_active', '1')->where('patient_id', $id)->where('ins_by', 'ori')->get();

        return view('setup.patient.patient-details', compact('patient_details', 'opd_registaion_list', 'emg_registaion_list', 'ipd_patient_list'));
    }

    public function edit_new_patient($id, Request $request)
    {
        $id = base64_decode($id);
        // dd($id);
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $patient = Patient::where('id', '=', $id)->first();
        // dd($patient);
        $country = Country::all();

        return view('setup.patient.edit-patient', compact('patient', 'blood_group', 'state', 'districts', 'country'));
    }
    public function edit_opd_new_patient($id, Request $request)
    {
        $id = base64_decode($id);
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $patient = Patient::where('id', '=', $id)->first();
        $country = Country::all();

        return view('OPD.patient-edit', compact('patient', 'blood_group', 'state', 'districts', 'country'));
    }

    public function edit_emg_new_patient($id, Request $request)
    {
        $id = base64_decode($id);
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $patient = Patient::where('id', '=', $id)->first();
        $country = Country::all();

        return view('emg.patient-edit', compact('patient', 'blood_group', 'state', 'districts', 'country'));
    }


    public function update_new_patient_details(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $patient_prefix = Prefix::where('name', 'patient')->first();

        $request->validate([
            'prefix'                     => 'required',
            'first_name'                 => "required",
            'last_name'                  => "required",
            'guardian_name'              => "required",
            'gender'                     => "required",
            'date_of_birth'              => "required",
            'date_of_birth_year'         => "numeric|max:130|required",
            'date_of_birth_month'        => "numeric|max:13|required",
            'date_of_birth_day'          => "numeric|max:32|required",
            'phone'                      => "max:9999999999|required",
            'address'                    => "required",
            'pin_no'                     => "required|max:999999",
            'district'                   => "required",
            'state'                      => "required",
            'local_guardian_contact_no'  => "max:9999999999",
            'guardian_contact_no'        => "max:9999999999",
            'local_guardian_name'        => "required",
        ]);
        try {
            DB::beginTransaction();
            $patient = Patient::where('id', $id)->first();
            $patient->prefix = $request->prefix;
            $patient->first_name = $request->first_name;
            $patient->middle_name = $request->middle_name;
            $patient->last_name = $request->last_name;
            $patient->guardian_name = $request->guardian_name;
            $patient->guardian_contact_no = $request->guardian_contact_no;
            $patient->marital_status = $request->marital_status;
            $patient->blood_group = $request->blood_group;
            $patient->gender = $request->gender;
            $patient->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $patient->year = $request->date_of_birth_year;
            $patient->month = $request->date_of_birth_month;
            $patient->day = $request->date_of_birth_day;
            $patient->local_guardian_name = $request->local_guardian_name;
            $patient->local_guardian_contact_no = $request->local_guardian_contact_no;
            $patient->phone = $request->phone;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->state = $request->state;
            $patient->country = $request->country;
            $patient->district = $request->district;
            $patient->pin_no = $request->pin_no;
            if (isset($request->localaddress_and_address_are_same)) {
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            } else {
                $patient->local_address = $request->local_address;
                $patient->country_local = $request->country_local;
                $patient->state_local = $request->state_local;
                $patient->district_local = $request->district_local;
                $patient->local_pin_no = $request->local_pin_no;
            }
            $patient->identification_name = $request->identification_name;
            $patient->identification_number = $request->identification_number;

            $patient->save();

            DB::commit();
            return redirect()->route('patient_details')->with('success', 'Patient Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('edit-new-patient/' . $id)->with('error', $th->getMessage());
        }
    }
    public function update_new_patient_details_opd(Request $request)
    {
        $id = $request->id;
        $patient_prefix = Prefix::where('name', 'patient')->first();

        $request->validate([
            'prefix'                     => 'required',
            'first_name'                 => "required",
            'last_name'                  => "required",
            'guardian_name'              => "required",
            'gender'                     => "required",
            'date_of_birth'              => "required",
            'date_of_birth_year'         => "numeric|max:130|required",
            'date_of_birth_month'        => "numeric|max:13|required",
            'date_of_birth_day'          => "numeric|max:32|required",
            'phone'                      => "max:9999999999|required",
            'address'                    => "required",
            'pin_no'                     => "required|max:999999",
            'district'                   => "required",
            'state'                      => "required",
            'local_guardian_contact_no'  => "max:9999999999",
            'guardian_contact_no'        => "max:9999999999",
            'local_guardian_name'        => "required",
        ]);
        try {
            DB::beginTransaction();
            $patient = Patient::where('id', $id)->first();
            $patient->prefix = $request->prefix;
            $patient->first_name = $request->first_name;
            $patient->middle_name = $request->middle_name;
            $patient->last_name = $request->last_name;
            $patient->guardian_name = $request->guardian_name;
            $patient->guardian_contact_no = $request->guardian_contact_no;
            $patient->marital_status = $request->marital_status;
            $patient->blood_group = $request->blood_group;
            $patient->gender = $request->gender;
            $patient->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $patient->year = $request->date_of_birth_year;
            $patient->month = $request->date_of_birth_month;
            $patient->day = $request->date_of_birth_day;
            $patient->local_guardian_name = $request->local_guardian_name;
            $patient->local_guardian_contact_no = $request->local_guardian_contact_no;
            $patient->phone = $request->phone;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->state = $request->state;
            $patient->country = $request->country;
            $patient->district = $request->district;
            $patient->pin_no = $request->pin_no;
            if (isset($request->localaddress_and_address_are_same)) {
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            } else {
                $patient->local_address = $request->local_address;
                $patient->country_local = $request->country_local;
                $patient->state_local = $request->state_local;
                $patient->district_local = $request->district_local;
                $patient->local_pin_no = $request->local_pin_no;
            }
            $patient->identification_name = $request->identification_name;
            $patient->identification_number = $request->identification_number;

            $patient->save();

            DB::commit();
            return redirect()->route('opd-registration', ['id' => base64_encode($id)])->with('success', 'Patient Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('edit-new-patient/' . $id)->with('error', $th->getMessage());
        }
    }
    public function update_new_patient_details_emg(Request $request)
    {
        $id = $request->id;
        $patient_prefix = Prefix::where('name', 'patient')->first();

        $request->validate([
            'prefix'                     => 'required',
            'first_name'                 => "required",
            'last_name'                  => "required",
            'guardian_name'              => "required",
            'gender'                     => "required",
            'date_of_birth'              => "required",
            'date_of_birth_year'         => "numeric|max:130|required",
            'date_of_birth_month'        => "numeric|max:13|required",
            'date_of_birth_day'          => "numeric|max:32|required",
            'phone'                      => "max:9999999999|required",
            'address'                    => "required",
            'pin_no'                     => "required|max:999999",
            'district'                   => "required",
            'state'                      => "required",
            'local_guardian_contact_no'  => "max:9999999999",
            'guardian_contact_no'        => "max:9999999999",
            'local_guardian_name'        => "required",
        ]);
        try {
            DB::beginTransaction();
            $patient = Patient::where('id', $id)->first();
            $patient->prefix = $request->prefix;
            $patient->first_name = $request->first_name;
            $patient->middle_name = $request->middle_name;
            $patient->last_name = $request->last_name;
            $patient->guardian_name = $request->guardian_name;
            $patient->guardian_contact_no = $request->guardian_contact_no;
            $patient->marital_status = $request->marital_status;
            $patient->blood_group = $request->blood_group;
            $patient->gender = $request->gender;
            $patient->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $patient->year = $request->date_of_birth_year;
            $patient->month = $request->date_of_birth_month;
            $patient->day = $request->date_of_birth_day;
            $patient->local_guardian_name = $request->local_guardian_name;
            $patient->local_guardian_contact_no = $request->local_guardian_contact_no;
            $patient->phone = $request->phone;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->state = $request->state;
            $patient->country = $request->country;
            $patient->district = $request->district;
            $patient->pin_no = $request->pin_no;
            if (isset($request->localaddress_and_address_are_same)) {
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            } else {
                $patient->local_address = $request->local_address;
                $patient->country_local = $request->country_local;
                $patient->state_local = $request->state_local;
                $patient->district_local = $request->district_local;
                $patient->local_pin_no = $request->local_pin_no;
            }
            $patient->identification_name = $request->identification_name;
            $patient->identification_number = $request->identification_number;

            $patient->save();

            DB::commit();
            return redirect()->route('emg-registation', base64_encode($id))->with('success', 'Patient Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('edit-new-patient/' . $id)->with('error', $th->getMessage());
        }
    }
    public function import_patient()
    {
        $state = State::all();
        return view('setup.patient.import_patient', compact('state'));
    }
    public function upload_import_patient(Request $request)
    {
        $dat = Excel::import(new PatientImport, request()->file('patient_file'));
        return redirect()->route('patient_details')->with('success', 'Patient Import Sucessful');
    }
    public function patient_billing_list($id)
    {
        $patient_id = base64_decode($id);
        $billing_details = Billing::where('patient_id',$patient_id)->get();
        return view('setup.patient.billing-list', compact('billing_details','patient_id'));
    }
    public function add_patient_billing($id)
    {
        $patient_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        return view('setup.patient.add-billing', compact('patient_id','charge_category'));
    }
    public function get_charge_amount_patient(Request $request)
    {
        $patient_type_id = ChargeType::where('charge_type_name', 'General')->first();
        $charge_amount = Charge::select('charges_with_charges_types.standard_charges as charge_amount')->join('charges_with_charges_types', 'charges.id', '=', 'charges_with_charges_types.charge_id')->where('charges.id', $request->chargeName)->where('charges_with_charges_types.charge_type_id', $patient_type_id->id)->first();
        return response()->json($charge_amount);
    }
    public function add_new_billing(Request $request)
    {
        //dd($request->all());
        $validate = $request->validate([
            'bill_date'   => 'required',
        ]);
        // try {
        //     DB::beginTransaction();
        if ($request->take_discount == 'yes') {
            $status = 'Done';
            $tax_total = $request->total;
            $grand_total = number_format((float)($tax_total), 2, '.', '');
            $discount_status = 'Requested';
        } else {
            $discount_status = 'Not applied';
            $tax_total = $request->total;
            $grand_total = number_format((float)($tax_total), 2, '.', '');
            $status = 'Done';
        }

        if ($request->payment_amount != null) {
            if ($request->payment_amount == $request->grand_total) {
                $payment_status = 'Done';
            } else {
                $payment_status = 'Due';
            }
        } else {
            $payment_status = 'Due';
        }

        // ====================== Billing ===========================================
        $billing_prefix = Prefix::where('name', 'bill')->first();
        $bill = new Billing;
        $bill->bill_prefix = $billing_prefix->prefix;
        $bill->bill_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
        $bill->patient_id = $request->patient_id;
        $bill->section = 'Direct';
        $bill->total_amount = $request->total;
        $bill->payment_status = $payment_status;
        $bill->discount_status =  $discount_status;
        $bill->status =  'done';
        $bill->created_by = Auth::user()->id;
        $bill->note = $request->note;
        $bill->grand_total = $grand_total;
        $bill->save();
        // ====================== Billing ===========================================
        foreach ($request->charge_category as $key => $value) {
                $patient_charge = new PatientCharge();
                $patient_charge->section = 'Direct';
                $patient_charge->charges_date = $request->date;
                $patient_charge->patient_id = $request->patient_id;
                $patient_charge->charge_category = $request->charge_category[$key];
                $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
                $patient_charge->charge_name = $request->charge_name[$key];
                $patient_charge->standard_charges = $request->standard_charges[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->generated_by = Auth::user()->id;
                $patient_charge->billing_status = '1';
                $patient_charge->save();
                $charge_id = $patient_charge->id;

                // ====================== Billing Details ===========================================
                $bill_details_charges = new BillDetails();
                $bill_details_charges->bill_id = $bill->id;
                $bill_details_charges->purpose_for = 'charges';
                $bill_details_charges->purpose_for_id = $charge_id;
                $bill_details_charges->save();
                // ====================== Billing Details ===========================================
        }

        //payment
        if ($request->payment_amount != null || $request->payment_amount != 0 || $request->payment_amount != '') {
            // ====================== add payment =======================================
            $payment_prefix = Prefix::where('name', 'payment')->first();
            $payment = new Payment();
            $payment->patient_id = $request->patient_id;
            $payment->section = 'Direct';
            $payment->payment_prefix = $payment_prefix->prefix;
            $payment->payment_amount = $request->payment_amount;
            $payment->payment_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
            $payment->payment_recived_by = Auth::user()->id;
            $payment->payment_mode = $request->payment_mode;
            $payment->note = $request->payment_note;
            $payment->save();
            // ====================== add payment =======================================
        }
        //payment

        if ($request->take_discount == 'yes') {
            // ====================== Discount ===========================================
            $discount = new Discount();
            $discount->discount_type =  $request->discount_type;
            $discount->patient_id =  $request->patient_id;
            $discount->section =  $request->section;
            $discount->asking_discount_amount =  $request->total_discount;
            $discount->discount_status = 'Pending';
            $discount->requested_by = Auth::user()->id;
            $discount->asking_discount_time = date('Y-m-d h:m:s', strtotime($request->bill_date));
            $discount->save();
            // ====================== Discount ===========================================
            // ====================== Discount Detaiils ==================================
            $discount_details = new DiscountDetails();
            $discount_details->bill_id = $bill->id;
            $discount_details->discount_id = $discount->id;
            $discount_details->bill_amount = $request->total;
            $discount_details->save();
            // ====================== Discount Detaiils ==================================
            $bill_update = Billing::find($bill->id);
            $bill_update->discount_id = $discount->id;
            $bill_update->save();
        }
            // DB::commit();
        return redirect()->route('patient-billing-list', ['id' => base64_encode($request->patient_id)])->with('success', "Billing added Successfully");
        
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return back()->withErrors(['error' => $th->getMessage()]);
        // }
    }
}
