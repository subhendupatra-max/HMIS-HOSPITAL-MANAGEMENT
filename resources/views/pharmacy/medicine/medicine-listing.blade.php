@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Medicines Stock
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('')
                        <a href="{{ route('import-medicine') }}" class="btn btn-primary btn-sm "><i class="fa fa-upload mr-1"></i>Import Medicines</a>
                        @endcan

                        @can('add medicine')
                        <a href="{{ route('add-medicine-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i>Add Medicine</a>
                        @endcan

                        @can('')
                        <a href="{{ route('all-medicine-requisition-listing') }}" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Purchase </a>
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
                                <th class="border-bottom-0">Medicine Name </th>
                                <th class="border-bottom-0">Medicine Category</th>
                                <th class="border-bottom-0">Medicine Company </th>
                                <th class="border-bottom-0">Medicine Composition</th>
                                <th class="border-bottom-0">Medicine Group </th>
                                @can('edit medicine','delete medicine')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicine as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->medicine_name}} </td>
                                <td>{{ @$item->catagory_name->medicine_catagory_name}} </td>
                                <td>{{ @$item->medicine_company}} </td>
                                <td>{{ @$item->medicine_composition}} </td>
                                <td>{{ @$item->medicine_group}} </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit medicine')
                                            <a class="dropdown-item" href="{{ route('edit-medicine-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine')
                                            <a class="dropdown-item" href="{{ route('delete-medicine-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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