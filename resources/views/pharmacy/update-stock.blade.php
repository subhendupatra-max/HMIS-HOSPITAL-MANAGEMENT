@extends('layouts.layout')

@section('content')

@can('medicine rack')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Medicine Stock</h4>
        </div>
        <div class="card-header">
            <h4 class="card-title">Update Medicine Stock</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('save-medicine-rack-details') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name">Store Room</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="{{ old('medicine_rack_name')}}">
                               
                                @error('medicine_rack_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name"> Batch No.</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="{{ old('medicine_rack_name')}}">
                               
                                @error('medicine_rack_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name"> Expiry Date</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="{{ old('medicine_rack_name')}}">
                               
                                @error('medicine_rack_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name"> Quantity</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="{{ old('medicine_rack_name')}}">
                               
                                @error('medicine_rack_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name">Unit </label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="{{ old('medicine_rack_name')}}">
                               
                                @error('medicine_rack_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name">MRP </label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="{{ old('medicine_rack_name')}}">
                               
                                @error('medicine_rack_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="sale_price">Sale Price </label>
                                <input type="text" id="sale_price" name="sale_price"
                                    value="{{ old('sale_price')}}">
                               
                                @error('sale_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="purchase_price">Purchase Price </label>
                                <input type="text" id="purchase_price" name="purchase_price"
                                    value="{{ old('purchase_price')}}">
                               
                                @error('purchase_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Medicine Rack</button>
            </form>
        </div>
    </div>
</div>
@endcan

@endsection