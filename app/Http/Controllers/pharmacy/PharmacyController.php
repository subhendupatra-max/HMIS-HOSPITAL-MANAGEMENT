<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\MedicineStock;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function pharmacy_bill_listing()
    {
        return view('pharmacy.generate-bill.generate-bill-listing');
    }

    public function all_medicine_stock()
    {
        $emdicine_stock = MedicineStock::get();
        return view('pharmacy.medicine-stock');
    }

}
