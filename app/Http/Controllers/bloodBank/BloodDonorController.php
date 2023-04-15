<?php

namespace App\Http\Controllers\bloodBank;

use App\Http\Controllers\Controller;
use App\Models\bloodBank\BloodDonor;
use Illuminate\Http\Request;

class BloodDonorController extends Controller
{
    public function all_blood_donor_details()
    {
        $bloodDonorDetails = BloodDonor::all();
        return view('Blood_bank.blood-donor.blood-donor-listing',compact('bloodDonorDetails'));
    }

    public function add_blood_donor()
    {

        return view('Blood_bank.blood-donor.add-blood-donor');
    }

    public function save_blood_donor(Request $request)
    {
        $request->validate([
            'donor_name'    => 'required',
            'date_of_birth' => 'required',
            'blood_group'   => 'required',
            'gender'        => 'required',
        ]);

        $donorDetails = new BloodDonor();
        $donorDetails->donor_name       = $request->donor_name;
        $donorDetails->date_of_birth    = $request->date_of_birth;
        $donorDetails->blood_group      = $request->blood_group;
        $donorDetails->gender           = $request->gender;
        $donorDetails->father_name      = $request->father_name;
        $donorDetails->ph_no            = $request->ph_no;
        $donorDetails->address          = $request->address;
        $status = $donorDetails->save();

        if ($status) {
            return redirect()->route('all-blood-donor-details-listing')->with('success', " Blood Donor Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_blood_donor($id, Request $request)
    {
        $id = base64_decode($id);
        $editBloodDonor      = BloodDonor::where('id', $id)->first();

        return view('Blood_bank.blood-donor.edit-blood-donor', compact('editBloodDonor'));
    }

    public function update_blood_donor(Request $request)
    {
        $request->validate([
            'donor_name'    => 'required',
            'date_of_birth' => 'required',
            'blood_group'   => 'required',
            'gender'        => 'required',
        ]);

        $donorDetails = BloodDonor::where('id', $request->id)->first();
        $donorDetails->donor_name       = $request->donor_name;
        $donorDetails->date_of_birth    = $request->date_of_birth;
        $donorDetails->blood_group      = $request->blood_group;
        $donorDetails->gender           = $request->gender;
        $donorDetails->father_name      = $request->father_name;
        $donorDetails->ph_no            = $request->ph_no;
        $donorDetails->address          = $request->address;
        $status = $donorDetails->save();

        if ($status) {
            return redirect()->route('all-blood-donor-details-listing')->with('success', " Blood Donor Updated Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_blood_donor($id)
    {
        $id = base64_decode($id);
        BloodDonor::find($id)->delete();
        return back()->with('success', "Blood Donor Deleted Succesfully");
    }
}
