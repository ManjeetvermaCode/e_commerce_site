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
                <div class="card-header">{{isset($role['role_slug']) ? 'Update' : 'Create'}} Role</div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($role['role_slug']) ? route('roles.update',encrypt($role['id'])) : route('roles.store') }}">
                        @csrf
                        @if (isset($role['role_slug']))
                            @method('patch')
                        @endif
                        <div class="form-group mb-2">
                          <label for="role_name">Role Name</label>
                          <input type="text" class="form-control" id="role_name" name="role_name" value="{{old('role_name',$role['role_name'] ?? '')}}" placeholder="Role Name">
                          @error('role_name')
                            <div class="error">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="role_slug">Slug Name</label>
                          <input type="text" class="form-control" id="role_slug" name="role_slug" value="{{old('role_slug',$role['role_slug'] ?? '')}}" {{isset($role['role_slug']) ? 'disabled' : ''}} placeholder="Role Slug">
                          @error('role_slug')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-success mt-2" type="submit"> {{isset($role['role_slug']) ? 'Update' : 'Submit'}}</button>
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
