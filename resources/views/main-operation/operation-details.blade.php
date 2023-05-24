@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Operation Details
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add patient')
                        <a href="{{ route('add-operation') }}" class="btn btn-primary btn-sm"><i class="fa fa-hospital-user"></i></i> Operation Booking </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        @include('message.notification')

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">UHID</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Guardian Name </th>
                                <th class="border-bottom-0">Gender</th>
                                <th class="border-bottom-0">Age</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection