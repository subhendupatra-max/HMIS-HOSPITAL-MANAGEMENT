<?php

namespace App\Http\Controllers\front_office;

use App\Http\Controllers\Controller;
use App\Models\front_office\AppointmentProirity;
use Illuminate\Http\Request;

class AppointmentPriorityController extends Controller
{
    public function add_appointment_priority_details()
    {
        $source = AppointmentProirity::all();
        return view('setup.front-office.source.add-source', compact('source'));
    }

    public function save_source_front_office(Request $request)
    {
        $request->validate([
            'source' => 'required',
        ]);

        $source = new AppointmentProirity();
        $source->source = $request->source;
        $source->description = $request->description;
        $status = $source->save();

        if ($status) {
            return back()->with('success', "Source Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_source_in_front_office($id)
    {
        $id = base64_decode($id);
        $source = AppointmentProirity::all();
        $editSource = AppointmentProirity::where('id', $id)->first();

        return view('setup.front-office.source.edit-source', compact('source', 'editSource'));
    }

    public function update_source_front_office(Request $request)
    {
        $request->validate([
            'source' => 'required',
        ]);

        $source = AppointmentProirity::where('id', $request->id)->first();
        $source->source = $request->source;
        $source->description = $request->description;
        $status = $source->save();

        if ($status) {
            return redirect()->route('add-source-in-front-office')->with('success', " Source Updated Successfully");
        } else {
            return redirect()->route('add-source-in-front-office')->with('error', "Something Went Wrong");
        }
    }

    public function delete_source_in_front_office($id)
    {
        $id = base64_decode($id);
        AppointmentProirity::where('id', $id)->first()->delete();

        return back()->with('success', "Source Deleted Successfully");
    }
}
