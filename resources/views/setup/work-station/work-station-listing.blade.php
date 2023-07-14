@extends('layouts.layout')

@section('content')

@can('add Work Station')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Work Station</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-work-station-details') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="work_station_name" class="medicinelabel">Work Station Name</label>
                        <input type="text" id="work_station_name" name="work_station_name" placeholder="Enter Work Station" value="{{ old('work_station_name')}}" required>
                        @error('work_station_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Work Station</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Work Station List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Work Station</th>
                                @can('delete Work Station','edit Work Station')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($work_station as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>
                                    <a class="textlink" href="{{ route('work-station-details-user',['id'=>$item->id]) }}">{{ @$item->work_station_name }}</a>
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            @can('Work Station Details')
                                            <a class="dropdown-item" href="{{ route('work-station-details-user',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> View</a>
                                            @endcan

                                            @can('edit Work Station')
                                            <a class="dropdown-item" href="{{ route('edit-work-station-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete Work Station')
                                            <a class="dropdown-item" href="{{ route('delete-work-station-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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