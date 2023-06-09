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
use App\Models\RadiologyCatagory;
use App\Models\PathologyCatagory;
use App\Models\PathologyTest;
use App\Models\PathologyPatientTest;
use App\Models\RadiologyTest;
use App\Models\RadiologyPatientTest;
use DB;
use Auth;

class OpdFalseController extends Controller
{
    public function index()
    {
        $departments = Department::where('is_active', '1')->get();
        return view('false.opd.index', compact('departments'));
    }
    public function false_opd_registation(Request $request)
    {
        $validate = $request->validate([
            'date'      => 'required',
            'department_id' => 'required',
        ]);
        $department_id = $request->department_id;
        $date = $request->date;
        $department_details = Department::where('is_active', '1')->where('id', $request->department_id)->first();
        $opd_registaion_list = OpdDetails::where('ins_by', 'sys')->where('created_at', 'like', '%' . $request->date . '%')->orderBy('id', 'desc')->get();
        $pathology_category = PathologyCatagory::get();
        $radiology_category = RadiologyCatagory::get();

        $todays_total_opd = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->count();
        $todays_new = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('visit_type', '=', 'New Visit')->count();
        $todays_revisit = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('visit_type', '=', 'Revisit')->count();
        $todays_total_for_this_department = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('department_id', '=', $department_id)->count();

        $todays_total_opd_sys = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'sys')->count();
        $todays_new_sys = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'sys')->where('visit_type', '=', 'New Visit')->count();
        $todays_revisit_sys = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('visit_type', '=', 'Revisit')->where('ins_by', '=', 'sys')->count();
        $todays_total_for_this_department_sys = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'sys')->where('department_id', '=', $department_id)->count();

        $todays_total_opd_ori = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'ori')->count();
        $todays_new_ori = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('visit_type', '=', 'New Visit')->where('ins_by', '=', 'ori')->count();
        $todays_revisit_ori = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('visit_type', '=', 'Revisit')->where('ins_by', '=', 'ori')->count();
        $todays_total_for_this_department_ori = OpdVisitDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'ori')->where('department_id', '=', $department_id)->count();

        $pathology_category = PathologyCatagory::get();
        $radiology_category = RadiologyCatagory::get();

        $pathology_test_original = PathologyPatientTest::where('date', 'like', $date . '%')->where('ins_by', 'ori')->count();

        if (@$department_details) {
            return view('false.opd.false_patient_list', compact('department_details', 'radiology_category', 'opd_registaion_list', 'date', 'department_id', 'pathology_category', 'radiology_category',     'todays_total_opd', 'todays_new', 'todays_revisit', 'todays_total_for_this_department', 'todays_total_opd_sys', 'todays_new_sys', 'todays_revisit_sys', 'todays_total_for_this_department_sys', 'todays_total_opd_ori', 'todays_new_ori', 'todays_revisit_ori', 'todays_total_for_this_department_ori', 'pathology_category'));
        } else {
            return redirect()->back()->with('success', 'Search Again !!!!');
        }
    }

    public function registation_false_opd(Request $request)
    {
        // try {
        //     DB::beginTransaction();
            $opd_prefix = Prefix::where('name', 'opd')->first();
            if ($request->visit_type == 'New Visit') {
                $patient_details = FalsePatient::whereBetween('year', [$request->from_age, $request->to_age])->where('last_update', '<=', now()->subDays(15))->limit($request->no_of_patient)->get();
            }
            if ($request->visit_type == 'Revisit') {
                $patient_details = Patient::whereBetween('year', [$request->from_age, $request->to_age])->where('created_at', '<=', now()->subDays(15))->where('ins_by', 'sys')->limit($request->no_of_patient)->get();
            }
            if (@$patient_details[0]->id == null) {
                return response()->json(['message' => 'You dont have enough patient']);
            }
            // dd($patient_details);

            foreach ($patient_details as $value) {
                if ($request->visit_type == 'New Visit') {
                    FalsePatient::where('id', $value->id)->update(['last_update' => $request->date]);
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
                } else {
                    $pati_id = $value->id;
                }

                //SAVE in CASE reference
                $caseReference = new caseReference;
                $caseReference->patient_id = $pati_id;
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
                $unit = OpdUnit::select('opd_unit_details.unit_name')->join('opd_unit_details', 'opd_unit_details.opd_unit_id', '=', 'opd_units.id')->where('opd_units.department_id', $request->department_id)->where('opd_units.department_id', $request->department_id)->where('opd_units.days', date('l', strtotime($request->date)))->inRandomOrder()->first();

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
                $opd_visit_details->appointment_date            = $request->date . ' ' . sprintf("%02d", rand(8, 13)) . ':' . sprintf("%02d", rand(00, 59)) . ':' . sprintf("%02d", rand(00, 59));
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
            return response()->json(['message' => 'Registation SuccessFully']);
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return response()->json(['message' => 'Error!! Do it Again']);
        // }
    }

    public function false_pathology_test_add_opd(Request $request)
    {
        try {
            DB::beginTransaction();
            $opd_patient_details = OpdDetails::select('opd_details.id as opd_id', 'opd_details.case_id', 'opd_details.patient_id')->leftjoin('opd_visit_details', 'opd_visit_details.opd_details_id', '=', 'opd_details.id')->where('opd_visit_details.department_id', '=', $request->pathology_department_id)->where('opd_visit_details.appointment_date', 'like', $request->pathology_date . '%')->limit($request->no_of_patient_for_pathology_test)->get();

            if (@$opd_patient_details[0]->opd_id == null) {
                return response()->json(['message' => 'You dont have enough patient']);
            }

            if (@$opd_patient_details[0]->opd_id != null) {

                foreach ($opd_patient_details as $value) {

                    $pathology_test_details = PathologyTest::select('pathology_tests.id')->where('catagory_id', $request->pathology_category)->inRandomOrder()->first();

                    $pathology_patient_test = new PathologyPatientTest();
                    $pathology_patient_test->case_id = $value->case_id;
                    $pathology_patient_test->date = $request->pathology_test_date;
                    $pathology_patient_test->section = 'OPD';
                    $pathology_patient_test->patient_id = $value->patient_id;
                    $pathology_patient_test->test_id = $pathology_test_details->id;
                    $pathology_patient_test->opd_id = $value->opd_id;
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
    public function false_radiology_test_add_opd(Request $request)
    {
        try {
            DB::beginTransaction();
            $opd_patient_details = OpdDetails::select('opd_details.id as opd_id', 'opd_details.case_id', 'opd_details.patient_id')->leftjoin('opd_visit_details', 'opd_visit_details.opd_details_id', '=', 'opd_details.id')->where('opd_visit_details.department_id', '=', $request->radiology_department_id)->where('opd_visit_details.appointment_date', 'like', $request->radiology_date . '%')->limit($request->no_of_patient_for_radiology_test)->get();
            if (@$opd_patient_details[0]->opd_id == null) {
                return response()->json(['message' => 'You dont have enough patient']);
            }

            if (@$opd_patient_details[0]->opd_id != null) {
                foreach ($opd_patient_details as $value) {
                    $radiology_test_details = RadiologyTest::select('radiology_tests.id')->where('catagory_id', $request->radiology_category)->inRandomOrder()->first();
                    $radiology_patient_test = new RadiologyPatientTest();
                    $radiology_patient_test->case_id = $value->case_id;
                    $radiology_patient_test->date = $request->radiology_date;
                    $radiology_patient_test->section = 'OPD';
                    $radiology_patient_test->patient_id = $value->patient_id;
                    $radiology_patient_test->opd_id = $value->opd_id;
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
}
