@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                 Phone Call Log List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add call log')
                        <a href="{{ route('add-call-log-details') }}" class="btn btn-primary btn-sm"> Add Call Log </a>
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
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Phone</th>
                                <th class="border-bottom-0">Next Follow Up Date</th>
                                <th class="border-bottom-0">Call Type</th>
                                <th class="border-bottom-0">Description</th>
                                @can('edit call log','delete call log')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phoneLog as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->name}} </td>
                                <td>{{ @$item->phone}} </td>
                                <td>{{ @$item->next_fllow_up_date}} </td>
                                <td>{{ @$item->call_type}} </td>
                                <td>{{ @$item->description}} </td>
                            <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit call log')
                                            <a class="dropdown-item" href="{{ route('edit-call-log-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete call log')
                                            <a class="dropdown-item" href="{{ route('delete-call-log-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
z
    </div>
</div>
    @endsection