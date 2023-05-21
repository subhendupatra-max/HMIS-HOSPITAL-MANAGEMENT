@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Ambulance List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add ambulance')
                        <a href="{{ route('add-ambulance-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Ambulance </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Vehicle Number</th>
                                <th class="border-bottom-0">Vehicle Model</th>
                                <th class="border-bottom-0">Year Made</th>
                                <th class="border-bottom-0">Driver Name</th>
                                <th class="border-bottom-0">Driver License</th>
                                <th class="border-bottom-0">Vehicle Type</th>

                                @can('edit ambulance ','delete ambulance ')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ambulance as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->vehicle_number}} </td>
                                <td>{{ @$item->vehicle_model}} </td>
                                <td>{{ @$item->year_made}} </td>
                                <td>{{ @$item->driver_name}} </td>
                                <td>{{ @$item->driver_license}} </td>
                                <td>{{ @$item->vehicle_type}} </td>

                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit ambulance')
                                            <a class="dropdown-item" href="{{ route('edit-ambulance-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete ambulance')
                                            <a class="dropdown-item" href="{{ route('delete-ambulance-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
</div>
@endsection