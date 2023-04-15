<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NurseNote;
use Illuminate\Http\Request;

class NurseNoteController extends Controller
{
    public function save_nurse_note_details(Request $request)
    {
        $request->validate([
            'date' => 'required',
        ]);

        $nurseNote                   = new NurseNote();
        $nurseNote->ipd_id           = $request->ipd_id;
        $nurseNote->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $nurseNote->nurse            = $request->nurse;
        $nurseNote->note             = $request->note;
        $nurseNote->comment          = $request->comment;
        $status = $nurseNote->save();

        if ($status) {
            return back()->with('success', " Nurse Note Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
}
