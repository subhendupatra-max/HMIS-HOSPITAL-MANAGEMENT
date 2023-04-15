<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        try {
            
            $validate =  Validator::make($request->all(),[
                'username'=>'required|email',
                'password'=>'required|',
    
            ]);
    
            if ($validate->fails()) {
                $errors = $validate->errors();

                return response([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $errors
                ]);

            }else{
                $data = User::where('email',$request->username)->first();
                $userInfo = [
                    'name'=> $data->name,
                    'email'=> $data->email
                ];
                return response([
                    'userInfo'=> $userInfo,
                    'token'=> $data->createToken("API TOKEN")->plainTextToken
                ], 200);
            }

        } catch (\Throwable $th) {

            return response([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $th->getMessage(),
                ]);

        }

    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->tokens()->delete();
        return response([
            'status' => true,
            'message' => 'User Logout',
        ]);
    }
}
