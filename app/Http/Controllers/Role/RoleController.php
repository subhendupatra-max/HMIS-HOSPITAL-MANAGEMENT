<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index($id=null)
    {

        // $allRole = Role::whereNotIn('name', ['Admin'])->get();
        $allRole = Role::all();
        return view('role.roleList', compact('allRole'));
        
    }
    
    public function addRole(Request $request)
    {
        $validator = $request->validate([
            'role'=>'required|unique:roles,name,{{$request->role}}',
        ]);

        $role = Role::create(['name' => $request->role]);

        if($role){
            return back()->with('success',"Role created Sucessfully")  ;
        }else{
            return back()->with('error' ,"Something Went Wrong");
        }
    }
    
    public function editRole($id)
    {
        $id = base64_decode($id);
        $role = Role::find($id);
        // $allRole = Role::whereNotIn('name', ['Admin'])->get();
        $allRole = Role::all();
        return view('role.editRole', compact('allRole', 'role'));
    }
    public function editRoleAction(Request $request)
    {
        $validator = $request->validate([
            'role'=>'required|unique:roles,name,{{$request->role}}',
        ]);

        $role = Role::find($request->roleId);
        $role->name = $request->role;
        $role->save();

        return redirect()->route('roleList')->with('success','Role Updated Successfully');
    }
    
    public function deleteRole(Request $request)
    {

        $permission = Role::findById($request->roleId)->permissions;
        $role = Role::findById($request->roleId);
        $role->revokePermissionTo($permission);
        $role->delete();

        return redirect()->route('roleList')->with('success','Role Removed Successfully');
    }

    public function asignRole()
    {
        $userDosentHaveRole = User::doesntHave('roles')->get();
        $userHaveRole = User::role(Role::all())->get();
        $allRole = Role::all();
        return view('role.asignRole',compact('userDosentHaveRole','userHaveRole', 'allRole'));
    }

    public function asignRoleAction(Request $request)
    {
        $validator = $request->validate([
            'user' => 'required',
            'role' => 'required'
        ]);

        $user = User::find($request->user);
        $response =  $user->assignRole($request->role);

        if ($response) {
            return redirect()->route('asignRole')->with('success','Role Asigned Sucessfully');
        }else{
            return redirect()->route('asignRole')->with('error','Something Went Wrong');
        }
    }

    public function revokeRoleAction(Request $request)
    {
        $validator = $request->validate([
            "revoke_role_user"=>"required",
            "hiddenRole" => "required"
        ]);

        $user = User::find($request->revoke_role_user);
        $response = $user->removeRole($request->hiddenRole);
        
        if ($response) {
            return redirect()->route('asignRole')->with('success','Role Revoked Sucessfully');
        }else{
            return redirect()->route('asignRole')->with('error','Something Went Wrong');
        }
    }

    public function getRole(Request $request)
    {
        $user = User::find($request->userId);
        $roles = $user->getRoleNames();
        return $roles;
    }
}
