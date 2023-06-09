@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title"> Discharged Patient List </h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        {{-- @can('')
                        <a href="#" class="btn btn-primary btn-sm"><i
                                class="fa-sharp fa-light fa-cart-flatbed-suitcase"></i>
                            Add Patient</a>
                        @endcan --}}

                        <!-- @can('') -->
                        <!-- <a href="{{ route('all-discharged-patient-in-ipd') }}" class="btn btn-primary btn-sm"><i class="fa-sharp fa-light fa-cart-flatbed-suitcase"></i>
                            Discharged Patient</a> -->
                        <!-- @endcan -->

                    </div>
                </div>
            </div>

        </div>
        @include('message.notification')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap" id="example">
                    <thead>
                        <tr>
                            <th scope="col">SL No.</th>
                            <th scope="col">IPD Id</th>
                            <th scope="col">Case Id</th>
                            <th scope="col">Patient Information</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Admission Information</th>
                            <th scope="col">Admission Date</th>
                            <th scope="col">Discharged Date</th>
                            <th scope="col">Discharged Status</th>
                            <th scope="col">Admitted By</th>
                            <th scope="col">Status</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($ipd_patient_list))
                        @foreach ($ipd_patient_list as $value)
                        <?php $discharged_status = DB::table('discharged_patients')->where('ipd_id',$value->id)->first(); ?>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                                {{ date('d-m-Y h:i A',strtotime($value->appointment_date)) }}
                            </td>
                            <td>
                                {{ date('d-m-Y h:i A',strtotime($value->discharged_date)) }}
                            </td>
                            <td>
                                {{ $discharged_status->discharge_status }}
                            </td>
                        
                            <td>
                                {{ @$value->admitted_by }}<br>
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
                         
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
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