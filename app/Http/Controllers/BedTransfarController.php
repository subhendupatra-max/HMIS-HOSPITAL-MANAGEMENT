<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientBedHistory;
use App\Models\Bed;
use App\Models\Department;
use App\Models\IpdDetails;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use  App\Models\BedUnit;
use DB;

class BedTransfarController extends Controller
{
    public function bed_history_listing($ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $bedHistory =  PatientBedHistory::where('ipd_id', $ipdId)->get();
        return view('ipd.bed-history.bed-history', compact('bedHistory', 'ipd_details'));
    }

    public function add_bed_transfar_history($ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $departments = Department::all();
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $units = BedUnit::all();
        return view('ipd.bed-history.add-bed-history', compact('ipd_details', 'departments', 'units'));
    }

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
        $ipd_details = IpdDetails::where('id', $request->ipd_id)->first();
        $ipd_details->department_id   = $request->department;
        $ipd_details->bed             = $request->bed;
        $ipd_details->bed_ward_id     = $request->ward;
        $ipd_details->bed_unit_id     = $request->unit;
        $ipd_details->update();

        $p_histry_details_id = PatientBedHistory::where('patient_id', $request->patient_id)->where('case_id', $request->case_id)->where('ipd_id', $request->ipd_id)->latest()->first();

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
            return redirect()->route('bed-transfar-history-in-ipd', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', " Bed History Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function find_bed_history_details_ipd(Request $request)
    {
        $edit_bed_history_details =  PatientBedHistory::where('ipd_id', $request->bedHistoryId)->first();
        return response()->json($edit_bed_history_details);
    }

    public function update_bed_transfar_from_date(Request $request)
    {
        try {
            DB::beginTransaction();
            $PatientBedHistory =  PatientBedHistory::find($request->bed_histry_id);
            $PatientBedHistory->from_date = $request->from_time;
            $PatientBedHistory->save();

            $sec_max = PatientBedHistory::where('ipd_id', $PatientBedHistory->ipd_id)
                ->orderBy('id', 'DESC')
                ->offset(1)
                ->limit(1)
                ->first();

            $sec_max->to_date = $request->from_time;
            $sec_max->save();

            DB::commit();
            return redirect()->back()->with('success', "Bed teansfer date Update Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function bed_transfar_history_print_in_ipd($ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $bedHistory =  PatientBedHistory::where('ipd_id', $ipdId)->get();
        return view('ipd._print.patient_bed_history', compact('bedHistory', 'ipd_details'));
    }
}
