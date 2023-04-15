@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">All header</h4>
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
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('save-all-header-details') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $allheader->id }}">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Header Name <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{@$allheader->header_name}}" name="header_name" placeholder="Name">
                            @error('header_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      
                        <div class="col-md-4">
                            <label class="form-label">Logo <span class="text-danger">*</span> (245px x 48px)</label>
                            <input type="file" name="logo" onchange="readURL(this);">
                            <img id="blah" width="50px" height="30px" src="{{ asset('public/assets/images/header') }}/{{@$allheader->logo}}" alt="your image" />
                            @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       
                    </div>
                    <hr>
                    

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

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection