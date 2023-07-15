@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Requisiton List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('add medicine requisition')
                        <a href="{{ route('add-medicine-requisition-details') }}" class="btn btn-primary btn-sm "><i class="fa fa-plus mr-1"></i>Add Requision</a>
                        @endcan

                        @can('medicine purchase order')
                        <a href="{{ route('all-medicine-purchase-order-listing') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i>Purchase Order</a>
                        @endcan

                        @can('GRN')
                        <a href="{{ route('medicine-grn-list') }}" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> GRN </a>
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
                        <thead class="bg-primary text-white">
                            <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Requisition No.</th>
                                <th class="text-white">Date</th>
                                <th class="text-white">Generate By</th>
                                <th class="text-white">Status</th>
                                @can('edit medicine requisition','delete medicine requisition')
                                <th class="text-white">Action</th>
                                @endcan
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($medicine_requisition as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{ route('medicine-requisition-details',['id'=> ($item->id)]) }}" style="color: blue;">{{$item->requisition_prefix }}{{ @$item->id }}</a></td>
                                <td>{{ @$item->date}} </td>
                                <td>{{ @$item->generate_by_name->first_name}} {{ @$item->generate_by_name->last_name}} </td>
                                <td>{!!@$item->working_status->status!!}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            @can('view medicine requisition')
                                            <a class="dropdown-item" href="{{ route('medicine-requisition-details',['id'=> ($item->id)]) }}"><i class="fa fa-eye"></i> View</a>
                                            @endcan

                                            @can('edit medicine requisition')
                                            <a class="dropdown-item" href="{{ route('edit-medicine-requisition-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine requisition')
                                            <a class="dropdown-item" href="{{ route('delete-medicine-requisition-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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