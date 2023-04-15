<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\InventoryVendor;

class InventoryVendorController extends Controller
{
    public function inventory_vendor_listing()
    {
        $vendors = InventoryVendor::all();
        return view('setup.Inventory.vendor.vendor-listing', compact('vendors'));
    }

    public function add_inventory_vendor()
    {
        return view('setup.Inventory.vendor.add-vendor');
    }

    public function save_inventory_vendor(Request $request)
    {
        $request->validate([
            'name' => 'required|',
            'email' => 'required|email',
            'pnno' => 'required|numeric',
            'pin' => 'required|numeric',
            'gst' => 'required|numeric',
            'address' => 'required',
        ]);

        try {

            $vendor = new InventoryVendor;
            $vendor->vendor_name = $request->name;
            $vendor->email = $request->email;
            $vendor->vendor_ph_no = $request->pnno;
            $vendor->contact_name = $request->contact_name;
            $vendor->pin = $request->pin;
            $vendor->vendor_gst = $request->gst;
            $vendor->vendor_address = $request->address;

            $vendor->save();

            if ($vendor->save()) {
                return redirect()->route('inventory-vendor')->with('success', "Vendor Added Sucessfully");
            } else {
                return back()->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit_inventory_vendor($id)
    {
        $vendorId = base64_decode($id);
        $data = InventoryVendor::find($vendorId);
        return view('setup.pharmacy.medicine-vendor.edit-vendor', compact('data'));
    }

    public function update_inventory_vendor(Request $request)
    {
        $request->validate([
            'name' => 'required|',
            'email' => 'required|email',
            'vendor_ph_no' => 'required|numeric',
            'pin' => 'required|numeric',
            'vendor_gst' => 'required|numeric',
            'contact_name' => 'required',
            'vendor_address' => 'required',
        ]);


        $data = InventoryVendor::find($request->vendor_id);


        $data->vendor_name            = $request->name;
        $data->email                = $request->email;
        $data->vendor_ph_no            = $request->vendor_ph_no;
        $data->pin                    = $request->pin;
        $data->vendor_gst            = $request->vendor_gst;
        $data->contact_name         = $request->contact_name;
        $data->vendor_address        = $request->vendor_address;


        $data->save();

        return redirect()->route('inventory-vendor')->with('success', "Vendor Details edited successfully");
    }

    public function delete_inventory_vendor(Request $request)
    {
        $data = InventoryVendor::find($request->vendorId);

        if ($data->delete()) {
            return back()->with('success', "vendor Removed Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function vendorStatusActionInventory(Request $req, $id)
    {
        //get post status with the help of post id

        $data = DB::table('inventory_vendors')->select('is_active')->where('id', '=', $id)->first();

        //check post status

        if ($data->is_active == '1') {
            $is_active = '0';
        } else {
            $is_active = '1';
        }

        $data = array('is_active' => $is_active);
        DB::table('inventory_vendors')->where('id', $id)->update($data);
        $req->session()->flash('success', 'Status has been updated successfully!');

        return redirect()->route('inventory-vendor');
    }

    public function vendorActivationInventory($id)
    {
        // is_active

    }
}
