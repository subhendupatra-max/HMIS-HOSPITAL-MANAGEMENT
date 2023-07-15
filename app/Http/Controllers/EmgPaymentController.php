<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmgPayment;
use App\Models\EmgDetails;
use App\Models\AllHeader;
use App\Models\Payment;

class EmgPaymentController extends Controller
{
    public function payment_listing_in_emg($id)
    {
        $emg_id = base64_decode($id);
        $emgPayment = EmgPayment::all();
        $emgPaymentDetails =  EmgPayment::where('emg_id', $emg_id)->get();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();

        return view('emg.payment.payment-listing', compact('emgPayment', 'emg_id', 'emgPaymentDetails', 'emg_patient_details'));
    }

    public function add_payment_in_emg($id)
    {
        $emg_id = base64_decode($id);
        // dd($emg_id);
        // dd( $emg_id );
        $emg_patient_detail =  EmgPayment::where('emg_id', $emg_id)->get();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        // dd( $emg_patient_details );
        return view('emg.payment.add-payment', compact('emg_id', 'emg_patient_details', 'emg_patient_detail'));
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

    public function edit_payment_in_emg($id, $emg_id)
    {
        $e_id = base64_decode($id);
        $emg_id = base64_decode($emg_id);
        $payment = EmgPayment::all();
        $editEmgPaymentDetails = EmgPayment::where('id', $e_id)->first();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();

        return view('emg.payment.edit-payment', compact('payment', 'editEmgPaymentDetails', 'emg_patient_details'));
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

    public function delete_payment_in_emg($id, Request $request)
    {
        $id = base64_decode($id);
        EmgPayment::find($id)->delete();
        return back()->with('success', "Payment Deleted Successfully");
    }

    public function payment_print_in_emg($id)
    {
        $emg_id = base64_decode($id);
        // dd($emg_id);
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        // dd( $emg_patient_details);
        // dd($emg_patient_details);
        $emgPaymentDetails =  Payment::where('emg_id', $emg_id)->where('section', 'EMG')->first();
        dd($emgPaymentDetails);
        return view('emg.payment.print-payment', compact('emg_id', 'emgPaymentDetails', 'emg_patient_details', 'header_image'));
    }
}
