<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IpdPayment;
use Illuminate\Http\Request;
use App\Models\IpdDetails;
use App\Models\Payment;
use App\Models\Prefix;
use Illuminate\Support\Facades\Auth;

class IpdPaymentController extends Controller
{

    public function ipd_payment_details(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $paymentDetails = Payment::where('ipd_id', $ipdId)->get();
        return view('Ipd.payment.payment-listing', compact('ipd_details', 'paymentDetails'));
    }

    public function add_ipd_payment_details(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();

        return view('Ipd.payment.add-payment', compact('ipd_details'));
    }

    public function save_ipd_payment_details(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);
        $ipd_prefix = Prefix::where('name', 'ipd')->first();

        $ipd_payment                             = new Payment();
        $ipd_payment->patient_id                 = $request->patient_id;
        $ipd_payment->case_id                    = $request->case_id;
        $ipd_payment->ipd_id                     = $request->ipd_id;
        $ipd_payment->section                    = $request->section;
        $ipd_payment->payment_prefix             = $ipd_prefix->prefix;
        $ipd_payment->payment_amount             = $request->amount;
        $ipd_payment->payment_date               = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d h:m:s');
        $ipd_payment->payment_recived_by         = Auth::user()->id;
        $ipd_payment->payment_mode               = $request->payment_mode;
        $ipd_payment->note                       = $request->note;
        $status = $ipd_payment->save();

        if ($status) {

            return redirect()->route('ipd-payment-details', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', "Payment Added Succesfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_ipd_payment_details(Request $request, $ipd_id, $id)
    {
        $ipdId = base64_decode($ipd_id);
        $id = base64_decode($id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $editPayemnt = Payment::where('id', $id)->first();
        return view('Ipd.payment.edit-payment', compact('ipd_details', 'editPayemnt'));
    }

    public function update_ipd_payment_details(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);
        $ipd_prefix = Prefix::where('name', 'ipd')->first();

        $ipd_payment                             = Payment::find($request->id);
        $ipd_payment->patient_id                 = $request->patient_id;
        $ipd_payment->case_id                    = $request->case_id;
        $ipd_payment->ipd_id                     = $request->ipd_id;
        $ipd_payment->section                    = $request->section;
        $ipd_payment->payment_prefix             = $ipd_prefix->prefix;
        $ipd_payment->payment_amount             = $request->amount;
        $ipd_payment->payment_date               = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d h:m:s');
        $ipd_payment->payment_recived_by         = Auth::user()->id;
        $ipd_payment->payment_mode               = $request->payment_mode;
        $ipd_payment->note                       = $request->note;
        $status = $ipd_payment->save();

        if ($status) {

            return redirect()->route('ipd-payment-details', ['ipd_id' => base64_encode($request->ipd_id)])->with('success', "Payment Updated Succesfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_ipd_payment_details($id)
    {
        $id = base64_decode($id);
        Payment::where('id', $id)->first()->delete();

        return back()->with('success', 'Payment Deleted Sucessfully');
    }
}
