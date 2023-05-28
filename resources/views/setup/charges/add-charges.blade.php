@extends('layouts.layout')

@section('content')
@can('add charges')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Charges</h4>
        </div>
        @include('message.notification')
        <div class="card-body">
            <form method="POST" action="{{ route('save-charges-details') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group">
                                        <label for="charges_catagory_id">Charges Catagory <span
                                                class="text-danger">*</span></label>
                                        <select id="charges_catagory_id" class="form-control"
                                            name="charges_catagory_id">
                                            <option value=" ">Select Charges Catagory </option>
                                            @foreach ($charges_catagory_id as $item)
                                            <option value="{{ $item->id }}">{{ $item->charges_catagories_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('charges_catagory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group">
                                        <label for="charges_sub_catagory_id">Charges Sub Catagory <span
                                                class="text-danger">*</span></label>
                                        <select id="charges_sub_catagory_id" class="form-control"
                                            name="charges_sub_catagory_id">
                                            <option value=" ">Select Charges Sub Catagory </option>
                                            @foreach ($charges_sub_catagory_id as $item)
                                            <option value="{{ $item->id }}">{{ $item->charges_sub_catagories_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('charges_sub_catagory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 addchargedesignin">
                                    <div class="form-group ">
                                        <label for="standard_charges">Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ old('date') }}">
                                        <small class="text-danger">{{ $errors->first('date') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-8 addchargedesign">
                                    <div class="form-group ">
                                        {{-- <label for="charges_name">Charges name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="charges_name" name="charges_name"
                                            placeholder="Enter Charges Name" value="{{ old('charges_name') }}" required>
                                        --}}
                                        <input type="text" value="{{ old('charges_name') }}" id="charges_name"
                                            name="charges_name">
                                        <label for="charges_name">Enter Charges Name <span
                                                class="text-danger">*</span></label>
                                        @error('charges_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group ">
                                        {{-- <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description"
                                            name="description"> {{ old('description') }} </textarea> --}}
                                        <input type="text" value=" {{ old('description') }} " id="sdescription"
                                            name="description">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                @if($charges_type[0]->id != null)
                                @foreach($charges_type as $value)
                                <input name="charge_type_id[]" type="hidden" value="{{ @$value->id }}" />
                                <div class="col-md-12 addchargedesign">
                                    <div class="form-group">
                                        <label for="charge_type">Charge for {{ @$value->charge_type_name }} Patient<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="charge_amount[]" />
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Charges</button>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection