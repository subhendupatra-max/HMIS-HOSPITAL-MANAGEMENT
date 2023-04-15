<?php

namespace App\Http\Controllers\radiology;

use App\Http\Controllers\Controller;
use App\Models\RadiologyParameter;
use App\Models\RadiologyUnit;
use Illuminate\Http\Request;

class RadiologyParameterController extends Controller
{
    public function parameter_details()
    {
        $parameter = RadiologyParameter::all();
        $unit = RadiologyUnit::all();

        return view('setup.radiology.parameter.parameter-listing', compact('parameter','unit'));
    }

    public function save_parameter_details(Request $request)
    {
        $request->validate([

            
        ]);

        $status = RadiologyParameter::Insert([
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
        $parameter = RadiologyParameter::all();
        $editParameter = RadiologyParameter::where('id', $id)->first();
        $unit = RadiologyUnit::all();

        return view('setup.radiology.parameter.edit-parameter', compact('parameter', 'editParameter','unit'));
    }

    public function update_parameter_details(Request $request)
    {
        $request->validate([
            'parameter_name'         => 'required',

        ]);

        $parameter = RadiologyParameter::find($request->id);
        $parameter->parameter_name         = $request->parameter_name;
        $parameter->reference_range        = $request->reference_range;
        $parameter->unit_id                = $request->unit_id;
        $parameter->description            = $request->description;

        $status = $parameter->save();

        if ($status) {
            return redirect()->route('radiology-parameter-details')->with('success', " Parameter Updated Successfully");
        } else {
            return redirect()->route('radiology-parameter-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_parameter_details($id)
    {
        RadiologyParameter::find($id)->delete();

        return back()->with('success', "Parameter Deleted Successfully");
    }
}
