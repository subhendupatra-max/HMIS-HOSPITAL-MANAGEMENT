<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DischargedPatient;
use App\Models\IpdDetails;
use App\Models\Diagonasis;
use App\Models\Patient;
use App\Models\Bed;
use App\Models\DeathReport;
use App\Models\PatientBedHistory;
use App\Models\User;
use App\Models\AllHeader;
use Illuminate\Support\Facades\DB;

class PatientDischargeController extends Controller
{
    public function discharged_patient_in_ipd($ipd_id = null)
    {
        $ipdId = base64_decode($ipd_id);
        $discharged_patient = DischargedPatient::all();
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipdId)->first();
        $patient_details = Patient::where('id', $ipd_details->patient_id)->first();
        // dd($ipd_patient_details);
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipdId)->get();
        $icd_code = Diagonasis::all();
        $doctor = User::where('role', 'Doctor')->get();
        return view('Ipd.discharge-patient.add-discharge-patient', compact('discharged_patient', 'ipdId', 'patient_discharge_details', 'ipd_details', 'ipd_patient_details', 'icd_code', 'patient_details', 'doctor'));
    }

    public function add_patient_discharge($ipd_id)
    {
        // dd($ipd_id);
        $ipdId = base64_decode($ipd_id);
        $ipd_id = base64_decode($ipd_id);
        $discharged_patient = DischargedPatient::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipd_id)->get();
        $patient_details = Patient::where('id', $ipd_details->patient_id)->first();
        $icd_code = Diagonasis::all();
        $doctor = User::where('role', 'Doctor')->get();
        return view('Ipd.discharge-patient.add-discharge-patient', compact('discharged_patient', 'ipd_id', 'patient_discharge_details', 'ipd_details', 'ipd_patient_details', 'icd_code', 'ipdId', 'patient_details', 'doctor'));
    }


    public function save_patient_discharge(Request $request)
    {
        // dd($request->all());
        // $validate = $request->validate([
        //     'patient_id' => 'required',
        //     'discharge_date' => 'required',
        //     'discharge_status' => 'required',
        //     'icd_code' => 'required',
        // ]);
        try {
            DB::beginTransaction();

            $p_bed_update = PatientBedHistory::where('ipd_id', $request->ipd_id)->where('to_date', '=', null)->orderBy('id', 'DESC')->first();
            $p_bed_update->is_present = 'no';
            $p_bed_update->to_date =  \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
            $p_bed_update->save();
            // dd($p_bed_update);
            //SAVE in ipd details
            $ipd_details = new DischargedPatient();
            $ipd_details->ipd_id                                        = $request->ipd_id;
            $ipd_details->case_id                                       = $request->case_id;
            $ipd_details->patient_id                                    = $request->patient_id;
            $ipd_details->discharge_date                                = \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
            $ipd_details->discharge_status                              = $request->discharge_status;
            $ipd_details->icd_code                                      = $request->icd_code;
            $ipd_details->diagonsis_admission_time                      = $request->diagonsis_admission_time;
            $ipd_details->final_diagonsis_discharge                     = $request->final_diagonsis_discharge;
            $ipd_details->diagnosis                                     = $request->diagnosis;
            $ipd_details->complaiints_duraiton                          = $request->complaiints_duraiton;
            $ipd_details->presenting_illness                            = $request->presenting_illness;
            $ipd_details->physical_examinaiton_at_admission             = $request->physical_examinaiton_at_admission;
            $ipd_details->summary_inves_during_hos                      = $request->summary_inves_during_hos;
            $ipd_details->course_complications                          = $request->course_complications;
            $ipd_details->dischage_advice                               = $request->dischage_advice;
            $ipd_details->refferal_hospital_name                        = $request->refferal_hospital_name;
            $ipd_details->doctor_name                                   = $request->doctor_name;
            $status      =  $ipd_details->save();
            //SAVE in ipd details

            if ($request->discharge_status ==  'Death') {
                $death_patient = new DeathReport();
                $death_patient->ipd_id = $request->ipd_id;
                $death_patient->case_id = $request->case_id;
                $death_patient->death_date =  \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
                $death_patient->save();
            }
            IpdDetails::where('id', $request->ipd_id)->update(['status' => 'Discharged', 'discharged' => 'yes', 'discharged_date' => \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s')]);
            Bed::where('id', $ipd_details->bed)->update(['is_used' => 'Under Maintenance']);
            DB::commit();
            if ($status) {
                return redirect()->route('all-discharged-patient-in-ipd')->with('success', 'Ipd Patient Discharged Successfully');
            } else {
                return redirect()->route('add-discharged-patient-in-ipd')->with('success', 'Something went wrong');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function all_discharged_patient_in_ipd()
    {

        $ipd_patient_list = IpdDetails::where('is_active', '1')->where('discharged', 'yes')->where('ins_by', 'ori')->get();

        // $discharged_patient = DischargedPatient::select('patients.id as patient_id', 'patients.first_name as patient_first_name', 'patients.middle_name as patient_middle_name', 'patients.last_name as patient_last_name', 'discharged_patients.patient_id', 'discharged_patients.case_id', 'patients.gender', 'patients.phone', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'ipd_details.appointment_date', 'ipd_details.discharged_date')->join('ipd_details', 'ipd_details.id', '=', 'discharged_patients.ipd_id')->join('patients', 'patients.id', '=', 'discharged_patients.patient_id')->join('users', 'users.id', '=', 'ipd_details.cons_doctor')->get();

        return view('Ipd.discharge-patient.all-discharge-patient-listing', compact('ipd_patient_list'));
    }

    public function edit_patient_discharge($ipd_id, $discharge_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_id = base64_decode($ipd_id);
        $discharge_id = base64_decode($discharge_id);
        $discharged_patient = DischargedPatient::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipd_details->id)->where('id', $discharge_id)->first();
        $patient_details = Patient::where('id', $ipd_details->patient_id)->first();
        $icd_code = Diagonasis::all();
        $doctor = User::where('role', 'Doctor')->get();
        return view('Ipd.discharge-patient.edit-discharge-patient', compact('discharged_patient', 'ipd_id', 'patient_discharge_details', 'ipd_details', 'ipd_patient_details', 'icd_code', 'ipdId', 'patient_details', 'doctor'));
    }

    public function update_patient_discharge(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'patient_id' => 'required',
            'discharge_date' => 'required',
            'discharge_status' => 'required',
            'icd_code' => 'required',
        ]);
        try {
            DB::beginTransaction();

            $p_bed_update = PatientBedHistory::where('ipd_id', $request->ipd_id)->where('to_date', '=', null)->orderBy('id', 'DESC')->first();
            $p_bed_update->is_present = 'yes';
            $p_bed_update->to_date =  \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
            $p_bed_update->save();
            // dd($p_bed_update);
            //SAVE in ipd details
            $ipd_details = DischargedPatient::where('id', $request->discharged_patient_id)->first();
            $ipd_details->ipd_id                                        = $request->ipd_id;
            $ipd_details->case_id                                       = $request->case_id;
            $ipd_details->patient_id                                    = $request->patient_id;
            $ipd_details->discharge_date                                = \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
            $ipd_details->discharge_status                              = $request->discharge_status;
            $ipd_details->icd_code                                      = $request->icd_code;
            $ipd_details->diagonsis_admission_time                      = $request->diagonsis_admission_time;
            $ipd_details->final_diagonsis_discharge                     = $request->final_diagonsis_discharge;
            $ipd_details->diagnosis                                     = $request->diagnosis;
            $ipd_details->complaiints_duraiton                          = $request->complaiints_duraiton;
            $ipd_details->presenting_illness                            = $request->presenting_illness;
            $ipd_details->physical_examinaiton_at_admission             = $request->physical_examinaiton_at_admission;
            $ipd_details->summary_inves_during_hos                      = $request->summary_inves_during_hos;
            $ipd_details->course_complications                          = $request->course_complications;
            $ipd_details->dischage_advice                               = $request->dischage_advice;
            $ipd_details->refferal_hospital_name                        = $request->refferal_hospital_name;
            $ipd_details->doctor_name                                   = $request->doctor_name;
            $status      =  $ipd_details->save();
            //SAVE in ipd details

            DeathReport::where('ipd_id', $request->ipd_id)->delete();

            if ($request->discharge_status ==  'Death') {
                $death_patient = new DeathReport();
                $death_patient->ipd_id = $request->ipd_id;
                $death_patient->case_id = $request->case_id;
                $death_patient->death_date =  \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
                $death_patient->save();
            }

            IpdDetails::where('id', $request->ipd_id)->update(['status' => 'Discharged', 'discharged' => 'yes', 'discharged_date' => \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s')]);

            Bed::where('id', $ipd_details->bed)->update(['is_used' => 'Under Maintenance']);
            DB::commit();
            if ($status) {
                return redirect()->route('all-discharged-patient-in-ipd')->with('success', 'Ipd Patient Discharged Updated Successfully');
            } else {
                return redirect()->route('add-discharged-patient-in-ipd')->with('success', 'Something went wrong');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function print_discharged_patient_in_ipd($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $patient_discharge_details =  DischargedPatient::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'ipd_details.appointment_date', 'ipd_details.ipd_prefix', 'ipd_details.id as ipd_id', 'patients.phone', 'patients.guardian_name', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'ipd_details.patient_type', 'wards.ward_name as wardname', 'bed_units.bedUnit_name', 'departments.department_name', 'beds.bed_name', 'patients.address', 'states.name as state_name', 'districts.name as district_name', 'discharged_patients.dischage_advice', 'discharged_patients.course_complications', 'discharged_patients.summary_inves_during_hos', 'ipd_details.family_history_diagnosis', 'ipd_details.medical_surgical_history', 'ipd_details.history_alcoholism', 'discharged_patients.physical_examinaiton_at_admission', 'ipd_patient_physical_details.height', 'ipd_patient_physical_details.weight', 'ipd_patient_physical_details.pulse', 'ipd_patient_physical_details.bp', 'ipd_patient_physical_details.temperature', 'ipd_patient_physical_details.respiration', 'ipd_details.patient_source', 'ipd_details.patient_source_id', 'diagonases.diagonasis_name', 'discharged_patients.final_diagonsis_discharge', 'discharged_patients.diagonsis_admission_time', 'tpa_management.TPA_name', 'ipd_details.type_no')
            ->where('discharged_patients.ipd_id', $ipd_details->id)
            ->leftjoin('ipd_details', 'ipd_details.id', '=', 'discharged_patients.ipd_id')
            ->leftjoin('patients', 'patients.id', '=', 'discharged_patients.patient_id')
            ->leftjoin('ipd_patient_physical_details', 'ipd_patient_physical_details.ipd_id', '=', 'discharged_patients.ipd_id')
            ->leftjoin('users', 'users.id', '=', 'ipd_details.cons_doctor')
            ->leftjoin('wards', 'wards.id', '=', 'ipd_details.bed_ward_id')
            ->leftjoin('bed_units', 'bed_units.id', '=', 'ipd_details.bed_unit_id')
            ->leftjoin('departments', 'departments.id', '=', 'ipd_details.department_id')
            ->leftjoin('beds', 'beds.id', '=', 'ipd_details.bed')
            ->leftjoin('states', 'states.id', '=', 'patients.state')
            ->leftjoin('districts', 'districts.id', '=', 'patients.district')
            ->leftjoin('diagonases', 'diagonases.id', '=', 'discharged_patients.icd_code')
            ->leftjoin('tpa_management', 'tpa_management.id', '=', 'ipd_details.tpa_organization')
            ->first();

        // dd($patient_discharge_details);
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        return view('ipd._print.discharged_patient', compact('patient_discharge_details', 'header_image'));
    }
}
