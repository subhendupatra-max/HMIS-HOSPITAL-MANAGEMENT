<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmgPatientDetails;
use Illuminate\Http\Request;
use App\Models\OpdVisitDetails;
use can;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $opd_today_ticket_details =  OpdVisitDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            } else if (auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori')->where('ins_by', 'sys');
            }
        })->sum('ticket_fees');

        // dd($opd_today_ticket_details);
        $opd_today_new_patient =  OpdVisitDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            } else if (auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori')->where('ins_by', 'sys');;
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->where('visit_type', '=', 'New Visit')->count();
        // dd($opd_today_new_patient);


        $opd_today_revisit_patient =  OpdVisitDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            } else if (auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori')->where('ins_by', 'sys');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->where('visit_type', '=', 'Revisit')->count();
        // dd($opd_today_revisit_patient);


        $opd_today_new_patient =  EmgPatientDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            } else if (auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori')->where('ins_by', 'sys');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->where('visit_type', '=', 'New Visit')->count();

        return view('appPages.dashboard', compact('opd_today_ticket_details', 'opd_today_new_patient', 'opd_today_revisit_patient'));
    }
}
