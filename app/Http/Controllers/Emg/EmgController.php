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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EmgPatientPhysicalDetail;
use PDF;

class EmgController extends Controller
{

    public function index()
    {
        $emg_registaion_list = EmgDetails::get();

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
            return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'type'));
        } else {
            return redirect()->route('emg-registation');
        }
    }

    public function emg_registation(Request $request,$patientid=null)
    {
        if($patientid != null){
            $patient_id = base64_decode($patientid);
        }
        else{
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

        $validate = $request->validate([
            'appointment_date'      => 'required',
            'patient_type'          => 'required',
            'department'            => 'required',
            'cons_doctor'           => 'required',
            'medico_legal_case'     => 'required',
        ]);
        // try {
        //     DB::beginTransaction();
        $emg_prefix = Prefix::where('name', 'emg')->first();

        //SAVE in CASE reference
        $caseReference = new caseReference;
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

        $patient_physical_condition = new EmgPatientPhysicalDetail();
        $patient_physical_condition->emg_id                      = $Emg_details->id;
        $patient_physical_condition->bp                          = $request->bp;
        $patient_physical_condition->height                      = $request->height;
        $patient_physical_condition->weight                      = $request->weight;
        $patient_physical_condition->pulse                       = $request->pulse;
        $patient_physical_condition->temperature                 = $request->temperature;
        $patient_physical_condition->respiration                 = $request->respiration;
        $patient_physical_condition->save();
        DB::commit();
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        $emg_patient_details = EmgPatientDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'emg_patient_details.patient_type', 'patients.address', 'patients.blood_group', 'emg_patient_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'patient_physical_details.height', 'patient_physical_details.weight', 'patient_physical_details.bp', 'patient_physical_details.respiration', 'patient_physical_details.temperature', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'emg_patient_details.appointment_date', 'emg_patient_details.medico_legal_case', 'emg_details.emg_prefix', 'emg_details.id as emg_id')
            ->join('emg_details', 'emg_details.id', '=', 'emg_patient_details.emg_details_id')
            ->join('patients', 'patients.id', '=', 'emg_details.patient_id')
            ->join('patient_physical_details', 'patient_physical_details.emg_patient_details_id', '=', 'emg_patient_details.id')
            ->join('users', 'users.id', '=', 'emg_patient_details.cons_doctor')
            ->join('departments', 'departments.id', '=', 'emg_patient_details.department_id')
            ->where('emg_patient_details.id', $emg_patient_details->id)
            ->first();



        if ($request->save == 'save_and_print') {
            $pdf = PDF::loadView('emg._print.emg_prescription', compact('emg_patient_details', 'header_image'));
            return $pdf->stream('emg_prescription.pdf', array('Attachment' => 0));
            return $pdf->download('emg_prescription.pdf')->redirect()->back()->with('success', 'EMG Registation Sucessfully');
        } else {
            return redirect()->route('emg-patient-list')->with('success', 'EMG Registation Sucessfully');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
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
        return view('emg.emg-patient-profile', compact('emg_patient_details', 'emg_visit_details'));
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
}
