@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Referral Person </h4>
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
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('save-referral') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="col-md-10">
                                <label class="form-label">Referral Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('referral_name') }}" name="referral_name" id="referral_name" placeholder="Referral Name">
                                @error('referral_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-10">
                                <label class="form-label">contact No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('phone_no') }}" name="phone_no" id="phone_no" placeholder="Enter Phone No">
                                @error('phone_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-10">
                                <label class="form-label">Standard Commission (%)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('standard_commission') }}" name="standard_commission" id="standard_commission" placeholder="Standard Commission">
                                @error('standard_commission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-6 text-right">
                                    <div class="d-block mt-3">
                                        @can('')
                                        <a href="#" onclick="getall_data()" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Apply To All</a>
                                        @endcan
                                    </div>
                                </div>

                            </div>


                        </div>


                        <div class="col-md-6">
                            @if ($model)
                            @foreach ($model as $value)
                            <div class="col-md-10">
                                <label class="form-label">{{$value->modules_name}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control m_raf_mod" require value="" name="ref_commision[]" id="{{$value->modules_name}}">
                            </div>
                            @endforeach
                            @endif
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Add Referral</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function getall_data() {
        let value = $('#standard_commission').val();
        $('.m_raf_mod').val(value);
    }
</script>



<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection