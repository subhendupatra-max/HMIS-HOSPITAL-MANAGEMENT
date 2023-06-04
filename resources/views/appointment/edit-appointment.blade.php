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

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="{{route('update-appointments-details')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">

                            <div class="row">
                                <input type="hidden" name="patient_id" value="{{ @$editAppointment->patient_id }}" />
                                <input type="hidden" name="id" value="{{ @$editAppointment->id }}" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Appointment Date <span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="appointment_date" value="{{ old('appointment_date') }}" required @if(isset($editAppointment->appointment_date)) value="{{date('Y-m-d H:i',strtotime($editAppointment->appointment_date))}}" @endif/>

                                    @error('appointment_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="doctor">Doctor <span class="text-danger">*</span></label>
                                    <select name="doctor" class="form-control select2-show-search" id="doctor" required>
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


                                <!-- <div class="form-group col-md-4 newaddappon">
                                    <label for="slot">Slot <span class="text-danger">*</span></label>
                                    <select name="slot" class="form-control select2-show-search" id="slot" required>
                                        <option value=" ">Select slot</option>
                                        @foreach ($slot as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('slot')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="shift">Shift <span class="text-danger">*</span></label>
                                    <select name="shift" class="form-control select2-show-search" id="shift" required>
                                        <option value=" ">Select shift</option>
                                        @foreach ($shift as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('shift')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div> -->

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="message">Message </label>
                                    <input type="text" class="form-control" name="message" value="{{ $editAppointment->message }}" id="message" />

                                    @error('message')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                </div>
                            </div>
                        </div>



                </div>
            </div>
            <div class="" style="text-align: center;">
                <button class="btn btn-primary btn-sm " type="submit" name="save" value="save"><i class="fa fa-file"></i> Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


@endsection