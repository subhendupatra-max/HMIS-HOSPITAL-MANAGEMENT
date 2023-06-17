@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title"> Add Appointment</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="{{route('add_new_patient_in_appointment')}}"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    {{-- ================== add new patient ====================== --}}

                    <div class="options px-5 pt-5  border-bottom pb-3">

                        <form method="post" action="{{route('add-appointments-details') }}">

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
                    <form method="post" action="{{route('save-appointments-details')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            @error('patient_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row">
                                <input type="hidden" name="patient_id" value="{{ @$patient_details_information->id }}" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Appointment Date <span class="text-danger">*</span></label>

                                    <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required style="margin:9px 0px 0px 0px;" />

                                    @error('appointment_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="doctor">Doctor <span class="text-danger">*</span></label>
                                    <select name="doctor" class="form-control select2-show-search" onchange="getSlot(this.value)" id="doctor" required>
                                        <option value=" ">Select Doctor...</option>
                                        @foreach ($doctor as $item)
                                        <option value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('doctor')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="slot">Slot <span class="text-danger">*</span></label>
                                    <select name="slot" class="form-control select2-show-search" id="slot" required>
                                        <option value=" ">Select slot...</option>
                                    </select>
                                    @error('slot')
                                    <small class="text-danger">{{ $message }}</sma>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="appointment_priority">Appointment Priority <span class="text-danger">*</span></label>
                                    <select name="appointment_priority" class="form-control select2-show-search" id="appointment_priority" required>
                                        <option value="">Select Appointment Priority..</option>
                                        @foreach (Config::get('static.appointment_priority') as $lang => $item)
                                        <option value="{{ $item }}"> {{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('appointment_priority')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>


                                <div class="form-group col-md-8 newaddappon">
                                    <label for="message">Message </label>
                                    <input type="text" class="form-control" name="message" value="{{ old('message') }}" id="message" style="margin:0px 0px 0px 0px;" />

                                    @error('message')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="btn-list p-3">
                <button class="btn btn-primary btn-sm float-right ml-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<script>
    function getSlot(doctor_id)
    {
        var appointment_date = $('#appointment_date').val();
       // alert(patient_type);
        var div_data = '';
        $('#slot').html('<option value="">Select One....</option>');
        $.ajax({
            url: "{{ route('get-slot-details-using-doctor_id') }}",
            type: "POST",
            data: {
                _token : '{{ csrf_token() }}',
                appointmentDate : appointment_date,
                doctorId : doctor_id,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    div_data += `<option value="${value.id}">${value.from_time} - ${value.to_time}</option>`;
                });
                $('#slot').append(div_data);
            },
            error: function(error) {
                console.log(error);
            }
        });
       
    }
</script>


@endsection