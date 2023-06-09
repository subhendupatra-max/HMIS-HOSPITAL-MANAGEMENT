@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Call Log </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-call-log-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-md-4 newaddcalltext">
                        <!-- <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required> -->
                        <input type="text" id="name" name="name" required="">
                        <label for="name">Enter Name<span class="text-danger">*</span></label>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 newaddcalltext">
                        <!-- <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required> -->
                        <input type="text" id="phone" name="phone" required="">
                        <label for="phone">Enter Phone<span class="text-danger">*</span></label>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <!-- <label for="date" class="form-label">Date<span class="text-danger">*</span></label> -->
                        <h6>Date<span class="text-danger">*</span></h6>
                        <input type="date" class="form-control" id="date" name="date" required>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 newaddcalltext">
                        <!-- <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"> </textarea> -->
                        <input type="text" id="description" name="description">
                        <label for="description">Description</label>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 newaddcalltext" >
                      
                        <input type="date" class="form-control" id="next_fllow_up_date" name="next_fllow_up_date">
                        <label for="next_fllow_up_date">Next Follow Up Date</label>
                        @error('next_fllow_up_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 newaddcalltext ">
                        <!-- <label for="call_duraiton" class="form-label">Call Duraiton<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="call_duraiton" name="call_duraiton" placeholder="Enter Call Duraiton"> -->
                        <input type="text" id="call_duraiton" name="call_duraiton">
                        <label for="call_duraiton">Call Duraiton</label>
                        @error('call_duraiton')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4" style="
                    margin: 28px 0px 0px 0px;">
                        <label for="call_type" class="form-label">Call Type</label>
                        <input type="radio" name="call_type" value="incoming" class="from-control"><span class="font-weight-bold;">Incoming</span>
                        <input type="radio" name="call_type" value="outgoing" class="from-control" checked><span class="fw-bold;">Outgoing</span>
                        @error('call_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4" style="
                    margin: 28px 0px 0px 0px;">
                        <!-- <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"> </textarea> -->
                        <input type="text" id="note" name="note">
                        <label for="note">Note</label>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

            
        </div>  
          <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Call </button>
                </div>
        </form>
    </div>

</div>

</div>


@endsection