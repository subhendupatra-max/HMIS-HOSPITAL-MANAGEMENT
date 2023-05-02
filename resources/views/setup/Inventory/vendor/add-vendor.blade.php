@extends('layouts.layout')

@section('content')


<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-header">
            <h4 class="card-title">Add Vendor</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('save-Inventory-vendor')  }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="vendor_name" class="medicinelabel">Enter Vendor Name</label>
                        <input type="text" value="" id="name" name="name" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row row-sm">
                        <div class="col-lg addvendoredit">
                            <label for="role" >Vendor Email</label>
                            <input class=" mb-4"  id="email" name="email" type="text">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg addvendoredit">
                            <label for="role" >Enter  Vendor Phone no.</label>
                            <input class=" mb-4" id="pnno" name="pnno" type="text">
                            @error('pnno')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg addvendoredit ">
                            <label for="role">Pincode.</label>
                            <input class=" mb-4"id="pin" name="pin" type="text">
                            @error('pin')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-sm">
                        <div class="col-lg addvendoredit">
                            <label for="role">GSTIN</label>
                            <input class=" mb-4"  id="gst" name="gst" value="" type="text">
                            @error('gst')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg addvendoredit">
                            <label for="role" >Contact Person name</label>
                            <input class=" mb-4" value="" name="contact_name" type="text">
                            @error('contact_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-sm">
                        <div class="col-lg addvendoredit">
                            <label for="vendor_address">Vendor Address</label>
                            {{--  <textarea class="form-control mb-4" placeholder="Enter Vendor Address" id="address" name="address" rows="3"></textarea>  --}}
                            <input class="" value="" id="address" name="address"type="text">
                        </div>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Vendor</button>
            </form>
        </div>
    </div>
</div>


@endsection
