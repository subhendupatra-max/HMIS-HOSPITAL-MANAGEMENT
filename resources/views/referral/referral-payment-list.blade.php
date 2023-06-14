@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Referral Payment List
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('')
                        <a href="{{ route('add-referral-payment') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                            Add Referral Payment </a>
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
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Referral Name</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Bill No.</th>
                                <th class="border-bottom-0">Bill Amount ($)</th>
                                <th class="border-bottom-0">Commission Amount ($)</th>
                                {{-- <th class="border-bottom-0">Status</th> --}}
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($payment_list))
                            @foreach ($payment_list as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$value->referral_details->referral_name }}</td>
                                <td>{{ @$value->all_patient_details->prefix }} {{ @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name }} {{ @$value->all_patient_details->last_name }}<br>
                                    {{ @$value->all_patient_details->patient_prefix }}{{ @$value->all_patient_details->id }}
                                </td>
                                <td>{{ @$value->bill_id }}</td>
                                <td>{{ @$value->bill_amount }}</td>
                                <td>{{ @$value->commission_amount }}</td>
                                {{-- <td>{!! @$value->status == 'pending'?'<span class="badge badge-warning">Payment Due</span>':'<span class="badge badge-success">Patment Done</span>' !!}</td> --}}
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            {{-- <a class="dropdown-item" href=""><i class="fa fa-eye"></i> View</a> --}}
                                            @can('')
                                            <a class="dropdown-item" href=""><i class="fa fa-edit"></i> Edit</a>
                                            @endcan
                                            @can('')
                                            <a class="dropdown-item" href=""><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
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