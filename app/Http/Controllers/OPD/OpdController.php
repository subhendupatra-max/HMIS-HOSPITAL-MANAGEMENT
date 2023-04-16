<?php

namespace App\Http\Controllers\OPD;

use App\Http\Controllers\Controller;
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
use App\Models\Prefix;
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
        $opd_registaion_list = OpdDetails::get();
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
            return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'type'));
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
    public function opd_registation($patientid)
    {
        $patient_id = base64_decode($patientid);
        $patient_details = Patient::where('id', '=', $patient_id)->first();
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $ticket_fees = OpdSetup::first();

        return view('OPD.opd_registation', compact('symptoms_types', 'ticket_fees', 'departments', 'referer', 'patient_details', 'patient_id', 'tpa_management'));
    }
    public function find_doctor_by_department(Request $request)
    {
        $opd_units = OpdUnit::select('opd_unit_details.unit_name')->join('opd_unit_details', 'opd_unit_details.opd_unit_id', '=', 'opd_units.id')->where('opd_units.days', date("l"))->where('opd_units.department_id', $request->department_id)->get();

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
        return response()->json($data);
    }

    public function add_opd_registation(Request $request)
    {
        $validate = $request->validate([
            'appointment_date' => 'required',
            'patient_type' => 'required',
            'visit_type' => 'required',
            'department' => 'required',
            'cons_doctor' => 'required',
            'unit' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $opd_prefix = Prefix::where('name', 'opd')->first();

            //SAVE in CASE reference
            $caseReference = new caseReference;
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
            $opd_visit_details->bp                          = $request->bp;
            $opd_visit_details->height                      = $request->height;
            $opd_visit_details->weight                      = $request->weight;
            $opd_visit_details->pulse                       = $request->pulse;
            $opd_visit_details->temperature                 = $request->temperature;
            $opd_visit_details->respiration                 = $request->respiration;
            $opd_visit_details->known_allergies             = $request->any_known_allergies;
            $opd_visit_details->note                        = $request->note;
            $opd_visit_details->refference                  = $request->reference;
            $opd_visit_details->generated_by                = Auth::user()->id;
            $opd_visit_details->save();
            //SAVE in opd Visit details

            DB::commit();
            if ($request->save == 'save_and_print') {
                $pdf = PDF::loadView('OPD._print.opd_prescription');
                return $pdf->stream('opd_prescription.pdf', array('Attachment' => 0));
                // return $pdf->download('opd_prescription.pdf')->redirect()->back()->with('success', 'OPD Registation Sucessfully');
            } else {
                return redirect()->route('OPD-Patient-list')->with('success', 'OPD Registation Sucessfully');
            }
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
        // $opd_visit_details = OpdVisitDetails::where('opd_details_id',$opd_id)->get();
        $opd_visit_details = OpdVisitDetails::where('opd_details_id', $opd_id)->first();
        return view('OPD.opd-patient-profile', compact('opd_patient_details', 'opd_visit_details', 'timelineDetails'));
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


    public function opd_registation_not_id(Request $request)
    {
           
        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();

     

        // $patient_details = Patient::where('id', '=', $patient_id)->first();
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $ticket_fees = OpdSetup::first();

        return view('OPD.opd_registation',compact('all_patient', 'patient_details_information','tpa_management','referer','departments','symptoms_types','ticket_fees'));
    }





    // public function add_patient_details_in_opd_resgistration(Request $request)
    // {
    //     $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
    //     $patient_details_information = Patient::where('id', $request->patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();


    //     return view('OPD.opd_registation', compact('all_patient', 'patient_details_information'));
    // }
}
