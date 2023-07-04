<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slot;

class BookingAppointmentController extends Controller
{

    public function all_department_list()
    {
        $department_list = Department::where('is_active', '1')

            ->get();

        return response()->json($department_list);
    }

    public function doctor_list(Request $request)
    {
        // dd($request->department_id);
        // $doctor_list = User::where('role', 'Doctor')->where('department','=', $request->department_id)->get();
        $data = User::where('role', 'Doctor')
            ->join('designations', 'designations.id', 'users.designation')
            ->join('departments', 'departments.id', 'users.department')
            ->get();

        foreach ($data  as $key => $doctor) {
            if ($doctor->profile_image != null || $doctor->profile_image != '') {
                $data[$key]['profile_image'] = config('app.url') . '/' . 'public/profile_picture/' . $doctor->profile_image;
            } else {
                $data[$key]['profile_image'] = '';
            }
        }

        //dd($doctor_list);
        // $Slot = Collect();
        // foreach ($doctor_list as $dlist) {
        //     $Slotlist = Slot::where('doctor', $dlist->id)->get();
        //     $Slot = $Slot->concat($Slotlist);
        // }

        return response()->json(['doctors_list' => $data]);
    }

    // -----------------------------------------
    public function fetch_all_staff()
    {
        $data = User::where('is_active', '1')->get();
        foreach ($data  as $key => $staff) {
            if ($staff->profile_image != null || $staff->profile_image != '') {
                $data[$key]['profile_image'] = config('app.url') . '/' . 'public/profile_picture/' . $staff->profile_image;
            } else {
                $data[$key]['profile_image'] = '';
            }
        }
        return response()->json(['staff_list' => $data]);
    }
}
