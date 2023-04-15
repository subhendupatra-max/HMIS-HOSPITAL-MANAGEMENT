<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\ChargesCatagory;
use App\Models\ChargesSubCatagory;
use App\Models\shift\Shift;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function slots_details()
    {
        $slots      = Slot::all();
        return view('setup.appointment.slots.slots-listing', compact('slots'));
    }

    public function add_slots_details()
    {
        $slots          = Slot::all();
        $shift          = Shift::all();
        $catagory       = ChargesCatagory::all();
        $doctor         = User::where('role', '=', 'Doctor')->get();

        return view('setup.appointment.slots.add-slots', compact('slots', 'doctor', 'shift', 'catagory'));
    }

    public function save_slots_details(Request $request)
    {
        $validate = $request->validate([
            'doctor'                    => 'required',
            'days'                      => 'required',
            'from_time'                 => 'required',
            'to_time'                   => 'required',
            'charge_category'           => 'required',
            'charge_sub_category'       => 'required',
            'charge'                    => 'required',
            'tax'                       => 'required',
            'total_amount'              => 'required',
            'standard_charges'          => 'required',
        ]);

        $status = Slot::insert([
            'doctor'                    => $request->doctor,
            'day'                      => $request->days,
            'from_time'                 => $request->from_time,
            'to_time'                   => $request->to_time,
            'charge_category'           => $request->charge_category,
            'charge_sub_category'       => $request->charge_sub_category,
            'charge'                    => $request->charge,
            'tax'                       => $request->tax,
            'total_amount'              => $request->total_amount,
            'standard_charges'          => $request->standard_charges,
        ]);
        $button1 = $request->button1;
        $charge  = Charge::where('id', '=', $request->charge)->first();
        $change_value = $charge->standard_charges;
        if ($change_value != $request->standard_charges && isset($button1)) {
            Charge::where('id', '=', $request->charge)->update(['standard_charges' => $request->standard_charges]);
        }

        if ($status) {
            return redirect()->route('slots-details')->with('success', 'Slot Added Sucessfully');
        } else {
            return redirect()->route('slots-details')->with('error', "Something Went Wrong");
        }
    }

    public function edit_slots_details($id, Request $request)
    {
        $slots      = Slot::all();
        $shift      = Shift::all();
        $editSlots  = Slot::find($id);
        $catagory   = ChargesCatagory::all();
        $doctor     = User::where('role', '=', 'Doctor')->get();

        return view('setup.appointment.slots.edit-slots', compact('slots', 'editSlots', 'shift','doctor','catagory'));
    }

    public function update_slots_details(Request $request)
    {
        $validate = $request->validate([
            'doctor'                    => 'required',
            'days'                      => 'required',
            'from_time'                 => 'required',
            'to_time'                   => 'required',
            'charge_category'           => 'required',
            'charge_sub_category'       => 'required',
            'charge'                    => 'required',
            'tax'                       => 'required',
            'standard_charges'          => 'required',
            'total_amount'              => 'required',
        ]);

        $slots = Slot::find($request->id);
        $slots->doctor                   = $request->doctor;
        $slots->days                     = $request->days;
        $slots->from_time                = $request->from_time;
        $slots->to_time                  = $request->to_time;
        $slots->charge_category          = $request->charge_category;
        $slots->charge_sub_category      = $request->charge_sub_category;
        $slots->charge                   = $request->charge;
        $slots->tax                      = $request->tax;
        $slots->standard_charges         = $request->standard_charges;
        $slots->total_amount             = $request->total_amount;
        $status = $slots->save();

        $button1 = $request->button1;
        $charge  = Charge::where('id', '=', $request->charge)->first();
        $change_value = $charge->standard_charges;
        if ($change_value != $request->standard_charges && isset($button1)) {
            Charge::where('id', '=', $request->charge)->update(['standard_charges' => $request->standard_charges]);
        }

        if ($status) {
            return redirect()->route('slots-details')->with('success', 'Slot Updated Sucessfully');
        } else {
            return redirect()->route('slots-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_slots_details($id)
    {
        Slot::where('id', $id)->delete();

        return redirect()->route('slots-details')->with('success', 'Slot Deleted Sucessfully');
    }

    public function find_sub_catagory_by_catagory(Request $request)
    {
        $subcatagory_by_catagory = ChargesSubCatagory::where('charges_catagories_id', $request->catagory_id)->get();

        return response()->json($subcatagory_by_catagory);
    }

    public function find_charge_by_sub_catagory(Request $request)
    {
        $charge_by_subcatagory = Charge::where('charges_sub_catagory_id', $request->charge_id)->get();

        return response()->json($charge_by_subcatagory);
    }

    public function find_charge_by_statndard_charges(Request $request)
    {
        $charges_value = Charge::where('id', $request->charges)->first();

        return response()->json($charges_value);
    }
}
