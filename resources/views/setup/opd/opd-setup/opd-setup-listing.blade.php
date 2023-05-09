@extends('layouts.layout')

@section('content')
@can('add opd setup')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">OPD Set-up</h4>
        </div>
        @include('message.notification')
        <div class="card-body">
            <form method="POST" action="{{ route('save-opd-setup-details') }}">
                @csrf
                <div class="row">
                    <input type="hidden" value="1" name="id">
                    <div class="col-md-6 form-group">
                        <label for="ticket_no_calculate" class=""> Ticket No Calculate <span class="text-danger">*</span></label>
                        <select name="ticket_no_calculate" class="form-control select2-show-search" id="ticket_no_calculate">
                            <option value="">Select</option>
                            @foreach (Config::get('static.opd_setup') as $lang => $setup)
                            <option value="{{ $setup }}" {{ $setup == $opdSetup->ticket_no_calculate ? 'selected' : ' ' }}>
                                {{ $setup }}
                            </option>
                            @endforeach
                        </select>
                        @error('ticket_no_calculate')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group opdsetupdesign">
                        <label for="ticket_fees" class="form-label">Ticket Fees<span class="text-danger">*</span></label>
                        <input name="ticket_fees" value="{{ $opdSetup->ticket_fees }}" type="text" class="form-control" />
                        @error('ticket_fees')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group opdsetupdesign">
                        <label for="registration_type" class=""> Registation Type <span class="text-danger">*</span></label>
                        <select name="registration_type" class="form-control select2-show-search" id="registration_type">
                            <option value="">Select</option>
                            @foreach (Config::get('static.registration_type') as $lang => $type)
                            <option value="{{ $type }}" {{ $type == $opdSetup->registration_type ? 'selected' : ' ' }}>
                                {{ $type }}
                            </option>
                            @endforeach
                        </select>


                        @error('registration_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-4 mb-0">Update OPD Setup</button>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection