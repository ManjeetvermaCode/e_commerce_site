<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use App\Models\UserRole;

use Illuminate\Http\Request;
use DB;

class userRoleController extends Controller
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
        $users=User::all();

        $usersWithRoles = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('role_user.id as role_userId','users.name','users.id', 'roles.role_name', 'role_user.role_id')
            ->orderBy('users.name')
            ->get()->toArray();

        return view('admin.UserRole.assignUserRole',compact('roles','users','usersWithRoles'));
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
            'user' => 'required',
            'role' => 'required',
        ]);
        $role_id=$request->role;
        $user_id=$request->user;
        $record=UserRole::getRoles($user_id);

        if(in_array($role_id,$record)){
            return to_route('user-role.create')->with(['type'=>'danger','message'=>"Role is already assigned to user."]);
        }
        $status=UserRole::create(['role_id'=>$role_id,'user_id'=>$user_id]);
        if($status){
            return to_route('user-role.create')->with(['type'=>'success','message'=>"Role Assigned to user success."]);
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
        $userWithRole = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('role_user.id as role_userId','users.name','users.id', 'roles.role_name', 'role_user.role_id')
            ->orderBy('users.name')
            ->where('role_user.id',$id)
            ->get()->toArray()[0];

        $roles=role::all();
        $users=User::all();
        if($userWithRole){
            return  view('admin.UserRole.assignUserRole',compact('userWithRole','roles','users'));
        }
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
        $user_role=UserRole::find($id);

        $record=UserRole::getRoles($input['user']);
        if(in_array($input['role'],$record)){
            return to_route('user-role.create')->with(['type'=>'danger','message'=>"Role is already assigned to user."]);
        }

        $status=$user_role->update(['user_id'=>$input['user'],'role_id'=>$input['role']]);
        if($status){
            return to_route('user-role.create')->with(['type'=>'success','message'=>"Role updated success."]);
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
        $result=UserRole::find($id);
        $status=$result->delete();
        if($status){
            return to_route('user-role.create')->with(['type'=>'success','message'=>"User Role deleted successfully"] );
        }

    }
}
