@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Radiology Billing List
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add radiology bill')
                        <a href="{{ route('add-radiology-billing') }}" class="btn btn-primary btn-sm"><i class="fa fa-file"></i>
                            Generate Bill </a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
        @include('message.notification')
        @can('radiology billing list')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Bill No.</th>
                                <th class="border-bottom-0">Patient Details</th>
                                <th class="border-bottom-0">Amount</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>

                        </thead>

                        <tbody>
                            @if(isset($radiology_bill_details))
                            @foreach ($radiology_bill_details as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$value->bill_prefix }}{{ @$value->id }}</td>
                                <td>{{ @$value->all_patient_details->prefix }} {{ @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name }} {{ @$value->all_patient_details->last_name }}<br>
                                    {{ @$value->all_patient_details->patient_prefix }}{{ @$value->all_patient_details->id }}
                                </td>
                                <td>{{ @$value->total_amount }}</td>
                                <td><a href="#"><span class="badge badge-danger">Accepted</span></a></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> View</a>

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
                    {{-- {!! $radiology_billing_list->links() !!} --}}
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
    @endsection