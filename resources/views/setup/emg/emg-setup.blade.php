@extends('layouts.layout')

@section('content')
    @can('Emg setUp')
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting</h4>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button>{{ session('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button>{{ session('error') }}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('save-emg-setup-details') }}">
                        @csrf
                        <div class="">
                            <input type="hidden" value="{{$setup_details->id}}" name="id">

                            <div class="col-md-4 form-group">
                                <label for="ticket_fees" class="form-label">Ticket Fees<span
                                        class="text-danger">*</span></label>
                                <input name="ticket_fees" type="text" class="form-control" value="{{@$setup_details->ticket_fees}}" />
                                @error('ticket_fees')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-0">Add Setup</button>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
