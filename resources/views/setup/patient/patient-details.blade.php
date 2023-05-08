@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold">{{ $patient_details->prefix }} {{
                        $patient_details->first_name }} {{ $patient_details->last_name }} ( {{ $patient_details->patient_prefix }}{{ $patient_details->id }} ) <i class="fa fa-check-circle text-success"></i></h4>
                </div>
                @can('edit patient')
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a href="{{ route('edit-patient-details', base64_encode($patient_details->id)) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Details</a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Patient's Details </h5>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Gender </span>
                                        </td>
                                        <td class="py-2 px-5">{!!$patient_details->gender!!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Age </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            @if ($patient_details->year != 0)
                                            {{ @$patient_details->year }}y
                                            @endif
                                            @if ($patient_details->month != 0)
                                            {{ @$patient_details->month }}m
                                            @endif
                                            @if ($patient_details->day != 0)
                                            {{ @$patient_details->day }}d
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Phone no </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$patient_details->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Guardian Name </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$patient_details->guardian_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Guardian Contact No. </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$patient_details->guardian_contact_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Local Guardian Name </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$patient_details->local_guardian_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Local Guardian Contact No </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$patient_details->local_guardian_contact_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Blood Group </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$patient_details->blood_group }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Phone </span>
                                        </td>
                                        <td class="py-2 px-5">{{@$patient_details->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Address </span>
                                        </td>
                                        <td class="py-2 px-5">{!!$patient_details->address!!},{!!$patient_details->pin_no!!},{!!@$patient_details->_district->name!!},{!! @$patient_details->_state->name!!},{!! @$patient_details->_country->country_name!!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Local Address </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!$patient_details->address!!},{!!$patient_details->pin_no!!},{!!@$patient_details->local_district->name!!},{!!@$patient_details->local_state->name!!},{!!@$patient_details->local_country->country_name!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Identification details </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$patient_details->identification_name }} : {{ @$patient_details->identification_number }}
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