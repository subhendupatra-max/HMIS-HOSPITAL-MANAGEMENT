@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">OPD Patient List </h4>
                </div>
                @can('OPD registation')
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i class="fa fa-plus"></i> OPD Registaion</a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('error') }}</div>
        @endif

        <div class="card-body">
            <table id="example" class="table table-borderless text-nowrap key-buttons">
                <thead>
                    <tr>
                        <th scope="col">OPD Id</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Gurdian Name</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Last Visit Details</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($opd_registaion_list))
                    @foreach ($opd_registaion_list as $value)
                    <tr>
                        <td><a class="textlink" href="{{route('opd-profile',['id'=>base64_encode($value->id)])}}">{{ @$value->opd_prefix }}{{ @$value->id }}</a></td>
                        <td>
                            {{ @$value->all_patient_details->prefix }} {{ @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name }} {{ @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id }})<br>
                            <i class="fa fa-venus-mars text-primary"></i> {{ @$value->all_patient_details->gender }} <i class="fa fa-calendar-plus-o text-primary"></i> {{ @$value->all_patient_details->year }}Y {{ @$value->all_patient_details->month }}M {{ @$value->all_patient_details->day }}D

                        </td>
                        <td>{{ @$value->all_patient_details->guardian_name }}</td>
                        <td>{{ @$value->all_patient_details->phone }}</td>

                        <td>
                            @if(isset($value->latest_opd_visit_details_for_patient->department_id))
                            <i class="fa fa-cubes text-primary"></i> {{ @$value->latest_opd_visit_details_for_patient->department_details->department_name }} <br>
                            @endif
                            @if(isset($value->latest_opd_visit_details_for_patient->cons_doctor))
                            <i class="fas fa-user-md text-primary"></i> {{ @$value->latest_opd_visit_details_for_patient->doctor->first_name }} {{ @$value->latest_opd_visit_details_for_patient->doctor->last_name }}<br>
                            @endif
                            @if(isset($value->latest_opd_visit_details_for_patient->appointment_date))
                            <i class="fa fa-calendar text-primary"></i> {{ date('d-m-Y h:i A',strtotime($value->latest_opd_visit_details_for_patient->appointment_date)) }}
                            @endif
                        </td>
                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    @can('OPD registation')
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-exchange-alt"></i> Recheckup
                                    </a>
                                    @endcan
                                    <a class="dropdown-item" href="{{route('opd-profile',['id'=>base64_encode($value->id)])}}"><i class="fa fa-eye"></i> View</a>
                                    @can('edit patient')
                                    <a class="dropdown-item" href="">
                                        <i class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('delete patient')
                                    <a class="dropdown-item" href=""><i class="fa fa-trash"></i> Delete</a>
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

<div class="modal" id="modaldemo2">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Select New / Old Patient</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('after-new-old')}}" method="post">
                @csrf
                <div class="modal-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="patient_type" value="new_patient">
                        <span class="custom-control-label" Style="color:rgb(7, 73, 1);font-weight: 500;font-size: 14px;">New Patient</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="patient_type" value="old_patient">
                        <span class="custom-control-label" Style="color:brown;font-weight: 500;
                        font-size: 14px;">Old Patient</span>
                    </label>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary text-right" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection