<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\MedicineCatagory;
use App\Models\MedicineStock;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PharmacyController extends Controller
{
    public function pharmacy_bill_listing()
    {
        return view('pharmacy.generate-bill.generate-bill-listing');
    }

    public function all_medicine_stock()
    {
        $medicine_stock = Medicine::select('medicine_units.medicine_unit_name', 'medicines.min_level', 'medicines.medicine_name', 'medicine_catagories.medicine_catagory_name', 'medicines.medicine_composition', DB::raw('SUM(medicine_stocks.quantity) - COALESCE(SUM(issue_medicines.quantity), 0) as available_quantity'))
            ->leftJoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->leftJoin('medicine_catagories', 'medicines.medicine_catagory', '=', 'medicine_catagories.id')
            ->leftJoin('medicine_stocks', 'medicines.id', '=', 'medicine_stocks.medicine_name')
            ->leftJoin('issue_medicines', 'medicines.id', '=', 'issue_medicines.medicine_name')
            ->groupBy('medicine_units.medicine_unit_name', 'medicines.id', 'medicines.medicine_name', 'medicines.medicine_composition', 'medicine_catagories.medicine_catagory_name', 'medicines.min_level')
            ->get();
        return view('pharmacy.medicine-stock', compact('medicine_stock'));
    }

    public function pharmacy_bill_add()
    {
        $all_patient = Patient::where('ins_by', 'ori')->where('is_active', '1')->get();
        return view('pharmacy.generate-bill.add-medicine-bill', compact('all_patient'));
    }
    public function add_pharmacy_billing_for_a_patient(Request $request)
    {
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();
        $medicine_category = MedicineCatagory::all();
        return view('pharmacy.generate-bill.add-medicine-bill', compact('all_patient', 'patient_details_information', 'medicine_category'));
    }

    public function medicine_name_by_medicine_category(Request $request)
    {
        $medicine_name = Medicine::where('medicine_catagory', $request->medicine_category_id)->get();
        return response()->json($medicine_name);
    }

    public function find_medicine_batch_by_medicine_name(Request $request)
    {
        $medicine_batch_details = MedicineStock::select('batch_no')->where('medicine_name', $request->medicine_name_id)->groupBy('batch_no')->get();
        return response()->json($medicine_batch_details);
    }

    public function find_medicine_details_by_medicine_batch(Request $request)
    {
        $medicine_details = MedicineStock::select('medicine_units.id as unit_id','medicine_stocks.expiry_date', 'medicine_stocks.mrp', 'medicine_stocks.sale_price', 'medicine_stocks.purchase_price', 'medicine_units.medicine_unit_name')->join('medicine_units', 'medicine_units.id', '=', 'medicine_stocks.unit')->where('medicine_name', $request->medicineId)->where('batch_no', $request->medicine_batch_no)->groupBy('medicine_stocks.expiry_date', 'medicine_stocks.mrp', 'medicine_stocks.sale_price', 'medicine_stocks.purchase_price', 'medicine_units.medicine_unit_name','medicine_units.id')->first();

        $medicine_stock = Medicine::select( DB::raw('SUM(medicine_stocks.quantity) - COALESCE(SUM(issue_medicines.quantity), 0) as available_quantity'))
            ->leftJoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->leftJoin('medicine_catagories', 'medicines.medicine_catagory', '=', 'medicine_catagories.id')
            ->leftJoin('medicine_stocks', 'medicines.id', '=', 'medicine_stocks.medicine_name')
            ->leftJoin('issue_medicines', 'medicines.id', '=', 'issue_medicines.medicine_name')
            ->where('medicine_stocks.medicine_name',$request->medicineId)
            ->where('medicine_stocks.batch_no',$request->medicine_batch_no)
            ->groupBy('medicines.id')
            ->first();

        return response()->json(['medicine_details'=>$medicine_details,'medicine_stock'=>$medicine_stock]);
    }
}
