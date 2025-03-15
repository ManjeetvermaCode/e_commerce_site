@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
        <x-alert-message type="{{session('type')}}" message="{{session('message')}}"></x-alert-message>

        <a class="btn btn-primary" style="float: inline-end" href="{{route('permissions.create')}}">Add Permission</a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Permission Name</th>
                <th scope="col">Permission Slug</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($all_permissions as $key => $item)
                <tr>
                    <td  scope="row">{{$key+1}}</td>
                    <td>{{$item['permission_name']}}</td>
                    <td>{{$item['permission_slug']}}</td>
                    <td style="display: flex">
                        <form action="{{route('permissions.edit',encrypt($item['id']))}}" method="get">
                            @csrf
                            <button class="btn btn-info" style="margin-right: 5px">Edit</button>
                        </form>
                        <form action="{{route('permissions.update',encrypt($item['id']))}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
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
