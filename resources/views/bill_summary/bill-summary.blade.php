@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Bill Summary
                </div>

                <div class="col-md-8 text-right">
               
                </div>
            </div>

        </div>
        @include('message.notification')
        <div class="card-body ">
            <form action="{{ route('save-medicaiton-dose') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="case_id_or_uhid_no" class="form-label">Case Id / UHID No. <span class="text-danger">*</span></label>
                        <input type="number" class="form-control billsummary" id="case_id_or_uhid_no" name="case_id_or_uhid_no" required>
                        @error('case_id_or_uhid_no')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="case_id_or_uhid_no_select" class="form-label">Case Id / UHID No. <span class="text-danger">*</span></label>
                        <select name="" id="case_id_or_uhid_no_select" class="form-control select2-show-search">
                            <option value="">Select One....</option>
                            <option value="uhid_no">UHID No.</option>
                            <option value="case_id">Case Id</option>
                        </select>
                        @error('case_id_or_uhid_no_select')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection