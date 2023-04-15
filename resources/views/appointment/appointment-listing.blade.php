@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Appointment List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add appointment main')
                        <a href="{{ route('add-appointments-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Appointment  </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>


    </div>
    @endsection