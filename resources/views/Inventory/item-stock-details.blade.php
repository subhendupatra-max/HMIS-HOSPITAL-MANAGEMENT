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

                        @can('Item Issue Inventory')
                        <a href="{{route('item-issue-listing-inventory')}}" class="btn btn-primary"> <i class="fa fa-cart-arrow-down"></i> Issue Item</a>
                        @endcan

                        @can('Inventory Requisition')
                        <a href="{{route('all-inventory-requisition-listing')}}" class="btn btn-primary"><i class="fa fa-file"></i> Requisition</a>
                        @endcan

                        @can('Inventory Purchase Order')
                        <a href="{{ route('Purchase-Order-list-inventory') }}" class="btn btn-primary"><i class="fa fa-file-invoice"></i> Purchase Order</a>
                        @endcan

                        @can('GRN Inventory')
                        <a href="{{route('grm-list-inven')}}" class="btn btn-primary"><i class="fa fa-list"></i> GRN</a>
                        @endcan

                        @can('Return PO Item')
                        <a href="{{route('return-list-inventory')}}" class="btn btn-primary"><i class="fa fa-undo"></i> Return</a>
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
                                <th scope="col">Item Type</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Part No</th>
                                <th scope="col">Low Order Level</th>
                                @can('update stock from back inventory')
                                <th class="border-bottom-0">Stock Update</th>
                                @endcan

                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($item_stock_list))
                            @foreach($item_stock_list as $value)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="#" style="color:blue">{{@$value->item_name}}({{$value->item_description}})</a></td>
                                <td>{{@$value->fetch_itemTypes_details->item_type_name}}</td>
                                <?php
                                $item_stock = DB::table('inventory_item_stocks')
                                    ->where('item_id', $value->id)->sum('quantity');

                                $item_issue = DB::table('inventory_item_issue_details')
                                    ->where('item_id', $value->id)->sum('quantity');

                                $stock = ($item_stock - $item_issue);

                                ?>
                                <td>
                                    {{@$stock}} {{ @$value->item_unit_name->units}}
                                </td>
                                <td>
                                    {{ @$value->part_no}}
                                </td>
                                <td>
                                    {{ @$value->loworder_level}}
                                </td>

                                @can('update stock from back inventory')
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ route('update-inventory-stock',['item_id' => $value->id ]) }}">Update Stock</a>
                                </td>
                                @endcan

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