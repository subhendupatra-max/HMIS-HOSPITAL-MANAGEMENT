<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\Module;
use App\Models\ReferralCommision;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $refferal_person = Referral::all();
        return view('referral.referral-listing',compact('refferal_person'));
    }

    public function add_referral()
    {
        $model = Module::get();
        return view('referral.add-referral', compact('model'));
    }

    public function save_referral(Request $request)
    {
        
        $request->validate([
            'referral_name'          => 'required',
            'phone_no'               => 'required',
            'standard_commission'    => 'required',
        ]);

        $referral = new Referral();
        $referral->referral_name        = $request->referral_name;
        $referral->phone_no             = $request->phone_no;
        $referral->address             = $request->address;
        $referral->standard_commission  = $request->standard_commission;
        $referral->opd_commission  = $request->opd_commission;
        $referral->emg_commission  = $request->emg_commission;
        $referral->ipd_commission  = $request->ipd_commission;
        $referral->pharmacy_commission  = $request->pharmacy_commission;
        $referral->pathology_commission  = $request->pathology_commission;
        $referral->radiology_commission  = $request->radiology_commission;
        $referral->blood_bank_commission  = $request->blood_bank_commission;
        $referral->ambulance_commission  = $request->ambulance_commission;
        $status = $referral->save();

        if ($status) {
            return redirect()->route('referral')->with('success', 'Referral Person Added Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_referral($id){
        $ref_id  =  base64_decode($id);
        $referral = Referral::find($ref_id);
        $referral->delete();
        if (true) {
            return redirect()->route('referral')->with('success', 'Referral Person Deleted Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_referral($id)
    {
        $ref_id  =  base64_decode($id);
        $referral = Referral::find($ref_id);
        return view('referral.edit-referral', compact('referral'));
    }
    public function update_referral(Request $request){
        $request->validate([
            'referral_name'          => 'required',
            'phone_no'               => 'required',
            'standard_commission'    => 'required',
        ]);

        $referral = Referral::find($request->refferal_id);
        $referral->referral_name        = $request->referral_name;
        $referral->phone_no             = $request->phone_no;
        $referral->address             = $request->address;
        $referral->standard_commission  = $request->standard_commission;
        $referral->opd_commission  = $request->opd_commission;
        $referral->emg_commission  = $request->emg_commission;
        $referral->ipd_commission  = $request->ipd_commission;
        $referral->pharmacy_commission  = $request->pharmacy_commission;
        $referral->pathology_commission  = $request->pathology_commission;
        $referral->radiology_commission  = $request->radiology_commission;
        $referral->blood_bank_commission  = $request->blood_bank_commission;
        $referral->ambulance_commission  = $request->ambulance_commission;
        $status = $referral->save();

        if ($status) {
            return redirect()->route('referral')->with('success', 'Referral Person Update Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
}
