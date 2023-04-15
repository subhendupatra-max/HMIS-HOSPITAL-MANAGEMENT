@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Change Password</h4>
        </div>
<!-- ================== message============================== -->
        @if (session('success'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
<!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('save-change-password') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Old Password <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{old('old_password')}}"  name="old_password" placeholder="Old Password">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{old('new_password')}}"  name="new_password" placeholder="New Password">
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{old('confirm_password')}}" name="confirm_password" placeholder="Confirm Password">
                            @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
             
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Change Password</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection 