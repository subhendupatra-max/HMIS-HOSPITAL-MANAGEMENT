@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Radiology Test
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
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Test Name</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Billing Status</th>
                                <th class="border-bottom-0">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (@$radiology_patient_test)
                            @foreach ($radiology_patient_test as $value)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @date('d-m-Y h:i A', strtotime($value->date)) }}</td>
                                <td>{{ @$value->test_details->test_name }}</td>
                                <td>{{ @$value->test_details->test_name }}</td>
                                <td>{{ @$value->generator_details->first_name }} {{ @$value->generator_details->last_name }}</td>
                                <td>
                                    {!! $value->billing_status == '0' ? '<span class="badge badge-warning">Billing Not Done</span>':'<span class="badge badge-success">Billing Done</span>' !!}
                                </td>
                                <td>{!! @$value->test_status !!}</td>
                                <td>
                                    <div class="card-options">
                                        <a class="btn btn-success btn-sm" href="#">
                                            <i class="fa fa-print"></i> Print Report
                                        </a>
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