<?php

namespace App\Http\Controllers\Emg;

use App\Http\Controllers\Controller;
use App\Models\BedUnit;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\State;
use App\Models\District;
use App\Models\Patient;
use App\Models\TpaManagement;
use App\Models\Referral;
use App\Models\Department;
use App\Models\EmgDetails;
use App\Models\Diagonasis;
use App\Models\EmgPatientDetails;
use App\Models\User;
use App\Models\SymptomsHead;
use App\Models\SymptomsType;
use App\Models\caseReference;
use App\Models\Prefix;
use App\Models\EmgSetup;
use App\Models\PatientPhysicalDetails;
use App\Models\AllHeader;
use App\Models\EmgPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EmgPatientPhysicalDetail;
use App\Models\Country;
use App\Models\Billing;
use App\Models\ChargesCatagory;
use App\Models\PatientCharge;
use App\Models\PathologyPatientTest;
use App\Models\RadiologyPatientTest;
use App\Models\PathologyTest;
use App\Models\RadiologyTest;
use App\Models\OperationBooking;
use App\Models\OperationTheather;
use App\Models\Operation;
use App\Models\OperationCatagory;
use App\Models\OperationType;
use App\Models\BloodComponentIssue;
use App\Models\bloodBank\BloodIssue;
use PDF;
use DateTime;

class EmgController extends Controller
{

    public function index(Request $request)
    {
        $emg_registaion_list ='';
        $today = new DateTime();  // Get the current date and time
        $today->modify('-30 days');  // Subtract 10 days
        $dateBefore7Days = $today->format('Y-m-d');  // Format the date as desired (e.g., Y-m-d)

        $request_data = $request->all();
        // dd($request_data);
        $trimmedString = str_replace(' ', '', $request->patient_first_name);

        if($request->case_id != null || $request->emg_id != null || $request->patient_phone_no != null ||$request->patient_first_name != null ||$request->appointment_date != null || $request->patient_uhid != null){
        // dd($request->opd_id);
            $emg_registaion_list =  EmgDetails::where(function ($query)  use ($request,$trimmedString) {
                if (!auth()->user()->can('False Generation')) {
                    $query->where('ins_by', 'ori');
                }
                if ($request->case_id != '') {
                    $query->where('case_id', '=', $request->case_id);
                }
                if ($request->emg_id != '') {
                    $query->where('id', '=', $request->emg_id);
                }
                })->whereHas('all_patient_details',function ($query)  use ($request,$trimmedString) {

                    if ($request->patient_phone_no != '') {
                        $query->where('phone', '=', $request->patient_phone_no);
                    }
                    if ($request->patient_uhid != '') {
                        $query->where('id', '=', $request->patient_uhid);
                    }
                    if ($request->patient_first_name != '') {
                        $query->where(DB::raw("CONCAT(
                            TRIM(CONCAT_WS('', prefix, ' ')),
                            TRIM(CONCAT_WS('', first_name, ' ')),
                            TRIM(CONCAT_WS('', middle_name, ' ')),
                            TRIM(last_name)
                          )"), 'like', '%'.$trimmedString.'%');
                    }
                })
                ->whereHas('all_emg_visit_details',function ($query)  use ($request) {
                    if ($request->appointment_date != '') {
                        $query->where('appointment_date', 'like', '%'.$request->appointment_date.'%');
                    }
                })
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        else{
           
            $emg_registaion_list =  EmgDetails::where(function ($query) {
                if (!auth()->user()->can('False Generation')) {
                    $query->where('ins_by', 'ori');
                }
                })->whereHas('all_emg_visit_details',function ($query)  use ($dateBefore7Days) {
                    $query->where('appointment_date', '>=', $dateBefore7Days);   
                })
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        // dd($opd_registaion_list);
        return view('emg.emg-patient-list', compact('emg_registaion_list','request_data'));

    }

    public function after_new_old(Request $request)
    {
        $patient_type = $request->patient_type;
        if ($patient_type == 'new_patient') {
            $blood_group = BloodGroup::all();
            $state = State::all();
            $districts = District::all();
            $type = 'emg';
            $country = Country::all();
            return view('setup.patient.add_new_patient', compact('blood_group', 'state', 'districts', 'type', 'country'));
        } else {
            return redirect()->route('emg-registation');
        }
    }

    public function emg_registation(Request $request, $patientid = null)
    {
        if ($patientid != null) {
            $patient_id = base64_decode($patientid);
        } else {
            $patient_id = $request->patient_id;
        }
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $department = Department::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $ticket_fees = EmgSetup::first();

        $all_patient = Patient::where('is_active', '1')->where('ins_by', 'ori')->get();
        $patient_details_information = Patient::where('id', $patient_id)->where('is_active', '1')->where('ins_by', 'ori')->first();

        return view('emg.emg-registration', compact('ticket_fees', 'symptoms_types', 'department', 'referer',  'tpa_management', 'all_patient', 'patient_details_information'));
    }

    public function add_emg_registation(Request $request)
    {
        //dd($request->all());
        $validate = $request->validate([
            'appointment_date'      => 'required',
            'patient_type'          => 'required',
            'department'            => 'required',
            'cons_doctor'           => 'required',
            'medico_legal_case'     => 'required',
            'patient_id'     => 'required',
        ]);
        try {
            DB::beginTransaction();
            $emg_prefix = Prefix::where('name', 'emg')->first();

            //SAVE in CASE reference
            $caseReference = new caseReference;
            $caseReference->patient_id     = $request->patient_id;
            $caseReference->section     = 'EMG';
            $caseReference->save();
            //SAVE in CASE reference

            //SAVE in opd details
            $Emg_details = new EmgDetails();
            $Emg_details->case_id        = $caseReference->id;
            $Emg_details->patient_id     = $request->patient_id;
            $Emg_details->emg_prefix     = $emg_prefix->prefix;
            $Emg_details->generate_by    = Auth::user()->id;
            $Emg_details->save();
            //SAVE in opd details

            $caseReference_update = caseReference::find($caseReference->id);
            $caseReference_update->section_id = $Emg_details->id;
            $caseReference->save();


            //SAVE in opd Visit details
            $emg_patient_details = new EmgPatientDetails();
            $emg_patient_details->emg_details_id              = $Emg_details->id;
            $emg_patient_details->department_id               = $request->department;
            $emg_patient_details->cons_doctor                 = $request->cons_doctor;
            $emg_patient_details->medico_legal_case           = $request->medico_legal_case;
            $emg_patient_details->ticket_fees                 = $request->ticket_fees;
            $emg_patient_details->case_type                   = $request->case;
            $emg_patient_details->patient_type                = $request->patient_type;
            $emg_patient_details->tpa_organization            = $request->tpa_organization;
            $emg_patient_details->type_no                     = $request->type_no;
            $emg_patient_details->appointment_date            = $request->appointment_date;
            $emg_patient_details->symptoms_type               = $request->symptoms_type;
            $emg_patient_details->symptoms                    = $request->symptoms_title;
            $emg_patient_details->symptoms_description        = $request->symptoms_description;
            $emg_patient_details->known_allergies             = $request->any_known_allergies;
            $emg_patient_details->note                        = $request->note;
            $emg_patient_details->refference                  = $request->reference;
            $emg_patient_details->generated_by                = Auth::user()->id;
            $emg_patient_details->save();
            //SAVE in Emg Patient details

            // $patient_physical_condition = new EmgPatientPhysicalDetail();
            // $patient_physical_condition->emg_id                      = $Emg_details->id;
            // $patient_physical_condition->bp                          = $request->bp;
            // $patient_physical_condition->height                      = $request->height;
            // $patient_physical_condition->weight                      = $request->weight;
            // $patient_physical_condition->pulse                       = $request->pulse;
            // $patient_physical_condition->temperature                 = $request->temperature;
            // $patient_physical_condition->respiration                 = $request->respiration;
            // $patient_physical_condition->save();
            DB::commit();
            $header_image = AllHeader::where('header_name', 'opd_prescription')->first();

            $emg_patient_details = EmgPatientDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'emg_patient_details.patient_type', 'patients.address', 'patients.blood_group', 'emg_patient_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'emg_patient_details.appointment_date', 'emg_patient_details.medico_legal_case', 'emg_details.emg_prefix', 'emg_details.id as emg_id')
                ->join('emg_details', 'emg_details.id', '=', 'emg_patient_details.emg_details_id')
                ->join('patients', 'patients.id', '=', 'emg_details.patient_id')
                ->join('users', 'users.id', '=', 'emg_patient_details.cons_doctor')
                ->join('departments', 'departments.id', '=', 'emg_patient_details.department_id')
                ->where('emg_patient_details.id', $emg_patient_details->id)
                ->first();

            dd($emg_patient_details);


            if ($request->save == 'save_and_print') {
                $pdf = PDF::loadView('emg._print.emg_prescription', compact('emg_patient_details', 'header_image'));
                return $pdf->stream('emg_prescription.pdf');
                return redirect()->route('emg-patient-list')->with('success', 'EMG Registation Sucessfully');
            } else {
                return redirect()->route('emg-patient-list')->with('success', 'EMG Registation Sucessfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function emg_set_up()
    {
        $setup_details = EmgSetup::first();
        return view('setup.emg.emg-setup', compact('setup_details'));
    }

    public function add_emg_set_up(Request $request)
    {
        $validate = $request->validate([
            'ticket_fees'  => 'required',
        ]);
        try {
            DB::beginTransaction();
            $emg_setup = EmgSetup::where('id', $request->id)->update(['ticket_fees' => $request->ticket_fees]);
            DB::commit();
            return redirect()->back()->with('success', 'EMG Setup Updated');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function profile($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $emg_visit_details = EmgPatientDetails::where('emg_details_id', $emg_id)->get();
        $PhysicalDetails  =  EmgPatientPhysicalDetail::where('emg_id', $emg_id)->get();
        $payment_amount = EmgPayment::where('emg_id', $emg_id)->sum('amount');
        $billing_amount = Billing::where('emg_id', $emg_id)->sum('grand_total');
        $PathologyTestDetails = PathologyPatientTest::where('case_id', $emg_patient_details->case_id)->get();
        $RadiologyTestDetails = RadiologyPatientTest::where('case_id', $emg_patient_details->case_id)->get();

        $blood_details = BloodIssue::where('patient_id', $emg_patient_details->patient_id)->get();
        $components_details = BloodComponentIssue::where('patient_id', $emg_patient_details->patient_id)->get();


        $operation_booking_id = '';
        $operation_details = '';

        // dd($opd_id);

        // dd($emg_patient_details);
        $patient_details_information = Patient::where('id', '=', $emg_patient_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $emg_patient_details->patient_id)->first();
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

        return view('emg.emg-patient-profile', compact('emg_patient_details', 'emg_visit_details', 'PhysicalDetails', 'payment_amount', 'billing_amount', 'PathologyTestDetails', 'RadiologyTestDetails', 'blood_details', 'components_details', 'operation_details'));
    }

    public function admission_from_emg($id)
    {
        $emg_opd_id = base64_decode($id);
        $tpa_management = TpaManagement::get();
        $referer = Referral::get();
        $departments = Department::where('is_active', '1')->get();
        $units = BedUnit::where('is_active', '1')->get();
        $symptoms_types = SymptomsType::get();
        $visit_details = EmgDetails::where('id', '=', $emg_opd_id)->first();
        $patient_source_id = $visit_details->emg_prefix . '' . $visit_details->id;
        $case_id = $visit_details->case_id;
        $patient_source = 'EMG';
        $icd_code  = Diagonasis::all();

        return view('Ipd.ipd-registration', compact('icd_code','symptoms_types', 'departments', 'referer', 'visit_details', 'tpa_management', 'patient_source_id', 'case_id', 'patient_source', 'emg_opd_id', 'units'));
    }

    public function charge_list($id = null)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $emg_charges_details = PatientCharge::where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.charges.charges-list', compact('emg_id', 'emg_patient_details', 'emg_charges_details'));
    }
    public function add_charges($id)
    {
        $emg_id = base64_decode($id);
        $charge_category =  ChargesCatagory::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        return view('emg.charges.add-charges', compact('emg_patient_details', 'emg_id', 'charge_category'));
    }
    public function edit_charges($id, $charge_id)
    {
        $emg_id = base64_decode($id);
        $chargeId = base64_decode($charge_id);
        $charge_category =  ChargesCatagory::all();
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $patient_charge_details = PatientCharge::where('id', $chargeId)->first();

        return view('emg.charges.edit-charges', compact('emg_patient_details', 'emg_id', 'charge_category', 'patient_charge_details'));
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
                $patient_charge->emg_id = $request->emg_id;
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

                // if ($request->charge_category[$key] == '1') {
                //     $charge_detp = PathologyTest::where('charge', $request->charge_name[$key])->first();
                //     // dd($charge_detp);
                //     $chargedetailstestp = PathologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detp->id)->where('test_status', '=', '0')->first();

                //     if ($chargedetailstestp == null) {
                //         $pathology_patient_test = new PathologyPatientTest();
                //         $pathology_patient_test->case_id = $request->case_id;
                //         $pathology_patient_test->date = $request->date;
                //         $pathology_patient_test->section = 'EMG';
                //         $pathology_patient_test->patient_id = $request->patient_id;
                //         $pathology_patient_test->test_id =  $charge_detp->id;
                //         $pathology_patient_test->emg_id = $request->emg_id;
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
                //     // dd( $charge_detr);
                //     $chargedetailstestr = RadiologyPatientTest::where('case_id', $request->case_id)->where('test_id', $charge_detr->id)->where('test_status', '=', '0')->where('test_id', $charge_detr->charge)->first();

                //     if ($chargedetailstestr == null) {
                //         $radiology_patient_test = new RadiologyPatientTest();
                //         $radiology_patient_test->case_id = $request->case_id;
                //         $radiology_patient_test->date = $request->date;
                //         $radiology_patient_test->section = 'EMG';
                //         $radiology_patient_test->patient_id = $request->patient_id;
                //         $radiology_patient_test->test_id = $charge_detr->id;
                //         $radiology_patient_test->emg_id = $request->emg_id;
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
            return redirect()->route('charges-list-emg', ['id' => base64_encode($request->emg_id)])->with('success', "Charges Added Successfully");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function emg_pathology_investigation($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $pathology_patient_test = PathologyPatientTest::where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.pathology.test-list', compact('pathology_patient_test', 'emg_patient_details', 'emg_id'));
    }

    public function emg_radiology_investigation($id)
    {
        $emg_id = base64_decode($id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        // dd($emg_patient_details);
        $radiology_patient_test = RadiologyPatientTest::where('ins_by', 'ori')->where('case_id', $emg_patient_details->case_id)->get();
        return view('emg.radiology.test-list', compact('radiology_patient_test', 'emg_patient_details', 'emg_id'));
    }

    public function print_emg_registation($id)
    {
        $emg_id = base64_decode($id);
        $header_image = AllHeader::where('header_name', 'opd_prescription')->first();
        $emg_patient_details = EmgPatientDetails::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.guardian_name', 'patients.guardian_contact_no', 'patients.year', 'patients.month', 'patients.day', 'patients.gender', 'emg_patient_details.patient_type', 'patients.address', 'patients.blood_group', 'emg_patient_details.ticket_fees', 'patients.patient_prefix', 'patients.id as patient_id', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'departments.department_name', 'emg_patient_details.appointment_date', 'emg_patient_details.medico_legal_case', 'emg_details.emg_prefix', 'emg_details.id as emg_id')
            ->join('emg_details', 'emg_details.id', '=', 'emg_patient_details.emg_details_id')
            ->join('patients', 'patients.id', '=', 'emg_details.patient_id')
            ->join('users', 'users.id', '=', 'emg_patient_details.cons_doctor')
            ->join('departments', 'departments.id', '=', 'emg_patient_details.department_id')
            ->where('emg_details.id', $emg_id)
            ->first();

        // dd($emg_patient_details);

        $pdf = PDF::loadView('emg._print.emg_prescription', compact('emg_patient_details', 'header_image'));
        return $pdf->stream('emg_prescription.pdf');

        return redirect()->route('emg-patient-list')->with('success', ' Sucessfully');
    }

    public function delete_emg_registation($id)
    {
        try {
            DB::beginTransaction();
            $emg_id = base64_decode($id);
            EmgDetails::where('id', $emg_id)->delete();
            EmgPatientDetails::where('emg_details_id', $emg_id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Registation Deleted Successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function emg_operation($id)
    {
        $operation_booking_id = '';
        $operation_details = '';
        $emg_id = base64_decode($id);
        // dd($emg_id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        // dd($emg_patient_details);
        $patient_details_information = Patient::where('id', '=', $emg_patient_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $emg_patient_details->patient_id)->first();
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            $operation_booking_id = $operation_booking->id;
            $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark','operation_theathers.emg_id')
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

        return view('emg.operation-emg.operation-listing-in-emg', compact('operation_details', 'emg_patient_details', 'emg_id', 'operation_booking_id'));
    }



    public function emg_operation_details($id)
    {
        $operation_booking_id = '';
        $operation_details = '';
        $emg_id = base64_decode($id);
        // dd($emg_id);
        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        // dd($emg_patient_details);
        $patient_details_information = Patient::where('id', '=', $emg_patient_details->patient_id)->first();
        // dd($patient_details_information);
        $operation_theathers  = OperationTheather::where('patient_id', $emg_patient_details->patient_id)->first();
        // dd($operation_theathers);
        // dd($patient_details_information);
        if ($operation_theathers != null) {
            $operation_booking = OperationBooking::where('id', $operation_theathers->operation_booking_id)->first();
            $operation_booking_id = $operation_booking->id;
            $operation_details = OperationBooking::select('patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.patient_prefix', 'operations.operation_name', 'departments.department_name', 'operation_catagories.operation_catagory_name', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'operation_bookings.operation_date_from', 'operation_bookings.operation_date_to', 'operation_bookings.id as booking_id', 'operation_bookings.ass_consultant_1', 'operation_bookings.ass_consultant_2', 'operation_bookings.anesthetist', 'operation_bookings.ot_assistant', 'operation_bookings.ot_technician', 'operation_bookings.anaethesia_type', 'operation_types.operation_type_name', 'operation_bookings.operation_date_to', 'operation_bookings.operation_date_from', 'operation_theathers.case_id', 'operation_theathers.section', 'operation_bookings.status', 'operation_bookings.remark', 'operation_theathers.emg_id')
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

        return view('emg.operation-emg.operation-details', compact('operation_details', 'emg_patient_details', 'operation_booking_id'));
    }


    public function edit_emg_operation(Request $request, $id)
    {
        $operation_booking_id = base64_decode($id);
        $operation_booking = OperationBooking::where('id', '=',  $operation_booking_id)->first();

        // dd( $operation_booking );
        $operation_theathers = OperationTheather::where('operation_booking_id', '=',  $operation_booking_id)->first();
        // dd($operation_theathers);
        $emg_patient_details = EmgDetails::where('id', $operation_theathers->emg_id)->first();

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

        return view('emg.operation-emg.edit-operation-details-in-emg', compact('operation_booking_id', 'departments', 'all_patient', 'doctor', 'nurse', 'staff', 'operation_catagory', 'operation_type', 'operation_department', 'operation_booking', 'operation_theathers', 'patient_details_information', 'emg_patient_details'));
    }


    public function update_emg_operation(Request $request)
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
            $operation_theathers->ipd_id                             = '';
            $operation_theathers->emg_id                             = $request->section_id;
            $operation_theathers->patient_id                         = $request->patient_id;
            $operation_theathers->operation_department               = $request->operation_department;
            $operation_theathers->operation_category_id              = $request->operation_category_id;
            $operation_theathers->operation_id                       = $request->operation_id;
            $operation_theathers->operation_type                     = $request->operation_type;
            $operation_theathers->remark                             = $request->remark;
            $operation_theathers->save();

            DB::commit();

            return redirect()->route('emg-operation-in-emg', ['id' => base64_encode($request->section_id)])->with('success', 'Operation Booking Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function blood_bank_details_in_emg($id)
    {
        $emg_id = base64_decode($id);

        $emg_patient_details = EmgDetails::where('id', $emg_id)->first();
        $patient_details_information = Patient::where('id', '=', $emg_patient_details->patient_id)->first();
        $blood_details = BloodIssue::where('patient_id', $emg_patient_details->patient_id)->get();
        // dd($blood_details);/
        $components_details = BloodComponentIssue::where('patient_id', $emg_patient_details->patient_id)->get();

        return view('emg.blood-bank.blood-details', compact('emg_id', 'emg_patient_details', 'blood_details', 'components_details', 'patient_details_information'));
    }
}
