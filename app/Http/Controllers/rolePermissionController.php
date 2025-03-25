<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\permission;
use App\Models\role;
use App\Models\RolePermission;

use DB;


class rolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=role::all();
        $permissions=permission::all();

        $rolesWithPermissions = DB::table('permissions')
        ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
        ->join('roles', 'roles.id', '=', 'permission_role.role_id')
        ->select('permission_role.id as permissionRoleId','permissions.permission_name','permissions.id', 'roles.role_name', 'permission_role.role_id')
        ->orderBy('permissions.permission_name')
        ->get()->toArray();

        return view('admin.RolePermission.assignRolePermission',compact('roles','permissions','rolesWithPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'permission' => 'required',
            'role' => 'required',
        ]);
        
        $role_id=$request->role;
        $permissions_id=$request->permission;
        $record=RolePermission::getPermissions($role_id);

        if(in_array($permissions_id,$record)){
            return to_route('role-permission.create')->with(['type'=>'danger','message'=>"Permission is already assigned to Role."]);
        }
        $status=RolePermission::create(['role_id'=>$role_id,'permission_id'=>$permissions_id]);
        if($status){
            return to_route('role-permission.create')->with(['type'=>'success','message'=>"Permission Assigned to Role successfully."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=decrypt($id);
        
        $roles=role::all();
        $permissions=permission::all();

        $rolePermission = DB::table('permissions')
        ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
        ->join('roles', 'roles.id', '=', 'permission_role.role_id')
        ->select('permission_role.id as permissionRoleId','permissions.permission_name','permissions.id', 'roles.role_name', 'permission_role.role_id')
        ->orderBy('permissions.permission_name')
        ->where('permission_role.id',$id)
        ->get()->toArray()[0];

        return view('admin.RolePermission.assignRolePermission',compact('roles','permissions','rolePermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id=decrypt($id);
        $input=$request->all();
        $role_permission=RolePermission::find($id);

        $record=RolePermission::getPermissions($role_permission['role_id']);
        if(in_array($input['permission'],$record)){
            return to_route('role-permission.edit',encrypt($role_permission['id']))->with(['type'=>'danger','message'=>"Permission is already assigned to Role."]);
        }
        $status=$role_permission->update(['permission_id'=>$input['permission'],'role_id'=>$input['role']]);
        if($status){
            return to_route('role-permission.create')->with(['type'=>'success','message'=>"Role updated success."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=decrypt($id);
        $result=RolePermission::find($id);
        $status=$result->delete();
        if($status){
            return to_route('role-permission.create')->with(['type'=>'success','message'=>"Role Permission deleted successfully"]);
        }

    }
}
