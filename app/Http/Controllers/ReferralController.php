<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\Module;
use App\Models\IpdDetails;
use App\Models\Billing;
use App\Models\OpdVisitDetails;
use App\Models\EmgPatientDetails;
use App\Models\ReferralCommissionPayment;
use App\Models\ReferralCommision;
use Illuminate\Http\Request;
use DB;

class ReferralController extends Controller
{
    public function index()
    {
        $refferal_person = Referral::all();
        return view('referral.referral-listing',compact('refferal_person'));
    }

    public function add_referral()
    {
        $model = Module::get();
        return view('referral.add-referral', compact('model'));
    }

    public function save_referral(Request $request)
    {
        
        $request->validate([
            'referral_name'          => 'required',
            'phone_no'               => 'required',
            'standard_commission'    => 'required',
        ]);

        $referral = new Referral();
        $referral->referral_name        = $request->referral_name;
        $referral->phone_no             = $request->phone_no;
        $referral->address             = $request->address;
        $referral->standard_commission  = $request->standard_commission;
        $referral->opd_commission  = $request->opd_commission;
        $referral->emg_commission  = $request->emg_commission;
        $referral->ipd_commission  = $request->ipd_commission;
        $referral->pharmacy_commission  = $request->pharmacy_commission;
        $referral->pathology_commission  = $request->pathology_commission;
        $referral->radiology_commission  = $request->radiology_commission;
        $referral->blood_bank_commission  = $request->blood_bank_commission;
        $referral->ambulance_commission  = $request->ambulance_commission;
        $status = $referral->save();

        if ($status) {
            return redirect()->route('referral')->with('success', 'Referral Person Added Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_referral($id){
        $ref_id  =  base64_decode($id);
        $referral = Referral::find($ref_id);
        $referral->delete();
        if (true) {
            return redirect()->route('referral')->with('success', 'Referral Person Deleted Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_referral($id)
    {
        $ref_id  =  base64_decode($id);
        $referral = Referral::find($ref_id);
        return view('referral.edit-referral', compact('referral'));
    }
    public function update_referral(Request $request){
        $request->validate([
            'referral_name'          => 'required',
            'phone_no'               => 'required',
            'standard_commission'    => 'required',
        ]);

        $referral = Referral::find($request->refferal_id);
        $referral->referral_name        = $request->referral_name;
        $referral->phone_no             = $request->phone_no;
        $referral->address             = $request->address;
        $referral->standard_commission  = $request->standard_commission;
        $referral->opd_commission  = $request->opd_commission;
        $referral->emg_commission  = $request->emg_commission;
        $referral->ipd_commission  = $request->ipd_commission;
        $referral->pharmacy_commission  = $request->pharmacy_commission;
        $referral->pathology_commission  = $request->pathology_commission;
        $referral->radiology_commission  = $request->radiology_commission;
        $referral->blood_bank_commission  = $request->blood_bank_commission;
        $referral->ambulance_commission  = $request->ambulance_commission;
        $status = $referral->save();

        if ($status) {
            return redirect()->route('referral')->with('success', 'Referral Person Update Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
    public function view_referral($id){
        $ref_id  =  base64_decode($id);
        $referral = Referral::find($ref_id);
        $emg_registaion_list = EmgPatientDetails::where('ins_by', 'ori')->where('refference', $ref_id)->orderBy('id', 'desc')->get();
        $opd_registaion_list = OpdVisitDetails::where('ins_by', 'ori')->where('refference', $ref_id)->orderBy('id', 'desc')->get();
        $ipd_patient_list = IpdDetails::where('is_active', '1')->where('refference', $ref_id)->where('ins_by', 'ori')->get();
        return view('referral.view-referral', compact('referral','emg_registaion_list','opd_registaion_list','ipd_patient_list'));
    }

    public function apply_opd_commission($case_id,$ref_id){
        $caseId  =  base64_decode($case_id);
        $refId  =  base64_decode($ref_id);
        $referral = Referral::find($refId);
        return view('referral.add-referral-commission',compact('medicine_billings','bill_details_for_charges'));
    }

    public function referral_payment_list()
    {
        $payment_list = ReferralCommissionPayment::get();
        return view('referral.referral-payment-list',compact('payment_list'));
    }
    public function add_referral_payment()
    {
        $referer  = Referral::get();
        return view('referral.referral-payment-add',compact('referer'));
    }
    public function get_patient_by_referral(Request $request)
    {
     
        $opd_details = DB::table('opd_details')->select('opd_details.patient_id','patients.prefix','patients.first_name','patients.middle_name','patients.last_name')->leftjoin('opd_visit_details','opd_details.id','=','opd_visit_details.opd_details_id')->leftjoin('patients','opd_details.patient_id','=','patients.id')->where('opd_visit_details.refference',$request->referralId)->get()->toArray();

        $emg_details = DB::table('emg_details')->select('emg_details.patient_id','patients.prefix','patients.first_name','patients.middle_name','patients.last_name')->leftjoin('emg_patient_details','emg_details.id','=','emg_patient_details.emg_details_id')->leftjoin('patients','emg_details.patient_id','=','patients.id')->where('emg_patient_details.refference',$request->referralId)->get()->toArray();

        $ipd_details = DB::table('ipd_details')->select('ipd_details.patient_id','patients.prefix','patients.first_name','patients.middle_name','patients.last_name')->leftjoin('patients','ipd_details.patient_id','=','patients.id')->where('ipd_details.refference',$request->referralId)->get()->toArray();

        $mergedData = array_merge($opd_details, $emg_details, $ipd_details);
       return response()->json($mergedData);
    }
    public function get_bill_by_patient_id(Request $request)
    {
        $billing_details = Billing::where('patient_id',$request->p_Id)->where('referral_payment','0')->get();
        return response()->json($billing_details);
    }
    public function get_bill_amount_by_bill_id(Request $request)
    {
       
        $billing_amount = Billing::where('id',$request->billId)->first();
        return response()->json($billing_amount->total_amount);
    }
    public function referral_commission_save(Request $request){

        $referral = new ReferralCommissionPayment();
        $referral->date        = date('Y-m-d');
        $referral->reference_id             = $request->reference;
        $referral->patient_details             = $request->patient_details;
        $referral->bill_id  = $request->bill_id;
        $referral->bill_amount  = $request->bill_amount;
        $referral->commission_amount  = $request->commission_amount;
        $status = $referral->save();

        Billing::where('id',$request->bill_id)->update(['referral_payment'=>'1']);

        if ($status) {
            return redirect()->route('referral-payment-list')->with('success', 'Referral Person Payment added Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
}
