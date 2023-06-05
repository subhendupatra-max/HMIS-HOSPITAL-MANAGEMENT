@extends('layouts.layout')

@section('content')

@can('medicine rack')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">

            <div class="col-md-12 row">
                <div class="col-md-6 card-title">
                    Expiry Medicine Details
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('add-bad-medicine',['medicine_id'=>$medicine_details->id]) }}"><i class="fa fa-plus"></i> Add Bad Medicine</a>
                </div>
            </div>
        </div>


        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Medicine Name</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Batch No </th>
                                <th class="border-bottom-0">Date </th>

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
@endcan


@endsection