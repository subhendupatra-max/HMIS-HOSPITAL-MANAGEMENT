@extends('layouts.layout')
@section('content')
<form method="post" action="{{ route('add-emg-registation') }}">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $patient_details->id }}" />
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12">

                        <a href="{{ route('opd-registration', base64_encode($patient_details->id)) }}" style="{{ Request::segment(1) == 'opd-registration' ? 'color:#705ec8' : '' }}" data-toggle="tooltip" data-placement="top" title="OPD Registation"><i class="fa fa-file-invoice fa-lg"></i></a>

                        <a href="{{ route('emg-registation', base64_encode($patient_details->id)) }}" style="{{ Request::segment(1) == 'emg-registation' ? 'color:#705ec8' : '' }};margin-left: 10px" data-toggle="tooltip" data-placement="top" title="Emergency Registation"><i class="fa fa-file-alt fa-lg" style="color:#705ec8"></i></a>
                        <span style=" color: #6f6f6f;font-size: 18px;font-weight: 500; margin-left: 24px;">Emergency
                            Registation</span>
                        <hr class="hr_line">
                        <div class="widget-user-image mx-auto mt-1"><img alt="User Avatar" class="rounded-circle" src="{{ asset('public/patient_image/patient_icon.png') }}" style="height: 100px;width: 117px;"></div>
                        <div class="card-body text-center">
                            <div class="pro-user">
                                <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                    {{ $patient_details->prefix }} {{ $patient_details->first_name }}
                                    {{ $patient_details->middle_name }} {{ $patient_details->last_name }}
                                </h4>
                                <h6 class="pro-user-desc textlink">
                                    {{ $patient_details->patient_prefix }}{{ $patient_details->id }}
                                </h6>

                                @can('edit patient')
                                <a href="{{ route('edit-patient-details', base64_encode($patient_id)) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Patient Profile"><i class="fa fa-edit"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-semibold w-50">Gender </span>
                                        </td>
                                        <td class="py-2 px-0">{{ $patient_details->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-semibold w-50">Age </span>
                                        </td>
                                        <td class="py-2 px-0">{{ $patient_details->year }}y
                                            {{ $patient_details->month }}m
                                            {{ $patient_details->day }}d

                                            <a href="#" class="btn btn-default btn-sm" data-target="#editAge" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-semibold w-50">Guardian Name </span>
                                        </td>
                                        <td class="py-2 px-0">{{ $patient_details->guardian_name_realation }}
                                            {{ $patient_details->guardian_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-semibold w-50">Blood Group </span>
                                        </td>
                                        <td class="py-2 px-0">{{ $patient_details->blood_group }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-semibold w-50">Phone </span>
                                        </td>
                                        <td class="py-2 px-0">{{ $patient_details->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9 col-md-12 vl_line">
                        <div class="main-profile-body">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="height" class="form-label">Appointment Date <span class="text-danger">*</span></label>
                                        @if (auth()->user()->can('appointment date'))
                                        <input type="datetime-local" class="form-control" name="appointment_date" value="{{ old('appointment_date') }}" required />
                                        @else
                                        <input type="datetime-local" class="form-control" name="appointment_date" value="{{ old('appointment_date') }}" required />
                                        @endif

                                        @error('appointment_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="medico_legal_case" class="form-label">Medico Legal Case <span class="text-danger">*</span></label>
                                        <input type="radio" name="medico_legal_case" value="yes" class="from-control"><span class="font-weight-bold;">Yes</span>
                                        <input type="radio" name="medico_legal_case" value="no" class="from-control" checked><span class="fw-bold;">No</span>
                                        @error('medico_legal_case')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="height" class="form-label">Case</label>
                                        <input type="text" class="form-control" name="case" value="{{ old('case') }}" required />

                                    </div>
                                    <div class="col-md-6">
                                        <label for="patient_type" class="form-label">Patient Type <span class="text-danger">*</span></label>
                                        <select name="patient_type" onchange="getDetailsAccordingType(this.value)" class="form-control select2-show-search" id="patient_type">
                                            <option value="">Select</option>
                                            @foreach (Config::get('static.patient_types') as $key => $patient_type)
                                            <option value="{{ $patient_type }}"> {{ $patient_type }}</option>
                                            @endforeach
                                        </select>

                                        @error('patient_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 frefesd" style="display:none">
                                        <label for="tpa_organization" class="form-label">TPA Organization <span class="text-danger">*</span></label>
                                        <select name="tpa_organization" class="form-control select2-show-search" id="tpa_organization">
                                            <option value="">Select</option>
                                            @foreach ($tpa_management as $key => $tpaManagement)
                                            <option value="{{ $tpaManagement->id }}">
                                                {{ $tpaManagement->TPA_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 frefesds" style="display:none">
                                        <label for="type_no" class="form-label"><span id="lableName"></span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="type_no" value="{{ old('type_no') }}" id="type_no" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reference" class="form-label">Reference</label>
                                        <select name="reference" class="form-control select2-show-search" id="reference">
                                            <option value="">Select</option>
                                            @foreach ($referer as $key => $reference)
                                            <option value="{{ $reference->id }}"> {{ $reference->referral_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                        <select name="department" class="form-control select2-show-search" id="department">
                                            @foreach ($department as $departments)
                                            <option value="{{ $departments->id }}">
                                                {{ $departments->department_name }}
                                            </option>
                                            @endforeach

                                        </select>
                                        @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cons_doctor" class="form-label">Consultant Doctor <span class="text-danger">*</span></label>
                                        <select name="cons_doctor" class="form-control select2-show-search" id="cons_doctor">
                                            <option value="">Select..</option>
                                        </select>
                                        @error('cons_doctor')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <hr class="hr_line">
                                <input type="checkbox" onchange="takeTicketFees()" id="show_taketicketFees" /><span style="font-weight: 500;color:blue"> Are You Want to take <b>TICKET FEES</b>
                                    ?</span>

                                <div class="row" id="taketicketFees" style="display: none">
                                    <div class="col-md-4">
                                        <label class="form-label">Ticket Fees</label>
                                        <input type="text" name="ticket_fees" value="{{@$ticket_fees->ticket_fees}}" class="form-control" />
                                    </div>
                                </div>
                                <hr class="hr_line">
                                <input type="checkbox" onchange="show_physical_condition()" id="isAgeSelected" /><span style="font-weight: 500;color:blue"> Are You Want to
                                    Share Patient's Physical Condition
                                    ?</span>

                                <div class="row" id="physical_condition" style="display: none">
                                    <div class="col-md-2">
                                        <label for="height" class="form-label">Height(cm)</label>
                                        <input type="text" class="form-control" id="height" name="height" value="{{ old('height') }}" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="weight" class="form-label">Weight(kg)</label>
                                        <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="bp" class="form-label">BP</label>
                                        <input type="text" class="form-control" id="bp" name="bp" value="{{ old('bp') }}" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="pulse" class="form-label">Pulse</label>
                                        <input type="text" class="form-control" id="pulse" name="pulse" value="{{ old('pulse') }}" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="temperature" class="form-label">Temperature</label>
                                        <input type="text" class="form-control" id="temperature" name="temperature" value="{{ old('temperature') }}" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="respiration" class="form-label">Respiration</label>
                                        <input type="text" class="form-control" id="respiration" name="respiration" value="{{ old('respiration') }}" />
                                    </div>
                                </div>

                                <hr class="hr_line">
                                <input type="checkbox" onchange="show_Symptoms()" id="show_Symptoms_button" /><span style="font-weight: 500;color:blue"> Are You Want to Share Patient's Symptoms
                                    ?</span>

                                <div class="row" id="show_Symptoms" style="display: none">
                                    <div class="col-md-3">
                                        <label for="symptoms_type" class="form-label">Symptoms Type</label>
                                        <select name="symptoms_type" class="form-control select2-show-search" id="symptoms_type">
                                            <option value="">Select</option>
                                            @foreach ($symptoms_types as $key => $symptoms_type)
                                            <option value="{{ $symptoms_type->id }}">
                                                {{ $symptoms_type->symptoms_type_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="symptoms_title" class="form-label">Symptoms Title</label>

                                        <select name="symptoms_title" id="symptoms_title" class="form-control select2-show-search">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="symptoms_description" class="form-label">Symptoms
                                            Description</label>
                                        <textarea class="form-control" name="symptoms_description"></textarea>
                                    </div>
                                </div>
                                <hr class="hr_line">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Note</label>
                                        <textarea class="form-control" name="note"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Any Known Allergies</label>
                                        <textarea class="form-control" name="any_known_allergies"></textarea>
                                    </div>
                                </div>
                                <div class="mt-5 text-right">
                                    <button name="save" value="save_and_print" class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Save & Print</button>
                                    <button name="save" value="save" class="btn btn-primary" type="submit"><i class="fa fa-file"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{ route('patient-age-edit') }}" method="POST">
    @csrf
    <div class="modal" id="editAge">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Age</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="patient_id" value="{{ @$patient_details->id }}" />
                        <div class="form-group col-md-12">
                            <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" onchange="getage(this.value)" value="{{ @$patient_details->date_of_birth }}">
                            <small class="text-danger">{{ $errors->first('date_of_birth') }}</small>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Age (yy-mm-dd) <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="date_of_birth_year" name="year" placeholder="Year" value="{{ @$patient_details->year }}" required>
                                    <small class="text-danger">{{ $errors->first('date_of_birth_year') }}</small>
                                </div>

                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="date_of_birth_month" name="month" placeholder="Month" value="{{ @$patient_details->month }}" required>
                                    <small class="text-danger">{{ $errors->first('date_of_birth_month') }}</small>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" value="{{ @$patient_details->day }}" id="date_of_birth_day" name="day" placeholder="Day" required>
                                    <small class="text-danger">{{ $errors->first('date_of_birth_day') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-indigo" type="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function takeTicketFees() {
        if (document.getElementById('show_taketicketFees').checked) {
            $('#taketicketFees').removeAttr('style', true);
        } else {
            $('#taketicketFees').attr('style', 'display:none', true);
        }
    }

    function show_physical_condition() {
        if (document.getElementById('isAgeSelected').checked) {
            $('#physical_condition').removeAttr('style', true);
        } else {
            $('#physical_condition').attr('style', 'display:none', true);
        }
    }

    function show_Symptoms() {
        if (document.getElementById('show_Symptoms_button').checked) {
            $('#show_Symptoms').removeAttr('style', true);
        } else {
            $('#show_Symptoms').attr('style', 'display:none', true);
        }
    }

    function getDetailsAccordingType(val) {

        if (val == 'TPA') {
            $('.frefesd').removeAttr('style', true);
            $('.frefesds').removeAttr('style', true);
            $('#lableName').text('TPA ID');
            $('#tpa_organization').attr(true);
        } else if (val == 'Swasthya Sathi') {
            $('.frefesds').removeAttr('style', true);
            $('.frefesd').attr('style', 'display:none', true);
            $('#lableName').text('Swasthya Sathi ID');
        } else {
            $('.frefesd').attr('style', 'display:none', true);
            $('.frefesds').attr('style', 'display:none', true);
        }
    }
</script>
<script>
    $(document).ready(function() {
        $("#department").change(function(event) {
            event.preventDefault();
            let department = $(this).val();
            $('#cons_doctor').html('<option vaule="" >Select...</option>');
            $.ajax({
                url: "{{ route('find-doctor-by-department') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    department_id: department,
                },
                success: function(response) {
                    $.each(response.cons_doctor, function(key, value) {
                        $('#cons_doctor').append(
                            `<option value="${value.id}">${value.first_name} ${value.last_name}</option>`
                        );
                    });
                    $.each(response.opd_units, function(key, value) {
                        $('#unit').append(
                            `<option value="${value.unit_name}">${value.unit_name}</option>`
                        );
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
<script>
    function getage(dob_) {
        const dob = new Date(dob_);
        const nw = new Date();

        let dob_year = dob.getFullYear();
        let dob_month = dob.getMonth() + 1;
        let dob_day = dob.getDate();

        let nw_year = nw.getFullYear();
        let nw_month = nw.getMonth() + 1;
        let nw_day = nw.getDate();

        let dob_in_date = ((parseInt(dob_year) * parseInt(365)) + (parseInt(dob_month) * parseInt(30)) + parseInt(
            dob_day));
        let now_in_date = ((parseInt(nw_year) * parseInt(365)) + (parseInt(nw_month) * parseInt(30)) + parseInt(
            nw_day));
        if (now_in_date >= dob_in_date) {
            let diffe_date = parseInt(parseInt(now_in_date) - parseInt(dob_in_date));

            let year = parseInt(diffe_date / 365);
            let remnder = diffe_date % 365;

            let month = parseInt(remnder / 30);
            let days = remnder % 30;

            $('#date_of_birth_year').val(year);
            $('#date_of_birth_month').val(month);
            $('#date_of_birth_day').val(days);
        } else {

            alert('Enter a Valid Date');
            $('#date_of_birth').reset();
        }

    }
</script>
<script>
    $(document).ready(function() {
        $("#symptoms_type").change(function(event) {
            event.preventDefault();
            let symptoms_type = $(this).val();
            $('#symptoms_title').html('<option value="" >Select...</option>');
            $.ajax({
                url: "{{ route('find-symptoms-title-by-symptoms-type') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    symptoms_type_id: symptoms_type,
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#symptoms_title').append(
                            `<option value="${value.symptoms_head_name	}">${value.symptoms_head_name }</option>`
                        );
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection