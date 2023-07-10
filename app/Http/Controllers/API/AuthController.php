<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        try {

            $validate =  Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required|',

            ]);

            if ($validate->fails()) {
                $errors = $validate->errors();

                return response([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $errors
                ]);
            } else {
                $data = User::where('phone_no', $request->phone)->first();
                // dd($data);
                $data['profile_image'] = config('app.url') . '/' . 'public/profile_picture/' . $data['profile_image'];


                return response([
                    'userInfo' => $data,
                    'token' => $data->createToken("API TOKEN")->plainTextToken
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


    public function loginUserDetais(Request $request)
    {

        $data = User::where('id', $request->user_id)->first();
        $data['profile_image'] = config('app.url') . '/' . 'public/profile_picture/' . $data['profile_image'];

        $role_details = DB::table('roles')->where('name', $data->role)->first();

        $permissions = DB::table('permissions')
            ->select('permissions.name', DB::raw('CASE WHEN role_has_permissions.permission_id IS NOT NULL THEN TRUE ELSE FALSE END AS has_permission'))
            ->leftJoin('role_has_permissions', function ($join) use ($role_details) {
                $join->on('permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where('role_has_permissions.role_id', '=', $role_details->id);
            })
            ->get();

        $newArray = [];
        $newArray2 = [];

        foreach ($permissions as $item) {

            array_push($newArray, $item->name);
        }

        foreach ($permissions as $item) {
            if($role_details->id == 1){
                array_push($newArray2, 1);
            }
            else{
                array_push($newArray2, $item->has_permission);
            }
          
        }

        $all_permission = array_combine($newArray, $newArray2);

// dd($all_permission);

        return response()->json(['all_permission' => $all_permission, 'user_details' => $data]);
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