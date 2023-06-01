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
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-appointments-details-dr-wise') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="form-group col-md-4 addopdd">
                                            <label>Doctor<span class="text-danger">*</span></label>
                                            <select name="doctor" class="form-control select2-show-search" id="doctor">
                                                <option value="">Select Doctor</option>
                                                @foreach ($doctors as $key => $doctor)
                                                <option value="{{$doctor->id}}" {{@$all_search_data['doctor'] == $doctor->id ? 'selected':'' }}> {{$doctor->first_name}} {{$doctor->last_name}}
                                                </option>
                                                @endforeach
                                            </select>


                                            @error('from_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 addopdd">
                                            <label>From Date <span class="text-danger">*</span></label>
                                            <input type="date" name="from_date" value="{{ date(@$all_search_data['from_date']) }}" required />
                                            @error('from_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-md-4 addopdd ">
                                            <label>To Date <span class="text-danger">*</span></label>
                                            <input type="date" name="to_date" value="{{ date(@$all_search_data['to_date']) }}" required />
                                            @error('to_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 border-right">
                            <canvas id="myChart" style="width:100%;max-width:300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th scope="col">Sl. No</th>
                                <th scope="col">Patient Name </th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Appointment Priority</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (@$appointment[0]->id != null)
                            @foreach ($appointment as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->patient_details->first_name}} {{$item->patient_details->middle_name}} {{$item->patient_details->last_name}}</td>
                                <td>{{$item->doctor_details->first_name}} {{$item->doctor_details->last_name}}</td>
                                <td>{{$item->appointment_date}}</td>
                                <td>{{$item->appointment_priority }}</td>

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

@endsection