<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\OpdVisitDetails;
use App\Models\User;
use App\Models\Billing;
use App\Models\IpdDetails;
use App\Models\Payment;
use App\Models\DischargedPatient;
use App\Models\Diagonasis;
use App\Models\Operation;
use App\Models\OperationCatagory;
use App\Models\Medicine;
use App\Models\OperationBooking;
use App\Models\bloodBank\BloodIssue;
use App\Models\BloodGroup;
use App\Models\bloodBank\BloodDonor;
use App\Models\BloodComponentIssue;
use App\Models\DeathReport;
use App\Models\MedicineBillingDetails;
use App\Models\Referral;
use App\Models\ReferralCommissionPayment;
use App\Models\EmgPatientDetails;

class ReportsController extends Controller
{
    public function opd_patient_report_index()
    {
        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();
        $data = [
            'doctors' => $doctors,
            'departments' => $departments,

        ];

        return response()->json($data);
    }

    public function opd_patient_report(Request $request)
    {
        $all_search_data = $request->all();

        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();

        $opd_patient_report = OpdVisitDetails::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->visit_type != '') {
                $query->where('visit_type', $request->visit_type);
            }
            if ($request->patient_type != '') {
                $query->where('patient_type', $request->patient_type);
            }
            if ($request->department != '') {
                $query->where('department_id', $request->department);
            }
            if ($request->cons_doctor != '') {
                $query->where('cons_doctor', $request->cons_doctor);
            }
            if ($request->from_date != '') {
                $query->where('appointment_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('appointment_date', '<=', $request->to_date);
            }
        })->get();
        // dd($opd_patient_report);

        $data = [
            'all_search_data' => $all_search_data,
            'departments' => $departments,
            'doctors' => $doctors,
            'opd_patient_report' => $opd_patient_report,
        ];

        return response()->json($data);
    }
    //opd billing reports

    public function opd_billing_report(Request $request)
    {
        $all_search_data = $request->all();

        $billing_report = Billing::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->from_date != '') {
                $query->where('bill_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('bill_date', '<=', $request->to_date);
            }
        })->where('section', 'OPD')
            ->get();

        $data = [
            'all_search_data' => $all_search_data,
            'billing_report' => $billing_report,
        ];

        return response()->json($data);
    }

    public function emg_patient_index()
    {
        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();
        $data = [
            'departments' => $departments,
            'doctors' => $doctors,
        ];
        return response()->json($data);
    }
    public function fetch_emg_patient_report(Request $request)
    {
        $all_search_data = $request->all();

        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();
        $emg_patient_report = EmgPatientDetails::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->patient_type != '') {
                $query->where('patient_type', $request->patient_type);
            }
            if ($request->medico_legal_case != '') {
                $query->where('medico_legal_case', $request->medico_legal_case);
            }
            if ($request->from_date != '') {
                $query->where('appointment_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('appointment_date', '<=', $request->to_date);
            }
        })->get();

        $data = [
            '$all_search_data' => $all_search_data,
            'departments' => $departments,
            'doctors' => $doctors,
            'emg_patient_report' => $emg_patient_report,
        ];
        return response()->json($data);
    }

    public function fetch_emg_billing_report(Request $request)
    {
        $all_search_data = $request->all();

        $billing_report = Billing::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->from_date != '') {
                $query->where('bill_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('bill_date', '<=', $request->to_date);
            }
        })->where('section', 'EMG')
            ->get();

        $data = [
            '$all_search_data' => $all_search_data,
            'billing_report' => $billing_report,
        ];
        return response()->json($data);
    }

    public function ipd_patient_index()
    {
        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();

        $data = [
            'departments' => $departments,
            'doctors' => $doctors,
        ];
        return response()->json($data);
    }

    public function fetch_ipd_patient_report(Request $request)
    {
        $all_search_data = $request->all();

        $departments = Department::where('is_active', '1')->get();
        $doctors = User::where('is_active', '1')->where('role', 'Doctor')->get();
        $ipd_patient_report = IpdDetails::where(function ($query) use ($request) {
            // if (!auth()->user()->can('False Generation')) {
            //     $query->where('ins_by', 'ori');
            // }
            if ($request->patient_type != '') {
                $query->where('patient_type', $request->patient_type);
            }
            if ($request->department != '') {
                $query->where('department_id', $request->department);
            }
            if ($request->cons_doctor != '') {
                $query->where('cons_doctor', $request->cons_doctor);
            }
            if ($request->from_date != '') {
                $query->where('appointment_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('appointment_date', '<=', $request->to_date);
            }
        })->get();
        $data = [
            'all_search_data' => $all_search_data,
            'departments' => $departments,
            'doctors' => $doctors,
            'ipd_patient_report' => $ipd_patient_report,
        ];
        return response()->json($data);
    }


    public function fetch_ipd_billing_report(Request $request)
    {
        $all_search_data = $request->all();

        $billing_report = Billing::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->from_date != '') {
                $query->where('bill_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('bill_date', '<=', $request->to_date);
            }
        })->where('section', 'IPD')
            ->get();


        $data = [
            'all_search_data' => $all_search_data,
            'billing_report' => $billing_report,
        ];
        return response()->json($data);
    }

    public function payment_report_index()
    {
        $user = User::where('role', 'Receptionist')->get();

        return response()->json(['user' => $user]);
    }

    public function fetch_payment_report(Request $request)
    {
        $all_search_data = $request->all();
        $from_date = date('Y-m-d h:m:s', strtotime($request->from_date));
        $to_date = date('Y-m-d h:m:s', strtotime($request->to_date));

        $payment_report = Payment::where(function ($query) use ($request, $to_date, $from_date) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->section != '') {
                $query->where('section', $request->section);
            }
            if ($request->collected_by != '') {
                $query->where('payment_recived_by', $request->collected_by);
            }
            if ($request->payment_mode != '') {
                $query->where('payment_mode', $request->payment_mode);
            }
            if ($request->from_date != '') {
                $query->where('payment_date', '>=', $from_date);
            }
            if ($request->to_date != '') {
                $query->where('payment_date', '<=', $to_date);
            }
        })->get();
        $user = User::where('role', 'Receptionist')->get();
        $data = [
            'all_search_data' => $all_search_data,
            'payment_report' => $payment_report,
            'user' => $user,
        ];
        return response()->json($data);
    }

    public function discharge_patient_report_index()
    {
        $icd_code = Diagonasis::all();
        return response()->json(['icd_code' => $icd_code]);
    }

    public function fetch_discharge_patient_report(Request $request)
    {
        $all_search_data = $request->all();

        $discharge_details = DischargedPatient::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->discharge_status != '') {
                $query->where('discharge_status', $request->discharge_status);
            }
            if ($request->icd_code != '') {
                $query->where('icd_code', $request->icd_code);
            }
            if ($request->from_date != '') {
                $query->where('discharge_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('discharge_date', '<=', $request->to_date);
            }
        })->get();


        $icd_code = Diagonasis::all();
        // dd($appointment);

        $data = [
            'all_search_data' => $all_search_data,
            'discharge_details' => $discharge_details,
            'icd_code' => $icd_code,
        ];

        return response()->json($data);
    }

    public function pharmacy_bill_report_index()
    {
        $medicine_name = Medicine::all();
        return response()->json(['medicine_name' => $medicine_name]);
    }

    public function fetch_pharmacy_bill_report(Request $request)
    {
        $all_search_data = $request->all();

        $pharmacy_bill_details = MedicineBillingDetails::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->medicine_id != '') {
                $query->where('medicine_billing_details.medicine_name', $request->medicine_id);
            }
            // if ($request->from_date != '') {
            //     $query->where('medicine_billing_details.created_at', '>=', $request->from_date);
            // }
            // if ($request->to_date != '') {
            //     $query->where('medicine_billing_details.created_at', '<=', $request->to_date);
            // }

            if ($request->from_date != '' && $request->to_date != '') {
                $query->whereBetween('medicine_billing_details.created_at', [$request->from_date, $request->to_date]);
            }
        })
            ->leftjoin('medicine_billings', 'medicine_billings.id', '=', 'medicine_billing_details.medicine_billing_id')
            ->leftjoin('patients', 'patients.id', '=', 'medicine_billings.patient_id')
            ->leftjoin('medicines', 'medicines.id', '=', 'medicine_billing_details.medicine_name')
            ->get();


        $medicine_name = Medicine::all();
        // dd($pharmacy_bill_details);

        $data = [
            'all_search_data' => $all_search_data,
            'pharmacy_bill_details' => $pharmacy_bill_details,
            'medicine_name' => $medicine_name,
        ];
        return response()->json($data);
    }

    public function operation_report_index()
    {
        $operation_id = Operation::all();
        $operation_catagory = OperationCatagory::all();

        $data = [
            'operation_id' => $operation_id,
            'operation_catagory' => $operation_catagory,

        ];
        return response()->json($data);
    }

    public function fetch_operation_report(Request $request)
    {
        $all_search_data = $request->all();

        $operation_details = OperationBooking::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->operation_name != '') {
                $query->where('operation_theathers.operation_id', $request->operation_name);
            }
            if ($request->operatoin_catagory != '') {
                $query->where('operation_theathers.operation_category_id', $request->operatoin_catagory);
            }
            if ($request->operation_status != '') {
                $query->where('operation_bookings.status', $request->operation_status);
            }
            if ($request->from_date != '' && $request->to_date != '') {
                $query->whereBetween('operation_bookings.operation_date_from', [$request->from_date, $request->to_date]);
            }
        })
            ->select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.status')
            ->leftjoin('operation_theathers', 'operation_theathers.operation_booking_id', '=', 'operation_bookings.id')
            ->leftjoin('patients', 'patients.id', '=', 'operation_theathers.patient_id')
            ->leftjoin('departments', 'departments.id', '=', 'operation_theathers.operation_department')
            ->leftjoin('users', 'users.id', '=', 'operation_bookings.consultant_doctor')
            ->leftjoin('operations', 'operations.id', '=', 'operation_theathers.operation_id')
            ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operation_theathers.operation_category_id')
            ->get();

        $operation_id = Operation::all();
        $operation_catagory = OperationCatagory::all();

        $data = [
            'operation_details' => $operation_details,
            'all_search_data' => $all_search_data,
            'operation_catagory' => $operation_catagory,
            'operation_id' => $operation_id,

        ];
        return response()->json($data);
    }

    public function blood_issue_report_index()
    {
        $blood_group = BloodGroup::all();
        return response()->json(['blood_group' => $blood_group]);
    }

    public function fetch_blood_issue_report(Request $request)
    {
        $all_search_data = $request->all();

        $blood_issue_details = BloodIssue::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->blood_group_id != '') {
                $query->where('blood_group', $request->blood_group_id);
            }
            // if ($request->from_date != '') {
            //     $query->where('issue_date', '>=', $request->from_date);
            // }
            // if ($request->to_date != '') {
            //     $query->where('issue_date', '<=', $request->to_date);
            // }
            if ($request->from_date != '' && $request->to_date != '') {
                $query->whereBetween('issue_date', [$request->from_date, $request->to_date]);
            }
        })
            ->get();

        $blood_group = BloodGroup::all();
        $data = [
            'blood_issue_details' => $blood_issue_details,
            'all_search_data' => $all_search_data,
            'blood_group' => $blood_group,

        ];
        return response()->json($data);
    }

    public function blood_components_issue_report_index()
    {
        $blood_group = BloodGroup::all();
        return response()->json(['blood_group' => $blood_group]);
    }

    public function fetch_blood_components_issue_report(Request $request)
    {
        $all_search_data = $request->all();

        $blood_components_issue_details = BloodComponentIssue::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->blood_group_id != '') {
                $query->where('blood_group', $request->blood_group_id);
            }
            // if ($request->from_date != '') {
            //     $query->where('issue_date', '>=', $request->from_date);
            // }
            // if ($request->to_date != '') {
            //     $query->where('issue_date', '<=', $request->to_date);
            // }
            if ($request->from_date != '' && $request->to_date != '') {
                $query->whereBetween('issue_date', [$request->to_date, $request->from_date]);
            }
        })
            ->get();

        $blood_group = BloodGroup::all();


        $data = [
            'blood_components_issue_details' => $blood_components_issue_details,
            'all_search_data' => $all_search_data,
            'blood_group' => $blood_group,

        ];
        return response()->json($data);
    }

    public function blood_donor_details()
    {
        $blood_group = BloodGroup::all();
        $blood_donor = BloodDonor::all();

        $data = [
            'blood_donor' => $blood_donor,
            'blood_group' => $blood_group,

        ];
        return response()->json($data);
    }

    public function fetch_blood_donor_details(Request $request)
    {
        $all_search_data = $request->all();

        $blood_donor_details = BloodDonor::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->blood_group_id != '') {
                $query->where('blood_group', $request->blood_group_id);
            }
            // if ($request->from_date != '') {
            //     $query->where('created_at', '>=', $request->from_date);
            // }
            // if ($request->to_date != '') {
            //     $query->where('created_at', '<=', $request->to_date);
            // }
            if ($request->from_date != '' && $request->to_date != '') {
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

        })
            ->get();

        // dd($blood_donor_details);
        $blood_group = BloodGroup::all();
        $blood_donor = BloodDonor::all();

        $data = [
            'blood_donor_details' => $blood_donor_details,
            'all_search_data' => $all_search_data,
            'blood_group' => $blood_group,
            'blood_donor' => $blood_donor,
        ];

        return response()->json($data);
    }


    public function fetch_patient_death_details(Request $request)
    {
        $all_search_data = $request->all();

        $death_details = DeathReport::where(function ($query) use ($request) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
            if ($request->from_date != '') {
                $query->where('death_date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('death_date', '<=', $request->to_date);
            }
        })
            ->get();


        $data = [
            'all_search_data' => $all_search_data,
            'death_details' => $death_details,

        ];

        return response()->json($data);
    }


    public function referral_details_report()
    {
        $referer  = Referral::get();
        return response()->json(['referer' => $referer]);
    }
    public function fetch_referral_payment_report(Request $request)
    {
        $all_search_data = $request->all();
        $referral_payment_details = ReferralCommissionPayment::where(function ($query) use ($request) {
            if ($request->referrar_name != '') {
                $query->where('reference_id', '<=', $request->referrar_name);
            }
            if ($request->from_date != '') {
                $query->where('date', '>=', $request->from_date);
            }
            if ($request->to_date != '') {
                $query->where('date', '<=', $request->to_date);
            }
        })
            ->get();
        $referer  = Referral::get();
        $data = [
            'all_search_data' => $all_search_data,
            'referral_payment_details' => $referral_payment_details,
            'referer' => $referer,

        ];

        return response()->json($data);
    }
}
