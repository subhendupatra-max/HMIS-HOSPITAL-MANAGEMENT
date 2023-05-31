<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DischargedPatient;
use App\Models\Patient;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //

    public function death_record()
    {
        $discharge_patient =  DischargedPatient::where('discharge_status', 'Death')->get();
// dd($discharge_patient );
        return view('record.death-record', compact('discharge_patient'));
    }
}
