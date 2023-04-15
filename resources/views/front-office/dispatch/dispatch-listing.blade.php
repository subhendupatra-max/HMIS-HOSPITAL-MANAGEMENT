@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Dispatch List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add postal dispatch')
                        <a href="{{ route('add-postal-dispatch-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Dispatch </a>
                        @endcan
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
                                <th class="border-bottom-0">To Title </th>
                                <th class="border-bottom-0">Reference No</th>
                                <th class="border-bottom-0">From Title</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Date</th>
                                @can('edit complain','delete complain')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dispatch as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->to_title}} </td>
                                <td>{{ @$item->reference_no}} </td>
                                <td>{{ @$item->to_title}} </td>
                                <td>{{ @$item->address}} </td>
                                <td>{{ @$item->date}} </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit postal dispatch')
                                            <a class="dropdown-item" href="{{ route('edit-postal-dispatch-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete postal dispatch')
                                            <a class="dropdown-item" href="{{ route('delete-postal-dispatch-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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