@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Appointment List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add appointment main')
                        <a href="{{ route('add-appointments-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Add Appointment </a>
                        @endcan

                        @can('dotor wise appointment main')
                        <a href="{{ route('doctor-wise-appointments-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Dr. Wise </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Doctor Name</th>
                                <th class="border-bottom-0">Appointment Date</th>
                                <th class="border-bottom-0">Appointment Priority</th>
                                <th class="border-bottom-0">Message</th>
                                @can('edit appointment','delete appointment')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointment as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->patient_details->first_name}} {{$item->patient_details->middle_name}} {{$item->patient_details->last_name}}</td>
                                <td>{{$item->doctor_details->first_name}} {{$item->doctor_details->last_name}}</td>
                                <td>{{$item->appointment_date}}</td>
                                <td>{{$item->appointment_priority }}</td>
                                <td>{{$item->message}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit appointments emg')
                                            <a class="dropdown-item" href="{{ route('edit-appointments-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete appointments details')
                                            <a class="dropdown-item" href="{{ route('delete-appointments-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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