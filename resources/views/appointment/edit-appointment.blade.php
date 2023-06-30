@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title"> Edit Appointment</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}

                    {{-- ================== add new patient ====================== --}}



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
                <script>
                    function getSlot(doctor_id,slot=null)
                    {
                        // alert(slot);
                        var appointment_date = $('#appointment_date').val();
                       // alert(patient_type);
                        var div_data = '';
                        var sel = '';
                        $('#slot').html('<option value="">Select One....</option>');
                        $.ajax({
                            url: "{{ route('get-slot-details-using-doctor_id-edit') }}",
                            type: "POST",
                            data: {
                                _token : '{{ csrf_token() }}',
                                appointmentDate : appointment_date,
                                doctorId : doctor_id,
                                slotId : slot,
                            },
                            success: function(response) {
                                $.each(response, function(key, value) {
                                    if(slot == value.id)
                                    {
                                        sel = 'selected';
                                    }
                                    else{
                                        sel = '';
                                    }
                                    div_data += `<option value="${value.id}" ${sel}>${value.from_time} - ${value.to_time}</option>`;
                                });
                                getAppointmentFees(slot)
                                $('#slot').append(div_data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                       
                    }
                    function getAppointmentFees(slot_id)
                    {
                        $.ajax({
                            url: "{{ route('get-appointment-fees-by-slot') }}",
                            type: "POST",
                            data: {
                                _token : '{{ csrf_token() }}',
                                slotId : slot_id,
                            },
                            success: function(response) {
                                $('#appointment_fees').val(response.standard_charges);
                                $('#payment_amount').val(response.standard_charges);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                </script>
                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="{{route('update-appointments-details')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">

                            <div class="row">
                                <input type="hidden" name="patient_id" value="{{ @$editAppointment->patient_id }}" />
                                <input type="hidden" name="id" value="{{ @$editAppointment->id }}" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Appointment Date <span class="text-danger">*</span></label>

                                    <input type="date" style="margin:9px 0px 0px 0px" name="appointment_date" id="appointment_date"  required value="{{date('Y-m-d',strtotime($editAppointment->appointment_date))}}" />

                                    @error('appointment_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="doctor">Doctor <span class="text-danger">*</span></label>
                                    <select name="doctor" onchange="getSlot(this.value,{{ $editAppointment->slot }})" class="form-control select2-show-search" id="doctor" required>
                                        <option value=" ">Select Doctor</option>
                                        @foreach ($doctor as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $editAppointment->doctor ? 'selected' : " " }}>{{ $item->first_name }} {{ $item->last_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('doctor')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="slot">Slot <span class="text-danger">*</span></label>
                                    <select name="slot" onchange="getAppointmentFees(this.value)" class="form-control select2-show-search" id="slot" required>
                                        <option value=" ">Select slot...</option>
                                    </select>
                                    @error('slot')
                                    <small class="text-danger">{{ $message }}</sma>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="appointment_priority">Appointment Priority <span class="text-danger">*</span></label>
                                    <select name="appointment_priority" class="form-control select2-show-search" id="appointment_priority" required>
                                        <option value="">Select Appointment Priority</option>
                                        @foreach (Config::get('static.appointment_priority') as $lang => $item)
                                        <option value="{{ $item }}" {{ $item == $editAppointment->appointment_priority ? 'selected' : " " }}> {{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('appointment_priority')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="appointment_fees">Appointment Fees <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="appointment_fees" value="{{ @$editAppointment->appointment_fees }}" id="appointment_fees" style="margin:0px 0px 0px 0px;" />
                                    @error('appointment_fees')
                                        <small class="text-danger">{{ $appointment_fees }}</sma>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="message">Message </label>
                                    <input type="text" class="form-control" name="message" style="margin:0px 0px 0px 0px" value="{{ $editAppointment->message }}" id="message" />

                                    @error('message')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="appointment_fees">Payment Mode <span class="text-danger">*</span></label>
                                    <select class="form-control" name="payment_mode">
                                        <option value="">Select One...</option>
                                        @foreach (Config::get('static.payment_mode_name') as $lang => $payment_mode_name)
                                            <option value="{{ $payment_mode_name }}" {{ $editAppointment->payment_mode == $payment_mode_name?'selected':'' }}> {{ $payment_mode_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payment_mode')
                                    <small class="text-danger">{{ $message }}</sma>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label class="form-label">Payment Amount </label>
                                    <input type="text" value="{{ $editAppointment->payment_amount }}" name="payment_amount" id="payment_amount" class="form-control" />
                                    @error('payment_amount')
                                    <small class="text-danger">{{ $message }}</sma>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label class="form-label">Note </label>
                                    <input type="text" name="note" value="{{ $editAppointment->note }}" class="form-control" />
                                </div>
                            </div>
                        </div>



                </div>
            </div>
            <div class="" style="text-align: center;">
                <button class="btn btn-primary btn-sm mb-3" type="submit" name="save" value="save"><i class="fa fa-file"></i> Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


@endsection