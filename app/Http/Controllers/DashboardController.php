<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmgPatientDetails;
use App\Models\IpdDetails;
use Illuminate\Http\Request;
use App\Models\OpdVisitDetails;
use App\Models\PathologyBilling;
use App\Models\PathologyPatientTest;
use can;
use Carbon\Carbon;
use App\Models\MedicineBilling;
use App\Models\Billing;

class DashboardController extends Controller
{
    public function index()
    {

        $opd_today_ticket_details =  OpdVisitDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->sum('ticket_fees');

        // dd($opd_today_ticket_details);
        $opd_today_new_patient =  OpdVisitDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->where('visit_type', '=', 'New Visit')->count();
        // dd($opd_today_new_patient);


        $opd_today_revisit_patient =  OpdVisitDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->where('visit_type', '=', 'Revisit')->count();
        // dd($opd_today_revisit_patient);

        $today_emg_patient =  EmgPatientDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->count();


        $today_emg_income =  EmgPatientDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->sum('ticket_fees');

        // dd($today_emg_income);

        $total_ipd_patient =  IpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->count();

        $today_total_ipd_patient =  IpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('appointment_date', 'like', date('Y-m-d') . '%')->count();
        //   dd($today_total_ipd_patient);

        $today_ipd_from_opd_patient =  IpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('patient_source', '=', 'OPD')->where('appointment_date', 'like', date('Y-m-d') . '%')->count();

        $today_ipd_from_emg_patient =  IpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('patient_source', '=', 'EMG')->where('appointment_date', 'like', date('Y-m-d') . '%')->count();

        $today_discharged_patient =  IpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('discharged', '=', 'yes')->where('discharged_date', 'like', date('Y-m-d') . '%')->count();

        // $ipd_income =  IpdDetails::where(function ($query) {
        //     if (!auth()->user()->can('False Generation')) {
        //         $query->where('ins_by', 'ori');
        //     }
        // })->sum('ticket_fees');

        // $pathology_income =  PathologyPatientTest::where(function ($query) {
        //     if (!auth()->user()->can('False Generation')) {
        //         $query->where('ins_by', 'ori');
        //     }
        // })->leftJoin('pathology_billings', 'pathology_billings.patientId', '=', 'pathology_patient_tests.patient_id')->sum('grand_total');

        $pharmacy_income =  MedicineBilling::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->leftJoin('medicine_billing_details', 'medicine_billing_details.medicine_billing_id', '=', 'medicine_billings.id')->sum('total_amount');

        // dd($pharmacy_income);

        //all billing details

        $opd_billing_details = Billing::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('section', 'OPD')
            ->sum('grand_total');

        $ipd_billing_details = Billing::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('section', 'IPD')
            ->sum('grand_total');

        $emg_billing_details = Billing::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->where('section', 'EMG')
            ->sum('grand_total');



        return view('appPages.dashboard', compact('opd_today_ticket_details', 'opd_today_new_patient', 'opd_today_revisit_patient', 'today_emg_patient', 'today_emg_income', 'total_ipd_patient', 'today_total_ipd_patient', 'today_ipd_from_opd_patient', 'today_ipd_from_emg_patient', 'today_discharged_patient', 'pharmacy_income', 'opd_billing_details', 'ipd_billing_details', 'emg_billing_details'));
    }
}
