<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\caseReference;
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
use Carbon;

class MainOperationController extends Controller
{
    public function index()
    {
        $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.status')
            ->leftjoin('operation_theathers', 'operation_theathers.operation_booking_id', '=', 'operation_bookings.id')
            ->leftjoin('patients', 'patients.id', '=', 'operation_theathers.patient_id')
            ->leftjoin('departments', 'departments.id', '=', 'operation_theathers.operation_department')
            ->leftjoin('users', 'users.id', '=', 'operation_bookings.consultant_doctor')
            ->leftjoin('operations', 'operations.id', '=', 'operation_theathers.operation_id')
            ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operation_theathers.operation_category_id')
            ->get();
        // dd($operation_details);
        return view('main-operation.operation-details', compact('operation_details'));
    }

    public function view_operation_booking_details($id)
    {
        $operation_booking_id = base64_decode($id);
        $section_id =  OperationTheather::where('operation_booking_id', $operation_booking_id)->first();
        $case_id = caseReference::where('id', $section_id->case_id)->first();
        $section_name = $case_id->section_id;

        $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark')
            ->leftjoin('operation_theathers', 'operation_theathers.operation_booking_id', '=', 'operation_bookings.id')
            ->leftjoin('patients', 'patients.id', '=', 'operation_theathers.patient_id')
            ->leftjoin('departments', 'departments.id', '=', 'operation_theathers.operation_department')
            ->leftjoin('users', 'users.id', '=', 'operation_bookings.consultant_doctor')
            ->leftjoin('operations', 'operations.id', '=', 'operation_theathers.operation_id')
            ->leftjoin('operation_types', 'operation_types.id', '=', 'operation_theathers.operation_type')
            ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operation_theathers.operation_category_id')
            ->where('operation_bookings.id', $operation_booking_id)
            ->where('operation_theathers.operation_booking_id', $operation_booking_id)
            ->first();
        // dd($operation_details);

        return view('main-operation.operation-booking-view', compact('operation_details', 'section_name'));
    }

    public function find_operation_catagory_by_department(Request $request)
    {
        $operation_catagory = Operation::where('operation_department', $request->department_id)
            ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operations.operation_catagory')
            ->get();
            // dd($operation_catagory);
        return response()->json(['operation_catagory' => $operation_catagory]);
    }

    public function find_operation_name_by_catagory(Request $request)
    {
        $operation_name = Operation::where('operation_catagory', $request->catagory_id)->get();

        return response()->json(['operation_name' => $operation_name]);
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
        // dd($request->patient_id);
        $patient_details_information = Patient::where('id', '=', $request->patient_id)->first();
        // dd($patient_details_information);
        $patient = Patient::all();
        $case_details = caseReference::where('patient_id', '=', $patient_details_information->id)->orderBy('patient_id', 'DESC')->first();

        // dd($case_details);
        // dd($case_details);

        $departments = Department::where('is_active', '1')->get();
        $all_patient = Patient::all();
        $doctor = User::where('role', '=', 'Doctor')->get();
        $nurse = User::where('role', '=', 'Nurse')->get();
        $staff = User::where('role', '=', 'staff')->get();
        $operation_department = Operation::all();
        $operation_catagory = OperationCatagory::all();
        $operation_type = OperationType::all();

        return view('main-operation.operation-booking', compact('patient_details_information', 'departments', 'all_patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department', 'case_details'));
    }

    public function save_operation_booking(Request $request)
    {
        // dd($request->all());

        // try {
        //     DB::beginTransaction();

        $operation_booking = new OperationBooking();
        $operation_booking->operation_date_from               = $request->operation_date_from;
        $operation_booking->operation_date_to                 = $request->operation_date_to;
        $operation_booking->consultant_doctor                 = $request->consultant_doctor;
        $operation_booking->ass_consultant_1                  = $request->ass_consultant_1;
        $operation_booking->ass_consultant_2                  = $request->ass_consultant_2;
        $operation_booking->anesthetist                       = $request->anesthetist;
        $operation_booking->anaethesia_type                   = $request->anaethesia_type;
        $operation_booking->ot_technician                     = $request->ot_technician;
        $operation_booking->ot_assistant                      = $request->ot_assistant;
        $operation_booking->remark                            = $request->remark;
        $operation_booking->generated_by                      = Auth::user()->id;
        $operation_booking->status                             = $request->status;
        $operation_booking->save();

        if ($request->section == 'OPD') {
            $opd_id = $request->section_id;

            $operation_theathers = new OperationTheather();
            $operation_theathers->operation_booking_id               = $operation_booking->id;
            $operation_theathers->case_id                            = $request->case_id;
            $operation_theathers->section                            = $request->section;
            $operation_theathers->opd_id                             = $opd_id;
            $operation_theathers->emg_id                             = '';
            $operation_theathers->ipd_id                             = '';
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id              = $request->operation_category_id;
            $operation_theathers->operation_id                       = $request->operation_id;
            $operation_theathers->operation_type                     = $request->operation_type;
            $operation_theathers->remark                             = $request->remark;
            $operation_theathers->save();
        } else if ($request->section == 'IPD') {
            $ipd_id = $request->section_id;

            $operation_theathers = new OperationTheather();
            $operation_theathers->operation_booking_id               = $operation_booking->id;
            $operation_theathers->case_id                            = $request->case_id;
            $operation_theathers->section                            = $request->section;
            $operation_theathers->opd_id                             = '';
            $operation_theathers->emg_id                             = '';
            $operation_theathers->ipd_id                             = $ipd_id;
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id              = $request->operation_category_id;
            $operation_theathers->operation_id                       = $request->operation_id;
            $operation_theathers->operation_type                     = $request->operation_type;
            $operation_theathers->remark                             = $request->remark;
            $operation_theathers->save();
        } else if ($request->section == 'EMG') {
            $emg_id = $request->section_id;

            $operation_theathers = new OperationTheather();
            $operation_theathers->operation_booking_id               = $operation_booking->id;
            $operation_theathers->case_id                            = $request->case_id;
            $operation_theathers->section                            = $request->section;
            $operation_theathers->opd_id                             = '';
            $operation_theathers->emg_id                             = $emg_id;
            $operation_theathers->ipd_id                             = '';
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id              = $request->operation_category_id;
            $operation_theathers->operation_id                       = $request->operation_id;
            $operation_theathers->operation_type                     = $request->operation_type;
            $operation_theathers->remark                             = $request->remark;
            $operation_theathers->save();
        }

        DB::commit();

        return redirect()->route('main-operation')->with('success', 'Operation Booking Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }

    public function edit_operation_booking_details(Request $request, $id)
    {
        $operation_booking_id = base64_decode($id);
        $operation_booking = OperationBooking::where('id', '=',  $operation_booking_id)->first();

        // dd( $operation_booking );
        $operation_theathers = OperationTheather::where('operation_booking_id', '=',  $operation_booking_id)->first();
        //    dd( $operation_theathers );
        $patient_id = $operation_theathers->patient_id;
        $patient_details_information = Patient::where('id', '=', $patient_id)->first();
        $departments = Department::where('is_active', '1')->get();
        $doctor = User::where('role', '=', 'Doctor')->get();
        $nurse = User::where('role', '=', 'Nurse')->get();
        $staff = User::where('role', '=', 'staff')->get();
        $operation_department = Operation::all();
        $operation_catagory = OperationCatagory::all();
        $operation_type = OperationType::all();
        $all_patient = Patient::all();

        return view('main-operation.edit-operation-booking', compact('operation_booking_id', 'departments', 'all_patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department', 'operation_booking', 'operation_theathers', 'patient_details_information'));
    }

    public function update_operation_booking_details(Request $request)
    {
        // dd($request->all());

        try {
            DB::beginTransaction();

            $operation_booking = OperationBooking::find($request->operation_booking_id);
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
            $operation_booking->status                             = $request->status;
            $operation_booking->save();

            $operation_theathers = OperationTheather::find($request->operation_theater_id);
            $operation_theathers->operation_booking_id               = $operation_booking->id;
            $operation_theathers->case_id                            = $request->case_id;
            $operation_theathers->section                            = $request->section;
            $operation_theathers->opd_id                             = $request->opd_id;
            $operation_theathers->emg_id                             = $request->emg_id;
            $operation_theathers->ipd_id                             = $request->ipd_id;
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id              = $request->operation_category_id;
            $operation_theathers->operation_id                       = $request->operation_id;
            $operation_theathers->operation_type                     = $request->operation_type;
            $operation_theathers->remark                             = $request->remark;
            $operation_theathers->save();
            DB::commit();

            return redirect()->route('main-operation')->with('success', 'Operation Booking Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function delete_operation_booking_details($id)
    {
        $operation_booking_id = base64_decode($id);
        // dd($operation_booking_id);
        $operation_booking = OperationBooking::where('id', $operation_booking_id)->first()->delete();
        $operation_theathers = OperationTheather::where('operation_booking_id', $operation_booking_id)->first()->delete();

        return redirect()->back()->with('success', 'Operation Booking Deleted Sucessfully');
    }
}
