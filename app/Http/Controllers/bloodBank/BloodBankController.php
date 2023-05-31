<?php

namespace App\Http\Controllers\bloodBank;

use App\Http\Controllers\Controller;
use App\Models\bloodBank\BloodDonor;
use App\Models\bloodBank\UnitType;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\ChargesCatagory;
use App\Models\Charge;
use App\Models\User;
use App\Models\bloodBank\Blood;
use App\Models\bloodBank\BloodIssue;
use App\Models\bloodBank\Components;
use App\Models\bloodBank\ComponentsDetail;
use App\Models\Patient;


class BloodBankController extends Controller
{
    public function all_blood_details()
    {
        $blood_groups = BloodGroup::all();
        return view('Blood_Bank.blood-bank-listing', compact('blood_groups'));
    }
    public function blood_details($id)
    {
        $id = base64_decode($id);
        $blood_group_id = $id;
        $blood_groups = BloodGroup::all();
        $blood = Blood::where('blood_group_id', $blood_group_id)->get();
        $components = Components::where('blood_group_id', $blood_group_id)->get();
        // dd( $components );

        $blood_groups_details_for_this_blood_group = BloodGroup::where('id', $blood_group_id)->first();

        return view('Blood_Bank.blood-bank-listing', compact('blood_groups', 'blood_group_id', 'blood_groups_details_for_this_blood_group', 'blood', 'components'));
    }

    public function add_blood($id)
    {
        $id = base64_decode($id);
        $blood_groups_id = BloodGroup::where('id', $id)->first();
        $bloodDonorDetails = BloodDonor::all();
        $catagory = ChargesCatagory::all();
        $unit_type = UnitType::all();
        return view('Blood_Bank.add-blood', compact('bloodDonorDetails', 'catagory', 'unit_type', 'blood_groups_id'));
    }

    public function blood_issue_listing()
    {
        $blood_issue_details = BloodIssue::all();

        return view('Blood_Bank.listing-blood-issue', compact('blood_issue_details'));
    }

    public function save_blood(Request $request)
    {
        $blood = new Blood();
        $blood->blood_group_id     = $request->blood_group_id;
        $blood->blood_donor_id     = $request->blood_donor_id;
        $blood->donate_date        = $request->donate_date;
        $blood->bag                = $request->bag;
        $blood->volume             = $request->volume;
        $blood->unit_type          = $request->unit_type;
        $blood->lot                = $request->lot;
        $blood->charge_catagory_id = $request->charge_category;
        $blood->charge_name        = $request->charge_name;
        $blood->standard_charge    = $request->standard_charges;
        $blood->institution        = $request->institution;
        $blood->total              = $request->total;
        $blood->discount           = $request->discount;
        $blood->tax                = $request->taxid;
        $blood->net_amount         = $request->net_amount;
        $blood->payment_mode       = $request->payment_mode;
        $blood->payment_amount     = $request->payment_amount;
        $blood->note               = $request->note;
        $status = $blood->save();

        if ($status) {
            return redirect()->route('blood-details', ['id' => base64_encode($request->blood_group_id)])->with('success', 'Blood Added Successfully.');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function find_charge_name_by_catagory(Request $request)
    {
        $catagory = Charge::where('charges_catagory_id', $request->catagory_id)->get();

        return response()->json($catagory);
    }

    public function find_standard_charges_by_charge(Request $request)
    {
        $standard_charges = Charge::where('id', $request->charge_id)->first();
        return response()->json($standard_charges);
    }

    public function add_blood_issue_details($blood_group_id, $id, Request $request)
    {

        $blood_id = base64_decode($id);
        $blood_group_id = base64_decode($blood_group_id);
        $blood_groups_id = BloodGroup::where('id', $blood_group_id)->first(); //a
        $blood_details = Blood::where('id', $blood_id)->first();
        $issed_by = User::all();
        $catagory = ChargesCatagory::all();
        $blood_groups = BloodGroup::all();
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $getBag = Blood::where('blood_group_id', $blood_group_id)->get();

        return view('Blood_Bank.add-blood-issue-details', compact('issed_by', 'catagory', 'blood_groups', 'getBag', 'blood_details', 'blood_groups_id', 'blood_id', 'all_patient'));
    }

    public function edit_blood_issue_listing($id)
    {
        $blood_id = base64_decode($id);

        $blood_details = Blood::where('id', $blood_id)->first();
        $issed_by = User::all();
        $catagory = ChargesCatagory::all();
        $blood_groups = BloodGroup::all();
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $getBag = Blood::where('blood_group_id', $blood_group_id)->get();


        return view('Blood_Bank.edit-blood-issue', compact('blood_details', ''));
    }

    public function save_blood_issue_details(Request $request)
    {
        $blood_issue = new BloodIssue();
        $blood_issue->patient_id         = $request->patient_id;
        $blood_issue->blood_id           = $request->blood_id;
        $blood_issue->blood_group_id     = $request->blood_group_id;
        $blood_issue->issue_date         = $request->issue_date;
        $blood_issue->issed_by           = $request->issed_by;
        $blood_issue->reference_name     = $request->reference_name;
        $blood_issue->technician         = $request->technician;
        $blood_issue->blood_group        = $request->blood_group;
        $blood_issue->bag                = $request->bag;
        $blood_issue->blood_qty          = $request->blood_qty;
        $blood_issue->note               = $request->note;
        $status = $blood_issue->save();

        if ($status) {
            return redirect()->route('blood-details', ['id' => base64_encode($request->blood_group_id)])->with('success', 'Blood Added Successfully.');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function add_blood_issue_belling_for_a_patient($blood_group_id, $id, Request $request)
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();


        $blood_id = base64_decode($id);
        $blood_group_id = base64_decode($blood_group_id);
        $blood_groups_id = BloodGroup::where('id', $blood_group_id)->first(); //a
        $blood_details = Blood::where('id', $blood_id)->first();
        $issed_by = User::all();
        $catagory = ChargesCatagory::all();
        $blood_groups = BloodGroup::all();
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $getBag = Blood::where('blood_group_id', $blood_group_id)->get();


        return view('Blood_Bank.add-blood-issue-details', compact('issed_by', 'catagory', 'blood_groups', 'getBag', 'blood_details', 'blood_groups_id', 'blood_id', 'all_patient', 'patient_details_information'));
    }

    public function update_blood_issue_details(Request $request)
    {
        $blood_issue = BloodIssue::where('id', $request->blood_issue_id);
        $blood_issue->patient_id         = $request->patient_id;
        $blood_issue->blood_id           = $request->blood_id;
        $blood_issue->blood_group_id     = $request->blood_group_id;
        $blood_issue->issue_date         = $request->issue_date;
        $blood_issue->issed_by           = $request->issed_by;
        $blood_issue->reference_name     = $request->reference_name;
        $blood_issue->technician         = $request->technician;
        $blood_issue->blood_group        = $request->blood_group;
        $blood_issue->bag                = $request->bag;
        $blood_issue->blood_qty          = $request->blood_qty;
        $blood_issue->note               = $request->note;
        $status = $blood_issue->save();

        if ($status) {
            return redirect()->route('blood-issue-listing', ['id' => base64_encode($request->blood_group_id)])->with('success', 'Blood Issue Updated Successfully.');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }
    public function delete_blood_issue_details($id)
    {
        $id = base64_decode($id);
        BloodIssue::where('id', $id)->first()->delete();
        return redirect()->back()->with('success', 'Blood Issued Deleted Successfully.');
    }
}
