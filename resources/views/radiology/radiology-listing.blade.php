@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Radiology List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('')
                        <a href="{{ route('import-patient') }}" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i>
                            Generate Bill </a>
                        @endcan

                        @can('')
                        <a href="{{ route('radiology-test-list') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Radiology Test </a>
                        @endcan

                        <!-- @can('')
                                <a href="{{ route('add_new_patient') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-user"></i> Pending Test </a>
                            @endcan -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>

                            </tr>
                        </thead>

                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    @endsection