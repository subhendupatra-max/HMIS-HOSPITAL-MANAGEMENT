<?php

namespace App\Http\Controllers\Emg;

use App\Http\Controllers\Controller;
use App\Models\BedUnit;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\State;
use App\Models\District;
use App\Models\Patient;
use App\Models\TpaManagement;
use App\Models\Referral;
use App\Models\Department;
use App\Models\EmgDetails;
use App\Models\EmgPatientDetails;
use App\Models\User;
use App\Models\SymptomsHead;
use App\Models\SymptomsType;
use App\Models\caseReference;
use App\Models\Prefix;
use App\Models\EmgSetup;
use App\Models\PatientPhysicalDetails;
use App\Models\AllHeader;
use App\Models\EmgPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EmgPatientPhysicalDetail;
use App\Models\Country;
use App\Models\Billing;
use App\Models\ChargesCatagory;
use App\Models\PatientCharge;
use App\Models\PathologyPatientTest;
use App\Models\RadiologyPatientTest;
use App\Models\PathologyTest;
use App\Models\RadiologyTest;
use PDF;

class EmgController extends Controller
{

    public function index()
    {
        $emg_registaion_list = EmgDetails::where('ins_by', 'ori')->get();
        return view('emg.emg-patient-list', compact('emg_registaion_list'));
    }

    public function after_new_old(Request $request)
    {
        $patient_type = $request->patient_type;
        if ($patient_type == 'new_patient') {
            $blood_group = BloodGroup::all();
            $state = State::all();
            $districts = District::all();
            $type = 'emg';
            $country = Country::all();
            return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'type', 'country'));
        } else {
            return redirect()->route('emg-registation');
        }
    }

    public function emg_registation(Request $request, $patientid = null)
    {
        if ($patientid != null) {
            $patient_id = base64_decode($patientid);
        } else {
            $patient_id = $request->patient_id;
        }
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $department = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $ticket_fees = EmgSetup::first();

        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();

        return view('emg.emg-registration', compact('ticket_fees', 'symptoms_types', 'department', 'referer',  'tpa_management', 'all_patient', 'patient_details_information'));
    }

    public function add_emg_registation(Request $request)
    {
//dd($request->all());
        $validate = $request->validate([
            'appointment_date'      => 'required',
            'patient_type'          => 'required',
            'department'            => 'required',
            'cons_doctor'           => 'required',
            'medico_legal_case'     => 'required',
            'patient_id'     => 'required',
        ]);
        try {
        DB::beginTransaction();
        $emg_prefix = Prefix::where('name', 'emg')->first();

        //SAVE in CASE reference
        $caseReference = new caseReference;
        $caseReference->patient_id     = $request->patient_id;
        $caseReference->section     = 'EMG';
        $caseReference->save();
        //SAVE in CASE reference

        //SAVE in opd details
        $Emg_details = new EmgDetails();
        $Emg_details->case_id        = $caseReference->id;
        $Emg_details->patient_id     = $request->patient_id;
        $Emg_details->emg_prefix     = $emg_prefix->prefix;
        $Emg_details->generate_by    = Auth::user()->id;
        $Emg_details->save();
        //SAVE in opd details

        $caseReference_update = caseReference::find($caseReference->id);
        $caseReference_update->section_id = $Emg_details->id; 
        $caseReference->save();


        //SAVE in opd Visit details
        $emg_patient_details = new EmgPatientDetails();
        $emg_patient_details->emg_details_id              = $Emg_details->id;
        $emg_patient_details->department_id               = $request->department;
        $emg_patient_details->cons_doctor                 = $request->cons_doctor;
        $emg_patient_details->medico_legal_case           = $request->medico_legal_case;
        $emg_patient_details->ticket_fees                 = $request->ticket_fees;
        $emg_patient_details->case_type                   = $request->case;
        $emg_patient_details->patient_type                = $request->patient_type;
        $emg_patient_details->tpa_organization            = $request->tpa_organization;
        $emg_patient_details->type_no                     = $request->type_no;
        $emg_patient_details->appointment_date            = $request->appointment_date;
        $emg_patient_details->symptoms_type               = $request->symptoms_type;
        $emg_patient_details->symptoms                    = $request->symptoms_title;
        $emg_patient_details->symptoms_description        = $request->symptoms_description;
        $emg_patient_details->known_allergies             = $request->any_known_allergies;
        $emg_patient_details->note                        = $request->note;
        $emg_patient_details->refference                  = $request->reference;
        $emg_patient_details->generated_by                = Auth::user()->id;
        $emg_patient_details->save();
        //SAVE in Emg Patient details

        // $patient_physical_condition = new EmgPatientPhysicalDetail();
        // $patient_physical_condition->emg_id                      = $Emg_details->id;
        // $patient_physical_condition->bp                          = $request->bp;
        // $patient_physical_condition->height                      = $request->height;
        // $patient_physical_condition->weight                      = $request->weight;
        // $patient_physical_condition->pulse                       = $request->pulse;
        // $patient_physical_condition->temperature                 = $request->temperature;
        // $patient_physical_condition->respiration                 = $request->respiration;
        // $patient_physical_condition->save();
         DB::commit();
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        $emg_patient_details = EmgPatientDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'emg_patient_details.patient_type', 'patients.address', 'patients.blood_group', 'emg_patient_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'emg_patient_details.appointment_date', 'emg_patient_details.medico_legal_case', 'emg_details.emg_prefix', 'emg_details.id as emg_id')
            ->join('emg_details', 'emg_details.id', '=', 'emg_patient_details.emg_details_id')
            ->join('patients', 'patients.id', '=', 'emg_details.patient_id')
            ->join('users', 'users.id', '=', 'emg_patient_details.cons_doctor')
            ->join('departments', 'departments.id', '=', 'emg_patient_details.department_id')
            ->where('emg_patient_details.id', $emg_patient_details->id)
            ->first();



        if ($request->save == 'save_and_print') {
            $pdf = PDF::loadView('emg._print.emg_prescription', compact('emg_patient_details', 'header_image'));
            return $pdf->stream('emg_prescription.pdf');
            return redirect()->route('emg-patient-list')->with('success', 'EMG Registation Sucessfully');
        } else {
            return redirect()->route('emg-patient-list')->with('success', 'EMG Registation Sucessfully');
        }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function emg_set_up()
    {
        $setup_details = EmgSetup::first();
        return view('setup.emg.emg-setup', compact('setup_details'));
    }

    public function add_emg_set_up(Request $request)
    {
        $validate = $request->validate([
            'ticket_fees'  => 'required',
        ]);
        try {
            DB::beginTransaction();
            $emg_setup = EmgSetup::where('id', $request->id)->update(['ticket_fees' => $request->ticket_fees]);
            DB::commit();
            return redirect()->back()->with('success', 'EMG Setup Updated');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function profile($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $emg_visit_details = EmgPatientDetails::where('emg_details_id', $emg_id)->get();
        $PhysicalDetails  =  EmgPatientPhysicalDetail::where('emg_id', $emg_id)->get();
        $payment_amount = EmgPayment::where('emg_id', $emg_id)->sum('amount');
        $billing_amount = Billing::where('emg_id', $emg_id)->sum('grand_total');
        $PathologyTestDetails = PathologyPatientTest::where('case_id', $emg_patient_details->case_id)->get();
        $RadiologyTestDetails = RadiologyPatientTest::where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.emg-patient-profile', compact('emg_patient_details', 'emg_visit_details', 'PhysicalDetails', 'payment_amount', 'billing_amount', 'PathologyTestDetails', 'RadiologyTestDetails'));
    }

    public function admission_from_emg($id)
    {
        $emg_opd_id = base64_decode($id);
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $visit_details = EmgDetails::where('id', '=', $emg_opd_id)->first();
        $patient_source_id = $visit_details->emg_prefix . '' . $visit_details->id;
        $case_id = $visit_details->case_id;
        $patient_source = 'EMG';

        return view('Ipd.ipd-registration', compact('symptoms_types', 'departments', 'referer', 'visit_details', 'tpa_management', 'patient_source_id', 'case_id', 'patient_source', 'emg_opd_id', 'units'));
    }

    public function charge_list($id = null)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $emg_charges_details = PatientCharge::where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.charges.charges-list', compact('emg_id', 'emg_patient_details', 'emg_charges_details'));
    }
    public function add_charges($id)
    {
        $emg_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        return view('emg.charges.add-charges', compact('emg_patient_details', 'emg_id', 'charge_category'));
    }
    public function edit_charges($id, $charge_id)
    {
        $emg_id = base64_decode($id);
        $chargeId = base64_decode($charge_id);
        $charge_category =  ChargesCatagory::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $patient_charge_details = PatientCharge::where('id', $chargeId)->first();

        return view('emg.charges.edit-charges', compact('emg_patient_details', 'emg_id', 'charge_category', 'patient_charge_details'));
    }
    public function save_charges(Request $request)
    {
        $validate = $request->validate([
            'date'   => 'required',
        ]);
        try {
            DB::beginTransaction();
        foreach ($request->charge_name as $key => $value) {
            $patient_charge = new PatientCharge();
            $patient_charge->case_id = $request->case_id;
            $patient_charge->section = $request->section;
            $patient_charge->charges_date = $request->date;
            $patient_charge->emg_id = $request->emg_id;
            $patient_charge->patient_id = $request->patient_id;
            $patient_charge->charge_set = $request->charge_set[$key];
            $patient_charge->charge_type = $request->charge_type[$key];
            $patient_charge->charge_category = $request->charge_category[$key];
            $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
            $patient_charge->charge_name = $request->charge_name[$key];
            $patient_charge->standard_charges = $request->standard_charges[$key];
            $patient_charge->tax = $request->tax[$key];
            $patient_charge->qty = $request->qty[$key];
            $patient_charge->amount = $request->amount[$key];
            $patient_charge->generated_by = Auth::user()->id;
            $patient_charge->billing_status = '0';
            $patient_charge->save();

            if ($request->charge_category[$key] == '1') {
                $charge_detp = PathologyTest::where('charge', $request->charge_name[$key])->first();
                // dd($charge_detp);
                $chargedetailstestp = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detp->id)->where('test_status', '=', '0')->first();

                if ($chargedetailstestp == null) {
                    $pathology_patient_test = new PathologyPatientTest();
                    $pathology_patient_test->case_id = $request->case_id;
                    $pathology_patient_test->date = $request->date;
                    $pathology_patient_test->section = 'EMG';
                    $pathology_patient_test->patient_id = $request->patient_id;
                    $pathology_patient_test->test_id =  $charge_detp->id;
                    $pathology_patient_test->emg_id = $request->emg_id;
                    $pathology_patient_test->generated_by = Auth::user()->id;
                    $pathology_patient_test->billing_status = '2';
                    $pathology_patient_test->test_status = '0';
                    $pathology_patient_test->save();
                } else {
                    $chargedetailstestp->billing_status = '2';
                    $chargedetailstestp->save();
                }
            }
            if ($request->charge_category[$key] == '2') {
                $charge_detr = RadiologyTest::where('charge', $request->charge_name[$key])->first();
                // dd( $charge_detr);
                $chargedetailstestr = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detr->id)->where('test_status', '=', '0')->where('test_id', $charge_detr->charge)->first();

                if ($chargedetailstestr == null) {
                    $radiology_patient_test = new RadiologyPatientTest();
                    $radiology_patient_test->case_id = $request->case_id;
                    $radiology_patient_test->date = $request->date;
                    $radiology_patient_test->section = 'EMG';
                    $radiology_patient_test->patient_id = $request->patient_id;
                    $radiology_patient_test->test_id = $charge_detr->id;
                    $radiology_patient_test->emg_id = $request->emg_id;
                    $radiology_patient_test->generated_by = Auth::user()->id;
                    $radiology_patient_test->billing_status = '2';
                    $radiology_patient_test->test_status = '0';
                    $radiology_patient_test->save();
                } else {
                    $chargedetailstestr->billing_status = '2';
                    $chargedetailstestr->save();
                }
            }
        }
        DB::commit();
        return redirect()->route('charges-list-emg', ['id' => base64_encode($request->emg_id)])->with('success', "Charges Added Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function emg_pathology_investigation($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $pathology_patient_test = PathologyPatientTest::where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.pathology.test-list', compact('pathology_patient_test', 'emg_patient_details', 'emg_id'));
    }

    public function emg_radiology_investigation($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        // dd($emg_patient_details);
        $radiology_patient_test = RadiologyPatientTest::where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.radiology.test-list', compact('radiology_patient_test', 'emg_patient_details', 'emg_id'));
    }

    public function print_emg_registation($id)
    {
        $emg_id = base64_decode($id);
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        $emg_patient_details = EmgPatientDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'emg_patient_details.patient_type', 'patients.address', 'patients.blood_group', 'emg_patient_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'emg_patient_details.appointment_date', 'emg_patient_details.medico_legal_case', 'emg_details.emg_prefix', 'emg_details.id as emg_id')
        ->join('emg_details', 'emg_details.id', '=', 'emg_patient_details.emg_details_id')
        ->join('patients', 'patients.id', '=', 'emg_details.patient_id')
        ->join('users', 'users.id', '=', 'emg_patient_details.cons_doctor')
        ->join('departments', 'departments.id', '=', 'emg_patient_details.department_id')
        ->where('emg_details.id', $emg_id)
        ->first();

        // dd($emg_patient_details);

        $pdf = PDF::loadView('emg._print.emg_prescription', compact('emg_patient_details', 'header_image'));
        return $pdf->stream('emg_prescription.pdf');

        return redirect()->route('emg-patient-list')->with('success', ' Sucessfully');

    }

    public function delete_emg_registation($id)
    {
        try {
            DB::beginTransaction();
            $emg_id = base64_decode($id);
            EmgDetails::where('id',$emg_id)->delete();
            EmgPatientDetails::where('emg_details_id',$emg_id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Registation Deleted Successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
