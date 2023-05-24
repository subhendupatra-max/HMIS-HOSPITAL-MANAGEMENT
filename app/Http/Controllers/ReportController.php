<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Models\OpdVisitDetails;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function opd_patient_index(){
        $departments = Department::where('is_active','1')->get();
        $doctors = User::where('is_active','1')->where('role','Doctor')->get();
        return view('report.opd_patient_report',compact('departments','doctors'));
    }
    public function fetch_opd_patient_report(Request $request)
    {
        $all_search_data = $request->all();
       
        $departments = Department::where('is_active','1')->get();
        $doctors = User::where('is_active','1')->where('role','Doctor')->get();
        $opd_patient_report = OpdVisitDetails::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
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
        return view('report.opd_patient_report',compact('opd_patient_report','all_search_data','departments','doctors'));
    }
}
