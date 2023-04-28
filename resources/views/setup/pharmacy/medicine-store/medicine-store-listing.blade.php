@extends('layouts.layout')

@section('content')

@can('medicine store')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Medicine Store</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-medicine-store-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        {{--  <label for="medicine_store_name" class="form-label">Medicine Store name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medicine_store_name" name="medicine_store_name" placeholder="Enter Medicine Store Name" value="{{ old('medicine_store_name')}}" required>  --}}
                            <input type="text" value="{{ old('medicine_store_name')}}" id="medicine_store_name"  name="medicine_store_name">
                            <label class="medicine-storeinput" for="medicine_store_name">Enter Medicine Store Name</label>
                        @error('medicine_store_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Medicine Store</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Medicine Store List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Medicine Store Name</th>
                                @can('edit medicine store','delete medicine store')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicineStore as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->medicine_store_name}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit medicine store')
                                            <a class="dropdown-item" href="{{ route('edit-medicine-store-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine store')
                                            <a class="dropdown-item" href="{{ route('delete-medicine-store-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
