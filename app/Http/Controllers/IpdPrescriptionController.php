<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EPrescription;
use App\Models\IpdDetails;
use App\Models\MedicineCatagory;
use App\Models\PathologyTest;
use App\Models\RadiologyTest;
use App\Models\DoseInterval;
use App\Models\DoseDuration;
use App\Models\EPrescriptionMedicine;
use App\Models\EPresPathologyTest;
use App\Models\EPresRadiologyTest;
use App\Models\AllHeader;


class IpdPrescriptionController extends Controller
{
    public function prescription_listing_in_ipd($id)
    {
        $ipd_id = base64_decode($id);
        // dd($ipd_id);
        $ipdPrescription =  EPrescription::where('ipd_id', $ipd_id)->where('section', 'IPD')->paginate(10);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();

        return view('Ipd.prescription.prescription-listing', compact('ipd_id', 'ipdPrescription', 'ipd_details'));
    }

    public function add_prescription_in_ipd($id)
    {
        $ipd_id = base64_decode($id);

        $ipd_details = IpdDetails::where('id', $ipd_id)->first();

        $ipdPrescriptionDetails =  EPrescription::where('ipd_id', $ipd_id)->where('section', 'IPD')->get();

        $medicine_catagory = MedicineCatagory::all();
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();

        return view('IPD.prescription.add-prescription', compact('ipd_id', 'ipdPrescriptionDetails', 'ipd_details', 'medicine_catagory', 'pathology_test', 'radiology_test', 'DoseInterval', 'DoseDuration'));
    }

    public function save_prescription_in_ipd(Request $request)
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
        $ipd_prescription = new EPrescription();
        $ipd_prescription->patient_id                                    = $request->patient_id;
        $ipd_prescription->section                                       = $request->section;
        $ipd_prescription->case_id                                       = $request->case_id;
        $ipd_prescription->opd_id                                        = '';
        $ipd_prescription->emg_id                                        = '';
        $ipd_prescription->ipd_id                                        = $request->ipd_id;
        $ipd_prescription->prescription_date                             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $ipd_prescription->note                                        = $request->note;
        $status      =  $ipd_prescription->save();


        if ($request->medicine_catagory_id[0] != null) {
            foreach ($request->medicine_catagory_id as $key => $value) {
                $medicine_discharged = new EPrescriptionMedicine();
                $medicine_discharged->e_prescriptions_id   =  $ipd_prescription->id;
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
                $pathology_discharged->e_prescriptions_id =  $ipd_prescription->id;
                $pathology_discharged->patient_id = $request->patient_id;
                $pathology_discharged->case_id = $request->case_id;
                $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                $pathology_discharged->save();
            }
        }
        if ($request->radiology_test_id[0] != null) {
            foreach ($request->radiology_test_id as $key => $value) {
                $radiolo_discharged = new EPresRadiologyTest();
                $radiolo_discharged->e_prescriptions_id =  $ipd_prescription->id;
                $radiolo_discharged->patient_id = $request->patient_id;
                $radiolo_discharged->case_id = $request->case_id;
                $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                $radiolo_discharged->save();
            }
        }
        // DB::commit();
        if ($status) {
            return redirect()->route('prescription-lisitng-in-ipd', ['id' => base64_encode($request->ipd_id)])->with('success', 'Ipd Prescription Added Successfully');
        } else {
            return redirect()->route('add-prescription-in-ipd', ['id' => base64_encode($request->ipd_id)])->with('success', 'Something went wrong');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }

    public function edit_prescription_in_ipd($id, $ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $p_id = base64_decode($id);

        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipdPrescriptionDetails =  EPrescription::where('id',  $p_id)->where('section', 'IPD')->first();

        $ipdPrescriptionMedicineDetails =  EPrescriptionMedicine::where('e_prescriptions_id',  $p_id)->get();
        $ipdPrescriptionPathologyDetails =  EPresPathologyTest::where('e_prescriptions_id',  $p_id)->get();
        $ipdPrescriptionRadiologyDetails =  EPresRadiologyTest::where('e_prescriptions_id',  $p_id)->get();


        // dd($ipdPrescriptionMedicineDetails);
        $medicine_catagory = MedicineCatagory::all();
        $pathology_test = PathologyTest::all();
        $radiology_test = RadiologyTest::all();
        $DoseInterval = DoseInterval::all();
        $DoseDuration = DoseDuration::all();

        return view('Ipd.prescription.edit-prescription', compact('ipd_id', 'ipdPrescriptionDetails', 'ipd_details', 'medicine_catagory', 'pathology_test', 'radiology_test', 'DoseInterval', 'DoseDuration', 'ipdPrescriptionMedicineDetails', 'ipdPrescriptionPathologyDetails', 'ipdPrescriptionRadiologyDetails'));
    }

    public function update_prescription_in_ipd(Request $request)
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
        $ipd_prescription = EPrescription::where('id', $request->id)->first();
        $ipd_prescription->patient_id                                    = $request->patient_id;
        $ipd_prescription->section                                       = $request->section;
        $ipd_prescription->case_id                                       = $request->case_id;
        $ipd_prescription->opd_id                                        = '';
        $ipd_prescription->emg_id                                        = '';
        $ipd_prescription->ipd_id                                        = $request->ipd_id;
        $ipd_prescription->prescription_date                             = \Carbon\Carbon::parse($request->date)->format('Y-m-d h:m:s');
        $ipd_prescription->note                                        = $request->note;
        $status      =  $ipd_prescription->save();


        if ($request->medicine_catagory_id[0] != null) {

            EPrescriptionMedicine::where('e_prescriptions_id', $ipd_prescription->id)->first()->delete();

            foreach ($request->medicine_catagory_id as $key => $value) {
                $medicine_discharged = new EPrescriptionMedicine();
                $medicine_discharged->e_prescriptions_id   =  $ipd_prescription->id;
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
            EPresPathologyTest::where('e_prescriptions_id', $ipd_prescription->id)->first()->delete();
            foreach ($request->pathology_test_id as $key => $value) {
                $pathology_discharged = new EPresPathologyTest();
                $pathology_discharged->e_prescriptions_id =  $ipd_prescription->id;
                $pathology_discharged->patient_id = $request->patient_id;
                $pathology_discharged->case_id = $request->case_id;
                $pathology_discharged->test_id =  $request->pathology_test_id[$key];
                $pathology_discharged->save();
            }
        }
        if ($request->radiology_test_id[0] != null) {
            EPresRadiologyTest::where('e_prescriptions_id', $ipd_prescription->id)->first()->delete();
            foreach ($request->radiology_test_id as $key => $value) {
                $radiolo_discharged = new EPresRadiologyTest();
                $radiolo_discharged->e_prescriptions_id =  $ipd_prescription->id;
                $radiolo_discharged->patient_id = $request->patient_id;
                $radiolo_discharged->case_id = $request->case_id;
                $radiolo_discharged->test_id =  $request->radiology_test_id[$key];
                $radiolo_discharged->save();
            }
        }
        // DB::commit();
        if ($status) {
            return redirect()->route('prescription-lisitng-in-ipd', ['id' => base64_encode($request->ipd_id)])->with('success', 'Opd Prescription Updated Successfully');
        } else {
            return redirect()->route('add-prescription-in-ipd', ['id' => base64_encode($request->ipd_id)])->with('success', 'Something went wrong');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }

    public function delete_prescription_in_ipd($id)
    {
        $p_id = base64_decode($id);
        EPrescription::where('id', $p_id)->first()->delete();
        EPresPathologyTest::where('e_prescriptions_id', $p_id)->delete();
        EPresRadiologyTest::where('e_prescriptions_id', $p_id)->delete();
        EPrescriptionMedicine::where('e_prescriptions_id', $p_id)->delete();

        return redirect()->back()->with('success', 'Prescription Deleted Succesfully');
    }

    public function prescription_view_in_ipd($id, $ipd_id)
    {
        $id = base64_decode($id);
        $ipd_id = base64_decode($ipd_id);
        // dd($ipd_id);
        $ipdPrescription =  EPrescription::where('id', $id)->where('section', 'EMG')->first();
        $EPresPathologyTest = EPresPathologyTest::where('e_prescriptions_id', $id)->get();
        // dd();
        $EPresRadiologyTest = EPresRadiologyTest::where('e_prescriptions_id', $id)->get();
        $EPrescriptionMedicine = EPrescriptionMedicine::where('e_prescriptions_id', $id)->get();

        $ipd_details = IpdDetails::where('id', $ipd_id)->first();

        return view('Ipd.prescription.prescription-view', compact('ipd_id', 'ipdPrescription', 'ipd_details', 'EPrescriptionMedicine', 'EPresPathologyTest', 'EPresRadiologyTest'));
    }

    public function prescription_print_in_ipd($id,  $ipd_id)
    {
        $id = base64_decode($id);
        $ipd_id = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipdPrescription =  EPrescription::where('id', $id)->where('section', 'IPD')->first();
        $EPresPathologyTest = EPresPathologyTest::where('e_prescriptions_id', $id)->get();
        // dd($EPresPathologyTest);
        $EPresRadiologyTest = EPresRadiologyTest::where('e_prescriptions_id', $id)->get();
        $EPrescriptionMedicine = EPrescriptionMedicine::where('e_prescriptions_id', $id)->get();
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        return view('Ipd.prescription.print-prescription', compact('ipd_id', 'ipd_details', 'ipdPrescription', 'EPresPathologyTest', 'EPresRadiologyTest', 'EPrescriptionMedicine','header_image'));
    }
}
