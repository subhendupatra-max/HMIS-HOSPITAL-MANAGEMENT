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
                        <a href="{{ route('add-payment-in-opd',['id'=> base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-rupee-sign"></i> Add Payment </a>
                        @endcan
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
                        <thead class="bg-primary text-white">
                            <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Date</th>
                                <th class="text-white">Amount</th>
                                <th class="text-white">Received By</th>
                                <th class="text-white">Payment Mode</th>
                                @can('edit opd payment','delete opd payment')
                                <th class="text-white" >Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opdPaymentDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{date('d-m-Y h:i a',strtotime($item->payment_date))}}</td>
                                <td>{{$item->payment_amount}}</td>
                                <td>{{$item->generated_by->first_name}} {{$item->generated_by->last_name}}</td>
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

                                            @can('print-payment-in-opd')
                                            <a class="dropdown-item" href="{{ route('print-payment-in-opd',['id'=> base64_encode($item->id),'opd_id'=> base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-print"></i> Print</a>
                                            @endcan

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $opdPaymentDetails->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection