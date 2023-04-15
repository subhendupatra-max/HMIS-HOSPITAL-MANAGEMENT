@extends('layouts.layout')

@section('content')

@can('add operation')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Operation</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-operation-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="operation_department" class="form-label">Department</label>
                        <select id="operation_department" class="form-control" name="operation_department">
                            <option value=" ">Select Department</option>
                            @foreach ($department as $item)
                            <option value="{{$item->id}}">{{$item->department_name}}</option>
                            @endforeach
                        </select>
                        @error('operation_department')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="operation_catagory" class="form-label">Operation Catagory</label>
                        <select id="operation_catagory" class="form-control" name="operation_catagory">
                            <option value=" ">Select Operation Catagory</option>
                            @foreach ($operation_catagory as $item)
                            <option value="{{$item->id}}">{{$item->operation_catagory_name}}</option>
                            @endforeach
                        </select>
                        @error('operation_catagory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="operation_name" class="form-label">Operation Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="operation_name" name="operation_name" placeholder="Enter Operation Name" value="{{ old('operation_name')}}" required>
                        @error('operation_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Operation</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Operation List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Operation Name</th>
                                <th class="border-bottom-0">Operation Department</th>
                                <th class="border-bottom-0">Operation Catagory</th>
                                @can('edit operation','delete operation')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($operation as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->operation_name}}</td>
                                <td>{{ @$item->department->department_name}}</td>
                                <td>{{ @$item->operation_catagory_id->operation_catagory_name}}</td>
                            <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit operation')
                                            <a class="dropdown-item" href="{{ route('edit-operation-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('edit operation')
                                            <a class="dropdown-item" href="{{ route('delete-operation-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>
@endsection