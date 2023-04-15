<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmgPayment;

class EmgPaymentController extends Controller
{
    public function payment_listing_in_emg($id)
    {
        $emg_id = base64_decode($id);
        $emgPayment = EmgPayment::all();
        $emgPaymentDetails =  EmgPayment::where('emg_id', $emg_id)->get();

        return view('emg.payment.payment-listing', compact('emgPayment', 'emg_id', 'emgPaymentDetails'));
    }

    public function add_payment_in_emg($id)
    {
        $emg_id = base64_decode($id);
        $emgPaymentDetails =  EmgPayment::where('emg_id', $emg_id)->get();

        return view('emg.payment.add-payment', compact('emg_id', 'emgPaymentDetails'));
    }

    public function save_payment_in_emg(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);

        $emg_payment                             = new EmgPayment();
        $emg_payment->emg_id                     = $request->emg_id;
        $emg_payment->payment_date               = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d h:m:s');
        $emg_payment->amount                     = $request->amount;
        $emg_payment->payment_mode               = $request->payment_mode;
        $emg_payment->note                       = $request->note;
        $status = $emg_payment->save();

        if ($status) {
            return redirect()->route('payment-listing-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Payment Added Succesfully');
        } else {
            return redirect()->route('payment-listing-in-emg', ['id' => base64_encode($request->emg_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_payment_in_emg($id)
    {
        $e_id = base64_decode($id);
        $payment = EmgPayment::all();
        $editEmgPaymentDetails = EmgPayment::where('id', $e_id)->first();

        return view('emg.payment.edit-payment', compact('payment', 'editEmgPaymentDetails'));
    }

    public function update_payment_in_emg(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);

        $emg_payment                             = EmgPayment::find($request->id);
        $emg_payment->emg_id                     = $request->emg_id;
        $emg_payment->payment_date               = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d h:m:s');
        $emg_payment->amount                     = $request->amount;
        $emg_payment->payment_mode               = $request->payment_mode;
        $emg_payment->note                       = $request->note;
        $status = $emg_payment->save();

        if ($status) {
            return redirect()->route('payment-listing-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Payment Updated Succesfully');
        } else {
            return redirect()->route('payment-listing-in-emg', ['id' => base64_encode($request->emg_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function delete_payment_in_emg($id,Request $request)
    {
        $id = base64_decode($id);
        EmgPayment::find($id)->delete();
        return back()->with('success', "Payment Deleted Successfully");
    }
}
