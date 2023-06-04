<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpdPayment;
use App\Models\OpdTimeline;
use App\Models\OpdDetails;
use App\Models\Payment;
use App\Models\Prefix;
use App\Models\AllHeader;
use Auth;

class OpdPaymentController extends Controller
{
    public function payment_listing_in_opd($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $opdPaymentDetails =  Payment::where('opd_id', $opd_id)->where('section', 'OPD')->paginate(10);

        return view('OPD.payment.payment-listing', compact('opd_id', 'opdPaymentDetails', 'opd_patient_details'));
    }

    public function add_payment_in_opd($id)
    {
        $opd_id = base64_decode($id);

        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $opdPaymentDetails =  Payment::where('opd_id', $opd_id)->where('section', 'OPD')->get();
        return view('OPD.payment.add-payment', compact('opd_id', 'opdPaymentDetails', 'opd_patient_details'));
    }

    public function save_payment_in_opd(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);

        $opd_patient_details = OpdDetails::where('id', $request->opd_id)->first();
        // ====================== add payment =======================================
        $payment_prefix = Prefix::where('name', 'payment')->first();
        $payment = new Payment();
        $payment->patient_id =  $opd_patient_details->patient_id;
        $payment->case_id =  $opd_patient_details->case_id;
        $payment->section = 'OPD';
        $payment->opd_id = $request->opd_id;
        $payment->payment_prefix = $payment_prefix->prefix;
        $payment->payment_amount = $request->amount;
        $payment->payment_date = date('Y-m-d h:m:s', strtotime($request->payment_date));
        $payment->payment_recived_by = Auth::user()->id;
        $payment->payment_mode = $request->payment_mode;
        $payment->note = $request->note;
        $payment->save();
        // ====================== add payment =======================================

        if (@$payment->id) {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Payment Added Succesfully');
        } else {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function edit_payment_in_opd($id, $opd_id)
    {
        $opd_id = base64_decode($opd_id);
        $e_id = base64_decode($id);
        $payment = OpdPayment::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $editOpdPaymentDetails = Payment::where('id', $e_id)->first();

        return view('OPD.payment.edit-payment', compact('payment', 'editOpdPaymentDetails', 'opd_patient_details'));
    }

    public function update_payment_in_opd(Request $request)
    {
        $request->validate([
            'payment_date'          => 'required',
            'amount'                => 'required',
            'payment_mode'          => 'required',
        ]);

        $opd_patient_details = OpdDetails::where('id', $request->opd_id)->first();
        // ====================== add payment =======================================
        $payment = Payment::find($request->id);
        $payment->payment_amount = $request->amount;
        $payment->payment_date = date('Y-m-d h:m:s', strtotime($request->payment_date));
        $payment->payment_mode = $request->payment_mode;
        $payment->note = $request->note;
        $status = $payment->save();
        // ====================== add payment =======================================

        if ($status) {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Payment Updated Succesfully');
        } else {
            return redirect()->route('payment-listing-in-opd', ['id' => base64_encode($request->opd_id)])->with('error', 'Something Went Wrong');
        }
    }

    public function delete_payment_in_opd($id)
    {
        $id = base64_decode($id);
        Payment::find($id)->delete();

        return back()->with('success', "Payment Deleted Successfully");
    }

    public function payment_print_in_opd($id, $opd_id)
    {
        $id = base64_decode($id);
        $opd_id = base64_decode($opd_id);
        // dd($opd_id);
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();

        $opdPaymentDetails =  Payment::where('opd_id', $opd_id)->where('section', 'OPD')->first();
        // dd($opdPaymentDetails);
        return view('OPD.payment.print-payment', compact('opd_id', 'opdPaymentDetails', 'opd_patient_details', 'header_image'));
    }
}
