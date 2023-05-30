@extends('layouts.layout')

@section('content')

@can('add role')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
            @if (session('success'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
            @endif
        <div class="card-header">
            <h4 class="card-title">Add Role</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('addRole') }}" novalidate>
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="role" class="medicinelabel">Role</label>
                        <input type="text"  id="role" name="role"  required>
                        @error('role')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Role</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Role List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Role</th>
                                @can('asign roleBasedPermission')
                                    <th class="border-bottom-0">Asign Permission</th>
                                @endcan
                                @can('delete role')
                                    <th class="border-bottom-0">Remove Role</th>
                                @endcan
                                @can('edit role')
                                    <th class="border-bottom-0">Edit Role</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allRole as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    @can('asign roleBasedPermission')
                                        <td>
                                            <a href="{{ route('PermissionAsign',['role'=>base64_encode($item->name)]) }}" class="btn btn-info"  data-toggle="tooltip-primary" data-bs-placement="top" title="Asign Permission To This Role"><i class="fa fa-check"></i></a>
                                        </td>
                                    @endcan
                                    @can('delete role')
                                      <td>
                                        <form action="{{ route('deleteRole') }}" method="POST" id="delete">
                                          @csrf
                                          <button class="btn btn-danger"  data-toggle="tooltip-primary" data-placement="top" title="Remove Role" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                          <input type="hidden" name="roleId" value="{{ $item->id }}">
                                        </form>
                                      </td>
                                    @endcan
                                    @can('edit role')
                                      <td>
                                        <a href="{{ route('editRole',['id'=>base64_encode($item->id)]) }}" class="btn btn-warning"  data-toggle="tooltip-primary" data-placement="top" title="Edit Role"><i class="fa fa-edit"></i></a>
                                      </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>
@endsection
