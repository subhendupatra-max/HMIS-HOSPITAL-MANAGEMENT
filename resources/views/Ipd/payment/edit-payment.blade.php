@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Payment
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('message.notification')
        <div class="card-body ">
            <form action="{{ route('update-ipd-payment-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $ipd_details->patient_id }}" />
                <input type="hidden" name="case_id" value="{{ $ipd_details->case_id }}" />
                <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                <input type="hidden" name="section" value="Ipd" />
                <input type="hidden" name="id" value="{{ $editPayemnt->id }}" />
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="payment_date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required @if(isset($editPayemnt->payment_date)) value="{{ date('Y-m-d h:m:s',strtotime($editPayemnt->payment_date))}}" @endif>
                        @error('payment_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ $editPayemnt->payment_amount }}">
                        @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="payment_mode" class="form-label">Payment Mode </label>
                        <select id="payment_mode" class="form-control" name="payment_mode">
                            <option value="">Select Payment Mode... </option>
                            @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                            <option value="{{$item}}" {{$item == $editPayemnt->payment_mode ? 'selected' : " " }}> {{$item}}</option>
                            @endforeach
                            @error('payment_mode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="note" class="form-label">Note </label>
                        <textarea name="note" id="note" class="form-control"> {{$editPayemnt->note}}</textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Payment</button>
                </div>

            </form>
        </div>
    </div>
</div>



@endsection