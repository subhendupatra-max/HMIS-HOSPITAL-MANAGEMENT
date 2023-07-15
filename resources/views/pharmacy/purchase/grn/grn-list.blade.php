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

                        @can('Medicine GRN Create')
                        <a href="{{route('medicine-grn-create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create GRN</a>
                        @endcan
                    </div>
                </div>

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
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                                <th class="text-white">Sl No.</th>
                                <th class="text-white">GRN No.</th>
                                <th class="text-white">Store Room</th>
                                <th class="text-white">Date</th>
                                <th class="text-white">Status</th>
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($grn_list) && $grn_list != '')
                            @foreach ($grn_list as $grn)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="{{route('medicine-grn-details')}}/{{base64_encode($grn->id)}}" style="color: blue;">{{$grn->grn_prefix}}{{ @$grn->id }}</a></td>
                                <td>{{@$grn->store_room_details->name}}</td>
                                <td><?= date('d-m-Y h:i', strtotime($grn->grn_date)); ?></td>
                                <td>
                                    @if ($grn->stock_update_status == '0')
                                    <span class="badge badge-warning">Stocks Not Updated</span>
                                    @else
                                    <span class="badge badge-success">Stocks Updated</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="{{route('medicine-grn-details',['id'=> base64_encode($grn->id)])}}"><i class="fa fa-eye"></i> View</a>

                                            <a class="dropdown-item" href="{{route('grn-edit',['id'=> base64_encode($grn->id)])}}"><i class="fa fa-edit"></i> Edit</a>

                                            @can('GRN Medicine delete')
                                            <a class="dropdown-item" href="{{route('grn-delete',['id'=> base64_encode($grn->id)])}}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan

                                            @can('Stock Update After GRN')
                                            @if ($grn->stock_update_status == '0')
                                            <a class="dropdown-item" onclick="return confirm('Are You Sure to add Item in Stock?')" href="{{route('stock-update-after-grn',['id'=> base64_encode($grn->id)])}}"><i class='fa fa-area-chart'></i> Stock Update</a>
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
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#removeIcon").click(function(e) {
            e.preventDefault();
            $("#delete").submit();
        });
    });
</script>
@endsection