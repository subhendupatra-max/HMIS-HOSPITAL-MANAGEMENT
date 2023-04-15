<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\MedicineSupplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function medicine_supplier_listing()
    {
        $supplier = MedicineSupplier::all();

        return view('setup.pharmacy.supplier.medicine-supplier-listing', compact('supplier'));
    }

    public function save_medicine_supplier(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required',
        ]);

       $supplier = new MedicineSupplier();
       $supplier->supplier_name             = $request->supplier_name;
       $supplier->supplier_contact          = $request->supplier_contact;
       $supplier->contact_person_name       = $request->contact_person_name;
       $supplier->contact_person_phone      = $request->contact_person_phone;
       $supplier->drug_license_number       = $request->drug_license_number;
       $supplier->address                   = $request->address;

       $status = $supplier->save();
        if ($status) {
            return back()->with('success', " Supplier Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_medicine_supplier($id)
    {
        $supplier = MedicineSupplier::all();
        $editSupplier = MedicineSupplier::where('id', $id)->first();

        return view('setup.pharmacy.supplier.edit-medicine-supplier', compact('supplier', 'editSupplier'));
    }

    public function update_medicine_supplier(Request $request)
    {
       
        $request->validate([
            'supplier_name' => 'required',
        ]);

       $supplier = MedicineSupplier::find($request->id);
       $supplier->supplier_name             = $request->supplier_name;
       $supplier->supplier_contact          = $request->supplier_contact;
       $supplier->contact_person_name       = $request->contact_person_name;
       $supplier->contact_person_phone      = $request->contact_person_phone;
       $supplier->drug_license_number       = $request->drug_license_number;
       $supplier->address                   = $request->address;
     
        $status = $supplier->save();

        if ($status) {
            return redirect()->route('medicine-supplier-details')->with('success', " Supplier Updated Successfully");
        } else {
            return redirect()->route('medicine-supplier-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_supplier($id)
    {
        MedicineSupplier::find($id)->delete();

        return back()->with('success', "Supplier Deleted Successfully");
    }
}
