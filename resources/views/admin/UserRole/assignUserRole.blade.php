@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
          <x-alert-message type="{{session('type')}}" message="{{session('message')}}"></x-alert-message>
            <div class="card">
                <div class="card-header">{{isset($userWithRole) ? 'Update' : 'Create'}} User-Role</div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($userWithRole) ? route('user-role.update',encrypt($userWithRole->id)) : route('user-role.store') }}">
                        @csrf
                        @if (isset($userWithRole))
                            @method('patch')
                        @endif
                        <div class="form-group mb-2">
                          <label for="user">User</label>
                          <select class="form-select" name="user" id="user">
                            <option value="">select</option>
                            @foreach ($users as $user)
                                <option {{isset($userWithRole) && $userWithRole->id == $user['id'] ? 'selected' : ''}} value="{{$user['id']}}">{{$user['name']}}</option>
                            @endforeach
                          </select>
                          @error('user')
                            <div class="error">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="role">Role</label>
                          <select name="role" id="role" class="form-select">
                            <option value="">select</option>
                            @foreach ($roles as $role)
                                <option {{isset($userWithRole) && $userWithRole->role_id == $role['id'] ? 'selected' : ''}} value="{{$role['id']}}">{{$role['role_name']}}</option>
                            @endforeach
                          </select>
                          @error('role')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-success mt-2" type="submit"> {{isset($userWithRole) ? 'Update' : 'Submit'}}</button>
                    </form>
                </div>
            </div>
            @if (!isset($userWithRole))
              <div class="card-body mt-3">
                <div class="card">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       @if (isset($usersWithRoles) && $usersWithRoles != [])
                          @foreach ($usersWithRoles as $key=> $user_role)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$user_role->name}}</td>
                              <td>{{$user_role->role_name}}</td>
                              <td style="display: flex">
                                <form action="{{route('user-role.edit',encrypt($user_role->role_userId))}}" method="get">
                                    @csrf
                                    <button class="btn btn-info" style="margin-right: 5px">Edit</button>
                                </form>
                                <form action="{{route('user-role.update',encrypt($user_role->role_userId))}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            </tr>
                          @endforeach
                       @else
                           <tr>
                            <td colspan="4" style="text-align: center">No Record Found</td>
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
        $("#user").select2();
        $("#role").select2();

        $(".btn-danger").on('click',function(){
                if (confirm("Are you sure, you want to delete this role") == true) {
                    $(this).closest('form').submit()
                }
        })
    });
  </script>
@endsection
