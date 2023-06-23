<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('password', $request->password)->first();

        if (!$user) {
        } else {
            $user->fcm_token = $request->fcm_token;
            $user->save();
        }


        // Return the newly created user data as JSON response
        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'photo' => $user->photo,
            
        ]);
    }
}
