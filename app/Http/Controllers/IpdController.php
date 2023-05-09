<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Patient;
use App\Models\PatientBedHistory;
use App\Models\TpaManagement;
use App\Models\Referral;
use App\Models\Department;
use App\Models\IpdDetails;
use App\Models\OpdDetails;
use App\Models\OpdVisitDetails;
use Illuminate\Http\Request;
use App\Models\SymptomsType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Bed;
use App\Models\BedUnit;
use App\Models\IpdPayment;
use App\Models\Prefix;
use App\Models\Ward;
use App\Models\IpdTimeline;
use App\Models\MedicationDose;
use App\Models\MedicineCatagory;
use App\Models\NurseNote;
use App\Models\OperationTheatre;
use App\Models\OxygenMonitoring;
use Illuminate\Support\Facades\DB;

class IpdController extends Controller
{
    public function index()
    {
        $ipd_patient_list = IpdDetails::where('is_active', '1')->where('ins_by', 'ori')->get();
        return view('Ipd.ipd-patients-details', compact('ipd_patient_list'));
    }

    public  function ipd_registation_from_opd($patientid, $patient_source, $source_id)
    {
        $patient_id = base64_decode($patientid);
        $patient_details = Patient::where('id', '=', $patient_id)->first();
        $patient_source_id = $source_id;
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $patient_source_name = $patient_source;
        $case_id = OpdDetails::where('patient_id', '=', $patient_id)->first();

        return view('Ipd.ipd-registration', compact('symptoms_types', 'departments', 'referer', 'patient_details', 'patient_id', 'tpa_management', 'patient_source_name', 'patient_source_id', 'case_id'));
    }

    public  function profile($id)
    {
        $ipd_id = base64_decode($id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $bed_history_details = PatientBedHistory::where('id', $ipd_id)->first();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::all();
        $oxygen_monitering = OxygenMonitoring::where('ipd_id', $ipd_id)->get();
        $bedHistory = PatientBedHistory::where('ipd_id', $ipd_id)->get();
        $edit_histry_details_id = PatientBedHistory::where('ipd_id', $ipd_id)->latest()->first();
        $nurseName = User::where('role', 'Nurse')->get();
        $nurseNoteDetails = NurseNote::where('ipd_id', $ipd_id)->get();
        $medicine_catagory = MedicineCatagory::all();
        $medication_details = MedicationDose::all();
        $cons_doctor = User::where('role', '=', 'Doctor')->get();
        $operation_details = OperationTheatre::all();
        $paymentDetails = IpdPayment::all();


        return view('Ipd.ipd-profile', compact('paymentDetails', 'operation_details', 'cons_doctor', 'medication_details', 'medicine_catagory', 'oxygen_monitering', 'ipd_details', 'bed_history_details', 'departments', 'units', 'bedHistory', 'edit_histry_details_id', 'nurseName', 'nurseNoteDetails'));
    }

    public function find_doctor_and_ward_by_department_in_opd(Request $request)
    {
        $find_doctor = User::where('department', $request->department_id)->get();
        $find_bedward = Ward::where('department_id', $request->department_id)->get();
        return response()->json(['doctor' => $find_doctor, 'ward' => $find_bedward]);
    }

    public function find_bed_by_bed_ward(Request $request)
    {
        $find_bed = Bed::where('bedWard_id', $request->bed_ward)->where('bedUnit_id', $request->bed_unit)->where('is_used', 'no')->get();
        // dd($find_bed);
        return response()->json($find_bed);
    }

    public function ipd_registation(Request $request)
    {
        $validate = $request->validate([
            'appointment_date' => 'required',
            'patient_type' => 'required',
            'department' => 'required',
            'cons_doctor' => 'required',
            'ward' => 'required',
            'unit' => 'required',
            'bed' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $ipd_prefix = Prefix::where('name', 'ipd')->first();

            //SAVE in ipd details
            $ipd_details = new IpdDetails();
            $ipd_details->ipd_prefix                  = $ipd_prefix->prefix;
            $ipd_details->patient_id                  = $request->patient_id;
            $ipd_details->patient_source_id           = $request->patient_source_id;
            $ipd_details->patient_source              = $request->patient_source;
            $ipd_details->case_id                     = $request->case_id;
            $ipd_details->appointment_date            = $request->appointment_date;
            $ipd_details->credit_limit                = $request->credit_limit;
            $ipd_details->bp                          = $request->bp;
            $ipd_details->height                      = $request->height;
            $ipd_details->weight                      = $request->weight;
            $ipd_details->pulse                       = $request->pulse;
            $ipd_details->temperature                 = $request->temperature;
            $ipd_details->respiration                 = $request->respiration;
            $ipd_details->known_allergies             = $request->any_known_allergies;
            $ipd_details->symptoms_type               = $request->symptoms_type;
            $ipd_details->symptoms                    = $request->symptoms_title;
            $ipd_details->symptoms_description        = $request->symptoms_description;
            $ipd_details->patient_type                = $request->patient_type;
            $ipd_details->tpa_organization            = $request->tpa_organization;
            $ipd_details->type_no                     = $request->type_no;
            $ipd_details->note                        = $request->note;
            $ipd_details->refference                  = $request->reference;
            $ipd_details->cons_doctor                 = $request->cons_doctor;
            $ipd_details->department_id               = $request->department;
            $ipd_details->bed                         = $request->bed;
            $ipd_details->bed_ward_id                 = $request->ward;
            $ipd_details->bed_unit_id                 = $request->unit;
            $ipd_details->generated_by                = Auth::user()->id;
            $ipd_details->save();
            //SAVE in ipd details


            //bed status update in bed table
            Bed::where('id', $request->bed)->update(['is_used' => 'yes']);
            //bed status update in bed table

            //bed history update in bed table
            $patient_bed_history = new PatientBedHistory();
            $patient_bed_history->patient_id = $request->patient_id;
            $patient_bed_history->case_id = $request->case_id;
            $patient_bed_history->ipd_id = $ipd_details->id;
            $patient_bed_history->department_id = $request->department;
            $patient_bed_history->bed_ward_id = $request->ward;
            $patient_bed_history->bed_unit_id = $request->unit;
            $patient_bed_history->bed_id = $request->bed;
            $patient_bed_history->from_date = $request->appointment_date;
            $patient_bed_history->save();
            //bed history update in bed table

            DB::commit();
            if ($request->save == 'save_and_print') {
                $pdf = PDF::loadView('OPD._print.opd_prescription');
                return $pdf->stream('opd_prescription.pdf', array('Attachment' => 0));
            } else {
                return redirect()->route('ipd-patient-listing')->with('success', 'Ipd Registation Sucessfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function ipd_patient_status_change(Request $request)
    {
        $ipd_details = IpdDetails::where('id', $request->ipdId)->get();
        return response()->json($ipd_details);
    }

    public function admission_from_opd($id)
    {
        $emg_opd_id = base64_decode($id);
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $visit_details = OpdDetails::where('id', '=', $emg_opd_id)->first();
        $patient_source_id = $visit_details->opd_prefix . '' . $visit_details->id;
        $case_id = $visit_details->case_id;
        $patient_source = 'OPD';

        return view('Ipd.ipd-registration', compact('symptoms_types', 'departments', 'referer', 'visit_details', 'tpa_management', 'patient_source_id', 'case_id', 'patient_source', 'emg_opd_id', 'units'));
    }

    public function edit_ipd_registration($id)
    {
        $ipd_id = $id;
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::where('is_active', '1')->get();
        $visit_details = IpdDetails::where('id', '=', $ipd_id)->first();
        // dd($visit_details);

        return view('Ipd.edit-ipd-patient', compact('ipd_id', 'departments', 'referer', 'tpa_management', 'visit_details', 'units'));
    }
}
