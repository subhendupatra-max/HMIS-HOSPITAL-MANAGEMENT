<?php

namespace App\Http\Controllers\OPD;

use App\Http\Controllers\Controller;
use App\Models\OpdDetails;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id',$opd_id)->first();
        return view('OPD.billing.billing-list',compact('opd_patient_details','opd_id'));
    }
    public function create_billing($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id',$opd_id)->first();
        return view('OPD.billing.create-billing',compact('opd_patient_details','opd_id'));
    }
}
