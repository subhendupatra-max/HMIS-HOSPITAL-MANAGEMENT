<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PatientPhysicalDetails;
use Illuminate\Http\Request;
use App\Models\OpdDetails;
use App\Models\EmgDetails;
use App\Models\IpdDetails;
use App\Models\OpdPatientPhysicalDetail;
use App\Models\EmgPatientPhysicalDetail;
use App\Models\IpdPatientPhysicalDetail;


class PhysicalConditionController extends Controller
{
    //for opd
    public function physical_condition_listing_in_opd($id)
    {
        $opd_id = base64_decode($id);
        $OpdPatientPhysicalDetails  = OpdPatientPhysicalDetail::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $PhysicalDetails  =  OpdPatientPhysicalDetail::where('opd_id', $opd_id)->get();
        return view('OPD.physical-condition.physical-condition-listing', compact('OpdPatientPhysicalDetails', 'opd_id', 'PhysicalDetails', 'opd_patient_details'));
    }

    public function add_physical_condition_opd($id)
    {
        $opd_id = base64_decode($id);
        $OpdPatientPhysicalDetails = OpdPatientPhysicalDetail::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $PhysicalDetails =  OpdPatientPhysicalDetail::where('opd_id', $opd_id)->get();

        return view('OPD.physical-condition.add-physical-condition', compact('OpdPatientPhysicalDetails', 'opd_id', 'PhysicalDetails', 'opd_patient_details'));
    }


    public function save_physical_condition_opd(Request $request)
    {
        $request->validate([
            'height'          => 'required',
        ]);

        $opd_details                             = new OpdPatientPhysicalDetail();
        $opd_details->opd_id                     = $request->opd_id;
        $opd_details->height                     = $request->height;
        $opd_details->weight                     = $request->weight;
        $opd_details->pulse                      = $request->pulse;
        $opd_details->bp                         = $request->bp;
        $opd_details->temperature                = $request->temperature;
        $opd_details->respiration                = $request->respiration;
        $status = $opd_details->save();

        if ($status) {
            return redirect()->route('physical-condition-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Physical Details Added Succesfully');
        } else {
            return redirect()->route('physical-condition-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_physical_condition_opd($id, $opd_id)
    {
        $opd_id = base64_decode($opd_id);
        $e_id = base64_decode($id);
        $PhysicalDetails = OpdPatientPhysicalDetail::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $editOpdPhysicalDetails = OpdPatientPhysicalDetail::where('id', $e_id)->first();

        return view('OPD.physical-condition.edit-physical-condition', compact('PhysicalDetails', 'editOpdPhysicalDetails', 'opd_patient_details'));
    }

    public function update_physical_condition_opd(Request $request)
    {
        $request->validate([
            'height'          => 'required',
        ]);

        $opd_details                              = OpdPatientPhysicalDetail::find($request->id);
        $opd_details->opd_id                     = $request->opd_id;
        $opd_details->height                     = $request->height;
        $opd_details->weight                     = $request->weight;
        $opd_details->pulse                      = $request->pulse;
        $opd_details->bp                         = $request->bp;
        $opd_details->temperature                = $request->temperature;
        $opd_details->respiration                = $request->respiration;
        $status = $opd_details->save();

        if ($status) {
            return redirect()->route('physical-condition-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Physical Details Updated Succesfully');
        } else {
            return redirect()->route('physical-condition-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }


    public function delete_physical_condition_opd($id)
    {
        $id = base64_decode($id);
        OpdPatientPhysicalDetail::find($id)->delete();

        return back()->with('success', "Payment Deleted Successfully");
    }
    //end for opd

    //for emg
    public function physical_condition_listing_in_emg($id)
    {
        // dd($id);
        $emg_id = base64_decode($id);
        $EmgPatientPhysicalDetails  = EmgPatientPhysicalDetail::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $PhysicalDetails  =  EmgPatientPhysicalDetail::where('emg_id', $emg_id)->get();
        return view('emg.physical-condition.emg-physical-condition-listing', compact('EmgPatientPhysicalDetails', 'emg_id', 'PhysicalDetails', 'emg_patient_details'));
    }

    public function add_physical_condition_emg($id)
    {
        $emg_id = base64_decode($id);
        $EmgPatientPhysicalDetails = EmgPatientPhysicalDetail::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $PhysicalDetails =  EmgPatientPhysicalDetail::where('emg_id', $emg_id)->get();

        return view('emg.physical-condition.add-physical-condition-emg', compact('EmgPatientPhysicalDetails', 'emg_id', 'PhysicalDetails', 'emg_patient_details'));
    }


    public function save_physical_condition_emg(Request $request)
    {
        $request->validate([
            'height'          => 'required',
        ]);

        $emg_details                             = new EmgPatientPhysicalDetail();
        $emg_details->emg_id                     = $request->emg_id;
        $emg_details->height                     = $request->height;
        $emg_details->weight                     = $request->weight;
        $emg_details->pulse                      = $request->pulse;
        $emg_details->bp                         = $request->bp;
        $emg_details->temperature                = $request->temperature;
        $emg_details->respiration                = $request->respiration;
        $status = $emg_details->save();

        if ($status) {
            return redirect()->route('physical-condition-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Physical Details Added Succesfully');
        } else {
            return redirect()->route('physical-condition-in-emg', ['id' => base64_encode($request->emg_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_physical_condition_emg($id, $emg_id)
    {
        $emg_id = base64_decode($emg_id);
        $e_id = base64_decode($id);
        $PhysicalDetails = EmgPatientPhysicalDetail::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $editEmgPhysicalDetails = EmgPatientPhysicalDetail::where('id', $e_id)->first();

        return view('emg.physical-condition.edit-physical-condition-emg', compact('PhysicalDetails', 'editEmgPhysicalDetails', 'emg_patient_details'));
    }

    public function update_physical_condition_emg(Request $request)
    {
        $request->validate([
            'height'          => 'required',
        ]);

        $emg_details                             = EmgPatientPhysicalDetail::find($request->id);
        $emg_details->emg_id                     = $request->emg_id;
        $emg_details->height                     = $request->height;
        $emg_details->weight                     = $request->weight;
        $emg_details->pulse                      = $request->pulse;
        $emg_details->bp                         = $request->bp;
        $emg_details->temperature                = $request->temperature;
        $emg_details->respiration                = $request->respiration;
        $status = $emg_details->save();

        if ($status) {
            return redirect()->route('physical-condition-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Physical Details Updated Succesfully');
        } else {
            return redirect()->route('physical-condition-in-emg', ['id' => base64_encode($request->emg_id)])->with('error', 'Something Went Wrong');
        }
    }


    public function delete_physical_condition_emg($id)
    {
        $id = base64_decode($id);
        EmgPatientPhysicalDetail::find($id)->delete();

        return back()->with('success', "Payment Deleted Successfully");
    }
    //for emg

    //for ipd
    public function physical_condition_listing_in_ipd($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $IpdPatientPhysicalDetails  = IpdPatientPhysicalDetail::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $PhysicalDetails  =  IpdPatientPhysicalDetail::where('ipd_id', $ipd_id)->get();
        return view('Ipd.physical-condition.physical-condition-listing', compact('IpdPatientPhysicalDetails', 'ipd_id', 'PhysicalDetails', 'ipd_details', 'ipd_patient_details'));
    }

    public function add_physical_condition_ipd($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $IpdPatientPhysicalDetails = IpdPatientPhysicalDetail::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $PhysicalDetails =  IpdPatientPhysicalDetail::where('ipd_id', $ipd_id)->get();

        return view('Ipd.physical-condition.add-physical-condition', compact('IpdPatientPhysicalDetails', 'ipd_id', 'PhysicalDetails', 'ipd_details', 'ipd_patient_details'));
    }

    public function save_physical_condition_ipd(Request $request)
    {
        $request->validate([
            'height'          => 'required',
        ]);

        $ipd_details                             = new IpdPatientPhysicalDetail();
        $ipd_details->ipd_id                     = $request->ipd_id;
        $ipd_details->height                     = $request->height;
        $ipd_details->weight                     = $request->weight;
        $ipd_details->pulse                      = $request->pulse;
        $ipd_details->bp                         = $request->bp;
        $ipd_details->temperature                = $request->temperature;
        $ipd_details->respiration                = $request->respiration;
        $status = $ipd_details->save();

        if ($status) {
            return redirect()->route('physical-condition-in-ipd', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', 'Physical Details Added Succesfully');
        } else {
            return redirect()->route('physical-condition-in-ipd', ['ipd_id' => base64_encode($request->ipd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_physical_condition_ipd($id, $ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $e_id = base64_decode($id);
        $PhysicalDetails = IpdPatientPhysicalDetail::all();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $editIpdPhysicalDetails = IpdPatientPhysicalDetail::where('id', $e_id)->first();

        return view('Ipd.physical-condition.edit-physical-condition', compact('PhysicalDetails', 'editIpdPhysicalDetails', 'ipd_patient_details', 'ipd_details'));
    }

    public function update_physical_condition_ipd(Request $request)
    {
        $request->validate([
            'height'          => 'required',
        ]);

        $ipd_details                             = IpdPatientPhysicalDetail::find($request->id);
        $ipd_details->ipd_id                     = $request->ipd_id;
        $ipd_details->height                     = $request->height;
        $ipd_details->weight                     = $request->weight;
        $ipd_details->pulse                      = $request->pulse;
        $ipd_details->bp                         = $request->bp;
        $ipd_details->temperature                = $request->temperature;
        $ipd_details->respiration                = $request->respiration;
        $status = $ipd_details->save();

        if ($status) {
            return redirect()->route('physical-condition-in-ipd', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', 'Physical Details Updated Succesfully');
        } else {
            return redirect()->route('physical-condition-in-ipd', ['ipd_id' => base64_encode($request->ipd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function delete_physical_condition_ipd($id)
    {
        $id = base64_decode($id);
        IpdPatientPhysicalDetail::find($id)->delete();

        return back()->with('success', "Physical Condition Deleted Successfully");
    }
    //end for ipd
}
