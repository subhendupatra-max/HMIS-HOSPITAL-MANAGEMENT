<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChargesCatagory;
use App\Models\PathologyCatagory;
use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\PathologyGroupTest;
use App\Models\PathologyGroupTestDetails;
use App\Models\PathologyTest;
use App\Models\PathologyParameter;
use App\Models\PathologyTestDetails;
use App\Models\PathologyTestMaster;
use App\Models\PathologyTestMasterDetails;
use App\Models\PathologyUnit;
use App\Models\Patient;
use App\Models\caseReference;
use App\Models\TestWithParameter;
use App\Models\PathologyBilling;
use App\Models\PathologyBillingDetails;
use App\Models\Prefix;
use Auth;
use App\Models\PatientCharge;
use App\Models\PathologyCharge;
use App\Models\IpdDetails;
use App\Models\OpdDetails;
use App\Models\EmgDetails;
use App\Models\PathologyPatientTest;
use Illuminate\Support\Facades\DB;

class PathologyController extends Controller
{
    // ======================== Pathology Billing =============================
    public function pathology_billing_list()
    {
        $pathology_bill_details = PathologyBilling::orderBy('id', 'desc')->get();
        return view('pathology.pathology-billing-list', compact('pathology_bill_details'));
    }
    public function add_pathology_bill()
    {
        $pathology_all_test = PathologyTest::all();
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        return view('pathology.pathology-add-billing', compact('all_patient', 'pathology_all_test'));
    }
    public function find_test_amount_by_test(Request $request)
    {
        $test_amount = PathologyTest::find($request->testId);
        return response()->json($test_amount);
    }
    public function add_pathology_billing_for_a_patient(Request $request)
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $pathology_all_test = PathologyTest::all();
        $patient_reg_details = caseReference::where('patient_id', $request->patient_id)->orderBy('id', 'desc')->first();
        return view('pathology.pathology-add-billing', compact('all_patient', 'patient_details_information', 'pathology_all_test', 'patient_reg_details'));
    }
    public function save_pathology_billing(Request $request)
    {
        //dd($request->all());
        request()->validate(
            [
                'billing_date' => 'required',
                'patientId' => 'required',
                'total' => 'required',

            ],
            [
                'patientId.required' => 'Please Select a Patient!!',
                'total.required' => 'Please Calculate!!',
            ]
        );

        try {
            DB::beginTransaction();
            $billing_prefix = Prefix::where('name', 'pathology_bill')->first();
            $bill = new PathologyBilling;
            $bill->bill_prefix = $billing_prefix->prefix;
            $bill->bill_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
            $bill->patient_id = $request->patientId;
            $bill->section = $request->section;
            $bill->case_id = $request->case_id;
            $bill->total_amount = $request->total;
            $bill->payment_status = '';
            $bill->status =  'Done';
            $bill->created_by = Auth::user()->id;
            $bill->note = $request->note;
            $bill->save();

            foreach ($request->test_id as $key => $value) {
                $patient_charge = new PathologyBillingDetails();
                $patient_charge->pathology_billing_id = $bill->id;
                $patient_charge->pathology_id = $request->test_id[$key];
                $patient_charge->charge_amount = $request->charge[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->status = '';
                $patient_charge->save();
            }
            DB::commit();
            return redirect()->route('pathology-details')->with('success', "Pathology Bill Successfully Created");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('add-pathology-billing')->with('error', "Something Went Wrong");
        }
    }
    // ======================== Pathology Billing =============================

    public function pathology_test_details()
    {
        $pathologyTest = PathologyTest::all();
        return view('pathology.test-master.pathology-test-master-listing', compact('pathologyTest'));
    }

    //====================================== pathology test master =========================================
    public function pathology_test_master_details()
    {
        $pathologyTest = PathologyTestMaster::all();
        return view('pathology.test-master.pathology-test-master-listing', compact('pathologyTest'));
    }

    public function add_pathology_test_master_details()
    {

        $catagory       = PathologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $parameter      = PathologyParameter::all();

        return view('pathology.test-master.add-pathology-test-master', compact('catagory', 'chargeCatagory', 'parameter'));
    }
    public function save_pathology_test_master_details(Request $request)
    {
        $request->validate([
            'test_name'                         => 'required',
        ]);

        $PathologyTestMaster = new PathologyTestMaster();

        $PathologyTestMaster->test_name                       = $request->test_name;
        $PathologyTestMaster->test_details                    = $request->test_details;
        $status = $PathologyTestMaster->save();
        if (isset($request->test_parameter_name)) {
            for ($i = 0; $i < count($request->test_parameter_name); $i++) {
                $status = PathologyTestMasterDetails::insert([
                    'pathology_test_master_id'                     => $PathologyTestMaster->id,
                    'pathology_parameter_id'                => $request->test_parameter_name[$i],
                    'reference_range'                       => '',
                    'unit'                                  => '',
                ]);
            }
        }
        if ($status) {
            return redirect()->route('pathology-test-master-details')->with('success', 'Test Master Added Sucessfully');
        } else {
            return redirect()->route('pathology-test-master-details')->with('error', "Something Went Wrong");
        }
    }

    //====================================== pathology test master =========================================


    // public function save_pathology_test_details(Request $request)
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

    //     $pathology_test = new PathologyTest;

    //     $pathology_test->test_name                       = $request->test_name;
    //     $pathology_test->short_name                      = $request->short_name;
    //     $pathology_test->test_type                       = $request->test_type;
    //     $pathology_test->catagory_id                     = $request->catagory_id;
    //     $pathology_test->sub_catagory                    = $request->sub_catagory;
    //     $pathology_test->method                          = $request->method;
    //     $pathology_test->report_days                     = $request->report_days;
    //     $pathology_test->charge_category                 = $request->charge_category;
    //     $pathology_test->charge_sub_category             = $request->charge_sub_category;
    //     $pathology_test->charge                          = $request->charge;
    //     $pathology_test->tax                             = $request->tax;
    //     $pathology_test->standard_charges                = $request->standard_charges;
    //     $pathology_test->total_amount                    = $request->total_amount;
    //     $pathology_test->test_details                    = $request->test_details;
    //     $status = $pathology_test->save();
    //     if(isset($request->test_parameter_name))
    //     {
    //             for ($i = 0; $i < count($request->test_parameter_name); $i++) {
    //             $status = TestWithParameter::insert([
    //                 'pathology_test_id'                     => $pathology_test->id,
    //                 'pathology_parameter_id'                => $request->test_parameter_name[$i],
    //                 'reference_range'                       => '',
    //                 'unit'                                  => '',
    //             ]);
    //         }
    //     }


    //     if ($status) {
    //         return redirect()->route('pathology-test-details')->with('success', 'Test Added Sucessfully');
    //     } else {
    //         return redirect()->route('pathology-test-details')->with('error', "Something Went Wrong");
    //     }
    // }

    public function find_range_by_parameter(Request $request)
    {
        $range_value = PathologyParameter::where('id', $request->parameter_id)->first();
        $unit_value = PathologyUnit::where('id', $range_value->unit_id)->first();
        return response()->json(['range_value' => $range_value, 'unit_value' => $unit_value]);
    }

    public function view_pathology_test_details($id)
    {
        $pathologyTest = PathologyTest::find($id);
        $pathologyParameter = TestWithParameter::where('pathology_test_id', $id)->get();
        return view('pathology.test-master.pathology-test-details', compact('pathologyTest', 'pathologyParameter'));
    }

    public function add_pathology_report()
    {
        $pathologyTest = PathologyTest::find(19);
        $pathologyparameterDetails = TestWithParameter::where('pathology_test_id', 19)->join('pathology_parameters', 'pathology_parameters.id', '=', 'test_with_parameters.pathology_parameter_id')->get();

        return view('pathology.add-pathology-report', compact('pathologyTest', 'pathologyparameterDetails'));
    }


    // =====================pathology test============================
    public function pathology_test_list()
    {
        $all_test = PathologyTest::all();
        return view('pathology.test.list', compact('all_test'));
    }
    public function add_pathology_test()
    {
        $catagory       = PathologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $all_test      = PathologyTestMaster::all();

        return view('pathology.test.add', compact('catagory', 'chargeCatagory', 'all_test'));
    }
    public function save_pathology_test(Request $request)
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

        $pathology_test = new PathologyTest();

        $pathology_test->test_name                       = $request->test_name;
        $pathology_test->short_name                      = $request->short_name;
        $pathology_test->test_type                       = $request->test_type;
        $pathology_test->catagory_id                     = $request->catagory_id;
        $pathology_test->sub_catagory                    = $request->sub_catagory;
        $pathology_test->method                          = $request->method;
        $pathology_test->report_days                     = $request->report_days;
        $pathology_test->charge_category                 = $request->charge_category;
        $pathology_test->charge_sub_category             = $request->charge_sub_category;
        $pathology_test->charge                          = $request->charge;
        $pathology_test->tax                             = $request->tax;
        $pathology_test->standard_charges                = $request->standard_charges;
        $pathology_test->total_amount                    = $request->total_amount;
        $pathology_test->save();

        for ($i = 0; $i < count($request->master_test_name); $i++) {
            $status = PathologyTestDetails::insert([
                'pathology_test_id'                                  => $pathology_test->id,
                'pathology_master_test_id'                           => $request->master_test_name[$i],
            ]);
        }

        if ($status) {
            return redirect()->route('pathology-test-list')->with('success', 'Test Added Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function add_test()
    {
    }

    public function pathology_test_charge()
    {
        $pathology_patient_test = PathologyPatientTest::where('ins_by', 'ori')->get();
        return view('pathology.patient-test.patient-test-list', compact('pathology_patient_test'));
    }
    public function pathology_test_charge_add()
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $pathology_all_test = PathologyTest::all();
        return view('pathology.patient-test.patient-test-add', compact('all_patient', 'pathology_all_test'));
    }
    public function add_pathology_charges_for_a_patient(Request $request)
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $pathology_all_test = PathologyTest::all();
        $patient_reg_details = caseReference::where('patient_id', $request->patient_id)->orderBy('id', 'desc')->first();
        return view('pathology.patient-test.patient-test-add', compact('all_patient', 'patient_details_information', 'pathology_all_test', 'patient_reg_details'));
    }

    public function save_pathology_charge(Request $request)
    {
        $validate = $request->validate([
            'date'   => 'required',
            'test_id'   => 'required',
            'patientId'   => 'required',
        ]);
        try {
            DB::beginTransaction();
            $pathology_patient_test = new PathologyPatientTest();

            $case_details = caseReference::where('id', $request->case_id)->first();
            if ($case_details->section == 'OPD') {
                $section_details = OpdDetails::where('case_id', $request->case_id)->first();
                $pathology_patient_test->opd_id = $section_details->id;
            } elseif ($case_details->section == 'EMG') {
                $section_details = EmgDetails::where('case_id', $request->case_id)->first();
                $pathology_patient_test->emg_id = $section_details->id;
            } else {
                $section_details = IpdDetails::where('case_id', $request->case_id)->first();
                $pathology_patient_test->ipd_id = $section_details->id;
            }
            $path_details = PathologyPatientTest::where('case_id',$request->case_id)->where('test_id',$request->test_id)->where('test_status','=','0')->first();
            if($path_details == null)
            {
            $pathology_patient_test->case_id = $request->case_id;
            $pathology_patient_test->date = $request->date;
            $pathology_patient_test->section = $case_details->section;
            $pathology_patient_test->patient_id = $request->patientId;
            $pathology_patient_test->test_id = $request->test_id;
            $pathology_patient_test->generated_by = Auth::user()->id;
            $pathology_patient_test->billing_status = '0';
            $pathology_patient_test->test_status = '0';
            $pathology_patient_test->save();

            DB::commit();
            return redirect()->route('pathology-test-charge')->with('success', "Test added successfully for this patient");
            }
            else{
                return redirect()->route('pathology-test-charge')->with('success', "Test already added For this patient");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pathology-test-charge')->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit_pathology_test_patient($id)
    {
        $test_id = base64_decode($id);
        $test_details = PathologyPatientTest::where('id', $test_id)->first();
        // dd($test_details );
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $test_details->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $pathology_all_test = PathologyTest::all();
        $patient_reg_details = caseReference::where('patient_id', $test_details->patient_id)->orderBy('id', 'desc')->first();
        return view('pathology.patient-test.patient-test-edit', compact('test_details', 'all_patient', 'patient_details_information', 'pathology_all_test', 'patient_reg_details'));
    }
    public function update_pathology_charge(Request $request)
    {
       
        $validate = $request->validate([
            'date'   => 'required',
            'test_id'   => 'required',
            'patientId'   => 'required',
        ]);
        try {
            DB::beginTransaction();
            $pathology_patient_test = PathologyPatientTest::find($request->pre_test_id);

            $pathology_patient_test->date = $request->date;
            $pathology_patient_test->test_id = $request->test_id;
            $pathology_patient_test->save();

            DB::commit();
            return redirect()->route('pathology-test-charge')->with('success', "Test Upadated Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pathology-test-charge')->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete_pathology_test_patient($id)
    {
        try {
            DB::beginTransaction();
            $test_id = base64_decode($id);
            $test_details = PathologyPatientTest::where('id', $test_id)->delete();
            DB::commit();
            return redirect()->route('pathology-test-charge')->with('success', "Test Deleted Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pathology-test-charge')->withErrors(['error' => $th->getMessage()]);
        }
    }

    // =====================pathology test============================


}
