<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\Models\OperationTheatre;
use App\Models\OperationType;
use Illuminate\Http\Request;
use App\Models\IpdDetails;
use App\Models\MedicineCatagory;
use DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Engine\Operands\Operand;

class OperationTheatreController extends Controller
{

    public function show_ipd_operation_details(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $operation_details = OperationTheatre::where('ipd_details_id', $ipdId)->get();
        return view('Ipd.operation.all-operation-listing', compact('ipd_details', 'operation_details'));
    }


    public function add_ipd_operation_details(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $medicine_catagory = MedicineCatagory::all();
        $ipd_details = IpdDetails::where('id', $ipdId)->first();

        return view('Ipd.add-medication-dose', compact('ipd_details', 'medicine_catagory','medicine_catagory'));
    }

    public function save_ipd_operation_details(Request $request)
    {
        $request->validate([
            'ipd_details_id'          => 'required',
            'operation_department'    => 'required',
            'operation_type'          => 'required',
            'operation_name'          => 'required',
            'consultant_doctor'       => 'required',
            'status'                  => 'required',
        ]);

        $operation_theatre                             = new OperationTheatre();
        $operation_theatre->ipd_details_id             = $request->ipd_details_id;
        $operation_theatre->operation_department       = $request->operation_department;
        $operation_theatre->operation_type             = $request->operation_type;
        $operation_theatre->operation_catagory         = $request->operation_catagory;
        $operation_theatre->operation_name             = $request->operation_name;
        $operation_theatre->operation_date             = \Carbon\Carbon::parse($request->operation_date)->format('Y-m-d h:m:s');
        $operation_theatre->consultant_doctor          = $request->consultant_doctor;
        $operation_theatre->ass_consultant_1           = $request->ass_consultant_1;
        $operation_theatre->ass_consultant_2           = $request->ass_consultant_2;
        $operation_theatre->anesthetist                = $request->anesthetist;
        $operation_theatre->anaethesia_type            = $request->anaethesia_type;
        $operation_theatre->medicine_name              = $request->medicine_name;
        $operation_theatre->ot_technician              = $request->ot_technician;
        $operation_theatre->ot_assistant               = $request->ot_assistant;
        $operation_theatre->remark                     = $request->remark;
        $operation_theatre->generated_by               = Auth::user()->id;
        $operation_theatre->status                     = $request->status;
        $status = $operation_theatre->save();

        if ($status) {
            return back()->with('success', "Operation Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function find_operation_type_and_name_by_department(Request $request)
    {
        $operation_catagory =
            DB::table('operations')->Join('operation_catagories', 'operation_catagories.id', '=', 'operations.operation_catagory')->where('operation_department', $request->department_id)->get();

        return response()->json($operation_catagory);
    }

    public function find_operation_name_by_operation_catagory(Request $request)
    {
        $operation_names = Operation::where('operation_catagory', $request->catagory_id)->first();

        return response()->json($operation_names);
    }
}
