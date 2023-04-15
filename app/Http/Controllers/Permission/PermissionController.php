<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $perms = Permission::paginate(50);
        return view('permission.permissionList', compact('perms'));
    }
    
    public function addPermission(Request $request)
    {
        $validator = $request->validate([
            'permission'=>'required|unique:permissions,name,{{$request->permission}}',
        ]);

        $permission = Permission::create(['name' => $request->permission]);

        if($permission){
            return back()->with('success',"Permission created Sucessfully")  ;
        }else{
            return back()->with('error' ,"Something Went Wrong");
        }
    }
    
    public function editPermission($id)
    {
        $id =base64_decode($id);
        $permission = Permission::find($id);
        $perms = Permission::all();
        return view('permission.editPermission', compact('perms','permission'));
    }
    
    public function deletePermission(Request $request)
    {
        $permission = Permission::find($request->permId);
        $permission->delete();
        return redirect()->route('PermissionList')->with('success','Permission Removed Successfully');
    }

    public function editPermissionAction(Request $request)
    {
        $validator = $request->validate([
            'permission'=>'required',
        ]);

        $role = Permission::find($request->id);
        $role->name = $request->permission;
        $role->save();

        return redirect()->route('PermissionList')->with('success','Permission Updated Successfully');
    }

    public function PermissionAsign($role)
    {
        $role = base64_decode($role);
        $PermissionOfRole = Role::findByName($role)->permissions;
        $all_permission =  Permission::all();
        return view('permission.asignPermission', compact('role','PermissionOfRole','all_permission'));
    }

    public function asignPermission(Request $request)
    {
        $role = Role::findByName($request->role);
        $result = $role->hasPermissionTo($request->permission);
        if ($result != 1) {
            $role->givePermissionTo($request->permission);
            return 1;
        }else{
            $role->revokePermissionTo($request->permission);
            return 0;
        }
    }

    public function userPermissionAsignList()
    {   
        $userList = array('user','admin');
        $allUsers = User::role($userList)->orderBy('id','desc')->get();
        return view('permission.userPermissionAsignList', compact('allUsers'));
    }

    public function PermissionAsignToUser($user)
    {
        $user = base64_decode($user);
        $userInfo = User::find($user);

        $PermissionOfUser = $userInfo->getAllPermissions();
        $all_permission =  Permission::all();
        return view('permission.asignPermissionToUser', compact('userInfo','PermissionOfUser','all_permission'));
    }

    public function PermissionAsignToUserAction(Request $request)
    {
        $permissionId = $request->permission;
        $userInfo = User::find($request->Id);
        $result = $userInfo->hasPermissionTo(Permission::find($permissionId)->id);

        if ($result != 1) {
            $userInfo->givePermissionTo(Permission::find($permissionId)->name);
            return 1;
        }else{
            $userInfo->revokePermissionTo(Permission::find($permissionId)->name);
            return 0;
        }

    }
    
}
