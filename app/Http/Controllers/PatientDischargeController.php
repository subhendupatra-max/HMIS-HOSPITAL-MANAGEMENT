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
use App\Models\Appointment;
use App\Models\RadiologyTest;
use App\Models\PathologyTest;
use App\Models\DoseDuration;
use App\Models\DoseInterval;
use App\Models\MedicineCatagory;
use Illuminate\Support\Facades\DB;
use App\Models\DischargedMedicine;
use App\Models\DischargedPathologyTest;
use App\Models\DischargedRadiologyTest;

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
        $medicine_catagory = MedicineCatagory::all();
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipdId)->get();
        $icd_code = Diagonasis::all();
        $doctor = User::where('role', 'Doctor')->get();
        return view('Ipd.discharge-patient.add-discharge-patient', compact('DoseDuration', 'DoseInterval', 'radiology_test', 'pathology_test', 'medicine_catagory', 'discharged_patient', 'ipdId', 'patient_discharge_details', 'ipd_details', 'ipd_patient_details', 'icd_code', 'patient_details', 'doctor'));
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
        // try {
        //     DB::beginTransaction();
        // dd($request->ipd_id);
        $p_bed_update = PatientBedHistory::where('ipd_id', $request->ipd_id)->where('to_date', '=', null)->orderBy('id', 'DESC')->first();
        // dd($p_bed_update);
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
        $ipd_details->next_appointment_date                         = $request->next_appointment_date;
        $status      =  $ipd_details->save();
        //SAVE in ipd details

        if ($request->medicine_catagory_id[0] != null) {
            foreach ($request->medicine_catagory_id as $key => $value) {
                $medicine_discharged = new DischargedMedicine();
                $medicine_discharged->ipd_id =  $request->ipd_id;
                $medicine_discharged->patient_id = $request->patient_id;
                $medicine_discharged->case_id = $request->case_id;
                $medicine_discharged->discharged_id  =  $ipd_details->id;
                $medicine_discharged->medicine_category_id =  $request->medicine_catagory_id[$key];
                $medicine_discharged->medicine_id = $request->medicine_name[$key];
                $medicine_discharged->dose = $request->dose[$key];
                $medicine_discharged->interval = $request->dose_interval[$key];
                $medicine_discharged->duration = $request->dose_duration[$key];
                $medicine_discharged->status = '';
                $medicine_discharged->save();
            }
        }
        if ($request->pathology_test_id[0] != null) {
            foreach ($request->pathology_test_id as $key => $value) {
                $pathology_discharged = new DischargedPathologyTest();
                $pathology_discharged->ipd_id =  $request->ipd_id;
                $pathology_discharged->patient_id = $request->patient_id;
                $pathology_discharged->case_id = $request->case_id;
                $pathology_discharged->discharged_id  =  $ipd_details->id;
                $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                $pathology_discharged->save();
            }
        }
        if ($request->radiology_test_id[0] != null) {
            foreach ($request->radiology_test_id as $key => $value) {
                $radiolo_discharged = new DischargedRadiologyTest();
                $radiolo_discharged->ipd_id =  $request->ipd_id;
                $radiolo_discharged->patient_id = $request->patient_id;
                $radiolo_discharged->case_id = $request->case_id;
                $radiolo_discharged->discharged_id  =  $ipd_details->id;
                $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                $radiolo_discharged->save();
            }
        }

        if ($request->discharge_status ==  'Death') {
            $death_patient = new DeathReport();
            $death_patient->ipd_id = $request->ipd_id;
            $death_patient->case_id = $request->case_id;
            $death_patient->death_date =  \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
            $death_patient->save();

            $appointment = new Appointment();
            $appointment->patient_id = $ipd_details->patient_id;
            $appointment->doctor =  $ipd_details->doctor_name;
            $appointment->appointment_date =  $ipd_details->next_appointment_date;
            $appointment->appointment_priority = '';
            $appointment->message = '';
            $appointment->save();
        }


        IpdDetails::where('id', $request->ipd_id)->update(['status' => 'Discharged', 'discharged' => 'yes', 'discharged_date' => \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s')]);
        Bed::where('id', $ipd_details->bed)->update(['is_used' => 'Under Maintenance']);
        // DB::commit();
        if ($status) {
            return redirect()->route('all-discharged-patient-in-ipd')->with('success', 'Ipd Patient Discharged Successfully');
        } else {
            return redirect()->route('add-discharged-patient-in-ipd')->with('success', 'Something went wrong');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }

    public function all_discharged_patient_in_ipd()
    {

        $ipd_patient_list = IpdDetails::where('is_active', '1')->where('discharged', 'yes')->where('ins_by', 'ori')->orderBy('discharged_date', 'DESC')->get();

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
        $medicine_catagory = MedicineCatagory::all();
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();
        $patient_details = Patient::where('id', $ipd_details->patient_id)->first();
        $icd_code = Diagonasis::all();
        $doctor = User::where('role', 'Doctor')->get();
        $medicine_discharge_details =  DischargedMedicine::where('ipd_id', $ipd_details->id)->get();
        $radiology_discharge_details =  DischargedRadiologyTest::where('ipd_id', $ipd_details->id)->get();
        $pathology_discharge_details =  DischargedPathologyTest::where('ipd_id', $ipd_details->id)->get();


        return view('Ipd.discharge-patient.edit-discharge-patient', compact('medicine_catagory', 'pathology_test', 'radiology_test', 'DoseInterval', 'DoseDuration', 'discharged_patient', 'ipd_id', 'patient_discharge_details', 'ipd_details', 'ipd_patient_details', 'icd_code', 'ipdId', 'patient_details', 'doctor', 'radiology_discharge_details', 'pathology_discharge_details', 'medicine_discharge_details'));
    }

    public function update_patient_discharge(Request $request)
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
            $ipd_details->next_appointment_date                         = $request->next_appointment_date;
            $status      =  $ipd_details->save();
            //SAVE in ipd details

            DischargedMedicine::where('ipd_id', $request->ipd_id)->delete();
            DischargedPathologyTest::where('ipd_id', $request->ipd_id)->delete();
            DischargedRadiologyTest::where('ipd_id', $request->ipd_id)->delete();

            if ($request->medicine_catagory_id[0] != null) {
                foreach ($request->medicine_catagory_id as $key => $value) {
                    $medicine_discharged = new DischargedMedicine();
                    $medicine_discharged->ipd_id =  $request->ipd_id;
                    $medicine_discharged->patient_id = $request->patient_id;
                    $medicine_discharged->case_id = $request->case_id;
                    $medicine_discharged->discharged_id  =  $ipd_details->id;
                    $medicine_discharged->medicine_category_id =  $request->medicine_catagory_id[$key];
                    $medicine_discharged->medicine_id = $request->medicine_name[$key];
                    $medicine_discharged->dose = $request->dose[$key];
                    $medicine_discharged->interval = $request->dose_interval[$key];
                    $medicine_discharged->duration = $request->dose_duration[$key];
                    $medicine_discharged->status = '';
                    $medicine_discharged->save();
                }
            }
            if ($request->pathology_test_id[0] != null) {
                foreach ($request->pathology_test_id as $key => $value) {
                    $pathology_discharged = new DischargedPathologyTest();
                    $pathology_discharged->ipd_id =  $request->ipd_id;
                    $pathology_discharged->patient_id = $request->patient_id;
                    $pathology_discharged->case_id = $request->case_id;
                    $pathology_discharged->discharged_id  =  $ipd_details->id;
                    $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                    $pathology_discharged->save();
                }
            }
            if ($request->radiology_test_id[0] != null) {
                foreach ($request->radiology_test_id as $key => $value) {
                    $radiolo_discharged = new DischargedRadiologyTest();
                    $radiolo_discharged->ipd_id =  $request->ipd_id;
                    $radiolo_discharged->patient_id = $request->patient_id;
                    $radiolo_discharged->case_id = $request->case_id;
                    $radiolo_discharged->discharged_id  =  $ipd_details->id;
                    $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                    $radiolo_discharged->save();
                }
            }

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
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipd_id)->first();
        $dis_id = $patient_discharge_details->id;
        $DischargedMedicine = DischargedMedicine::where('discharged_id', $dis_id)->get();
        // dd($DischargedMedicine);
        $DischargedPathologyTest = DischargedPathologyTest::where('discharged_id', $dis_id)->get();
        $DischargedRadiologyTest = DischargedRadiologyTest::where('discharged_id', $dis_id)->get();

        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        return view('ipd._print.discharged_patient', compact('patient_discharge_details', 'header_image', 'ipd_details', 'DischargedMedicine', 'DischargedPathologyTest', 'DischargedRadiologyTest'));
    }

    public function details_discharged_patient_in_ipd($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $discharge_patient_details = DischargedPatient::where('ipd_id', $ipd_id)->first();
        // dd($discharge_patient_details);
        $dis_id = $discharge_patient_details->id;
        // dd($dis_id);
        $DischargedMedicine = DischargedMedicine::where('discharged_id', $dis_id)->get();
        //  dd($DischargedMedicine);
        $DischargedPathologyTest = DischargedPathologyTest::where('discharged_id', $dis_id)->get();
        $DischargedRadiologyTest = DischargedRadiologyTest::where('discharged_id', $dis_id)->get();
        return view('ipd.discharge-patient.discharge-patient-details', compact('dis_id', 'discharge_patient_details', 'DischargedMedicine', 'DischargedPathologyTest', 'DischargedRadiologyTest', 'ipd_details', 'ipd_id'));
    }
}
