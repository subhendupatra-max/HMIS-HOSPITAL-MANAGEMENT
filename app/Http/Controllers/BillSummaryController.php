<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseReference;
use App\Models\PatientOthersBilling;

class BillSummaryController extends Controller
{
    public function billing_summary(Request $request)
    {
        $uhid_no_case_id = $request->uhid_no_case_id;
        $bill_details = '';
        $discount_details = '';
        $payment_details = '';
        $patient_charge_details = '';
        if($uhid_no_case_id != null)
        {
            $bill_details = Billing::where('id',$id)->first();
            $discount_details = DiscountDetails::where('bill_id', $id)->first();
            $payment_details = Payment::where('bill_id',$id)->get();

            $patient_charge_details = BillDetails::select('charges.charges_name', 'patient_charges.amount', 'patient_charges.standard_charges', 'patient_charges.tax', 'patient_charges.qty')->where('bill_details.purpose_for', '=', 'charges')->leftjoin('patient_charges', 'patient_charges.id', '=', 'bill_details.purpose_for_id')->leftjoin('charges', 'patient_charges.charge_name', '=', 'charges.id')->where('bill_details.bill_id', $id)->get(); 
        }

        return view('bill_summary.bill-summary',compact('uhid_no_case_id','bill_details','discount_details','payment_details','patient_charge_details'));
    }

}
