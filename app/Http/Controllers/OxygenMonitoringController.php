<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OxygenMonitoring;
use Illuminate\Http\Request;

class OxygenMonitoringController extends Controller
{
    public function save_oxygen_monitoring_details(Request $request)
    {
        // dd($request['ipd_id']);
        $oxygen = new OxygenMonitoring;
        $oxygen->ipd_id      = $request->ipdID;
        $oxygen->oxygen_time = $request->otwotime_value;
        $status = $oxygen->save();

        if ($status) {
            return back()->with('success', " Oxygen Monitoring Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
}
