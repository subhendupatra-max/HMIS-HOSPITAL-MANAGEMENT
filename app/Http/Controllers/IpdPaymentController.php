<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IpdPayment;
use Illuminate\Http\Request;

class IpdPaymentController extends Controller
{
    public function save_ipd_payment_details(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);

        $ipd_payment                             = new IpdPayment();
        $ipd_payment->ipd_id                     = $request->ipd_id;
        $ipd_payment->payment_date               = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d h:m:s');
        $ipd_payment->amount                     = $request->amount;
        $ipd_payment->payment_mode               = $request->payment_mode;
        $ipd_payment->note                       = $request->note;
        $status = $ipd_payment->save();

        if ($status) {
            return back()->with('success', "Payment Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
}
