<?php

namespace App\Http\Controllers;
use App\Models\role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_roles=role::all();
        return view('admin.role.listRole',compact('all_roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.createRole');
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
            'role_name' => 'required|unique:roles,role_name',
            'role_slug' => 'required|unique:roles,role_slug',
        ]);
        $status=role::create([
            "role_name"=>$request->role_name,
            "role_slug"=>$request->role_slug
        ]);
        return redirect()->route('roles.index')->with(['type'=>'success','message'=>'Role created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd("in show");
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
        $role=Role::find($id);
        return view('admin.role.createRole',compact('role'));
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
        $role=Role::find($id);
        $role->update(['role_name'=>$request->role_name]);
        return redirect()->route('roles.index')->with(['type'=>'success','message'=>'Role name Updated successfully.']);
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
        $role=Role::find($id);
        $status=$role->delete();
        if($status){
            return redirect()->back()->with(['type'=>'success','message'=>'Role deleted successfully.']);
        }

    }
}
