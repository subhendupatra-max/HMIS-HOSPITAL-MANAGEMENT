@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit IPD Patient</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    {{-- ================== patient Details ====================== --}}

                    <div class="options px-5  pb-3">
                        <div class="row">
                            <hr class="hr_line">
                            <div class="card-body text-center">
                                <div class="pro-user">
                                    <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                        {{ $visit_details->all_patient_details->prefix }}
                                        {{ $visit_details->all_patient_details->first_name }}
                                        {{ $visit_details->all_patient_details->middle_name }}
                                        {{ $visit_details->all_patient_details->last_name }}
                                    </h4>
                                    <h6 class="pro-user-desc textlink">
                                        {{ $visit_details->all_patient_details->patient_prefix }}{{
                                        $visit_details->all_patient_details->id }}
                                    </h6>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5">{{ $visit_details->all_patient_details->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5">
                                                {{ @$visit_details->all_patient_details->year ==
                                                '0'?'':$visit_details->all_patient_details->year.'y' }}
                                                {{ @$visit_details->all_patient_details->month ==
                                                '0'?'':$visit_details->all_patient_details->month.'m' }}
                                                {{ @$visit_details->all_patient_details->day ==
                                                '0'?'':$visit_details->all_patient_details->day.'d' }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5">{{
                                                @$visit_details->all_patient_details->guardian_name_realation }}
                                                {{ @$visit_details->all_patient_details->guardian_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$visit_details->all_patient_details->blood_group
                                                }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5">{{@$visit_details->all_patient_details->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- ================== patient Details ====================== --}}
                </div>

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="{{ route('update-ipd-registation') }}">
                        @csrf
                        <input type="hidden" name="ipd_details_id" value="{{ $visit_details->id }}" />
                        <input type="hidden" name="patient_id" value="{{ $visit_details->all_patient_details->id }}" />
                        <input type="hidden" name="patient_source_id" value="{{ $visit_details->patient_source_id }}" />
                        <input type="hidden" name="patient_source" value="{{ $visit_details->patient_source }}" />
                        <input type="hidden" name="case_id" value="{{ $visit_details->case_id }}" />

                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <div class="form-group col-md-2 newaddappon">
                                    <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                                    <input type="date" required class="form-control" id="date_of_birth" name="date_of_birth" onchange="getagefromdate(this.value)" value="{{ date('Y-m-d',strtotime($visit_details->all_patient_details->date_of_birth)) }}" />
                                    <small class="text-danger">{{ $errors->first('date_of_birth') }}</small>
                                </div>

                                <div class="form-group col-md-4 ">
                                    <div class="row">
                                        <div class="col-lg-4 newdesignadd">
                                            <input type="text" required onkeyup="getage()" id="date_of_birth_year" value="{{ $visit_details->all_patient_details->year }}" name="date_of_birth_year">
                                            <label for="date_of_birth_year"> Year</label>
                                            <small class="text-danger">{{
                                                $errors->first('date_of_birth_year') }}</small>
                                        </div>

                                        <div class="col-lg-4 newdesignadd">
                                            <input type="text" required onkeyup="getage()" id="date_of_birth_month" value="{{ $visit_details->all_patient_details->month }}" name="date_of_birth_month">
                                            <label for="date_of_birth_month"> Month</label>
                                            <small class="text-danger">{{
                                                $errors->first('date_of_birth_month') }}</small>

                                        </div>
                                        <div class="col-lg-4 newdesignadd">
                                            <input type="text" required onkeyup="getage()" id="date_of_birth_day" value="{{ $visit_details->all_patient_details->day }}" name="date_of_birth_day">
                                            <label for="date_of_birth_day"> Day</label>
                                            <small class="text-danger">{{
                                                $errors->first('date_of_birth_day') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 newdesignadd">
                                    <input type="text" required id="admitted_by" value="{{ $visit_details->all_patient_details->local_guardian_name }}" name="admitted_by">
                                    <label for="admitted_by"> Admitted By</label>
                                    <small class="text-danger">{{
                                        $errors->first('admitted_by') }}</small>
                                </div>
                                <div class="col-md-3 newdesignadd">
                                    <input type="text" required id="admitted_by_contact_no" value="{{ $visit_details->all_patient_details->local_guardian_contact_no	 }}" name="admitted_by_contact_no">
                                    <label for="admitted_by_contact_no"> Admitted By Contact No.</label>
                                    <small class="text-danger">{{
                                        $errors->first('admitted_by_contact_no') }}</small>
                                </div>

                            </div>
                        </div>
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            @error('patient_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row">
                                <div class="col-md-4 ipd-registrationproaddd">
                                    <label for="height">Admission Date <span class="text-danger">*</span></label>
                                    @if (auth()->user()->can('appointment date'))
                                    {{-- <input type="datetime-local" class="form-control" name="appointment_date"
                                        value="{{ old('appointment_date') }}" required /> --}}

                                    <input type="datetime-local" id="appointment_date" name="appointment_date" @if (isset($visit_details->appointment_date)) value="{{ date('Y-m-d h:m:s', strtotime($visit_details->appointment_date)) }}" @endif >
                                    @else
                                    <input type="datetime-local" id="appointment_date" name="appointment_date" @if (isset($visit_details->appointment_date)) value="{{ date('Y-m-d h:m:s', strtotime($visit_details->appointment_date)) }}" @endif >
                                    @endif

                                    @error('appointment_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 ipd-registrationproaddin">

                                    <input type="text" value="{{ 20000 }}" id="credit_limit" name="credit_limit">
                                    <label for="credit_limit">Credit Limit <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="patient_type">Patient Type <span class="text-danger">*</span></label>
                                    <select name="patient_type" onchange="getDetailsAccordingType(this.value)" class="form-control select2-show-search" id="patient_type">
                                        <option value="">Select</option>
                                        @foreach (Config::get('static.patient_types') as $key => $patient_type)
                                        <option value="{{ $patient_type }}" {{ $patient_type == $visit_details->patient_type ? 'selected' : " "}}> {{ $patient_type }}</option>
                                        @endforeach
                                    </select>

                                    @error('patient_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-md-4 frefesd ipd-registrationproadd" style="display:none">
                                    <label for="tpa_organization">TPA Organization <span class="text-danger">*</span></label>
                                    <select name="tpa_organization" class="form-control select2-show-search" id="tpa_organization">
                                        <option value="">Select</option>
                                        @foreach ($tpa_management as $key => $tpaManagement)
                                        <option value="{{ $tpaManagement->id }}" {{ $tpaManagement->id == $visit_details->tpa_organization ? 'selected' : " " }}>
                                            {{ $tpaManagement->TPA_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 frefesds ipd-registrationproadd" style="display:none">
                                    <label for="type_no"><span id="lableName"></span><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="type_no" value="{{ old('type_no') }}" id="type_no" />
                                </div>
                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="reference">Reference</label>
                                    <select name="reference" class="form-control select2-show-search" id="reference">
                                        <option value="">Select</option>
                                        @foreach ($referer as $key => $reference)
                                        <option value="{{ $reference->id }}" {{ $reference->id == $visit_details->refference ? 'selected' : " "}}> {{ $reference->referral_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 ipd-registrationproadd ">
                                    <label for="department">Department <span class="text-danger">*</span></label>
                                    <select name="department" class="form-control select2-show-search" id="department" onchange="getDoctor_ward(this.value,{{ $visit_details->cons_doctor }},{{ $visit_details->bed_ward_id }})">
                                        <option value="">Select</option>
                                        @foreach ($departments as $key => $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $visit_details->department_id ? 'selected' : " "}}>
                                            {{ $department->department_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="cons_doctor"> Doctor <span class="text-danger">*</span></label>
                                    <select name="cons_doctor" class="form-control select2-show-search" id="cons_doctor">
                                        <option value="">Select..</option>
                                    </select>
                                    @error('cons_doctor')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="ward"> Ward <span class="text-danger">*</span></label>
                                    <select name="ward" onchange="getBed({{$visit_details->bed}})" class="form-control select2-show-search" id="bed_ward">
                                        <option value="">Select..</option>
                                    </select>
                                    @error('ward')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="unit"> Unit <span class="text-danger">*</span></label>
                                    <select name="unit" onchange="getBed({{$visit_details->bed}})" class="form-control select2-show-search" id="unit">
                                        <option value="">Select..</option>
                                        @foreach ($units as $key => $unit)
                                        <option value="{{ $unit->id }}" {{ $unit->id == $visit_details->bed_unit_id ? 'selected' : " "}}> {{ $unit->bedUnit_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-4 ipd-registrationproadd">
                                    <label> Bed <span class="text-danger">*</span></label>
                                    <select name="bed" class="form-control select2-show-search" id="bed">
                                        <option value="">Select..</option>
                                    </select>
                                    @error('bed')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ipd-registrationproaddd">
                                    <input type="text" id="note" name="note" value="{{$visit_details->note}}">
                                    <label for="note">Note</label>
                                </div>
                                <div class="col-md-6 ipd-registrationproaddd">
                                    <input type="text" id="any_known_allergies" name="any_known_allergies" value="{{$visit_details->known_allergies}}">
                                    <label for="any_known_allergies">Any Known Allergies</label>
                                </div>
                            </div>
                            <div class="mt-5 text-right">

                                <button name="save" value="save" class="btn btn-primary" type="submit"><i class="fa fa-file"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
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
            $('#type_no').attr('required', 'required', true);
            $('#tpa_organization').attr('required', 'required', true);
        } else if (val == 'Swasthya Sathi') {
            $('.frefesds').removeAttr('style', true);
            $('.frefesd').attr('style', 'display:none', true);
            $('#lableName').text('Swasthya Sathi ID');
            $('#type_no').attr('required', 'required', true);
        } else {
            $('.frefesd').attr('style', 'display:none', true);
            $('.frefesds').attr('style', 'display:none', true);
        }
    }
</script>

<script>
    function getDoctor_ward(department, doctor_id, bed_ward_id) {
        $('#cons_doctor').html('<option value="" >Select...</option>');
        $('#bed_ward').html('<option value="" >Select...</option>');
        $.ajax({
            url: "{{ route('find-doctor-and-ward-by-department-in-ipd') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                department_id: department,
            },
            success: function(response) {
                console.log(response);
                $.each(response.doctor, function(key, value) {
                    let sel = (value.id == doctor_id ? 'selected' : '');
                    $('#cons_doctor').append(
                        `<option value="${value.id}" ${sel}>${value.first_name} ${value.last_name }</option>`
                    );
                });
                $.each(response.ward, function(key, values) {
                    let sel = (values.id == bed_ward_id ? 'selected' : '');
                    $('#bed_ward').append(
                        `<option value="${values.id}" ${sel}>${values.ward_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
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

    function getBed(bed) {
        var bedward = $('#bed_ward').val();
        var bedunit = $('#unit').val();
        $('#bed').empty();
        $('#bed').html(`<option value="">Select.....</option>`)
        $.ajax({
            url: "{{ route('find-bed-by-bed-ward') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                bed_ward: bedward,
                bed_unit: bedunit,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == bed ? 'selected' : '');
                    $('#bed').append(`<option value="${value.id	}" ${sel}>${value.bed_name }</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
<script>
    function getage() {
        var year = $('#date_of_birth_year').val();
        var month = $('#date_of_birth_month').val();
        var days = $('#date_of_birth_day').val();
        // var duration = {years: 40, months: 2, days: 3}; // duration object
        var currentDate = new Date(); // current date object
        var date = new Date(currentDate.getFullYear() - year,
            currentDate.getMonth() - month,
            currentDate.getDate() - days); // subtracting duration from current date
        var yyyy = date.getFullYear().toString(); // extracting year
        var mm = (date.getMonth() + 1).toString().padStart(2, '0'); // extracting month and padding with 0 if needed
        var dd = date.getDate().toString().padStart(2, '0'); // extracting day and padding with 0 if needed
        var formattedDate = yyyy + '-' + mm + '-' + dd; // formatting date string
        $('#date_of_birth').val(formattedDate);
    }
</script>
<script>
    function getagefromdate(dob_) {
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




@endsection