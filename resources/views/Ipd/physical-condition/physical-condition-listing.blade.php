@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Patient Physical Condition
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add ipd physical condition')
                        <a href="{{ route('add-physical-condition-in-ipd',['ipd_id'=> base64_encode(@$ipd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Physical Condition </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            @include('ipd.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Height</th>
                                <th class="text-white">Weight</th>
                                <th class="text-white">Pulse</th>
                                <th class="text-white">BP</th>
                                <th class="text-white">Temperature</th>
                                <th class="text-white">Respiration</th>
                                @can('edit physical condition','delete physical condition')
                                <th class="text-white">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($PhysicalDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->height}}</td>
                                <td>{{$item->weight}}</td>
                                <td>{{$item->pulse}}</td>
                                <td>{{$item->bp}}</td>
                                <td>{{$item->temperature}}</td>
                                <td>{{$item->respiration}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit physical condition')
                                            <a class="dropdown-item" href="{{ route('edit-physical-condition-in-ipd',['id'=> base64_encode($item->id),'ipd_id'=> base64_encode($ipd_patient_details->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete physical condition')
                                            <a class="dropdown-item" href="{{ route('delete-physical-condition-in-ipd',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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