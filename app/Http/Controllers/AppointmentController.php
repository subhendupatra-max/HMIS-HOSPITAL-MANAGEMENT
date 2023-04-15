<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\shift\Shift;
use App\Models\Slot;
use Illuminate\Http\Request;
use App\Models\User;


class AppointmentController extends Controller
{
    public function appointments_details()
    {
        $appointment = Appointment::all();

        return view('appointment.appointment-listing', compact('appointment'));
    }

    public function add_appointments_details()
    {
        $shift = Shift::all();
        $slot  = Slot::all();
        $doctor = User::where('role', 'Doctor')->get();
        return view('appointment.add-appointment', compact('shift' , 'slot' ,'doctor'));
    }

    public function save_appointments_details(Request $request)
    {
        $request->validate([
            'doctor' => 'required',
            'doctor_fees' => 'required',
            'shift' => 'required',
            'appointment_date' => 'required',
            'slot' => 'required',
            'payment_mode' => 'required',
        ]);

        $status = Appointment::Insert([
            'doctor'                    => $request->doctor,
            'doctor_fees'               => $request->doctor_fees,
            'shift'                     => $request->shift,
            'appointment_date'          => $request->appointment_date,
            'slot'                      => $request->slot,
            'appointment_priority'      => $request->appointment_priority,
            'payment_mode'              => $request->payment_mode,
            'status'                    => $request->status,
            'message'                   => $request->message,
            'live_consultant'           => $request->live_consultant,
            'alternate_address'         => $request->alternate_address,
        ]);

        if ($status) {
            return back()->with('success', " Appointment Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_appointments_details($id)
    {
        $editAppointment = Appointment::where('id', $id)->first();

        return view('appointment.edit-appointment', compact('editAppointment'));
    }

    public function update_appointments_details(Request $request)
    {
        $request->validate([
            'doctor' => 'required',
            'doctor_fees' => 'required',
            'shift' => 'required',
            'appointment_date' => 'required',
            'slot' => 'required',
            'payment_mode' => 'required',
        ]);

        $appointment = Appointment::find($request->id);
        $appointment->doctor = $request->doctor;
        $appointment->doctor_fees = $request->doctor_fees;
        $appointment->shift = $request->shift;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->slot = $request->slot;
        $appointment->appointment_priority = $request->appointment_priority;
        $appointment->payment_mode = $request->payment_mode;
        $appointment->status = $request->status;
        $appointment->message = $request->message;
        $appointment->live_consultant = $request->live_consultant;
        $appointment->alternate_address = $request->alternate_address;

        $status = $appointment->save();

        if ($status) {
            return redirect()->route('all-appointments-details')->with('success', "Appointment Updated Successfully");
        } else {
            return redirect()->route('all-appointments-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_charges_catagory_details($id)
    {
        Appointment::find($id)->delete();

        return back()->with('success', "Appointment Deleted Successfully");
    }

    public function find_doctor_fees_by_doctor(Request $request)
    {
        $find_fees = Slot::where('doctor' , $request->doctor)->first();

          return response()->json($find_fees);
    }
}
