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
use App\Models\RadiologyBilling;
use App\Models\Prefix;
use App\Models\RadiologyBillingDetails;
use App\Models\RadiologyParameterWithTest;
use App\Models\RadiologyReport;
use App\Models\ChargesWithChargesType;
use App\Models\ChargeType;
use App\Models\AllHeader;
use PDF;

class RadiologyController extends Controller
{

    public function radiology_billing_list()
    {
        $radiology_bill_details = RadiologyBilling::orderBy('id', 'desc')->get();
        return view('radiology.radiology-billing-list', compact('radiology_bill_details'));
    }

    public function add_radiology_bill()
    {
        $radiology_all_test = RadiologyTest::all();
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        return view('radiology.radiology-add-billing', compact('all_patient', 'radiology_all_test'));
    }

    public function add_radiology_billing_for_a_patient(Request $request)
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $radiology_all_test = RadiologyTest::all();
        $patient_reg_details = caseReference::where('patient_id', $request->patient_id)->orderBy('id', 'desc')->first();
        // dd($request->patient_id);
        dd($patient_reg_details);
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
        return view('radiology.radiology-add-billing', compact('all_patient', 'patient_details_information', 'radiology_all_test', 'patient_reg_details', 'p_type'));
    }
    public function find_test_amount_by_test_add(Request $request)
    {
        $p_type = ChargeType::where('charge_type_name', $request->p_type)->first(); //2
        $charge_id = RadiologyTest::find($request->testId);
        // dd($charge_id); 
        //dd($p_type);
        $test_amount = ChargesWithChargesType::where('charge_id', $charge_id->charge)->where('charge_type_id', $p_type->id)->first();
        return response()->json($test_amount);
    }

    public function save_radiology_test(Request $request)
    {
        $request->validate([
            'test_name'                         => 'required',
            'catagory_id'                       => 'required',
            'sub_catagory'                      => 'required',
            'charge_category'                   => 'required',
            'charge_sub_category'               => 'required',
            'charge'                            => 'required',
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
        $radiology_test->description                     = $request->description;
        $radiology_test->save();

        if (@$request->test_parameter_name[0] != null) {
            foreach ($request->test_parameter_name as $key => $value) {
                $RadiologyParameterWithTest = new RadiologyParameterWithTest();
                $RadiologyParameterWithTest->radiology_test_id =  $radiology_test->id;
                $RadiologyParameterWithTest->radiology_parameter_id = $request->test_parameter_name[$key];
                $RadiologyParameterWithTest->save();
            }
        }

        if (true) {
            return redirect()->route('radiology-test-list')->with('success', 'Test Added Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function save_radiology_billing(Request $request)
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
            $bill = new RadiologyBilling;
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
                $patient_charge = new RadiologyBillingDetails();
                $patient_charge->pathology_billing_id = $bill->id;
                $patient_charge->pathology_id = $request->test_id[$key];
                $patient_charge->charge_amount = $request->charge[$key];
                $patient_charge->status = '';
                $patient_charge->save();

                $radiology_patient_test = new RadiologyPatientTest();

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
                $path_details = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $request->test_id)->where('test_status', '=', '0')->first();
                if ($path_details == null) {
                    $radiology_patient_test->case_id = $request->case_id;
                    $radiology_patient_test->date = date('Y-m-d h:m:s', strtotime($request->bill_date));
                    $radiology_patient_test->section = $case_details->section;
                    $radiology_patient_test->patient_id = $request->patientId;
                    $radiology_patient_test->test_id = $request->test_id[$key];
                    $radiology_patient_test->generated_by = Auth::user()->id;
                    $radiology_patient_test->billing_status = '1';
                    $radiology_patient_test->test_status = '0';
                    $radiology_patient_test->save();
                }

                $test_details = RadiologyParameterWithTest::select('radiology_parameters.id as paramet_id', 'radiology_units.id as radiology_unit_id', 'radiology_parameters.parameter_name', 'radiology_parameters.reference_range', 'radiology_units.unit_name')->leftjoin('radiology_parameters', 'radiology_parameters.id', '=', 'radiology_parameter_with_tests.radiology_parameter_id')->leftjoin('radiology_units', 'radiology_units.id', '=', 'radiology_parameters.unit_id')->where('radiology_parameter_with_tests.radiology_test_id', $request->test_id[$key])->get();

                foreach ($test_details as $k => $vale) {
                    $RadiologyReport = new RadiologyReport();
                    $RadiologyReport->radiology_patient_test_id = $radiology_patient_test->id;
                    $RadiologyReport->parameter_id              = $vale->paramet_id;
                    $RadiologyReport->reference_range           = $vale->reference_range;
                    $RadiologyReport->unit                      = $vale->pathology_unit_id;
                    $RadiologyReport->save();
                }
            }
            DB::commit();
            return redirect()->route('radiology-details')->with('success', "Radiology Bill Successfully Created");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('add-radiology-billing')->with('error', "Something Went Wrong");
        }
    }

    public function add_radiology_test_result_details($id)
    {
        $p_id = base64_decode($id);
        $radiology_patient_test_details = RadiologyPatientTest::where('id', $p_id)->first();
        $patient_details = Patient::where('id', $radiology_patient_test_details->patient_id)->first();
        $radiologyParameterResult = RadiologyReport::select('radiology_reports.id', 'radiology_parameters.parameter_name', 'radiology_parameters.reference_range', 'radiology_units.unit_name', 'radiology_reports.report_value', 'radiology_reports.parameter_description','radiology_reports.unit')->leftjoin('radiology_parameters', 'radiology_parameters.id', '=', 'radiology_reports.parameter_id')->leftjoin('radiology_units', 'radiology_units.id', '=', 'radiology_reports.unit')->where('radiology_reports.radiology_patient_test_id', $p_id)->get();
        // dd( $radiologyParameterResult);
        // dd($radiologyParameterResult);

        $radio_test = RadiologyTest::find($radiology_patient_test_details->test_id);

        // dd($patho_test);

        return view('radiology.add-radiology-test-result-details', compact('radiology_patient_test_details', 'patient_details', 'radiologyParameterResult', 'radio_test', 'p_id'));
    }

    public function print_radiology_result($id)
    {
        $p_id = base64_decode($id);
        $radiology_patient_test_details = RadiologyPatientTest::where('id', $p_id)->first();
        $patient_details = Patient::where('id', $radiology_patient_test_details->patient_id)->first();
        $radiologyParameterResult = RadiologyReport::select('radiology_reports.id', 'radiology_parameters.parameter_name', 'radiology_parameters.reference_range', 'radiology_units.unit_name', 'radiology_reports.report_value', 'radiology_reports.parameter_description','radiology_reports.unit')->leftjoin('radiology_parameters', 'radiology_parameters.id', '=', 'radiology_reports.parameter_id')->leftjoin('radiology_units', 'radiology_units.id', '=', 'radiology_reports.unit')->where('radiology_reports.radiology_patient_test_id', $p_id)->get();

        $radio_test = RadiologyTest::find($radiology_patient_test_details->test_id);
        $header_image = AllHeader::where('header_name', 'pathology_report')->first();
        return view('radiology.printReport', compact('header_image', 'radiology_patient_test_details', 'patient_details', 'radiologyParameterResult', 'radio_test'));
    }

    public function update_radiology_report(Request $request)
    {
        $radiologyPatientTest = RadiologyPatientTest::where('id', $request->p_test_id)->first();
        $radiologyPatientTest->description = $request->description;
        $radiologyPatientTest->save();
        
        // dd($request->all());
        foreach ($request->id as $key => $value) {
            $radiology_report_details = RadiologyReport::where('id', $request->id[$key])->first();
            $radiology_report_details->report_value = $request->report_value[$key];
            $radiology_report_details->parameter_description = $request->parameter_description[$key];
            // dd($radiology_report_details)
            $radiology_report_details->save();
        }
        if (true) {
            return redirect()->route('radiology-test-charge')->with('success', 'Report Update Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_radiology_test_details($id)
    {
        $patho_id = base64_decode($id);
        RadiologyTest::where('id', $patho_id)->delete();
        RadiologyParameterWithTest::where('radiology_test_id', $patho_id)->delete();
        if (true) {
            return redirect()->route('radiology-test-list')->with('success', 'Test deleted Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_radiology_test_details($id)
    {
        $radio_id = base64_decode($id);
        $catagory       = RadiologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $all_test      = RadiologyTestMaster::all();
        $parameter      = RadiologyParameter::all();
        $radiology_test = RadiologyTest::where('id', $radio_id)->first();
        $radiology_test_details = RadiologyParameterWithTest::where('radiology_test_id', $radio_id)->get();
        return view('radiology.test.edit', compact('parameter', 'catagory', 'chargeCatagory', 'all_test', 'radiology_test_details', 'radiology_test'));
    }

    public function update_radiology_test_details(Request $request)
    {
        $request->validate([
            'test_name'                         => 'required',
            'catagory_id'                       => 'required',
            'sub_catagory'                      => 'required',
            'charge_category'                   => 'required',
            'charge_sub_category'               => 'required',
            'charge'                            => 'required',
        ]);

        $radiology_test = RadiologyTest::find($request->id);

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
        $radiology_test->description                     = $request->description;
        $radiology_test->save();

        RadiologyParameterWithTest::where('radiology_test_id', $request->id)->delete();

        if (@$request->test_parameter_name[0] != null) {
            foreach ($request->test_parameter_name as $key => $value) {
                $radiologyParameterWithTest = new RadiologyParameterWithTest();
                $radiologyParameterWithTest->radiology_test_id =  $radiology_test->id;
                $radiologyParameterWithTest->radiology_parameter_id = $request->test_parameter_name[$key];
                $radiologyParameterWithTest->save();
            }
        }

        if (true) {
            return redirect()->route('radiology-test-list')->with('success', 'Test Update Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

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
            // $radio_details = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $request->test_id)->where('test_status', '=', '0')->first();
            // if ($radio_details == null) {
                $radiology_patient_test->case_id = $request->case_id;
                $radiology_patient_test->date = $request->date;
                $radiology_patient_test->section = $case_details->section;
                $radiology_patient_test->patient_id = $request->patientId;
                $radiology_patient_test->test_id = $request->test_id;
                $radiology_patient_test->generated_by = Auth::user()->id;
                $radiology_patient_test->billing_status = $request->billing_status;
                $radiology_patient_test->test_status = '0';
                $radiology_patient_test->save();

                $radiology_parameter = RadiologyParameterWithTest::where('radiology_test_id', $request->test_id)->get();

                foreach($radiology_parameter as $value){
                    $radio_report = new RadiologyReport();
                    $radio_report->radiology_patient_test_id = $radiology_patient_test->id;
                    $radio_report->parameter_id = $value->radiology_parameter_id;
                    $radio_report->reference_range = $value->test_parameter_name->reference_range;
                    $radio_report->unit = $value->test_parameter_name->unitName->unit_name;
                    $radio_report->save();
                }
//DB::commit();
                return redirect()->route('radiology-test-charge')->with('success', "Test Added Successfully for this patient");
            // } else {
            //     return redirect()->route('radiology-test-charge')->with('success', "Test already added for this patient");
            // }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('radiology-test-charge')->withErrors(['error' => $th->getMessage()]);
        // }
    }



    //radiology test
    public function radiology_test_list()
    {
        $all_test = RadiologyTest::all();
        return view('radiology.test.list', compact('all_test'));
    }

    public function add_radiology_test()
    {
        $catagory       = RadiologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $parameter      = RadiologyParameter::all();

        return view('radiology.test.add', compact('catagory', 'chargeCatagory', 'parameter'));
    }

    public function view_radiology_test_details($id)
    {
        $patho_id = base64_decode($id);
        $radiologyTest = RadiologyTest::where('id', $patho_id)->first();

        $radiologyParameter = RadiologyParameterWithTest::select('radiology_parameters.parameter_name', 'radiology_parameters.reference_range', 'radiology_units.unit_name')->leftjoin('radiology_parameters', 'radiology_parameters.id', '=', 'radiology_parameter_with_tests.radiology_parameter_id')->leftjoin('radiology_units', 'radiology_units.id', '=', 'radiology_parameters.unit_id')->where('radiology_parameter_with_tests.radiology_test_id', $patho_id)->get();
        return view('radiology.test.view', compact('radiologyTest', 'radiologyParameter'));
    }

    // public function save_radiology_test(Request $request)
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

    //     $radiology_test = new RadiologyTest();

    //     $radiology_test->test_name                       = $request->test_name;
    //     $radiology_test->short_name                      = $request->short_name;
    //     $radiology_test->test_type                       = $request->test_type;
    //     $radiology_test->catagory_id                     = $request->catagory_id;
    //     $radiology_test->sub_catagory                    = $request->sub_catagory;
    //     $radiology_test->method                          = $request->method;
    //     $radiology_test->report_days                     = $request->report_days;
    //     $radiology_test->charge_category                 = $request->charge_category;
    //     $radiology_test->charge_sub_category             = $request->charge_sub_category;
    //     $radiology_test->charge                          = $request->charge;
    //     $radiology_test->tax                             = $request->tax;
    //     $radiology_test->standard_charges                = $request->standard_charges;
    //     $radiology_test->total_amount                    = $request->total_amount;
    //     $radiology_test->save();

    //     for ($i = 0; $i < count($request->master_test_name); $i++) {
    //         $status = RadiologyTestDetails::insert([
    //             'radiology_test_id'                                  => $radiology_test->id,
    //             'radiology_master_test_id'                           => $request->master_test_name[$i],
    //         ]);
    //     }

    //     if ($status) {
    //         return redirect()->route('radiology-test-list')->with('success', 'Test Added Sucessfully');
    //     } else {
    //         return redirect()->back()->with('error', "Something Went Wrong");
    //     }
    // }


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

    public function find_range_by_parameter_in_radiology(Request $request)
    {
        // dd( $request->all());
        $range_value = RadiologyParameter::where('id', $request->parameter_id)->first();

        $unit_value = RadiologyUnit::where('id', $range_value->unit_id)->first();
        return response()->json(['range_value' => $range_value, 'unit_value' => $unit_value]);
    }

    public function find_range_by_parameter(Request $request)
    {
        $range_value = RadiologyParameter::where('id', $request->parameter_id)->first();
        $unit_value = RadiologyUnit::where('id', $range_value->unit_id)->first();
        return response()->json(['range_value' => $range_value, 'unit_value' => $unit_value]);
    }

    // public function view_radiology_test_details($id)
    // {
    //     $radiologyTest = RadiologyTest::find($id);
    //     $radiologyParameter = TestWithParameterInRadiology::where('radiology_test_id', $id)->get();
    //     return view('radiology.test-master.radiology-test-details', compact('radiologyTest', 'radiologyParameter'));
    // }

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

    public function change_sample_status(Request $request)
    {
        $radiology_patient_test = RadiologyPatientTest::where('id', $request->id)->first();
        $radiology_patient_test->test_status = $request->sample_status;
        if($request->sample_status == 3){
            $radiology_patient_test->report_date = date('Y-m-d');
        }
       
        if($request->sample_status == 2 || $request->sample_status == 1 ){
            $radiology_patient_test->sample_collected_date = date('Y-m-d');
        }
        
        $radiology_patient_test->save();
        if (true) {
            return redirect()->route('radiology-test-charge')->with('success', 'Sample Collected Successfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }
}
