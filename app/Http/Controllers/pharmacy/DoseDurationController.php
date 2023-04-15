<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DoseDuration;
use Illuminate\Http\Request;

class DoseDurationController extends Controller
{

    public function dose_duration_listing()
    {
        $doseDuration = DoseDuration::all();

        return view('setup.pharmacy.dose-duration.dose-duration-listing', compact('doseDuration'));
    }

    public function save_dose_duration(Request $request)
    {
        $request->validate([
            'dose_duration' => 'required',
        ]);

        $status = DoseDuration::Insert([
            'dose_duration' => $request->dose_duration,
        ]);

        if ($status) {
            return back()->with('success', "Duration Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_dose_duration($id)
    {
        $doseDuration = DoseDuration::all();
        $editDoseDuration = DoseDuration::where('id', $id)->first();

        return view('setup.pharmacy.dose-duration.edit-dose-duration', compact('doseDuration', 'editDoseDuration'));
    }

    public function update_dose_duration(Request $request)
    {
        $request->validate([
            'dose_duration' => 'required',
        ]);

        $doseDuration = DoseDuration::find($request->id);
        $doseDuration->dose_duration = $request->dose_duration;
        $status = $doseDuration->save();

        if ($status) {
            return redirect()->route('dose-duration-details')->with('success', "Duration Updated Successfully");
        } else {
            return redirect()->route('dose-duration-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_dose_duration($id)
    {
        DoseDuration::find($id)->delete();

        return back()->with('success', "Duration Deleted Successfully");
    }
}
