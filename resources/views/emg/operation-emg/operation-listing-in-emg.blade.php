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
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Operation Name</th>
                                <th class="text-white">Operation Catagory </th>
                                <th class="text-white">Consultant Doctor </th>
                                <th class="text-white">Operaiton Type</th>
                                <th class="text-white">From Date</th>
                                <th class="text-white">To Date</th>
                                @can('edit physical condition','delete physical condition')
                                <th class="text-white">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$operation_details[0]->operation_name != null )
                            @foreach ($operation_details as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('emg-operation-details',['emg_id' => base64_encode($item->emg_id)]) }}" style="color:blue">{{$item->booking_id}}</a>
                                </td>
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