<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentBookingController extends Controller
{
    public function index()
    {
        return view('appointment-frontend.index');
    }
}
