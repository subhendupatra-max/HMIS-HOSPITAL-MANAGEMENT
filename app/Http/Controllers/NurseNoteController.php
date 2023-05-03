<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NurseNote;
use App\Models\IpdDetails;
use Illuminate\Http\Request;
use App\Models\User;

class NurseNoteController extends Controller
{

    public function ipd_nurse_note_details(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $nurseNoteDetails = NurseNote::where('ipd_id', $ipdId)->get();
        return view('Ipd.nurse-note.nurse-note-listing', compact('ipd_details', 'nurseNoteDetails'));
    }

    public function add_nurse_note_details(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $nurseName = User::where('role', 'Nurse')->get();

        return view('Ipd.nurse-note.add-nurse-note', compact('ipd_details', 'nurseName'));
    }

    public function save_nurse_note_details(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'note' => 'required',
        ]);

        $nurseNote                   = new NurseNote();
        $nurseNote->ipd_id           = $request->ipd_id;
        $nurseNote->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $nurseNote->nurse            = $request->nurse;
        $nurseNote->note             = $request->note;
        $nurseNote->comment          = $request->comment;
        $status = $nurseNote->save();

        if ($status) {
            return redirect()->route('ipd-nurse-note-details', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', " Nurse Note Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }


    public function edit_nurse_note_details(Request $request, $ipd_id, $id)
    {
        $ipdId = base64_decode($ipd_id);
        $id = base64_decode($id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $editNurseNote = NurseNote::where('id', $id)->first();
        $nurseName = User::where('role', 'Nurse')->get();
        return view('Ipd.nurse-note.edit-nurse-note', compact('ipd_details', 'editNurseNote','nurseName'));
    }

    public function update_nurse_note_details(Request $request)
    {
        $request->validate([
            'date' => 'required',
        ]);

        $nurseNote                   = NurseNote::find($request->id);
        $nurseNote->ipd_id           = $request->ipd_id;
        $nurseNote->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $nurseNote->nurse            = $request->nurse;
        $nurseNote->note             = $request->note;
        $nurseNote->comment          = $request->comment;
        $status = $nurseNote->save();

        if ($status) {
            return redirect()->route('ipd-nurse-note-details', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', " Nurse Note Updated Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_nurse_note_details($id)
    {
        $id = base64_decode($id);
        NurseNote::where('id', $id)->first()->delete();

        return back()->with('success', 'Nurse Note Deleted Sucessfully');
    }
}
