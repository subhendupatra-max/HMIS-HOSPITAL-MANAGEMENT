<?php

namespace App\Http\Controllers\OPD;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Charge;
use App\Models\ChargesCatagory;
use App\Models\ChargesPackageCatagory;
use App\Models\ChargesPackageName;
use App\Models\ChargesPackageSubCatagory;
use App\Models\ChargesSubCatagory;
use App\Models\Discount;
use App\Models\DiscountDetails;
use App\Models\OpdDetails;
use App\Models\PatientCharge;
use App\Models\Payment;
use App\Models\Prefix;
use App\Models\PathologyBilling;
use App\Models\PathologyBillingDetails;
use App\Models\DiscountDeatils;
use App\Models\MedicineBilling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function index($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $opd_billing_details = Billing::where('section', 'OPD')->where('opd_id', $opd_id)->orderBy('id','desc')->get();
        // dd($opd_billing_details);
        return view('OPD.billing.billing-list', compact('opd_patient_details', 'opd_id', 'opd_billing_details'));
    }
    public function create_billing($id)
    {
        $opd_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $old_applied_charges = PatientCharge::where('billing_status','0')->where('ins_by','ori')->where('case_id',$opd_patient_details->case_id)->get();
        $medicine_charges = MedicineBilling::where('status','0')->where('ins_by','ori')->where('case_id',$opd_patient_details->case_id)->get();
        return view('OPD.billing.create-billing', compact('opd_patient_details', 'opd_id', 'charge_category','old_applied_charges','medicine_charges'));
    }
    public function get_category(Request $request)
    {
        if ($request->chargeSet == 'Normal') {
            $charge_category =  ChargesCatagory::select('charges_catagories.charges_catagories_name as category_name', 'charges_catagories.id as category_id')->get();
        }
        if ($request->chargeSet == 'Package') {
            $charge_category =  ChargesPackageCatagory::select('charges_package_catagories.charges_package_catagories_name as category_name', 'charges_package_catagories.id as category_id')->get();
        }
        return response()->json($charge_category);
    }
    public function get_subcategory_by_category(Request $request)
    {
        if ($request->chargeSet == 'Normal') {
            $subCategory = ChargesSubCatagory::select('charges_sub_catagories.charges_sub_catagories_name as sub_category_name', 'charges_sub_catagories.id as sub_category_id')->where('charges_catagories_id', $request->categoryId)->get();
        }
        if ($request->chargeSet == 'Package') {
            $subCategory =  ChargesPackageSubCatagory::select('charges_package_sub_catagories.charges_package_sub_catagory_name as sub_category_name', 'charges_package_sub_catagories.id as sub_category_id')->where('charges_package_catagory_id', $request->categoryId)->get();
        }
        return response()->json($subCategory);
    }

    public function get_charge_name(Request $request)
    {
        if ($request->chargeSet == 'Normal') {
            $charge_details = Charge::select('charges.charges_name as charges_name', 'charges.id as charge_id')->where('charges_catagory_id', $request->chargeCategory)->where('charges_sub_catagory_id', $request->chargeSubCategory)->where('type', $request->chargeType)->get();
        }
        if ($request->chargeSet == 'Package') {
            $charge_details = ChargesPackageName::select('charges_package_names.package_name as charges_name', 'charges_package_names.id as charge_id')->where('charge_package_catagory_id', $request->chargeCategory)->where('charge_package_sub_catagory_id', $request->chargeSubCategory)->where('type', $request->chargeType)->get();
        }
        return response()->json($charge_details);
    }
    public function get_charge_amount(Request $request)
    {
        if ($request->chargeSet == 'Normal') {
            $charge_amount = Charge::select('charges.standard_charges as charge_amount')->where('id', $request->chargeName)->first();
        }
        if ($request->chargeSet == 'Package') {
            $charge_amount = ChargesPackageName::select('charges_package_names.total_amount as charge_amount')->where('id', $request->chargeName)->first();
        }
        return response()->json($charge_amount);
    }

    public function save_new_opd_billing(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'bill_date'   => 'required',
            'total'   => 'required',
        ]);
        try {
            DB::beginTransaction();
            foreach ($request->charge_category as $key => $value) {

            // for pathology billing 
            if($request->charge_category[$key] == '1')
            {
                $billing_prefix = Prefix::where('name', 'pathology_bill')->first();
                $bill = new PathologyBilling;
                $bill->bill_prefix = $billing_prefix->prefix;
                $bill->bill_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
                $bill->patient_id = $request->patient_id;
                $bill->section = $request->section;
                $bill->case_id = $request->case_id;
                $bill->total_amount = $request->total;
                $bill->payment_status = '';
                $bill->status =  'Done';
                $bill->created_by = Auth::user()->id;
                $bill->note = $request->note;
                $bill->save();
    
                $patient_charge = new PathologyBillingDetails();
                $patient_charge->pathology_billing_id = $bill->id;
                $patient_charge->pathology_id = $request->charge_name[$key];
                $patient_charge->charge_amount = $request->standard_charges[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->status = '';
                $patient_charge->save();
                
            }
            // for pathology billing

            // for Radiology billing
            if($request->charge_category[$key] == '2')
            {

            } 
            // for Radiology billing

            // for Others billing 
            if($request->charge_category[$key] == '3')
            {

            }
            // for Others billing

            // for Blood Bank billing 
            // for Blood Bank billing

            // for Ambulance billing 
            // for Ambulance billing



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




            // if ($request->take_discount == 'yes') {
            //     $status = 'Done';
            //     $tax = $request->total_tax;
            //     $tax_total = $request->total + (($request->total)*($tax / 100));
            //     $grand_total = number_format((float)($tax_total), 2, '.', '');
            //     $discount_status = 'Requested';
            // } else {
            //     $discount_status = 'Not applied';
            //     $tax = $request->total_tax;
            //     $tax_total = $request->total + (($request->total)*($tax / 100));
            //     $grand_total = number_format((float)($tax_total), 2, '.', '');
            //     $status = 'Done';
            // }

            // if ($request->payment_amount != null) {
            //     if ($request->payment_amount == $request->grand_total) {
            //         $payment_status = 'Done';
            //     } else {
            //         $payment_status = 'Due';
            //     }
            // }
            // ====================== Billing ===========================================
            // $billing_prefix = Prefix::where('name', 'bill')->first();
            // $bill = new Billing;
            // $bill->bill_prefix = $billing_prefix->prefix;
            // $bill->bill_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
            // $bill->patient_id = $request->patient_id;
            // $bill->section = $request->section;
            // $bill->case_id = $request->case_id;
            // // $bill->opd_id = $request->opd_id;
            // $bill->total_amount = $request->total;
            // $bill->payment_status = '';
            // $bill->discount_status = '';
            // $bill->status =  'done';
            // $bill->created_by = Auth::user()->id;
            // $bill->note = $request->note;
            // $bill->save();
            // ====================== Billing ===========================================

            // ====================== Billing Details ===========================================
            // foreach ($request->charge_name as $key => $value) {
            //     $patient_charge = new PatientCharge();
            //     $patient_charge->bill_id = $bill->id;
            //     $patient_charge->charge_set = $request->charge_set[$key];
            //     $patient_charge->charge_type = $request->charge_type[$key];
            //     $patient_charge->charge_category = $request->charge_category[$key];
            //     $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
            //     $patient_charge->charge_name = $request->charge_name[$key];
            //     $patient_charge->standard_charges = $request->standard_charges[$key];
            //     $patient_charge->tax = $request->tax[$key];
            //     $patient_charge->amount = $request->amount[$key];
            //     $patient_charge->save();
            // }
            // ====================== Billing Details ===========================================
            // if ($request->take_discount == 'yes') {
            //     // ====================== Discount ===========================================
            //     $discount = new Discount();
            //     $discount->discount_type =  $request->discount_type;
            //     $discount->patient_id =  $request->patient_id;
            //     $discount->section =  $request->section;
            //     $discount->asking_discount_amount =  $request->total_discount;
            //     $discount->discount_status = 'Pending';
            //     $discount->requested_by = Auth::user()->id;
            //     $discount->asking_discount_time = date('Y-m-d h:m:s', strtotime($request->bill_date));
            //     $discount->save();
            //     // ====================== Discount ===========================================
            //     // ====================== Discount Detaiils ==================================
            //     $discount_details = new DiscountDetails();
            //     $discount_details->bill_id = $bill->id;
            //     $discount_details->discount_id = $discount->id;
            //     $discount_details->bill_amount = $request->total;
            //     $discount_details->save();
            //     // ====================== Discount Detaiils ==================================
                
            //     $bill_update = Billing::find($bill->id);
            //     $bill_update->discount_id = $discount->id;
            //     $bill_update->save();
            // }

            DB::commit();
            return redirect()->route('opd-billing', ['id' => base64_encode($request->opd_id)])->with('success', "Biliing Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function bill_details($bill_id)
    {
        $billId = base64_decode($bill_id);
        $bill_details = Billing::where('id', $billId)->first();
        $discount_details = DiscountDetails::where('bill_id', $billId)->first();
        $patient_charge_details = PatientCharge::where('bill_id', $billId)->get();
        $opd_patient_details = OpdDetails::where('id', $bill_details->opd_id)->first();
        return view('OPD.billing.billing-details', compact('bill_details', 'patient_charge_details', 'opd_patient_details','discount_details'));
    }
    public function edit_opd_bill($bill_id)
    {
        $billId = base64_decode($bill_id);
    }
    public function delete_opd_bill($bill_id)
    {
        $billId = base64_decode($bill_id);
    }
}
