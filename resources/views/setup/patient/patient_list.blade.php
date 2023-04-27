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
                        <a href="{{ route('import-patient') }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-upload"></i>
                            Import Patient </a>
                        @endcan --}}
                        @can('add patient')
                        <a href="{{ route('add_new_patient') }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-hospital-user"></i></i> Add New Patient </a>
                        @endcan
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
                                <th class="border-bottom-0">UHID</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Guardian Name </th>
                                <th class="border-bottom-0">Gender</th>
                                <th class="border-bottom-0">Age</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($all_patient as $all_patients)
                            <tr>

                                <td><a href="{{ route('patient-details-profile', base64_encode($all_patients->id)) }}"
                                        class="textlink">{{ $all_patients->patient_prefix }}{{ $all_patients->id }}</a>
                                </td>
                                <td>{{ $all_patients->prefix }} {{ $all_patients->first_name }}
                                    {{ $all_patients->middle_name }} {{ $all_patients->last_name }}
                                </td>
                                <td>{{ $all_patients->guardian_name_realation }} {{ $all_patients->guardian_name }}
                                </td>
                                <td>{{ $all_patients->gender }}</td>
                                <td>{{ $all_patients->year }}y {{ $all_patients->month }}m {{ $all_patients->day }}d
                                </td>
                                <td>{{ $all_patients->address }},{{ @$all_patients->_district->name }},<br>{{
                                    @$all_patients->_state->name}},{{ $all_patients->pin_no }}</td>
                                <td>


                                    <div class="card-options">

                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"> <i
                                                class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item"
                                                href="{{ route('view-new-patient', base64_encode($all_patients->id)) }}"><i
                                                    class="fa fa-eye"></i> View</a>
                                            @can('edit patient')
                                            <a class="dropdown-item"
                                                href="{{ route('edit-patient-details', base64_encode($all_patients->id)) }}">
                                                <i class="fa fa-edit"></i> Edit</a>
                                            @endcan
                                            @can('delete patient')
                                            <a class="dropdown-item"
                                                href="{{ route('delete-patient-details', base64_encode($all_patients->id)) }}"><i
                                                    class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                            @can('OPD registation')
                                            <a class="dropdown-item"
                                                href="{{ route('opd-registration', base64_encode($all_patients->id)) }}"><i
                                                    class="fa fa-file-alt"></i> OPD Registation</a>
                                            @endcan
                                            @can('Emg registation')
                                            <a class="dropdown-item"
                                                href="{{ route('emg-registation', base64_encode($all_patients->id)) }}"><i
                                                    class="fa fa-file-alt"></i> EMG Registation</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    @endsection