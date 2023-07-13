@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Patient List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        {{-- @can('add patient')
                        <a href="{{ route('import-patient') }}" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i>
                        Import Patient </a>
                        @endcan --}}
                        @can('add patient')
                        <a href="{{ route('add_new_patient') }}" class="btn btn-primary btn-sm"><i class="fa fa-hospital-user"></i></i> Add New Patient </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header d-block">
            <form action="{{ route('patient_details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_first_name" value="{{ @$request_data['patient_first_name'] }}" placeholder="Search By Patient Name ....." />
                    </div>
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_uhid"  value="{{ @$request_data['patient_uhid'] }}" placeholder="Search By Patient UHID ....." />
                    </div>
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_phone_no"  value="{{ @$request_data['patient_phone_no'] }}" placeholder="Search By Patient Phone No ....." />
                    </div>
                    <div class="col-md-3 card-title">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> Search</button>
                        <a class="btn btn-primary btn-sm" href="{{ route('patient_details') }}"><i class="fa fa-list"></i> All Patient</a>
                    </div>
                </div>
            </form>
        </div>

        @include('message.notification')

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap border-left border-right border-bottom">
                        <thead class="bg-primary text-white">
                            <tr class="border-left">
                                <th  class="text-white">UHID</th>
                                <th  class="text-white">Patient Name</th>
                                <th  class="text-white">Guardian Name </th>
                                <th  class="text-white">Gender</th>
                                <th  class="text-white">Age</th>
                                <th  class="text-white">Phone</th>
                                <th  class="text-white">Address</th>
                                <th  class="text-white">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(@$all_patient[0]->id != null)
                            @foreach ($all_patient as $all_patients)
                            <tr>
                                <td><a href="{{ route('patient-details-profile', base64_encode($all_patients->id)) }}" class="textlink">{{ $all_patients->id }}</a>
                                </td>
                                <td>{{ $all_patients->prefix }} {{ $all_patients->first_name }}
                                    {{ $all_patients->middle_name }} {{ $all_patients->last_name }}
                                </td>
                                <td>{{ $all_patients->guardian_name_realation }} {{ $all_patients->guardian_name }}
                                </td>
                                <td>{{ $all_patients->gender }}</td>
                                <td>
                                    {{@$all_patients->year == '0' ?'':$all_patients->year.'Y'}}
                                    {{@$all_patients->month == '0' ?'':$all_patients->month.'M'}}
                                    {{@$all_patients->day == '0' ?'':$all_patients->day.'D'}}
                                </td>
                                <td>{{ $all_patients->phone }}</td>
                                <td>{{ $all_patients->address }},{{ @$all_patients->_district->name }},<br>{{
                                    @$all_patients->_state->name}},{{ $all_patients->pin_no }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href="{{ route('patient-details-profile', base64_encode($all_patients->id)) }}"><i class="fa fa-eye"></i> View</a>
                                            @can('edit patient')
                                            <a class="dropdown-item" href="{{ route('edit-patient-details', base64_encode($all_patients->id)) }}">
                                                <i class="fa fa-edit"></i> Edit</a>
                                            @endcan
                                            @can('delete patient')
                                            <a class="dropdown-item" href="{{ route('delete-patient-details', base64_encode($all_patients->id)) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                            @can('OPD registation')
                                            <a class="dropdown-item" href="{{ route('opd-registration', base64_encode($all_patients->id)) }}"><i class="fa fa-file-alt"></i> OPD Registation</a>
                                            @endcan
                                            @can('Emg registation')
                                            <a class="dropdown-item" href="{{ route('emg-registation', base64_encode($all_patients->id)) }}"><i class="fa fa-file-alt"></i> EMG Registation</a>
                                            @endcan
                                            @can('Ipd Admission')
                                            <a class="dropdown-item" href="{{ route('direct-ipd-admission', $all_patients->id) }}"><i class="fa fa-bed"></i> Admission</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" style="text-align: center;">
                                    <img src="{{ asset('public/no_found_data/no_data.png') }}" alt="loader" width="400px"
                                    height="160px">
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-2">
                         {!! $all_patient->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection