<?php

namespace App\Http\Controllers;
use App\Models\permission;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_permissions=permission::all();
        return view('admin.permission.listPermission',compact('all_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Permission.createPermission');
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
            'permission_name' => 'required|string|max:255|unique:permissions,permission_name',
            'permission_slug' => 'required|string|max:255|unique:permissions,permission_slug',
        ]);
        $status=permission::create([
            "permission_name"=>$request->permission_name,
            "permission_slug"=>$request->permission_slug
        ]);
        return redirect()->route('permissions.index')->with(['type'=>'success','message'=>'Permission created successfully.']);
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
        $permission=Permission::find($id);
        return view('admin.permission.createPermission',compact('permission'));
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
        $permission=Permission::find($id);
        $permission->update(['permission_name'=>$request->permission_name]);
        return redirect()->route('permissions.index')->with(['type'=>'success','message'=>'Permission name Updated successfully.']);
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
        $permission=Permission::find($id);
        $status=$permission->delete();
        if($status){
            return redirect()->back()->with(['type'=>'success','message'=>'Permission deleted successfully.']);
        }
    }
}
