@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Medicine Stock
                </div>
                <div class="col-md-6 text-right">

                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Medicine Name</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Medicine Composition</th>
                                <th class="border-bottom-0">Stock </th>
                                @can('update stock from back')
                                    <th class="border-bottom-0">Stock Update</th>
                                @endcan
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$medicine_stock)
                            @foreach ($medicine_stock as $value)

                            <?php if($value->available_quantity <= $value->min_level && $value->available_quantity > 0)
                            {
                                $stock_status = $value->available_quantity.' '.$value->medicine_unit_name.' <span class="badge badge-warning">Low Stock</span>';
                            }
                            elseif ($value->available_quantity <= 0 ) {
                                $stock_status = ' <span class="badge badge-danger">Out Of Stock</span>';
                            }
                            else {
                                $stock_status = $value->available_quantity .' '.$value->medicine_unit_name;
                            }

                             ?>
                                <tr>
                                    <td><a href= "{{ route('medicine-details',['medicine_id'=>$value->id]) }}" class="text-info">{{ $value->medicine_name}}</a></td>
                                    <td>{{$value->medicine_catagory_name}}</td>
                                    <td>{{$value->medicine_composition}}</td>
                                    <td>{!!$stock_status!!}</td>
                                    @can('update stock from back')
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{ route('update-medicine-stock',['medicine_id'=>$value->id]) }}">Update Stock</a>
                                    </td>
                                    @endcan
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
 @endsection
