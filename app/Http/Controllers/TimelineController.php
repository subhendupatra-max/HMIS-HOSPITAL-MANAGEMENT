<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OpdTimeline;
use App\Models\IpdTimeline;
use Illuminate\Http\Request;
use App\Models\OpdDetails;
use App\Models\EmgTimeline;

class TimelineController extends Controller
{
    //============= timeline for opd ====================
    public function timeline_listing_opd($id)
    {
        //dd($id);
        $opd_id = base64_decode($id);
        $opdTimeline = OpdTimeline::all();
        $opd_patient_details = OpdDetails::where('id',$opd_id)->first();
        $timelineDetails =  OpdTimeline::where('opd_id', $opd_id)->get();
        return view('OPD.timeline.timeline-listing', compact('opdTimeline', 'opd_id', 'timelineDetails','opd_patient_details'));
    }

    public function add_timeline_listing_opd($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id',$opd_id)->first();
        return view('OPD.timeline.add-timeline', compact('opd_id','opd_patient_details'));
    }

    public function save_timeline_listing_opd(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/opd-timeline/", $filename);
        }

        $timeline                   = new OpdTimeline();
        $timeline->opd_id           = $request->opd_id;
        $timeline->title            = $request->title;
        $timeline->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $timeline->description      = $request->description;
        $timeline->attach_document  = $filename;

        $status = $timeline->save();

        if ($status) {
            return redirect()->route('timeline-lisitng-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Timeline Added Succesfully  ');
        } else {
            return redirect()->route('timeline-lisitng-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_timeline_listing_opd($id,$opd_id)
    {
        $id = base64_decode($id);
        $opd_id = base64_decode($opd_id);
        $timeline = OpdTimeline::all();
        $opd_patient_details = OpdDetails::where('id',$opd_id)->first();
        $editTimeline = OpdTimeline::where('id', $id)->first();

        return view('OPD.timeline.edit-timeline', compact('timeline', 'editTimeline','opd_patient_details'));
    }

    public function update_timeline_listing_opd(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/opd-timeline/", $filename);
        }

        $timeline                   = OpdTimeline::find($request->id);
        $timeline->opd_id           = $request->opd_id;
        $timeline->title            = $request->title;
        $timeline->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $timeline->description      = $request->description;
        $timeline->attach_document  = $filename;

        $status = $timeline->save();

        if ($status) {
            return redirect()->route('timeline-lisitng-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Timeline Updated Succesfully ');
        } else {
            return redirect()->route('timeline-lisitng-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function delete_timeline_listing_opd($id)
    {
        $id = base64_decode($id);
        OpdTimeline::find($id)->delete();

        return back()->with('success', "Timeline Deleted Successfully");
    }

    public function find_timeline_details(Request $request)
    {
        $edit_timieline_value =  OpdTimeline::where('opd_id', $request->timelineId)->first();
        return response()->json($edit_timieline_value);
    }

    //============= timeline for opd ====================

    //============= timeline for ipd ====================
    public function save_timeline_listing_ipd(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/ipd-timeline/", $filename);
        }

        $timeline                   = new IpdTimeline();
        $timeline->ipd_id           = $request->ipd_id;
        $timeline->title            = $request->title;
        $timeline->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $timeline->description      = $request->description;
        $timeline->attach_document  = $filename;

        $status = $timeline->save();

        if ($status) {
            return back()->with('success', " Timeline Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
    //============= timeline for ipd ====================

    //============= timeline for emg ====================
    public function timeline_listing_emg($id)
    {
        $emg_id = base64_decode($id);
        $emgTimeline = EmgTimeline::all();
        $timelineDetails =  EmgTimeline::where('emg_id', $emg_id)->get();
        return view('emg.timeline.timeline-listing', compact('emgTimeline', 'emg_id', 'timelineDetails'));
    }

    public function add_timeline_listing_emg($id)
    {
        $emg_id = base64_decode($id);
        return view('emg.timeline.add-timeline', compact('emg_id'));
    }

    public function save_timeline_listing_emg(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/emg-timeline/", $filename);
        }

        $timeline                   = new EmgTimeline();
        $timeline->emg_id           = $request->emg_id;
        $timeline->title            = $request->title;
        $timeline->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $timeline->description      = $request->description;
        $timeline->attach_document  = $filename;

        $status = $timeline->save();

        if ($status) {
            return redirect()->route('timeline-lisitng-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Timeline Added Succesfully  ');
        } else {
            return redirect()->route('timeline-lisitng-in-emg', ['id' => base64_encode($request->emg_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_timeline_listing_emg($id)
    {
        $id = base64_decode($id);
        $timeline = EmgTimeline::all();
        $editTimeline = EmgTimeline::where('id', $id)->first();

        return view('emg.timeline.edit-timeline', compact('timeline', 'editTimeline'));
    }

    public function update_timeline_listing_emg(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/emg-timeline/", $filename);
        }

        $timeline                   = EmgTimeline::find($request->id);
        $timeline->emg_id           = $request->emg_id;
        $timeline->title            = $request->title;
        $timeline->date             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $timeline->description      = $request->description;
        $timeline->attach_document  = $filename;

        $status = $timeline->save();

        if ($status) {
            return redirect()->route('timeline-lisitng-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Timeline Updated Succesfully ');
        } else {
            return redirect()->route('timeline-lisitng-in-emg', ['id' => base64_encode($request->emg_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function delete_timeline_listing_emg($id)
    {
        $id = base64_decode($id);
        EmgTimeline::find($id)->delete();

        return back()->with('success', "Timeline Deleted Successfully");
    }



    //============= timeline for emg ====================
}
