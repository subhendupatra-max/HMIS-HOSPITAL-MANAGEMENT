<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function pharmacy_bill_listing()
    {
        return view('pharmacy.generate-bill.generate-bill-listing');
    }
}
