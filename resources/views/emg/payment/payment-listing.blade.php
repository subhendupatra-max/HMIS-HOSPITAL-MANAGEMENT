@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Payment List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('emg payment')
                        <a href="{{ route('add-payment-in-emg',['id'=> base64_encode($emg_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Payment </a>
                        @endcan
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
                                <th class="text-white">Date</th>
                                <th class="text-white">Amount</th>
                                <th class="text-white">Payment Mode</th>
                                @can('edit opd payment','delete opd payment')
                                <th class="text-white">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emgPaymentDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->payment_date}}</td>
                                <td>{{$item->amount}}</td>
                                <td>{{$item->payment_mode}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit-payment-in-emg')
                                            <a class="dropdown-item" href="{{ route('edit-payment-in-emg',['id'=> base64_encode($item->id),'emg_id'=> base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete-payment-in-emg')
                                            <a class="dropdown-item" href="{{ route('delete-payment-in-emg',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan

                                            @can('print-payment-in-emg')
                                            <a class="dropdown-item" href="{{ route('print-payment-in-emg',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Print</a>
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