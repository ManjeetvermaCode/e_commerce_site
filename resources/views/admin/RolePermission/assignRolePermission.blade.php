@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
          <x-alert-message type="{{session('type')}}" message="{{session('message')}}"></x-alert-message>
            <div class="card">
                <div class="card-header">{{isset($rolePermission) ? 'Update' : 'Create'}} role-permission</div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($rolePermission) ? route('role-permission.update',encrypt($rolePermission->permissionRoleId)) : route('role-permission.store')}}">
                        @csrf
                        @if (isset($rolePermission))
                            @method('patch')
                        @endif
                        <div class="form-group mb-2">
                          <label for="role">Roles</label>
                          <select class="form-select" name="role" id="role">
                            <option value="">select</option>
                            @foreach ($roles as $role)
                                <option {{isset($rolePermission->role_id) && $rolePermission->role_id == $role['id'] ? 'selected' : ''}} value="{{$role['id']}}">{{$role['role_name']}}</option>
                            @endforeach
                          </select>
                          @error('role')
                            <div class="error">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="permission">Permissions</label>
                          <select name="permission" id="permission" class="form-select">
                            <option value="">select</option>
                            @foreach ($permissions as $permission)
                                <option {{isset($rolePermission->role_id) && $rolePermission->id == $permission['id'] ? 'selected' : ''}} value="{{$permission['id']}}">{{$permission['permission_name']}}</option>
                            @endforeach
                          </select>
                          @error('permission')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-success mt-2" type="submit"> {{isset($rolePermission) ? 'Update' : 'Submit'}}</button>
                    </form>
                </div>
            </div>
            {{-- {{dd($rolesWithPermissions)}} --}}
            @if (isset($rolesWithPermissions))
              <div class="card-body mt-3">
                <div class="card">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Permission Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (isset($rolesWithPermissions) && $rolesWithPermissions != [])
                          @foreach ($rolesWithPermissions as $key=> $rolesWithPermission)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$rolesWithPermission->role_name}}</td>
                              <td>{{$rolesWithPermission->permission_name}}</td>
                              <td style="display: flex">
                                <form action="{{route('role-permission.edit',encrypt($rolesWithPermission->permissionRoleId))}}" method="get">
                                    @csrf
                                    <button class="btn btn-info" style="margin-right: 5px">Edit</button>
                                </form>
                                <form action="{{route('role-permission.update',encrypt($rolesWithPermission->permissionRoleId))}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            </tr>
                          @endforeach
                        @else
                            <tr>
                              <td colspan="4" style="text-align: center">No Records Found</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
            @endif
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#permission").select2();
        $("#role").select2();

        $(".btn-danger").on('click',function(){
                if (confirm("Are you sure ?") == true) {
                    $(this).closest('form').submit()
                }
        })
    });
  </script>
@endsection
