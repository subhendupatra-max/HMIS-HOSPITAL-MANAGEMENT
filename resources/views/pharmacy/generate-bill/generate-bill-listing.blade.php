@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Pharmacy Bill
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('search Summery Bill')
                        <a href="{{ route('summery-bill-pharmacy') }}" class="btn btn-primary btn-sm"><i class="fa fa-file-invoice-dollar"></i> Summery Bill</a>
                        @endcan

                        @can('add pharmacy bill')
                        <a href="{{ route('generate-medicine-bill') }}" class="btn btn-primary btn-sm"><i class="fa fa-file-invoice-dollar"></i> Generate Bill</a>
                        @endcan

                        @can('medicine stock')
                        <a href="{{ route('all-medicine-stock') }}" class="btn btn-primary btn-sm"><i class="fa fa-capsules"></i> Medicine Stock</a>
                        @endcan

                        @can('medicine')
                        <a href="{{ route('all-medicine-listing') }}" class="btn btn-primary btn-sm"><i class="fa fa-pills"></i></i> Medicines</a>
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
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Bill No</th>
                                <th class="border-bottom-0">Case Id </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Patient Name </th>
                                <th class="border-bottom-0">Amount(Rs)</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(@$medicine_bill)
                            @foreach ($medicine_bill as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a class="dropdown-item text-info" href="{{ route('medicine-bill-details', ['bill_id' => base64_encode($value->id)]) }}">
                                        {{ @$value->id }}
                                    </a></td>
                                <td>{{ @$value->case_id }}</td>
                                <td>{{ date('d-m-Y h:i a',strtotime($value->bill_date)) }}</td>
                                <td>{{ @$value->all_patient_details->prefix }} {{ @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name }} {{ @$value->all_patient_details->last_name }}<br>
                                    {{ @$value->all_patient_details->patient_prefix }}{{ @$value->all_patient_details->id }}
                                </td>
                                <td>{{ @$value->total_amount }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="{{ route('medicine-bill-details', ['bill_id' => base64_encode($value->id)]) }}">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            @can('print medicine bill')
                                            <a class="dropdown-item" href="{{route('print-medicine-bill',['bill_id'=>base64_encode($value->id)])}}">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                            @endcan


                                            @if($value->status != '1')
                                            @can('edit medicine bill')
                                            {{-- <a class="dropdown-item" href="{{route('edit-medicine-bill',['bill_id'=>base64_encode($value->id)])}}">
                                            <i class="fa fa-edit"></i> Edit
                                            </a> --}}
                                            @endcan
                                            @can('delete medicine bill')
                                            <a class="dropdown-item" href="{{route('delete-medicine-bill',['bill_id'=>base64_encode($value->id)])}}">
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