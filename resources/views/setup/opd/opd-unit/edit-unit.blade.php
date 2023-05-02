@extends('layouts.layout')

@section('content')

@can('edit opd unit')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Opd Unit</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-opd-unit-details') }}">
                @csrf
                <div class="">
                    <input type="hidden" name="id" value="{{ $editOpdUnit->id }}">
                    <div class="form-group">
                        <label for="department_id" class="medicinelabel">Department<span class="text-danger">*</span></label>
                        <select id="department_id" class="form-control" name="department_id">
                            <option value=" ">Select Department</option>
                            @foreach ($department as $item)
                            <option value="{{$item->id}}" {{ $item->id == $editOpdUnit->department_id ? 'selected' : " " }}>{{$item->department_name}}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="opdunitedit">
                        <label for="department_id" class="opdunittlabel">Days<span class="text-danger">*</span></label>
                        <select name="days" class="form-control" id="days">
                            <option value="">Select</option>
                            @foreach (Config::get('static.weeks') as $lang => $week)
                            <option value="{{$week}}" {{ $week == $editOpdUnit->days ? 'selected' : " " }}> {{$week}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="department_id" class="opdunittwolabel">Unit<span class="text-danger">*</span></label>
                        <table class="table" id="dynamic_field">
                        <td><button type="button" name="add" id="add" class="btn btn-success" onclick="addmore()"><i class="fa fa-plus"></i></button></td>
                            @foreach ( $opdUnitDetails as $item)
                            <tr id="row1">
                                <td><input type="text" name="unit[]" value="{{ @$item->unit_name}}" class="form-control name_list" /></td>
                            </tr>
                            @endforeach

                        </table>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Opd Unit</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Opd Unit List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Department</th>
                                <th class="border-bottom-0">Days</th>
                                @can('delete opd unit','edit opd unit')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opdUnit as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->department_id }}</td>
                                <td>{{ $item->days }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit opd unit')
                                            <a class="dropdown-item" href="{{ route('edit-opd-unit-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete opd unit')
                                            <a class="dropdown-item" href="{{ route('delete-opd-unit-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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

<script>
    var i = 2;

    function addmore() {

        $('#dynamic_field').append(
            `<tr id="row${i}">
                <td><input type="text" name="unit[]" placeholder="Enter Unit" class="form-control name_list" /></td>
                <td><button type="button" id="add" class="btn btn-danger" onclick="remove(${i})"><i class="fa fa-trash"></i></button></td>
            </tr>`
        );
        i = i + 1;

    }

    function remove(row_no) {
        $('#row' + row_no).remove();
    }
</script>
