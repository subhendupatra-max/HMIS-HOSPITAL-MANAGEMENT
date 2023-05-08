@extends('layouts.layout')

@section('content')
    @can('edit charges')
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Charges</h4>
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
                    <form method="POST" action="{{ route('update-charges-details') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $editCharges->id }}">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">Type <span class="text-danger">*</span></label>
                                        <select id="type" class="form-control" name="type">
                                            <option value=" ">Select type </option>
                                            @foreach (Config::get('static.charges_type') as $lang => $charges_type)
                                                <option value="{{ $charges_type }}" {{ @$charges_type == $editCharges->type ? 'selected' : ' ' }} > {{ $charges_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="charges_catagory_id">Charges Catagory <span
                                            class="text-danger">*</span></label>
                                        <select id="charges_catagory_id" class="form-control select2-show-search"
                                            name="charges_catagory_id">
                                            <option value=" ">Select Charges Catagory </option>
                                            @foreach (@$charges_catagory_id as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ @$item->id == $editCharges->charges_catagory_id ? 'selected' : ' ' }}>
                                                    {{ $item->charges_catagories_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('charges_catagory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="charges_sub_catagory_id">Charges Sub Catagory <span
                                            class="text-danger">*</span></label>
                                        <select id="charges_sub_catagory_id" class="form-control select2-show-search"
                                            name="charges_sub_catagory_id">
                                            <option value=" ">Select Charges Sub Catagory </option>
                                            @foreach ($charges_sub_catagory_id as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ @$item->id == $editCharges->charges_sub_catagory_id ? 'selected' : ' ' }}>
                                                    {{ $item->charges_sub_catagories_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('charges_sub_catagory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 chargespackagesetup">
                                   <div class="form-group">
                                        <label for="charges_name">Enter Charges Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="charges_name" name="charges_name"
                                             value="{{ $editCharges->charges_name }}" required>
                                        @error('charges_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 chargespackagesetup">
                                    <div class="form-group">
                                        <label for="standard_charges">Standard Charges <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="standard_charges" name="standard_charges"
                                            value="{{ $editCharges->standard_charges }}" required>
                                        @error('standard_charges')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 chargespackageset">
                                    <div class="form-group ">
                                        <label for="standard_charges">Date</label>
                                        <input type="date"id="date" name="date"
                                            @if (isset($editCharges->date)) value="{{ date('Y-m-d', strtotime($editCharges->date)) }}" @endif>
                                        <small class="text-danger">{{ $errors->first('date') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4 chargespackagesetup">
                                    <div class="form-group ">
                                        <label for="description" >Description</label>
                                        <input type="text"id="description" name="description" value="{{ @$editCharges->description }}">
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-0">Edit Charges</button>
                </div>

                </form>
            </div>
        </div>
        </div>
    @endcan
@endsection
