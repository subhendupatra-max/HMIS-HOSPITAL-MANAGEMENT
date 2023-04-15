<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientBedHistory;
use App\Models\Bed;
use App\Models\IpdDetails;
use Illuminate\Http\Request;

class BedTransfarController extends Controller
{
    public function save_bed_transfar_history(Request $request)
    {
        $request->validate([
            'department'    => 'required',
            'ward'          => 'required',
            'unit'          => 'required',
            'bed'           => 'required',
            'from_time'     => 'required',

        ]);

        //pervious bed status update in bed table
        Bed::where('id', $request->previous_bed_id)->update(['is_used' => 'no']);
        //pervious bed status update in bed table

        //new bed status update in bed table
        Bed::where('id', $request->bed)->update(['is_used' => 'yes']);
        //new bed status update in bed table

        // changed bed status in ipd details
        $ipd_details = IpdDetails::where('id',$request->ipd_id)->first();
        $ipd_details->department_id   = $request->department ;
        $ipd_details->bed             = $request->bed ;
        $ipd_details->bed_ward_id     = $request->ward ;
        $ipd_details->bed_unit_id     = $request->unit ;
        $ipd_details->update();

        $p_histry_details_id = PatientBedHistory::where('patient_id',$request->patient_id)->where('case_id',$request->case_id)->where('ipd_id',$request->ipd_id)->latest()->first();
      
        $p_histry_details_id->to_date = \Carbon\Carbon::parse($request->from_time)->format('Y-m-d h:m:s');
        $p_histry_details_id->is_present = 'no';
        $p_histry_details_id->save();
        
        $bedHistory                          = new PatientBedHistory();
        $bedHistory->patient_id              = $request->patient_id;
        $bedHistory->case_id                 = $request->case_id;
        $bedHistory->ipd_id                  = $request->ipd_id;
        $bedHistory->department_id           = $request->department;
        $bedHistory->bed_ward_id             = $request->ward;
        $bedHistory->bed_unit_id             = $request->unit;
        $bedHistory->bed_id                  = $request->bed;
        $bedHistory->from_date               = \Carbon\Carbon::parse($request->from_time)->format('Y-m-d h:m:s');
        $status = $bedHistory->save();



        if ($status) {
            return back()->with('success', " Bed History Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function find_bed_history_details_ipd(Request $request)
    {
        $edit_bed_history_details =  PatientBedHistory::where('ipd_id', $request->bedHistoryId)->first();
        // dd($edit_bed_history_details);
        return response()->json($edit_bed_history_details);
    }
}
