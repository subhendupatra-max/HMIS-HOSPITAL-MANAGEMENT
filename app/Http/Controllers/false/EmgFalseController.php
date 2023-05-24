<?php

namespace App\Http\Controllers\false;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\FalsePatient;
use App\Models\Prefix;
use App\Models\Patient;
use App\Models\caseReference;
use App\Models\EmgDetails;
use App\Models\User;
use App\Models\EmgPatientDetails;
use App\Models\OpdUnit;
use App\Models\RadiologyCatagory;
use App\Models\PathologyCatagory;
use App\Models\PathologyTest;
use App\Models\PathologyPatientTest;
use App\Models\RadiologyTest;
use App\Models\RadiologyPatientTest;
use DB;
use Auth;

class EmgFalseController extends Controller
{
    public function index()
    {
        return view('false.emg.index');
    }
    public function false_emg_registation(Request $request)
    {
        $validate = $request->validate([
            'date'      => 'required',
        ]);

        $date = $request->date;
       
        $emg_registaion_list = EmgDetails::where('ins_by', 'sys')->where('created_at', 'like', '%' . $request->date . '%')->orderBy('id', 'desc')->get();
        $pathology_category = PathologyCatagory::get();
        $radiology_category = RadiologyCatagory::get();

        $todays_total_emg = EmgPatientDetails::where('appointment_date', 'like', $date . '%')->count();

        $todays_total_emg_sys = EmgPatientDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'sys')->count();
        $todays_total_emg_ori = EmgPatientDetails::where('appointment_date', 'like', $date . '%')->where('ins_by', '=', 'ori')->count();

        $pathology_test_original = PathologyPatientTest::where('date', 'like', $date . '%')->where('ins_by', 'ori')->count();
        $doctor = User::where('role', '=', 'Doctor')->get();

        if (@$date) {
            return view('false.emg.false_patient_list', compact('radiology_category', 'emg_registaion_list', 'date',  'pathology_category', 'todays_total_emg',  'todays_total_emg_sys', 'todays_total_emg_ori',  'pathology_category', 'doctor'));
        } else {
            return redirect()->back()->with('success', 'Search Again !!!!');
        }
    }

    public function false_pathology_test_show_in_modal(Request $request)
    {

        $radiology_test_deatils =  RadiologyPatientTest::select('radiology_tests.test_name', 'radiology_patient_tests.id as radiology_patient_tests_id')->leftjoin('radiology_tests', 'radiology_tests.id', '=', 'radiology_patient_tests.test_id')->where('case_id', $request->caseId)->get();
        // dd($radiology_test_deatils);

        $pathology_test_deatils =  PathologyPatientTest::select('pathology_tests.test_name', 'pathology_patient_tests.id as pathology_patient_tests_id')->leftjoin('pathology_tests', 'pathology_tests.id', '=', 'pathology_patient_tests.test_id')->where('case_id', $request->caseId)->get();

        return response()->json(['radiology_test_deatils' => $radiology_test_deatils, 'pathology_test_deatils' => $pathology_test_deatils]);
    }

    public function false_pathology_test_add_emg(Request $request)
    {
        try {
            DB::beginTransaction();
            $emg_patient_details = EmgDetails::select('emg_details.id as emg_id', 'emg_details.case_id', 'emg_details.patient_id')->leftjoin('emg_patient_details', 'emg_patient_details.emg_details_id', '=', 'emg_details.id')->where('emg_patient_details.appointment_date', 'like', $request->pathology_date . '%')->limit($request->no_of_patient_for_pathology_test)->get();

            if (@$emg_patient_details[0]->emg_id == null) {
                return response()->json(['message' => 'You dont have enough patient']);
            }

            if (@$emg_patient_details[0]->emg_id != null) {

                foreach ($emg_patient_details as $value) {

                    $pathology_test_details = PathologyTest::select('pathology_tests.id')->where('catagory_id', $request->pathology_category)->inRandomOrder()->first();

                    $pathology_patient_test = new PathologyPatientTest();
                    $pathology_patient_test->case_id = $value->case_id;
                    $pathology_patient_test->date = $request->pathology_date;
                    $pathology_patient_test->section = 'EMG';
                    $pathology_patient_test->patient_id = $value->patient_id;
                    $pathology_patient_test->test_id = $pathology_test_details->id;
                    $pathology_patient_test->emg_id = $value->emg_id;
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

    public function false_radiology_test_add_emg(Request $request)
    {
        try {
            DB::beginTransaction();
            $emg_patient_details = EmgDetails::select('emg_details.id as emg_id', 'emg_details.case_id', 'emg_details.patient_id')->leftjoin('emg_patient_details', 'emg_patient_details.emg_details_id', '=', 'emg_details.id')->where('emg_patient_details.appointment_date', 'like', $request->radiology_date . '%')->limit($request->no_of_patient_for_radiology_test)->get();
            if (@$emg_patient_details[0]->emg_id == null) {
                return response()->json(['message' => 'You dont have enough patient']);
            }

            if (@$emg_patient_details[0]->emg_id != null) {
                foreach ($emg_patient_details as $value) {
                    $radiology_test_details = RadiologyTest::select('radiology_tests.id')->where('catagory_id', $request->radiology_category)->inRandomOrder()->first();
                    $radiology_patient_test = new RadiologyPatientTest();
                    $radiology_patient_test->case_id = $value->case_id;
                    $radiology_patient_test->date = $request->radiology_date;
                    $radiology_patient_test->section = 'EMG';
                    $radiology_patient_test->patient_id = $value->patient_id;
                    $radiology_patient_test->emg_id = $value->emg_id;
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

    public function registation_false_emg(Request $request)
    {
        try {
            DB::beginTransaction();
        $emg_prefix = Prefix::where('name', 'emg')->first();
      
        $patient_details = FalsePatient::whereBetween('year', [$request->from_age, $request->to_age])->where('last_update', '<=', now()->subDays(5))->limit($request->no_of_patient)->get();
  
        if (@$patient_details[0]->id == null) {
            return response()->json(['message' => 'You dont have enough patient']);
        }
        

        foreach ($patient_details as $value) {
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
          

            //SAVE in CASE reference
            $caseReference = new caseReference;
            $caseReference->patient_id = $pati_id;
            $caseReference->section = 'EMG';
            $caseReference->ins_by = 'sys';
            $caseReference->save();
            //SAVE in CASE reference

            //SAVE in opd details
            $Emg_details = new EMGDetails;
            $Emg_details->case_id        = $caseReference->id;
            $Emg_details->patient_id     = $pati_id;
            $Emg_details->emg_prefix     = $emg_prefix->prefix;
            $Emg_details->generate_by    = Auth::user()->id;
            $Emg_details->ins_by = 'sys';
            $Emg_details->save();
            //SAVE in opd details

            $caseReferenceUpdate = caseReference::find($caseReference->id);
            $caseReferenceUpdate->section_id = $Emg_details->id;
            $caseReferenceUpdate->save();
            //SAVE in CASE reference

            //SAVE in opd Visit details
            $emg_visit_details = new EmgPatientDetails();
            $emg_visit_details->emg_details_id              = $Emg_details->id;
            $emg_visit_details->department_id               = 3;
            $emg_visit_details->cons_doctor                 = 1;
            $emg_visit_details->case_type                   = '';
            $emg_visit_details->patient_type                = 'General';
            $emg_visit_details->ticket_fees                 = 00;
            $emg_visit_details->medico_legal_case           = 'no';
            $emg_visit_details->tpa_organization            = '';
            $emg_visit_details->type_no                     = '';
            $emg_visit_details->appointment_date            = $request->date . ' ' . sprintf("%02d", rand(8, 13)) . ':' . sprintf("%02d", rand(00, 59)) . ':' . sprintf("%02d", rand(00, 59));
            $emg_visit_details->symptoms_type               = '';
            $emg_visit_details->symptoms                    = '';
            $emg_visit_details->symptoms_description        = '';
            $emg_visit_details->known_allergies             = '';
            $emg_visit_details->note                        = '';
            $emg_visit_details->refference                  = '';
            $emg_visit_details->generated_by                = Auth::user()->id;
            $emg_visit_details->ins_by                      = 'sys';
            $emg_visit_details->save();
            //SAVE in opd Visit details
         
        }
        DB::commit();
        return response()->json(['message' => 'Registation SuccessFully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Error!! Do it Again']);
        }
    }

    public function delete_radiology_test_false_emg($id)
    {
        RadiologyPatientTest::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Test Deleted Successfully');
    }
    public function delete_pathology_test_false_emg($id)
    {
        PathologyPatientTest::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Test Deleted Successfully');
    }
}
