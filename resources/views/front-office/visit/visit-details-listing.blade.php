@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Visitor List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add visit')
                        <a href="{{ route('add-visit-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Visitor </a>
                        @endcan
                        @can('call log')
                        <a href="{{ route('all-phone-call-log-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-phone"></i> Call Log </a>
                        @endcan

                        @can('complain')
                        <a href="{{ route('all-complain-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></i> Complain </a>
                        @endcan

                        <div class="card-options carddrpdwn_area">
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                                Postal
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="">

                                @can('postal receive')
                                <a class="dropdown-item" href="{{ route('all-postal-receive-details') }}"><i class="fa fa-users"></i> Receive</a>
                                @endcan
                                @can('postal dispatch')
                                <a class="dropdown-item" href="{{  route('all-postal-dispatch-details') }}"><i class="fa fa-file-alt"></i>Dispatch</a>
                                @endcan
                            </div>
                        </div>

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
                                <th class="border-bottom-0">Purpose</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Phone No </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">In Time</th>
                                <th class="border-bottom-0">Out Time Time</th>
                                @can('edit visit ','delete visit ')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visit as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->purpose}} </td>
                                <td>{{ @$item->name}} </td>
                                <td>{{ @$item->phone}} </td>
                                <td>{{ date('d-m-Y',strtotime($item->date)) }} </td>
                                <td>{{ @$item->in_time}} </td>
                                <td>{{ @$item->out_time}} </td>

                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit visit')
                                            <a class="dropdown-item" href="{{ route('edit-visit-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete visit')
                                            <a class="dropdown-item" href="{{ route('delete-visit-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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