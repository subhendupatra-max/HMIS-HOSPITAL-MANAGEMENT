@extends('layouts.layout')

@section('content')

@can('add shift')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Shift</h4>
        </div>
         @include('message.notification')
        <div class="card-body">
            <form method="POST" action="{{ route('save-shift-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="name" class="medicinelabel">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name')}}" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="appoinmentedit">
                        <label for="from_time" class="appoimmentlabel">From Time<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="from_time" name="from_time"  required>
                        @error('from_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="appoinmentedit">
                        <label for="from_to" class="appoimmentlabelone">From To<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="from_to" name="from_to"  required>
                        @error('from_to')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Shift</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Shift List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">From Time</th>
                                <th class="border-bottom-0">From To</th>
                                @can('edit shift','delete shift')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shift as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->from_time}}</td>
                                <td>{{ $item->from_to}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit shift')
                                            <a class="dropdown-item" href="{{ route('edit-shift-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete shift')
                                            <a class="dropdown-item" href="{{ route('delete-shift-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
