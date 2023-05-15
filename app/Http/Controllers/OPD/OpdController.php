<?php

namespace App\Http\Controllers\OPD;

use App\Http\Controllers\Controller;
use App\Models\AllHeader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\OpdTimeline;
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
use App\Models\Country;
use App\Models\Payment;
use App\Models\PatientCharge;
use App\Models\PathologyTest;
use App\Models\RadiologyTest;
use App\Models\RadiologyPatientTest;
use PDF;

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
    public function index()
    {
        $opd_registaion_list = OpdDetails::where('ins_by', 'ori')->orderBy('id', 'desc')->get();
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

        //dd($PathologyTestDetails);
        $opd_visit_details = OpdVisitDetails::where('opd_details_id', $opd_id)->first();
        return view('OPD.opd-patient-profile', compact('billing_amount', 'opd_patient_details', 'opd_visit_details', 'timelineDetails', 'PhysicalDetails', 'payment_amount', 'PathologyTestDetails', 'RadiologyTestDetails'));
    }
    public function prescription_print($id)
    {
        $opd_visit_id = base64_decode($id);
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        $opd_patient_details = OpdVisitDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'opd_visit_details.patient_type', 'patients.address', 'patients.blood_group', 'opd_visit_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'opd_patient_physical_details.height', 'opd_patient_physical_details.weight', 'opd_patient_physical_details.bp', 'opd_patient_physical_details.respiration', 'opd_patient_physical_details.temperature', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'opd_visit_details.appointment_date', 'opd_visit_details.id as opd_visit_details_id', 'opd_details.id as opd_id', 'opd_details.case_id', 'opd_details.opd_prefix', 'states.name as state_name', 'districts.name as district_name', 'patients.pin_no', 'countries.country_name', 'patients.phone', 'patients.guardian_contact_no', 'patients.local_guardian_name', 'patients.local_guardian_contact_no', 'opd_visit_details.ticket_no')
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

        $pdf = PDF::loadView('OPD._print.opd_prescription', compact('opd_patient_details', 'header_image'));
        return $pdf->stream('opd-prescription.pdf');

        return redirect()->route('OPD-Patient-list')->with('success', ' Sucessfully');
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

        return view('Ipd.ipd-registration', compact('symptoms_types', 'departments', 'referer', 'visit_details', 'tpa_management', 'patient_source_id', 'case_id', 'patient_source', 'emg_opd_id', 'units'));
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

        return view('OPD.edit-opd-patient', compact('opd_patient_details', 'opd_visit_details', 'timelineDetails', 'ticket_fees', 'tpa_management', 'referer', 'departments', 'symptoms_types', 'all_patient', 'patient_details_information', 'patient_physical_details'));
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
        // try {
        DB::beginTransaction();
        $opd_prefix = Prefix::where('name', 'opd')->first();

        //SAVE in CASE reference
        $caseReference = new caseReference;
        $caseReference->patient_id = $request->patient_id;
        $caseReference->section = 'OPD';
        $caseReference->save();
        //SAVE in CASE reference

        //SAVE in opd details
        $Opd_details = OpdDetails::find($request->old_details_id);
        $Opd_details->case_id        = $caseReference->id;
        $Opd_details->patient_id     = $request->patient_id;
        $Opd_details->opd_prefix     = $opd_prefix->prefix;
        $Opd_details->generate_by    = Auth::user()->id;
        $Opd_details->save();
        //SAVE in opd details
        CaseReference::where('patient_id', $request->patient_id)->update(['section_id' => $Opd_details->id]);

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


        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

        $opd_patient_details = OpdVisitDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'opd_visit_details.patient_type', 'patients.address', 'patients.blood_group', 'opd_visit_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'opd_patient_physical_details.height', 'opd_patient_physical_details.weight', 'opd_patient_physical_details.bp', 'opd_patient_physical_details.respiration', 'opd_patient_physical_details.temperature', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'opd_visit_details.appointment_date', 'opd_visit_details.id as opd_visit_details_id')
            ->leftjoin('opd_details', 'opd_details.id', '=', 'opd_visit_details.opd_details_id')
            ->leftjoin('patients', 'patients.id', '=', 'opd_details.patient_id')
            ->leftjoin('opd_patient_physical_details', 'opd_patient_physical_details.opd_id', '=', 'opd_visit_details.id')
            ->leftjoin('users', 'users.id', '=', 'opd_visit_details.cons_doctor')
            ->leftjoin('departments', 'departments.id', '=', 'opd_visit_details.department_id')
            ->where('opd_visit_details.id', $opd_visit_details->id)
            ->first();

        DB::commit();
        if ($request->save == 'save_and_print') {
            return view('OPD._print.opd_prescription', compact('opd_patient_details', 'header_image'));
            // return $pdf->stream('opd_prescription.pdf', array('Attachment' => 0));
            // return $pdf->download('opd_prescription.pdf')->redirect()->back()->with('success', 'OPD Registation Sucessfully');
        } else {
            return redirect()->route('OPD-Patient-list')->with('success', 'OPD Registation Updated Sucessfully');
        }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
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
                $patient_charge->charge_set = $request->charge_set[$key];
                $patient_charge->charge_type = $request->charge_type[$key];
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

                if ($request->charge_category[$key] == '1') {
                    $charge_detp = PathologyTest::where('charge', $request->charge_name[$key])->first();
                    $chargedetailstestp = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detp->id)->where('test_status', '=', '0')->first();

                    if ($chargedetailstestp == null) {
                        $pathology_patient_test = new PathologyPatientTest();
                        $pathology_patient_test->case_id = $request->case_id;
                        $pathology_patient_test->date = $request->date;
                        $pathology_patient_test->section = 'OPD';
                        $pathology_patient_test->patient_id = $request->patient_id;
                        $pathology_patient_test->test_id =  $charge_detp->id;
                        $pathology_patient_test->opd_id = $request->opd_id;
                        $pathology_patient_test->generated_by = Auth::user()->id;
                        $pathology_patient_test->billing_status = '2';
                        $pathology_patient_test->test_status = '0';
                        $pathology_patient_test->save();
                    } else {
                        $chargedetailstestp->billing_status = '2';
                        $chargedetailstestp->save();
                    }
                }
                if ($request->charge_category[$key] == '2') {
                    $charge_detr = RadiologyTest::where('charge', $request->charge_name[$key])->first();
                    $chargedetailstestr = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detr->id)->where('test_status', '=', '0')->where('test_id', $charge_detr->charge)->first();

                    if ($chargedetailstestr == null) {
                        $radiology_patient_test = new RadiologyPatientTest();
                        $radiology_patient_test->case_id = $request->case_id;
                        $radiology_patient_test->date = $request->date;
                        $radiology_patient_test->section = 'OPD';
                        $radiology_patient_test->patient_id = $request->patient_id;
                        $radiology_patient_test->test_id = $charge_detr->id;
                        $radiology_patient_test->opd_id = $request->opd_id;
                        $radiology_patient_test->generated_by = Auth::user()->id;
                        $radiology_patient_test->billing_status = '2';
                        $radiology_patient_test->test_status = '0';
                        $radiology_patient_test->save();
                    } else {
                        $chargedetailstestr->billing_status = '2';
                        $chargedetailstestr->save();
                    }
                }
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
}
