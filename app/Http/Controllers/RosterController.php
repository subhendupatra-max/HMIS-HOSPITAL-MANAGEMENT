<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkStation;
use App\Models\WorkStationUser;
use App\Models\WorkingSlot;
use DateTime;
use DateInterval;
use DatePeriod;

class RosterController extends Controller
{
    public function roster()
    {
        $work_station = WorkStation::get();
        return view('roster.choose_work_station',compact('work_station'));
    }
    public function create_roster(Request $request)
    {
        $work_station_id = $request->work_station_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $date1 = new DateTime($from_date);
        $date2 = new DateTime($to_date);

        $start = $date1;
        $end = $date2;
        $interval = new DateInterval('P1D'); // 1 day interval

        $daterange = [];
        $daterange_y_m_d = [];
        while ($start <= $end) {
            $daterange[] = $start->format('Y-m-d');
            $start->add($interval);
        }
        $staffDetails = WorkStationUser::where('station_id',$work_station_id)->get();
        $working_slot_Details = WorkingSlot::get();

        return view('roster.create-roster',compact('working_slot_Details','daterange_y_m_d','daterange','to_date','from_date','work_station_id','staffDetails'));
    }
}
