<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\MedicineCatagory;
use App\Models\MedicineStock;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Prefix;
use App\Models\AllHeader;
use App\Models\MedicineBilling;
use App\Models\MedicineBillingDetails;
use App\Models\caseReference;
use Illuminate\Http\Request;
use App\Models\ExpiredMedicine;
use App\Models\MedicineStoreRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class PharmacyController extends Controller
{
    public function pharmacy_bill_listing()
    {
        $medicine_bill = MedicineBilling::orderBy('id', 'desc')->get();
        return view('pharmacy.generate-bill.generate-bill-listing', compact('medicine_bill'));
    }

    public function all_medicine_stock()
    {
        $medicine_stock = Medicine::select('medicines.id', 'medicine_units.medicine_unit_name', 'medicines.min_level', 'medicines.medicine_name', 'medicine_catagories.medicine_catagory_name', 'medicines.medicine_composition', DB::raw('SUM(medicine_stocks.qty) - COALESCE(SUM(issue_medicines.quantity), 0) as available_quantity'))
            ->leftJoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->leftJoin('medicine_catagories', 'medicines.medicine_catagory', '=', 'medicine_catagories.id')
            ->leftJoin('medicine_stocks', 'medicines.id', '=', 'medicine_stocks.medicine')
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
        $medicine_name = Medicine::select('medicine_catagories.medicine_catagory_name', 'medicines.medicine_name', 'medicine_catagories.id as medicine_cat_id', 'medicines.id as medicine_id')->join('medicine_catagories', 'medicine_catagories.id', '=', 'medicines.medicine_catagory')->get();
        // dd( $medicine_name);
        return view('pharmacy.generate-bill.add-medicine-bill', compact('all_patient', 'patient_details_information', 'medicine_name', 'patient_reg_details'));
    }

    public function medicine_name_by_medicine_category(Request $request)
    {
        $medicine_name = Medicine::where('medicine_catagory', $request->medicine_category_id)->get();
        return response()->json($medicine_name);
    }

    public function find_medicine_batch_by_medicine_name(Request $request)
    {
        $medicine_batch_details = MedicineStock::select('batch_no')->where('medicine', $request->medicine_name_id)->groupBy('batch_no')->orderBy('exp_date', 'ASC')->get();
        return response()->json($medicine_batch_details);
    }

    public function find_medicine_details_by_medicine_batch(Request $request)
    {
        $medicine_details = MedicineStock::select('medicine_units.id as unit_id', 'medicine_stocks.exp_date', 'medicine_stocks.mrp', 'medicine_stocks.s_rate', 'medicine_stocks.p_rate', 'medicine_units.medicine_unit_name', 'medicine_stocks.igst', 'medicine_stocks.sgst', 'medicine_stocks.cgst')->join('medicine_units', 'medicine_units.id', '=', 'medicine_stocks.unit')->where('medicine', $request->medicineId)->where('batch_no', $request->medicine_batch_no)->groupBy('medicine_stocks.exp_date', 'medicine_stocks.mrp', 'medicine_stocks.s_rate', 'medicine_stocks.p_rate', 'medicine_units.medicine_unit_name', 'medicine_units.id', 'medicine_stocks.igst', 'medicine_stocks.sgst', 'medicine_stocks.cgst')->first();

        $medicine_stock = Medicine::select(DB::raw('SUM(medicine_stocks.qty) - COALESCE(SUM(issue_medicines.quantity), 0) as available_quantity'))
            ->leftJoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->leftJoin('medicine_catagories', 'medicines.medicine_catagory', '=', 'medicine_catagories.id')
            ->leftJoin('medicine_stocks', 'medicines.id', '=', 'medicine_stocks.medicine')
            ->leftJoin('issue_medicines', 'medicines.id', '=', 'issue_medicines.medicine_name')
            ->where('medicine_stocks.medicine', $request->medicineId)
            ->where('medicine_stocks.batch_no', $request->medicine_batch_no)
            ->groupBy('medicines.id')
            ->first();

        return response()->json(['medicine_details' => $medicine_details, 'medicine_stock' => $medicine_stock]);
    }
    public function save_pharmacy_billing(Request $request)
    {
        $validate = $request->validate([
            'patientId'             => 'required',
            'bill_date'             => 'required',
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
            $bill->total_amount = $request->total_value;
            $bill->total_cgst = $request->total_cgst_amount;
            $bill->total_sgst = $request->total_sgst_amount;
            $bill->total_igst = $request->total_igst_amount;
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
                $patient_charge->medicine_name = $request->medicine_name[$key];
                $patient_charge->medicine_batch = $request->medicine_batch[$key];
                $patient_charge->medicine_expiry_date = $request->medicine_expiry_date[$key];
                $patient_charge->mrp = $request->mrp[$key];
                $patient_charge->sale_price = $request->sale_price[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->cgst = $request->cgst[$key];
                $patient_charge->sgst = $request->sgst[$key];
                $patient_charge->igst = $request->igst[$key];
                $patient_charge->cgst_value = $request->cgst_value[$key];
                $patient_charge->sgst_value = $request->sgst_value[$key];
                $patient_charge->igst_value = $request->igst_value[$key];
                $patient_charge->unit_id = $request->unit_id[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->status = '';
                $patient_charge->save();
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
        $medicine_details = Medicine::where('id', $medicine_id)->first();
        // dd( $medicine_details);
        return view('pharmacy.medicine.medicine-details', compact('medicine_details'));
    }

    public function bad_medicine_details($medicine_id)
    {
        $medicine_details = Medicine::where('id', $medicine_id)->first();

        return view('pharmacy.medicine.bad-medicine-details', compact('medicine_details'));
    }
    public function add_bad_medicine($medicine_id)
    {
        $medicine_details = Medicine::find($medicine_id);
        $medicine_stock = MedicineStock::where('medicine', $medicine_details->id)->first();
        // dd($medicine_stock);
        $medicine = Medicine::all();
        $store_room = MedicineStoreRoom::all();
        $medicine_catagory = MedicineCatagory::all();

        return view('pharmacy.medicine.add-bad-medicines', compact('medicine_details', 'medicine', 'store_room', 'medicine_catagory', 'medicine_stock'));
    }

    public function save_bad_medicine(Request $request)
    {
        try {
            DB::beginTransaction();
            $bad_medicine = new ExpiredMedicine();
            $bad_medicine->grm_id         =  '';
            $bad_medicine->po_details_id  =  '';
            $bad_medicine->emg_challan_id =  '';
            $bad_medicine->stored_room =  $request->stored_room;
            $bad_medicine->status =  'bad medicine updated';
            $bad_medicine->catagory =  $request->medicine_category;
            $bad_medicine->unit =  $request->unit;
            $bad_medicine->medicine =  $request->medicine_name;
            $bad_medicine->batch_no =  $request->batch_no;
            $bad_medicine->qty =  $request->quantity;
            $bad_medicine->mrp =  $request->mrp;
            $bad_medicine->discount =  $request->discount;
            $bad_medicine->p_rate =  $request->purchase_price;
            $bad_medicine->s_rate =  $request->sale_price;
            $bad_medicine->cgst =  $request->cgst;
            $bad_medicine->cgst_value =  $request->cgst_value;
            $bad_medicine->sgst =  $request->sgst;
            $bad_medicine->sgst_value =  $request->sgst_value;
            $bad_medicine->igst =  $request->igst;
            $bad_medicine->igst_value =  $request->igst_value;
            $bad_medicine->amount =  $request->amount;
            $status = $bad_medicine->save();

            DB::commit();
            if ($status) {
                return redirect()->route('bad-medicine-details')->with('success', 'Medicine Added Sucessfully');
            } else {
                return redirect()->route('bad-medicine-details')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('bad-medicine-details')->with('error', "Something Went Wrong");
        }
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
        $medicine_bill_details = MedicineBillingDetails::select('medicine_units.medicine_unit_name', 'medicine_catagories.medicine_catagory_name', 'medicines.medicine_name as med_nam', 'medicine_billing_details.amount', 'medicine_billing_details.*')

            ->leftjoin('medicines', 'medicine_billing_details.medicine_name', '=', 'medicines.id')
            ->leftjoin('medicine_catagories', 'medicines.medicine_catagory', '=', 'medicine_catagories.id')
            ->leftjoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->where('medicine_billing_id', $id)
            ->get();
        return view('pharmacy.generate-bill.bill-details', compact('medicine_bill_details', 'medicine_bill'));
    }
    public function print_medicine_bill($bill_id)
    {
        $id = base64_decode($bill_id);
        $medicine_bill = MedicineBilling::where('id', $id)->first();
        $medicine_bill_details = MedicineBillingDetails::select('medicine_units.medicine_unit_name', 'medicine_catagories.medicine_catagory_name', 'medicines.medicine_name as med_nam', 'medicine_billing_details.amount', 'medicine_billing_details.*')

            ->leftjoin('medicines', 'medicine_billing_details.medicine_name', '=', 'medicines.id')
            ->leftjoin('medicine_catagories', 'medicines.medicine_catagory', '=', 'medicine_catagories.id')
            ->leftjoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->where('medicine_billing_id', $id)
            ->get();

        $header_image = AllHeader::where('header_name', 'medicine_bill')->first();
        $pdf = PDF::loadView('pharmacy.generate-bill.bill-print', compact('medicine_bill_details', 'medicine_bill', 'header_image'));
        return $pdf->stream('medicine-bill.pdf');
    }
}
