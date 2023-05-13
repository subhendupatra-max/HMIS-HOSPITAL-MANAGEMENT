<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DischargedPatient;
use App\Models\IpdDetails;
use App\Models\Diagonasis;
use App\Models\Patient;
use App\Models\PatientBedHistory;
use Illuminate\Support\Facades\DB;

class PatientDischargeController extends Controller
{
    public function discharged_patient_in_ipd($ipd_id)
    {

        $discharged_patient = DischargedPatient::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipd_id)->get();
        $icd_code = Diagonasis::all();
        return view('Ipd.discharge-patient.add-discharge-patient', compact('discharged_patient', 'ipd_id', 'patient_discharge_details', 'ipd_details', 'ipd_patient_details', 'icd_code'));
    }

    public function add_patient_discharge($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $discharged_patient = DischargedPatient::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipd_id)->get();
        $icd_code = Diagonasis::all();
        return view('Ipd.discharge-patient.add-discharge-patient', compact('discharged_patient', 'ipd_id', 'patient_discharge_details', 'ipd_details', 'ipd_patient_details', 'icd_code'));
    }


    public function save_patient_discharge(Request $request)
    {
        $validate = $request->validate([
            'patient_id' => 'required',
            'discharge_date' => 'required',
            'discharge_status' => 'required',
            'icd_code' => 'required',
        ]);
        try {
            DB::beginTransaction();

            //SAVE in ipd details
            $ipd_details = new DischargedPatient();
            $ipd_details->ipd_id                      = $request->ipd_id;
            $ipd_details->case_id                     = $request->case_id;
            $ipd_details->patient_id                  = $request->patient_id;
            $ipd_details->discharge_date              = \Carbon\Carbon::parse($request->discharge_date)->format('Y-m-d h:m:s');
            $ipd_details->discharge_status            = $request->discharge_status;
            $ipd_details->icd_code                    = $request->icd_code;
            $ipd_details->note                        = $request->note;
            $ipd_details->operation                   = $request->operation;
            $ipd_details->diagnosis                   = $request->diagnosis;
            $ipd_details->investigation               = $request->investigation;
            $ipd_details->treatment_home              = $request->treatment_home;
            $status =  $ipd_details->save();
            //SAVE in ipd details

            IpdDetails::where('id', $ipd_details->ipd_id)->update(['discharged' => 'yes', 'discharged_date' => $ipd_details->discharge_date]);

            PatientBedHistory::where('ipd_id', $ipd_details->id)->update(['is_present' => 'no', 'to_date' => $ipd_details->discharge_date]);

            DB::commit();
            if ($status) {
                return redirect()->route('add-discharged-patient-in-ipd', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', 'Ipd Patient Discharged Sucessfully');
            } else {
                return redirect()->route('add-discharged-patient-in-ipd', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', 'Something went wrong');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function all_discharged_patient_in_ipd()
    {
        $discharged_patient = DischargedPatient::select('patients.id as patient_id', 'patients.first_name as patient_first_name', 'patients.middle_name as patient_middle_name', 'patients.last_name as patient_last_name', 'discharged_patients.patient_id', 'discharged_patients.case_id', 'patients.gender', 'patients.phone', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'ipd_details.appointment_date', 'ipd_details.discharged_date')->join('ipd_details', 'ipd_details.id', '=', 'discharged_patients.ipd_id')->join('patients', 'patients.id', '=', 'discharged_patients.patient_id')->join('users', 'users.id', '=', 'ipd_details.cons_doctor')->get();


        return view('Ipd.discharge-patient.all-discharge-patient-listing', compact('discharged_patient'));
    }
}
