@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Discharged Patient
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add ipd discharge')
                        <a href="{{ route('add-discharged-patient-in-ipd',['ipd_id'=> base64_encode(@$ipd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Discharge Patient </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
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
                                <th class="border-bottom-0">Discharge Date</th>
                                <th class="border-bottom-0">Discharge Status</th>
                                <th class="border-bottom-0">Icd Code </th>
                                <th class="border-bottom-0">Note</th>
                                <th class="border-bottom-0">Operation</th>
                                <th class="border-bottom-0">Diagonasis</th>
                                @can('edit physical condition','delete physical condition')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patient_discharge_details as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->discharge_date}}</td>
                                <td>{{$item->discharge_status}}</td>
                                <td>{{$item->icd_code}}</td>
                                <td>{{$item->note}}</td>
                                <td>{{$item->operation}}</td>
                                <td>{{$item->diagnosis}}</td>
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