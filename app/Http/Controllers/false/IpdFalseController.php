<?php

namespace App\Http\Controllers\false;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\IpdDetails;
use App\Models\Prefix;
use App\Models\FalsePatient;
use App\Models\EmgDetails;
use App\Models\OpdDetails;
use App\Models\PatientBedHistory;
use App\Models\caseReference;
use App\Models\Bed;
use App\Models\Patient;
use App\Models\RadiologyTest;
use App\Models\User;
use App\Models\Diagonasis;
use App\Models\PathologyTest;
use App\Models\PathologyPatientTest;
use App\Models\RadiologyPatientTest;
use App\Models\RadiologyCatagory;
use App\Models\PathologyCatagory;
use App\Models\DischargedPatient;
use Auth;
use DB;

class IpdFalseController extends Controller
{
    public function index()
    {
        $departments = Department::where('is_active', '1')->get();
        return view('false.ipd.index', compact('departments'));
    }

    public function false_ipd_registation(Request $request)
    {
        $validate = $request->validate([
            'date'      => 'required',
            'department_id' => 'required',
        ]);
        $department_id = $request->department_id;
        $date = $request->date;
        $department_details = Department::where('is_active', '1')->where('id', $request->department_id)->first();
        $ipd_registaion_list = IpdDetails::where('ins_by', 'sys')->where('discharged', 'no')->get();
        $pathology_category = PathologyCatagory::get();
        $radiology_category = RadiologyCatagory::get();

        $todays_total_ipd = IpdDetails::where('appointment_date', 'like', $date . '%')->count();
        $todays_ipd_from_opd = IpdDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->where('patient_source', 'OPD')->count();
        $todays_ipd_from_opd_sys = IpdDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->where('patient_source', 'OPD')->where('ins_by', 'sys')->count();
        $todays_ipd_from_opd_ori = IpdDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->where('patient_source', 'OPD')->where('ins_by', 'ori')->count();



        $todays_ipd_from_emg = IpdDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->where('patient_source', 'EMG')->count();
        $todays_ipd_from_emg_sys = IpdDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', 'sys')->where('patient_source', 'EMG')->where('department_id', '=', $department_id)->count();
        $todays_ipd_from_emg_ori = IpdDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', 'ori')->where('patient_source', 'EMG')->where('department_id', '=', $department_id)->count();

        $todays_total_for_this_department = IpdDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->count();

        $todays_total_for_this_department_sys = IpdDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->where('ins_by', '=', 'sys')->count();

        $todays_total_for_this_department_ori = IpdDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->where('ins_by', '=', 'ori')->count();

        $todays_total_ipd_sys = IpdDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'sys')->count();
        $todays_total_ipd_ori = IpdDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'ori')->count();

        $doctor = User::where('role', '=', 'Doctor')->get();
        $icd_code = Diagonasis::all();
        if (@$department_details) {
            return view('false.ipd.false_patient_list', compact('todays_ipd_from_emg_sys','todays_ipd_from_emg_ori','todays_ipd_from_opd_ori','todays_ipd_from_opd_sys','department_id', 'ipd_registaion_list', 'date', 'department_details', 'pathology_category', 'radiology_category', 'todays_total_ipd', 'todays_ipd_from_opd', 'todays_ipd_from_emg', 'todays_total_for_this_department', 'todays_total_ipd_sys','todays_total_ipd_ori','doctor','todays_total_for_this_department_sys','todays_total_for_this_department_ori','icd_code'));
        } else {
            return redirect()->back()->with('success', 'Search Again !!!!');
        }
    }

    public function registation_false_ipd(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->from == 'OPD') {
                if ($request->re_new == 'Revisit') {
                    $patient_details = OpdDetails::select('opd_details.id as patient_source_id','opd_details.patient_id','opd_visit_details.unit')->leftjoin('opd_visit_details','opd_visit_details.opd_details_id','=','opd_details.id')->leftjoin('patients','patients.id','=','opd_details.patient_id')->whereBetween('patients.year', [$request->from_age, $request->to_age])->where('opd_details.is_ipd_moved','0')->where('opd_visit_details.visit_type','Revisit')->where('opd_details.ins_by','=','sys')->where('opd_visit_details.department_id','=',$request->department_id)->where('opd_visit_details.appointment_date','like',$request->date.'%')->inRandomOrder()->limit($request->no_of_patient)->get();
                }
                else {
                    $patient_details = OpdDetails::select('opd_details.id as patient_source_id','opd_details.patient_id','opd_visit_details.unit')->leftjoin('opd_visit_details','opd_visit_details.opd_details_id','=','opd_details.id')->leftjoin('patients','patients.id','=','opd_details.patient_id')->whereBetween('patients.year', [$request->from_age, $request->to_age])->where('opd_details.ins_by','=','sys')->where('opd_details.is_ipd_moved','0')->where('opd_visit_details.visit_type','New Visit')->where('opd_visit_details.department_id','=',$request->department_id)->where('opd_visit_details.appointment_date','like',$request->date.'%')->inRandomOrder()->limit($request->no_of_patient)->get();
                }
            }
            else{
                $patient_details = EmgDetails::select('emg_details.id as patient_source_id','emg_details.patient_id','patients.local_guardian_name','patients.local_guardian_contact_no')->leftjoin('emg_patient_details','emg_patient_details.emg_details_id','=','emg_details.id')->leftjoin('patients','patients.id','=','emg_details.patient_id')->whereBetween('patients.year', [$request->from_age, $request->to_age])->where('emg_details.ins_by','=','sys')->where('emg_details.is_ipd_moved','0')->where('emg_patient_details.appointment_date','like',$request->date.'%')->inRandomOrder()->limit($request->no_of_patient)->get(); 
            }

            if( @$patient_details[0]->patient_source_id == null){
                return response()->json(['message' => 'You have not Enough Patient']);
            }

            $ipd_prefix = Prefix::where('name', 'ipd')->first();
            foreach ($patient_details as $value) {
                try {
                    DB::beginTransaction();
                $admission_date = $request->date. ' ' . sprintf("%02d", rand(8, 13)) . ':' . sprintf("%02d", rand(00, 59)) . ':' . sprintf("%02d", rand(00, 59));

                $doctor = User::where('department',$request->department_id)->where('role','Doctor')->inRandomOrder()->first();

                $bed = Bed::where('department_id',$request->department_id)->where('is_used','no')->where('is_active','1')->inRandomOrder()->first();

                if($bed == null){
                    return response()->json(['message' => 'You have not Enough bed']);
                }

                //SAVE in CASE reference
                $caseReference = new CaseReference;
                $caseReference->patient_id = $value->patient_id;
                $caseReference->section = 'IPD';
                $caseReference->save();
                //SAVE in CASE reference

                //SAVE in ipd details
                $ipd_details = new IpdDetails();
                $ipd_details->patient_source_id           = $value->patient_source_id;
                $ipd_details->admitted_by                 = $value->local_guardian_name;
                $ipd_details->admitted_by_contact_no      = $value->local_guardian_contact_no;
                $ipd_details->ipd_prefix                  = $ipd_prefix->prefix;
                $ipd_details->patient_id                  = $value->patient_id;
                $ipd_details->patient_source              = $request->from;
                $ipd_details->case_id                     = $caseReference->id;
                $ipd_details->appointment_date            = $admission_date;
                $ipd_details->credit_limit                = '0';
                $ipd_details->patient_type                = 'General';
                $ipd_details->note                        = 'Nothing....';
                $ipd_details->cons_doctor                 = $doctor->id;
                $ipd_details->department_id               = $request->department_id;
                $ipd_details->bed                         = $bed->id;
                $ipd_details->bed_ward_id                 = $bed->bedWard_id;
                $ipd_details->bed_unit_id                 = $bed->bedUnit_id;
                $ipd_details->ins_by                      = 'sys';
                $ipd_details->generated_by                = Auth::user()->id;
                $ipd_details->save();

                $caseReferenceupdate = caseReference::find($caseReference->id);
                $caseReference->section_id = $ipd_details->id;
                $caseReference->save();


                if ($request->from == 'OPD') {
                $opd_update = OpdDetails::find($value->patient_source_id);
                $opd_update->is_ipd_moved = '1';
                $opd_update->save();
                }else{
                $emg_update = EmgDetails::find($value->patient_source_id);
                $emg_update->is_ipd_moved = '1';
                $emg_update->save();
                }

                //bed status update in bed table
                Bed::where('id', $bed->id)->update(['is_used' => 'yes']);
                //bed status update in bed table

                //bed history update in bed table
                $patient_bed_history = new PatientBedHistory();
                $patient_bed_history->patient_id = $value->patient_id;
                $patient_bed_history->case_id = $caseReference->id;
                $patient_bed_history->ipd_id = $ipd_details->id;
                $patient_bed_history->department_id = $request->department_id;
                $patient_bed_history->bed_ward_id = $bed->bedWard_id;
                $patient_bed_history->bed_unit_id = $bed->bedUnit_id;
                $patient_bed_history->bed_id = $bed->id;
                $patient_bed_history->from_date =  $admission_date;
                $patient_bed_history->save();
                //bed history update in bed table
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
            }
            }
            DB::commit();
            return response()->json(['message' => 'Registation SuccessFully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Error!! Do it Again']);
        }
    }

    public function false_pathology_test_add_ipd(Request $request)
    {
        try {
            DB::beginTransaction();
        $ipd_patient_details = IpdDetails::where('ipd_details.department_id', '=', $request->pathology_department_id)->where('ipd_details.ins_by', 'sys')->where('ipd_details.discharged', 'no')->limit($request->no_of_patient_for_pathology_test)->get();

        if (@$ipd_patient_details[0]->id == null) {
            return response()->json(['message' => 'You dont have enough patient']);
        }

        if (@$ipd_patient_details[0]->id != null) {
            foreach ($ipd_patient_details as $value) {
                $pathology_test_details = PathologyTest::select('pathology_tests.id')->where('catagory_id', $request->pathology_category)->inRandomOrder()->first();
                $pathology_patient_test = new PathologyPatientTest();
                $pathology_patient_test->case_id = $value->case_id;
                $pathology_patient_test->date = $request->pathology_date;
                $pathology_patient_test->section = 'IPD';
                $pathology_patient_test->patient_id = $value->patient_id;
                $pathology_patient_test->test_id = $pathology_test_details->id;
                $pathology_patient_test->ipd_id = $value->id;
                $pathology_patient_test->generated_by = Auth::user()->id;
                $pathology_patient_test->billing_status = '1';
                $pathology_patient_test->test_status = '3';
                $pathology_patient_test->ins_by = 'sys';
                $pathology_patient_test->save();
            }
        }

        DB::commit();
        return response()->json(['message' => 'Pathology Investigation added SuccessFully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Error!! Do it Again']);
        }
    }
    public function false_radiology_test_add_ipd(Request $request)
    {
        try {
            DB::beginTransaction();
            $ipd_patient_details = IpdDetails::select('ipd_details.id as ipd_id', 'ipd_details.case_id', 'ipd_details.patient_id')->where('ipd_details.department_id', '=', $request->radiology_department_id)->where('ipd_details.ins_by', 'sys')->where('ipd_details.discharged', 'no')->limit($request->no_of_patient_for_radiology_test)->get();
            if (@$ipd_patient_details[0]->ipd_id == null) {
                return response()->json(['message' => 'You dont have enough patient']);
            }

            if (@$ipd_patient_details[0]->ipd_id != null) {
                foreach ($ipd_patient_details as $value) {
                    $radiology_test_details = RadiologyTest::select('radiology_tests.id')->where('catagory_id', $request->radiology_category)->inRandomOrder()->first();
                    $radiology_patient_test = new RadiologyPatientTest();
                    $radiology_patient_test->case_id = $value->case_id;
                    $radiology_patient_test->date = $request->radiology_date;
                    $radiology_patient_test->section = 'IPD';
                    $radiology_patient_test->patient_id = $value->patient_id;
                    $radiology_patient_test->ipd_id = $value->ipd_id;
                    $radiology_patient_test->test_id = $radiology_test_details->id;
                    $radiology_patient_test->generated_by = Auth::user()->id;
                    $radiology_patient_test->billing_status = '1';
                    $radiology_patient_test->test_status = '3';
                    $radiology_patient_test->ins_by = 'sys';
                    $radiology_patient_test->save();
                }
            }
            DB::commit();
            return response()->json(['message' => 'Radiology Investigation added SuccessFully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Error!! Do it Again']);
        }
    }

    public function false_pathology_test_show_in_modal(Request $request)
    {

        $radiology_test_deatils =  RadiologyPatientTest::select('radiology_tests.test_name', 'radiology_patient_tests.id as radiology_patient_tests_id')->leftjoin('radiology_tests', 'radiology_tests.id', '=', 'radiology_patient_tests.test_id')->where('case_id', $request->caseId)->get();
        // dd($radiology_test_deatils);

        $pathology_test_deatils =  PathologyPatientTest::select('pathology_tests.test_name', 'pathology_patient_tests.id as pathology_patient_tests_id')->leftjoin('pathology_tests', 'pathology_tests.id', '=', 'pathology_patient_tests.test_id')->where('case_id', $request->caseId)->get();

        return response()->json(['radiology_test_deatils' => $radiology_test_deatils, 'pathology_test_deatils' => $pathology_test_deatils]);
    }

    public function delete_radiology_test_false($id)
    {
        RadiologyPatientTest::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Test Deleted Successfully');
    }
    public function delete_pathology_test_false($id)
    {
        PathologyPatientTest::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Test Deleted Successfully');
    }
    public function add_discharged_false(Request $request)
    {
        try {
            DB::beginTransaction();

            //SAVE in ipd details
            $ipd_details = new DischargedPatient();
            $ipd_details->ipd_id                      = $request->ipd_id;
            $ipd_details->case_id                     = $request->case_id;
            $ipd_details->patient_id                  = $request->patient_id;
            $ipd_details->discharge_date              = $request->discharged_date;
            $ipd_details->discharge_status            = $request->discharge_status;
            $ipd_details->icd_code                    = $request->icd_code;
            $ipd_details->note                        = '...';
            $ipd_details->operation                   = '';
            $ipd_details->diagnosis                   = '';
            $ipd_details->investigation               = '';
            $ipd_details->treatment_home              = '';
            $ipd_details->ins_by                      = 'sys';
            $status =  $ipd_details->save();
            //SAVE in ipd details

            IpdDetails::where('id', $request->ipd_id)->update(['discharged' => 'yes', 'discharged_date' => $request->discharge_date]);

            PatientBedHistory::where('ipd_id', $request->ipd_id)->update(['is_present' => 'no', 'to_date' => $request->discharge_date]);
            Bed::where('id',$request->bed)->update(['is_used'=>'no']);
            DB::commit();
            return response()->json(['message' => 'Patient Discharged SuccessFully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Error!! Do it Again']);
        }

    }
}
