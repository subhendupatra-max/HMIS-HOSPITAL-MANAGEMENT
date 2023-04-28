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
            <form method="POST" action="{{ route('save-medicine-vendor-details')  }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        {{--  <label for="vendor_name" class="form-label">Vendor Name</label>
                        <input type="text" value="" class="form-control" id="name" name="name" placeholder="Enter Vendor Name" required>  --}}
                        <input type="text"id="name" name="name">
                        <label  class="medicinelabel"for="name">Enter Vendor Name</label>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row row-sm">
                        <div class="col-lg vendordesign">
                            {{--  <label for="role" class="form-label">Vendor Email</label>
                            <input class="form-control mb-4" placeholder="Enter Vendor Email" id="email" name="email" type="text">  --}}
                            <input type="email"id="email" name="email">
                            <label for="email">Enter Vendor Email</label>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg vendordesign">
                            {{--  <label for="role" class="form-label">Vendor Phone no.</label>
                            <input class="form-control mb-4" placeholder="Enter Vendor Mobile No" id="pnno" name="pnno" type="text">  --}}
                            <input type="text"id="pnno" name="pnno">
                            <label for="pnno">Enter Vendor Mobile No</label>
                            @error('pnno')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg vendordesign">
                            {{--  <label for="role" class="form-label">Pincode.</label>
                            <input class="form-control mb-4" placeholder="Vendor pincode" id="pin" name="pin" type="text">  --}}
                            <input type="text"id="pin" name="pin">
                            <label for="pin">Vendor pincode</label>
                            @error('pin')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-sm">
                        <div class="col-lg vendordesignone">
                            {{--  <label for="role" class="form-label">GSTIN</label>
                            <input class="form-control mb-4" placeholder="Input box" id="gst" name="gst" value="" type="text">  --}}
                            <input type="text"id="gst" name="gst">
                            <label for="gst">GSTIN</label>
                            @error('gst')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg vendordesignone">
                            {{--  <label for="role" class="form-label">Contact Person name</label>
                            <input class="form-control mb-4" placeholder="Input box" value="" name="contact_name" type="text">  --}}
                            <input type="text"id="contact_name" name="contact_name">
                            <label for="role">Contact Person name</label>
                            @error('contact_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-sm">
                        <div class="col-lg vendordesignone">
                            {{--  <label for="vendor_address" class="form-label">Vendor Address</label>
                            <textarea class="form-control mb-4" placeholder="Enter Vendor Address" id="address" name="address" rows="3"></textarea>  --}}
                            <input type="text"id="address" name="address">
                            <label for="vendor_address">Enter Vendor Address</label>
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
