@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Ambulance Call List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('')
                        <a href="{{ route('add-ambulance-call-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Ambulance Call </a>
                        @endcan

                        @can('')
                        <a href="{{ route('ambulance-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Ambulance List </a>
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
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Vehicle Model</th>
                                <th class="border-bottom-0">Driver Name</th>
                                <th class="border-bottom-0">Charges Catagory </th>
                                <th class="border-bottom-0">Charges Sub Catagory</th>

                                <th class="border-bottom-0">Total Amount</th>

                                @can('edit ambulance call','delete ambulance call')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($ambulanceCall as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->vehicle_model}} </td>
                                <td>{{ @$item->driver_name}} </td>
                                <td>{{ @$item->catagory->charges_catagories_name}} </td>
                                <td>{{ @$item->subCatagory->charges_sub_catagories_name}} </td>
                                <td>{{ @$item->total_amount}} </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit ambulance call')
                                            <a class="dropdown-item" href="{{ route('edit-ambulance-call-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete ambulance call')
                                            <a class="dropdown-item" href="{{ route('delete-ambulance-call-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection