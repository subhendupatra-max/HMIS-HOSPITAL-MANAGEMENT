@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Add Charges Package Name
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add package name')
                        <a href="{{ route('add-charges-package-name-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Charges Package </a>
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
                                <th class="border-bottom-0">Catagory</th>
                                <th class="border-bottom-0">Sub Catagory</th>
                                <th class="border-bottom-0">Charges Package Name</th>
                                <th class="border-bottom-0">Tax</th>
                                <th class="border-bottom-0">Total Amount</th>
                                @can('edit package name','delete package name')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chargePackageName as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->chargesPackageCatagoryName->charges_package_catagories_name}}</td>
                                <td>{{$item->chargesPackageSubCatagoryName->charges_package_sub_catagory_name }}</td>
                                <td>{{$item->package_name}}</td>
                                <td>{{$item->tax}}</td>
                                <td>{{$item->total_amount}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit package name')
                                            <a class="dropdown-item" href="{{ route('edit-charges-package-name-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete package name')
                                            <a class="dropdown-item" href="{{ route('delete-charges-package-name-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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