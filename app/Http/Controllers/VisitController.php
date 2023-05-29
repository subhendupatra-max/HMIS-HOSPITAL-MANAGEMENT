<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmgDetails;
use App\Models\OpdDetails;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\User;
use App\Models\Patient;
use App\Models\PhoneCallLog;
use DB;
use \Carbon\Carbon;

class VisitController extends Controller
{
    public function visit_details()
    {
        $visit = Visit::all();

        return view('front-office.visit.visit-details-listing', compact('visit'));
    }

    public function add_visit_details()
    {
        return view('front-office.visit.add-visit-details');
    }

    public function find_staff_by_visitor(Request $request)
    {
        $visitor_type  = $request->visitor;
        $staff = " ";
        $Opd_patient = " ";
        $Emg_patient = " ";
        $Ipd_patient = " ";

        if ($visitor_type == 'Staff') {

            $staff = User::all();
        } else if ($visitor_type == 'OPD Patient') {

            $Opd_patient = DB::table('opd_details')
                ->leftJoin('patients', 'opd_details.patient_id', '=', 'patients.id')
                ->get();
        } else if ($visitor_type == 'Emg Patient') {

            $Emg_patient = DB::table('emg_details')
                ->leftJoin('patients', 'emg_details.patient_id', '=', 'patients.id')
                ->get();
        } else {

            $Ipd_patient = 'ipd';
        }

        return response()->json(['staff' => $staff, 'opd' => $Opd_patient, 'emg' => $Emg_patient, 'ipd' => $Ipd_patient]);
    }

    public function save_visit_details(Request $request)
    {
        $request->validate([
            'purpose'           => 'required',
            'name'              => 'required',
            'phone'             => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/checks/", $filename);
        }


        $visit = new Visit();
        $visit->purpose             = $request->purpose;
        $visit->name                = $request->name;
        $visit->phone               = $request->phone;
        $visit->id_card             = $request->id_card;
        $visit->visit_to            = $request->visit_to;
        $visit->visit_to_name       = $request->visit_to_name;
        $visit->number_of_person    = $request->number_of_person;
        $visit->date                = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $visit->in_time             = $request->in_time;
        $visit->out_time            = $request->out_time;
        $visit->note                = $request->note;
        $visit->attach_document     = $filename;

        $status = $visit->save();

        if ($status) {
            return redirect()->route('all-visit-details')->with('success', " Visitor Added Successfully");
        } else {
            return redirect()->route('all-visit-details')->with('error', " Something Went Wrong");
        }
    }

    public function edit_visit_details($id)
    {
        $visit = Visit::all();
        $editVisit = Visit::where('id', $id)->first();

        return view('front-office.visit.edit-visit-details', compact('visit', 'editVisit'));
    }

    public function update_visit_details(Request $request)
    {
        $request->validate([
            'purpose'           => 'required',
            'name'              => 'required',
            'phone'             => 'required',
        ]);


        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/checks/", $filename);
        }

        $visit = Visit::find($request->id);
        $visit->purpose             = $request->purpose;
        $visit->name                = $request->name;
        $visit->phone               = $request->phone;
        $visit->id_card             = $request->id_card;
        $visit->visit_to            = $request->visit_to;
        $visit->visit_to_name       = $request->visit_to_name;
        $visit->number_of_person    = $request->number_of_person;
        $visit->date                = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $visit->in_time             = $request->in_time;
        $visit->out_time            = $request->out_time;
        $visit->note                = $request->note;
        $visit->attach_document     = $filename;

        $status = $visit->save();

        if ($status) {
            return redirect()->route('all-visit-details')->with('success', "Visitor  Updated Successfully");
        } else {
            return redirect()->route('all-visit-details')->with('error', "Something Went Wrong");
        }
    }
    public function delete_visit_details($id)
    {
        Visit::find($id)->delete();

        return back()->with('success', "Visitor Deleted Successfully");
    }


    //call log 

    public function all_phone_call_log_listing()
    {
        $phoneLog = PhoneCallLog::all();
        return view('front-office.call-log.call-listing', compact('phoneLog'));
    }

    public function add_call_log_details()
    {
        return view('front-office.call-log.add-call');
    }

    public function save_call_log_details(Request $request)
    {
        $request->validate([
            'name'              => 'required',
        ]);

        $call = new PhoneCallLog();
        $call->name                          = $request->name;
        $call->phone                         = $request->phone;
        $call->date                          = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $call->description                   = $request->description;
        $call->next_fllow_up_date            = \Carbon\Carbon::parse($request->next_fllow_up_date)->format('Y-m-d');
        $call->call_duraiton                 = $request->call_duraiton;
        $call->call_type                     = $request->call_type;
        $call->note                          = $request->note;
        $status = $call->save();

        if ($status) {
            return redirect()->route('all-phone-call-log-details')->with('success', " Call Added Successfully");
        } else {
            return redirect()->route('all-phone-call-log-details')->with('error', " Something Went Wrong");
        }
    }

    public function edit_call_log_details($id)
    {
        $editPhoneLog = PhoneCallLog::find($id);
        return view('front-office.call-log.edit-call', compact('editPhoneLog'));
    }

    public function update_call_log_details(Request $request)
    {
        $request->validate([
            'name'              => 'required',
        ]);

        $call = PhoneCallLog::find($request->id);
        $call->name                          = $request->name;
        $call->phone                         = $request->phone;
        $call->date                          = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $call->description                   = $request->description;
        $call->next_fllow_up_date            = \Carbon\Carbon::parse($request->next_fllow_up_date)->format('Y-m-d');
        $call->call_duraiton                 = $request->call_duraiton;
        $call->call_type                     = $request->call_type;
        $call->note                          = $request->note;
        $status = $call->save();

        if ($status) {
            return redirect()->route('all-phone-call-log-details')->with('success', " Call Added Successfully");
        } else {
            return redirect()->route('all-phone-call-log-details')->with('error', " Something Went Wrong");
        }
    }

    public function delete_call_log_details($id)
    {
        PhoneCallLog::find($id)->delete();
        return back()->with('success', "Call Deleted Successfully");
    }
}
