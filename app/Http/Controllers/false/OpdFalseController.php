<?php

namespace App\Http\Controllers\false;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\FalsePatient;

class OpdFalseController extends Controller
{
    public function index()
    {
        $departments = Department::where('is_active','1')->get();
        return view('false.opd.index',compact('departments'));
    }
    public function false_opd_registation(Request $request)
    {
        $validate = $request->validate([
            'date'      => 'required',
            'department_id' => 'required',
        ]);
        $department_id = $request->department_id;
        $date = $request->date;
        $department_details = Department::where('is_active','1')->where('id',$request->department_id)->first();
        if (@$department_details) {
            return view('false.opd.false_patient_list',compact('department_details','date','department_id'));
        } else {
            return redirect()->back()->with('success', 'Search Again !!!!');
        }
    }

    public function registation_false_opd(Request $request)
    {
        $validate = $request->validate([
            'department_id'      => 'required',
            'visit_type' => 'required',
            'from_age' => 'required',
            'gender' => 'required',
            'no_of_patient' => 'required',
            'date' => 'required',
            'to_age' => 'required',
        ]);
        $opd_prefix = Prefix::where('name', 'opd')->first();
        $false_patient = FalsePatient::whereBetween('year', [$request->from_age, $request->to_age])->limit($request->no_of_patient)->get();
        foreach($false_patient as $value)
        {
            $patient = new Patient();
            $patient->patient_prefix =  $false_patient->patient_prefix
            $patient->prefix = $false_patient->prefix;
            $patient->first_name = $false_patient->first_name;
            $patient->middle_name = $false_patient->middle_name;
            $patient->last_name = $false_patient->last_name;
            $patient->guardian_name = $false_patient->guardian_name;
            $patient->guardian_contact_no = $false_patient->guardian_contact_no;
            $patient->marital_status = $false_patient->marital_status;
            $patient->blood_group = $false_patient->blood_group;
            $patient->gender = $false_patient->gender;
            $patient->date_of_birth = \Carbon\Carbon::parse($false_patient->date_of_birth)->format('Y-m-d');
            $patient->year = $false_patient->year;
            $patient->month = $false_patient->month;
            $patient->day = $false_patient->day;
            $patient->local_guardian_name = $false_patient->local_guardian_name;
            $patient->local_guardian_contact_no = $false_patient->local_guardian_contact_no;
            $patient->phone = $false_patient->phone;
            $patient->email = $false_patient->email;
            $patient->address = $false_patient->address;
            $patient->state = $false_patient->state;
            $patient->country = $false_patient->country;
            $patient->district = $false_patient->district;
            $patient->pin_no = $false_patient->pin_no;
            $patient->identification_name = $false_patient->identification_name;
            $patient->identification_number = $false_patient->identification_number;
            $patient->local_address = $false_patient->local_address;     
            $patient->country_local = $false_patient->country_local;
            $patient->state_local = $false_patient->state_local;
            $patient->district_local = $false_patient->district_local;
            $patient->local_pin_no = $false_patient->local_pin_no;    
            $patient->save();

            //SAVE in CASE reference
            $caseReference = new caseReference;
            $caseReference->patient_id = $request->patient_id;
            $caseReference->section = 'OPD';
            $caseReference->save();
            //SAVE in CASE reference

            //SAVE in opd details
            $Opd_details = new OpdDetails;
            $Opd_details->case_id        = $caseReference->id;
            $Opd_details->patient_id     = $patient->id;
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
            $opd_visit_details->known_allergies             = $request->any_known_allergies;
            $opd_visit_details->note                        = $request->note;
            $opd_visit_details->refference                  = $request->reference;
            $opd_visit_details->generated_by                = Auth::user()->id;
            $opd_visit_details->save();
            //SAVE in opd Visit details
            // dd($opd_visit_details);

            $patient_physical_condition = new OpdPatientPhysicalDetail();
            $patient_physical_condition->opd_id                      = $Opd_details->id;
            $patient_physical_condition->bp                          = $request->bp;
            $patient_physical_condition->height                      = $request->height;
            $patient_physical_condition->weight                      = $request->weight;
            $patient_physical_condition->pulse                       = $request->pulse;
            $patient_physical_condition->temperature                 = $request->temperature;
            $patient_physical_condition->respiration                 = $request->respiration;
            $patient_physical_condition->save();



        }
        
    }
}
