<?php

namespace App\Http\Controllers\ambulance;

use App\Http\Controllers\Controller;
use App\Models\AmbulanceCall;
use App\Models\ChargesCatagory;
use Illuminate\Http\Request;
use App\Models\Ambulance;

class AmbulanceController extends Controller
{
    // add ambulance

    public function ambulance_details()
    {
        $ambulance = Ambulance::all();
        return view('ambulance.ambulance.ambulance-lisitng', compact('ambulance'));
    }

    public function add_ambulance_details()
    {
        return view('ambulance.ambulance.add-ambulance');
    }

    public function save_ambulance_details(Request $request)
    {
        $validate = $request->validate([
            'vehicle_number'                => 'required',
        ]);

        $status = Ambulance::insert([
            'vehicle_number'            => $request->vehicle_number,
            'vehicle_model'             => $request->vehicle_model,
            'year_made'                 => $request->year_made,
            'driver_name'               => $request->driver_name,
            'driver_license'            => $request->driver_license,
            'vehicle_type'              => $request->vehicle_type,
            'note'                      => $request->note,
        ]);


        if ($status) {
            return redirect()->route('ambulance-details')->with('success', 'Ambulance Added Sucessfully');
        } else {
            return redirect()->route('ambulance-details')->with('error', "Something Went Wrong");
        }
    }

    public function edit_ambulance_details($id)
    {
        $ambulance = Ambulance::where('id', $id)->first();
        return view('ambulance.ambulance.edit-ambulance', compact('ambulance'));
    }

    public function update_ambulance_details(Request $request)
    {
        $validate = $request->validate([
            'vehicle_number'                => 'required',

        ]);

        $slots = Ambulance::find($request->id);
        $slots->vehicle_number           = $request->vehicle_number;
        $slots->vehicle_model            = $request->vehicle_model;
        $slots->year_made                = $request->year_made;
        $slots->driver_name              = $request->driver_name;
        $slots->driver_license           = $request->driver_license;
        $slots->vehicle_type             = $request->vehicle_type;
        $slots->note                     = $request->note;
        $status = $slots->save();



        if ($status) {
            return redirect()->route('ambulance-details')->with('success', 'Ambulance Added Sucessfully');
        } else {
            return redirect()->route('ambulance-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_ambulance_details($id)
    {
         Ambulance::find($id)->delete();
        return redirect()->route('ambulance-details')->with('success', 'Ambulance Deleted Sucessfully');
    }

    //ambulance call
    public function ambulance_call_details()
    {
        $ambulanceCall = AmbulanceCall::all();
        return view('ambulance.ambulance-call.ambulance-call-listing', compact('ambulanceCall'));
    }

    public function add_ambulance_call_details()
    {
        $ambulance = Ambulance::all();
        return view('ambulance.ambulance-call.add-ambulance-call', compact('ambulance'));
    }

    public function find_driver_name_by_vehical_model(Request $request)
    {
        $find_driver = Ambulance::where('id', '=', $request->driver_id)->first();
        return response()->json($find_driver);
    }

    public function save_ambulance_call_details(Request $request)
    {

        $validate = $request->validate([
            'vehicle_model'                => 'required',
            'driver_name'                  => 'required',
            'start_date_and_time'              => 'required',
            'place'                  => 'required',
            'purpose'                  => 'required', 
        ]);

        $ambulance = new AmbulanceCall();
        $ambulance->vehicle_model           = $request->vehicle_model;
        $ambulance->driver_name             = $request->driver_name;
        $ambulance->start_date_and_time             = $request->start_date_and_time;
        $ambulance->return_date_and_time             = $request->return_date_and_time;
        $ambulance->place             = $request->place;
        $ambulance->purpose             = $request->purpose;
        $ambulance->note             = $request->note;
        $status =  $ambulance->save();

        if($request->return_date_and_time == '' || $request->return_date_and_time == null){
            Ambulance::where('id', '=', $request->vehicle_model)->update(['status'=>'Unavailable']);
        }
        else{
            Ambulance::where('id', '=', $request->vehicle_model)->update(['status'=>'Available']); 
        }


        if ($status) {
            return redirect()->route('ambulance-call-details')->with('success', 'Ambulance Call Added Sucessfully');
        } else {
            return redirect()->route('ambulance-call-details')->with('error', "Something Went Wrong");
        }
    }
    public function update_ambulance_call_details(Request $request)
    {
        $validate = $request->validate([
            'vehicle_model'                => 'required',
            'driver_name'                  => 'required',
            'start_date_and_time'              => 'required',
            'place'                  => 'required',
            'purpose'                  => 'required', 
        ]);

        $ambulance =  AmbulanceCall::find($id);
        $ambulance->vehicle_model           = $request->vehicle_model;
        $ambulance->driver_name             = $request->driver_name;
        $ambulance->start_date_and_time             = $request->start_date_and_time;
        $ambulance->return_date_and_time             = $request->return_date_and_time;
        $ambulance->place             = $request->place;
        $ambulance->purpose             = $request->purpose;
        $ambulance->note             = $request->note;
        $status =  $ambulance->save();

        if($request->return_date_and_time == '' || $request->return_date_and_time == null){
            Ambulance::where('id', '=', $request->vehicle_model)->update(['status'=>'Unavailable']);
        }
        else{
            Ambulance::where('id', '=', $request->vehicle_model)->update(['status'=>'Available']); 
        }


        if ($status) {
            return redirect()->route('ambulance-call-details')->with('success', 'Ambulance Call Update Sucessfully');
        } else {
            return redirect()->route('ambulance-call-details')->with('error', "Something Went Wrong");
        }
    }

    public function edit_ambulance_call_details($id, Request $request)
    {
        $catagory  = ChargesCatagory::all();
        $editAmbulanceCall = AmbulanceCall::where('id' , $id)->first();
        $ambulance = Ambulance::all();
        return view('ambulance.ambulance-call.edit-ambulance-call',compact('editAmbulanceCall','catagory' , 'ambulance'));
    }

    public function delete_ambulance_call_details($id)
    {
        AmbulanceCall::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
 
}
