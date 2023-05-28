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
use App\Models\PathologyTest;
use App\Models\PathologyPatientTest;
use App\Models\Prefix;
use App\Models\PathologyBilling;
use App\Models\PathologyBillingDetails;
use App\Models\DiscountDeatils;
use App\Models\MedicineBilling;
use App\Models\RadiologyTest;
use App\Models\BillDetails;
use App\Models\RadiologyPatientTest;
use App\Models\IpdDetails;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AllHeader;
use PDF;

class BillingController extends Controller
{
    public function index($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $opd_billing_details = Billing::where('section', 'OPD')->where('case_id', $opd_patient_details->case_id)->where('is_delete', '0')->orderBy('id', 'desc')->get();
        return view('OPD.billing.billing-list', compact('opd_patient_details', 'opd_id', 'opd_billing_details'));
    }
    public function create_billing($id)
    {
        $opd_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $old_applied_charges = PatientCharge::where('billing_status', '0')->where('ins_by', 'ori')->where('case_id', $opd_patient_details->case_id)->get();
        $medicine_charges = MedicineBilling::where('status', '0')->where('ins_by', 'ori')->where('case_id', $opd_patient_details->case_id)->get();
        return view('OPD.billing.create-billing', compact('opd_patient_details', 'opd_id', 'charge_category', 'old_applied_charges', 'medicine_charges'));
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
        //dd($request->all());
        $validate = $request->validate([
            'bill_date'   => 'required',
        ]);
        // try {
        //     DB::beginTransaction();
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
        } else {
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
            if ($request->old_or_new[$key] == 'new') {
                $patient_charge = new PatientCharge();
                $patient_charge->case_id = $request->case_id;
                $patient_charge->section = $request->section;
                $patient_charge->charges_date = $request->date;
                $patient_charge->opd_id = $request->opd_id;
                $patient_charge->patient_id = $request->patient_id;
                $patient_charge->charge_set = $request->charge_set[$key];
                $patient_charge->charge_type = $request->charge_type[$key];
                $patient_charge->charge_category = $request->charge_category[$key];
                $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
                $patient_charge->charge_name = $request->charge_name[$key];
                $patient_charge->standard_charges = $request->standard_charges[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->generated_by = Auth::user()->id;
                $patient_charge->billing_status = '1';
                $patient_charge->save();
                $charge_id = $patient_charge->id;
            }
            if ($request->old_or_new[$key] == 'old') {
                $charge_id = $request->charge_id_old[$key];
                $patient_charge_update = PatientCharge::find($charge_id);
                $patient_charge_update->billing_status = '1';
                $patient_charge_update->save();
            }

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

        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        $Opd_details = OpdDetails::where('id', $request->opd_id)->first();

        if ($request->save == 'save_and_print') {
            // $pdf = PDF::loadView('OPD._print.opd-biling-charges');
            return view('OPD._print.opd-biling-charges', compact('header_image', 'Opd_details'));

            return redirect()->route('opd-billing', ['id' => base64_encode($request->opd_id)])->with('success', "Biliing Successfully");
        } else {

            return redirect()->route('opd-billing', ['id' => base64_encode($request->opd_id)])->with('error', "Something Went Worng");
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return back()->withErrors(['error' => $th->getMessage()]);
        // }
    }
    public function bill_details($bill_id)
    {
        $billId = base64_decode($bill_id);
        // dd($billId); 
        $bill_details = Billing::where('id', $billId)->first();
        // dd($bill_details); 
        $discount_details = DiscountDetails::where('bill_id', $billId)->first();

        $patient_charge_details = BillDetails::select('charges.charges_name', 'patient_charges.amount', 'patient_charges.standard_charges', 'patient_charges.tax', 'patient_charges.qty')->where('bill_details.purpose_for', '=', 'charges')->leftjoin('patient_charges', 'patient_charges.id', '=', 'bill_details.purpose_for_id')->leftjoin('charges', 'patient_charges.charge_name', '=', 'charges.id')->where('bill_details.bill_id', $billId)->get();

        $medicine_bill_details = BillDetails::select('medicine_billings.total_amount', 'medicine_billings.bill_prefix', 'medicine_billings.id', 'medicine_billings.bill_date')->where('bill_details.purpose_for', '=', 'medicine')->leftjoin('medicine_billings', 'medicine_billings.id', '=', 'bill_details.purpose_for_id')->get();

        $opd_patient_details = OpdDetails::where('case_id', $bill_details->case_id)->first();

        return view('OPD.billing.billing-details', compact('bill_details', 'patient_charge_details', 'opd_patient_details', 'discount_details', 'medicine_bill_details'));
    }
    public function edit_opd_bill($bill_id, $id)
    {
        $billId = base64_decode($bill_id);
        $opd_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $old_applied_charges = PatientCharge::where('billing_status', '0')->where('ins_by', 'ori')->where('case_id', $opd_patient_details->case_id)->get();
        $medicine_charges = MedicineBilling::where('status', '0')->where('ins_by', 'ori')->where('case_id', $opd_patient_details->case_id)->get();
        $bill_details = Billing::where('id', $billId)->first();
        $discount_details = DiscountDetails::where('bill_id', $billId)->first();

        $patient_charge_details = BillDetails::select('charges.charges_name', 'patient_charges.*')->where('bill_details.purpose_for', '=', 'charges')->leftjoin('patient_charges', 'patient_charges.id', '=', 'bill_details.purpose_for_id')->leftjoin('charges', 'patient_charges.charge_name', '=', 'charges.id')->where('bill_details.bill_id', $billId)->get();

        $medicine_bill_details = BillDetails::select('medicine_billings.total_amount', 'medicine_billings.bill_prefix', 'medicine_billings.id', 'medicine_billings.bill_date')->where('bill_details.purpose_for', '=', 'medicine')->leftjoin('medicine_billings', 'medicine_billings.id', '=', 'bill_details.purpose_for_id')->get();

        return view('OPD.billing.edit-billing', compact('opd_patient_details', 'opd_id', 'charge_category', 'old_applied_charges', 'medicine_charges', 'billId', 'bill_details', 'discount_details', 'patient_charge_details', 'medicine_bill_details'));
    }
    public function update_new_opd_billing(Request $request)
    {
        //dd($request->all());
        $validate = $request->validate([
            'bill_date'   => 'required',
        ]);
        // try {
        //     DB::beginTransaction();
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
        } else {
            $payment_status = 'Due';
        }

        // ====================== Billing ===========================================
        $billing_prefix = Prefix::where('name', 'bill')->first();
        $bill = Billing::where('id', $request->bill_id)->first();
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
            if ($request->old_or_new[$key] == 'new') {
                $patient_charge = PatientCharge::where('id', $request->patient_charge_id)->first();
                $patient_charge->case_id = $request->case_id;
                $patient_charge->section = $request->section;
                $patient_charge->charges_date = $request->date;
                $patient_charge->opd_id = $request->opd_id;
                $patient_charge->patient_id = $request->patient_id;
                $patient_charge->charge_set = $request->charge_set[$key];
                $patient_charge->charge_type = $request->charge_type[$key];
                $patient_charge->charge_category = $request->charge_category[$key];
                $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
                $patient_charge->charge_name = $request->charge_name[$key];
                $patient_charge->standard_charges = $request->standard_charges[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->generated_by = Auth::user()->id;
                $patient_charge->billing_status = '1';
                $patient_charge->save();
                $charge_id = $patient_charge->id;
            }
            if ($request->old_or_new[$key] == 'old') {
                $charge_id = $request->charge_id_old[$key];
                $patient_charge_update = PatientCharge::find($charge_id);
                $patient_charge_update->billing_status = '1';
                $patient_charge_update->save();
            }

            // ====================== Billing Details ===========================================
            BillDetails::where('bill_id', $bill->id)->first()->delete();

            $bill_details_charges = new BillDetails();
            $bill_details_charges->bill_id = $bill->id;
            $bill_details_charges->purpose_for = 'charges';
            $bill_details_charges->purpose_for_id = $charge_id; ///patient chare id
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

        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        $Opd_details = OpdDetails::where('id', $request->opd_id)->first();

        if ($request->save == 'save_and_print') {
            // $pdf = PDF::loadView('OPD._print.opd-biling-charges');
            return view('OPD._print.opd-biling-charges', compact('header_image', 'Opd_details'));

            return redirect()->route('opd-billing', ['id' => base64_encode($request->opd_id)])->with('success', "Biliing Updated Successfully");
        } else {

            return redirect()->route('opd-billing', ['id' => base64_encode($request->opd_id)])->with('success', "Biliing Updated Successfully");
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return back()->withErrors(['error' => $th->getMessage()]);
        // }
    }
    public function delete_opd_bill($bill_id)
    {
        try {
            DB::beginTransaction();
            $billId = base64_decode($bill_id);
            $bill_details_charges_ = BillDetails::where('bill_id', $billId)->get();

            foreach ($bill_details_charges_ as $key => $value) {

                if ($bill_details_charges_[$key]->purpose_for == 'charges') {
                    $patient_charge_update = PatientCharge::where('id', $bill_details_charges_[$key]->purpose_for_id)->update(['billing_status' => '0']);
                }
            }
            BillDetails::where('bill_id', $billId)->delete();
            Billing::where('id', $billId)->delete();
            DB::commit();
            return redirect()->back()->with('success', "Billing Deleted Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    //--------------------------------------   Belling for Ipd   --------------------------------------------
    public function ipd_billing_index($id)
    {
        $ipd_id = base64_decode($id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_billing_details = Billing::where('section', 'IPD')->where('case_id', $ipd_details->case_id)->where('is_delete', '0')->orderBy('id', 'desc')->get();
        return view('Ipd.billing.billing-list', compact('ipd_details', 'ipd_id', 'ipd_billing_details'));
    }

    public function create_billing_in_ipd($id)
    {
        $ipd_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $old_applied_charges = PatientCharge::where('billing_status', '0')->where('ins_by', 'ori')->where('case_id', $ipd_details->case_id)->get();
        $medicine_charges = MedicineBilling::where('status', '0')->where('ins_by', 'ori')->where('case_id', $ipd_details->case_id)->get();
        return view('Ipd.billing.create-billing', compact('ipd_details', 'ipd_id', 'charge_category', 'old_applied_charges', 'medicine_charges'));
    }

    public function save_new_ipd_billing(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'bill_date'   => 'required',
            'total'   => 'required',
            'grand_total'   => 'required',
        ]);
        // try {
        //     DB::beginTransaction();
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

            if ($value->old_or_new == 'new') {
                $patient_charge = new PatientCharge();
                $patient_charge->case_id = $request->case_id;
                $patient_charge->section = $request->section;
                $patient_charge->charges_date = $request->date;
                $patient_charge->ipd_id = $request->ipd_id;
                $patient_charge->patient_id = $request->patient_id;
                $patient_charge->charge_set = $request->charge_set[$key];
                $patient_charge->charge_type = $request->charge_type[$key];
                $patient_charge->charge_category = $request->charge_category[$key];
                $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
                $patient_charge->charge_name = $request->charge_name[$key];
                $patient_charge->standard_charges = $request->standard_charges[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->generated_by = Auth::user()->id;
                $patient_charge->billing_status = '1';
                $patient_charge->save();
                $charge_id = $patient_charge->id;
            }
            if ($value->old_or_new == 'old') {
                $charge_id = $request->charge_id_old[$key];
            }


            // for pathology billing 
            if ($request->charge_category[$key] == '1') {
                $charge_detp = PathologyTest::where('charge', $request->charge_name[$key])->first();
                $chargedetailstestp = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detp->id)->where('test_status', '=', '0')->first();

                if ($chargedetailstestp == null) {
                    $pathology_patient_test = new PathologyPatientTest();
                    $pathology_patient_test->bill_id = $bill->id;
                    $pathology_patient_test->case_id = $request->case_id;
                    $pathology_patient_test->date = $request->date;
                    $pathology_patient_test->section = 'IPD';
                    $pathology_patient_test->patient_id = $request->patient_id;
                    $pathology_patient_test->test_id =  $charge_detp->id;
                    $pathology_patient_test->ipd_id = $request->ipd_id;
                    $pathology_patient_test->generated_by = Auth::user()->id;
                    $pathology_patient_test->billing_status = '1';
                    $pathology_patient_test->test_status = '0';
                    $pathology_patient_test->save();
                } else {
                    $chargedetailstestp->billing_status = '1';
                    $chargedetailstestp->save();
                }
            }

            // for pathology billing
            // for Radiology billing

            if ($request->charge_category[$key] == '2') {
                $charge_detr = RadiologyTest::where('charge', $request->charge_name[$key])->first();
                $chargedetailstestr = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detr->id)->where('test_status', '=', '0')->where('test_id', $charge_detr->charge)->first();

                if ($chargedetailstestr == null) {
                    $radiology_patient_test = new RadiologyPatientTest();
                    $radiology_patient_test->bill_id = $bill->id;
                    $radiology_patient_test->case_id = $request->case_id;
                    $radiology_patient_test->date = $request->date;
                    $radiology_patient_test->section = 'IPD';
                    $radiology_patient_test->patient_id = $request->patient_id;
                    $radiology_patient_test->test_id = $charge_detr->id;
                    $radiology_patient_test->ipd_id = $request->ipd_id;
                    $radiology_patient_test->generated_by = Auth::user()->id;
                    $radiology_patient_test->billing_status = '2';
                    $radiology_patient_test->test_status = '0';
                    $radiology_patient_test->save();
                } else {
                    $chargedetailstestr->billing_status = '2';
                    $chargedetailstestr->save();
                }
            }
            // for Radiology billing

            // for Blood Bank billing 
            // for Blood Bank billing

            // for Ambulance billing 
            // for Ambulance billing

            // ====================== Billing Details ===========================================
            $bill_details_charges = new BillDetails();
            $bill_details_charges->bill_id = $bill->id;
            $bill_details_charges->purpose_for = 'charges';
            $bill_details_charges->purpose_for_id = $patient_charge->id;
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

        //     DB::commit();
        //     return redirect()->route('ipd-billing', ['id' => base64_encode($request->ipd_id)])->with('success', "Biliing Successfully");
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return back()->withErrors(['error' => $th->getMessage()]);
        // }
    }
}
