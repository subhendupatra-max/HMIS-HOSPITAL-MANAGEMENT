<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CaseReference;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Department;
use App\Models\OperationBooking;
use App\Models\OperationCatagory;
use App\Models\OperationTheather;
use App\Models\OperationType;
use App\Models\User;
use App\Models\Operation;
use Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Calculation\Engine\Operands\Operand;
use Svg\Tag\Rect;

class MainOperationController extends Controller
{
    public function index()
    {
        return view('main-operation.operation-details');
    }

    public function find_operation_catagory_by_department(Request $request)
    {
        $departments = Operation::where('operation_department', $request->department_id)
            ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operations.operation_catagory')
            ->get();

        // dd($departments);
        return response()->json($departments);
    }


    public function add_operation()
    {
        $patient = Patient::all();
        $departments = Department::where('is_active', '1')->get();
        $all_patient = Patient::all();
        $doctor = User::where('role', '=', 'Doctor')->get();
        $nurse = User::where('role', '=', 'Nurse')->get();
        $staff = User::where('role', '=', 'staff')->get();
        $operation_catagory = OperationCatagory::all();

        $operation_type = OperationType::all();
        $operation_department = Operation::all();

        return view('main-operation.operation-booking', compact('patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department', 'departments', 'all_patient'));
    }

    public function operation_booking(Request $request)
    {
        $patient_details_information = Patient::where('id', '=', $request->patient_id)->first();
        $patient = Patient::all();
        $case_details = CaseReference::where('patient_id', '=', $patient_details_information->id)
            ->orderBy('id', 'DESC')->first();
        // dd($case_details);

        $departments = Department::where('is_active', '1')->get();
        $all_patient = Patient::all();
        $doctor = User::where('role', '=', 'Doctor')->get();
        $nurse = User::where('role', '=', 'Nurse')->get();
        $staff = User::where('role', '=', 'staff')->get();
        $operation_department = Operation::all();
        $operation_catagory = OperationCatagory::all();
        $operation_type = OperationType::all();

        return view('main-operation.operation-booking', compact('patient_details_information', 'departments', 'all_patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department'));
    }

    public function save_operation_booking(Request $request)
    {
        $validate = $request->validate([
            'operation_date_from' => 'required',
            'operation_date_to' => 'required',
            'visit_consultant_doctortype' => 'required',
            'ass_consultant_1' => 'required',
            'ass_consultant_1' => 'required',

        ]);
        try {
            DB::beginTransaction();

            // CaseReference::where('patient_id', $request->patient_id)->update(['section_id' => $Opd_details->id]);

            $operation_booking = new OperationBooking();
            $operation_booking->operation_date_from               = $request->operation_date_from;
            $operation_booking->operation_date_to                 = $request->operation_date_to;
            $operation_booking->consultant_doctor                 = $request->consultant_doctor;
            $operation_booking->ass_consultant_1                  = $request->ass_consultant_1;
            $operation_booking->ass_consultant_2                  = $request->ass_consultant_2;
            $operation_booking->anesthetist                        = $request->anesthetist;
            $operation_booking->anaethesia_type                    = $request->anaethesia_type;
            $operation_booking->ot_technician                      = $request->ot_technician;
            $operation_booking->ot_assistant                       = $request->ot_assistant;
            $operation_booking->remark                             = $request->remark;
            $operation_booking->generated_by                        = Auth::user()->id;
            $operation_booking->save();

            if ($request->section == 'OPD') {
                $opd_id = $request->section_id;
            } else if ($request->section == 'IPD') {
                $ipd_id = $request->section_id;
            } else if ($request->section == 'EMG') {
                $emg_id = $request->section_id;
            }


            $operation_theathers = new OperationTheather();
            $operation_theathers->operation_booking_id               = $operation_booking->id;
            $operation_theathers->case_id                            = $request->case_id;
            $operation_theathers->section                            = $request->section;
            $operation_theathers->opd_id                             = $opd_id;
            $operation_theathers->emg_id                              = $emg_id;
            $operation_theathers->ipd_id                             = $ipd_id;
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id                = $request->operation_category_id;
            $operation_theathers->operation_id                       = '';
            $operation_theathers->operation_type                    = $request->operation_type;
            $operation_theathers->remark                        = $request->remark;
            $operation_theathers->save();

            DB::commit();

            return redirect()->route('')->with('success', 'Operation Booking Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
