<?php

namespace App\Http\Controllers\Bed;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Ward;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class WardController extends Controller
{

    public function ward_details()
    {
        $ward = Ward::where('is_active', '=', 1)->get();
        return view('setup.ward.ward-listing', compact('ward'));
    }

    public function save_ward_details(Request $request)
    {
        $request->validate([
            'ward_name' => 'required',
        ]);

        $status = Ward::insert([
            'ward_name' => $request->ward_name,
        ]);

        if ($status) {
            return back()->with('success', "Ward Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_ward_details($id)
    {
        $ward = Ward::where('id', $id)->update(['is_active' => '0', 'is_delete' => '1']);
        return redirect()->route('ward-details')->with('success', 'Ward Deleted Sucessfully');
    }

    public function edit_ward_details($id, Request $request)
    {
        $ward = Ward::where('is_active', 1)->get();
        $editWard = Ward::find($id);
        return view('setup.ward.ward-edit', compact('editWard', 'ward'));
    }

    public function update_ward_details(Request $request)
    {

        $request->validate([
            'ward_name' => 'required',
        ]);

        $ward = Ward::find($request->id);
        $ward->ward_name = $request->ward_name;

        $status = $ward->save();
        if ($status) {
            return redirect()->route('ward-details')->with('success', "Ward Edited Sucessfully");
        } else {
            return redirect()->route('ward-details')->with('error', "Something Went Wrong");
        }
    }
}
