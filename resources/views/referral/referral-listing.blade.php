@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                       Referral Person List
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            @can('')
                                <a href="{{ route('add-referral') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-user"></i> Add Referral Person</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered text-nowrap key-buttons">
                            
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endsection
