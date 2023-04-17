@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Billing
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add opd billing')
                        <a href="{{ route('add-opd-billing',['id'=> base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add Billing </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('OPD.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Amount</th>
                                <th class="border-bottom-0">Payment Mode</th>
                                @can('edit opd payment','delete opd payment')
                                <th>Action</th>
                                @endcan
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
