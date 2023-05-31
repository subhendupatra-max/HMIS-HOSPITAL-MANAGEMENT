<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EPrescription;
use App\Models\EmgDetails;
use App\Models\MedicineCatagory;
use App\Models\PathologyTest;
use App\Models\RadiologyTest;
use App\Models\DoseInterval;
use App\Models\DoseDuration;
use App\Models\EPrescriptionMedicine;
use App\Models\EPresPathologyTest;
use App\Models\EPresRadiologyTest;


class EmgPrescriptionController extends Controller
{
    //
    public function prescription_listing_in_emg($id)
    {
        $emg_id = base64_decode($id);
        // dd($emg_id);
        $emgPrescription =  EPrescription::where('emg_id', $emg_id)->where('section', 'EMG')->paginate(10);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();

        return view('emg.prescription.prescription-listing', compact('emg_id', 'emgPrescription', 'emg_patient_details'));
    }

    public function add_prescription_in_emg($id)
    {
        $emg_id = base64_decode($id);

        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();

        $emgPrescriptionDetails =  EPrescription::where('emg_id', $emg_id)->where('section', 'emg')->get();

        $medicine_catagory = MedicineCatagory::all();
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();

        return view('emg.prescription.add-prescription', compact('emg_id', 'emgPrescriptionDetails', 'emg_patient_details', 'medicine_catagory', 'pathology_test', 'radiology_test', 'DoseInterval', 'DoseDuration'));
    }

    public function save_prescription_in_emg(Request $request)
    {
        // dd($request->all());
        // $validate = $request->validate([
        //     'patient_id' => 'required',
        //     'discharge_date' => 'required',
        //     'discharge_status' => 'required',
        //     'icd_code' => 'required',
        // ]);
        // try {
        //     DB::beginTransaction();


        //SAVE in emg details
        $emg_prescription = new EPrescription();
        $emg_prescription->patient_id                                    = $request->patient_id;
        $emg_prescription->section                                       = $request->section;
        $emg_prescription->case_id                                       = $request->case_id;
        $emg_prescription->opd_id                                        = '';
        $emg_prescription->ipd_id                                        = '';
        $emg_prescription->emg_id                                        = $request->emg_id;
        $emg_prescription->prescription_date                             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $emg_prescription->note                                        = $request->note;
        $status      =  $emg_prescription->save();


        if ($request->medicine_catagory_id[0] != null) {
            foreach ($request->medicine_catagory_id as $key => $value) {
                $medicine_discharged = new EPrescriptionMedicine();
                $medicine_discharged->e_prescriptions_id   =  $emg_prescription->id;
                $medicine_discharged->patient_id            = $request->patient_id;
                $medicine_discharged->case_id               = $request->case_id;
                $medicine_discharged->medicine_category_id =  $request->medicine_catagory_id[$key];
                $medicine_discharged->medicine_id = $request->medicine_name[$key];
                $medicine_discharged->dose = $request->dose[$key];
                $medicine_discharged->interval = $request->dose_interval[$key];
                $medicine_discharged->duration = $request->dose_duration[$key];
                $medicine_discharged->status = '';
                $medicine_discharged->save();
            }
        }
        if ($request->pathology_test_id[0] != null) {
            foreach ($request->pathology_test_id as $key => $value) {
                $pathology_discharged = new EPresPathologyTest();
                $pathology_discharged->e_prescriptions_id =  $emg_prescription->id;
                $pathology_discharged->patient_id = $request->patient_id;
                $pathology_discharged->case_id = $request->case_id;
                $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                $pathology_discharged->save();
            }
        }
        if ($request->radiology_test_id[0] != null) {
            foreach ($request->radiology_test_id as $key => $value) {
                $radiolo_discharged = new EPresRadiologyTest();
                $radiolo_discharged->e_prescriptions_id =  $emg_prescription->id;
                $radiolo_discharged->patient_id = $request->patient_id;
                $radiolo_discharged->case_id = $request->case_id;
                $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                $radiolo_discharged->save();
            }
        }
        // DB::commit();
        if ($status) {
            return redirect()->route('prescription-lisitng-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'emg Prescription Added Successfully');
        } else {
            return redirect()->route('add-prescription-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Something went wrong');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }

    public function edit_prescription_in_emg($id, $emg_id)
    {
        $emg_id = base64_decode($emg_id);
        $p_id = base64_decode($id);

        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $emgPrescriptionDetails =  EPrescription::where('id',  $p_id)->where('section', 'EMG')->first();

        $emgPrescriptionMedicineDetails =  EPrescriptionMedicine::where('e_prescriptions_id',  $p_id)->get();
        $emgPrescriptionPathologyDetails =  EPresPathologyTest::where('e_prescriptions_id',  $p_id)->get();
        $emgPrescriptionRadiologyDetails =  EPresRadiologyTest::where('e_prescriptions_id',  $p_id)->get();


        // dd($emgPrescriptionMedicineDetails);
        $medicine_catagory = MedicineCatagory::all();
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();

        return view('emg.prescription.edit-prescription', compact('emg_id', 'emgPrescriptionDetails', 'emg_patient_details', 'medicine_catagory', 'pathology_test', 'radiology_test', 'DoseInterval', 'DoseDuration', 'emgPrescriptionMedicineDetails', 'emgPrescriptionPathologyDetails', 'emgPrescriptionRadiologyDetails'));
    }

    public function update_prescription_in_emg(Request $request)
    {
        // dd($request->all());
        // $validate = $request->validate([
        //     'patient_id' => 'required',
        //     'discharge_date' => 'required',
        //     'discharge_status' => 'required',
        //     'icd_code' => 'required',
        // ]);
        // try {
        //     DB::beginTransaction();


        //SAVE in emg details
        $emg_prescription = EPrescription::where('id', $request->id)->first();
        $emg_prescription->patient_id                                    = $request->patient_id;
        $emg_prescription->section                                       = $request->section;
        $emg_prescription->case_id                                       = $request->case_id;
        $emg_prescription->opd_id                                        = '';
        $emg_prescription->ipd_id                                        = '';
        $emg_prescription->emg_id                                        = $request->emg_id;
        $emg_prescription->prescription_date                             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $emg_prescription->note                                        = $request->note;
        $status      =  $emg_prescription->save();


        if ($request->medicine_catagory_id[0] != null) {

            EPrescriptionMedicine::where('e_prescriptions_id', $emg_prescription->id)->first()->delete();

            foreach ($request->medicine_catagory_id as $key => $value) {
                $medicine_discharged = new EPrescriptionMedicine();
                $medicine_discharged->e_prescriptions_id   =  $emg_prescription->id;
                $medicine_discharged->patient_id            = $request->patient_id;
                $medicine_discharged->case_id               = $request->case_id;
                $medicine_discharged->medicine_category_id =  $request->medicine_catagory_id[$key];
                $medicine_discharged->medicine_id = $request->medicine_name[$key];
                $medicine_discharged->dose = $request->dose[$key];
                $medicine_discharged->interval = $request->dose_interval[$key];
                $medicine_discharged->duration = $request->dose_duration[$key];
                $medicine_discharged->status = '';
                $medicine_discharged->save();
            }
        }
        if ($request->pathology_test_id[0] != null) {
            EPresPathologyTest::where('e_prescriptions_id', $emg_prescription->id)->first()->delete();
            foreach ($request->pathology_test_id as $key => $value) {
                $pathology_discharged = new EPresPathologyTest();
                $pathology_discharged->e_prescriptions_id =  $emg_prescription->id;
                $pathology_discharged->patient_id = $request->patient_id;
                $pathology_discharged->case_id = $request->case_id;
                $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                $pathology_discharged->save();
            }
        }
        if ($request->radiology_test_id[0] != null) {
            EPresRadiologyTest::where('e_prescriptions_id', $emg_prescription->id)->first()->delete();
            foreach ($request->radiology_test_id as $key => $value) {
                $radiolo_discharged = new EPresRadiologyTest();
                $radiolo_discharged->e_prescriptions_id =  $emg_prescription->id;
                $radiolo_discharged->patient_id = $request->patient_id;
                $radiolo_discharged->case_id = $request->case_id;
                $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                $radiolo_discharged->save();
            }
        }
        // DB::commit();
        if ($status) {
            return redirect()->route('prescription-lisitng-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Opd Prescription Updated Successfully');
        } else {
            return redirect()->route('add-prescription-in-emg', ['id' => base64_encode($request->emg_id)])->with('success', 'Something went wrong');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }

    public function delete_prescription_in_emg($id)
    {
        $p_id = base64_decode($id);
        EPrescription::where('id', $p_id)->first()->delete();
        EPresPathologyTest::where('e_prescriptions_id', $p_id)->get()->delete();
        EPresRadiologyTest::where('e_prescriptions_id', $p_id)->get()->delete();
        EPrescriptionMedicine::where('e_prescriptions_id', $p_id)->get()->delete();

        return redirect()->back()->with('success', 'Prescription Deleted Succesfully');
    }

    public function prescription_view_in_emg($id, $emg_id)
    {
        $id = base64_decode($id);
        $emg_id = base64_decode($emg_id);
        // dd($emg_id);
        $emgPrescription =  EPrescription::where('id', $id)->where('section', 'EMG')->first();
        $EPresPathologyTest =EPresPathologyTest::where('e_prescriptions_id', $id)->get();
        // dd();
        $EPresRadiologyTest= EPresRadiologyTest::where('e_prescriptions_id', $id)->get();
        $EPrescriptionMedicine = EPrescriptionMedicine::where('e_prescriptions_id', $id)->get();

        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();

        return view('emg.prescription.prescription-view', compact('emg_id', 'emgPrescription', 'emg_patient_details','EPrescriptionMedicine','EPresPathologyTest','EPresRadiologyTest'));
    }
}
