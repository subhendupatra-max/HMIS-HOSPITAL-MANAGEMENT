<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseReference;
use App\Models\PatientOthersBilling;

class BillSummaryController extends Controller
{
    public function bill_summary()
    {
        return view('bill_summary.bill-summary');
    }
    public function create_bill_summary($section_id = null,$case_id = null,$patient_id = null)
    {
        if($case_id != null)
        {
            $case_details = CaseReference::where('id',$case_id)->first();
            $others_charges = PatientOthersBilling::where('case_id',$case_id)->get();
            $pathology_charges = PatientOthersBilling::where('case_id',$case_id)->get();
            $radiology_charges = PatientOthersBilling::where('case_id',$case_id)->get();
            $medicine_charges = PatientOthersBilling::where('case_id',$case_id)->get();
        }
        return view('bill_summary.create-bill-summary');
    }
}
