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
            'Driver Name'                   => 'required',
            'year_made'                     => 'required',
            'driver_name'                   => 'required',
            'driver_license'                => 'required',
            'vehicle_type'                  => 'required',
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
            'vehicle_model'                 => 'required',
            'year_made'                     => 'required',
            'driver_name'                   => 'required',
            'driver_license'                => 'required',
            'vehicle_type'                  => 'required',
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
        return view('ambulance.ambulance.ambulance-listing');
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
        $catagory  = ChargesCatagory::all();
        return view('ambulance.ambulance-call.add-ambulance-call', compact('ambulance', 'catagory'));
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
            'charge_category'              => 'required',
            'charge_sub_category'          => 'required',
            'charge_name'                  => 'required',
            'standard_charges'             => 'required',
            'tax'                          => 'required',
            'total_amount'                 => 'required',
            'net_amount'                   => 'required',
            'payment_mode'                 => 'required',
            'payment_amount'               => 'required',
        ]);
        $filename = '';
        if ($request->hasfile('cheque_document')) {
            $file = $request->file('cheque_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/visitor/", $filename);
        }

        $ambulance = new AmbulanceCall();
        $ambulance->vehicle_model           = $request->vehicle_model;
        $ambulance->driver_name             = $request->driver_name;
        $ambulance->date                    = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $ambulance->charge_category         = $request->charge_category;
        $ambulance->charge_sub_category     = $request->charge_sub_category;
        $ambulance->charge_name             = $request->charge_name;
        $ambulance->standard_charges        = $request->standard_charges;
        $ambulance->tax                     = $request->tax;
        $ambulance->total_amount            = $request->total_amount;
        $ambulance->net_amount              = $request->net_amount;
        $ambulance->payment_mode            = $request->payment_mode;
        $ambulance->payment_amount          = $request->payment_amount;
        $ambulance->cheque_date             = \Carbon\Carbon::parse($request->cheque_date)->format('Y-m-d');
        $ambulance->note                    = $request->note;
        $ambulance->cheque_document         = $filename;
        $status =  $ambulance->save();

        if ($status) {
            return redirect()->route('ambulance-call-details')->with('success', 'Ambulance Call Added Sucessfully');
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
