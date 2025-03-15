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
                <div class="card-header">{{isset($permission['permission_slug']) ? 'Update' : 'Create'}} Permission</div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($permission['permission_slug']) ? route('permissions.update',encrypt($permission['id'])) : route('permissions.store') }}">
                        @csrf
                        @if (isset($permission['permission_slug']))
                            @method('patch')
                        @endif
                        <div class="form-group mb-2">
                          <label for="permission_name">Permission Name</label>
                          <input type="text" class="form-control" id="permission_name" name="permission_name" value="{{old('permission_name',$permission['permission_name'] ?? '')}}" placeholder="Permission Name">
                          @error('permission_name')
                            <div class="error">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="permission_slug">Permission Name</label>
                          <input type="text" class="form-control" id="permission_slug" name="permission_slug" value="{{old('permission_slug',$permission['permission_slug'] ?? '')}}" {{isset($permission['permission_slug']) ? 'disabled' : ''}} placeholder="Permission Slug">
                          @error('permission_slug')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-success mt-2" type="submit"> {{isset($permission['permission_slug']) ? 'Update' : 'Submit'}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        let page_type="{{ $permission['permission_slug'] ?? '' }}"
        if(!page_type){
            $("#permission_name").on('keyup',function(){
                let permission_name=$("#permission_name").val()
                if(permission_name){
                    $("#permission_slug").val("permission_"+permission_name)
                }
            })
        }
    });
  </script>
  
@endsection
