@extends('layouts.layout')

@section('content')

@can('add designation')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Working Slot</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-working-slot-details') }}">
                @csrf
                <div class="">
                    <div class="form-group col-md-12">
                        <label for="working_slot_name" class="medicinelabel" style="margin: -15px 0px 0px 0px">Working Slot Name</label>
                        <input type="text" class="form-control" id="working_slot_name" name="working_slot_name" placeholder="Enter Working Slot Name" value="{{ old('working_slot_name')}}" required>
                        @error('working_slot_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="from_time" class="medicinelabel" style="margin: -15px 0px 0px 0px">From Time</label>
                        <input type="time" class="form-control" id="from_time" name="from_time" value="{{ old('from_time')}}"  style=" margin: 0px 0px 0px 0px;">
                        @error('from_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="to_time" class="medicinelabel" style="margin: -15px 0px 0px 0px">To Time</label>
                        <input type="time" class="form-control" id="to_time" name="to_time" value="{{ old('to_time')}}" style=" margin: 0px 0px 0px 0px;">
                        @error('to_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="to_time" class="medicinelabel" style="margin: -15px 0px 0px 0px">Color</label>
                        <input type="color" class="form-control" id="color" name="color" value="{{ old('color')}}" required style=" margin: 0px 0px 0px 0px;">
                        @error('color')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Working Slot</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Working Slot List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Working Slot Name</th>
                                <th class="border-bottom-0">From Time</th>
                                <th class="border-bottom-0">To Time</th>
                                <th class="border-bottom-0">Total Working Hour</th>
                                <th class="border-bottom-0">Color</th>
                     
                                @can('delete Work Timing Slot','edit Work Timing Slot')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($working_time_slot_list as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->working_slot_name }}</td>
                                <td>{{ date('h:i A',strtotime($item->from_time)) }}</td>
                                <td>{{ date('h:i A',strtotime($item->to_time)) }}</td>
                                <td>{{ $item->total_working_hr }}</td>
                                <td>
                                    <div style="height:10px;width:40px;background-color:{{ @$item->color }}"></div>
                                </td>
                                <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                        @can('edit Work Timing Slot')
                                        <a class="dropdown-item" href="{{ route('edit-working-slot-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan

                                        @can('delete Work Timing Slot')
                                        <a class="dropdown-item" href="{{ route('delete-working-slot-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
