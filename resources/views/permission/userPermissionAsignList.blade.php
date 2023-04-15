@extends('layouts.layout')

@section('content')

<!--div-->
<div class="card">
    <div class="card-header">
        <div class="card-title">User List</div>
    </div>
    <div class="card-body">
        <div class="">
            <div class="table-responsive">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">Sl. No</th>
                            <th class="border-bottom-0">Name</th>
                            <th class="border-bottom-0">Email</th>
                            <th class="border-bottom-0">Asign Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allUsers as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td> 
                                    <a href="{{ route('PermissionAsignToUser',['role'=>base64_encode($item->id)]) }}" class="btn btn-info"  data-bs-toggle="tooltip" data-bs-placement="top" title="Asign Permission To This User"><i class="fa fa-link fa-spin"></i></a> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/div-->
@endsection