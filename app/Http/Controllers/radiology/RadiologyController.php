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
use App\Models\RadiologyTestWithParameters;

class RadiologyController extends Controller
{
    public function radiology_details()
    {
        return view('radiology.radiology-listing');
    }

    //pathology test
    public function radiology_test_details()
    {
        $radiologyTest = RadiologyTest::all();
        return view('radiology.test-radiology.radiology-test-listing', compact('radiologyTest'));
    }

    public function add_radiology_test_details()
    {

        $catagory       = RadiologyCatagory::all();
        $chargeCatagory = ChargesCatagory::all();
        $parameter      = RadiologyParameter::all();

        return view('radiology.test-radiology.add-radiology-test', compact('catagory', 'chargeCatagory', 'parameter'));
    }

    public function save_radiology_test_details(Request $request)
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

        $status = RadiologyTest::insert([
            'test_name'                       => $request->test_name,
            'short_name'                      => $request->short_name,
            'test_type'                       => $request->test_type,
            'catagory_id'                     => $request->catagory_id,
            'sub_catagory'                    => $request->sub_catagory,
            'method'                          => $request->method,
            'report_days'                     => $request->report_days,
            'charge_category'                 => $request->charge_category,
            'charge_sub_category'             => $request->charge_sub_category,
            'charge'                          => $request->charge,
            'tax'                             => $request->tax,
            'standard_charges'                => $request->standard_charges,
            'total_amount'                    => $request->total_amount,

        ]);

        for ($i = 0; $i < count($request->test_parameter_name); $i++) {
            $status = RadiologyTestWithParameters::insert([
                'pathology_test_id'                     => $status->id,
                'pathology_parameter_id'                => $request->test_parameter_name[$i],
                'reference_range'                       => '',
                'unit'                                  => '',
                'formula'                               => $request->formula[$i],
            ]);
        }


        if ($status) {
            return redirect()->route('radiology-test-details')->with('success', 'Test Added Sucessfully');
        } else {
            return redirect()->route('radiology-test-details')->with('error', "Something Went Wrong");
        }
    }

    public function find_range_by_parameter(Request $request)
    {
        $range_value = RadiologyParameter::where('id', $request->parameter_id)->first();
        $unit_value = RadiologyUnit::where('id', $range_value->unit_id)->first();
        return response()->json(['range_value' => $range_value, 'unit_value' => $unit_value]);
    }
}
