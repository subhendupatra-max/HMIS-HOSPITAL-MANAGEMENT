<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OxygenMonitoring;
use Illuminate\Http\Request;
use App\Models\IpdDetails;

class OxygenMonitoringController extends Controller
{

    public function add_oxygen_monitoring_details(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $oxygen_monitering = OxygenMonitoring::where('ipd_id', $ipdId)->get();
        $oxygen_monitering_last = OxygenMonitoring::where('ipd_id', $ipdId)->orderBy('id','DESC')->first();
        //dd($oxygen_monitering_last);
        return view('Ipd.add-oxygen-monitoring', compact('ipd_details', 'oxygen_monitering','ipdId','oxygen_monitering_last'));
    }

    public function save_oxygen_monitoring_details(Request $request)
    {
        // dd($request['ipd_id']);
        $oxygen = new OxygenMonitoring;
        $oxygen->ipd_id      = $request->ipd_id;
        $oxygen->start_time = $request->start_time;
        $status = $oxygen->save();

        if ($status) {
            return back()->with('success', " Oxygen started !! ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
    public function save_end_oxygen_monitoring_details(Request $request)
    {
        // dd($request['ipd_id']);
        $date1 = strtotime($request->start_time);
        $date2 = strtotime($request->end_time);
        $secondsDiff = $date2 - $date1;

        $oxygen = OxygenMonitoring::find($request->id);
        $oxygen->ipd_id      = $request->ipd_id;
        $oxygen->end_time = $request->end_time;
        $oxygen->duration = $secondsDiff;
        $status = $oxygen->save();

        if ($status) {
            return back()->with('success', " Oxygen started !! ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_oxygen_monitoring($id)
    {
        $id = base64_decode($id);
        OxygenMonitoring::where('id', $id)->first()->delete();
        // return view('done');
        return back()->with('success', " Oxygen Monitoring Deleted Succesfully ");
        // return redirect()->route('add-oxygen-monitoring-details')->with('success', 'Oxygen Monitoring Deleted Succesfully');
    }
}
