<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Prefix;
use App\Models\User;
use App\Models\Slot;
use App\Models\Appointment;
use DB;

class AppointmentBookingController extends Controller
{
    public function index()
    {
        $general_setting = DB::table('general_settings')->first();
        return view('appointment-frontend.index',compact('general_setting'));
    }
    public function search_patient_for_appointment(Request $request)
    {
        $patient_ph_no = $request->patient_mobile_no;
        $patient_details = Patient::where('phone',$patient_ph_no)->get();
        return view('appointment-frontend.patient-search',compact('patient_details','patient_ph_no'));
    }
    public function otp_varification()
    {
        return view('appointment-frontend.otp-varification');
    }
    public function patient_search()
    {
        return view('appointment-frontend.patient-search');
    }
    public function patient_details($id)
    {
        $patient_id  = base64_decode($id);
        $patient_details = Patient::where('id',$patient_id)->first();
        // Generate a 5-digit OTP
        $otp = mt_rand(10000, 99999);
        // Create a new Leads instance
        $contacts = $patient_details->phone;
        $patient_details->otp = $otp ;
        $patient_details->save();

        $msg= 'Your%20OTP%20for%20verification%20is%3A%20'.$otp;
        $xx= $this->sendsms($contacts,$msg);

        return view('appointment-frontend.patient-details',compact('patient_details'))->with('success','OTP send your mobile no!!!');
    }
    public function sendsms($contacts,$msg)
    { 
        $message=$msg;
       
        $url="https://www.fast2sms.com/dev/bulkV2?authorization=6ZTgliRqceh34b8EnNVBuoQfUs5ykFCAOzvpWPr709SJxXHMa1WHvc4CpPlefBEN0dsX78njKxAQaIRF&route=v3&sender_id=FTWSMS&message=$message&language=english&flash=0&numbers=$contacts";
        $i = file_get_contents($url);
        return response()->json($i);
    }
    public function add_new_patient_for_appointment(Request $request)
    {
        $patient_prefix = Prefix::where('name', 'patient')->first();
        try {
            DB::beginTransaction();

            // Generate a 5-digit OTP
            $otp = mt_rand(10000, 99999);
            // Create a new Leads instance

            $patient = new Patient();
            $patient->patient_prefix =  $patient_prefix->prefix;
            $patient->prefix = '';
            $patient->first_name = $request->patient_name;
            $patient->middle_name = '';
            $patient->last_name = '';
            $patient->guardian_name = $request->guardian_name;
            $patient->gender = $request->patient_gender;
            $patient->year = $request->patient_age;
            $patient->local_guardian_name = $request->guardian_name;
            $patient->phone = $request->patient_phone;
            $patient->otp = $otp;
            $patient->save();

            $contacts = $request->patient_phone;

            // $msg= 'Your%20OTP%20for%20verification%20is%3A%20'.$otp;
            // $xx= $this->sendsms($contacts,$msg);
            // // Encrypt the insert ID

            DB::commit();
            return redirect()->route('appointment-booking.patient-details', base64_encode($patient->id))->with('success', 'Registation Successfully and send a OTP to your mobile no.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('appointment-booking')->with('error', $th->getMessage());
        }
    }
    public function verifyOTP(Request $request)
    {

    $patient_id = $request->input('patient_id');
    $otp = $request->input('otp');
    $patient_details = Patient::where('id', $patient_id)->first();

    if ($patient_details) {
        if ($patient_details->otp === $otp) {
            // OTP verification successful
            // dd('Thank you for registering!');
            $message = "Thank you for registering!";
            return redirect()->route('appointment-booking.department-list',base64_encode($patient_id))->with('success', $message);
        } else {
            // OTP verification failed
            $message = "Wrong OTP. Please try again.";
            return redirect()->back()->with('error', $message);
        }
        } else {
            // Lead not found
            $message = "Invalid phone number. Please try again.";
        return redirect()->back()->with('error', $message);
        }
    }
    public function department_list($patient_id)
    {
        return view('appointment-frontend.departments',compact('patient_id'));
    }

    public function department_doctor_list($department_id,$patient_id)
    {
        $doctor_details = User::where('department',$department_id)->get();
        //dd($doctor_details);
        return view('appointment-frontend.doctor',compact('department_id','patient_id','doctor_details'));
    }
    public function get_slot_by_appointment_doctor_and_date(Request $request)
    {
        $slot_details = Slot::where('doctor',$request->doctorId)->where('date',$request->appointMentdate)->get();
        return response()->json($slot_details);
    }
    public function slot_booking($slot,$patient_id,$doctor,$appointment_date)
    {
        $status = Appointment::insertGetId([
            'patient_id'                => $patient_id,
            'doctor'                    => $doctor,
            'appointment_date'          => $appointment_date,
            'slot'                      => $slot,
            'appointment_priority'      => 'Normal',
        ]);

        $slot_status_change = Slot::find($slot);
        $slot_status_change->is_booked = '1';
        $slot_status_change->save();
    }


}
