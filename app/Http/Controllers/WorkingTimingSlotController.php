<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkingSlot;
use DateTime;

class WorkingTimingSlotController extends Controller
{
    public function work_timing_slot()
    {
        $working_time_slot_list = WorkingSlot::get();
        return view('setup.working-slot.working-slot-listing', compact('working_time_slot_list'));
    }

    public function save_working_slot_details(Request $request)
    {
        $validate = $request->validate([
            'working_slot_name' => 'required',
            'color' => 'required',
        ]);
        
        $start = new DateTime($request->from_time);
        $end = new DateTime($request->to_time);
        $interval = $start->diff($end);
        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');
        $totalHours = $hours + ($minutes / 60);
        $total_working_hr = $totalHours;

        $status = WorkingSlot::insert([
            'working_slot_name' => $request->working_slot_name,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'total_working_hr' => $total_working_hr,
            'color' => $request->color,
        ]);

        if ($status) {
            return back()->with('success', "Working Time Slot Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_working_slot_details($id, Request $request)
    {
        $WorkingSlot = WorkingSlot::find($id);
        $working_time_slot_list = WorkingSlot::get();
        return view('setup.working-slot.working-slot-edit', compact('WorkingSlot','working_time_slot_list'));
    }

    public function update_working_slot_details(Request $request)
    {
        $validate = $request->validate([
            'working_slot_name' => 'required',
            'color' => 'required',
        ]);
        
        $start = new DateTime($request->from_time);
        $end = new DateTime($request->to_time);
        $interval = $start->diff($end);
        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');
        $totalHours = $hours + ($minutes / 60);
        $total_working_hr = $totalHours;

        $status = WorkingSlot::where('id',$request->working_slot_id)->update([
            'working_slot_name' => $request->working_slot_name,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'total_working_hr' => $total_working_hr,
            'color' => $request->color,
        ]);

        if ($status) {
            return redirect()->route('work-timing-slot')->with('success', 'Working Time Slot Edited Sucessfully');
        } else {
            return redirect()->route('work-timing-slot')->with('error', "Something Went Wrong");
        }
    }

    public function delete_working_slot_details($id)
    {
        WorkingSlot::where('id',$id)->delete();
        return redirect()->route('work-timing-slot')->with('success', 'Working Time Slot Deleted Sucessfully');
    }
}
