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
                        <a href="{{ route('doctor-wise-appointments-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-medkit"></i> Dr. Wise </a>
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
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Patient Name</th>
                                <th class="text-white">Doctor Name</th>
                                <th class="text-white">Appointment Date</th>
                                <th class="text-white">Slot</th>
                                <th class="text-white">Appointment Priority</th>
                                <th class="text-white">Appointment Fees</th>
                                <th class="text-white">Message</th>
                                <th class="text-white">Payment Mode</th>
                                <th class="text-white">Payment Amount</th>
                                <th class="text-white">Note</th>

                                @can('edit appointment','delete appointment')
                                <th class="text-white">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointment as $item)
                            <?php
                             $slot_details = DB::table('slots')->where('id',$item->slot)->first();
                             $slot_time =  date('H:i A',strtotime($slot_details->from_time))." - ".date('H:i A',strtotime($slot_details->to_time));
                            ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->patient_details->first_name}} {{$item->patient_details->middle_name}} {{$item->patient_details->last_name}}</td>
                                <td>{{$item->doctor_details->first_name}} {{$item->doctor_details->last_name}}</td>
                                <td>{{ date('d-m-Y',strtotime($item->appointment_date)) }}</td>
                                <td>{{$slot_time}}</td>
                                <td>
                                    @if($item->appointment_priority == 'Normal')
                                        <span class="badge badge-success">Normal</span>
                                    @elseif($item->appointment_priority == 'Urgent')
                                        <span class="badge badge-warning">Urgent</span>
                                    @elseif($item->appointment_priority == 'Very Urgent')
                                        <span class="badge badge-danger">Very Urgent</span>
                                    @else
                                        <span class="badge badge-info">Low</span>
                                    @endif
                                </td>
                                <td>{{ $item->appointment_fees }}</td>
                                <td>{{$item->message}}</td>
                                <td>{{ $item->payment_mode }}</td>
                                <td>{{ $item->payment_amount }}</td>
                                <td>{{ $item->note }}</td>
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