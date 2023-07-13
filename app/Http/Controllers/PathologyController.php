<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChargesCatagory;
use App\Models\PathologyCatagory;
use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\PathologyGroupTest;
use App\Models\PathologyGroupTestDetails;
use App\Models\PathologyParameterWithTest;
use App\Models\PathologyTest;
use App\Models\PathologyParameter;
use App\Models\PathologyTestDetails;
use App\Models\ChargesWithChargesType;
use App\Models\PathologyTestMaster;
use App\Models\PathologyTestMasterDetails;
use App\Models\PathologyUnit;
use App\Models\ChargeType;
use App\Models\PathologyReport;
use App\Models\Patient;
use App\Models\caseReference;
use App\Models\TestWithParameter;
use App\Models\PathologyBilling;
use App\Models\PathologyBillingDetails;
use App\Models\Prefix;
use Auth;
use PDF;
use App\Models\PatientCharge;
use App\Models\AllHeader;
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
        $p_type = ChargeType::where('charge_type_name', $request->p_type)->first();
        $charge_id = PathologyTest::find($request->testId);
        //dd($p_type);
        $test_amount = ChargesWithChargesType::where('charge_id', $charge_id->charge)->where('charge_type_id', $p_type->id)->first();
        return response()->json($test_amount);
    }
    public function add_pathology_billing_for_a_patient(Request $request)
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $pathology_all_test = PathologyTest::all();
        $patient_reg_details = caseReference::where('patient_id', $request->patient_id)->orderBy('id', 'desc')->first();
        if ($patient_reg_details->section == 'OPD') {
            $patient_type =  OpdDetails::where('case_id', $patient_reg_details->id)->first();
            if ($patient_type->latest_opd_visit_details_for_patient->patient_type == 'TPA') {
                $p_type = $patient_type->latest_opd_visit_details_for_patient->TpaManagement->TPA_name;
            } else {
                $p_type = $patient_type->latest_opd_visit_details_for_patient->patient_type;
            }
        }
        if ($patient_reg_details->section == 'IPD') {
            $patient_type =  IpdDetails::where('case_id', $patient_reg_details->id)->first();
            if ($patient_type->patient_type == 'TPA') {
                $p_type = $patient_type->TpaManagement->TPA_name;
            } else {
                $p_type = $patient_type->patient_type;
            }
        }
        if ($patient_reg_details->section == 'EMG') {
            $patient_type =  EmgDetails::where('case_id', $patient_reg_details->id)->first();
            if ($patient_type->all_emg_visit_details->patient_type == 'TPA') {
                $p_type = $patient_type->all_emg_visit_details->TpaManagement->TPA_name;
            } else {
                $p_type = $patient_type->all_emg_visit_details->patient_type;
            }
        }
        return view('pathology.pathology-add-billing', compact('all_patient', 'patient_details_information', 'pathology_all_test', 'patient_reg_details', 'p_type'));
    }
    public function save_pathology_billing(Request $request)
    {
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
                $patient_charge->status = '';
                $patient_charge->save();

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
                $path_details = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $request->test_id)->where('test_status', '=', '0')->first();
                if ($path_details == null) {
                    $pathology_patient_test->case_id = $request->case_id;
                    $pathology_patient_test->date = date('Y-m-d h:m:s', strtotime($request->bill_date));
                    $pathology_patient_test->section = $case_details->section;
                    $pathology_patient_test->patient_id = $request->patientId;
                    $pathology_patient_test->test_id = $request->test_id[$key];
                    $pathology_patient_test->generated_by = Auth::user()->id;
                    $pathology_patient_test->billing_status = '1';
                    $pathology_patient_test->test_status = '0';
                    $pathology_patient_test->save();
                }

                $test_details = PathologyParameterWithTest::select('pathology_parameters.id as paramet_id', 'pathology_units.id as pathology_unit_id', 'pathology_parameters.parameter_name', 'pathology_parameters.reference_range', 'pathology_units.unit_name')->leftjoin('pathology_parameters', 'pathology_parameters.id', '=', 'pathology_parameter_with_tests.pathology_parameter_id')->leftjoin('pathology_units', 'pathology_units.id', '=', 'pathology_parameters.unit_id')->where('pathology_parameter_with_tests.pathology_test_id', $request->test_id[$key])->get();

                foreach ($test_details as $k => $vale) {
                    $PathologyReport = new PathologyReport();
                    $PathologyReport->pathology_patient_test_id = $pathology_patient_test->id;
                    $PathologyReport->parameter_id              = $vale->paramet_id;
                    $PathologyReport->reference_range           = $vale->reference_range;
                    $PathologyReport->unit                      = $vale->pathology_unit_id;
                    $PathologyReport->save();
                }
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
        // dd( $request->all());
        $range_value = PathologyParameter::where('id', $request->parameter_id)->first();

        $unit_value = PathologyUnit::where('id', $range_value->unit_id)->first();
        return response()->json(['range_value' => $range_value, 'unit_value' => $unit_value]);
    }

    // public function view_pathology_test_details($id)
    // {
    //     $pathologyTest = PathologyTest::find($id);
    //     $pathologyParameter = TestWithParameter::where('pathology_test_id', $id)->get();
    //     return view('pathology.test-master.pathology-test-details', compact('pathologyTest', 'pathologyParameter'));
    // }

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
        $parameter      = PathologyParameter::all();

        return view('pathology.test.add', compact('parameter', 'catagory', 'chargeCatagory', 'all_test'));
    }
    public function save_pathology_test(Request $request)
    {
        $request->validate([
            'test_name'                         => 'required',
            'catagory_id'                       => 'required',
            'sub_catagory'                      => 'required',
            'charge_category'                   => 'required',
            'charge_sub_category'               => 'required',
            'charge'                            => 'required',
        ]);

        // dd($request->description);
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
        $pathology_test->description                     = $request->description;
        // dd($pathology_test);
        $pathology_test->save();

        if (@$request->test_parameter_name[0] != null) {
            foreach ($request->test_parameter_name as $key => $value) {
                $PathologyParameterWithTest = new PathologyParameterWithTest();
                $PathologyParameterWithTest->pathology_test_id =  $pathology_test->id;
                $PathologyParameterWithTest->pathology_parameter_id = $request->test_parameter_name[$key];
                $PathologyParameterWithTest->save();
            }
        }

        if (true) {
            return redirect()->route('pathology-test-list')->with('success', 'Test Added Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }
    public function update_pathology_test_details(Request $request)
    {
        $request->validate([
            'test_name'                         => 'required',
            'catagory_id'                       => 'required',
            'sub_catagory'                      => 'required',
            'charge_category'                   => 'required',
            'charge_sub_category'               => 'required',
            'charge'                            => 'required',
        ]);

        $pathology_test = PathologyTest::find($request->id);

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
        $pathology_test->description                     = $request->description;
        $pathology_test->save();

        PathologyParameterWithTest::where('pathology_test_id', $request->id)->delete();

        if (@$request->test_parameter_name[0] != null) {
            foreach ($request->test_parameter_name as $key => $value) {
                $PathologyParameterWithTest = new PathologyParameterWithTest();
                $PathologyParameterWithTest->pathology_test_id =  $pathology_test->id;
                $PathologyParameterWithTest->pathology_parameter_id = $request->test_parameter_name[$key];
                $PathologyParameterWithTest->save();
            }
        }

        if (true) {
            return redirect()->route('pathology-test-list')->with('success', 'Test Update Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function view_pathology_test_details($id)
    {
        $patho_id = base64_decode($id);
        $pathologyTest = PathologyTest::where('id', $patho_id)->first();

        $pathologyParameter = PathologyParameterWithTest::select('pathology_parameters.parameter_name', 'pathology_parameters.reference_range', 'pathology_units.unit_name')->leftjoin('pathology_parameters', 'pathology_parameters.id', '=', 'pathology_parameter_with_tests.pathology_parameter_id')->leftjoin('pathology_units', 'pathology_units.id', '=', 'pathology_parameters.unit_id')->where('pathology_parameter_with_tests.pathology_test_id', $patho_id)->get();
        return view('pathology.test.view', compact('pathologyTest', 'pathologyParameter'));
    }

    public function delete_pathology_test_details($id)
    {
        $patho_id = base64_decode($id);
        PathologyTest::where('id', $patho_id)->delete();
        PathologyParameterWithTest::where('pathology_test_id', $patho_id)->delete();
        if (true) {
            return redirect()->route('pathology-test-list')->with('success', 'Test deleted Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }
    public function edit_pathology_test_details($id)
    {
        $patho_id = base64_decode($id);
        $catagory       = PathologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $all_test      = PathologyTestMaster::all();
        $parameter      = PathologyParameter::all();
        $pathology_test = PathologyTest::where('id', $patho_id)->first();
        $pathology_test_details = PathologyParameterWithTest::where('pathology_test_id', $patho_id)->get();
        return view('pathology.test.edit', compact('parameter', 'catagory', 'chargeCatagory', 'all_test', 'pathology_test_details', 'pathology_test'));
    }

    public function add_pathology_test_result_details($id)
    {
        $p_id = base64_decode($id);
        $pathology_patient_test_details = PathologyPatientTest::where('id', $p_id)->first();
        $patient_details = Patient::where('id', $pathology_patient_test_details->patient_id)->first();
        $pathologyParameterResult = PathologyReport::select('pathology_reports.id', 'pathology_parameters.parameter_name', 'pathology_parameters.reference_range', 'pathology_units.unit_name', 'pathology_reports.report_value', 'pathology_reports.parameter_description','pathology_reports.unit')->leftjoin('pathology_parameters', 'pathology_parameters.id', '=', 'pathology_reports.parameter_id')->leftjoin('pathology_units', 'pathology_units.id', '=', 'pathology_reports.unit')->where('pathology_reports.pathology_patient_test_id', $p_id)->get();

        $patho_test = PathologyTest::find($pathology_patient_test_details->test_id);

        return view('pathology.add-pathology-test-result-details', compact('pathology_patient_test_details', 'patient_details', 'pathologyParameterResult', 'patho_test', 'p_id'));
    }

    public function update_pathology_report(Request $request)
    {
        // dd($request->all());
        $PathologyPatientTest = PathologyPatientTest::where('id', $request->p_test_id)->first();
        $PathologyPatientTest->description = $request->description;
        $PathologyPatientTest->save();
        
        foreach ($request->id as $key => $value) {
            $oathology_report_details = PathologyReport::where('id', $request->id[$key])->first();
            $oathology_report_details->report_value = $request->report_value[$key];
            $oathology_report_details->parameter_description = $request->parameter_description[$key];
            // dd($oathology_report_details)
            $oathology_report_details->save();
        }
        if (true) {
            return redirect()->route('pathology-test-charge')->with('success', 'Report Update Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function pathology_test_charge()
    {
        $pathology_patient_test = PathologyPatientTest::where('ins_by', 'ori')->orderBy('date','DESC')->get();
        return view('pathology.patient-test.patient-test-list', compact('pathology_patient_test'));
    }
    public function change_sample_status(Request $request)
    {
        $pathology_patient_test = PathologyPatientTest::where('id', $request->id)->first();
        $pathology_patient_test->test_status = $request->sample_status;
        if($request->sample_status == 3){
            $pathology_patient_test->report_date = date('Y-m-d');
        }
       
        if($request->sample_status == 2 || $request->sample_status == 1 ){
            $pathology_patient_test->sample_collected_date = date('Y-m-d');
        }
        
        $pathology_patient_test->save();
        if (true) {
            return redirect()->route('pathology-test-charge')->with('success', 'Sample Collected Successfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
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
    
                $pathology_patient_test->case_id = $request->case_id;
                $pathology_patient_test->date = $request->date;
                $pathology_patient_test->section = $case_details->section;
                $pathology_patient_test->patient_id = $request->patientId;
                $pathology_patient_test->test_id = $request->test_id;
                $pathology_patient_test->generated_by = Auth::user()->id;
                $pathology_patient_test->billing_status = $request->billing_status;
                $pathology_patient_test->test_status = '0';
                $pathology_patient_test->save();
                
                $pthology_parameter = PathologyParameterWithTest::where('pathology_test_id', $request->test_id)->get();
                
                foreach($pthology_parameter as $value){
                    $pathology_report = new PathologyReport();
                    $pathology_report->pathology_patient_test_id = $pathology_patient_test->id;
                    $pathology_report->parameter_id = $value->pathology_parameter_id;
                    $pathology_report->reference_range = $value->test_parameter_name->reference_range;
                    $pathology_report->unit = $value->test_parameter_name->unitName->unit_name;
                    $pathology_report->save();
                }
                DB::commit();
                return redirect()->route('pathology-test-charge')->with('success', "Test added successfully for this patient");
        
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

    public function getcharges_amount(Request $request)
    {
        $charge_details = ChargesWithChargesType::join('charge_types', 'charges_with_charges_types.charge_type_id', '=', 'charge_types.id')->where('charges_with_charges_types.charge_id', $request->charges)->get();
        return response()->json($charge_details);
    }

    public function print_pathology_result($id)
    {
        $p_id = base64_decode($id);
        $pathology_patient_test_details = PathologyPatientTest::where('id', $p_id)->first();
        $patient_details = Patient::where('id', $pathology_patient_test_details->patient_id)->first();
        $pathologyParameterResult = PathologyReport::select('pathology_reports.id', 'pathology_parameters.parameter_name', 'pathology_parameters.reference_range', 'pathology_units.unit_name', 'pathology_reports.report_value', 'pathology_reports.parameter_description','pathology_reports.unit')->leftjoin('pathology_parameters', 'pathology_parameters.id', '=', 'pathology_reports.parameter_id')->leftjoin('pathology_units', 'pathology_units.id', '=', 'pathology_reports.unit')->where('pathology_reports.pathology_patient_test_id', $p_id)->get();

        $patho_test = PathologyTest::find($pathology_patient_test_details->test_id);
        $header_image = AllHeader::where('header_name', 'pathology_report')->first();
        return view('pathology.printReport', compact('header_image', 'pathology_patient_test_details', 'patient_details', 'pathologyParameterResult', 'patho_test'));
        // return $pdf->stream('pathology-report.pdf');
    }

    // =====================pathology test============================


}
