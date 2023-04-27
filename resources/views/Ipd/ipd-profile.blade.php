@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Profile
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                {{-- ========================================================================================= --}}
                <div class="col-lg-6 col-xl-6 border-right">

                    {{-- ================== patient name ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span class="profileHeding">{{ @$ipd_details->all_patient_details->first_name }}
                                    {{ @$ipd_details->all_patient_details->middle_name }}
                                    {{ @$ipd_details->all_patient_details->last_name }}({{
                                    @$ipd_details->all_patient_details->patient_prefix }}{{
                                    @$ipd_details->all_patient_details->id }})</span>
                            </div>
                        </div>
                    </div>
                    {{-- ================== patient name ====================== --}}

                    {{-- ================== patient information ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-venus-mars text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Gender :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->gender }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-users text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Gurdian Name :-
                                        </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->guardian_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-mobile-alt text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Mobile No :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-calendar text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Age :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->year }}Y
                                        {{ @$ipd_details->all_patient_details->month }}M
                                        {{ @$ipd_details->all_patient_details->day }}D
                                    </td>
                                </tr>
                                <tr colspan="2">
                                    <td class="py-2 px-0"><i class="fa fa-map-pin text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Address :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->address }},{{
                                        @$ipd_details->patient_state->name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- ================== patient information ====================== --}}

                    {{-- ================== patient registation information ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">IPD Id :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{$ipd_details->ipd_prefix}}{{$ipd_details->id}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Department :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->department_details->department_name }}( {{ @$ipd_details->department_details->department_code }})
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fas fa-user-md text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Doctor :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$ipd_details->doctor_details->first_name}} {{@$ipd_details->doctor_details->last_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-bed text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Bed :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{$ipd_details->bed_details->bed_name}} - {{$ipd_details->unit_details->bedUnit_name}} - {{$ipd_details->ward_details->ward_name}}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    {{-- ================== patient registation information ====================== --}}

                </div>
                {{-- ========================================================================================= --}}

                {{-- ========================================================================================= --}}
                <div class="col-lg-6 col-xl-6 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">

                            </div>
                        </div>
                    </div>
                </div>
                {{-- ========================================================================================= --}}
            </div>
        </div>
    </div>
</div>
@endsection