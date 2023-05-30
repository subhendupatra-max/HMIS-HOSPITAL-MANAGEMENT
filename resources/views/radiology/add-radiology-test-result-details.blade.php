@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold">{{ @$patient_details->prefix }} {{
                        @$patient_details->first_name }} {{ @$patient_details->middle_name }} {{ @$patient_details->last_name }} ( {{
                        @$patient_details->patient_prefix }}{{ @$patient_details->id }} ) <i class="fa fa-check-circle text-success"></i></h4>
                </div>

                <div class="col-md-6 text-right">
                </div>

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
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Address </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!$patient_details->address!!},{!!$patient_details->pin_no!!},{!!@$patient_details->_district->name!!},{!!
                                            @$patient_details->_state->name!!},{!!
                                            @$patient_details->_country->country_name!!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                  
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Case Id </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {!!$patient_details->case_id!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Section </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$radiology_patient_test_details->section }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Date </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @date('d-m-Y h:i A', strtotime($radiology_patient_test_details->date)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Test Staus </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            @if($radiology_patient_test_details->test_status == '0')
                                            <span class="badge badge-warning">Sample Not Collected</span>
                                            @else
                                            <span class="badge badge-success">Sample Collected</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Bill Status </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            @if($radiology_patient_test_details->billing_status == '0')
                                            <span class="badge badge-warning">Billing Not Done</span>
                                            @elseif ($radiology_patient_test_details->billing_status == '1')
                                            <span class="badge badge-warning">Billing Done</span>
                                            @else
                                            <span class="badge badge-warning">Charge Added</span>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr style="margin: 0px 0px 22px 0px !important;">
                <h5 class="font-weight-bold text-center">       {{ @$radiology_patient_test_details->test_details->test_name }}({{ @$radiology_patient_test_details->test_details->short_name }}) </h5>
            <form action="{{ route('update-radiology-report') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="content" >{{ $radio_test->description }}</textarea>
                </div>
                <input name="p_test_id" value="{{ $p_id }}" type="hidden" />

                <div class="col-md-12">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap" >
                                <thead  class="bg-success text-white">
                                    <tr>
                                        <th class="text-white">Parameter Name</th>
                                        <th class="text-white">Referance Range</th>
                                        <th class="text-white">Unit</th>
                                        <th class="text-white">Result</th>
                                        <th class="text-white">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($radiologyParameterResult as $key=>$value)
                                    <input type="hidden" name="id[]" value="{{ $value->id }}" />
                                        <tr>
                                            <td>{{ @$value->parameter_name }}</td>
                                            <td>{!! @$value->reference_range !!}
                                            </td>
                                            <td>{!! @$value->unit_name !!}</td>
                                            <td><input type="text" name="report_value[]" value="{{ @$value->report_value }}" required="" /></td>
                                            <td><textarea class="form-control" name="parameter_description[]">{{ @$value->parameter_description }}</textarea></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center m-auto mb-4">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Save Test Result</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
    function result1(val){
            var parameter2 = ($('#parameter1').val()) * (10/100);
            $('#parameter2').val(parameter2); 
    }
</script>

@endsection