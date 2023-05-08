@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Bill Details
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('emg.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                {{-- ========================================================================== --}}
                <div class="col-lg-4 col-xl-4 border-right">
                    <div class="mt-2">
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Bill No : </span><span class="requisition_text">{{ @$bill_details->bill_prefix }}{{ @$bill_details->id }}</span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Bill Date : </span><span class="requisition_text"><?= date('d-m-Y h:i', strtotime($bill_details->bill_date)) ?></span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Created By : </span><span class="requisition_text">{{ @$bill_details->created_details->first_name }}
                                {{ @$bill_details->created_details->last_name }}</span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Billing </span><span class="requisition_text"><span class="badge badge-success">{{ $bill_details->status }}</span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Payment Status </span><span class="badge badge-success">{{ $bill_details->payment_status }}</span>
                        </div>
                    </div>
                </div>
                {{-- ========================================================================== --}}

                {{-- ========================================================================= --}}
                <div class="col-lg-8 col-xl-8 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">

                            <div class="table-responsive">
                                <table class="table table-striped card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Charge Name</th>
                                            <th>Charge Amount</th>
                                            <th>Tax</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($patient_charge_details) && $patient_charge_details != '')
                                        @foreach ($patient_charge_details as $charge)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ @$charge->charge_details->charges_name }}</td>
                                            <td>{{ @$charge->standard_charges }}</td>
                                            <td>{{ @$charge->tax }}</td>
                                            <td>{{ @$charge->amount }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <hr>
                                <div class="container mt-5" style="margin-left: -53px;">
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                                            {{ @$bill_details->total_amount }}</span>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Discount </span><span class="bilpo_value"> :
                                            00</span>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Tax </span><span class="bilpo_value"> :
                                            {{ @$bill_details->tax }}</span>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Grand Total </span><span class="bilpo_value"> :
                                            {{ number_format((float) $bill_details->grand_total, 2, '.', '') }}</span>
                                    </div>
                                </div>
                            </div><!-- bd -->

                        </div>
                    </div>
                </div>
                {{-- ======================================================================== --}}
            </div>
        </div>
    </div>
</div>
@endsection