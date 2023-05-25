<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\OpdVisitDetails;
use Illuminate\Http\Request;
use App\Models\IpdDetails;
use App\Models\EmgPatientDetails;

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

    public function ipd_patient_index(){
        $departments = Department::where('is_active','1')->get();
        $doctors = User::where('is_active','1')->where('role','Doctor')->get();
        return view('report.ipd_patient_report',compact('departments','doctors'));
    }
    public function fetch_ipd_patient_report(Request $request)
    {
        $all_search_data = $request->all();
       
        $departments = Department::where('is_active','1')->get();
        $doctors = User::where('is_active','1')->where('role','Doctor')->get();
        $ipd_patient_report = IpdDetails::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
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

        // dd($ipd_patient_report);
        return view('report.ipd_patient_report',compact('ipd_patient_report','all_search_data','departments','doctors'));
    }

    public function emg_patient_index(){
        $departments = Department::where('is_active','1')->get();
        $doctors = User::where('is_active','1')->where('role','Doctor')->get();
        return view('report.emg_patient_report',compact('departments','doctors'));
    }
    public function fetch_emg_patient_report(Request $request)
    {
        $all_search_data = $request->all();
       
        $departments = Department::where('is_active','1')->get();
        $doctors = User::where('is_active','1')->where('role','Doctor')->get();
        $emg_patient_report = EmgPatientDetails::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
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
        return view('report.emg_patient_report',compact('emg_patient_report','all_search_data','departments','doctors'));
    }

    public function payment_report_index()
    {
        return view('report.payment_report');
    }

    public function fetch_payment_report(Request $request)
    {
        $all_search_data = $request->all();
       
        $payment_report = Payment::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->section != '') {
                $query->where('section', $request->section);
            }
            if ($request->payment_mode != '') {
                $query->where('payment_mode', $request->payment_mode);
            }
            if ($request->from_date != '') {
                $query->where('payment_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('payment_date', '<=', $request->to_date);
            }
        })->get();
        return view('report.payment_report',compact('payment_report','all_search_data'));
    }

}
