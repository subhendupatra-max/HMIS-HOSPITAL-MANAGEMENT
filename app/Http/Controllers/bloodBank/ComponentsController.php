<?php

namespace App\Http\Controllers\bloodBank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\bloodBank\Blood;
use App\Models\bloodBank\Components;
use App\Models\bloodBank\ComponentsName;
use App\Models\bloodBank\UnitType;
use App\Models\bloodBank\ComponentsDetail;

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
}
