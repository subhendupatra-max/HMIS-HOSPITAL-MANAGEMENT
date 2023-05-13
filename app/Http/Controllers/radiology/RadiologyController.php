<?php

namespace App\Http\Controllers\radiology;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChargesCatagory;
use App\Models\RadiologyCatagory;
use App\Models\Charge;
use App\Models\RadiologyTest;
use App\Models\RadiologyParameter;
use App\Models\RadiologyUnit;
use App\Models\Patient;
use App\Models\OpdDetails;
use App\Models\IpdDetails;
use App\Models\EmgDetails;
use App\Models\CaseReference;
use App\Models\RadiologyPatientTest;
use Auth;
use App\Models\RadiologyTestMaster;
use DB;
use App\Models\RadiologyTestDetails;
use App\Models\RadiologyTestMasterDetails;
use App\Models\RadiologyTestWithParameters;
use App\Models\TestWithParameterInRadiology;

class RadiologyController extends Controller
{
    // public function radiology_details()
    // {
    //     return view('radiology.radiology-listing');
    // }

    public function radiology_test_charge()
    {
        $radiology_patient_test = RadiologyPatientTest::where('ins_by', 'ori')->get();
        return view('radiology.patient-test.patient-test-list', compact('radiology_patient_test'));
    }

    public function radiology_test_charge_add()
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $radiology_all_test = RadiologyTest::all();
        return view('radiology.patient-test.patient-test-add', compact('all_patient', 'radiology_all_test'));
    }


    public function add_radiology_charges_for_a_patient(Request $request)
    {
        // dd($request->patient_id);
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $radiology_all_test = RadiologyTest::all();
        $patient_reg_details = CaseReference::where('patient_id', $request->patient_id)->orderBy('id', 'desc')->first();
        return view('radiology.patient-test.patient-test-add', compact('all_patient', 'patient_details_information', 'radiology_all_test', 'patient_reg_details'));
    }

    public function save_radiology_charge(Request $request)
    {
        $validate = $request->validate([
            'date'   => 'required',
            'test_id'   => 'required',
            'patientId'   => 'required',
        ]);
        // try {
        //     DB::beginTransaction();
        $radiology_patient_test = new RadiologyPatientTest();
        // dd($request->case_id);
        $case_details = caseReference::where('id', $request->case_id)->first();
        if ($case_details->section == 'OPD') {
            $section_details = OpdDetails::where('case_id', $request->case_id)->first();
            $radiology_patient_test->opd_id = $section_details->id;
        } elseif ($case_details->section == 'EMG') {
            $section_details = EmgDetails::where('case_id', $request->case_id)->first();
            $radiology_patient_test->emg_id = $section_details->id;
        } else {
            $section_details = IpdDetails::where('case_id', $request->case_id)->first();
            $radiology_patient_test->ipd_id = $section_details->id;
        }

        $radiology_patient_test->case_id = $request->case_id;
        $radiology_patient_test->date = $request->date;
        $radiology_patient_test->section = $case_details->section;
        $radiology_patient_test->patient_id = $request->patientId;
        $radiology_patient_test->test_id = $request->test_id;
        $radiology_patient_test->generated_by = Auth::user()->id;
        $radiology_patient_test->billing_status = '0';
        $radiology_patient_test->test_status = '<span class="badge badge-warning">Sample Not Collected</span>';
        $radiology_patient_test->save();

        DB::commit();
        return redirect()->route('radiology-test-charge')->with('success', "Test Added Successfully");
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('radiology-test-charge')->withErrors(['error' => $th->getMessage()]);
        // }
    }






    //pathology test
    public function radiology_test_list()
    {
        $all_test = RadiologyTest::all();
        return view('pathology.test.list', compact('all_test'));
    }

    public function add_radiology_test()
    {
        $catagory       = RadiologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $all_test      = RadiologyParameter::all();

        return view('radiology.test.add', compact('catagory', 'chargeCatagory', 'all_test'));
    }

    public function save_radiology_test(Request $request)
    {
        $request->validate([
            'test_name'                         => 'required',
            'test_type'                         => 'required',
            'catagory_id'                       => 'required',
            'sub_catagory'                      => 'required',
            'report_days'                       => 'required',
            'charge_category'                   => 'required',
            'charge_sub_category'               => 'required',
            'charge'                            => 'required',
            'tax'                               => 'required',
            'standard_charges'                  => 'required',
            'total_amount'                      => 'required',
        ]);

        $radiology_test = new RadiologyTest();

        $radiology_test->test_name                       = $request->test_name;
        $radiology_test->short_name                      = $request->short_name;
        $radiology_test->test_type                       = $request->test_type;
        $radiology_test->catagory_id                     = $request->catagory_id;
        $radiology_test->sub_catagory                    = $request->sub_catagory;
        $radiology_test->method                          = $request->method;
        $radiology_test->report_days                     = $request->report_days;
        $radiology_test->charge_category                 = $request->charge_category;
        $radiology_test->charge_sub_category             = $request->charge_sub_category;
        $radiology_test->charge                          = $request->charge;
        $radiology_test->tax                             = $request->tax;
        $radiology_test->standard_charges                = $request->standard_charges;
        $radiology_test->total_amount                    = $request->total_amount;
        $radiology_test->save();

        for ($i = 0; $i < count($request->master_test_name); $i++) {
            $status = RadiologyTestDetails::insert([
                'radiology_test_id'                                  => $radiology_test->id,
                'radiology_master_test_id'                           => $request->master_test_name[$i],
            ]);
        }

        if ($status) {
            return redirect()->route('radiology-test-list')->with('success', 'Test Added Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }


    //====================================== pathology test master =========================================
    public function radiology_test_master_details()
    {
        $radiologyTest = RadiologyTestMaster::all();
        return view('radiology.test-master.radiology-test-master-listing', compact('radiologyTest'));
    }

    public function add_radiology_test_master_details()
    {

        $catagory       = RadiologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $parameter      = RadiologyParameter::all();

        return view('radiology.test-master.add-radiology-test-master', compact('catagory', 'chargeCatagory', 'parameter'));
    }

    public function save_radiology_test_master_details(Request $request)
    {
        $request->validate([
            'test_name'                         => 'required',
        ]);

        $PathologyTestMaster = new RadiologyTestMaster();
        $PathologyTestMaster->test_name                       = $request->test_name;
        $PathologyTestMaster->test_details                    = $request->test_details;
        $status = $PathologyTestMaster->save();
        if (isset($request->test_parameter_name)) {
            for ($i = 0; $i < count($request->test_parameter_name); $i++) {
                $status = RadiologyTestMasterDetails::insert([
                    'radiology_test_master_id'                     => $PathologyTestMaster->id,
                    'radiology_parameter_id'                => $request->test_parameter_name[$i],
                    'reference_range'                       => '',
                    'unit'                                  => '',
                ]);
            }
        }
        if ($status) {
            return redirect()->route('radiology-test-master-details')->with('success', 'Test Master Added Sucessfully');
        } else {
            return redirect()->route('radiology-test-master-details')->with('error', "Something Went Wrong");
        }
    }

    public function find_range_by_parameter(Request $request)
    {
        $range_value = RadiologyParameter::where('id', $request->parameter_id)->first();
        $unit_value = RadiologyUnit::where('id', $range_value->unit_id)->first();
        return response()->json(['range_value' => $range_value, 'unit_value' => $unit_value]);
    }

    public function view_radiology_test_details($id)
    {
        $radiologyTest = RadiologyTest::find($id);
        $radiologyParameter = TestWithParameterInRadiology::where('radiology_test_id', $id)->get();
        return view('radiology.test-master.radiology-test-details', compact('radiologyTest', 'radiologyParameter'));
    }

    public function edit_radiology_test_patient($id)
    {
        $test_id = base64_decode($id);
        $test_details = RadiologyPatientTest::where('id', $test_id)->first();
        // dd($test_details );
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $test_details->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $radiology_all_test = RadiologyTest::all();
        $patient_reg_details = caseReference::where('patient_id', $test_details->patient_id)->orderBy('id', 'desc')->first();
        return view('radiology.patient-test.patient-test-edit', compact('test_details', 'all_patient', 'patient_details_information', 'radiology_all_test', 'patient_reg_details'));
    }

    public function update_radiology_charge(Request $request)
    {
        $validate = $request->validate([
            'date'   => 'required',
            'test_id'   => 'required',
            'patientId'   => 'required',
        ]);
        try {
            DB::beginTransaction();
            $radiology_patient_test = RadiologyPatientTest::find($request->pre_test_id);

            $radiology_patient_test->date = $request->date;
            $radiology_patient_test->test_id = $request->test_id;
            $radiology_patient_test->save();

            DB::commit();
            return redirect()->route('radiology-test-charge')->with('success', "Test Upadated Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('radiology-test-charge')->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete_radiology_test_patient($id)
    {
        try {
            DB::beginTransaction();
            $test_id = base64_decode($id);
            $test_details = RadiologyPatientTest::where('id', $test_id)->delete();
            DB::commit();
            return redirect()->route('radiology-test-charge')->with('success', "Test Deleted Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('radiology-test-charge')->withErrors(['error' => $th->getMessage()]);
        }
    }

    // public function add_radiology_test_details()
    // {

    //     $catagory       = RadiologyCatagory::all();
    //     $chargeCatagory = ChargesCatagory::all();
    //     $parameter      = RadiologyParameter::all();

    //     return view('radiology.test-radiology.add-radiology-test', compact('catagory', 'chargeCatagory', 'parameter'));
    // }

    // public function save_radiology_test_details(Request $request)
    // {
    //     $request->validate([
    //         'test_name'                         => 'required',
    //         'test_type'                         => 'required',
    //         'catagory_id'                       => 'required',
    //         'sub_catagory'                      => 'required',
    //         'report_days'                       => 'required',
    //         'charge_category'                   => 'required',
    //         'charge_sub_category'               => 'required',
    //         'charge'                            => 'required',
    //         'tax'                               => 'required',
    //         'standard_charges'                  => 'required',
    //         'total_amount'                      => 'required',
    //     ]);

    //     $status = RadiologyTest::insert([
    //         'test_name'                       => $request->test_name,
    //         'short_name'                      => $request->short_name,
    //         'test_type'                       => $request->test_type,
    //         'catagory_id'                     => $request->catagory_id,
    //         'sub_catagory'                    => $request->sub_catagory,
    //         'method'                          => $request->method,
    //         'report_days'                     => $request->report_days,
    //         'charge_category'                 => $request->charge_category,
    //         'charge_sub_category'             => $request->charge_sub_category,
    //         'charge'                          => $request->charge,
    //         'tax'                             => $request->tax,
    //         'standard_charges'                => $request->standard_charges,
    //         'total_amount'                    => $request->total_amount,

    //     ]);

    //     for ($i = 0; $i < count($request->test_parameter_name); $i++) {
    //         $status = RadiologyTestWithParameters::insert([
    //             'pathology_test_id'                     => $status->id,
    //             'pathology_parameter_id'                => $request->test_parameter_name[$i],
    //             'reference_range'                       => '',
    //             'unit'                                  => '',
    //             'formula'                               => $request->formula[$i],
    //         ]);
    //     }


    //     if ($status) {
    //         return redirect()->route('radiology-test-details')->with('success', 'Test Added Sucessfully');
    //     } else {
    //         return redirect()->route('radiology-test-details')->with('error', "Something Went Wrong");
    //     }
    // }
}
