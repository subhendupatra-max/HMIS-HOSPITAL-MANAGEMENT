@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Complain List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add complain')
                        <a href="{{ route('add-complain-details') }}" class="btn btn-primary btn-sm"> Add Complain </a>
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
                                <th class="border-bottom-0">Complain Type</th>
                                <th class="border-bottom-0">Source</th>
                                <th class="border-bottom-0">Complain By</th>
                                <th class="border-bottom-0">Phone</th>
                                <th class="border-bottom-0">Date</th>
                                @can('edit complain','delete complain')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complain as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->complain_type}} </td>
                                <td>{{ @$item->source}} </td>
                                <td>{{ @$item->complain_by}} </td>
                                <td>{{ @$item->phone}} </td>
                                <td>{{ @$item->date}} </td>
                            <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit complain')
                                            <a class="dropdown-item" href="{{ route('edit-complain-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete complain')
                                            <a class="dropdown-item" href="{{ route('delete-complain-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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