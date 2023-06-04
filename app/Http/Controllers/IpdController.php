<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Patient;
use App\Models\PatientBedHistory;
use App\Models\TpaManagement;
use App\Models\Referral;
use App\Models\Department;
use App\Models\IpdDetails;
use App\Models\MedicineBilling;
use App\Models\CaseReference;
use App\Models\OpdDetails;
use App\Models\OpdVisitDetails;
use Illuminate\Http\Request;
use App\Models\SymptomsType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Bed;
use App\Models\BedUnit;
use App\Models\ChargeType;
use App\Models\RadiologyTest;
use App\Models\PathologyTest;
use App\Models\IpdPayment;
use App\Models\Prefix;
use App\Models\Ward;
use App\Models\IpdTimeline;
use App\Models\ChargesCatagory;
use App\Models\MedicationDose;
use App\Models\MedicineCatagory;
use App\Models\NurseNote;
use App\Models\AllHeader;
use App\Models\OperationTheatre;
use App\Models\OxygenMonitoring;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\PatientCharge;
use App\Models\PathologyPatientTest;
use App\Models\RadiologyPatientTest;
use App\Models\IpdPatientPhysicalDetail;
use Illuminate\Support\Facades\DB;
use App\Models\OperationBooking;
use App\Models\OperationTheather;
use App\Models\Operation;
use App\Models\OperationCatagory;
use App\Models\OperationType;
use App\Models\BloodComponentIssue;
use App\Models\bloodBank\BloodIssue;
use App\Models\Diagonasis;
use App\Models\DischargedPatient;

use PDF;

class IpdController extends Controller
{
    public function index()
    {
        $ipd_patient_list =  IpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->orderBy('appointment_date', 'DESC')
            ->where('is_active', '1')
            ->where('discharged', 'no')
            ->get();

        // $ipd_patient_list = IpdDetails::where('is_active', '1')->where('discharged', 'no')->where('ins_by', 'ori')->orderBy('appointment_date', 'DESC')->get();

        return view('Ipd.ipd-patients-details', compact('ipd_patient_list'));
    }

    public  function ipd_registation_from_opd($patientid, $patient_source, $source_id)
    {
        $patient_id = base64_decode($patientid);
        $patient_details = Patient::where('id', '=', $patient_id)->first();
        $patient_source_id = $source_id;
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $patient_source_name = $patient_source;
        $case_id = OpdDetails::where('patient_id', '=', $patient_id)->first();
        $icd_code  = Diagonasis::all();
        return view('Ipd.ipd-registration', compact('symptoms_types', 'departments', 'referer', 'patient_details', 'patient_id', 'tpa_management', 'patient_source_name', 'patient_source_id', 'case_id', 'icd_code'));
    }

    public  function profile($id)
    {
        $ipd_id = base64_decode($id);
        $PhysicalDetails  =  IpdPatientPhysicalDetail::where('ipd_id', $ipd_id)->orderBy('id', 'Desc')->first();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $bed_history_details = PatientBedHistory::where('id', $ipd_id)->first();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::all();
        $oxygen_monitering = OxygenMonitoring::where('ipd_id', $ipd_id)->get();
        $bedHistory = PatientBedHistory::where('ipd_id', $ipd_id)->get();
        $edit_histry_details_id = PatientBedHistory::where('ipd_id', $ipd_id)->latest()->first();
        $nurseName = User::where('role', 'Nurse')->get();
        $nurseNoteDetails = NurseNote::where('ipd_id', $ipd_id)->get();
        $medicine_catagory = MedicineCatagory::all();
        $medication_details = MedicationDose::all();
        $cons_doctor = User::where('role', '=', 'Doctor')->get();
        $operation_details = OperationTheatre::all();
        $paymentDetails = IpdPayment::all();

        $payment_amount = Payment::where('ipd_id', $ipd_id)->sum('payment_amount');
        $billing_amount = Billing::where('ipd_id', $ipd_id)->sum('grand_total');
        $patient_discharge_details =  DischargedPatient::where('ipd_id', $ipd_id)->first();

        $PathologyTestDetails = PathologyPatientTest::where('case_id', $ipd_details->case_id)->get();
        //  dd($patient_discharge_details);
        $RadiologyTestDetails = RadiologyPatientTest::where('case_id', $ipd_details->case_id)->get();

        $chargeCategoriesamount = DB::table('patient_charges')
            ->select('charges_catagories.charges_catagories_name', DB::raw('SUM(patient_charges.amount) as total_amount'))
            ->join('charges_catagories', 'patient_charges.charge_category', '=', 'charges_catagories.id')
            ->groupBy('charges_catagories.charges_catagories_name')
            ->where('case_id', $ipd_details->case_id)
            ->get();
        $p_chart_name = '';
        $p_chart_value = '';
        foreach ($chargeCategoriesamount as $value) {
            $p_chart_name .= '"' . $value->charges_catagories_name . '",';
            $p_chart_value .= '"' . $value->total_amount . '",';
        }

        $total_charge_amount = PatientCharge::where('case_id', $ipd_details->case_id)->sum('amount');
        $blood_details = BloodIssue::where('patient_id', $ipd_details->patient_id)->get();
        $components_details = BloodComponentIssue::where('patient_id', $ipd_details->patient_id)->get();


        $operation_booking_id = '';
        $operation_details_fetch = '';

        // dd($opd_id);

        // dd($ipd_details);
        $patient_details_information = Patient::where('id', '=', $ipd_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $ipd_details->patient_id)->first();
        // dd( $operation_theathers);
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            // dd($operation_booking);
            $operation_booking_id = $operation_booking->id;
            $operation_details_fetch = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark')
                ->leftjoin('operation_theathers', 'operation_theathers.operation_booking_id', '=', 'operation_bookings.id')
                ->leftjoin('patients', 'patients.id', '=', 'operation_theathers.patient_id')
                ->leftjoin('departments', 'departments.id', '=', 'operation_theathers.operation_department')
                ->leftjoin('users', 'users.id', '=', 'operation_bookings.consultant_doctor')
                ->leftjoin('operations', 'operations.id', '=', 'operation_theathers.operation_id')
                ->leftjoin('operation_types', 'operation_types.id', '=', 'operation_theathers.operation_type')
                ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operation_theathers.operation_category_id')
                ->where('operation_bookings.id', $operation_booking->id)
                ->where('operation_theathers.operation_booking_id', $operation_booking->id)
                ->get();
        }






        return view('Ipd.ipd-profile', compact('p_chart_value', 'p_chart_name', 'paymentDetails', 'operation_details', 'cons_doctor', 'medication_details', 'medicine_catagory', 'oxygen_monitering', 'ipd_details', 'bed_history_details', 'departments', 'units', 'bedHistory', 'edit_histry_details_id', 'nurseName', 'nurseNoteDetails', 'payment_amount', 'billing_amount', 'PathologyTestDetails', 'RadiologyTestDetails', 'PhysicalDetails', 'patient_discharge_details', 'total_charge_amount', 'blood_details', 'components_details', 'operation_details_fetch'));
    }

    public function find_doctor_and_ward_by_department_in_opd(Request $request)
    {
        $find_doctor = User::where('department', $request->department_id)->get();
        $find_bedward = Ward::where('department_id', $request->department_id)->get();
        return response()->json(['doctor' => $find_doctor, 'ward' => $find_bedward]);
    }

    public function find_bed_by_bed_ward(Request $request)
    {
        $find_bed = Bed::where('bedWard_id', $request->bed_ward)->where('bedUnit_id', $request->bed_unit)->where('is_used', 'no')->orwhere('id', $request->previous_bed)->get();
        // dd($find_bed);
        return response()->json($find_bed);
    }

    public function ipd_registation(Request $request)
    {
        $validate = $request->validate([
            'appointment_date' => 'required',
            'patient_type' => 'required',
            'department' => 'required',
            'cons_doctor' => 'required',
            'ward' => 'required',
            'unit' => 'required',
            'bed' => 'required',
            'date_of_birth' => 'required',
            'date_of_birth_year' => 'required',
            'date_of_birth_month' => 'required',
            'date_of_birth_day' => 'required',
            'admitted_by' => 'required',
            'admitted_by_contact_no' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $result =  Bed::where('id', $request->bed)->where('is_used', 'no')->first();
            if ($result == null) {
                return redirect()->back()->with('success', 'Select Another Bed');
            }
            //SAVE in CASE reference
            $caseReference = new CaseReference;
            $caseReference->patient_id = $request->patient_id;
            $caseReference->section = 'IPD';
            $caseReference->save();
            //SAVE in CASE reference

            $patient_update = Patient::find($request->patient_id);
            $patient_update->date_of_birth = $request->date_of_birth;
            $patient_update->year = $request->date_of_birth_year;
            $patient_update->month = $request->date_of_birth_month;
            $patient_update->day = $request->date_of_birth_day;
            $patient_update->save();

            $ipd_prefix = Prefix::where('name', 'ipd')->first();

            //SAVE in ipd details
            $ipd_details = new IpdDetails();
            $ipd_details->admitted_by                 = $request->admitted_by;
            $ipd_details->admitted_by_contact_no      = $request->admitted_by_contact_no;
            $ipd_details->ipd_prefix                  = $ipd_prefix->prefix;
            $ipd_details->patient_id                  = $request->patient_id;
            $ipd_details->patient_source_id           = $request->patient_source_id;
            $ipd_details->patient_source              = $request->patient_source;
            $ipd_details->case_id                     = $caseReference->id;
            $ipd_details->appointment_date            = $request->appointment_date;
            $ipd_details->credit_limit                = $request->credit_limit;
            $ipd_details->bp                          = $request->bp;
            $ipd_details->height                      = $request->height;
            $ipd_details->weight                      = $request->weight;
            $ipd_details->pulse                       = $request->pulse;
            $ipd_details->temperature                 = $request->temperature;
            $ipd_details->respiration                 = $request->respiration;
            $ipd_details->known_allergies             = $request->any_known_allergies;
            $ipd_details->symptoms_type               = $request->symptoms_type;
            $ipd_details->symptoms                    = $request->symptoms_title;
            $ipd_details->symptoms_description        = $request->symptoms_description;
            $ipd_details->patient_type                = $request->patient_type;
            $ipd_details->tpa_organization            = $request->tpa_organization;
            $ipd_details->type_no                     = $request->type_no;
            $ipd_details->note                        = $request->note;
            $ipd_details->refference                  = $request->reference;
            $ipd_details->cons_doctor                 = $request->cons_doctor;
            $ipd_details->department_id               = $request->department;
            $ipd_details->bed                         = $request->bed;
            $ipd_details->bed_ward_id                 = $request->ward;
            $ipd_details->bed_unit_id                 = $request->unit;
            $ipd_details->history_alcoholism          = $request->history_alcoholism;
            $ipd_details->medical_surgical_history    = $request->medical_surgical_history;
            $ipd_details->family_history_diagnosis    = $request->family_history_diagnosis;
            $ipd_details->icd_code_at_the_time_of_admission  = $request->icd_code_at_the_time_of_admission;
            $ipd_details->generated_by                = Auth::user()->id;
            $ipd_details->save();
            //SAVE in ipd details


            //bed status update in bed table
            Bed::where('id', $request->bed)->update(['is_used' => 'yes']);
            //bed status update in bed table

            //bed history update in bed table
            $patient_bed_history = new PatientBedHistory();
            $patient_bed_history->patient_id = $request->patient_id;
            $patient_bed_history->case_id = $caseReference->id;
            $patient_bed_history->ipd_id = $ipd_details->id;
            $patient_bed_history->department_id = $request->department;
            $patient_bed_history->bed_ward_id = $request->ward;
            $patient_bed_history->bed_unit_id = $request->unit;
            $patient_bed_history->bed_id = $request->bed;
            $patient_bed_history->from_date = $request->appointment_date;
            $patient_bed_history->save();
            //bed history update in bed table

            DB::commit();

            // $ipd_details = IpdDetails::where('id', $ipd_details->id)->first();

            return redirect()->route('ipd-patient-listing')->with('success', 'Ipd Registation Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function ipd_patient_status_change(Request $request)
    {
        $ipd_details = IpdDetails::where('id', $request->ipdId)->first();
        return response()->json($ipd_details);
    }

    public function admission_from_opd($id)
    {
        $emg_opd_id = base64_decode($id);
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $visit_details = OpdDetails::where('id', '=', $emg_opd_id)->first();
        $patient_source_id = $visit_details->opd_prefix . '' . $visit_details->id;
        $case_id = $visit_details->case_id;
        $patient_source = 'OPD';
        $icd_code  = Diagonasis::all();

        return view('Ipd.ipd-registration', compact('symptoms_types', 'departments', 'referer', 'visit_details', 'tpa_management', 'patient_source_id', 'case_id', 'patient_source', 'emg_opd_id', 'units', 'icd_code'));
    }

    public function edit_ipd_registration($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        // dd($ipd_id);
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::where('is_active', '1')->get();
        $visit_details = IpdDetails::where('id', '=', $ipd_id)->first();
        $patient_details = PatientBedHistory::where('ipd_id', $ipd_id)->latest()->first();
        // dd($patient_details);

        return view('Ipd.edit-ipd-patient', compact('ipd_id', 'departments', 'referer', 'tpa_management', 'visit_details', 'units', 'patient_details'));
    }

    public function updaste_ipd_registation(Request $request)
    {
        $validate = $request->validate([
            'appointment_date' => 'required',
            'patient_type' => 'required',
            'department' => 'required',
            'cons_doctor' => 'required',
            'ward' => 'required',
            'unit' => 'required',
            'bed' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $ipd_prefix = Prefix::where('name', 'ipd')->first();

            //SAVE in ipd details
            $ipd_details = IpdDetails::find($request->ipd_details_id);
            $ipd_details->ipd_prefix                  = $ipd_prefix->prefix;
            $ipd_details->patient_id                  = $request->patient_id;
            $ipd_details->patient_source_id           = $request->patient_source_id;
            $ipd_details->patient_source              = $request->patient_source;
            $ipd_details->case_id                     = $request->case_id;
            $ipd_details->appointment_date            = $request->appointment_date;
            $ipd_details->credit_limit                = $request->credit_limit;
            $ipd_details->bp                          = $request->bp;
            $ipd_details->height                      = $request->height;
            $ipd_details->weight                      = $request->weight;
            $ipd_details->pulse                       = $request->pulse;
            $ipd_details->temperature                 = $request->temperature;
            $ipd_details->respiration                 = $request->respiration;
            $ipd_details->known_allergies             = $request->any_known_allergies;
            $ipd_details->symptoms_type               = $request->symptoms_type;
            $ipd_details->symptoms                    = $request->symptoms_title;
            $ipd_details->symptoms_description        = $request->symptoms_description;
            $ipd_details->patient_type                = $request->patient_type;
            $ipd_details->tpa_organization            = $request->tpa_organization;
            $ipd_details->type_no                     = $request->type_no;
            $ipd_details->note                        = $request->note;
            $ipd_details->refference                  = $request->reference;
            $ipd_details->cons_doctor                 = $request->cons_doctor;
            $ipd_details->department_id               = $request->department;
            $ipd_details->bed                         = $request->bed;
            $ipd_details->bed_ward_id                 = $request->ward;
            $ipd_details->bed_unit_id                 = $request->unit;
            $ipd_details->history_alcoholism          = $request->history_alcoholism;
            $ipd_details->medical_surgical_history    = $request->medical_surgical_history;
            $ipd_details->family_history_diagnosis    = $request->family_history_diagnosis;
            $ipd_details->generated_by                = Auth::user()->id;
            $ipd_details->save();
            //SAVE in ipd details


            //bed status update in bed table
            Bed::where('id', $request->bed)->update(['is_used' => 'yes']);
            //bed status update in bed table
            // dd($request->patient_bed_history_id);
            //bed history update in bed table
            $patient_bed_history = PatientBedHistory::find($request->patient_bed_history_id);
            $patient_bed_history->patient_id = $request->patient_id;
            $patient_bed_history->case_id = $request->case_id;
            $patient_bed_history->ipd_id = $ipd_details->id;
            $patient_bed_history->department_id = $request->department;
            $patient_bed_history->bed_ward_id = $request->ward;
            $patient_bed_history->bed_unit_id = $request->unit;
            $patient_bed_history->bed_id = $request->bed;
            $patient_bed_history->from_date = $request->appointment_date;
            $patient_bed_history->save();
            //bed history update in bed table

            DB::commit();
            if ($request->save == 'save_and_print') {
                $pdf = PDF::loadView('OPD._print.opd_prescription');
                return $pdf->stream('opd_prescription.pdf', array('Attachment' => 0));
            } else {
                return redirect()->route('ipd-patient-listing')->with('success', 'Ipd Patient Details Updated Sucessfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function charge_list_in_ipd($id = null)
    {
        $ipd_id = base64_decode($id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_charges_details = PatientCharge::where('ins_by', 'ori')->where('case_id', $ipd_details->case_id)->orderBy('charges_date', 'DESC')->get();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        // dd($ipd_details);
        return view('Ipd.charges.charges-list', compact('ipd_id', 'ipd_details', 'ipd_charges_details', 'ipd_patient_details'));
    }
    public function add_charges_ipd($id)
    {
        $ipd_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        $pathology_charge = PathologyPatientTest::where('ipd_id', $ipd_id)->where('billing_status', '0')->get();
        $radiology_charge = RadiologyPatientTest::where('ipd_id', $ipd_id)->where('billing_status', '0')->get();
        $pathology_charge_count = PathologyPatientTest::where('ipd_id', $ipd_id)->where('billing_status', '0')->count();
        $radiology_charge_count = RadiologyPatientTest::where('ipd_id', $ipd_id)->where('billing_status', '0')->count();
        if ($ipd_patient_details->patient_type == 'TPA') {
            $p_type = $ipd_patient_details->TpaManagement->TPA_name;
        } else {
            $p_type = $ipd_patient_details->patient_type;
        }
        $patient_type_id = ChargeType::where('charge_type_name', $p_type)->first();
        return view('Ipd.charges.add-charges', compact('pathology_charge_count', 'radiology_charge_count', 'pathology_charge', 'patient_type_id', 'radiology_charge', 'ipd_id', 'charge_category', 'ipd_details', 'ipd_patient_details'));
    }
    public function edit_charges_ipd($id, $charge_id)
    {
        $ipd_id = base64_decode($id);
        $chargeId = base64_decode($charge_id);
        $charge_category =  ChargesCatagory::all();
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $patient_charge_details = PatientCharge::where('id', $chargeId)->first();
        $ipd_patient_details = IpdDetails::where('id', $ipd_id)->first();
        //dd($patient_charge_details );
        return view('Ipd.charges.edit-charges', compact('ipd_details', 'ipd_id', 'charge_category', 'patient_charge_details', 'ipd_patient_details'));
    }
    public function save_charges_ipd(Request $request)
    {
        $validate = $request->validate([
            'date'   => 'required',
        ]);
        try {
            DB::beginTransaction();
            foreach ($request->charge_name as $key => $value) {
                $patient_charge = new PatientCharge();
                $patient_charge->case_id = $request->case_id;
                $patient_charge->section = $request->section;
                $patient_charge->charges_date = $request->date;
                $patient_charge->ipd_id = $request->ipd_id;
                $patient_charge->patient_id = $request->patient_id;
                $patient_charge->charge_category = $request->charge_category[$key];
                $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
                $patient_charge->charge_name = $request->charge_name[$key];
                $patient_charge->standard_charges = $request->standard_charges[$key];
                $patient_charge->cgst = $request->cgst[$key];
                $patient_charge->sgst = $request->sgst[$key];
                $patient_charge->igst = $request->igst[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->generated_by = Auth::user()->id;
                $patient_charge->billing_status = '0';
                $patient_charge->save();

                // if ($request->charge_category[$key] == '1') {
                //     $charge_detp = PathologyTest::where('charge', $request->charge_name[$key])->first();
                //     $chargedetailstestp = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detp->id)->where('test_status', '=', '0')->first();

                //     if ($chargedetailstestp == null) {
                //         $pathology_patient_test = new PathologyPatientTest();
                //         $pathology_patient_test->case_id = $request->case_id;
                //         $pathology_patient_test->date = $request->date;
                //         $pathology_patient_test->section = 'IPD';
                //         $pathology_patient_test->patient_id = $request->patient_id;
                //         $pathology_patient_test->test_id =  $charge_detp->id;
                //         $pathology_patient_test->ipd_id = $request->ipd_id;
                //         $pathology_patient_test->generated_by = Auth::user()->id;
                //         $pathology_patient_test->billing_status = '2';
                //         $pathology_patient_test->test_status = '0';
                //         $pathology_patient_test->save();
                //     } else {
                //         $chargedetailstestp->billing_status = '2';
                //         $chargedetailstestp->save();
                //     }
                // }
                // if ($request->charge_category[$key] == '2') {
                //     $charge_detr = RadiologyTest::where('charge', $request->charge_name[$key])->first();
                //     $chargedetailstestr = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detr->id)->where('test_status', '=', '0')->where('test_id', $charge_detr->charge)->first();

                //     if ($chargedetailstestr == null) {
                //         $radiology_patient_test = new RadiologyPatientTest();
                //         $radiology_patient_test->case_id = $request->case_id;
                //         $radiology_patient_test->date = $request->date;
                //         $radiology_patient_test->section = 'IPD';
                //         $radiology_patient_test->patient_id = $request->patient_id;
                //         $radiology_patient_test->test_id = $charge_detr->id;
                //         $radiology_patient_test->ipd_id = $request->ipd_id;
                //         $radiology_patient_test->generated_by = Auth::user()->id;
                //         $radiology_patient_test->billing_status = '2';
                //         $radiology_patient_test->test_status = '0';
                //         $radiology_patient_test->save();
                //     } else {
                //         $chargedetailstestr->billing_status = '2';
                //         $chargedetailstestr->save();
                //     }
                // }
            }
            DB::commit();
            return redirect()->route('charges-list-ipd', ['id' => base64_encode($request->ipd_id)])->with('success', "Charges Added Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function delete_ipd_charges($charge_id, $id)
    {
        try {
            DB::beginTransaction();
            $charge_id = base64_decode($charge_id);
            $ipd_id = base64_decode($id);
            $patient_charge = PatientCharge::find($charge_id);
            $patient_charge->delete();
            DB::commit();
            return redirect()->route('charges-list-ipd', ['id' => base64_encode($ipd_id)])->with('success', "Charges delete Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function ipd_pathology_investigation($id)
    {
        $ipd_id = base64_decode($id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $pathology_patient_test = PathologyPatientTest::where('ins_by', 'ori')->where('case_id', $ipd_details->case_id)->get();
        return view('Ipd.pathology.test-list', compact('pathology_patient_test', 'ipd_details', 'ipd_id'));
    }

    public function ipd_radiology_investigation($id)
    {
        $ipd_id = base64_decode($id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        // dd($ipd_details);
        $radiology_patient_test = RadiologyPatientTest::where('ins_by', 'ori')->where('case_id', $ipd_details->case_id)->get();
        return view('Ipd.radiology.test-list', compact('radiology_patient_test', 'ipd_details', 'ipd_id'));
    }
    public function update_status(Request $request)
    {
        try {
            DB::beginTransaction();

            $ipd_details =  IpdDetails::find($request->ipd_id);
            $ipd_details->discharged_planed_date = $request->date;
            $ipd_details->status = $request->status;
            $ipd_details->save();
            DB::commit();
            return redirect()->back()->with('success', "Status Changed Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function ipd_patient_delete($ipd_id)
    {
        try {
            DB::beginTransaction();
            $ipdid = base64_decode($ipd_id);
            $ipd_details =  IpdDetails::find($ipdid);
            PatientBedHistory::where('ipd_id', $ipdid)->delete();
            Bed::where('id', $ipd_details->bed)->update(['is_used' => 'no']);
            $ipd_details->delete();
            DB::commit();
            return redirect()->back()->with('success', "IPD Patient Deleted Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function ipd_operation_details_for_a_patient($id)
    {
        $operation_booking_id = '';
        $operation_details = '';
        $ipd_id = base64_decode($id);
        // dd($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        // dd($ipd_details);
        $patient_details_information = Patient::where('id', '=', $ipd_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $ipd_details->patient_id)->first();
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            $operation_booking_id = $operation_booking->id;
            $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark', 'operation_theathers.ipd_id')
                ->leftjoin('operation_theathers', 'operation_theathers.operation_booking_id', '=', 'operation_bookings.id')
                ->leftjoin('patients', 'patients.id', '=', 'operation_theathers.patient_id')
                ->leftjoin('departments', 'departments.id', '=', 'operation_theathers.operation_department')
                ->leftjoin('users', 'users.id', '=', 'operation_bookings.consultant_doctor')
                ->leftjoin('operations', 'operations.id', '=', 'operation_theathers.operation_id')
                ->leftjoin('operation_types', 'operation_types.id', '=', 'operation_theathers.operation_type')
                ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operation_theathers.operation_category_id')
                ->where('operation_bookings.id', $operation_booking->id)
                ->where('operation_theathers.operation_booking_id', $operation_booking->id)
                ->first();
        }

        // dd($operation_details);

        return view('IPD.operation-ipd.operation-details', compact('operation_details', 'ipd_details', 'operation_booking_id','ipd_id'));
    }


    public function ipd_operation($id)
    {
        $operation_booking_id = '';
        $operation_details = '';
        $ipd_id = base64_decode($id);
        // dd($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        // dd($ipd_details);
        $patient_details_information = Patient::where('id', '=', $ipd_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $ipd_details->patient_id)->first();
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            $operation_booking_id = $operation_booking->id;
            $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark', 'operation_theathers.ipd_id')
                ->leftjoin('operation_theathers', 'operation_theathers.operation_booking_id', '=', 'operation_bookings.id')
                ->leftjoin('patients', 'patients.id', '=', 'operation_theathers.patient_id')
                ->leftjoin('departments', 'departments.id', '=', 'operation_theathers.operation_department')
                ->leftjoin('users', 'users.id', '=', 'operation_bookings.consultant_doctor')
                ->leftjoin('operations', 'operations.id', '=', 'operation_theathers.operation_id')
                ->leftjoin('operation_types', 'operation_types.id', '=', 'operation_theathers.operation_type')
                ->leftjoin('operation_catagories', 'operation_catagories.id', '=', 'operation_theathers.operation_category_id')
                ->where('operation_bookings.id', $operation_booking->id)
                ->where('operation_theathers.operation_booking_id', $operation_booking->id)
                ->get();
        }

        // dd($operation_details);

        return view('IPD.operation-ipd.operation-listing-in-ipd', compact('operation_details', 'ipd_details', 'ipd_id',  'operation_booking_id'));
    }


    public function edit_ipd_operation(Request $request, $id)
    {
        $operation_booking_id = base64_decode($id);
        $operation_booking = OperationBooking::where('id', '=',  $operation_booking_id)->first();

        // dd( $operation_booking );
        $operation_theathers = OperationTheather::where('operation_booking_id', '=',  $operation_booking_id)->first();
        // dd($operation_theathers);
        $ipd_details = IpdDetails::where('id', $operation_theathers->ipd_id)->first();
        $patient_id = $operation_theathers->patient_id;
        $patient_details_information = Patient::where('id', '=', $patient_id)->first();
        $departments = Department::where('is_active', '1')->get();
        $doctor = User::where('role', '=', 'Doctor')->get();
        $nurse = User::where('role', '=', 'Nurse')->get();
        $staff = User::where('role', '=', 'staff')->get();
        $operation_department = Operation::all();
        $operation_catagory = OperationCatagory::all();
        $operation_type = OperationType::all();
        $all_patient = Patient::all();

        return view('IPD.operation-ipd.edit-operation-details-in-ipd', compact('operation_booking_id', 'departments', 'all_patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department', 'operation_booking', 'operation_theathers', 'patient_details_information', 'ipd_details'));
    }


    public function update_ipd_operation(Request $request)
    {
        // dd($request->all());

        try {
            DB::beginTransaction();

            $operation_booking = OperationBooking::find($request->operation_booking_id);
            $operation_booking->operation_date_from               = $request->operation_date_from;
            $operation_booking->operation_date_to                 = $request->operation_date_to;
            $operation_booking->consultant_doctor                 = $request->consultant_doctor;
            $operation_booking->ass_consultant_1                  = $request->ass_consultant_1;
            $operation_booking->ass_consultant_2                  = $request->ass_consultant_2;
            $operation_booking->anesthetist                        = $request->anesthetist;
            $operation_booking->anaethesia_type                    = $request->anaethesia_type;
            $operation_booking->ot_technician                      = $request->ot_technician;
            $operation_booking->ot_assistant                       = $request->ot_assistant;
            $operation_booking->remark                             = $request->remark;
            $operation_booking->generated_by                        = Auth::user()->id;
            $operation_booking->status                             = $request->status;
            $operation_booking->save();

            $operation_theathers = OperationTheather::find($request->operation_theater_id);
            $operation_theathers->operation_booking_id               = $operation_booking->id;
            $operation_theathers->case_id                            = $request->case_id;
            $operation_theathers->section                            = $request->section;
            $operation_theathers->opd_id                             = '';
            $operation_theathers->emg_id                             = '';
            $operation_theathers->ipd_id                             = $request->section_id;
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id              = $request->operation_category_id;
            $operation_theathers->operation_id                       = $request->operation_id;
            $operation_theathers->operation_type                     = $request->operation_type;
            $operation_theathers->remark                             = $request->remark;
            $operation_theathers->save();

            DB::commit();

            return redirect()->route('ipd-operation-in-ipd', ['id' => base64_encode($request->section_id)])->with('success', 'Operation Booking Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function blood_bank_details_in_ipd($id)
    {
        $ipd_id = base64_decode($id);

        $ipd_details = IpdDetails::where('id', $ipd_id)->first();

        $patient_details_information = Patient::where('id', '=', $ipd_details->patient_id)->first();

        $blood_details = BloodIssue::where('patient_id', $ipd_details->patient_id)->get();

        // dd($blood_details);/
        $components_details = BloodComponentIssue::where('patient_id', $ipd_details->patient_id)->get();

        return view('ipd.blood-bank.blood-details', compact('ipd_id', 'ipd_details', 'blood_details', 'components_details', 'patient_details_information'));
    }

    public function print_ipd_addmission_form($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        return view('Ipd._print.ipd-admission-form', compact('ipd_details', 'header_image')) . redirect('ipd/ipd-profile/ipd-profile/' . base64_encode($ipd_id));
    }

    public function ipd_draft_bill($ipd_id)
    {
        $ipd_id = base64_decode($ipd_id);
        $ipd_details = IpdDetails::where('id', $ipd_id)->first();
        $patient_charges = PatientCharge::where('case_id', $ipd_details->case_id)->get();
        $medicine = MedicineBilling::where('case_id', $ipd_details->case_id)->get();
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        return view('Ipd._print.draft-bill', compact('ipd_details', 'header_image', 'patient_charges', 'medicine'));
    }
}
