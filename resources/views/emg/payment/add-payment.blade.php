@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Payment
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href="{{route('opd-profile',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-home"></i> Profile</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-billing' ? 'active' : '' }}" href="{{route('opd-billing',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-money-bill"></i> Billing</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-payment' ? 'active' : '' }}" href="{{route('payment-listing-in-opd',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-rupee-sign"></i> Payment</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-timeline' ? 'active' : '' }}" href="{{route('timeline-lisitng-in-opd',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="far fa-calendar-check"></i> Timeline</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('save-payment-in-emg') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="emg_id" value="{{ $emg_id }}" />
                    <div class="form-group col-md-6">
                        <label for="payment_date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required>
                        @error('payment_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                        @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="payment_mode" class="form-label">Payment Mode </label>
                        <select id="payment_mode" class="form-control" name="payment_mode">
                            <option value="">Select Payment Mode... </option>
                            @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                            <option value="{{$item}}"> {{$item}}</option>
                            @endforeach
                            @error('payment_mode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="note" class="form-label">Note </label>
                        <textarea name="note" id="note" class="form-control"> </textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Payment</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection
