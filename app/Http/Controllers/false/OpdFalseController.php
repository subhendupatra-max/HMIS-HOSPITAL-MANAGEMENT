<?php

namespace App\Http\Controllers\false;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\FalsePatient;
use App\Models\Prefix;
use App\Models\Patient;
use App\Models\caseReference;
use App\Models\OpdDetails;
use App\Models\User;
use App\Models\OpdVisitDetails;
use App\Models\OpdUnit;
use DB;
use Auth;

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
        $opd_registaion_list = OpdDetails::where('ins_by','sys')->where('created_at','like','%'.$request->date.'%')->orderBy('id','desc')->get();
        if (@$department_details) {
            return view('false.opd.false_patient_list',compact('department_details','opd_registaion_list','date','department_id'));
        } else {
            return redirect()->back()->with('success', 'Search Again !!!!');
        }
    }

    public function registation_false_opd(Request $request)
    {
        try {
        DB::beginTransaction();
        $opd_prefix = Prefix::where('name', 'opd')->first();
        if($request->visit_type == 'New Visit')
        {
            $patient_details = FalsePatient::whereBetween('year', [$request->from_age, $request->to_age])->where('last_update', '<=', now()->subDays(15))->limit($request->no_of_patient)->get();
        }
        if($request->visit_type == 'Revisit')
        {
            $patient_details = Patient::whereBetween('year', [$request->from_age, $request->to_age])->where('created_at', '<=', now()->subDays(15))->where('ins_by','sys')->limit($request->no_of_patient)->get();
        }

        foreach($patient_details as $value)
        {
            if($request->visit_type == 'New Visit')
            {
                FalsePatient::where('id',$patient_details->id)->update(['last_update'=>$request->date]);
                $patient = new Patient();
                $patient->patient_prefix =  $value->patient_prefix;
                $patient->prefix = $value->prefix;
                $patient->first_name = $value->first_name;
                $patient->middle_name = $value->middle_name;
                $patient->last_name = $value->last_name;
                $patient->guardian_name = $value->guardian_name;
                $patient->guardian_contact_no = $value->guardian_contact_no;
                $patient->marital_status = $value->marital_status;
                $patient->blood_group = $value->blood_group;
                $patient->gender = $value->gender;
                $patient->date_of_birth = $value->date_of_birth;
                $patient->year = $value->year;
                $patient->month = $value->month;
                $patient->day = $value->day;
                $patient->local_guardian_name = $value->local_guardian_name;
                $patient->local_guardian_contact_no = $value->local_guardian_contact_no;
                $patient->phone = $value->phone;
                $patient->email = $value->email;
                $patient->address = $value->address;
                $patient->state = $value->state;
                $patient->country = $value->country;
                $patient->district = $value->district;
                $patient->pin_no = $value->pin_no;
                $patient->identification_name = $value->identification_name;
                $patient->identification_number = $value->identification_number;
                $patient->local_address = $value->local_address;     
                $patient->country_local = $value->country_local;
                $patient->state_local = $value->state_local;
                $patient->district_local = $value->district_local;
                $patient->local_pin_no = $value->local_pin_no;    
                $patient->ins_by = 'sys';   
                $patient->save();

                $pati_id = $patient->id;
            }
            else
            {
                $pati_id = $patient_details->id;
            }

            //SAVE in CASE reference
            $caseReference = new caseReference;
            $caseReference->patient_id =$pati_id;
            $caseReference->section = 'OPD';
            $caseReference->ins_by = 'sys'; 
            $caseReference->save();
            //SAVE in CASE reference

            //SAVE in opd details
            $Opd_details = new OpdDetails;
            $Opd_details->case_id        = $caseReference->id;
            $Opd_details->patient_id     = $pati_id;
            $Opd_details->opd_prefix     = $opd_prefix->prefix;
            $Opd_details->generate_by    = Auth::user()->id;
            $Opd_details->ins_by = 'sys'; 
            $Opd_details->save();
            //SAVE in opd details

            // $cons_doctor = User::where('department',$request->department_id)->inRandomOrder()->first();
            $unit = OpdUnit::select('opd_unit_details.unit_name')->join('opd_unit_details','opd_unit_details.opd_unit_id','=','opd_units.id')->where('opd_units.department_id',$request->department_id)->where('opd_units.department_id',$request->department_id)->where('opd_units.days',date('l', strtotime($request->date)))->inRandomOrder()->first();

            //SAVE in opd Visit details
            $opd_visit_details = new OpdVisitDetails();
            $opd_visit_details->opd_details_id              = $Opd_details->id;
            $opd_visit_details->department_id               = $request->department_id;
            $opd_visit_details->visit_type                  = $request->visit_type;
            $opd_visit_details->unit                        = $unit->unit_name;
            $opd_visit_details->case_type                   = '';
            $opd_visit_details->patient_type                = 'General';
            $opd_visit_details->ticket_fees                 = 00;
            $opd_visit_details->ticket_no                   = 0;
            $opd_visit_details->tpa_organization            = '';
            $opd_visit_details->type_no                     = '';
            $opd_visit_details->appointment_date            = $request->date.' '.sprintf("%02d", rand(8,13)).':'.sprintf("%02d", rand(00,59)).':'.sprintf("%02d", rand(00,59));
            $opd_visit_details->symptoms_type               = '';
            $opd_visit_details->symptoms                    = '';
            $opd_visit_details->symptoms_description        = '';
            $opd_visit_details->known_allergies             = '';
            $opd_visit_details->note                        = '';
            $opd_visit_details->refference                  = '';
            $opd_visit_details->generated_by                = Auth::user()->id;
            $opd_visit_details->ins_by                      = 'sys'; 
            $opd_visit_details->save();
            //SAVE in opd Visit details
            // dd($opd_visit_details);
       }
        DB::commit();
        return response()->json(['message'=>'Registation SuccessFully']); 
    } catch (\Throwable $th) {
        DB::rollback();
        return response()->json(['message'=>'Error!! Do it Again']);
    }
}
        
    
}
