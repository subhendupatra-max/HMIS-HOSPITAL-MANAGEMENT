<?php

namespace App\Http\Controllers\pathology;

use App\Http\Controllers\Controller;
use App\Models\PathologyParameter;
use Illuminate\Http\Request;
use App\Models\PathologyUnit;

class PathologyParameterController extends Controller
{
    public function parameter_details()
    {
        $parameter = PathologyParameter::all();
        $unit = PathologyUnit::all();

        return view('setup.pathology.parameter.parameter-listing', compact('parameter','unit'));
    }

    public function save_parameter_details(Request $request)
    {
        $request->validate([


        ]);

        $status = PathologyParameter::Insert([
            'parameter_name'        => $request->parameter_name,
            'reference_range'       => $request->reference_range,
            'unit_id'               => $request->unit_id,
            'description'           => $request->description,

        ]);

        if ($status) {
            return back()->with('success', " Parameter Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_parameter_details($id)
    {
        $parameter = PathologyParameter::all();
        $editParameter = PathologyParameter::where('id', $id)->first();
        $unit = PathologyUnit::all();

        return view('setup.pathology.parameter.edit-parameter', compact('parameter', 'editParameter','unit'));
    }

    public function update_parameter_details(Request $request)
    {
        $request->validate([
            'parameter_name'         => 'required',

        ]);

        $parameter = PathologyParameter::find($request->id);
        $parameter->parameter_name         = $request->parameter_name;
        $parameter->reference_range        = $request->reference_range;
        $parameter->unit_id                = $request->unit_id;
        $parameter->description            = $request->description;

        $status = $parameter->save();

        if ($status) {
            return redirect()->route('pathology-parameter-details')->with('success', " Parameter Updated Successfully");
        } else {
            return redirect()->route('pathology-parameter-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_parameter_details($id)
    {
        PathologyParameter::find($id)->delete();

        return back()->with('success', "Parameter Deleted Successfully");
    }

}
