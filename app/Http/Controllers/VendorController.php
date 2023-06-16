<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function medicine_vendor_listing()
    {
        $vendors = Vendor::all();
        return view('setup.pharmacy.medicine-vendor.vendor-listing', compact('vendors'));
    }

    public function add_medicine_vendor_listing()
    {
        return view('setup.pharmacy.medicine-vendor.add-vendor');
    }

    public function save_medicine_vendor(Request $request)
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

            $vendor = new Vendor;
            $vendor->vendor_name = $request->name;
            $vendor->email = $request->email;
            $vendor->vendor_ph_no = $request->pnno;
            $vendor->contact_name = $request->contact_name;
            $vendor->pin = $request->pin;
            $vendor->vendor_gst = $request->gst;
            $vendor->vendor_address = $request->address;

            $vendor->save();

            if ($vendor->save()) {
                return redirect()->route('medicine-vendor-details')->with('success', "Vendor Added Sucessfully");
            } else {
                return back()->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit_medicine_vendor($id)
    {
        $vendorId = base64_decode($id);
        $data = Vendor::find($vendorId);
        return view('setup.pharmacy.medicine-vendor.edit-vendor', compact('data'));
    }

    public function update_medicine_vendor(Request $request)
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


        $data = Vendor::find($request->vendor_id);
        $data->vendor_name            = $request->name;
        $data->email                = $request->email;
        $data->vendor_ph_no            = $request->vendor_ph_no;
        $data->pin                    = $request->pin;
        $data->vendor_gst            = $request->vendor_gst;
        $data->contact_name         = $request->contact_name;
        $data->vendor_address        = $request->vendor_address;
        $data->save();

        return redirect()->route('medicine-vendor-details')->with('success', "Vendor Details Updated successfully");
    }

    public function delete_medicine_vendor(Request $request)
    {
        $data = Vendor::find($request->vendorId);

        if ($data->delete()) {
            return back()->with('success', "vendor Removed Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function vendorStatusAction(Request $req, $id)
    {
        //get post status with the help of post id

        $data = DB::table('vendors')->select('is_active')->where('id', '=', $id)->first();

        //check post status

        if ($data->is_active == '1') {
            $is_active = '0';
        } else {
            $is_active = '1';
        }

        //update post status

        $data = array('is_active' => $is_active);
        DB::table('vendors')->where('id', $id)->update($data);
        $req->session()->flash('success', 'Status has been updated successfully!');

        return redirect()->route('medicine-vendor-details');
    }

    public function vendorActivation($id)
    {
        // is_active

    }
}
