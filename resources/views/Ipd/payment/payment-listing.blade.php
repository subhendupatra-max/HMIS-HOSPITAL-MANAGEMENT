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
                        <a href="{{ route('add-ipd-payment-details',['ipd_id' => base64_encode($ipd_details->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Total Payment Slip</a>
                        @can('')
                        <a href="{{ route('add-ipd-payment-details',['ipd_id' => base64_encode($ipd_details->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-rupee-sign"></i> Add new Payment</a>
                        @endcan

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-header">
            @include('ipd.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body ">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead class="bg-primary text-white">
                                <tr class="border-left">
                                    <th class="text-white">Sl. No</th>
                                    <th class="text-white">Date</th>
                                    <th class="text-white">Amount</th>
                                    <th class="text-white">Payement Mode</th>
                                    <th class="text-white">Note</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $paymentDetails as $item )
                                <tr>
                                    <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">{{ @$item->payment_date }} </td>
                                    <td class="border-bottom-0">{{ @$item->payment_amount }}</td>
                                    <td class="border-bottom-0">{{ @$item->payment_mode }}</td>
                                    <td class="border-bottom-0">{{ @$item->note }}</td>
                                    <td class="border-bottom-0">
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                @can('edit ipd payment')
                                                <a class="dropdown-item" href="{{ route('edit-ipd-payment-details',['ipd_id' => base64_encode($ipd_details->id) , 'id' => base64_encode($item->id)]) }}">
                                                    <i class="fa fa-edit"></i> Edit</a>
                                                @endcan

                                                @can('delete ipd payment')
                                                <a class="dropdown-item" href="{{ route('delete-ipd-payment-details',['id' => base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                                                @endcan


                                                @can('print-payment-in-ipd')
                                                <a class="dropdown-item" href="{{ route('print-payment-in-ipd',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Print</a>
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
</div>

@endsection