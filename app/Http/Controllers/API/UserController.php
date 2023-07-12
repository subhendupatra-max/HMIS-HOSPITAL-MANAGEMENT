<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Config;

class UserController extends Controller
{
    public function UserCreate()
    {
        $all_role = Role::all();
        $designation = Designation::get();
        $department = Department::where('is_active', '=', 1)->get();
        return response([
            'status' => true,
            'role' => $all_role,
            'designation' => $designation,
            'department' => $department,
            'blood_groups' => Config::get('static.blood_groups'),
            'contract_types' => Config::get('static.contract_types'),
            'gender' => Config::get('static.gender'),
            'marital_status' => Config::get('static.marital_status'),
        ], 200);
    }
    public function UserCreateAction()
    {
        try {
            $validate =  Validator::make($request->all(), [
                'employee_id' => 'required|unique:users',
                'role' => "required",
                'first_name' => "required",
                'last_name' => "required",
                'department' => "required",
                'designation' => "required",
                'gender' => "required|",
                'phone_no' => "required|unique:users",
                'email' => "required|unique:users",
            ]);

            if ($validate->fails()) {
                $errors = $validate->errors();
                return response([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $errors
                ]);
            } else {
                if ($request->profile_image != null) {

                    $file = $request->file('profile_image');
                    $filename = rand() . '.' . $file->getClientOriginalExtension();
                    $file->move("public/profile_picture/", $filename);
                } else {
                    $filename = "no-image-available.png";
                }
                //  dd($filename);
                $password = rand(10000000, 99999999);
                $user = User::create([
                    'employee_id' => $request->employee_id,
                    'password' => Hash::make($password),
                    'role' => $request->role,
                    'designation' => $request->designation,
                    'department' => $request->department,
                    'specialist' => $request->specialist,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'gender' => $request->gender,
                    'marital_status' => $request->marital_status,
                    'blood_group' => $request->blood_group,
                    'date_of_birth' => $request->date_of_birth,
                    'date_of_joining' => \Carbon\Carbon::parse($request->date_of_joining)->format('Y-m-d'),
                    'phone_no' => $request->phone_no,
                    'whatsapp_no' => $request->whatsapp_no,
                    'emg_phone_no' => $request->emg_phone_no,
                    'email' => $request->email,
                    'profile_image' => $filename,
                    'current_address' => $request->current_address,
                    'permanent_address' => $request->permanent_address,
                    'qualification' => $request->qualification,
                    'experience' => $request->experience,
                    'specialization' => $request->specialization,
                    'note' => $request->note,
                    'pan_number' => $request->pan_number,
                    'identification_number' => $request->identification_number,
                    'identification_name' => $request->identification_name,
                    'bank_account_no' => $request->bank_account_no,
                    'bank_name' => $request->bank_name,
                    'ifsc_code' => $request->ifsc_code,
                    'bank_branch_name' => $request->bank_branch_name,
                    'epf_no' => $request->epf_no,
                    'basic_salary' => $request->basic_salary,
                    'contract_type' => $request->contract_type,
                    'casual_leave' => $request->casual_leave,
                    'privilege_leave' => $request->privilege_leave,
                    'sick_leave' => $request->sick_leave,
                    'maternity_leave' => $request->maternity_leave,
                    'paternity_leave' => $request->paternity_leave,
                ]);
    
                $user->assignRole($request->role);
                /*=================================Mail function=========================*/
                $software_link = URL::to('/');
                $email_id = $request->email;
                $name = $request->first_name;
    
                Mail::send('mail.user-credential', ['name' => $name, 'software_link' => $software_link, 'email_id' => $email_id, 'password' => $password], function ($message) use ($email_id) {
                    $message->from('subhendu.dits@gmail.com');
                    $message->to($email_id);
                    $message->subject('User Generation');
                });
                DB::commit();

                return response([
                    'status' => true,
                    'message' => 'New User Created SuccessFully',
                ], 200);
            }
        } catch (\Throwable $th) {

            return response([
                'status' => false,
                'message' => 'Some Error !! try again',
                'errors' => $th->getMessage(),
            ]);
        }
    }
}
