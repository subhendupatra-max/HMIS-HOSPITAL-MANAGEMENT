<?php

namespace App\Http\Controllers\OPD;

use App\Http\Controllers\Controller;
use App\Models\AllHeader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\OpdTimeline;
use App\Models\Notification;
use App\Models\State;
use App\Models\District;
use App\Models\Patient;
use App\Models\TpaManagement;
use App\Models\Referral;
use App\Models\Department;
use App\Models\User;
use App\Models\SymptomsHead;
use App\Models\SymptomsType;
use App\Models\caseReference;
use App\Models\OpdDetails;
use App\Models\OpdVisitDetails;
use App\Models\OpdUnitDetail;
use App\Models\OpdUnit;
use App\Models\BedUnit;
use App\Models\OpdSetup;
use App\Models\OpdTicketFees;
use App\Models\PathologyPatientTest;
use App\Models\PatientPhysicalDetails;
use App\Models\Prefix;
use App\Models\OpdPatientPhysicalDetail;
use App\Models\OpdPayment;
use App\Models\ChargesCatagory;
use App\Models\Billing;
use App\Models\bloodBank\BloodIssue;
use App\Models\Country;
use App\Models\Payment;
use App\Models\PatientCharge;
use App\Models\PathologyTest;
use App\Models\RadiologyTest;
use App\Models\RadiologyPatientTest;
use App\Models\OperationTheather;
use App\Models\OperationBooking;
use App\Models\OperationType;
use App\Models\OperationCatagory;
use App\Models\Operation;
use App\Models\Diagonasis;

use PDF;
use App\Models\BloodComponentIssue;

class OpdController extends Controller
{

    public function opd_unit_details()
    {
        $department = Department::where('is_active', '=', 1)->get();
        $opdUnit    = OpdUnit::all();
        return view('setup.opd.opd-unit.unit-listing', compact('department', 'opdUnit'));
    }

    public function save_opd_unit_details(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'days'          => 'required',
        ]);

        $opdUnit = new OpdUnit();
        $opdUnit->department_id = $request->department_id;
        $opdUnit->days = $request->days;
        $status =  $opdUnit->save();

        foreach ($request->post('unit') as $key => $val) {
            $opdUnitDetails = new OpdUnitDetail();
            $opdUnitDetails->opd_unit_id        = $opdUnit->id;
            $opdUnitDetails->unit_name          = $val;
            $opdUnitDetails->save();
        }

        if ($status) {
            return redirect()->route('opd-unit-details')->with('success', 'Opd Unit Added Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public  function delete_opd_unit_details($id)
    {
        OpdUnit::find($id)->delete();
        OpdUnitDetail::where('opd_unit_id', $id)->delete();
        return back()->with('success', "Opd Unit Remove Sucessfully");
    }

    public function edit_opd_unit_details($id, Request $request)
    {
        $opdUnit        = OpdUnit::all();
        $editOpdUnit    = OpdUnit::where('id', $id)->first();
        $department     = Department::where('is_active', '=', 1)->get();
        $opdUnitDetails = OpdUnitDetail::where('opd_unit_id', $id)->get();

        return view('setup.opd.opd-unit.edit-unit', compact('department', 'opdUnit', 'editOpdUnit', 'opdUnitDetails'));
    }

    public function update_opd_unit_details(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'days'          => 'required',
        ]);

        $opdUnit = OpdUnit::where('id', $request->id)->first();
        $opdUnit->department_id = $request->department_id;
        $opdUnit->days = $request->days;
        $status =  $opdUnit->save();

        OpdUnitDetail::where('opd_unit_id', $opdUnit->id)->delete();

        foreach ($request->post('unit') as $key => $val) {
            $opdUnitDetails = new OpdUnitDetail();
            $opdUnitDetails->opd_unit_id        = $opdUnit->id;
            $opdUnitDetails->unit_name          = $val;
            $opdUnitDetails->save();
        }

        if ($status) {
            return redirect()->route('opd-unit-details')->with('success', 'Opd Unit Added Sucessfully');
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
    public function index(Request $request)
    {

        $opd_registaion_list =  OpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->orderBy('id', 'DESC')
            ->get();

        return view('OPD.opd-patient-list', compact('opd_registaion_list'));
    }
    public function after_new_old(Request $request)
    {
        $patient_type = $request->patient_type;
        if ($patient_type == 'new_patient') {
            $blood_group = BloodGroup::all();
            $state = State::all();
            $districts = District::all();
            $type = 'opd';
            $country = Country::all();

            return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'type', 'country'));
        } else {
            return redirect()->route('opd-registration');
        }
    }
    public function patient_search_in_opd(Request $request)
    {
        $patient_uhid_no = $request->uhid_no;
        $patient_patient_name = $request->patient_name;
        $patient_mobile_no = $request->mobile_no;
    }
    public function opd_registation(Request $request, $patientid = null)
    {
        if ($patientid != null) {
            $patient_id = base64_decode($patientid);
        } else {
            $patient_id = $request->patient_id;
        }
        $ticket_fees = OpdSetup::select('ticket_fees')->first();
        $patient_details_information = Patient::where('id', '=', $patient_id)->first();
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $all_patient = Patient::all();
        $opdSetup = OpdSetup::first();

        return view('OPD.opd_registation', compact('symptoms_types', 'ticket_fees', 'departments', 'referer', 'patient_details_information', 'patient_id', 'tpa_management', 'all_patient', 'opdSetup'));
    }
    public function find_doctor_by_department(Request $request)
    {
        $opd_units = OpdUnit::select('opd_unit_details.unit_name')->join('opd_unit_details', 'opd_unit_details.opd_unit_id', '=', 'opd_units.id')->where('opd_units.department_id', $request->department_id)->get();
        // dd($opd_units);
        $ticket_type = OpdSetup::select('ticket_no_calculate')->first();
        if ($ticket_type == 'By-Doctor') {
        } else {
            $opd_ticket_no_by_department = OpdVisitDetails::where('appointment_date', 'like', '%' . date('Y-m-d') . '%')->where('department_id', $request->department_id)->max('ticket_no');
        }
        $cons_doctor = User::where('is_active', '1')->where('role', 'Doctor')->where('department', $request->department_id)->get();
        // dd($cons_doctor);

        return response()->json(['cons_doctor' => $cons_doctor, 'opd_units' => $opd_units, 'opd_ticket_no_by_department' => ($opd_ticket_no_by_department + 1)]);
    }

    public function patient_edit_age(Request $request)
    {
        $patient_id = $request->patient_id;
        $dob = $request->date_of_birth;
        $year = $request->year;
        $month = $request->month;
        $days = $request->day;
        Patient::where('id', $patient_id)->update(['date_of_birth' => $dob, 'year' => $year, 'month' => $month, 'day' => $days]);
        return redirect('opd/opd-registration');
    }

    public function find_symptoms_title_by_symptoms_type(Request $request)
    {
        $data = SymptomsHead::where('symptoms_type', $request->symptoms_type_id)->get();
        // dd($data);
        return response()->json($data);
    }

    public function add_opd_registation(Request $request)
    {
        $validate = $request->validate([
            'appointment_date' => 'required',
            'patient_type' => 'required',
            'visit_type' => 'required',
            'department' => 'required',
            'unit' => 'required',
            'patient_id' => 'required',
        ], [
            'patient_id.required' => '*** Please select a Patient ***',
        ]);
        try {
            DB::beginTransaction();
            $opd_prefix = Prefix::where('name', 'opd')->first();

            //SAVE in CASE reference
            $caseReference = new CaseReference;
            $caseReference->patient_id = $request->patient_id;
            $caseReference->section = 'OPD';
            $caseReference->save();
            //SAVE in CASE reference

            //SAVE in opd details
            $Opd_details = new OpdDetails;
            $Opd_details->case_id        = $caseReference->id;
            $Opd_details->patient_id     = $request->patient_id;
            $Opd_details->opd_prefix     = $opd_prefix->prefix;
            $Opd_details->generate_by    = Auth::user()->id;
            $Opd_details->save();
            //SAVE in opd details

            CaseReference::where('patient_id', $request->patient_id)->update(['section_id' => $Opd_details->id]);

            //SAVE in opd Visit details
            $opd_visit_details = new OpdVisitDetails();
            $opd_visit_details->opd_details_id              = $Opd_details->id;
            $opd_visit_details->department_id               = $request->department;
            $opd_visit_details->cons_doctor                 = $request->cons_doctor;
            $opd_visit_details->visit_type                  = $request->visit_type;
            $opd_visit_details->unit                        = $request->unit;
            $opd_visit_details->case_type                   = $request->case;
            $opd_visit_details->patient_type                = $request->patient_type;
            $opd_visit_details->ticket_fees                 = $request->ticket_fees;
            $opd_visit_details->ticket_no                   = $request->ticket_no;
            $opd_visit_details->tpa_organization            = $request->tpa_organization;
            $opd_visit_details->type_no                     = $request->type_no;
            $opd_visit_details->appointment_date            = $request->appointment_date;
            $opd_visit_details->symptoms_type               = $request->symptoms_type;
            $opd_visit_details->symptoms                    = $request->symptoms_title;
            $opd_visit_details->symptoms_description        = $request->symptoms_description;
            $opd_visit_details->known_allergies             = $request->any_known_allergies;
            $opd_visit_details->note                        = $request->note;
            $opd_visit_details->refference                  = $request->reference;
            $opd_visit_details->generated_by                = Auth::user()->id;
            $opd_visit_details->save();
            //SAVE in opd Visit details
            // dd($opd_visit_details);




            $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

            $opd_patient_details = OpdVisitDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'opd_visit_details.patient_type', 'patients.address', 'patients.blood_group', 'opd_visit_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'opd_patient_physical_details.height', 'opd_patient_physical_details.weight', 'opd_patient_physical_details.bp', 'opd_patient_physical_details.respiration', 'opd_patient_physical_details.temperature', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'opd_visit_details.appointment_date', 'opd_visit_details.id as opd_visit_details_id', 'opd_details.id as opd_detailsId')
                ->leftjoin('opd_details', 'opd_details.id', '=', 'opd_visit_details.opd_details_id')
                ->leftjoin('patients', 'patients.id', '=', 'opd_details.patient_id')
                ->leftjoin('opd_patient_physical_details', 'opd_patient_physical_details.opd_id', '=', 'opd_visit_details.opd_details_id')
                ->leftjoin('users', 'users.id', '=', 'opd_visit_details.cons_doctor')
                ->leftjoin('departments', 'departments.id', '=', 'opd_visit_details.department_id')
                ->where('opd_visit_details.id', $opd_visit_details->id)
                ->first();

            DB::commit();
            if ($request->save == 'save_and_print') {
                return view('OPD._print.opd_prescription', compact('opd_patient_details', 'header_image')) . redirect('/opd/OPD-Patient-list');
            } else {
                return redirect()->route('OPD-Patient-list')->with('success', 'OPD Registation Sucessfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteOPDdETAILS($id)
    {
        try {
            DB::beginTransaction();
            $opd_visit_id = base64_decode($id);
            $visit_details =  OpdVisitDetails::find($opd_visit_id);
            OpdDetails::where('id', $visit_details->opd_details_id)->delete();
            OpdVisitDetails::where('id', $opd_visit_id)->delete();
            DB::commit();
            return redirect()->route('OPD-Patient-list')->with('success', 'Delected Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function profile($id)
    {
        $opd_id = base64_decode($id);
        $timelineDetails =  OpdTimeline::where('opd_id', $opd_id)->get();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $PhysicalDetails  =  OpdPatientPhysicalDetail::where('opd_id', $opd_id)->get();
        $payment_amount = Payment::where('opd_id', $opd_id)->sum('payment_amount');
        $billing_amount = Billing::where('opd_id', $opd_id)->sum('grand_total');
        $PathologyTestDetails = PathologyPatientTest::where('case_id', $opd_patient_details->case_id)->get();
        $RadiologyTestDetails = RadiologyPatientTest::where('case_id', $opd_patient_details->case_id)->get();
        // $opd_visit_details = OpdVisitDetails::where('opd_details_id',$opd_id)->get();

        $blood_details = BloodIssue::where('patient_id', $opd_patient_details->patient_id)->get();
        $components_details = BloodComponentIssue::where('patient_id', $opd_patient_details->patient_id)->get();
        // dd( $components_details);


        $operation_booking_id = '';
        $operation_details = '';

        // dd($opd_id);

        // dd($opd_patient_details);
        $patient_details_information = Patient::where('id', '=', $opd_patient_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $opd_patient_details->patient_id)->first();
        // dd( $operation_theathers);
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            // dd($operation_booking);
            $operation_booking_id = $operation_booking->id;
            $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark')
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

        //dd($PathologyTestDetails);
        $opd_visit_details = OpdVisitDetails::where('opd_details_id', $opd_id)->first();
        return view('OPD.opd-patient-profile', compact('billing_amount', 'opd_patient_details', 'opd_visit_details', 'timelineDetails', 'PhysicalDetails', 'payment_amount', 'PathologyTestDetails', 'RadiologyTestDetails', 'blood_details', 'components_details', 'operation_details'));
    }
    public function prescription_print($id)
    {
        $opd_visit_id = base64_decode($id);
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        $opd_patient_details = OpdVisitDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'opd_visit_details.patient_type', 'patients.address', 'patients.blood_group', 'opd_visit_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'opd_patient_physical_details.height', 'opd_patient_physical_details.weight', 'opd_patient_physical_details.bp', 'opd_patient_physical_details.respiration', 'opd_patient_physical_details.temperature', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'opd_visit_details.appointment_date', 'opd_visit_details.id as opd_visit_details_id', 'opd_details.id as opd_id', 'opd_details.case_id', 'opd_details.opd_prefix', 'states.name as state_name', 'districts.name as district_name', 'patients.pin_no', 'countries.country_name', 'patients.phone', 'patients.guardian_contact_no', 'patients.local_guardian_name', 'patients.local_guardian_contact_no', 'opd_visit_details.ticket_no', 'opd_visit_details.cons_doctor')
            ->leftjoin('opd_details', 'opd_details.id', '=', 'opd_visit_details.opd_details_id')
            ->leftjoin('patients', 'patients.id', '=', 'opd_details.patient_id')
            ->leftjoin('opd_patient_physical_details', 'opd_patient_physical_details.opd_id', '=', 'opd_visit_details.opd_details_id')
            ->leftjoin('users', 'users.id', '=', 'opd_visit_details.cons_doctor')
            ->leftjoin('departments', 'departments.id', '=', 'opd_visit_details.department_id')
            ->leftjoin('states', 'states.id', '=', 'patients.state')
            ->leftjoin('countries', 'countries.id', '=', 'patients.country')
            ->leftjoin('districts', 'districts.id', '=', 'patients.district')
            ->where('opd_visit_details.id', $opd_visit_id)
            ->first();

        return view('OPD._print.opd_prescription', compact('opd_patient_details', 'header_image'));
    }

    //opd setup

    public function opd_setup_details()
    {
        $opdSetup = OpdSetup::first();
        return view('setup.opd.opd-setup.opd-setup-listing', compact('opdSetup'));
    }

    public function save_opd_setup_details(Request $request)
    {
        $request->validate([
            'ticket_no_calculate' => 'required',
        ]);

        $opdSetup =  OpdSetup::first();
        $opdSetup->ticket_no_calculate = $request->ticket_no_calculate;
        $opdSetup->ticket_fees = $request->ticket_fees;
        $opdSetup->registration_type = $request->registration_type;

        $status = $opdSetup->save();

        if ($status) {
            return redirect()->back()->with('success', 'Setup Updated Sucessfully');
        } else {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    //opd ticket fees
    public function opd_ticket_fees_details()
    {
        $ticketFees = OpdTicketFees::all();

        return view('setup.opd.ticket-fees.opd-ticket-fees-listing', compact('ticketFees'));
    }

    public function save_opd_ticket_fees_details(Request $request)
    {
        $request->validate([
            'patient_type' => 'required',
            'ticket_fees' => 'required',
        ]);

        $status = OpdTicketFees::Insert([
            'patient_type' => $request->patient_type,
            'ticket_fees'  => $request->ticket_fees,
        ]);

        if ($status) {
            return back()->with('success', "Ticket Fees Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_opd_ticket_fees_details($id)
    {
        $ticketFees = OpdTicketFees::all();
        $editTicketFees = OpdTicketFees::where('id', $id)->first();

        return view('setup.opd.ticket-fees.edit-opd-ticket-fees', compact('ticketFees', 'editTicketFees'));
    }

    public function update_opd_ticket_fees_details(Request $request)
    {
        $request->validate([
            'patient_type' => 'required',
            'ticket_fees' => 'required',
        ]);

        $ticketFees = OpdTicketFees::find($request->id);
        $ticketFees->patient_type = $request->patient_type;
        $ticketFees->ticket_fees  = $request->ticket_fees;

        $status = $ticketFees->save();

        if ($status) {
            return redirect()->route('opd-ticket-fees-details')->with('success', " Ticket Fees Updated Successfully");
        } else {
            return redirect()->route('opd-ticket-fees-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_opd_ticket_fees_details($id)
    {
        OpdTicketFees::find($id)->delete();

        return back()->with('success', "Ticket Fees Deleted Successfully");
    }
    public function payment_list()
    {
        return view('OPD.payment-list');
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

    public function get_charge_category(Request $request)
    {
        $chargeType =  $request->charge_type;
        if ($chargeType == 'Normal') {
        }
        if ($chargeType == 'Normal') {
        }
        $data = SymptomsHead::where('symptoms_type', $request->symptoms_type_id)->get();
        return response()->json($data);
    }

    public function editOPDdETAILS($id)
    {
        $opd_id = base64_decode($id);
        $timelineDetails =  OpdTimeline::where('opd_id', $opd_id)->get();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        // dd($opd_patient_details);
        $opd_visit_details = OpdVisitDetails::where('opd_details_id', $opd_id)->first();
        //   dd($opd_visit_details);
        $ticket_fees = OpdSetup::select('ticket_fees')->first();
        $patient_details_information = Patient::where('id', '=', $opd_patient_details->patient_id)->first();
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        // dd($symptoms_types);
        $all_patient = Patient::all();
        $patient_physical_details = OpdPatientPhysicalDetail::where('opd_id', $opd_id)->first();
        $opdSetup = OpdSetup::first();

        return view('OPD.edit-opd-patient', compact('opd_patient_details', 'opd_visit_details', 'timelineDetails', 'ticket_fees', 'tpa_management', 'referer', 'departments', 'symptoms_types', 'all_patient', 'patient_details_information', 'patient_physical_details', 'opdSetup'));
    }

    public function updateOPDdETAILS(Request $request)
    {
        $validate = $request->validate([
            'appointment_date' => 'required',
            'patient_type' => 'required',
            'visit_type' => 'required',
            'department' => 'required',
            'cons_doctor' => 'required',
            'unit' => 'required',

        ], [
            'patient_id.required' => '*** Please select a Patient ***',
        ]);
        try {
            DB::beginTransaction();
            $opd_prefix = Prefix::where('name', 'opd')->first();


            //SAVE in opd details
            $Opd_details = OpdDetails::find($request->old_details_id);
            $Opd_details->patient_id     = $request->patient_id;
            $Opd_details->opd_prefix     = $opd_prefix->prefix;
            $Opd_details->generate_by    = Auth::user()->id;
            $Opd_details->save();
            //SAVE in opd details

            //SAVE in opd Visit details
            $opd_visit_details = OpdVisitDetails::find($request->opd_visit_details_id);
            $opd_visit_details->opd_details_id              = $request->old_details_id;
            $opd_visit_details->department_id               = $request->department;
            $opd_visit_details->cons_doctor                 = $request->cons_doctor;
            $opd_visit_details->visit_type                  = $request->visit_type;
            $opd_visit_details->unit                        = $request->unit;
            $opd_visit_details->case_type                   = $request->case;
            $opd_visit_details->patient_type                = $request->patient_type;
            $opd_visit_details->ticket_fees                 = $request->ticket_fees;
            $opd_visit_details->ticket_no                   = $request->ticket_no;
            $opd_visit_details->tpa_organization            = $request->tpa_organization;
            $opd_visit_details->type_no                     = $request->type_no;
            $opd_visit_details->appointment_date            = $request->appointment_date;
            $opd_visit_details->symptoms_type               = $request->symptoms_type;
            $opd_visit_details->symptoms                    = $request->symptoms_title;
            $opd_visit_details->symptoms_description        = $request->symptoms_description;
            $opd_visit_details->known_allergies             = $request->any_known_allergies;
            $opd_visit_details->note                        = $request->note;
            $opd_visit_details->refference                  = $request->reference;
            $opd_visit_details->generated_by                = Auth::user()->id;
            $opd_visit_details->save();
            //SAVE in opd Visit details
            // dd($opd_visit_details);

            DB::commit();
            return redirect()->route('OPD-Patient-list')->with('success', 'OPD Registation Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function charge_list($id = null)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $opd_charges_details = PatientCharge::where('ins_by', 'ori')->where('case_id', $opd_patient_details->case_id)->get();
        return view('OPD.charges.charges-list', compact('opd_id', 'opd_patient_details', 'opd_charges_details'));
    }
    public function add_charges($id)
    {
        $opd_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        return view('OPD.charges.add-charges', compact('opd_patient_details', 'opd_id', 'charge_category'));
    }
    public function edit_charges($id, $charge_id)
    {
        $opd_id = base64_decode($id);
        $chargeId = base64_decode($charge_id);
        $charge_category =  ChargesCatagory::all();
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $patient_charge_details = PatientCharge::where('id', $chargeId)->first();

        //dd($patient_charge_details );
        return view('OPD.charges.edit-charges', compact('opd_patient_details', 'opd_id', 'charge_category', 'patient_charge_details'));
    }
    public function delete_charges($id, $charge_id)
    {
        try {
            DB::beginTransaction();
            $opd_id = base64_decode($id);
            $Chargeid = base64_decode($charge_id);
            $charge_details = PatientCharge::find($Chargeid);
            $charge_details->delete();
            DB::commit();
            return redirect()->route('charges-list', ['id' => base64_encode($opd_id)])->with('success', "Charges Deleted Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function save_charges(Request $request)
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
                $patient_charge->opd_id = $request->opd_id;
                $patient_charge->patient_id = $request->patient_id;
                $patient_charge->charge_category = $request->charge_category[$key];
                $patient_charge->charge_sub_category = $request->charge_sub_category[$key];
                $patient_charge->charge_name = $request->charge_name[$key];
                $patient_charge->standard_charges = $request->standard_charges[$key];
                $patient_charge->tax = $request->tax[$key];
                $patient_charge->qty = $request->qty[$key];
                $patient_charge->amount = $request->amount[$key];
                $patient_charge->generated_by = Auth::user()->id;
                $patient_charge->billing_status = '0';
                $patient_charge->save();

                $patient_details = Patient::where('id', $request->patient_id)->first();

                $notofication = new Notification();
                $notofication->message = 'A charge added for ' . $patient_details->prefix . ' ' . $patient_details->first_name . ' ' . $patient_details->middle_name . ' ' . $patient_details->last_name . '(' . $patient_details->id . '' . $patient_details->patient_prefix . ')';
                $notofication->date = $request->date;
                $notofication->created_by = Auth::user()->id;
                $notofication->save();
                // if ($request->charge_category[$key] == '1') {
                //     $charge_detp = PathologyTest::where('charge', $request->charge_name[$key])->first();
                //     $chargedetailstestp = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detp->id)->where('test_status', '=', '0')->first();

                //     if ($chargedetailstestp == null) {
                //         $pathology_patient_test = new PathologyPatientTest();
                //         $pathology_patient_test->case_id = $request->case_id;
                //         $pathology_patient_test->date = $request->date;
                //         $pathology_patient_test->section = 'OPD';
                //         $pathology_patient_test->patient_id = $request->patient_id;
                //         $pathology_patient_test->test_id =  $charge_detp->id;
                //         $pathology_patient_test->opd_id = $request->opd_id;
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
                //         $radiology_patient_test->section = 'OPD';
                //         $radiology_patient_test->patient_id = $request->patient_id;
                //         $radiology_patient_test->test_id = $charge_detr->id;
                //         $radiology_patient_test->opd_id = $request->opd_id;
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
            return redirect()->route('charges-list', ['id' => base64_encode($request->opd_id)])->with('success', "Charges Added Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function opd_pathology_investigation($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $pathology_patient_test = PathologyPatientTest::where('ins_by', 'ori')->where('case_id', $opd_patient_details->case_id)->get();
        return view('OPD.pathology.test-list', compact('pathology_patient_test', 'opd_patient_details', 'opd_id'));
    }
    public function opd_radiology_investigation($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $radiology_patient_test = RadiologyPatientTest::where('ins_by', 'ori')->where('case_id', $opd_patient_details->case_id)->get();
        return view('OPD.radiology.test-list', compact('radiology_patient_test', 'opd_patient_details', 'opd_id'));
    }

    public function opd_prescription_list($id)
    {
        $opd_id = base64_decode($id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();

        return view('OPD.prescription.prescription-list', compact('opd_patient_details', 'opd_id'));
    }

    public function opd_operation($id)
    {
        $operation_booking_id = '';
        $operation_details = '';
        $opd_id = base64_decode($id);
        // dd($opd_id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        // dd($opd_patient_details);
        $patient_details_information = Patient::where('id', '=', $opd_patient_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $opd_patient_details->patient_id)->first();
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            $operation_booking_id = $operation_booking->id;
            $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark', 'operation_theathers.opd_id')
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

        return view('OPD.operation.operation-listing-in-opd', compact('operation_details', 'opd_patient_details', 'operation_booking_id'));
    }

    public function opd_operation_details($id)
    {
        $operation_booking_id = '';
        $operation_details = '';
        $opd_id = base64_decode($id);
        // dd($opd_id);
        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        // dd($opd_patient_details);
        $patient_details_information = Patient::where('id', '=', $opd_patient_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $opd_patient_details->patient_id)->first();
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            $operation_booking_id = $operation_booking->id;
            $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark', 'operation_theathers.opd_id')
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

        return view('OPD.operation.operation-details', compact('operation_details', 'opd_patient_details', 'operation_booking_id'));
    }




    // public function edit_operation_booking_details(Request $request, $id)
    // {
    //     $operation_booking_id = base64_decode($id);
    //     $operation_booking = OperationBooking::where('id', '=',  $operation_booking_id)->first();

    //     // dd( $operation_booking );
    //     $operation_theathers = OperationTheather::where('operation_booking_id', '=',  $operation_booking_id)->first();
    //     //    dd( $operation_theathers );
    //     $patient_id = $operation_theathers->patient_id;
    //     $patient_details_information = Patient::where('id', '=', $patient_id)->first();
    //     $departments = Department::where('is_active', '1')->get();
    //     $doctor = User::where('role', '=', 'Doctor')->get();
    //     $nurse = User::where('role', '=', 'Nurse')->get();
    //     $staff = User::where('role', '=', 'staff')->get();
    //     $operation_department = Operation::all();
    //     $operation_catagory = OperationCatagory::all();
    //     $operation_type = OperationType::all();
    //     $all_patient = Patient::all();

    //     return view('main-operation.edit-operation-booking', compact('operation_booking_id', 'departments', 'all_patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department', 'operation_booking', 'operation_theathers', 'patient_details_information'));
    // }

    public function edit_opd_operation(Request $request, $ot_id)
    {
        $operation_booking_id = base64_decode($ot_id);
        $operation_booking = OperationBooking::where('id', '=',  $operation_booking_id)->first();
        // dd( $operation_booking );
        $operation_theathers = OperationTheather::where('operation_booking_id', '=',  $operation_booking_id)->first();
        // dd($operation_theathers);

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

        return view('OPD.operation.edit-operation-details-in-opd', compact('operation_booking_id', 'departments', 'all_patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department', 'operation_booking', 'operation_theathers', 'patient_details_information'));
    }


    public function update_opd_operation(Request $request)
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
            $operation_theathers->opd_id                             = $request->section_id;
            $operation_theathers->emg_id                             = '';
            $operation_theathers->ipd_id                             = '';
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id              = $request->operation_category_id;
            $operation_theathers->operation_id                       = $request->operation_id;
            $operation_theathers->operation_type                     = $request->operation_type;
            $operation_theathers->remark                             = $request->remark;
            $operation_theathers->save();

            DB::commit();

            return redirect()->route('opd-operation-details', ['opd_id' => base64_encode($request->section_id)])->with('success', 'Operation Booking Details Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function blood_bank_details_in_opd($id)
    {
        $opd_id = base64_decode($id);

        $opd_patient_details = OpdDetails::where('id', $opd_id)->first();
        $patient_details_information = Patient::where('id', '=', $opd_patient_details->patient_id)->first();
        $blood_details = BloodIssue::where('patient_id', $opd_patient_details->patient_id)->get();
        // dd($blood_details);/
        $components_details = BloodComponentIssue::where('patient_id', $opd_patient_details->patient_id)->get();

        return view('OPD.blood-bank.blood-details', compact('opd_id', 'opd_patient_details', 'blood_details', 'components_details', 'patient_details_information'));
    }
}
