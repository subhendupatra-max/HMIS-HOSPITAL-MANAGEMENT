@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Return Item List
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('Create Return PO Item Inventory')
                        <a href="{{ route('return-create-inventory') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create GRN</a>
                        @endcan
                    </div>
                </div>
            </div>

        </div>
        @include('message.notification')
        <div class="card-body ">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">Return Form No.</th>
                                    <th scope="col">Workshop</th>
                                    <th scope="col">Rejection Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($return_list) && $return_list != '')
                                @foreach ($return_list as $value)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                                                        
                                    <td><a href="{{ route('return-details-inventory',['id'=> base64_encode($value->id)]) }}" style="color: blue;">{{$value->return_prefix}}{{ @$value->id }}</a></td>

                                    <td>{{@$value->store_room->item_store_room}}</td>
                                    <td><?= date('d-m-Y h:i', strtotime($value->rejection_date)); ?></td>

                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">

                                                <a class="dropdown-item"  href="{{ route('return-details-inventory',['id'=> base64_encode($value->id)]) }}"><i class="fa fa-eye"></i> View</a>
                                                @can('edit Return PO Item')
                                                <a class="dropdown-item" href="{{ route('return-edit-inventory',['id'=> base64_encode($value->id)])}}"><i class="fa fa-edit"></i> Edit</a>
                                                @endcan

                                                @can('delete Return PO Item')
                                                <a class="dropdown-item" href="{{ route('return-delete-inventory',['id'=>base64_encode($value->id)])}}"><i class="fa fa-trash"></i> Delete</a>
                                                @endcan

                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection