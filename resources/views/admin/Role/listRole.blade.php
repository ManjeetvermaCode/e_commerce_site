@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-alert-message type="{{session('type')}}" message="{{session('message')}}"></x-alert-message>
                <a class="btn btn-primary" style="float: inline-end" href="{{route('roles.create')}}">Add Role</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Role Slug</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (isset($all_roles) && $all_roles->isNotEmpty())
                            @foreach ($all_roles as $key => $item)
                                <tr>
                                    <td  scope="row">{{$key+1}}</td>
                                    <td>{{$item['role_name']}}</td>
                                    <td>{{$item['role_slug']}}</td>
                                    <td style="display: flex">
                                        <form action="{{route('roles.edit',encrypt($item['id']))}}" method="get">
                                            @csrf
                                            <button class="btn btn-info" style="margin-right: 5px">Edit</button>
                                        </form>
                                        <form action="{{route('roles.update',encrypt($item['id']))}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align:center">No Records Found</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".btn-danger").on('click',function(){
                if (confirm("Are you sure, you want to delete this role") == true) {
                    $(this).closest('form').submit()
                }
            })
        })
    </script>
@endsection
