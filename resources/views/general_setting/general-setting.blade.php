@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">General Setting</h4>
        </div>
        <!-- ================== message============================== -->
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('save-general-setting') }}">
                @csrf
                <input type="hidden" name="id" value="1">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{@$general_details->software_name}}" name="software_name" placeholder="Name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" required value="{{@$general_details->email}}" class="form-control" name="email" placeholder="Email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{@$general_details->address}}" name="address" placeholder="Address">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">HF ID<span class="text-danger"></span></label>
                            <input type="text" required class="form-control" value="{{@$general_details->hf_id}}" name="hf_id" placeholder="HF-ID">
                            @error('abdm_hf_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">HMIS ID<span class="text-danger"></span></label>
                            <input type="text" required class="form-control" value="{{@$general_details->hmis_id}}" name="hmis_id" placeholder="HMIS-ID">
                            @error('hmis_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Phone No.<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{@$general_details->phone_no}}" name="phone_no" placeholder="Phone No.">
                            @error('gst_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Logo <span class="text-danger">*</span> (245px x 48px)</label>
                            <input type="file" name="logo" onchange="readURL(this);">
                            <img id="blah" width="50px" height="30px" src="{{ asset('public/assets/images/brand') }}/{{@$general_details->logo}}" alt="your image" />
                            @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Small Logo <span class="text-danger">*</span> (70px x 70px)</label>
                            <input type="file" name="small_logo" onchange="readURL_small_logo(this);">
                            <img id="blah_small_logo" width="50px" height="30px" src="{{ asset('public/assets/images/brand') }}/{{@$general_details->small_logo}}" alt="your image" />
                            @error('small_logo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">PO Permission Percentage <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{$general_details->po_permission_percentage}}" name="po_permission_percentage" placeholder="PO Permission Percentage">
                            @error('po_permission_percentage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Requisition Permission Percentage <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" name="rfq_permission_percentage" value="{{$general_details->req_permission_percentage}}" placeholder="Requisition Permission Percentage">
                            @error('rfq_permission_percentage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">PUC Alert Days <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{$general_details->puc_alert_days}}" name="puc_alert_days" placeholder="PUC Alert Days">
                            @error('puc_alert_days')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-9 mt-5">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(50)
                    .height(50);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    function readURL_small_logo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah_small_logo')
                    .attr('src', e.target.result)
                    .width(50)
                    .height(50);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection