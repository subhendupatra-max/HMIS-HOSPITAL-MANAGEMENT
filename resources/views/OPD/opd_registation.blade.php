@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">OPD Registation</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="{{route('add_new_patient')}}"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    {{-- ================== add new patient ====================== --}}

                    <div class="options px-5 pt-5  border-bottom pb-3">

                        <form method="post" action="{{route('opd-registration') }}">

                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select class="form-control  select2-show-search" name="patient_id">
                                        <option value="">Select One Patient</option>
                                        @if(isset($all_patient))
                                        @foreach ($all_patient as $patient)
                                        <option value="{{@$patient->id}}" {{ @$patient_details_information->id == $patient->id ? 'Selected' : '' }}> {{@$patient->prefix}} {{@$patient->first_name}} {{@$patient->middle_name}} {{@$patient->last_name}} ( {{@$patient->id}} ) </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    @if(isset($patient_details_information))
                    {{-- ================== patient Details ====================== --}}
                    @error('patientId')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="options px-5  pb-3">
                        <div class="row">

                            <hr class="hr_line">

                            <div class="card-body text-center">
                                <div class="pro-user">
                                    <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                        {{ $patient_details_information->prefix }} {{ $patient_details_information->first_name }}
                                        {{ $patient_details_information->middle_name }} {{ $patient_details_information->last_name }}
                                    </h4>
                                    <h6 class="pro-user-desc textlink">
                                        {{ $patient_details_information->patient_prefix }}{{ $patient_details_information->id }}
                                    </h6>

                                    @can('edit patient')
                                    <a href="{{ route('edit-new-patient-opd', base64_encode($patient_details_information->id)) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Patient Profile"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5">
                                                {{ @$patient_details_information->year == '0'?'':$patient_details_information->year.'y' }}
                                                {{ @$patient_details_information->month == '0'?'':$patient_details_information->month.'m' }}
                                                {{ @$patient_details_information->day == '0'?'':$patient_details_information->day.'d' }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->guardian_name_realation }}
                                                {{ @$patient_details_information->guardian_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->blood_group }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5">{{@$patient_details_information->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- ================== patient Details ====================== --}}
                    @endif

                </div>

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="{{route('add-opd-registration')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            @error('patient_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row">
                                <input type="hidden" name="patient_id" value="{{ @$patient_details_information->id }}" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Appointment Date <span class="text-danger">*</span></label>

                                    @if (auth()->user()->can('appointment date'))
                                    <input type="datetime-local" name="appointment_date" value="{{ old('appointment_date') }}" required />
                                    @else
                                    <input type="datetime-local" name="appointment_date" value="{{ date('Y-m-d H:s') }}" required />
                                    @endif
                                    @error('appointment_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="visit_type">Visit Type <span class="text-danger">*</span></label>
                                    <select name="visit_type" class="form-control select2-show-search" id="visit_type" required>
                                        <option value="New Visit" selected>New-Visit</option>
                                        <option value="Revisit">Revisit</option>
                                    </select>
                                    @error('visit_type')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>

                                {{-- <div class="form-group col-md-4  opd-bladedesignin  ">
                                    <label for="height">Case</label>
                                    <input type="text" class="form-control" name="case" value="{{ old('case') }}">

                            </div> --}}
                            <div class="form-group col-md-4 newaddappon">
                                <label for="patient_type">Patient Type <span class="text-danger">*</span></label>
                                <select name="patient_type" required onchange="getDetailsAccordingType(this.value)" class="form-control select2-show-search" id="patient_type">
                                    <option value="">Patient Type </option>
                                    @foreach (Config::get('static.patient_types') as $key => $patient_type)
                                    <option value="{{$patient_type}}"> {{$patient_type}}</option>
                                    @endforeach
                                </select>

                                @error('patient_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group  col-md-4 frefesd newaddappon " style="display:none">
                                <label for="tpa_organization">TPA Organization <span class="text-danger">*</span></label>
                                <select name="tpa_organization" class="form-control select2-show-search" id="tpa_organization">
                                    <option value="">TPA Organization<span class="text-danger">*</span></option>
                                    @foreach ($tpa_management as $key => $tpaManagement)
                                    <option value="{{$tpaManagement->id}}"> {{$tpaManagement->TPA_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4 frefesds newaddappon" style="display:none">
                                <label for="type_no"><span id="lableName"></span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="type_no" value="{{ old('type_no') }}" id="type_no" />
                            </div>
                            <div class="form-group col-md-4 newaddappon ">
                                <label for="reference" class="form-label">Reference</label>
                                <select name="reference" class="form-control select2-show-search" id="reference">
                                    <option value="">Referrel Name</option>
                                    @foreach ($referer as $key => $reference)
                                    <option value="{{$reference->id}}"> {{$reference->referral_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4 newaddappon">
                                <label for="department">Department <span class="text-danger">*</span></label>
                                <select name="department" class="form-control select2-show-search" id="department">
                                    <option value="">Department</option>
                                    @foreach ($departments as $key => $department)
                                    <option value="{{$department->id}}"> {{$department->department_name}}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if($opdSetup->registration_type == 'By-Doctor')
                            <div class="form-group col-md-4 newaddappon">
                                <label for="cons_doctor">Consultant Doctor <span class="text-danger">*</span></label>
                                <select name="cons_doctor" class="form-control select2-show-search" id="cons_doctor">
                                    <option value="">Consultant Doctor</option>
                                </select>
                                @error('cons_doctor')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                            <div class="form-group col-md-4 newaddappon ">
                                <label for="unit">Unit <span class="text-danger">*</span></label>
                                <select name="unit" class="form-control select2-show-search" id="unit">
                                    <option value="">Unit</option>
                                </select>
                                @error('unit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 newaddticket">
                                <input type="text" id="ticket_no" name="ticket_no">
                                <label for="ticket_no">Ticket No <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group col-md-4 newaddappon ">
                                <input type="text" value="{{ @$ticket_fees->ticket_fees }}" id="ticket_fees" name="ticket_fees">
                                <label for="ticket_fees">Ticket Fees <span class="text-danger">*</span></label>
                            </div>

                        </div>
                </div>

                <div class="options px-5">
                    <div class="container mt-3">
                        {{-- <hr class="hr_line">
                                <input type="checkbox" onchange="takeTicketFees()" checked id="cb01"><span style="font-weight: 500;color:blue"> Are You Want to take <b>TICKET FEES</b> ?</span>

                                <div class="row" id="taketicketFees" style="display: none"> --}}

                        {{-- </div> --}}

                        {{-- <hr class="hr_line"> --}}
                        <!-- <input type="checkbox" onchange="show_physical_condition()" id="isAgeSelected" /><span style="font-weight: 500;color:blue"> Are You Want to Share Patient's Physical Condition
                                    ?</span>

                                <div class="row" id="physical_condition" style="display: none">
                                    <div class="col-md-2 opd-condition">
                                        <label for="height" class="form-label">Height(cm)</label>
                                        <input type="text" class="form-control" id="height" name="height" value="{{ old('height') }}" />
                                    </div>
                                    <div class="col-md-2 opd-condition">
                                        <label for="weight" class="form-label">Weight(kg)</label>
                                        <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" />
                                    </div>
                                    <div class="col-md-2 opd-condition">
                                        <label for="bp" class="form-label">BP</label>
                                        <input type="text" class="form-control" id="bp" name="bp" value="{{ old('bp') }}" />
                                    </div>
                                    <div class="col-md-2 opd-condition1">
                                        <label for="pulse" class="form-label">Pulse</label>
                                        <input type="text" class="form-control" id="pulse" name="pulse" value="{{ old('pulse') }}" />
                                    </div>
                                    <div class="col-md-2 opd-condition1">
                                        <label for="temperature" class="form-label">Temperature</label>
                                        <input type="text" class="form-control" id="temperature" name="temperature" value="{{ old('temperature') }}" />
                                    </div>
                                    <div class="col-md-2 opd-condition1">
                                        <label for="respiration" class="form-label">Respiration</label>
                                        <input type="text" class="form-control" id="respiration" name="respiration" value="{{ old('respiration') }}" />
                                    </div>
                                </div> -->

                        <!-- <hr class="hr_line"> -->
                        <!-- <input type="checkbox" onchange="show_Symptoms()" id="show_Symptoms_button" /><span style="font-weight: 500;color:blue"> Are You Want to Share Patient's Symptoms ?</span> -->

                        <!-- <div class="row" id="show_Symptoms" style="display: none">
                                    <div class="col-md-3 newaddappon ">
                                         <label for="symptoms_type" class="form-label">Symptoms Type</label>
                                        <select name="symptoms_type" class="form-control select2-show-search" id="symptoms_type">
                                            <option value="">symptoms type</option>
                                            @foreach ($symptoms_types as $key => $symptoms_type)
                                            <option value="{{$symptoms_type->id}}"> {{$symptoms_type->symptoms_type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 newaddappon">
                                         <label for="symptoms_title" class="form-label">Symptoms Title</label>

                                        <select name="symptoms_title" id="symptoms_title" class="form-control select2-show-search">
                                            <option value="">symptoms_title</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 opd-bladedesigninin">
                            
                                        <input type="text" id="symptoms_description" name="symptoms_description" >
                                        <label for="Symptoms Description">Symptoms Description </label>
                                    </div>
                                </div> -->


                        <!-- <hr class="hr_line"> -->
                        <div class="row">
                            <div class="form-group col-md-4 opd-condition">

                                <input type="text" id="note" name="note">
                                <label for="note">Note </label>
                            </div>
                            <div class="form-group col-md-4 opd-condition">

                                <input type="text" id="any_known_allergies" name="any_known_allergies">
                                <label for="any_known_allergies">Any Known Allergies</label>
                            </div>
                        </div>
                        {{-- <hr class="hr_line">
                        <input type="checkbox" id="opd_belling" value="opd_belling_from_opd" />
                        <span style="font-weight: 500;color:blue"> Are You Want To do <b> Billing</b>
                            ?</span> --}}

                    </div>
                </div>
                <div class="btn-list p-3">
                    <button class="btn btn-primary btn-sm float-right ml-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Save</button>

                    <button class="btn btn-primary btn-sm float-right" type="submit" name="save" value="save_and_print"><i class="fa fa-file"></i> Save & Print</button>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


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
    $(document).ready(function() {
        $("#department").change(function(event) {
            event.preventDefault();
            let department = $(this).val();
            // alert(department);
            $('#cons_doctor').html('<option vaule="" >Select...</option>');
            $.ajax({
                url: "{{ route('find-doctor-by-department') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    department_id: department,
                },
                success: function(response) {
                    console.log(response);
                    $('#ticket_no').val(response.opd_ticket_no_by_department)
                    $.each(response.cons_doctor, function(key, value) {
                        $('#cons_doctor').append(`<option value="${value.id}">${value.first_name} ${value.last_name}</option>`);
                    });
                    $.each(response.opd_units, function(key, value) {
                        $('#unit').append(`<option value="${value.unit_name}">${value.unit_name}</option>`);
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
                        $('#symptoms_title').append(`<option value="${value.symptoms_head_name	}">${value.symptoms_head_name }</option>`);
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