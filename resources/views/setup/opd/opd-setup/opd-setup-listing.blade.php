@extends('layouts.layout')

@section('content')
    @can('add opd setup')
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ticket NO Calculate</h4>
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
                    <form method="POST" action="{{ route('save-opd-setup-details') }}">
                        @csrf
                        <div class="">
                            <input type="hidden" value="1" name="id">
                            <div class="col-md-4 form-group">
                                <label for="ticket_no_calculate" class="form-label"> Ticket No Calculate <span
                                        class="text-danger">*</span></label>
                                <select name="ticket_no_calculate" class="form-control select2-show-search"
                                    id="ticket_no_calculate">
                                    <option value="">Select</option>
                                    @foreach (Config::get('static.opd_setup') as $lang => $setup)
                                        <option value="{{ $setup }}"
                                            {{ $setup == $opdSetup->ticket_no_calculate ? 'selected' : ' ' }}>
                                            {{ $setup }}</option>
                                    @endforeach
                                </select>
                                @error('ticket_no_calculate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="ticket_fees" class="form-label">Ticket Fees<span
                                        class="text-danger">*</span></label>
                                <input name="ticket_fees" type="text" class="form-control" />
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
