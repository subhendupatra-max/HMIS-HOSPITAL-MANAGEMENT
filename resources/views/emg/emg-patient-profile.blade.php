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
                        <a class="btn btn-primary btn-sm" data-placement="top" data-toggle="tooltip" title="Move to IPD" href="{{ route('ipd-registation-from-emg', ['id' => base64_encode($emg_patient_details->id), 'patient_source' => 'emg', 'source_id' => '$emg_patient_details->id']) }}"><i class="fa fa-address-card"></i> Admission</a>

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('emg.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            @include('emg.include.patient-name')
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                {{-- ========================================================================================= --}}
                <div class="col-lg-4 col-xl-4 border-right">

                    {{-- ================== patient name ====================== --}}
                    <!-- <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span class="profileHeding">{{ @$emg_patient_details->patient_details->first_name }}
                                    {{ @$emg_patient_details->patient_details->middle_name }}
                                    {{ @$emg_patient_details->patient_details->last_name }}({{ @$emg_patient_details->patient_details->patient_prefix }}{{ @$emg_patient_details->patient_details->id }})</span>
                            </div>
                        </div>
                    </div> -->
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
                                        {{ @$emg_patient_details->patient_details->gender }}
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
                                        {{ @$emg_patient_details->patient_details->guardian_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-mobile-alt text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Mobile No :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$emg_patient_details->patient_details->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-calendar text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Age :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$emg_patient_details->patient_details->year == '0'?'':$emg_patient_details->patient_details->year.'Y' }}
                                        {{ @$emg_patient_details->patient_details->month == '0'?'':$emg_patient_details->patient_details->month.'M' }}
                                        {{ @$emg_patient_details->patient_details->day == '0'?'':$emg_patient_details->patient_details->day.'D' }}

                                    </td>
                                </tr>
                                <tr colspan="2">
                                    <td class="py-2 px-0"><i class="fa fa-map-pin text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Address :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$emg_patient_details->patient_details->address }},{{ @$emg_patient_details->patient_state->name }}
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
                                        <span class="font-weight-semibold w-50">Emg Id :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{$emg_patient_details->emg_prefix}}{{$emg_patient_details->id}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-calendar text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Appointment Date :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ date('d-m-Y h:i A',strtotime(@$emg_patient_details->all_emg_visit_details->appointment_date)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-user text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50"> Patient Type :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ $emg_patient_details->all_emg_visit_details->patient_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-cube text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50"> Case Id :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ $emg_patient_details->case_id }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- ================== patient registation information ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span style="font-weight: bold; font-size: 15px;">Total Payment Amount : ₹{{ $payment_amount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span style="font-weight: bold; font-size: 15px;">Total Billing Amount : ₹{{ $billing_amount }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- ========================================================================================= --}}

                {{-- ========================================================================================= --}}
                <div class="col-lg-8 col-xl-8 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Latest Physical Condition</h5>
                                @if (@$PhysicalDetails[0]->height != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-danger">
                                        <thead class="bg-danger text-white">
                                            <tr>
                                                <th class="text-white">Height</th>
                                                <th class="text-white">Weight</th>
                                                <th class="text-white">Pulse</th>
                                                <th class="text-white">BP</th>
                                                <th class="text-white">Temp</th>
                                                <th class="text-white">Resp</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($PhysicalDetails as $item)
                                            <tr>
                                                <td>{{@$item->height == null ?'':$item->height.' cm'}}</td>
                                                <td>{{@$item->weight == null ?'':$item->weight.' kg'}}</td>
                                                <td>{{@$item->pulse == null ?'':$item->pulse.' bpm'}}</td>
                                                <td>{{@$item->bp == null ?'':$item->bp.' mmHg'}}</td>
                                                <td>{{@$item->temperature == null ?'':$item->temperature.' °C'}}</td>
                                                <td>{{@$item->respiration == null ?'':$item->respiration.' b/m'}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Physical condition added **</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Pathology Test</h5>
                                @if (@$PathologyTestDetails[0]->id != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Test Name</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Billing Status</th>
                                                <th class="text-white">Test Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($PathologyTestDetails as $item)
                                            <tr>
                                                <td>{{ @$item->test_details->test_name }}</td>
                                                <td>{{@date('d-m-Y h:i A',strtotime($item->date))}}</td>
                                                <td>
                                                    @if($item->billing_status == '0')
                                                    <span class="badge badge-warning">Billing Not Done</span>
                                                    @elseif ($item->billing_status == '1')
                                                    <span class="badge badge-warning">Billing Done</span>
                                                    @else
                                                    <span class="badge badge-warning">Charge Added</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->test_status == '0')
                                                    <span class="badge badge-warning">Sample Not Collected</span>
                                                    @else
                                                    <span class="badge badge-success">Sample Collected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Pathology Test done **</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Radiology Test</h5>
                                @if (@$RadiologyTestDetails[0]->id != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Test Name</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Billing Status</th>
                                                <th class="text-white">Test Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($RadiologyTestDetails as $item)
                                            <tr>
                                                <td>{{ @$item->test_details->test_name }}</td>
                                                <td>{{@date('d-m-Y h:i A',strtotime($item->date))}}</td>
                                                <td>
                                                    @if($item->billing_status == '0')
                                                    <span class="badge badge-warning">Billing Not Done</span>
                                                    @elseif ($item->billing_status == '1')
                                                    <span class="badge badge-warning">Billing Done</span>
                                                    @else
                                                    <span class="badge badge-warning">Charge Added</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->test_status == '0')
                                                    <span class="badge badge-warning">Sample Not Collected</span>
                                                    @else
                                                    <span class="badge badge-success">Sample Collected</span>
                                                    @endif
                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Radiology Test done **</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Blood Issue Details</h5>
                                @if (@$blood_details[0]->id != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Blood Group</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Bag</th>
                                                <th class="text-white">Blood Quentity</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($blood_details as $item)
                                            <tr>
                                                <td>{{@$item->blood_group_details->blood_group_name}}</td>
                                                <td> {{@$item->issue_date}}</td>
                                                <td> {{@$item->bag}}</td>
                                                <td> {{@$item->blood_qty}}</td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Blood Issued **</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Blood Components Issue Details</h5>
                                @if (@$blood_details[0]->id != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Blood Group</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Bag</th>
                                                <th class="text-white">Blood Components Quentity</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($components_details as $item)
                                            <tr>
                                                <td>{{@$item->blood_group_details->blood_group_name}}</td>
                                                <td> {{@$item->issue_date}}</td>
                                                <td> {{@$item->bag}}</td>
                                                <td> {{@$item->components_qty}}</td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Blood Components Issued **</span>
                                @endif
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