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
                    Item Attribute List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('Inventory Item Attribute')
                        <a href="{{route('add-Inventory-item-attribute')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Item Attribute</a>
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
                                <th scope="col">Attribute Name</th>
                                <th scope="col">Attribute Label Name</th>
                                @can('Inventory Item Attribute Edit' , 'Inventory Item Attribute Delete')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemAttribute as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->attribute_name }}</td>
                                <td>{{ @$item->attribute_label_name }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('Inventory Item Attribute Edit')
                                            <a class="dropdown-item" href="{{ route('edit-Inventory-item-attribute',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('Inventory Item Attribute Delete')
                                            <a class="dropdown-item" href="{{ route('delete-Inventory-item-attribute',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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