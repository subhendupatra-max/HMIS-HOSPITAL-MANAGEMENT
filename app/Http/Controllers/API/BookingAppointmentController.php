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
        $department_list = Department::where('is_active', '1')->get();

        return response()->json($department_list);
    }

    public function doctor_list(Request $request)
    {
        // dd($request->department_id);
        $doctor_list = User::where('role', 'Doctor')->where('department','=', $request->department_id)->get();
        //dd($doctor_list);
        $Slot=Collect();
        foreach($doctor_list as $dlist){
        $Slotlist = Slot::where('doctor',$dlist->id)->get();
        $Slot = $Slot->concat($Slotlist);
        }

        return response()->json(['doctors_list'=>$doctor_list,'slot'=>$Slot]);
    }




    // -----------------------------------------
    public function fetch_all_staff()
    {
        $staff_list = User::where('is_active', '1')->get();

        return response()->json($staff_list);
    }
}
