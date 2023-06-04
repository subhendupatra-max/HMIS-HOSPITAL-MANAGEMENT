<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\shift\Shift;
use App\Models\Slot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;


class AppointmentController extends Controller
{
    public function appointments_details()
    {
        $appointment = Appointment::all();

        return view('appointment.appointment-listing', compact('appointment'));
    }

    public function add_appointments_details(Request $request, $patientid = null)
    {

        if ($patientid != null) {
            $patient_id = base64_decode($patientid);
        } else {
            $patient_id = $request->patient_id;
        }

        $patient_details_information = Patient::where('id', '=', $patient_id)->first();
        $all_patient = Patient::all();
        $shift = Shift::all();
        $slot  = Slot::all();
        $doctor = User::where('role', 'Doctor')->get();
        return view('appointment.add-appointment', compact('shift', 'slot', 'doctor', 'patient_details_information', 'all_patient'));
    }

    public function save_appointments_details(Request $request)
    {
        $request->validate([
            'doctor' => 'required',
            'appointment_date' => 'required',

        ]);

        $status = Appointment::Insert([
            'patient_id'                => $request->patient_id,
            'doctor'                    => $request->doctor,
            // 'shift'                     => $request->shift,
            'appointment_date'          => $request->appointment_date,
            // 'slot'                      => $request->slot,
            'appointment_priority'      => $request->appointment_priority,
            'message'                   => $request->message,
        ]);

        if ($status) {
            return redirect()->route('all-appointments-details')->with('success', "Appointment Added Successfully");
        } else {
            return redirect()->route('all-appointments-details')->with('error', "Something Went Wrong");
        }
    }

    public function edit_appointments_details($id)
    {
        $id = base64_decode($id);
        $editAppointment = Appointment::where('id', $id)->first();
        // dd($editAppointment);
        $patient_details_information = Patient::where('id', $editAppointment->patient_id)->first();
        $doctor = User::where('role', 'Doctor')->get();
        $shift = Shift::all();
        $slot  = Slot::all();
        return view('appointment.edit-appointment', compact('editAppointment', 'patient_details_information', 'doctor', 'shift', 'slot'));
    }

    public function update_appointments_details(Request $request)
    {
        $request->validate([
            'doctor' => 'required',
            'appointment_date' => 'required',

        ]);
        // dd( $request->patient_id);
        $appointment = Appointment::where('id', $request->id)->first();
        $appointment->patient_id = $request->patient_id;
        $appointment->doctor = $request->doctor;
        // $appointment->shift = $request->shift;
        $appointment->appointment_date = $request->appointment_date;
        // $appointment->slot = $request->slot;
        $appointment->appointment_priority = $request->appointment_priority;
        $appointment->message = $request->message;
        $status = $appointment->save();

        if ($status) {
            return redirect()->route('all-appointments-details')->with('success', "Appointment Updated Successfully");
        } else {
            return redirect()->route('all-appointments-details')->with('error', "Something Went Wrong");
        }
    }






    public function delete_appointments_details($id)
    {
        $id = base64_decode($id);
        Appointment::find($id)->delete();

        return back()->with('success', "Appointment Deleted Successfully");
    }



    public function find_doctor_fees_by_doctor(Request $request)
    {
        $find_fees = Slot::where('doctor', $request->doctor)->first();

        return response()->json($find_fees);
    }

    public function dr_wise_appointments_details()
    {
        // $appointment = Appointment::all();

        $doctors = User::where('role', 'Doctor')->get();
        return view('appointment.dr-wise-appointment', compact('doctors'));
    }


    public function fetch_appointments_details_by_doctor_wise(Request $request)
    {
        $all_search_data = $request->all();

        $appointment = Appointment::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->doctor != '') {
                $query->where('doctor', $request->doctor);
            }
            if ($request->from_date != '') {
                $query->where('appointment_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('appointment_date', '<=', $request->to_date);
            }
        })->get();

        $doctors = User::where('role', 'Doctor')->get();
        // dd($appointment);

        return view('appointment.dr-wise-appointment', compact('appointment', 'all_search_data','doctors'));
    }
}
