<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmgDetails;
use App\Models\Billing;
use App\Models\ChargesCatagory;
use App\Models\Prefix;
use App\Models\DiscountDetails;
use App\Models\Discount;
use App\Models\PatientCharge;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmgBillingController extends Controller
{
    public function index_in_emg($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details =  EmgDetails::where('id', $emg_id)->first();
        $emg_billing_details = Billing::where('section', 'EMG')->where('emg_id', $emg_id)->get();
        return view('emg.billing.emg-billing-listing', compact('emg_patient_details', 'emg_id', 'emg_billing_details'));
    }

    public function create_billing_in_emg($id)
    {
        $emg_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        return view('emg.billing.create-emg-billing', compact('emg_patient_details', 'emg_id', 'charge_category'));
    }

    public function save_new_emg_billing(Request $request)
    {
        //  dd($request->all());
        $validate = $request->validate([
            'bill_date'   => 'required',
            'grand_total'   => 'required',
        ]);
        try {
            DB::beginTransaction();
            if ($request->take_discount == 'yes') {
                $status = 'Requested For Discount';
            } else {
                $status = 'Billing Done';
            }
            if ($request->payment_amount != null) {
                if ($request->payment_amount == $request->grand_total) {
                    $payment_status = 'Done';
                } else {
                    $payment_status = 'Due';
                }
            }
            // ====================== Billing ===========================================
            $billing_prefix = Prefix::where('name', 'bill')->first();
            $bill = new Billing;
            $bill->bill_prefix = $billing_prefix->prefix;
            $bill->bill_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
            $bill->patient_id = $request->patient_id;
            $bill->section = $request->section;
            $bill->case_id = $request->case_id;
            $bill->emg_id = $request->emg_id;
            $bill->total_amount = $request->total;
            $bill->tax = $request->total_tax;
            $bill->grand_total = number_format((float)$request->grand_total, 2, '.', '');
            $bill->payment_status = $payment_status;
            $bill->status =  $status;
            $bill->created_by = Auth::user()->id;
            $bill->note = $request->note;
            $bill->save();
            // ====================== Billing ===========================================

            // ====================== Billing Details ===========================================
            foreach ($request->charge_name as $key => $value) {
                $patient_charge = new PatientCharge();
                $patient_charge->bill_id = $bill->id;
                $patient_charge->charge_set = $request->charge_set[$key];
                $patient_charge->charge_type = $request->charge_type[$key];
                $patient_charge->charge_category = $request->charge_category[$key];
                $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
                $patient_charge->charge_name = $request->charge_name[$key];
                $patient_charge->standard_charges = $request->standard_charges[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->save();
            }
            // ====================== Billing Details ===========================================
            if ($request->take_discount == 'yes') {
                // ====================== Discount ===========================================
                $discount = new Discount();
                $discount->discount_type =  $request->discount_type;
                $discount->patient_id =  $request->patient_id;
                $discount->section =  $request->section;
                $discount->asking_discount_amount =  $request->total_discount;
                $discount->discount_status = 'Pending';
                $discount->requested_by = Auth::user()->id;
                $discount->asking_discount_time = date('Y-m-d h:m:s', strtotime($request->bill_date));
                $discount->save();
                // ====================== Discount ===========================================
                // ====================== Discount Detaiils ==================================
                $discount_details = new DiscountDetails();
                $discount_details->bill_id = $bill->id;
                $discount_details->discount_id = $discount->id;
                $discount_details->bill_amount = $request->total;
                $discount_details->save();
                // ====================== Discount Detaiils ==================================
            }
            if ($request->payment_amount != null || $request->payment_amount != 0 || $request->payment_amount != '') {
                // ====================== add payment =======================================
                $payment_prefix = Prefix::where('name', 'payment')->first();
                $payment = new Payment();
                $payment->patient_id = $request->patient_id;
                $payment->case_id = $request->case_id;
                $payment->section = $request->section;
                $payment->opd_id = $request->opd_id;
                $payment->emg_id = $request->emg_id;
                $payment->ipd_id = $request->ipd_id;
                $payment->payment_prefix = $payment_prefix->prefix;
                $payment->payment_amount = $request->payment_amount;
                $payment->payment_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
                $payment->payment_recived_by = Auth::user()->id;
                $payment->payment_mode = $request->payment_mode;
                $payment->note = $request->note;
                $payment->save();
                // ====================== add payment =======================================
            }
            DB::commit();
            return redirect()->route('emg-billing', ['id' => base64_encode($request->emg_id)])->with('success', "Biliing Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function bill_details_in_emg($bill_id)
    {
        $billId = base64_decode($bill_id);
        $bill_details = Billing::where('id', $billId)->first();
        $patient_charge_details = PatientCharge::where('bill_id', $billId)->get();
        $emg_patient_details = EmgDetails::where('id', $bill_details->emg_id)->first();
        return view('emg.billing.emg-billing-details', compact('bill_details', 'patient_charge_details', 'emg_patient_details'));
    }

    public function edit_emg_bill($bill_id)
    {
        $billId = base64_decode($bill_id);
    }

    public function delete_emg_bill($bill_id)
    {
        $billId = base64_decode($bill_id);
    }
}
