<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BookingAppointmentController extends Controller
{
    public function doctor_list()
    {
        $doctor_list = User::where('role', 'Doctor')->get();
        return response()->json($doctor_list);
    }
    
}
