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
use App\Models\OpdDetails;
use App\Models\Payment;
use App\Models\Prefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        return view('OPD.billing.billing-list', compact('opd_patient_details', 'opd_id'));
    }
    public function create_billing($id)
    {
        $opd_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        return view('OPD.billing.create-billing', compact('opd_patient_details', 'opd_id', 'charge_category'));
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

        dd($request->all());
        // ====================== Billing ===========================================
            $billing_prefix = Prefix::where('name', 'bill')->first();
            $bill = new Billing;
            $bill->bill_prefix = $billing_prefix->prefix;
            $bill->bill_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
            $bill->patient_id = $request->patient_id;
            $bill->section = $request->section;
            $bill->case_id = $request->case_id;
            $bill->opd_id = $request->opd_id;
            $bill->total_amount = $request->total;
            $bill->payment_status = '';
            $bill->status = null;
            $bill->created_by = Auth::user()->id;
            $bill->note = $request->note;
            $bill->save();
        // ====================== Billing ===========================================

        if ($request->payment_amount != null || $request->payment_amount != 0 || $request->payment_amount != '') {
        // ====================== add payment =======================================
            $payment_prefix = Prefix::where('name', 'payment')->first();
            $payment = new Payment();
            $payment->patient_id = $request->patient_id;
            $payment->case_id = $request->case_id;
            $payment->section = $request->section;
            $payment->payment_prefix = $payment_prefix->prefix;
            $payment->payment_amount = $request->payment_amount;
            $payment->payment_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
            $payment->payment_recived_by = Auth::user()->id;
            $payment->payment_mode = $request->payment_mode;
            $payment->note = $request->note;
        // ====================== add payment =======================================
        }

    }
}
