<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\MedicineCatagory;
use App\Models\MedicineStock;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Prefix;
use App\Models\MedicineBilling;
use App\Models\MedicineBillingDetails;
use App\Models\caseReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    public function pharmacy_bill_listing()
    {
        $medicine_bill = MedicineBilling::orderBy('id', 'desc')->get();
        return view('pharmacy.generate-bill.generate-bill-listing', compact('medicine_bill'));
    }

    public function all_medicine_stock()
    {
        $medicine_stock = Medicine::select('medicines.id', 'medicine_units.medicine_unit_name', 'medicines.min_level', 'medicines.medicine_name', 'medicine_catagories.medicine_catagory_name', 'medicines.medicine_composition', DB::raw('SUM(medicine_stocks.quantity) - COALESCE(SUM(issue_medicines.quantity), 0) as available_quantity'))
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
        $patient_reg_details = caseReference::where('patient_id', $request->patient_id)->orderBy('id', 'desc')->first();
        $medicine_category = MedicineCatagory::all();
        //   dd( $patient_reg_details);
        return view('pharmacy.generate-bill.add-medicine-bill', compact('all_patient', 'patient_details_information', 'medicine_category', 'patient_reg_details'));
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
        $medicine_details = MedicineStock::select('medicine_units.id as unit_id', 'medicine_stocks.expiry_date', 'medicine_stocks.mrp', 'medicine_stocks.sale_price', 'medicine_stocks.purchase_price', 'medicine_units.medicine_unit_name')->join('medicine_units', 'medicine_units.id', '=', 'medicine_stocks.unit')->where('medicine_name', $request->medicineId)->where('batch_no', $request->medicine_batch_no)->groupBy('medicine_stocks.expiry_date', 'medicine_stocks.mrp', 'medicine_stocks.sale_price', 'medicine_stocks.purchase_price', 'medicine_units.medicine_unit_name', 'medicine_units.id')->first();

        $medicine_stock = Medicine::select(DB::raw('SUM(medicine_stocks.quantity) - COALESCE(SUM(issue_medicines.quantity), 0) as available_quantity'))
            ->leftJoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->leftJoin('medicine_catagories', 'medicines.medicine_catagory', '=', 'medicine_catagories.id')
            ->leftJoin('medicine_stocks', 'medicines.id', '=', 'medicine_stocks.medicine_name')
            ->leftJoin('issue_medicines', 'medicines.id', '=', 'issue_medicines.medicine_name')
            ->where('medicine_stocks.medicine_name', $request->medicineId)
            ->where('medicine_stocks.batch_no', $request->medicine_batch_no)
            ->groupBy('medicines.id')
            ->first();

        return response()->json(['medicine_details' => $medicine_details, 'medicine_stock' => $medicine_stock]);
    }
    public function save_pharmacy_billing(Request $request)
    {
        $validate = $request->validate([
            'patientId'             => 'required',
            'total'                 => 'required',
        ]);
        try {
            DB::beginTransaction();
            $billing_prefix = Prefix::where('name', 'medicine_bill')->first();
            $bill = new MedicineBilling;
            $bill->bill_prefix = $billing_prefix->prefix;
            $bill->bill_date = $request->bill_date;
            $bill->patient_id = $request->patientId;
            $bill->section = $request->section;
            $bill->case_id = $request->case_id;
            $bill->total_amount = $request->total;
            $bill->payment_status = '';
            $bill->status =  '0';
            $bill->ins_by =  'ori';
            $bill->bill_id =  '';
            $bill->created_by = Auth::user()->id;
            $bill->note = $request->note;
            $bill->save();

            foreach ($request->medicine_name as $key => $value) {
                $patient_charge = new MedicineBillingDetails();
                $patient_charge->medicine_billing_id = $bill->id;
                $patient_charge->medicine_category = $request->medicine_category[$key];
                $patient_charge->medicine_name = $request->medicine_name[$key];
                $patient_charge->medicine_batch = $request->medicine_batch[$key];
                $patient_charge->medicine_expiry_date = $request->medicine_expiry_date[$key];
                $patient_charge->mrp = $request->mrp[$key];
                $patient_charge->sale_price = $request->sale_price[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->unit_id = $request->unit_id[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->status = '';
                $patient_charge->save();
            }

            if ($request->payment_amount != null || $request->payment_amount != 0 || $request->payment_amount != '') {
                // ====================== add payment =======================================
                $payment_prefix = Prefix::where('name', 'payment')->first();
                $payment = new Payment();
                $payment->patient_id = $request->patientId;
                $payment->case_id = $request->case_id;
                $payment->section = $request->section;
                $payment->opd_id = $request->opd_id;
                $payment->emg_id = $request->emg_id;
                $payment->ipd_id = $request->ipd_id;
                $payment->payment_prefix = $payment_prefix->prefix;
                $payment->payment_amount = $request->payment_amount;
                $payment->payment_date = date('Y-m-d h:m:s', strtotime($request->bill_date));
                $payment->payment_recived_by = Auth::user()->id;
                $payment->payment_mode = $request->payment_mode;
                $payment->note = $request->note;
                $payment->save();
                // ====================== add payment =======================================
            }

            DB::commit();
            return redirect()->route('pharmacy-bill-listing')->with('success', "Medicine Bill Successfully Created");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function medicine_details($medicine_id)
    {
        $medicine_details = Medicine::where('id', $medicine_id)->get();
        return view('pharmacy.medicine.medicine-details', compact('medicine_details'));
    }

    public function delete_medicine_bill($bill_id)
    {
        try {
            DB::beginTransaction();
            $id = base64_decode($bill_id);
            MedicineBilling::where('id', $id)->delete();
            MedicineBillingDetails::where('medicine_billing_id', $id)->delete();
            DB::commit();
            return redirect()->route('pharmacy-bill-listing')->with('success', "Medicine Bill Successfully deleted");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function details_medicine_bill($bill_id)
    {
        $id = base64_decode($bill_id);
        $medicine_bill = MedicineBilling::where('id', $id)->first();
        $medicine_bill_details = MedicineBillingDetails::select('medicine_units.medicine_unit_name', 'medicine_catagories.medicine_catagory_name', 'medicines.medicine_name', 'medicine_billing_details.amount', 'medicine_billing_details.qty')
            ->leftjoin('medicine_catagories', 'medicine_billing_details.medicine_category', '=', 'medicine_catagories.id')
            ->leftjoin('medicines', 'medicine_billing_details.medicine_name', '=', 'medicines.id')
            ->leftjoin('medicine_units', 'medicine_billing_details.unit_id', '=', 'medicine_units.id')
            ->where('medicine_billing_id', $id)
            ->get();
        return view('pharmacy.generate-bill.bill-details', compact('medicine_bill_details', 'medicine_bill'));
    }
}
