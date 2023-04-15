<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DoseInterval;
use Illuminate\Http\Request;

class DoseIntervalController extends Controller
{
    public function dose_interval_listing()
    {
        $doseInterval = DoseInterval::all();

        return view('setup.pharmacy.dose-interval.dose-interval-listing', compact('doseInterval'));
    }

    public function save_dose_interval(Request $request)
    {
        $request->validate([
            'dose_interval' => 'required',
        ]);

        $status = DoseInterval::Insert([
            'dose_interval' => $request->dose_interval,
        ]);

        if ($status) {
            return back()->with('success', "Interval Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_dose_interval($id)
    {
        $doseInterval = DoseInterval::all();
        $editDoseInterval = DoseInterval::where('id', $id)->first();

        return view('setup.pharmacy.dose-interval.edit-dose-interval', compact('doseInterval', 'editDoseInterval'));
    }

    public function update_dose_interval(Request $request)
    {
        $request->validate([
            'dose_interval' => 'required',
        ]);

        $doseInterval = DoseInterval::find($request->id);
        $doseInterval->dose_interval = $request->dose_interval;
        $status = $doseInterval->save();

        if ($status) {
            return redirect()->route('dose-interval-details')->with('success', "Interval Updated Successfully");
        } else {
            return redirect()->route('dose-interval-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_dose_interval($id)
    {
        DoseInterval::find($id)->delete();

        return back()->with('success', "Interval Deleted Successfully");
    }
}
