<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkStation;
use App\Models\User;
use App\Models\WorkStationUser;

class WorkStationController extends Controller
{
    public function work_station_details()
    {
        $work_station = WorkStation::get();
        return view('setup.work-station.work-station-listing', compact('work_station'));
    }

    public function save_work_station_details(Request $request)
    {
        $validate = $request->validate([
            'work_station_name' => 'required',
        ]);

        $status = WorkStation::insert([
            'work_station_name' => $request->work_station_name,
        ]);

        if ($status) {
            return back()->with('success', "WorkStation Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_work_station_details($id, Request $request)
    {
        $work_station = WorkStation::get();
        $editWorkStation = WorkStation::find($id);
        return view('setup.work-station.edit-work-station', compact('work_station', 'editWorkStation'));
    }

    public function update_work_station_details(Request $request)
    {
        $validate = $request->validate([
            'work_station_name' => 'required',

        ]);
 
        $work_station = WorkStation::find($request->id);
        $work_station->work_station_name = $request->work_station_name;
        $status = $work_station->save();

        if ($status) {
            return redirect()->route('work-station-details')->with('success', 'WorkStation Edited Sucessfully');
        } else {
            return redirect()->route('work-station-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_work_station_details($id)
    {
        $work_station = WorkStation::where('id',$id)->delete();
        return redirect()->route('work-station-details')->with('success', 'WorkStation Deleted Sucessfully');
    }

    public function work_station_details_user($id)
    {
        $user_list  = User::all();
        $work_details = WorkStation::where('id',$id)->first();
        $work_details_user = WorkStationUser::where('station_id',$id)->get();
        return view('setup.work-station.work-station-details', compact('id','work_details','user_list','work_details_user'));
    }
    public function add_work_station_user(Request $request)
    {
        foreach ($request->staff_id as $key => $value) {
            $WorkStationUser = new WorkStationUser();
            $WorkStationUser->station_id = $request->station_id;
            $WorkStationUser->staff_id = $value;
            $WorkStationUser->save();
        }

        if (true) {
            return redirect()->route('work-station-details-user',['id'=> $request->station_id])->with('success', 'WorkStation User Added Sucessfully');
        } else {
            return redirect()->route('work-station-details-user',['id'=> $request->station_id])->with('error', "Something Went Wrong");
        }
    }
    public function delete_work_station_user($id,$station_id)
    {
        WorkStationUser::where('id',$id)->delete();
        if (true) {
            return redirect()->route('work-station-details-user',['id'=> $station_id])->with('success', 'WorkStation User Deleted Sucessfully');
        } else {
            return redirect()->route('work-station-details-user',['id'=> $station_id])->with('error', "Something Went Wrong");
        }
    }
}
