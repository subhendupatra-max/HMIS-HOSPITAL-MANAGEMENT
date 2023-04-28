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
use Illuminate\Support\Facades\DB;
use App\Imports\PatientImport;
use App\Models\PatientPhysicalDetails;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

use function PHPSTORM_META\type;

class PatientController extends Controller
{
    public function patient_details()
    {
        $all_patient = Patient::where('is_active', 1)
            ->where('ins_by', 'ori')
            ->orderBy('id', 'DESC')
            ->get();

        return view('setup.patient.patient_list', compact('all_patient'));
    }

    public function add_new_patient()
    {
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $country = Country::all();
        return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'country'));
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
            if(isset($request->localaddress_and_address_are_same))
            {  
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            }
            else{
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
        return view('setup.patient.patient-details', compact('patient_details'));
    }

    public function edit_new_patient($id, Request $request)
    {
        $id = base64_decode($id);
        $blood_group = BloodGroup::all();
        $state = State::all();
        $districts = District::all();
        $patient = Patient::where('id', '=', $id)->first();
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
            if(isset($request->localaddress_and_address_are_same))
            {  
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            }
            else{
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
            if(isset($request->localaddress_and_address_are_same))
            {  
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            }
            else{
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
            return redirect()->route('opd-registration',['id'=>base64_encode($id)])->with('success', 'Patient Updated Sucessfully');
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
            if(isset($request->localaddress_and_address_are_same))
            {  
                $patient->local_address = $request->address;
                $patient->country_local = $request->country;
                $patient->state_local = $request->state;
                $patient->district_local = $request->district;
                $patient->local_pin_no = $request->pin_no;
            }
            else{
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
            return redirect()->route('emg-registation',base64_encode($id))->with('success', 'Patient Updated Sucessfully');
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
}
