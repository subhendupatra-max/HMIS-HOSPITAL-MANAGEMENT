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
        return view('referral.referral-listing');
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
            'phone_no'               => 'required|numeric',
            'standard_commission'    => 'required',
        ]);

        $model = Module::get();

        $referral = new Referral();
        $referral->referral_name        = $request->referral_name;
        $referral->phone_no             = $request->phone_no;
        $referral->standard_commission  = $request->standard_commission;

        $status = $referral->save();
        foreach($request->post('ref_commision') as $key => $val)
        {
            $module_id = $key+1;
            $referral_commission = new ReferralCommision();
            $referral_commission->referral_id        = $referral->id;
            $referral_commission->module_id          = $module_id;
            $referral_commission->commission         = $val;
            $referral_commission->save();
        }

        if ($status) {
            return redirect()->route('referral')->with('success', 'Referral Person Added Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
}
