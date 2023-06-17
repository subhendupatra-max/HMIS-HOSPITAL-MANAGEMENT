@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Slots List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add slots')
                        <a href="{{ route('add-slots-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-clock"></i> Add New Slots </a>
                        @endcan
                    </div>
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
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Doctor</th>
                                <th class="border-bottom-0">Days</th>
                                <th class="border-bottom-0">From Time</th>
                                <th class="border-bottom-0">To Time</th>
                                @can('edit slots','delete slots')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slots as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->fetch_doctor_name->first_name}} {{ @$item->fetch_doctor_name->last_name}}</td>
                                <td>{{ $item->days}}</td>
                                <td>{{ date('H:i A',strtotime($item->from_time))}}</td>
                                <td>{{ date('H:i A',strtotime($item->to_time))}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit slots')
                                            <a class="dropdown-item" href="{{ route('edit-slots-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete slots')
                                            <a class="dropdown-item" href="{{ route('delete-slots-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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