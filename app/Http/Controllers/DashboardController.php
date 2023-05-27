<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmgPatientDetails;
use App\Models\IpdDetails;
use Illuminate\Http\Request;
use App\Models\OpdVisitDetails;
use App\Models\Billing;
use App\Models\PathologyBilling;
use App\Models\PathologyPatientTest;
use can;
use Carbon\Carbon;
use App\Models\MedicineBilling;
use date;

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
        $before_today_billing = Billing::where('bill_date','like','2023-05-27%')->sum('grand_total');
        $before_two_billing = Billing::where('bill_date','like','2023-05-26%')->sum('grand_total');
        $before_three_billing = Billing::where('bill_date','like','2023-05-25%')->sum('grand_total');
        $before_four_billing = Billing::where('bill_date','like','2023-05-24%')->sum('grand_total');
        $before_five_billing = Billing::where('bill_date','like','2023-05-23%')->sum('grand_total');
        $before_six_billing = Billing::where('bill_date','like','2023-05-22%')->sum('grand_total');
        $before_seven_billing = Billing::where('bill_date','like','2023-05-21%')->sum('grand_total');
        $before_eight_billing = Billing::where('bill_date','like','2023-05-20%')->sum('grand_total');
        $before_nine_billing = Billing::where('bill_date','like','2023-05-19%')->sum('grand_total');
        $before_ten_billing = Billing::where('bill_date','like','2023-05-18%')->sum('grand_total');

        // dd($pharmacy_income);

        return view('appPages.dashboard', compact('opd_today_ticket_details', 'opd_today_new_patient', 'opd_today_revisit_patient', 'today_emg_patient', 'today_emg_income', 'total_ipd_patient', 'today_total_ipd_patient', 'today_ipd_from_opd_patient', 'today_ipd_from_emg_patient', 'today_discharged_patient', 'pharmacy_income','before_today_billing','before_two_billing','before_three_billing','before_four_billing','before_five_billing','before_six_billing','before_seven_billing','before_eight_billing','before_nine_billing','before_ten_billing'));
    }
}
