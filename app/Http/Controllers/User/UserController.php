<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
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



class UserController extends Controller
{
    public function UserCreate(Request $request)
    {
        $all_role = Role::all();
        $department = Department::where('is_active', '=', 1)->get();

        return view('appPages.Users.userCreation', compact('all_role', 'department'));
    }

    public function userlist()
    {
        $all_user = User::where('is_delete', '0')->get();
        return view('appPages.Users.user-list', compact('all_user'));
    }

    public function UserCreateAction(Request $request)
    {


        // $general_details = DB::table('settings')->first();
        $request->validate([

            'employee_id' => 'required|unique:users',
            'role' => "required",
            'first_name' => "required",
            'last_name' => "required",
            'gender' => "required|",
            'date_of_birth' => "required",
            'email' => "required|unique:users",
            'current_address' => "required",
        ]);


        // try {

        //     DB::beginTransaction();

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
                'local_identification_number' => $request->local_identification_number,

            ]);

            $user->assignRole($request->role);
            DB::commit();

            /*=================================Mail function=========================*/
            $software_link = URL::to('/');
            $email_id = $request->email;
            $name = $request->first_name;

            Mail::send('mail.user-credential', ['name' => $name, 'software_link' => $software_link, 'email_id' => $email_id, 'password' => $password], function ($message) use ($email_id) {
                $message->from('subhendu.dits@gmail.com');
                $message->to($email_id);
                $message->subject('User Generation');
            });
            /*=======================================================================*/

            return redirect()->route('user-list')->with('success', 'User Created Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('UserCreate')->with('error', $th->getMessage());
        // }
    }

    public function userprofile($id)
    {
        $user_id = base64_decode($id);
        $login_details = User::where('id', $user_id)->first();
        return view('appPages.Users.user-details', compact('login_details'));
    }

    public function user_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = User::find($u_id);
            $user->is_delete = '1';
            $user->is_active = '0';
            $user->save();
            DB::commit();
            return redirect()->route('user-list')->with('success', 'User Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('user-list')->with('error', $th->getMessage());
        }
    }
    public function user_enable_disable($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = User::find($u_id);
            if ($user->is_active == '0') {
                $user->is_active = '1';
                $user->save();
                DB::commit();
                return redirect()->route('user-list')->with('success', 'User Enable Sucessfully');
            } else {
                $user->is_active = '0';
                $user->save();
                DB::commit();
                return redirect()->route('user-list')->with('error', 'User Disable Sucessfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('user-list')->with('error', $th->getMessage());
        }
    }

    public function change_password()
    {
        return view('appPages.Users.change-password');
    }
    public function save_change_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);
        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->new_password, $hashedPassword)) {
                if ($request->new_password == $request->confirm_password) {

                    $users = User::find(Auth::id());
                    $users->password = Hash::make($request->new_password);
                    $users->save();

                    session()->flash('success', 'Password updated successfully!');
                    return redirect('user-profile/' . base64_encode(Auth::id()));
                } else {
                    session()->flash('error', 'New password does not matched with Confirm password!');
                    return redirect()->back();
                }
            } else {
                session()->flash('error', 'New password can not be the old password!');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Old password does not matched! ');
            return redirect()->back();
        }
    }

    public function user_edit($id)
    {

        $u_id = base64_decode($id);
        $user_details = User::find($u_id);
        // dd( $user_details);
        $all_role = Role::all();
        $department = Department::where('is_active', '=', 1)->get();


        return view('appPages.Users.edit-user', compact('user_details', 'all_role', 'department'));
    }

    public function user_update(Request $request)
    {
       // dd($request->all());
        $request->validate([

            'employee_id' => Rule::unique('users')->ignore($request->id),
            'role' => "required|",
            'first_name' => "required|",
            'last_name' => "required",
            'gender' => "required|",
            'date_of_birth' => "required|",
            'email' => Rule::unique('users')->ignore($request->id),
            'current_address' => "required",

        ]);

        // try {

        //     DB::beginTransaction();

            if ($request->hasfile('profile_image')) {

                $file = $request->file('profile_image');
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $file->move("public/profile_picture/", $filename);
            } else {
                $filename = Auth::user()->profile_image;
            }
            $password = rand(10000000, 99999999);
            $user = User::find($request->id);
            $user->update([

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
                'date_of_joining' => $request->date_of_joining,
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
                'local_identification_number' => $request->local_identification_number,
            ]);
            // DB::commit();

        //     return redirect()->route('user-list')->with('success', 'User Updated Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }
}
