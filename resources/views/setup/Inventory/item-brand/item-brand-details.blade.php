@extends('layouts.layout')

@section('content')

@can('')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Item Brand</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-inventory-item-brand') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="item_brand_name" class="form-label">Item Brand name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="item_brand_name" name="item_brand_name" placeholder="Enter Item Brand Name" value="{{ old('item_brand_name')}}" required>
                        @error('item_brand_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Item Brand</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item Brand List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Brand Name</th>
                                @can('Inventory Item Brand Edit','Inventory Item Brand Delete')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item_brand as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->item_brand_name}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('Inventory Item Brand Edit')
                                            <a class="dropdown-item" href="{{ route('edit-inventory-item-brand',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('Inventory Item Brand Delete')
                                            <a class="dropdown-item" href="{{ route('delete-inventory-item-brand',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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
</div>
@endsection