<?php

namespace App\Http\Controllers\shift;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shift\Shift;
use \Carbon\Carbon;

class ShiftController extends Controller
{
    public function shift_details()
    {
        $shift = Shift::all(); 
       
        return view('setup.appointment.shift.shift-listing', compact('shift'));
    }

    public function save_shift_details(Request $request)
    {
        $validate = $request->validate([
            'name'      => 'required',
            'from_time' => 'required',
            'from_to'   => 'required',
            
        ]);

        $status = Shift::insert([
            'name' => $request->name,
            'from_time' =>Carbon::parse($request->input('from_time')),
            'from_to' =>Carbon::parse($request->input('from_to')),
        ]);
        
        if ($status) {
            return back()->with('success', "Shift Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_shift_details($id, Request $request)
    {
        $shift = Shift::all();
        $editShift = Shift::find($id);
      
        return view('setup.appointment.shift.edit-shift', compact('shift', 'editShift'));
    }

    public function update_shift_details(Request $request)
    {
        $validate = $request->validate([
            'name'      => 'required',
            'from_time' => 'required',
            'from_to'   => 'required',
        ]);

        $shift = Shift::find($request->id);
        $shift->name            = $request->name;
        $shift->from_time       = Carbon::parse($request->input('from_time'));
        $shift->from_to         = Carbon::parse($request->input('from_to'));
      
        $status = $shift->save();

        if ($status) {
            return redirect()->route('shift-details')->with('success', 'Shift Updated Sucessfully');
        } else {
            return redirect()->route('shift-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_shift_details($id)
    {
        Shift::where('id',$id)->delete();

        return redirect()->route('shift-details')->with('success', 'Shift Deleted Sucessfully');
    }
}
