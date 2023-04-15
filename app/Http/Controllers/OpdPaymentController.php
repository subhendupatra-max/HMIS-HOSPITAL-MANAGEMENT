<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpdPayment;
use App\Models\OpdTimeline;

class OpdPaymentController extends Controller
{
    public function payment_listing_in_opd($id)
    {
        $opd_id = base64_decode($id);
        $opdPayment = OpdPayment::all();
        $opdPaymentDetails =  OpdPayment::where('opd_id', $opd_id)->get();

        return view('OPD.payment.payment-listing', compact('opdPayment', 'opd_id', 'opdPaymentDetails'));
    }

    public function add_payment_in_opd($id)
    {
        $opd_id = base64_decode($id);
        $opdPayment = OpdPayment::all();
        $opdPaymentDetails =  OpdPayment::where('opd_id', $opd_id)->get();

        return view('OPD.payment.add-payment', compact('opdPayment', 'opd_id', 'opdPaymentDetails'));
    }

    public function save_payment_in_opd(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);

        $opd_payment                             = new OpdPayment();
        $opd_payment->opd_id                     = $request->opd_id;
        $opd_payment->payment_date               = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d h:m:s');
        $opd_payment->amount                     = $request->amount;
        $opd_payment->payment_mode               = $request->payment_mode;
        $opd_payment->note                       = $request->note;
        $status = $opd_payment->save();

        if ($status) {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Payment Added Succesfully');
        } else {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_payment_in_opd($id)
    {
        $e_id = base64_decode($id);
        $payment = OpdPayment::all();
        $editOpdPaymentDetails = OpdPayment::where('id', $e_id)->first();

        return view('OPD.payment.edit-payment', compact('payment', 'editOpdPaymentDetails'));
    }

    public function update_payment_in_opd(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);

        $opd_payment                             = OpdPayment::find($request->id);
        $opd_payment->opd_id                     = $request->opd_id;
        $opd_payment->payment_date               = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d h:m:s');
        $opd_payment->amount                     = $request->amount;
        $opd_payment->payment_mode               = $request->payment_mode;
        $opd_payment->note                       = $request->note;
        $status = $opd_payment->save();

        if ($status) {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Payment Updated Succesfully');
        } else {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function delete_payment_in_opd($id)
    {
        $id = base64_decode($id);
        OpdPayment::find($id)->delete();

        return back()->with('success', "Payment Deleted Successfully");
    }
}
