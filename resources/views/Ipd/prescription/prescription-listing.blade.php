@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Prescirption
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('ipd prescription')
                        <a href="{{ route('add-prescription-in-ipd',['id'=> base64_encode($ipd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-report"></i> Add Prescription </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('Ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            @include('Ipd.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Medicine Name</th>
                                <th class="border-bottom-0">Medicine Catagory</th>
                                <th class="border-bottom-0">Dose</th>
                                <th class="border-bottom-0">Interval</th>
                                @can('edit ipd payment','delete ipd payment')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ipdPrescription as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{date('d-m-Y h:i a',strtotime(@$item->prescription_date))}}</td>
                                <td>{{@$item->eprescription_details->medicine_details->medicine_name}}</td>
                                <td>{{@$item->eprescription_details->medicine_details->catagory_name->medicine_catagory_name}}</td>
                                <td>{{@$item->eprescription_details->dose}}</td>
                                <td>{{@$item->eprescription_details->interval}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit-payment-in-ipd')
                                            <a class="dropdown-item" href="{{ route('prescription-view-in-ipd',['id'=> base64_encode($item->id),'ipd_id'=> base64_encode($ipd_details->id)]) }}"><i class="fa fa-edit"></i> View</a>
                                            @endcan

                                            @can('edit-prescription-in-ipd')
                                            <a class="dropdown-item" href="{{ route('edit-prescription-in-ipd',['id'=> base64_encode($item->id),'ipd_id'=> base64_encode($ipd_details->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete-payment-in-ipd')
                                            <a class="dropdown-item" href="{{ route('delete-prescription-in-ipd',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan

                                            @can('print-prescription-in-ipd')
                                            <a class="dropdown-item" href="{{ route('print-prescription-in-ipd',['id'=> base64_encode($item->id), 'ipd_id'=> base64_encode($ipd_details->id)]) }}"><i class="fa fa-trash"></i> Print</a>
                                            @endcan

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $ipdPrescription->links() !!}
                </div>
            </div>
        </div>
    </div>
    @endsection