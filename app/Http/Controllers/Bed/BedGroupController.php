<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Models\BedGroup;
use Illuminate\Http\Request;

class BedGroupController extends Controller
{

    public function bedgroup_details()
    {
        $bedgroup = BedGroup::where('is_active', '=', 1)->get();
        return view('setup.bedgroup.bedgroup-listing', compact('bedgroup'));
    }

    public function save_bedgroup_details(Request $request)
    {
        $request->validate([
            'bedGroup_name' => 'required',
        ]);

        $status = BedGroup::insert([
            'bedGroup_name' => $request->bedGroup_name,
        ]);

        if ($status) {
            return back()->with('success', "BedGroup Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_bedgroup_details($id)
    {
        $bedgroup = BedGroup::where('id', $id)->update(['is_active' => '0', 'is_delete' => '1']);
        return redirect()->route('bedgroup-details')->with('success', 'BedGroup Deleted Sucessfully');
    }

    public function edit_bedgroup_details($id, Request $request)
    {
        $bedgroup = BedGroup::where('is_active', 1)->get();
        $editBedGroup = BedGroup::find($id);
        return view('setup.bedgroup.bedgroup-edit', compact('editBedGroup', 'bedgroup'));
    }

    public function update_bedgroup_details(Request $request)
    {

        $request->validate([
            'bedGroup_name' => 'required',
        ]);

        $bedgroup = BedGroup::find($request->id);
        $bedgroup->bedGroup_name = $request->bedGroup_name;

        $status = $bedgroup->save();
        if ($status) {
            return redirect()->route('bedgroup-details')->with('success', "BedGroup Edited Sucessfully");
        } else {
            return redirect()->route('bedgroup-details')->with('error', "Something Went Wrong");
        }
    }
}
