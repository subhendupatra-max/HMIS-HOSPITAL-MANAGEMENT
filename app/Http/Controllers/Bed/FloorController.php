<?php

namespace App\Http\Controllers\Bed;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{

    public function floor_details()
    {
        $floor = Floor::where('is_active','=',1)->get();
        return view('setup.floor.floor-listing',compact('floor'));
    }

    public function save_floor_details(Request $request)
    {
        $validate = $request->validate([
            'floor_name' => 'required',
        ]);

        $status = Floor::insert([
            'floor_name' => $request->floor_name,
        ]);

        if ($status) {
            return back()->with('success', "Floor Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_floor_details($id, Request $request)
    {
        $floor = Floor::where('is_active','=',1)->get();
        $editFloor = Floor::find($id);
        return view('setup.floor.floor-edit', compact('floor', 'editFloor'));
    }

    public function update_floor_details(Request $request)
    {
        $validate = $request->validate([
            'floor_name' => 'required',
        ]);

        $floor = Floor::find($request->id);
        $floor->floor_name = $request->floor_name;

        $status = $floor->save();

        if ($status) {
            return redirect()->route('floor-details')->with('success', 'Floor Edited Sucessfully');
        } else {
            return redirect()->route('floor-details')->with('error', "Something Went Wrong");
        }
    }


    public function delete_floor_details($id)
    {
        $floor = Floor::where('id',$id)->update(['is_active' => '0', 'is_delete' => '1']);

        return redirect()->route('floor-details')->with('success', 'Floor Deleted Sucessfully');
    }
}
