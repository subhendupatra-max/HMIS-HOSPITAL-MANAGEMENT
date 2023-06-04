@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold"> Operation Booking Details</h4>
                </div>

                <div class="col-md-6 text-right">

                
                    <a class="btn btn-primary btn-sm" href="{{ route('edit-opd-operation-in-opd',['id' => base64_encode($operation_details->booking_id)]) }}"><i class="fa fa-edit"></i> Edit Details</a>


                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        @include('OPD.include.menu')
                    </div>
                </div>

            </div>
        </div>
        <div class="card-header">
            @include('OPD.include.patient-name')
        </div>
        <div class="card-body p-0">
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Operation Booking Details </h5>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operation Name </span>
                                        </td>
                                        <td class="py-2 px-5">{!!@$operation_details->operation_name!!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operation Department </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!@$operation_details->department_name!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operation Catagory </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$operation_details->operation_catagory_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Consultant Doctor </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$operation_details->doctor_first_name }} {{ @$operation_details->doctor_last_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php $nurse1 = DB::table('operation_bookings')->select('users.first_name as nurse_first_name', 'users.last_name as nurse_last_name')->leftjoin('users', 'users.id', '=', 'operation_bookings.ass_consultant_1')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Assistant Consultant 1 </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$nurse1->nurse_first_name }} {{ @$nurse1->nurse_last_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php $nurse2 = DB::table('operation_bookings')->select('users.first_name as nurse_first_names', 'users.last_name as nurse_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ass_consultant_2')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Assistant Consultant 2</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$nurse2->nurse_first_names }} {{ @$nurse2->nurse_last_names }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php $anesthetist = DB::table('operation_bookings')->select('users.first_name as anesthetist_first_names', 'users.last_name as anesthetist_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ass_consultant_2')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Anesthetist</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$anesthetist->anesthetist_first_names }} {{ @$anesthetist->anesthetist_last_names }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Anaethesia Type </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$operation_details->anaethesia_type }}</td>
                                    </tr>
                                    <tr>
                                        <?php $ot_technician = DB::table('operation_bookings')->select('users.first_name as ot_technician_first_names', 'users.last_name as ot_technician_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ot_technician')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Ot Technician </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$anesthetist->ot_technician_first_names }} {{ @$anesthetist->ot_technician_last_names }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <?php $ot_assistant = DB::table('operation_bookings')->select('users.first_name as ot_assistant_first_names', 'users.last_name as ot_assistant_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ot_assistant')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Ot Assistant </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$anesthetist->ot_assistant_first_names }} {{ @$anesthetist->ot_assistant_last_names }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operaiton Type</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!@$operation_details->operation_type_name!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">From Date</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!@$operation_details->operation_date_from!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">To Date</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!@$operation_details->operation_date_to!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Case Id</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!@$operation_details->case_id!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Section</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!@$operation_details->section!!}
                                            <a class="textlink" href="{{ route('opd-profile', ['id' => base64_encode($operation_details->opd_id)]) }}">({{@$operation_details->opd_id}}) </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Status </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            @if($operation_details->status == 'Pending')
                                            <span class="badge badge-warning"> {!!@$operation_details->status!!}</span>
                                            @elseif(@$operation_details->status == 'Complete')
                                            <span class="badge badge-success"> {!!@$operation_details->status!!}</span>
                                            @else
                                            <span class="badge badge-secondary"> {!!@$operation_details->status!!}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Remark </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!@$operation_details->remark !!}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection