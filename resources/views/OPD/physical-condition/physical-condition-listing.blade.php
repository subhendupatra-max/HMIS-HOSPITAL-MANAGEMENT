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
                        @can('add opd physical condition')
                        <a href="{{ route('add-physical-condition-in-opd',['id'=> base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Physical Condition </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('OPD.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            @include('OPD.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Height</th>
                                <th class="border-bottom-0">Weight</th>
                                <th class="border-bottom-0">Pulse</th>
                                <th class="border-bottom-0">BP</th>
                                <th class="border-bottom-0">Temperature</th>
                                <th class="border-bottom-0">Respiration</th>
                                @can('edit physical condition','delete physical condition')
                                <th>Action</th>
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
                                            <a class="dropdown-item" href="{{ route('edit-physical-condition-in-opd',['id'=> base64_encode($item->id),'opd_id'=> base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete physical condition')
                                            <a class="dropdown-item" href="{{ route('delete-physical-condition-in-opd',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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
    @endsection