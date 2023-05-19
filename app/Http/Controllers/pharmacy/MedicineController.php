<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\MedicineCatagory;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Imports\MedicineImport;
use App\Models\MedicineBaseUnit;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MedicineBoxStrip;
use App\Models\MedicineStock;
use App\Models\MedicineStoreRoom;
use App\Models\MedicineUnit;
use App\Models\SimilarMedicine;
use Faker\Provider\Medical;
use Google\Service\ChromePolicy\Resource\Media;

class MedicineController extends Controller
{
    public function medicine_details()
    {
        $medicine = Medicine::all();
        return view('pharmacy.medicine.medicine-listing', compact('medicine'));
    }

    public function add_medicine_details()
    {
        $baseUnit = MedicineUnit::all();
        $similarMedicine = Medicine::all();
        $medicine_catagory = MedicineCatagory::all();

        return view('pharmacy.medicine.add-medicine', compact('baseUnit', 'medicine_catagory', 'similarMedicine'));
    }

    public function save_medicine_details(Request $request)
    {
        $validate = $request->validate([
            'medicine_name'             => 'required',
            'medicine_catagory'         => 'required',
            'unit'                       => 'required',
            'min_level'                   => 'required',
        ]);

        try {
            $filename = '';
            if ($request->hasfile('medicine_photo')) {
                $file = $request->file('medicine_photo');
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $fileSave =  $file->move("public/assets/images/medicine/", $filename);
            }

            $medicine = new Medicine();
            $medicine->medicine_name            = $request->medicine_name;
            $medicine->medicine_catagory        = $request->medicine_catagory;
            $medicine->medicine_company         = $request->medicine_company;
            $medicine->medicine_composition     = $request->medicine_composition;
            $medicine->medicine_group           = $request->medicine_group;
            $medicine->min_level                = $request->min_level;
            $medicine->unit                     = $request->unit;
            $medicine->tax                      = $request->tax;
            $medicine->note                     = $request->note;
            $medicine->medicine_photo           = $filename;
            $status =  $medicine->save();

            // foreach ($request->medicine_base_unit as $key => $medicine_base_unit) {
            //     $baseUnit = new MedicineBaseUnit();
            //     $baseUnit->medicine_id                 = $medicine->id;
            //     $baseUnit->medicine_base_unit          = $request->medicine_base_unit[$key];
            //     $baseUnit->medicine_unit               = $request->medicine_unit[$key];
            //     $baseUnit->value                       = $request->value[$key];
            //     $status = $baseUnit->save();
            // }

            if (@$request->similiar_medicine_name) {
                foreach ($request->similiar_medicine_name as $key => $medicine_names) {
                    $similar_medicine = new SimilarMedicine();
                    $similar_medicine->medicine_id                 = $medicine->id;
                    $similar_medicine->medicine_name               = $request->similiar_medicine_name[$key];
                    $status = $similar_medicine->save();
                }
            }

            if ($status) {
                return redirect()->route('all-medicine-listing')->with('success', 'Medicine Added Sucessfully');
            } else {
                return redirect()->route('all-medicine-listing')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return redirect()->route('all-medicine-listing')->with('error', "Something Went Wrong");
        }
    }

    public function edit_medicine_details($id)
    {
        $id = base64_decode($id);
        $editMedicine = Medicine::where('id', $id)->first();
        $medicine_catagory = MedicineCatagory::all();
        $medicine_box_strip = MedicineBoxStrip::where('medicine_id', $id)->get();
        $editSimilarMedicine = SimilarMedicine::where('medicine_id', $id)->get();
        $editBaseUnit = MedicineBaseUnit::where('medicine_id', $id)->get();
        $similarMedicine = Medicine::all();
        $baseUnit = MedicineUnit::all();

        return view('pharmacy.medicine.edit-medicine', compact('baseUnit', 'editBaseUnit', 'editSimilarMedicine', 'similarMedicine', 'editMedicine', 'medicine_catagory', 'medicine_box_strip'));
    }

    public function update_medicine_details(Request $request)
    {

        $validate = $request->validate([
            'medicine_name'             => 'required',
            'medicine_catagory'         => 'required',
            'unit'                       => 'required',
            'min_level'                   => 'required',
        ]);
        $filename = '';
        if ($request->hasfile('medicine_photo')) {
            $file = $request->file('medicine_photo');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/medicine/", $filename);
        }

        $medicine = Medicine::find($request->id);
        $medicine->medicine_name            = $request->medicine_name;
        $medicine->medicine_catagory        = $request->medicine_catagory;
        $medicine->medicine_company         = $request->medicine_company;
        $medicine->medicine_composition     = $request->medicine_composition;
        $medicine->medicine_group           = $request->medicine_group;
        $medicine->min_level                = $request->min_level;
        $medicine->unit                     = $request->unit;
        // $medicine->re_order_level           = $request->re_order_level;
        $medicine->tax                      = $request->tax;
        $medicine->note                     = $request->note;
        $medicine->medicine_photo           = $filename;
        $status =  $medicine->save();


        SimilarMedicine::where('medicine_id', $request->id)->delete();

        if (@$request->similiar_medicine_name[0]->id) {
            foreach ($request->similiar_medicine_name as $key => $medicine_names) {
                $similar_medicine = new SimilarMedicine();
                $similar_medicine->medicine_id                 = $medicine->id;
                $similar_medicine->medicine_name               = $request->similiar_medicine_name[$key];
                $status = $similar_medicine->save();
            }
        }


        //    MedicineBaseUnit::where('medicine_id', $request->id)->delete();

        // foreach ($request->medicine_base_unit as $key => $medicine_base_unit) {
        //     $baseUnit = new MedicineBaseUnit();
        //     $baseUnit->medicine_id                 = $medicine->id;
        //     $baseUnit->medicine_base_unit          = $request->medicine_base_unit[$key];
        //     $baseUnit->medicine_unit               = $request->medicine_unit[$key];
        //     $baseUnit->value                       = $request->value[$key];
        //     $status = $baseUnit->save();
        // }

        if ($status) {
            return redirect()->route('all-medicine-listing')->with('success', 'Medicine Updated Sucessfully');
        } else {
            return redirect()->route('all-medicine-listing')->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_details($id)
    {
        $id = base64_decode($id);
        Medicine::find($id)->delete();
        return back()->with('success', 'Medicine Deleted Successfully');
    }

    public function import_medicine()
    {
        $medicine_catagory = MedicineCatagory::all();
        return view('pharmacy.medicine.import-medicine', compact('medicine_catagory'));
    }

    public function upload_import_medicine()
    {
        $dat = Excel::import(new MedicineImport, request()->file('medicine_file'));
        return redirect()->route('all-medicine-listing')->with('success', 'Medicine Import Sucessful');
    }

    public function update_stock_form($medicine_id)
    {
        $medicine_details = Medicine::find($medicine_id);
        $medicine = Medicine::all();
        $store_room = MedicineStoreRoom::all();
        $medicine_catagory = MedicineCatagory::all();
        return view('pharmacy.update-stock', compact('medicine_details', 'medicine', 'store_room', 'medicine_catagory'));
    }

    public function save_update_stock_form(Request $request)
    {

        $validate = $request->validate([
            'medicine_name'             => 'required',
            'medicine_category'         => 'required',
        ]);

        try {

            $medicine = new MedicineStock();
            $medicine->stored_room              = $request->stored_room;
            $medicine->medicine_category        = $request->medicine_category;
            $medicine->medicine_name            = $request->medicine_name;
            $medicine->batch_no                 = $request->batch_no;
            $medicine->expiry_date              = date('Y-m-d', strtotime($request->expiry_date));
            $medicine->quantity                 = $request->quantity;
            $medicine->mrp                      = $request->mrp;
            $medicine->unit                     = $request->unit;
            $medicine->sale_price               = $request->sale_price;
            $medicine->purchase_price           = $request->purchase_price;
            $medicine->amount                   = $request->amount;
            $status =  $medicine->save();

            if ($status) {
                return redirect()->route('all-medicine-stock')->with('success', 'Medicine Added Sucessfully');
            } else {
                return redirect()->route('all-medicine-stock')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return redirect()->route('all-medicine-stock')->with('error', "Something Went Wrong");
        }
    }
}
