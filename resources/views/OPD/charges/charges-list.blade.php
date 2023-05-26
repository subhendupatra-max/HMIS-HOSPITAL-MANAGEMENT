@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Charges
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add opd charges')
                        <a href="{{ route('add-opd-charges', ['id' => base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add Charges </a>
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
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Charge Name</th>
                                <th class="border-bottom-0">Amount</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Bill Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (@$opd_charges_details)
                            @foreach ($opd_charges_details as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @date('d-m-Y h:i A', strtotime($value->charges_date)) }}</td>
                                <td>{{ @$value->charges_category_details->charges_catagories_name }}</td>
                                <td>{{ @$value->charge_details->charges_name }}</td>
                                <td>{{ @$value->amount }}</td>
                                <td>{{ @$value->generated_by_details->first_name }} {{ @$value->generated_by_details->last_name }}</td>
                                <td>
                                    @if($value->billing_status == '0')
                                    <span class="badge badge-warning">Billing Not Created</span>
                                    @else
                                    <span class="badge badge-success">Billing Created</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="{{ route('opd-bill-details', ['bill_id' => base64_encode($value->id)]) }}">
                                                <i class="fa fa-eye"></i> View
                                            </a>

                                            <a class="dropdown-item" href="">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                            {{-- @can('edit opd charges')
                                                        <a class="dropdown-item" href="{{route('edit-opd-charges',['id'=>base64_encode($opd_id),'charge_id'=>base64_encode($value->id)])}}">
                                            <i class="fa fa-edit"></i> Edit
                                            </a>
                                            @endcan --}}
                                            @if($value->billing_status == '0')
                                            @can('delete opd charges')
                                            <a class="dropdown-item" href="{{route('delete-opd-charges',['id'=>base64_encode($opd_id),'charge_id'=>base64_encode($value->id)])}}">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                            @endcan
                                            @endif
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
</div>
@endsection