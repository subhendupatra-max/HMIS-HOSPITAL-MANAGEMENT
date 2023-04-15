<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bed;
use App\Models\BedGroup;
use App\Models\BedType;
use App\Models\BedUnit;
use App\Models\Department;
use App\Models\Ward;

class BedController extends Controller
{

    public function bed_details()
    {

        $bed = Bed::where('is_active', '=', 1)->get();
        $bedTypeId = BedType::where('is_active', '=', 1)->get();
        $bedGroupId = BedGroup::where('is_active', '=', 1)->get();
        $bedWard = Ward::where('is_active', '=', 1)->get();
        $bedUnitId = BedUnit::where('is_active', '=', 1)->get();
        $departmentId = Department::where('is_active', '=', 1)->get();

        return view('setup.bed.bed-listing', compact('bed','bedWard', 'bedTypeId', 'bedGroupId', 'bedUnitId', 'departmentId'));
    }

    public function save_bed_details(Request $request)
    {
        $request->validate([
            'bed_name' => 'required',
            'bedWard_id' => 'required',
        ]);

        $status = Bed::insert([
            'bed_name' => $request->bed_name,
            'bedType_id' => $request->bedType_id,
            'bedWard_id' => $request->bedWard_id,
            'bedGroup_id' => $request->bedGroup_id,
            'bedUnit_id' => $request->bedUnit_id,
            'department_id' => $request->department_id,
        ]);

        if ($status) {
            return back()->with('success', "Bed Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_bed_details($id)
    {
        $ward = Bed::where('id', $id)->update(['is_active' => '0', 'is_delete' => '1']);
        return redirect()->route('bed-details')->with('success', 'Bed Deleted Sucessfully');
    }

    public function edit_bed_details($id, Request $request)
    {
        $bed = Bed::where('is_active', 1)->get();
        $bedTypeId = BedType::where('is_active', '=', 1)->get();
        $bedGroupId = BedGroup::where('is_active', '=', 1)->get();
        $bedWard = Ward::where('is_active', '=', 1)->get();
        $bedUnitId = BedUnit::where('is_active', '=', 1)->get();
        $departmentId = Department::where('is_active', '=', 1)->get();
        $editBed = Bed::find($id);
        return view('setup.bed.bed-edit', compact('editBed','bedWard' ,'bed', 'bedTypeId', 'bedGroupId', 'bedUnitId', 'departmentId'));
    }

    public function update_bed_details(Request $request)
    {

        $request->validate([
            'bed_name' => 'required',
            'bedWard_id' => 'required',
        ]);

        $bed = Bed::find($request->id);
        $bed->bed_name = $request->bed_name;
        $bed->bedType_id = $request->bedType_id;
        $bed->bedGroup_id = $request->bedGroup_id;
        $bed->bedWard_id = $request->bedWard_id;
        $bed->bedUnit_id = $request->bedUnit_id;
        $bed->department_id = $request->department_id;

        $status = $bed->save();
        if ($status) {
            return redirect()->route('bed-details')->with('success', "Bed Edited Sucessfully");
        } else {
            return redirect()->route('bed-details')->with('error', "Something Went Wrong");
        }
    }
    public function bed_status()
    {
        $bedWard = Ward::where('is_active', '=', 1)->get();
        return view('setup.bed.bed-status', compact('bedWard'));
    }

    public function find_bed_by_ward_in_bed_status(Request $request)
    {
        $bed_ward_id = $request->search_bed_ward;
        $beds = Bed::where('is_active', 1)->where('bedWard_id',$bed_ward_id)->get();
        return response()->json($beds);

    }
}
