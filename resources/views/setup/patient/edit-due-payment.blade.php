@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Edit Payment
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('update-patient-due-bill') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="payment_id" value="{{ $payment_id }}" />
                    <div class="form-group col-md-6">
                        <label for="payment_date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" value="{{ $payment_details->payment_date }}" class="form-control" id="payment_date" name="payment_date" required>
                        @error('payment_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required id="amount" name="payment_amount" value="{{ $payment_details->payment_amount }}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="payment_mode" class="form-label">Payment Mode<span class="text-danger">*</span> </label>
                        <select id="payment_mode" required class="form-control" name="payment_mode">
                            <option value="">Select Payment Mode... </option>
                            @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                            <option value="{{$item}}" {{@$item == @$payment_details->payment_mode ? 'selected' : '' }} > {{$item}}</option>
                            @endforeach
                            @error('payment_mode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="note" class="form-label">Note<span class="text-danger">*</span> </label>
                        <input name="note" id="note"  class="form-control" value="{{ $payment_details->note }}" />
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Payment</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection
