@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Payment</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-payment-in-emg') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $editEmgPaymentDetails->id }}" />
                    <input type="hidden" name="emg_id" value="{{ $editEmgPaymentDetails->emg_id }}" />

                    <div class="form-group col-md-6">
                        <label for="payment_date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required @if(isset($editEmgPaymentDetails->payment_date)) value="{{ date('Y-m-d h:m:s',strtotime($editEmgPaymentDetails->payment_date)) }}" @endif>
                        @error('payment_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ $editEmgPaymentDetails->amount }}">
                        @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="payment_mode" class="form-label">Payment Mode </label>
                        <select id="payment_mode" class="form-control" name="payment_mode">
                            <option value="">Select Payment Mode... </option>
                            @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                            <option value="{{$item}}" {{ $item == $editEmgPaymentDetails->payment_mode ? 'selected' : " "}}> {{$item}}</option>
                            @endforeach
                            @error('payment_mode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="note" class="form-label">Note </label>
                        <textarea name="note" id="note" class="form-control"> {{ $editEmgPaymentDetails->note}} </textarea>
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