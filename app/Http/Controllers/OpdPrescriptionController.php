<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EPrescription;
use App\Models\OpdDetails;
use App\Models\MedicineCatagory;
use App\Models\PathologyTest;
use App\Models\RadiologyTest;
use App\Models\DoseInterval;
use App\Models\DoseDuration;
use App\Models\EPrescriptionMedicine;
use App\Models\EPresPathologyTest;
use App\Models\EPresRadiologyTest;
use App\Models\AllHeader;

class OpdPrescriptionController extends Controller
{
    public function prescription_listing_in_opd($id)
    {
        $opd_id = base64_decode($id);
        // dd($opd_id);
        $opdPrescription =  EPrescription::where('opd_id', $opd_id)->where('section', 'OPD')->paginate(10);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();

        return view('OPD.prescription.prescription-listing', compact('opd_id', 'opdPrescription', 'opd_patient_details'));
    }

    public function add_prescription_in_opd($id)
    {
        $opd_id = base64_decode($id);

        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();

        $opdPrescriptionDetails =  EPrescription::where('opd_id', $opd_id)->where('section', 'OPD')->get();

        $medicine_catagory = MedicineCatagory::all();
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();

        return view('OPD.prescription.add-prescription', compact('opd_id', 'opdPrescriptionDetails', 'opd_patient_details', 'medicine_catagory', 'pathology_test', 'radiology_test', 'DoseInterval', 'DoseDuration'));
    }

    public function save_prescription_in_opd(Request $request)
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


        //SAVE in ipd details
        $opd_prescription = new EPrescription();
        $opd_prescription->patient_id                                    = $request->patient_id;
        $opd_prescription->section                                       = $request->section;
        $opd_prescription->case_id                                       = $request->case_id;
        $opd_prescription->ipd_id                                        = '';
        $opd_prescription->emg_id                                        = '';
        $opd_prescription->opd_id                                        = $request->opd_id;
        $opd_prescription->prescription_date                             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $opd_prescription->note                                        = $request->note;
        $status      =  $opd_prescription->save();


        if ($request->medicine_catagory_id[0] != null) {
            foreach ($request->medicine_catagory_id as $key => $value) {
                $medicine_discharged = new EPrescriptionMedicine();
                $medicine_discharged->e_prescriptions_id   =  $opd_prescription->id;
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
                $pathology_discharged->e_prescriptions_id =  $opd_prescription->id;
                $pathology_discharged->patient_id = $request->patient_id;
                $pathology_discharged->case_id = $request->case_id;
                $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                $pathology_discharged->save();
            }
        }
        if ($request->radiology_test_id[0] != null) {
            foreach ($request->radiology_test_id as $key => $value) {
                $radiolo_discharged = new EPresRadiologyTest();
                $radiolo_discharged->e_prescriptions_id =  $opd_prescription->id;
                $radiolo_discharged->patient_id = $request->patient_id;
                $radiolo_discharged->case_id = $request->case_id;
                $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                $radiolo_discharged->save();
            }
        }
        // DB::commit();
        if ($status) {
            return redirect()->route('prescription-lisitng-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Opd Prescription Added Successfully');
        } else {
            return redirect()->route('add-prescription-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Something went wrong');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }

    public function edit_prescription_in_opd($id, $opd_id)
    {
        $opd_id = base64_decode($opd_id);
        $p_id = base64_decode($id);

        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $opdPrescriptionDetails =  EPrescription::where('id',  $p_id)->where('section', 'OPD')->first();

        $opdPrescriptionMedicineDetails =  EPrescriptionMedicine::where('e_prescriptions_id',  $p_id)->get();
        $opdPrescriptionPathologyDetails =  EPresPathologyTest::where('e_prescriptions_id',  $p_id)->get();
        $opdPrescriptionRadiologyDetails =  EPresRadiologyTest::where('e_prescriptions_id',  $p_id)->get();


        // dd($opdPrescriptionMedicineDetails);
        $medicine_catagory = MedicineCatagory::all();;
        // dd($medicine_catagory);
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();

        return view('OPD.prescription.edit-prescription', compact('opd_id', 'opdPrescriptionDetails', 'opd_patient_details', 'medicine_catagory', 'pathology_test', 'radiology_test', 'DoseInterval', 'DoseDuration', 'opdPrescriptionMedicineDetails', 'opdPrescriptionPathologyDetails', 'opdPrescriptionRadiologyDetails'));
    }

    public function update_prescription_in_opd(Request $request)
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


        //SAVE in ipd details
        $opd_prescription = EPrescription::where('id', $request->id)->first();
        $opd_prescription->patient_id                                    = $request->patient_id;
        $opd_prescription->section                                       = $request->section;
        $opd_prescription->case_id                                       = $request->case_id;
        $opd_prescription->ipd_id                                        = '';
        $opd_prescription->emg_id                                        = '';
        $opd_prescription->opd_id                                        = $request->opd_id;
        $opd_prescription->prescription_date                             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $opd_prescription->note                                        = $request->note;
        $status      =  $opd_prescription->save();


        if ($request->medicine_catagory_id[0] != null) {

            EPrescriptionMedicine::where('e_prescriptions_id', $opd_prescription->id)->first()->delete();

            foreach ($request->medicine_catagory_id as $key => $value) {
                $medicine_discharged = new EPrescriptionMedicine();
                $medicine_discharged->e_prescriptions_id   =  $opd_prescription->id;
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
            EPresPathologyTest::where('e_prescriptions_id', $opd_prescription->id)->first()->delete();
            foreach ($request->pathology_test_id as $key => $value) {
                $pathology_discharged = new EPresPathologyTest();
                $pathology_discharged->e_prescriptions_id =  $opd_prescription->id;
                $pathology_discharged->patient_id = $request->patient_id;
                $pathology_discharged->case_id = $request->case_id;
                $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                $pathology_discharged->save();
            }
        }
        if ($request->radiology_test_id[0] != null) {
            EPresRadiologyTest::where('e_prescriptions_id', $opd_prescription->id)->first()->delete();
            foreach ($request->radiology_test_id as $key => $value) {
                $radiolo_discharged = new EPresRadiologyTest();
                $radiolo_discharged->e_prescriptions_id =  $opd_prescription->id;
                $radiolo_discharged->patient_id = $request->patient_id;
                $radiolo_discharged->case_id = $request->case_id;
                $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                $radiolo_discharged->save();
            }
        }
        // DB::commit();
        if ($status) {
            return redirect()->route('prescription-lisitng-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Opd Prescription Updated Successfully');
        } else {
            return redirect()->route('add-prescription-in-opd', ['id' => base64_encode($request->opd_id)])->with('success', 'Something went wrong');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }
    public function delete_prescription_in_opd($id)
    {
        $p_id = base64_decode($id);
        EPrescription::where('id', $p_id)->first()->delete();
        EPresPathologyTest::where('e_prescriptions_id', $p_id)->get()->delete();
        EPresRadiologyTest::where('e_prescriptions_id', $p_id)->get()->delete();
        EPrescriptionMedicine::where('e_prescriptions_id', $p_id)->get()->delete();

        return redirect()->back()->with('success', 'Prescription Deleted Succesfully');
    }

    public function prescription_view_in_opd($id, $opd_id)
    {
        $id = base64_decode($id);
        $opd_id = base64_decode($opd_id);
        // dd($opd_id);
        $opdPrescription =  EPrescription::where('id', $id)->where('section', 'EMG')->first();
        $EPresPathologyTest = EPresPathologyTest::where('e_prescriptions_id', $id)->get();
        // dd();
        $EPresRadiologyTest = EPresRadiologyTest::where('e_prescriptions_id', $id)->get();
        $EPrescriptionMedicine = EPrescriptionMedicine::where('e_prescriptions_id', $id)->get();

        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();

        return view('OPD.prescription.prescription-view', compact('opd_id', 'opdPrescription', 'opd_patient_details', 'EPrescriptionMedicine', 'EPresPathologyTest', 'EPresRadiologyTest'));
    }

    public function prescription_print_in_opd($id,  $opd_id)
    {
        $id = base64_decode($id);
        $opd_id = base64_decode($opd_id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $opdPrescription =  EPrescription::where('id', $id)->where('section', 'OPD')->first();
        $EPresPathologyTest = EPresPathologyTest::where('e_prescriptions_id', $id)->get();

        $EPresRadiologyTest = EPresRadiologyTest::where('e_prescriptions_id', $id)->get();
        $EPrescriptionMedicine = EPrescriptionMedicine::where('e_prescriptions_id', $id)->get();
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        return view('opd.prescription.print-prescription', compact('opd_id', 'opd_patient_details', 'opdPrescription', 'EPresPathologyTest', 'EPresRadiologyTest', 'EPrescriptionMedicine', 'header_image'));
    }
}
