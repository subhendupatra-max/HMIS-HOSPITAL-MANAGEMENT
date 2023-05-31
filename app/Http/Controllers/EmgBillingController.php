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
use App\Models\MedicineBilling;
use App\Models\BillDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmgBillingController extends Controller
{
    public function index_in_emg($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details =  EmgDetails::where('id', $emg_id)->first();
        $emg_billing_details = Billing::where('section', 'EMG')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.billing.emg-billing-listing', compact('emg_patient_details', 'emg_id', 'emg_billing_details'));
    }

    public function create_billing_in_emg($id)
    {
        $emg_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $old_applied_charges = PatientCharge::where('billing_status', '0')->where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        $medicine_charges = MedicineBilling::where('status', '0')->where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.billing.create-emg-billing', compact('emg_patient_details', 'emg_id', 'charge_category','medicine_charges','old_applied_charges'));
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
            $status = 'Done';
            $tax = $request->total_tax;
            $tax_total = $request->total + (($request->total) * ($tax / 100));
            $grand_total = number_format((float)($tax_total), 2, '.', '');
            $discount_status = 'Requested';
        } else {
            $discount_status = 'Not applied';
            $tax = $request->total_tax;
            $tax_total = $request->total + (($request->total) * ($tax / 100));
            $grand_total = number_format((float)($tax_total), 2, '.', '');
            $status = 'Done';
        }

        if ($request->payment_amount != null) {
            if ($request->payment_amount == $request->grand_total) {
                $payment_status = 'Done';
            } else {
                $payment_status = 'Due';
            }
        }
        else{
            $payment_status = 'Due';
        }

        // ====================== Billing ===========================================
        $billing_prefix = Prefix::where('name', 'bill')->first();
        $bill = new Billing;
        $bill->bill_prefix = $billing_prefix->prefix;
        $bill->bill_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
        $bill->patient_id = $request->patient_id;
        $bill->section = $request->section;
        $bill->case_id = $request->case_id;
        // $bill->opd_id = $request->opd_id;
        $bill->total_amount = $request->total;
        $bill->payment_status = $payment_status;
        $bill->discount_status =  $discount_status;
        $bill->status =  'done';
        $bill->created_by = Auth::user()->id;
        $bill->note = $request->note;
        $bill->grand_total = $grand_total;
        $bill->tax =  $request->total_tax;
        $bill->save();
        // ====================== Billing ===========================================

        foreach ($request->charge_category as $key => $value) {

            // if ($value->old_or_new == 'new') {
            //     $patient_charge = new PatientCharge();
            //     $patient_charge->case_id = $request->case_id;
            //     $patient_charge->section = $request->section;
            //     $patient_charge->charges_date = $request->date;
            //     $patient_charge->emg_id = $request->emg_id;
            //     $patient_charge->patient_id = $request->patient_id;
            //     $patient_charge->charge_set = $request->charge_set[$key];
            //     $patient_charge->charge_type = $request->charge_type[$key];
            //     $patient_charge->charge_category = $request->charge_category[$key];
            //     $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
            //     $patient_charge->charge_name = $request->charge_name[$key];
            //     $patient_charge->standard_charges = $request->standard_charges[$key];
            //     $patient_charge->tax = $request->tax[$key];
            //     $patient_charge->qty = $request->qty[$key];
            //     $patient_charge->amount = $request->amount[$key];
            //     $patient_charge->generated_by = Auth::user()->id;
            //     $patient_charge->billing_status = '1';
            //     $patient_charge->save();
            //     $charge_id = $patient_charge->id;
            // }
            if ($request->old_or_new[$key] == 'old') {
                $charge_id = $request->charge_id_old[$key];
                $p_charg = PatientCharge::find( $charge_id);
                $p_charg->billing_status = '1';
                $p_charg->save();
            }


            // for pathology billing 
            // if ($request->charge_category[$key] == '1') {
            //     $charge_detp = PathologyTest::where('charge', $request->charge_name[$key])->first();
            //     $chargedetailstestp = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detp->id)->where('test_status', '=', '0')->first();

            //     if ($chargedetailstestp == null) {
            //         $pathology_patient_test = new PathologyPatientTest();
            //         $pathology_patient_test->bill_id = $bill->id;
            //         $pathology_patient_test->case_id = $request->case_id;
            //         $pathology_patient_test->date = $request->date;
            //         $pathology_patient_test->section = 'EMG';
            //         $pathology_patient_test->patient_id = $request->patient_id;
            //         $pathology_patient_test->test_id =  $charge_detp->id;
            //         $pathology_patient_test->emg_id = $request->emg_id;
            //         $pathology_patient_test->generated_by = Auth::user()->id;
            //         $pathology_patient_test->billing_status = '1';
            //         $pathology_patient_test->test_status = '0';
            //         $pathology_patient_test->save();
            //     } else {
            //         $chargedetailstestp->billing_status = '1';
            //         $chargedetailstestp->save();
            //     }
            // }

            // for pathology billing
            // for Radiology billing

            // if ($request->charge_category[$key] == '2') {
            //     $charge_detr = RadiologyTest::where('charge', $request->charge_name[$key])->first();
            //     $chargedetailstestr = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detr->id)->where('test_status', '=', '0')->where('test_id', $charge_detr->charge)->first();

            //     if ($chargedetailstestr == null) {
            //         $radiology_patient_test = new RadiologyPatientTest();
            //         $radiology_patient_test->bill_id = $bill->id;
            //         $radiology_patient_test->case_id = $request->case_id;
            //         $radiology_patient_test->date = $request->date;
            //         $radiology_patient_test->section = 'EMG';
            //         $radiology_patient_test->patient_id = $request->patient_id;
            //         $radiology_patient_test->test_id = $charge_detr->id;
            //         $radiology_patient_test->emg_id = $request->emg_id;
            //         $radiology_patient_test->generated_by = Auth::user()->id;
            //         $radiology_patient_test->billing_status = '2';
            //         $radiology_patient_test->test_status = '0';
            //         $radiology_patient_test->save();
            //     } else {
            //         $chargedetailstestr->billing_status = '2';
            //         $chargedetailstestr->save();
            //     }
            // }
            // for Radiology billing

            // for Blood Bank billing 
            // for Blood Bank billing

            // for Ambulance billing 
            // for Ambulance billing

            // ====================== Billing Details ===========================================
            $bill_details_charges = new BillDetails();
            $bill_details_charges->bill_id = $bill->id;
            $bill_details_charges->purpose_for = 'charges';
            $bill_details_charges->purpose_for_id = $charge_id;
            $bill_details_charges->save();
            // ====================== Billing Details ===========================================
        }
        if (@$request->medicine_bill_id[0]->medicine_bill_id != null) {
            foreach ($request->medicine_bill_id as $value) {
                // ====================== Billing Details ===========================================
                $bill_details_medicine = new BillDetails();
                $bill_details_medicine->bill_id = $bill->id;
                $bill_details_medicine->purpose_for = 'medicine';
                $bill_details_medicine->purpose_for_id = $value->medicine_bill_id;
                $bill_details_medicine->save();
                // ====================== Billing Details ===========================================
            }
        }


        //payment
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
        //payment

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
            $bill_update = Billing::find($bill->id);
            $bill_update->discount_id = $discount->id;
            $bill_update->save();
        }

            DB::commit();
            return redirect()->route('emg-billing', ['id' => base64_encode($request->emg_id)])->with('success', "Billing Successfully");
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
