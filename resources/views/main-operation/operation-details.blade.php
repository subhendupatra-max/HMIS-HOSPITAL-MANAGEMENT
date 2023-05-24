@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Operation Details
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add patient')
                        <a href="{{ route('add-operation') }}" class="btn btn-primary btn-sm"><i class="fa fa-hospital-user"></i></i> Operation Booking </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        @include('message.notification')

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Operation Name</th>
                                <th class="border-bottom-0">Operation Department</th>
                                <th class="border-bottom-0">Operation Catagory </th>
                                <th class="border-bottom-0">Consultant Doctor</th>
                                <th class="border-bottom-0">Date From</th>
                                <th class="border-bottom-0">Date To</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($operation_details as $operation_detail)
                            <tr>
                                <td>{{$operation_detail->first_name }} {{$operation_detail->middle_name }} {{$operation_detail->last_name }}</td>
                                <td> {{ @$operation_detail->operation_name }} </td>
                                <td> {{ @$operation_detail->department_name }} </td>
                                <td> {{ @$operation_detail->operation_catagory_name }} </td>
                                <td> {{ @$operation_detail->doctor_first_name }} {{ @$operation_detail->doctor_last_name }} </td>
                                <td> {{ @$operation_detail->operation_date_from }} </td>
                                <td> {{ @$operation_detail->operation_date_to }} </td>
                                <td> @if($operation_detail->status == 'Pending')
                                    <span class="badge badge-warning"> {{ $operation_detail->status }}</span>
                                    @elseif($operation_detail->status == 'Complete')
                                    <span class="badge badge-success">  {{ $operation_detail->status }}</span>
                                    @else
                                    <span class="badge badge-secondary">  {{ $operation_detail->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            @can('view operation main')
                                            <a class="dropdown-item" href="{{ route('view-operation-booking-details', base64_encode($operation_detail->booking_id)) }}">
                                                <i class="fa fa-eye"></i> View</a>
                                            @endcan

                                            @can('edit operation main')
                                            <a class="dropdown-item" href="{{ route('edit-operation-booking-details',['id' => base64_encode($operation_detail->booking_id)]) }}">
                                                <i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete operation main')
                                            <a class="dropdown-item" href="{{ route('delete-operation-booking-details', base64_encode(@$operation_detail->booking_id)) }}"><i class="fa fa-trash"></i>
                                                Delete</a>
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