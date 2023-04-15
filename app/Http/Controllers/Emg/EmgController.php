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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->route('patient_details');
        }
    }

    public function emg_registation($patientid)
    {
        $patient_id = base64_decode($patientid);
        $patient_details = Patient::where('id', '=', $patient_id)->first();
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $department = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $ticket_fees = EmgSetup::first();

        return view('emg.emg-registration', compact('ticket_fees', 'symptoms_types', 'department', 'referer', 'patient_details', 'patient_id', 'tpa_management'));
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
        try {
            DB::beginTransaction();
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
            $emg_patient_details->bp                          = $request->bp;
            $emg_patient_details->height                      = $request->height;
            $emg_patient_details->weight                      = $request->weight;
            $emg_patient_details->pulse                       = $request->pulse;
            $emg_patient_details->temperature                 = $request->temperature;
            $emg_patient_details->respiration                 = $request->respiration;
            $emg_patient_details->known_allergies             = $request->any_known_allergies;
            $emg_patient_details->note                        = $request->note;
            $emg_patient_details->refference                  = $request->reference;
            $emg_patient_details->generated_by                = Auth::user()->id;
            $emg_patient_details->save();
            //SAVE in opd Visit details

            DB::commit();
            if ($request->save == 'save_and_print') {
                $pdf = PDF::loadView('OPD._print.opd_prescription');
                return $pdf->stream('opd_prescription.pdf', array('Attachment' => 0));
                // return $pdf->download('opd_prescription.pdf')->redirect()->back()->with('success', 'OPD Registation Sucessfully');
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
        $emg_visit_details = EmgPatientDetails::where('emg_details_id',$emg_id)->get();
        return view('emg.emg-patient-profile', compact('emg_patient_details','emg_visit_details'));
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
        $patient_source_id = $visit_details->emg_prefix.''.$visit_details->id;
        $case_id = $visit_details->case_id;
        $patient_source = 'EMG';

        return view('Ipd.ipd-registration', compact('symptoms_types', 'departments', 'referer', 'visit_details', 'tpa_management','patient_source_id','case_id','patient_source','emg_opd_id','units'));
    }


}
