@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold">{{ @$patient_details->prefix }} {{
                        @$patient_details->first_name }} {{ @$patient_details->middle_name }} {{ @$patient_details->last_name }} ( {{
                        @$patient_details->patient_prefix }}{{ @$patient_details->id }} ) <i
                            class="fa fa-check-circle text-success"></i></h4>
                </div>

                <div class="col-md-6 text-right">

                    @can('edit patient')
                    <a href="{{ route('edit-patient-details', base64_encode($patient_details->id)) }}"
                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Details</a>
                    @endcan

                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" style="">

                        <a class="dropdown-item" href="{{ route('opd-registration', base64_encode($patient_details->id)) }}"><i class="fa fa-plus"></i> OPD Registation</a>
                        <a class="dropdown-item" href="{{ route('emg-registation', base64_encode($patient_details->id)) }}"><i class="fa fa-stethoscope"></i> EMG Registation</a>
                    </div>

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
                                        <td class="py-2 px-5">
                                            {!!$patient_details->address!!},{!!$patient_details->pin_no!!},{!!@$patient_details->_district->name!!},{!!
                                            @$patient_details->_state->name!!},{!!
                                            @$patient_details->_country->country_name!!}</td>
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
                                        <td class="py-2 px-5">{{ @$patient_details->identification_name }} : {{
                                            @$patient_details->identification_number }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Opd Registation Details </h5>
                <div class="col-md-12">
                    <table class="table card-table table-vcenter text-nowrap table-default">
                        <thead>
                            <tr>
                                <th scope="col">OPD Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Last Visit Details</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($opd_registaion_list))
                            @foreach ($opd_registaion_list as $value)
                            <tr>
                                <td><a class="textlink"
                                        href="{{ route('opd-profile', ['id' => base64_encode($value->id)]) }}">{{
                                        @$value->id }}</a>
                                </td>
                                <td>
                                    {{ @$value->all_patient_details->prefix }}
                                    {{ @$value->all_patient_details->first_name }}
                                    {{ @$value->all_patient_details->middle_name }}
                                    {{ @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id
                                    }})<br>
                                    <i class="fa fa-venus-mars text-primary"></i>
                                    {{ @$value->all_patient_details->gender }} <i
                                        class="fa fa-calendar-plus-o text-primary"></i>
                                    @if (@$value->all_patient_details->year != 0)
                                    {{ @$value->all_patient_details->year }}y
                                    @endif
                                    @if (@$value->all_patient_details->month != 0)
                                    {{ @$value->all_patient_details->month }}m
                                    @endif
                                    @if (@$value->all_patient_details->day != 0)
                                    {{ @$value->all_patient_details->day }}d
                                    @endif

                                </td>
                                <td>{{ @$value->all_patient_details->guardian_name }}</td>
                                <td>{{ @$value->all_patient_details->phone }}</td>
                                <td>{{ @$value->case_id }}</td>
                                <td>
                                    @if (isset($value->latest_opd_visit_details_for_patient->department_id))
                                    <i class="fa fa-cubes text-primary"></i>
                                    {{
                                    @$value->latest_opd_visit_details_for_patient->department_details->department_name
                                    }}
                                    <br>
                                    @endif
                                    @if (isset($value->latest_opd_visit_details_for_patient->cons_doctor))
                                    <i class="fas fa-user-md text-primary"></i>
                                    {{ @$value->latest_opd_visit_details_for_patient->doctor->first_name }}
                                    {{ @$value->latest_opd_visit_details_for_patient->doctor->last_name }}<br>
                                    @endif
                                    @if (isset($value->latest_opd_visit_details_for_patient->appointment_date))
                                    <i class="fa fa-calendar text-primary"></i>
                                    {{ date('d-m-Y h:i A',
                                    strtotime($value->latest_opd_visit_details_for_patient->appointment_date)) }}
                                    @endif
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"> <i
                                                class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item"
                                                href="{{ route('opd-profile', ['id' => base64_encode($value->id)]) }}"><i
                                                    class="fa fa-eye"></i> View</a>

                                            <a class="dropdown-item"
                                                href="{{ route('print-opd-patient', base64_encode(@$value->latest_opd_visit_details_for_patient->id)) }}"><i
                                                    class="fa fa-print"></i>
                                                Print</a>
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
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Emg Registation Details </h5>
                <div class="col-md-12">
                    <table class="table card-table table-vcenter text-nowrap table-default">
                        <thead>
                            <tr>
                                <th scope="col">Emg Id</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">G. Name/P. Type</th>
                                <th scope="col">Medico Legal Case</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($emg_registaion_list))
                            @foreach ($emg_registaion_list as $value)
                            <tr>

                                <td><a class="textlink"
                                        href="{{route('emg-patient-profile',['id'=>base64_encode($value->id)])}}">{{
                                        @$value->emg_prefix }}{{ @$value->id }}</a></td>
                                <td>
                                    {{ @$value->all_patient_details->prefix }} {{
                                    @$value->all_patient_details->first_name }} {{
                                    @$value->all_patient_details->middle_name }} {{
                                    @$value->all_patient_details->last_name }} ({{ @$value->all_patient_details->id
                                    }})<br>
                                    <i class="fa fa-venus-mars text-primary"></i> {{
                                    @$value->all_patient_details->gender }} <i
                                        class="fa fa-calendar-plus-o text-primary"></i> {{
                                    @$value->all_patient_details->year }}Y {{ @$value->all_patient_details->month }}M {{
                                    @$value->all_patient_details->day }}D
                                </td>
                                <td>{{ @$value->all_patient_details->phone }}</td>
                                <td>
                                    <i class="fa fa-user-secret text-primary"></i> {{
                                    @$value->all_patient_details->guardian_name }}<br>
                                    <i class="fa fa-adjust text-primary"></i> {{
                                    @$value->all_emg_visit_details->patient_type }}
                                </td>
                                <td>{{ @$value->all_emg_visit_details->medico_legal_case }}</td>
                                <td>
                                    @if(isset($value->all_emg_visit_details->appointment_date))
                                    {{ date('d-m-Y h:i A',strtotime($value->all_emg_visit_details->appointment_date)) }}
                                    @endif
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"> <i
                                                class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item"
                                                href="{{route('emg-patient-profile',['id'=>base64_encode($value->id)])}}"><i
                                                    class="fa fa-eye"></i> View</a>

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
            <div class="card-body border-top">
                <h5 class="font-weight-bold">IPD Registation Details </h5>
                <div class="col-md-12">
                    <table class="table card-table table-vcenter text-nowrap table-default">
                        <thead>
                            <tr>
                                <th scope="col">IPD Id</th>
                                <th scope="col">Patient Information</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Admission Information</th>
                                <th scope="col">Admission Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($ipd_patient_list))
                            @foreach ($ipd_patient_list as $value)
                            <tr>
                                <td><a class="textlink"
                                        href="{{route('ipd-profile',['id'=>base64_encode($value->id)])}}">{{
                                        @$value->ipd_prefix }}{{ @$value->id }}</a></td>
                                <td>
                                    <i class="fa fa-user text-primary"></i> {{ @$value->all_patient_details->prefix }}
                                    {{ @$value->all_patient_details->first_name }} {{
                                    @$value->all_patient_details->middle_name }} {{
                                    @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id }})
                                    <br>
                                    <i class="fa fa-users text-primary"></i>
                                    {{ @$value->all_patient_details->guardian_name }}
                                    <br>
                                    <i class="fa fa-venus-mars text-primary"></i> {{
                                    @$value->all_patient_details->gender }} //


                                    <i class="fa fa-calendar-plus-o text-primary"></i> {{
                                    @$value->all_patient_details->year }}Y {{ @$value->all_patient_details->month }}M {{
                                    @$value->all_patient_details->day }}D

                                </td>
                                <td>{{ @$value->all_patient_details->phone }}</td>
                                <td>
                                    @if(isset($value->department_id))
                                    <i class="fa fa-cubes text-primary"></i> {{
                                    @$value->department_details->department_name }}( {{
                                    @$value->department_details->department_code }}) <br>
                                    @endif
                                    @if(isset($value->cons_doctor))
                                    <i class="fas fa-user-md text-primary"></i> {{ @$value->doctor_details->first_name
                                    }} {{ @$value->doctor_details->last_name }} <br>
                                    @endif
                                    @if(isset($value->bed_ward_id))
                                    <i class="fa fa-bed text-primary"></i> {{ @$value->bed_details->bed_name }} - {{
                                    @$value->ward_details->ward_name }} - {{ @$value->unit_details->bedUnit_name }}
                                    @endif
                                </td>
                                <td>
                                    {{ date('d-m-Y h:i A',strtotime($value->appointment_date)) }}
                                </td>
                                <td>
                                    @if($value->status == 'admitted')
                                    <span class="badge badge-success">Admission</span>
                                    @elseif ($value->status == 'discharged_planed')
                                    <span class="badge badge-warning">Discharge Planed</span>
                                    @else
                                    <span class="badge badge-secondary">Discharged</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"> <i
                                                class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> View</a>
                                            @can('')
                                            <a class="dropdown-item" href=""><i class="fa fa-print"></i> Print Admission
                                                Form</a>
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