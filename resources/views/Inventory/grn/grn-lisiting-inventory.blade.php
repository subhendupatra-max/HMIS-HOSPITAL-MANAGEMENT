@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    GRN List
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('')
                        <a href="{{ route('grm-create-inven') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create GRN</a>
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
                                    <th scope="col">GRN No.</th>
                                    <th scope="col">Workshop</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($grm_list) && $grm_list != '')
                                @foreach ($grm_list as $grm)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                  
                                    <td><a   href="{{ route('grm-details-inven',['id'=> base64_encode($grm->id)]) }}" style="color: blue;">{{$grm->grm_prefix}}{{ @$grm->id }}</a></td>
                                    <td>{{@$grm->store_room->item_store_room}}</td>
                                    <td><?= date('d-m-Y h:i', strtotime($grm->grm_date)); ?></td>
                                    <td>
                                        @if ($grm->stock_update_status == '0')
                                        <span class="badge badge-warning">Stocks Not Updated</span>
                                        @else
                                        <span class="badge badge-success">Stocks Updated</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">

                                                <a class="dropdown-item" href="{{ route('grm-details-inven',['id'=> base64_encode($grm->id)]) }}" ><i class="fa fa-eye"></i> View</a>

                                                <a class="dropdown-item" href="{{ route('grm-edit-inven',['id'=> base64_encode($grm->id)]) }}" ><i class="fa fa-edit"></i> Edit</a>

                                                @can('GRN delete')
                                                <a class="dropdown-item" href="{{ route('grm-delete-inven',['id'=> base64_encode($grm->id)]) }}" ><i class="fa fa-trash"></i> Delete</a>
                                                @endcan

                                                @can('GRN print')
                                                <a class="dropdown-item" href="{{ route('grm-print-inven',['id'=> base64_encode($grm->id)]) }}" ><i class="fa fa-print"></i> Print</a>
                                                @endcan

                                                @can('Stock Update After GRN')
                                                @if ($grm->stock_update_status == '0')
                                                <a class="dropdown-item" onclick="return confirm('Are You Sure to add Item in Stock?')" href="{{ route('stock-update-after-grm-inven',['id'=> base64_encode($grm->id)]) }}" ><i class='fa fa-area-chart'></i> Stock Update</a>
                                                @endif
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