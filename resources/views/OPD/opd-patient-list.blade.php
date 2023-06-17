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
                        <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i
                                class="fa fa-plus"></i> OPD Registation</a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        <div class="card-header d-block">
            <form action="{{ route('OPD-Patient-list') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_first_name" value="{{ @$request_data['patient_first_name'] }}" placeholder="Search By Patient Name ....." />
                    </div>
                    <div class="col-md-2 card-title">
                        <input type="text" name="patient_uhid"  value="{{ @$request_data['patient_uhid'] }}" placeholder="Search By Patient UHID ....." />
                    </div>
                    <div class="col-md-1 card-title">
                        <input type="text" name="patient_phone_no"  value="{{ @$request_data['patient_phone_no'] }}" placeholder="Phone No ....." />
                    </div>
                    <div class="col-md-1 card-title">
                        <input type="text" name="opd_id"  value="{{ @$request_data['opd_id'] }}" placeholder="OPD Id ....." />
                    </div>
                    <div class="col-md-1 card-title">
                        <input type="text" name="case_id"  value="@if(@$request_data['case_id'] != null){{ $request_data['case_id'] }} @endif" placeholder="Case Id ....." />
                    </div>
                    <div class="col-md-2 card-title">
                        <input type="date" style="margin: 6px 0px 0px 0px" name="appointment_date"  value="{{ @$request_data['appointment_date'] }}" />
                    </div>
                    <div class="col-md-2 card-title">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> Search</button>
                        <a class="btn btn-primary btn-sm" href="{{ route('OPD-Patient-list') }}"><i class="fa fa-list"></i> All List</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- ================================ Alert Message===================================== -->

        @include('message.notification')

        <div class="card-body">
            <table class="table table-hover card-table table-vcenter text-nowrap border-left border-right border-bottom">
                <thead class="bg-primary text-white">
                    <tr class="border-left">
                        <th  class="text-white">OPD Id</th>
                        <th  class="text-white">Patient Name</th>
                        <th  class="text-white">Gurdian Name</th>
                        <th  class="text-white">Mobile No.</th>
                        <th  class="text-white">Case Id</th>
                        <th class="text-white">Patient Type</th>
                        <th  class="text-white">Visit Details</th>
                        <th  class="text-white">Appointment Date</th>
                        <th  class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(@$opd_registaion_list[0]->id != null)
                    @foreach ($opd_registaion_list as $value)
                    <tr>
                        <td><a class="textlink"
                                href="{{ route('opd-profile', ['id' => base64_encode($value->id)]) }}">{{ @$value->id }}</a>
                        </td>
                        <td>
                            {{ @$value->all_patient_details->prefix }}
                            {{ @$value->all_patient_details->first_name }}
                            {{ @$value->all_patient_details->middle_name }}
                            {{ @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id }})<br>
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
                            <i class="fa fa-adjust text-primary"></i> {{ @$value->latest_opd_visit_details_for_patient->patient_type }}

                            @if(@$value->latest_opd_visit_details_for_patient->tpa_organization != null)
                            <br>
                            <i class="fa fa-adjust text-primary"></i> {{ @$value->latest_opd_visit_details_for_patient->tpa_details->TPA_name }}
                            @endif
                            
                            @if(@$value->latest_opd_visit_details_for_patient->type_no != null)
                            <br>
                            <i class="fa fa-adjust text-primary"></i> {{ @$value->latest_opd_visit_details_for_patient->type_no }}
                            @endif
                        </td>
                        <td>
                            @if (isset($value->latest_opd_visit_details_for_patient->department_id))
                            <i class="fa fa-cubes text-primary"></i>
                            {{ @$value->latest_opd_visit_details_for_patient->department_details->department_name }}
                            <br>
                            @endif
                            @if (isset($value->latest_opd_visit_details_for_patient->cons_doctor))
                            <i class="fas fa-user-md text-primary"></i>
                            {{ @$value->latest_opd_visit_details_for_patient->doctor->first_name }}
                            {{ @$value->latest_opd_visit_details_for_patient->doctor->last_name }}<br>
                            @endif
                           
                        </td>

                        <td>{{ date('d-m-Y h:i A',
                            strtotime(@$value->latest_opd_visit_details_for_patient->appointment_date)) }}</td>
                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    {{-- <a class="dropdown-item" href=""><i class="fa fa-file"></i> Bill Summary</a> --}}
                                    <a class="dropdown-item"
                                        href="{{ route('opd-profile', ['id' => base64_encode($value->id)]) }}"><i
                                            class="fa fa-eye"></i> View</a>
                                    @can('edit opd patient')
                                    <a class="dropdown-item" href="{{ route('edit-opd-patient', base64_encode($value->id)) }}">
                                        <i class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('delete opd patient')
                                    <a class="dropdown-item" href="{{ route('delete-opd-patient', base64_encode(@$value->latest_opd_visit_details_for_patient->id)) }}"><i class="fa fa-trash"></i>
                                         Delete</a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('print-opd-patient', base64_encode(@$value->latest_opd_visit_details_for_patient->id)) }}"><i class="fa fa-print"></i>
                                         Print</a>

                                    {{-- @can('opd billing')
                                    <a class="dropdown-item"
                                        href="{{ route('add-opd-billing',['id'=> base64_encode($value->id)]) }}"><i
                                            class="fa fa-money-bill"></i>
                                         Add Billing</a>
                                    @endcan --}}
                                    {{-- <a class="dropdown-item"
                                        href="{{ route('payment-listing-in-opd', ['id' => base64_encode($value->id)]) }}"><i
                                            class="fa fa-rupee-sign"></i> Take Payment</a>
                                    <a class="dropdown-item"  href="{{ route('ipd-registation-from-opd', ['id' => base64_encode($value->id), 'patient_source' => 'opd', 'source_id' => $value->id]) }}"><i class="fa fa-bed"></i> Admission</a> --}}

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
            @if(@$opd_registaion_list[0]->id != null)
            
            <div class="mt-2">
                {!! $opd_registaion_list->links() !!}
            </div> 
            @endif 
        </div>
    </div>
</div>

<div class="modal" id="modaldemo2">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Select New / Old Patient</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('after-new-old') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="patient_type" value="new_patient">
                        <span class="custom-control-label"
                            Style="color:rgb(7, 73, 1);font-weight: 500;font-size: 14px;">New Patient</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="patient_type" value="old_patient">
                        <span class="custom-control-label" Style="color:brown;font-weight: 500;
                        font-size: 14px;">Old
                            Patient</span>
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
