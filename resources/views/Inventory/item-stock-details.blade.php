@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Item Stock
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                    @can('Requisition')
                        <a href="{{route('all-inventory-requisition-listing')}}" class="btn btn-primary"><i class="fa fa-file"></i> Requisition</a>
                    @endcan

                    </div>
                </div>

            </div>
        </div>
        @can('Item Stock')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($item))
                            @foreach($item as $value)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="#" style="color:blue">{{$value->item_name}}({{$value->item_description}})</a></td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
        @endcan
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