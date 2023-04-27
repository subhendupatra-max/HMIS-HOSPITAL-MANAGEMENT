@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Appointment </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('save-appointments-details') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            {{-- <label for="doctor" class="form-label">Doctor<span class="text-danger">*</span></label> --}}
                            <select class="form-control select2-show-search select2-hidden-accessible"
                                value="{{ old('doctor') }}" name="doctor" id="doctor" required>
                                <optgroup>
                                    <option value=" ">Select Doctor</option>
                                    @foreach ($doctor as $item)
                                        <option value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('doctor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            {{-- <label for="doctor_fees" class="form-label">Doctor Fees<span class="text-danger">*</span></label> --}}
                            {{-- <input type="text" class="form-control" id="doctor_fees" name="doctor_fees" placeholder="Enter Doctor Fees" required> --}}
                            <input type="text" id="doctor_fees" name="doctor_fees" required />
                            <label for="doctor_fees"> Enter Doctor Fees<span class="text-danger">*</span></label>
                            @error('doctor_fees')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            {{-- <label for="shift" class="form-label">Shift <span class="text-danger">*</span></label> --}}
                            <select class="form-control select2-show-search select2-hidden-accessible"
                                value="{{ old('vehicle_model') }}" name="shift" id="shift" required>
                                <optgroup>
                                    <option value=" ">Select Shift <span class="text-danger">*</span></option>
                                    @foreach ($shift as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('shift')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <!-- <label for="appointment_date" class="form-label">Appointment Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date"> -->
                            <lable class="dateformat">Appointment Date<span class="text-danger">*</span></lable>
                            <input type="date" id="appointment_date" name="appointment_date">
                            @error('appointment_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 newwformatt">
                            {{-- <label for="slot" class="form-label">Slot <span class="text-danger">*</span></label> --}}
                            <select class="form-control select2-show-search select2-hidden-accessible"
                                value="{{ old('slot') }}" name="slot" id="slot" required>
                                <optgroup>
                                    <option value=" ">Select Slot <span class="text-danger">*</span></option>
                                    @foreach ($slot as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('slot')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 newwformatt ">
                            {{-- <label for="appointment_priority" class="form-label">Appointment Priority<span class="text-danger">*</span></label> --}}
                            <select id="appointment_priority" class="form-control" name="appointment_priority">
                                <option value="">Select Appointment Priority</option>
                                @foreach (Config::get('static.appointment_priority') as $lang => $item)
                                    <option value="{{ $item }}"> {{ $item }}</option>
                                @endforeach
                            </select>
                            @error('appointment_priority')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            {{-- <label for="payment_mode" class="form-label">Payment Mode<span class="text-danger">*</span></label> --}}
                            <select id="payment_mode" class="form-control" name="payment_mode">
                                <option value="">Select Appointment Priority<span class="text-danger">*</span>
                                </option>
                                @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                                    <option value="{{ $item }}"> {{ $item }}</option>
                                @endforeach
                            </select>
                            @error('payment_mode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            {{-- <label for="status" class="form-label">Status<span class="text-danger">*</span></label> --}}
                            <select id="status" class="form-control" name="status">
                                <option value="">Select Appointment Priority<span class="text-danger">*</span>
                                </option>
                                @foreach (Config::get('static.status') as $lang => $item)
                                    <option value="{{ $item }}"> {{ $item }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            {{-- <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                         <textarea name="message" id="message" class="form-control"></textarea> --}}
                            <input type="text" id="message" name="message" required />
                            <label for="Message"> Message<span class="text-danger">*</span></label>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            {{-- <label for="live_consultant" class="form-label">Live Consultant<span class="text-danger">*</span></label> --}}
                            <select id="live_consultant" class="form-control" name="live_consultant">
                                <option value="">Select Appointment Priority<span class="text-danger">*</span>
                                </option>
                                @foreach (Config::get('static.ans') as $lang => $item)
                                    <option value="{{ $item }}"> {{ $item }}</option>
                                @endforeach
                            </select>
                            @error('live_consultant')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            {{-- <label for="alternate_address" class="form-label">Alternate Address <span class="text-danger">*</span></label>
                        <textarea name="alternate_address" id="alternate_address" class="form-control"></textarea> --}}
                            <input type="text" id="alternate_address" name="alternate_addresss" required />
                            <label for="Alternate Address"> Alternate Address<span class="text-danger">*</span></label>
                            @error('alternate_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="text-center m-auto">
                        <button type="submit" class="btn btn-primary">Save Appointment </button>
                    </div>
            </div>
            </form>
        </div>

    </div>

    </div>


    <script>
        $(document).ready(function() {
            $("#doctor").change(function(event) {
                event.preventDefault();
                let doctor_id = $(this).val();
                // alert('doctor_id');
                $.ajax({
                    url: "{{ route('find-fees-by-doctor') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        doctor: doctor_id,
                    },

                    success: function(response) {

                        $('#doctor_fees').val(response.total_amount);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
