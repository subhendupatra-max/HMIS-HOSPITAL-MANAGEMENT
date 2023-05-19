@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Emg Patient List </h4>
                </div>
                @can('emg registation')
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i class="fa fa-plus"></i> Emg Registaion</a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->
        @include('message.notification')
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-nowrap" id="example">
                    <thead>
                        <tr>
                            <th scope="col">Emg Id</th>
                            <th scope="col">Case Id</th>
                            <th scope="col">Patient</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">G. Name/P. Type</th>
                            <th scope="col">Appointment Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($emg_registaion_list))
                        @foreach ($emg_registaion_list as $value)
                        <tr>

                            <td><a class="textlink" href="{{route('emg-patient-profile',['id'=>base64_encode($value->id)])}}">{{ @$value->id }}</a></td>
                            <td>{{ @$value->case_id }}</td>
                            <td>
                                {{ @$value->all_patient_details->prefix }} {{ @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name }} {{ @$value->all_patient_details->last_name }} ({{ @$value->all_patient_details->id }})<br>
                                <i class="fa fa-venus-mars text-primary"></i> {{ @$value->all_patient_details->gender }} <i class="fa fa-calendar-plus-o text-primary"></i> {{ @$value->all_patient_details->year }}Y {{ @$value->all_patient_details->month }}M {{ @$value->all_patient_details->day }}D
                            </td>
                            <td>{{ @$value->all_patient_details->phone }}</td>
                            <td>
                                <i class="fa fa-user-secret text-primary"></i> {{ @$value->all_patient_details->guardian_name }}<br>
                                <i class="fa fa-adjust text-primary"></i> {{ @$value->all_emg_visit_details->patient_type }}
                            </td>
                      
                            <td>
                                @if(isset($value->all_emg_visit_details->appointment_date))
                                {{ date('d-m-Y h:i A',strtotime($value->all_emg_visit_details->appointment_date)) }}
                                @endif
                            </td>
                            <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">

                                        <a class="dropdown-item" href="{{route('emg-patient-profile',['id'=>base64_encode($value->id)])}}"><i class="fa fa-eye"></i> View</a>
                                        @can('edit emg registation')
                                        <a class="dropdown-item" href="">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('print emg registation copy')
                                        <a class="dropdown-item" href="{{route('print-emg-registation',['id'=>base64_encode($value->id)])}}">
                                            <i class="fa fa-print"></i> Print</a>
                                        @endcan
                                        @can('delete emg registation')
                                        <a class="dropdown-item" href="{{route('delete-emg-registation',['id'=>base64_encode($value->id)])}}"><i class="fa fa-trash"></i> Delete</a>
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

<div class="modal" id="modaldemo2">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Select New / Old Patient</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('emg-after-new-old')}}" method="post">
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