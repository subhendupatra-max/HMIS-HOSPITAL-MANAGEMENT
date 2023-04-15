<?php

namespace App\Http\Controllers\bloodBank;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use Illuminate\Http\Request;

class BloodBPosetiveController extends Controller
{
    public function all_b_posetive_blood_details()
    {
        $blood_groups = BloodGroup::all();
        return view('Blood_Bank.blood-bank-listing',compact('blood_groups'));
    }


}
