@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Payment
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('opd payment')
                        <a href="{{ route('add-payment-in-opd',['id'=> base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Payment </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href="{{route('opd-profile',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-home"></i> Profile</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-billing' ? 'active' : '' }}" href="{{route('opd-billing',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-money-bill"></i> Billing</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-payment' ? 'active' : '' }}" href="{{route('payment-listing-in-opd',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-rupee-sign"></i> Payment</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-timeline' ? 'active' : '' }}" href="{{route('timeline-lisitng-in-opd',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="far fa-calendar-check"></i> Timeline</a>
                        </div>
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
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Amount</th>
                                <th class="border-bottom-0">Payment Mode</th>
                                @can('edit opd payment','delete opd payment')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opdPaymentDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->payment_date}}</td>
                                <td>{{$item->amount}}</td>
                                <td>{{$item->payment_mode}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit-payment-in-opd')
                                            <a class="dropdown-item" href="{{ route('edit-payment-in-opd',['id'=> base64_encode($item->id),'opd_id'=> base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete-payment-in-opd')
                                            <a class="dropdown-item" href="{{ route('delete-payment-in-opd',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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
    @endsection
