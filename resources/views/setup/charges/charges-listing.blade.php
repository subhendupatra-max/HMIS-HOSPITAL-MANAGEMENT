@extends('layouts.layout')

@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Charges List
                </div>
                @can('add charges')
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a href="{{route('charges-add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Charges</a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Charges name</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Sub Catagory Name</th>
                                <th class="border-bottom-0">Type</th>
                                <th class="border-bottom-0">Standard Charges </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Description</th>
                                @can('delete charges','edit charges')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($charges as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->charges_name}}</td>
                                <td>{{ @$item->charges_catagory->charges_catagories_name}}</td>
                                <td>{{ @$item->charges_sub_catagory->charges_sub_catagories_name}}</td>
                                <td>{{ @$item->type}}</td>

                                <td>{{ @$item->standard_charges}}</td>
                                <td>{{ @$item->date}}</td>
                                <td>{{ @$item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit charges')
                                            <a class="dropdown-item" href="{{ route('edit-charges-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete charges')
                                            <a class="dropdown-item" href="{{ route('delete-charges-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>

@endsection