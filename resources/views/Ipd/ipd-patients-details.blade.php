@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">IPD Patient List </h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('Ipd Admission')
                        <a href="{{ route('direct-ipd-admission') }}" class="btn btn-primary btn-sm"><i class="fa fa-bed"></i>
                            Admission</a>
                        @endcan
                        @can('Discharged Patient List')
                        <a href="{{ route('all-discharged-patient-in-ipd') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i>
                            Discharged Patient</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header d-block">
            <form action="{{ route('ipd-patient-listing') }}" method="POST">
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
                        <input type="text" name="ipd_id"  value="{{ @$request_data['ipd_id'] }}" placeholder="IPD Id ....." />
                    </div>
                    <div class="col-md-1 card-title">
                        <input type="text" name="case_id"  value="@if(@$request_data['case_id'] != null){{ $request_data['case_id'] }} @endif" placeholder="Case Id ....." />
                    </div>
                    <div class="col-md-2 card-title">
                        <input type="date" style="margin: 6px 0px 0px 0px" name="appointment_date"  value="{{ @$request_data['appointment_date'] }}" />
                    </div>
                    <div class="col-md-2 card-title">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> Search</button>
                        <a class="btn btn-primary btn-sm" href="{{ route('ipd-patient-listing') }}"><i class="fa fa-list"></i> All List</a>
                    </div>
                </div>
            </form>
        </div>
        @include('message.notification')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover card-table table-vcenter text-nowrap border-left border-right border-bottom">
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                            <th class="text-white">IPD Id</th>
                            <th class="text-white">Case Id</th>
                            <th class="text-white">Patient Details</th>
                            <th class="text-white">Mobile No.</th>
                            <th class="text-white">Admission Details</th>
                            <th class="text-white">Patient Type</th>
                            <th class="text-white">Admission Date</th>
                            <th class="text-white">Admitted By</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (@$ipd_patient_list[0]->id != null)
                        @foreach ($ipd_patient_list as $value)
                        <tr>
                            <td><a class="textlink" href="{{route('ipd-profile',['id'=>base64_encode($value->id)])}}">{{ @$value->id }}</a></td>
                            <td>{{ @$value->case_id }}</td>
                            <td>
                                <i class="fa fa-user text-primary"></i> {{ @$value->all_patient_details->prefix }} {{
                                @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name
                                }} {{ @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id }})
                                <br>
                                <i class="fa fa-users text-primary"></i>
                                {{ @$value->all_patient_details->guardian_name }}
                                <br>
                                <i class="fa fa-venus-mars text-primary"></i> {{ @$value->all_patient_details->gender }}
                                //
                                <i class="fa fa-calendar-plus-o text-primary"></i> {{ @$value->all_patient_details->year
                                }}Y {{ @$value->all_patient_details->month }}M {{ @$value->all_patient_details->day }}D

                            </td>
                            <td>{{ @$value->all_patient_details->phone }}</td>
                            <td>
                                @if(isset($value->department_id))
                                <i class="fa fa-cubes text-primary"></i> {{ @$value->department_details->department_name
                                }}( {{ @$value->department_details->department_code }}) <br>
                                @endif
                                @if(isset($value->cons_doctor))
                                <i class="fas fa-user-md text-primary"></i> {{ @$value->doctor_details->first_name }} {{
                                @$value->doctor_details->last_name }} <br>
                                @endif
                                @if(isset($value->bed_ward_id))
                                <i class="fa fa-bed text-primary"></i> {{ @$value->bed_details->bed_name }} - {{
                                @$value->ward_details->ward_name }} - {{ @$value->unit_details->bedUnit_name }}
                                @endif
                            </td>
                            <td>
                                <i class="fa fa-adjust text-primary"></i> {{ @$value->patient_type }}
                                @if(@$value->tpa_organization != null)
                                <br>
                                <i class="fa fa-adjust text-primary"></i> {{ @$value->tpa_details->TPA_name }}
                                @endif
                               
                                @if(@$value->type_no != null)
                                <br>
                                <i class="fa fa-adjust text-primary"></i> {{ @$value->type_no }}
                                @endif
                            </td>
                            <td>
                                {{ date('d-m-Y h:i A',strtotime($value->appointment_date)) }}
                            </td>
                            <td>
                                {{ @$value->admitted_by}}<br>
                                {{ @$value->admitted_by_contact_no }}
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
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href=""><i class="fa fa-eye"></i> View</a>
                                        {{-- @can('')
                                        <a class="dropdown-item" href=""><i class="fa fa-print"></i> Print Admission
                                            Form</a>
                                        @endcan --}}
                                        {{-- @can('ipd status change')
                                        <a class="dropdown-item" href="#" onclick="statusButton(<?php echo $value->id; ?>)">
                                            <i class="fa fa-file"></i> Status Change</a>
                                        @endcan --}}
                                        @can('')

                                        <a class="dropdown-item" href="{{ route('edit-ipd-registation',['ipd_id'=>base64_encode($value->id) ])}}">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('ipd delete')
                                        <a class="dropdown-item" href="{{ route('ipd-patient-delete',['ipd_id'=>base64_encode($value->id) ])}}"><i class="fa fa-trash"></i> Delete</a>
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
                    {!! $ipd_patient_list->links() !!}
                </div> 
            </div>
        </div>

    </div>
</div>



{{-- ====================patient status change(admission/discharged planed/discharged) ================== --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Patient Status Change
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-status-ipd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="ipd_id" id="ipd_id_" />
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select......</option>
                                <option value="discharged_planed">Discharged Planed</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" required>
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ====================patient status change(admission/discharged planed/discharged) ================== --}}


<script>
    function statusButton(ipd_id) {
        $.ajax({
            url: "{{ route('ipd-patient-status-change') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                ipdId: ipd_id,
            },
            success: function(response) {
                console.log(response);
                $("#ipd_id_").val(response.id);
                $("#exampleModal").modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection