<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SymptomsHead;
use App\Models\SymptomsType;
use Illuminate\Http\Request;

class SymptomsController extends Controller
{
     // symptoms type
    public function symptoms_type_details()
    {
        $symptomsType = SymptomsType::all();
        return view('setup.symptoms.symptoms-type.type-listing', compact('symptomsType'));
    }

    public function save_symptoms_type_details(Request $request)
    {
        $validate = $request->validate([
            'symptoms_type_name' => 'required',
            
        ]);

        $status = SymptomsType::insert([
            'symptoms_type_name' => $request->symptoms_type_name,
           
        ]);

        if ($status) {
            return back()->with('success', "Symptoms Type Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_symptoms_type_details($id, Request $request)
    {
        $symptomsType = SymptomsType::all();
        $editSymptomsType = SymptomsType::find($id);
        return view('setup.symptoms.symptoms-type.edit-type', compact('symptomsType', 'editSymptomsType'));
    }

    public function update_symptoms_type_details(Request $request)
    {
        $validate = $request->validate([
            'symptoms_type_name' => 'required',
            
        ]);

        $department = symptomsType::find($request->id);
        $department->symptoms_type_name = $request->symptoms_type_name;
      

        $status = $department->save();

        if ($status) {
            return redirect()->route('symptoms-type-details')->with('success', 'Symptoms Type Updated Sucessfully');
        } else {
            return redirect()->route('symptoms-type-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_symptoms_type_details($id)
    {
        SymptomsType::where('id',$id)->delete();

        return redirect()->route('symptoms-type-details')->with('success', 'Symptoms Type Deleted Sucessfully');
    }
    // symptoms type

    // symptoms head

    public function symptoms_head_details()
    {
        $symptomsType = SymptomsType::all();
        $symptomsHead = SymptomsHead::all();
        return view('setup.symptoms.symptoms-head.head-listing', compact('symptomsType','symptomsHead'));
    }

    public function save_symptoms_head_details(Request $request)
    {
        $validate = $request->validate([
            'symptoms_head_name' => 'required',
            'symptoms_type' => 'required',
           
        ]);

        $status = SymptomsHead::insert([
            'symptoms_head_name' => $request->symptoms_head_name,
            'symptoms_type' => $request->symptoms_type,
            'description' => $request->description,
        ]);

        if ($status) {
            return back()->with('success', "Symptoms Head Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_symptoms_head_details($id, Request $request)
    {
        $symptomsType = SymptomsType::all();
        $symptomsHead = SymptomsHead::all();
        $editSymptomsHead = SymptomsHead::find($id);
        return view('setup.symptoms.symptoms-head.edit-head', compact('symptomsType', 'editSymptomsHead','symptomsHead'));
    }

    public function update_symptoms_head_details(Request $request)
    {
        $validate = $request->validate([
            'symptoms_head_name' => 'required',
            'symptoms_type' => 'required',
            
        ]);

        $symptomsHead = SymptomsHead::find($request->id);
        $symptomsHead->symptoms_head_name = $request->symptoms_head_name;
        $symptomsHead->symptoms_type = $request->symptoms_type;
        $symptomsHead->description = $request->description;

        $status = $symptomsHead->save();

        if ($status) {
            return redirect()->route('symptoms-head-details')->with('success', 'Symptoms Head Updated Sucessfully');
        } else {
            return redirect()->route('symptoms-head-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_symptoms_head_details($id)
    {
        SymptomsHead::where('id',$id)->delete();

        return redirect()->route('symptoms-head-details')->with('success', 'Symptoms Head Deleted Sucessfully');
    }

    // symptoms head
}
