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
        $slots      = Slot::orderBy('id','DESC')->get();
        return view('setup.appointment.slots.slots-listing', compact('slots'));
    }

    public function add_slots_details()
    {
        $slots          = Slot::all();
        $shift          = Shift::all();
        $charge_name      = Charge::where('charges_sub_catagory_id',27)->get();
        $doctor         = User::where('role', '=', 'Doctor')->get();

        return view('setup.appointment.slots.add-slots', compact('slots', 'doctor', 'shift', 'charge_name'));
    }

    public function save_slots_details(Request $request)
    {
        $validate = $request->validate([
            'doctor'                    => 'required',
            'date'                      => 'required',
            'from_time'                 => 'required',
            'to_time'                   => 'required',
            'standard_charges'          => 'required',
            'charge'                    => 'required',
        ]);

        $status = Slot::insert([
            'doctor'                    => $request->doctor,
            'date'                      => $request->date,
            'charge'                    => $request->charge,
            'standard_charges'          => $request->standard_charges,
            'from_time'                 =>  $request->from_time,
            'to_time'                   =>  $request->to_time,
        ]);

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
        $charge_name      = Charge::where('charges_sub_catagory_id',27)->get();
        $doctor     = User::where('role', '=', 'Doctor')->get();

        return view('setup.appointment.slots.edit-slots', compact('slots', 'editSlots', 'shift','doctor','charge_name'));
    }

    public function update_slots_details(Request $request)
    {
        $validate = $request->validate([
            'doctor'                    => 'required',
            'date'                      => 'required',
            'from_time'                 => 'required',
            'to_time'                   => 'required',
            'standard_charges'          => 'required',
            'charge'                    => 'required',


        ]);

        $slots = Slot::find($request->id);
        $slots->doctor                   = $request->doctor;
        $slots->date                     = $request->date;
        $slots->charge                   = $request->charge;
        $slots->standard_charges         = $request->standard_charges;
        $slots->from_time                = $request->from_time;
        $slots->to_time                  = $request->to_time;
        $status = $slots->save();

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
        $charge_amount = Charge::select('charges_with_charges_types.standard_charges as charge_amount')->join('charges_with_charges_types', 'charges.id', '=', 'charges_with_charges_types.charge_id')->where('charges.id', $request->charges)->where('charges_with_charges_types.charge_type_id', '1')->first();

        return response()->json($charge_amount);
    }

    public function doctor_slot_status_change($status,$slot_id)
    {
        $slots = Slot::find($slot_id);
        $slots->status                   = $status;
        $status = $slots->save();
        if ($status) {
            return redirect()->route('slots-details')->with('success', 'Slot Status Updated Sucessfully');
        } else {
            return redirect()->route('slots-details')->with('error', "Something Went Wrong");
        }
    }
}
