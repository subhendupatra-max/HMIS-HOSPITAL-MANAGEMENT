@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-pills-circle" id="tabs_2" role="tablist">
                {{-- ===========================nav menu=========================== --}}
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#profile" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-th"></i> Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#billing" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-file-alt"></i> Billing </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" href="{{ route('payment-listing-in-opd',['id' => base64_encode($opd_patient_details->id)]) }}" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-rupee-sign"></i> Payment </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" href="{{ route('timeline-lisitng-in-opd',['id' => base64_encode($opd_patient_details->id)]) }}" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="far fa-calendar-check"></i> Timeline </span>
                    </a>
                </li>
                {{-- ===========================nav menu=========================== --}}

                {{-- =========================== Button =========================== --}}
                <li class="nav-item" style="margin-left: auto;">
                    <a class="btn btn-primary btn-sm" data-placement="top" data-toggle="tooltip" title="Admission" href="{{ route('ipd-registation-from-opd', ['id' => base64_encode($opd_patient_details->id), 'patient_source' => 'opd', 'source_id' => '$opd_patient_details->emg_details_id']) }}"><i class="fa fa-address-card"></i></a>
                </li>
                {{-- =========================== Button =========================== --}}
            </ul>

            <div class="panel-body tabs-menu-body">
                <div class="tab-content">
                    {{-- =================== profile =========================== --}}
                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="profileHeding">{{ @$opd_patient_details->patient_details->first_name }}
                                    {{ @$opd_patient_details->patient_details->middle_name }}
                                    {{ @$opd_patient_details->patient_details->last_name }}({{ @$opd_patient_details->patient_details->patient_prefix }}{{ @$opd_patient_details->patient_details->id }})</span>
                                <hr class="hr_line">
                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table_border_none">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-2 px-0"><i class="fa fa-venus-mars text-primary"></i></td>
                                                        <td class="py-2 px-0">
                                                            <span class="font-weight-semibold w-50">Gender :- </span>
                                                        </td>
                                                        <td class="py-2 px-0">
                                                            {{ @$opd_patient_details->patient_details->gender }}
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
                                                            {{ @$opd_patient_details->patient_details->guardian_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0"><i class="fa fa-mobile-alt text-primary"></i></td>
                                                        <td class="py-2 px-0">
                                                            <span class="font-weight-semibold w-50">Mobile No :- </span>
                                                        </td>
                                                        <td class="py-2 px-0">
                                                            {{ @$opd_patient_details->patient_details->phone }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0"><i class="fa fa-calendar text-primary"></i></td>
                                                        <td class="py-2 px-0">
                                                            <span class="font-weight-semibold w-50">Age :- </span>
                                                        </td>
                                                        <td class="py-2 px-0">
                                                            {{ @$opd_patient_details->patient_details->year }}Y
                                                            {{ @$opd_patient_details->patient_details->month }}M
                                                            {{ @$opd_patient_details->patient_details->day }}D
                                                        </td>
                                                    </tr>
                                                    <tr colspan="2">
                                                        <td class="py-2 px-0"><i class="fa fa-map-pin text-primary"></i>
                                                        </td>
                                                        <td class="py-2 px-0">
                                                            <span class="font-weight-semibold w-50">Address :- </span>
                                                        </td>
                                                        <td class="py-2 px-0">
                                                            {{ @$opd_patient_details->patient_details->address }},{{ @$opd_patient_details->patient_state->name }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr class="hr_line">
                                            <table class="table table_border_none">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                            <i class="fa fa-rocket text-primary"></i>
                                                        </td>
                                                        <td class="py-2 px-0">
                                                            <span class="font-weight-semibold w-50">Opd Id :- </span>
                                                        </td>
                                                        <td class="py-2 px-0">
                                                            {{$opd_patient_details->opd_prefix}}{{$opd_patient_details->id}}
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

                                                            {{ date('d-m-Y h:i A',strtotime(@$opd_patient_details->all_emg_visit_details->appointment_date)) }}
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr_line">
                            <div class="col-md-6 vl_line">
                                <h5>LAB INVESTIGATION</h5>
                                <div class="col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Joan Powell</td>
                                                    <td>Associate Developer</td>
                                                    <td>$450,870</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Gavin Gibson</td>
                                                    <td>Account manager</td>
                                                    <td>$230,540</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Julian Kerr</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>$55,300</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>Cedric Kelly</td>
                                                    <td>Accountant</td>
                                                    <td>$234,100</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <td>Samantha May</td>
                                                    <td>Junior Technical Author</td>
                                                    <td>$43,198</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- =================== profile =========================== --}}

                    {{-- =================== billing =========================== --}}
                    <div class="tab-pane" id="billing">
                        billing
                    </div>
                    {{-- =================== billing =========================== --}}

                    {{-- =================== payment =========================== --}}
                    <div class="tab-pane" id="payment">
                        payment
                    </div>
                    {{-- =================== payment =========================== --}}

                    {{-- =================== Timeline =========================== --}}
                    <div class="tab-pane" id="timeline">

                        <!-- <h4 class="card-title">Add Timeline</h4> -->
                        <div class="row">
                            <div class="col-md-6 card-title">
                                Timeline List
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="d-block">

                                </div>
                            </div>
                        </div> 
                        {{-- =================== Timeline =========================== --}}

                    </div>
                    {{-- =================== Timeline =========================== --}}
                </div>
            </div>
            <!-- <div class="new"> -->
        </div>
    </div>
</div>

<!-- timeline add modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add TimeLine
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-timeline-lisitng-in-opd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="opd_id" value="{{ $opd_patient_details->id }}" />
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                            @error('title')
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

                        <div class="form-group col-md-12">
                            <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control"> </textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="attach_document" class="form-label">Attach Document <span class="text-danger">*</span></label>
                            <input type="file" id="attach_document" name="attach_document">
                            @error('attach_document')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Timeline</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- timeline add modal -->

<!-- timeline add modal -->

<div class="modal fade" id="timelineEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Edit TimeLine
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-timeline-lisitng-in-opd') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="e_opd_id" name="opd_id" />
                    <!-- <input type="hidden" name="e_opd_id" value="{{ $opd_patient_details->id }}" /> -->
                    <input type="hidden" id="e_timeline_id" name="timeline_id" />
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="e_title" name="title" placeholder="Enter Title" required>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="e_date" name="date" required>
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="e_description" class="form-control"> </textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="attach_document" class="form-label">Attach Document <span class="text-danger">*</span></label>
                            <input type="file" id="e_attach_document" name="attach_document">
                            @error('attach_document')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Timeline</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- timeline edit modal -->

<script>
    function timelineEditButton(timeline_id) {
        $.ajax({
            url: "{{ route('find-timeline-details') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                timelineId: timeline_id,
            },
            success: function(response) {

                var date = new Date(response.date);
                var newDate = date.toString('yyyy-mm-dd hh:mm:ss');

                console.log(response.date);

                $('#e_opd_id').val(response.opd_id);
                $('#e_title').val(response.title);
                $('#e_timeline_id').val(response.id);
                $('#e_date').val(newDate);
                $('#e_description').val(response.description);
                $("#timelineEdit").modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    function timelineDeleteButton() {
        $.ajax({
            url: "{{ route('find-timeline-details') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                timelineId: timeline_id,
            },
            success: function(response) {

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


@endsection