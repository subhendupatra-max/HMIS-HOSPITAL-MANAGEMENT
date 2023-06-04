@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Operation Booking Details
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('emg.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            @include('emg.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Operation Name</th>
                                <th class="border-bottom-0">Operation Catagory </th>
                                <th class="border-bottom-0">Consultant Doctor </th>
                                <th class="border-bottom-0">Operaiton Type</th>
                                <th class="border-bottom-0">From Date</th>
                                <th class="border-bottom-0">To Date</th>
                                @can('edit physical condition','delete physical condition')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$operation_details[0]->operation_name != null )
                            @foreach ($operation_details as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->operation_name}}</td>
                                <td>{{$item->operation_catagory_name}}</td>
                                <td>{{$item->doctor_first_name}} {{$item->doctor_last_name}}</td>
                                <td>{{$item->operation_type_name}}</td>
                                <td>{{$item->operation_date_from}}</td>
                                <td>{{$item->operation_date_to}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit operation details')
                                            <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endsection