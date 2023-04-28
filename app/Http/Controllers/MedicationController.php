<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dosage;
use App\Models\MedicationDose;
use App\Models\Medicine;
use App\Models\MedicineCatagory;
use Illuminate\Http\Request;
use App\Models\IpdDetails;

class MedicationController extends Controller
{
    public function show_medicaiton_dose(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        $medication_details = MedicationDose::where('ipd_id', $ipdId)->get();
        return view('Ipd.show-medication-dose', compact('ipd_details', 'medication_details'));
    }

    public function add_medicaiton_dose(Request $request, $ipd_id)
    {
        $ipdId = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipdId)->first();
        return view('Ipd.add-medication-dose', compact('ipd_details'));
    }

    public function save_medicaiton_dose(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'medicine_catagory_id' => 'required',
        ]);

        $medication                             = new MedicationDose();
        $medication->ipd_id                     = $request->ipd_id;
        $medication->date                       = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $medication->time                       = $request->time;
        $medication->medicine_catagory_id       = $request->medicine_catagory_id;
        $medication->medicine_name              = $request->medicine_name;
        $medication->dosage                     = $request->dosage;
        $medication->remarks                    = $request->remarks;
        $status = $medication->save();

        if ($status) {
            return redirect()->route('show-medicaiton-dose', ['ipd_id' => ($request->ipd_id)])->with('success', " Medication Dose Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function find_medicine_name_by_medicine_catagory(Request $request)
    {
        $medicine_name  =  Medicine::where('medicine_catagory', $request->medicine_catagory_id)->get();
        return response()->json($medicine_name);
    }

    public function find_dosage_by_medicine_catagory(Request $request)
    {
        $dosage = Dosage::where('medicine_catagory_id', $request->medicine_catagory_id_for_dose)->get();
        return response()->json($dosage);
    }

    public function find_medication_details(Request $request)
    {
        $edit_medicine_catagory = MedicineCatagory::all();
        $edit_medication_dose_all = MedicationDose::all();
        $edit_medication_dose =  MedicationDose::where('id', $request->medicationDoseId)->first();
        // dd($edit_medication_dose);
        return response()->json(['edit_medication_dose' => $edit_medication_dose, 'edit_medicine_catagory' => $edit_medicine_catagory, 'edit_medication_dose_all' => $edit_medication_dose_all]);
    }

    public function find_medication_name_dose_details(Request $request)
    {
        $medicine_name  =  Medicine::where('medicine_catagory', $request->medicine_catagory_id_for_dose)->get();
        $dosage = Dosage::where('medicine_catagory_id', $request->medicine_catagory_id_for_dose)->get();

        return response()->json(['medicine_name' => $medicine_name, 'dosage' => $dosage]);
    }
}
