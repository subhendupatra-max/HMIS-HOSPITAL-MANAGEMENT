<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
  
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'max:255'],
            'role' => ['required', 'integer'],
            'metrial_status' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'integer'],
            'highest_qualification' => ['required', 'longtext'],
            'address' => ['required', 'longtext'],
        ]);

        if($request->hasfile('profile_image'))
        {
            $file = $request->file('profile_image');
            $filename = rand().'.'.$file->getClientOriginalExtension();
            $file->move("public/profile_picture/",$filename);
        }
        else
        {
            $filename = "no-image-available.png";
        }

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'metrial_status' => $request->metrial_status,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'age' => $request->age,
                'phone_no' => $request->phone_no,
                'emg_phone_no' => $request->emg_phone_no,
                'highest_qualification' => $request->highest_qualification,
                'address' => $request->address,
                'role_as' =>$request->role,
                'profile_image'=> $filename,

        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
