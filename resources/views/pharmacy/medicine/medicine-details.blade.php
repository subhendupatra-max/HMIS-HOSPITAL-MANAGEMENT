@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Medicine Details</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="col-md-12">
                ce
            </div>
        </div>
        <div class="card-body p-0 border-top">
            <div class="col-md-12">
                <div class="btn-list p-3">
                    <a class="btn btn-success btn-sm"><i class="fa fa-capsules"></i> Medicine Stock</a>
                    <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i> Medicine Bad Stock</a>
                </div>
            </div>
        </div>
        @if(true)
             @include('pharmacy.medicine.medicine-bad-stock')
        @endif
        @if(true)
            @include('pharmacy.medicine.medicine-good-stock')
        @endif
    </div>
</div>


@endsection