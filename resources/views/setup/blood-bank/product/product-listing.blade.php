@extends('layouts.layout')

@section('content')

@can('add blood bank product')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Product</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-blood-bank-product-details') }}">
                @csrf
                <div class="">
                  
                    <div class="form-group">
                        <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" value="{{ old('product_name')}}" required>
                        @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group ">
                        <label for="description" class="form-label">Product Type</label>
                        <select name="product_type" class="form-control" id="product_type">
                            <option value="">Select</option>
                            @foreach (Config::get('static.productType') as $lang => $item)
                            <option value="{{$item}}"> {{$item}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('product_type') }}</small>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Product</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Product List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Product Name</th>
                                <th class="border-bottom-0">Product Type</th>
                                @can('edit blood bank product','delete blood bank product')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->product_name}}</td>
                                <td>{{ $item->product_type}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit blood bank product')
                                            <a class="dropdown-item" href="{{ route('edit-blood-bank-product-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete blood bank product')
                                            <a class="dropdown-item" href="{{ route('delete-blood-bank-product-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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