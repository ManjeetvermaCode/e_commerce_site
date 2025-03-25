@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('success') != null)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Message : </strong>{{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                {{-- <div class="card-header">{{isset($role['role_slug']) ? 'Update' : 'Create'}} Role</div> --}}
                <div class="card-header">Create User</div>
                <div class="card-body">
                    <form method="POST" action="{{route('acl-users.store')}}">
                        @csrf
                        {{-- @if (isset($role['role_slug']))
                            @method('patch')
                        @endif --}}
                        <div class="form-group mb-2">
                          <label for="role_name">User Name</label>
                          <input class="form-control" type="text" name="name" value="{{old('name')}}" id="name">
                          @error('name')
                            <div class="error">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="role_slug">User Email</label>
                            <input class="form-control" type="text" name="email" value="{{old('email')}}" id="email">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror 
                        </div>
                        <div class="form-group">
                            <label for="role_slug">Password</label>
                              <input class="form-control" type="text" name="pass" id="pass" value="abcd1234" readonly>
                              @error('pass')
                                  <div class="error">{{ $message }}</div>
                              @enderror
                          </div>
                        <button class="btn btn-success mt-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        let page_type="{{ $role['role_slug'] ?? '' }}"
        if(!page_type){
            $("#role_name").on('keyup',function(){
                let role_name=$("#role_name").val()
                if(role_name){
                    $("#role_slug").val("role_"+role_name)
                }
            })
        }
    });
  </script>
@endsection
