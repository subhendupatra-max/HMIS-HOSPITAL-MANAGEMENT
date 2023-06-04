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
                            @include('OPD.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            @include('OPD.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">OT. No</th>
                                <th class="border-bottom-0">Operation Name</th>
                                <th class="border-bottom-0">Operation Catagory </th>
                                <th class="border-bottom-0">Consultant Doctor </th>
                                <th class="border-bottom-0">Operaiton Type</th>
                                <th class="border-bottom-0">From Date</th>
                                <th class="border-bottom-0">To Date</th>
                                <!-- @can('edit physical condition','delete physical condition')
                                <th>Action</th>
                                @endcan -->
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$operation_details[0]->operation_name != null )
                            @foreach ($operation_details as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('opd-operation-details',['opd_id' => base64_encode($item->opd_id)]) }}" style="color:blue">{{$item->booking_id}}</a>
                                </td>
                                <td>{{$item->operation_name}}</td>
                                <td>{{$item->operation_catagory_name}}</td>
                                <td>{{$item->doctor_first_name}} {{$item->doctor_last_name}}</td>
                                <td>{{$item->operation_type_name}}</td>
                                <td>{{$item->operation_date_from}}</td>
                                <td>{{$item->operation_date_to}}</td>
                                <!-- <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            
                                        </div>
                                    </div>
                                </td> -->
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection