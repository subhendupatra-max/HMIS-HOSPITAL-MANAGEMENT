@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Billing
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add opd billing')
                        <a href="{{ route('add-opd-billing', ['id' => base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add Billing </a>
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
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Bill No.</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Total Amount</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Discount Status</th>
                                <th class="border-bottom-0">Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (@$opd_billing_details)
                            @foreach ($opd_billing_details as $value)
                            <tr>
                                <td><a class="text-info" href="{{ route('opd-bill-details', ['bill_id' => base64_encode($value->id)]) }}">{{ $value->bill_prefix }}{{ $value->id }}</a>
                                </td>
                                <td>{{ date('d-m-Y h:i A', strtotime($value->bill_date)) }}</td>
                                <td>{{ $value->total_amount }}</td>
                                <td>{{ $value->created_details->first_name }}
                                    {{ $value->created_details->last_name }}
                                </td>

                                <td>
                                    @if($value->discount_status != 'Not applied')
                                    @if($value->discount_status == 'Approved')
                                    <span class="badge badge-success">Approved</span>
                                    @elseif ($value->discount_status == 'Requested')
                                    <span class="badge badge-warning">Requested</span>
                                    @else
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif
                                    @else
                                    <span class="badge badge-primary">Not Applied</span>
                                    @endif
                                </td>

                                <td><span class="badge badge-success">{{ $value->payment_status }}</span></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            {{-- <a class="dropdown-item" href="{{ route('opd-bill-details', ['bill_id' => base64_encode($value->id)]) }}">
                                            <i class="fa fa-eye"></i> View
                                            </a> --}}
                                            @can('print opd billing')
                                            <a class="dropdown-item" href="{{route('print-opd-bill',['bill_id'=>base64_encode($value->id)])}}">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                            @endcan
                                            {{-- @can('edit opd billing')
                                            <a class="dropdown-item" href="{{route('edit-opd-bill',['bill_id'=>base64_encode($value->id),'id'=>base64_encode($opd_id)])}}">
                                            <i class="fa fa-edit"></i> Edit
                                            </a>
                                            @endcan
                                            @can('delete opd billing')
                                            <a class="dropdown-item" href="{{route('delete-opd-bill',['bill_id'=>base64_encode($value->id)])}}">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                            @endcan --}}

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- {!! $opd_billing_details->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection