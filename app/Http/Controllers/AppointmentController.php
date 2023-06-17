<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\shift\Shift;
use App\Models\Slot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Notification;
use Auth;


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
             'slot'                      => $request->slot,
            'appointment_priority'      => $request->appointment_priority,
            'message'                   => $request->message,
        ]);

        $patient_details = Patient::where('id',$request->patient_id)->first();
        //dd($patient_details);
        $user_details = User::where('id',$request->doctor)->first();
        $message = "<a href=".route('all-appointments-details').">".$patient_details->first_name." ".$patient_details->last_name." has booked a appointment with " .$user_details->first_name.' '.$user_details->last_name." for ".date('d-m-Y',strtotime($request->appointment_date))."</a>";
        $notification = new Notification();
        $notification->message = $message;
        $notification->date = $request->appointment_date;
        $notification->created_by = Auth::user()->id;
        $notification->save();

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
        $appointment->slot = $request->slot;
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
            if ($request->doctor != '') {
                $query->where('doctor', $request->doctor);
            }
            if ($request->date != '') {
                $query->where('appointment_date', '=', $request->date);
            }
            if ($request->slot != '') {
                $query->where('slot', '=', $request->slot);
            }
        })->get();

        $doctors = User::where('role', 'Doctor')->get();
        // dd($appointment);

        return view('appointment.dr-wise-appointment', compact('appointment', 'all_search_data','doctors'));
    }

    public function get_slot_details_using_doctor_id(Request $request)
    {
        $appointment_date = $request->appointmentDate;
        $doctor_id = $request->doctorId;
        $day = date('l',strtotime($appointment_date));
        $doctor_slot_details = Slot::where('days',$day)->where('doctor',$doctor_id)->get();
        return response()->json($doctor_slot_details);
    }
}
