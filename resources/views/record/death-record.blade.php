@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Death Record </h4>
                </div>

            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        @include('message.notification')

        <div class="card-body">
            <table class="table table-bordered text-nowrap" id="example">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Guardian Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date Of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($discharge_patient))
                    @foreach ($discharge_patient as $value)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                        <td> {{ @$value->patient_details->first_name }} {{ @$value->patient_details->middle_name }} {{ @$value->patient_details->last_name }}</td>

                        <td> {{ @$value->patient_details->guardian_name }}</td>
                        <td> {{ @$value->patient_details->phone }}</td>
                        <td> {{ @$value->patient_details->gender }}</td>
                        <td> {{ @$value->patient_details->year }}Y {{ @$value->patient_details->month }}M {{ @$value->patient_details->day }}D </td>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection