<?php

namespace App\Http\Controllers\bloodBank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\bloodBank\Blood;
use App\Models\bloodBank\Components;
use App\Models\bloodBank\ComponentsName;
use App\Models\bloodBank\UnitType;
use App\Models\Patient;
use App\Models\User;
use App\Models\bloodBank\ComponentsDetail;
use App\Models\BloodComponentIssue;

class ComponentsController extends Controller
{
    public function add_blood_components_details($id)
    {
        $id = base64_decode($id);
        $blood_groups_id = BloodGroup::where('id', $id)->first();
        $blood_groups = BloodGroup::all();
        $getBag = Blood::where('blood_group_id', $id)->get();
        $component_name = ComponentsName::all();
        $unit_types = UnitType::all();

        return view('Blood_Bank.blood-components.add-blood-components', compact('blood_groups_id', 'getBag', 'blood_groups', 'component_name', 'unit_types'));
    }

    public function save_blood_components_details(Request $request)
    {
        $component = new Components();
        $component->blood_group_id      = $request->blood_group_id;
        $component->blood_groups        = $request->blood_group;
        $component->bag                 = $request->bag;
        $status = $component->save();

        foreach ($request->componests_id as $key => $detais) {
            $components_details = new ComponentsDetail();
            $components_details->components_id        = $component->id;
            $components_details->components_name_id   = $request->componests_id[$key];
            $components_details->bag                  = $request->bags[$key];
            $components_details->volume               = $request->volumes[$key];
            $components_details->unit_id              = $request->unitTypes[$key];
            $components_details->lot                  = $request->lots[$key];
            $components_details->institution          = $request->institution[$key];
            $status = $components_details->save();
        }

        if ($status) {
            return redirect()->route('blood-details', ['id' => base64_encode($request->blood_group_id)])->with('success', 'Components Added Successfully.');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function add_blood_components_issue_details($blood_group_id, $id, Request $request)
    {
        $components_id  = base64_decode($id);
        $blood_group_id = base64_decode($blood_group_id);
        $blood_groups_id = BloodGroup::where('id', $blood_group_id)->first(); //a
        $blood_details = Components::where('id', $components_id)->first();
        $issed_by = User::all();
        $blood_groups = BloodGroup::all();
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $getBag = Components::where('blood_group_id', $blood_group_id)->get();

        return view('Blood_Bank.blood-components.blood-components-issue', compact('issed_by', 'getBag', 'blood_details', 'blood_groups_id', 'components_id', 'all_patient', 'blood_groups'));
    }

    public function save_blood_components_issue_details(Request $request)
    {
        // dd('hii');
        // dd($request->all());

        $blood_components_issue = new BloodComponentIssue();
        $blood_components_issue->patient_id         = $request->patient_id;
        $blood_components_issue->components_id      = $request->components_id;
        $blood_components_issue->blood_group_id     = $request->blood_group_id;
        $blood_components_issue->issue_date         = $request->issue_date;
        $blood_components_issue->issed_by           = $request->issed_by;
        $blood_components_issue->reference_name     = $request->reference_name;
        $blood_components_issue->technician         = $request->technician;
        $blood_components_issue->blood_group        = $request->blood_group;
        $blood_components_issue->bag                = $request->bag;
        $blood_components_issue->components_qty      = $request->components_qty;
        $blood_components_issue->note               = $request->note;
        $status = $blood_components_issue->save();

        if ($status) {
            return redirect()->route('blood-details', ['id' => base64_encode($request->blood_group_id)])->with('success', 'Blood Components Issued Successfully.');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function add_blood_components_issue_belling_for_a_patient($blood_group_id, $id, Request $request)
    {
        // dd($request->patient_id);
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();

        $components_id = base64_decode($id);
        $blood_group_id = base64_decode($blood_group_id);
        $blood_groups_id = BloodGroup::where('id', $blood_group_id)->first(); //a
        $blood_details = Components::where('id', $components_id)->first();
        $issed_by = User::all();
        $blood_groups = BloodGroup::all();
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $getBag = Components::where('blood_group_id', $blood_group_id)->get();

        return view('Blood_Bank.blood-components.blood-components-issue', compact('issed_by', 'blood_groups', 'getBag', 'blood_details', 'blood_groups_id', 'components_id', 'all_patient', 'patient_details_information'));
    }

    // listing_blood_components_details
    public function listing_blood_components_details()
    {
        $blood_component_issue_details = BloodComponentIssue::all();

        return view('Blood_Bank.listing-blood-components-issue', compact('blood_component_issue_details'));
    }

    public function update_blood_components_issue_details(Request $request)
    {
        // dd('hii');
        // dd($request->all());

        $blood_components_issue = BloodComponentIssue::where('id', $request->blood_components_id);
        $blood_components_issue->patient_id         = $request->patient_id;
        $blood_components_issue->components_id      = $request->components_id;
        $blood_components_issue->blood_group_id     = $request->blood_group_id;
        $blood_components_issue->issue_date         = $request->issue_date;
        $blood_components_issue->issed_by           = $request->issed_by;
        $blood_components_issue->reference_name     = $request->reference_name;
        $blood_components_issue->technician         = $request->technician;
        $blood_components_issue->blood_group        = $request->blood_group;
        $blood_components_issue->bag                = $request->bag;
        $blood_components_issue->components_qty      = $request->components_qty;
        $blood_components_issue->note               = $request->note;
        $status = $blood_components_issue->save();

        if ($status) {
            return redirect()->route('listing-blood-components-details', ['id' => base64_encode($request->blood_group_id)])->with('success', 'Blood Components Issued Updated Successfully.');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function delete_components_issue_details($id)
    {
        $id = base64_decode($id);
        BloodComponentIssue::where('id', $id)->first()->delete();
        return redirect()->back()->with('success', 'Blood Components Issued Deleted Successfully.');
    }
}
