@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Appointment of Dr. Wise</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-12 border-right">
                            <form method="POST" action="{{ route('fetch-appointments-details-dr-wise') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="form-group col-md-4 addopdd">
                                            <label> Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" id="date" style="margin: 11px 0px 0px 0px;" value="{{ @$all_search_data['date'] }}" required />
                                            @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 addopdd">
                                            <label>Doctor<span class="text-danger">*</span></label>
                                            <select name="doctor" onchange="getSlot(this.value,{{ @$all_search_data['slot'] }})" class="form-control select2-show-search" id="doctor">
                                                <option value="">Select Doctor</option>
                                                @foreach ($doctors as $key => $doctor)
                                                <option value="{{$doctor->id}}" {{@$all_search_data['doctor'] == $doctor->id ? 'selected':'' }}> {{$doctor->first_name}} {{$doctor->last_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('doctor')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 addopdd">
                                            <label for="slot">Slot </label>
                                            <select name="slot" class="form-control select2-show-search" id="slot">
                                                <option value=" ">Select slot...</option>
                                            </select>
                                            @error('slot')
                                            <small class="text-danger">{{ $message }}</sma>
                                                @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead class="bg-primary text-white">
                            <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Patient Name </th>
                                <th class="text-white">Doctor Name</th>
                                <th class="text-white">Appointment Date</th>
                                <th class="text-white">Appointment Priority</th>
                                <th class="text-white">Slot</th>
                                <th class="text-white">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (@$appointment[0]->id != null)
                            @foreach ($appointment as $item)
                            <?php
                            $slot_details = DB::table('slots')->where('id', $item->slot)->first();
                            $slot_time =  date('H:i A', strtotime($slot_details->from_time)) . " - " . date('H:i A', strtotime($slot_details->to_time));
                            ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->patient_details->first_name}} {{$item->patient_details->middle_name}} {{$item->patient_details->last_name}}</td>
                                <td>{{$item->doctor_details->first_name}} {{$item->doctor_details->last_name}}</td>
                                <td>{{$item->appointment_date}}</td>
                                <td>
                                    @if($item->appointment_priority == 'Normal')
                                    <span class="badge badge-success">Normal</span>
                                    @elseif($item->appointment_priority == 'Urgent')
                                    <span class="badge badge-warning">Urgent</span>
                                    @elseif($item->appointment_priority == 'Very Urgent')
                                    <span class="badge badge-danger">Very Urgent</span>
                                    @else
                                    <span class="badge badge-info">Low</span>
                                    @endif
                                </td>
                                <td>{{$slot_time}}</td>
                                <td>{!! $item->message !!}</td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getSlot(doctor_id, slot = null) {
        var appointment_date = $('#date').val();
        var sel = '';
        var div_data = '';
        $('#slot').html('<option value="">Select One....</option>');
        $.ajax({
            url: "{{ route('get-slot-details-using-doctor_id') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                appointmentDate: appointment_date,
                doctorId: doctor_id,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    if (slot == value.id) {
                        sel = 'Selected';
                    }
                    div_data += `<option value="${value.id}" ${sel}>${value.from_time} - ${value.to_time}</option>`;
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