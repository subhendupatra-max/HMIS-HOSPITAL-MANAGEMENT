@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Discharged Patient </h4>
                </div>

            </div>

        </div>
        @include('message.notification')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap table-default">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Patient Id</th>
                            <th scope="col">Case Id</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Phone No</th>
                            <th scope="col">Consultant</th>
                            <th scope="col">Admission Date</th>
                            <th scope="col">Discharged Date</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Net</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($discharged_patient))
                        @foreach ($discharged_patient as $value)
                        <tr>
                            <td>{{$value->patient_first_name }} {{$value->patient_middle_name }} {{$value->patient_last_name }}</td>
                            <td>{{$value->patient_id }}</td>
                            <td>{{$value->case_id }}</td>
                            <td>{{$value->gender }}</td>
                            <td>{{$value->phone }}</td>
                            <td>{{@$value->doctor_first_name}}{{@$value->doctor_last_name}}</td>
                            <td>{{$value->appointment_date }}</td>
                            <td>{{$value->discharged_date }}</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- ====================patient status change(admission/discharged planed/discharged) ================== --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Patient Status Change
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('save-timeline-lisitng-in-opd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="ipd_id" value="" />
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select......</option>
                                <option value="discharged_planed">Discharged Planed</option>
                                <option value="discharged">Discharged</option>
                            </select>
                            @error('status')
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ====================patient status change(admission/discharged planed/discharged) ================== --}}


<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection