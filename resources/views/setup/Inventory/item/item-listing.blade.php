@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    @if (session('success'))
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
    @endif

    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Item List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('Inventory Item')
                        <a href="{{route('add-Inventory-item')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Item</a>
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
                                <th scope="col">Sl No.</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Category</th>
                                <th scope="col">Part No.</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Manufacturer Name</th>
                                <th scope="col">Stored</th>
                                <th scope="col">HSN or SAC No</th>
                                <th scope="col">Loworder Level</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">
                                    @can('Inventory Item Delete' , 'Inventory Item Edit')
                                    Action
                                    @endcan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->item_name }}</td>
                                <td>{{ @$item->fetch_catagory_name->item_catagory_name }}</td>
                                <td>{{ @$item->part_no }}</td>
                                <td>{{ @$item->fetch_brand_name->item_brand_name }}</td>
                                <td>{{ @$item->fetch_manufacture_name->manufacture_name }}</td>
                                <td>{{ @$item->stored }}</td>
                                <td>{{ @$item->hsn_or_sac_no }}</td>
                                <td>{{ @$item->loworder_level }}</td>
                                <td>{{ @$item->product_code }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('Inventory Item Edit')
                                            <a class="dropdown-item" href="{{ route('edit-Inventory-item',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('Inventory Item Delete')
                                            <a class="dropdown-item" href="{{ route('delete-Inventory-item',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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