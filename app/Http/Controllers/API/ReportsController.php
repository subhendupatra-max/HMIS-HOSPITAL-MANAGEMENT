<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\OpdVisitDetails;
use App\Models\User;
use App\Models\Billing;
use App\Models\EmgPatientDetails;

class ReportsController extends Controller
{
    public function opd_patient_report_index()
    {
        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();
        $data = [
            'doctors' => $doctors,
            'departments' => $departments,

        ];

        return response()->json($data);
    }

    public function opd_patient_report(Request $request)
    {
        $all_search_data = $request->all();

        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();

        $opd_patient_report = OpdVisitDetails::where(function ($query) use ($request) {
            // if (!auth()->user()->can('False Generation')) {
            //     $query->where('ins_by', 'ori');
            // }
            if ($request->visit_type != '') {
                $query->where('visit_type', $request->visit_type);
            }
            if ($request->patient_type != '') {
                $query->where('patient_type', $request->patient_type);
            }
            if ($request->department != '') {
                $query->where('department_id', $request->department);
            }
            if ($request->cons_doctor != '') {
                $query->where('cons_doctor', $request->cons_doctor);
            }
            if ($request->from_date != '') {
                $query->where('appointment_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('appointment_date', '<=', $request->to_date);
            }
        })->get();
        // dd($opd_patient_report);

        $data = [
            'all_search_data' => $all_search_data,
            'departments' => $departments,
            'doctors' => $doctors,
            'opd_patient_report' => $opd_patient_report,
        ];

        return response()->json($data);
    }
    //opd billing reports

    public function opd_billing_report(Request $request)
    {
        $all_search_data = $request->all();

        $billing_report = Billing::where(function ($query) use ($request) {
            // if (!auth()->user()->can('False Generation')) {
            //     $query->where('ins_by', 'ori');
            // }
            if ($request->from_date != '') {
                $query->where('bill_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('bill_date', '<=', $request->to_date);
            }
        })->where('section', 'OPD')
            ->get();

        $data = [
            'all_search_data' => $all_search_data,
            'billing_report' => $billing_report,
        ];

        return response()->json($data);
    }

    public function emg_patient_index()
    {
        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();
        $data = [
            'departments' => $departments,
            'doctors' => $doctors,
        ];
        return response()->json($data);
    }
    public function fetch_emg_patient_report(Request $request)
    {
        $all_search_data = $request->all();

        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();
        $emg_patient_report = EmgPatientDetails::where(function ($query) use ($request) {
            // if (!auth()->user()->can('False Generation')) {
            //     $query->where('ins_by', 'ori');
            // }
            if ($request->patient_type != '') {
                $query->where('patient_type', $request->patient_type);
            }
            if ($request->medico_legal_case != '') {
                $query->where('medico_legal_case', $request->medico_legal_case);
            }
            if ($request->from_date != '') {
                $query->where('appointment_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('appointment_date', '<=', $request->to_date);
            }
        })->get();

        $data = [
                    'emg_patient_report' => $emg_patient_report,
        ];
        return response()->json($data);
    }
}
