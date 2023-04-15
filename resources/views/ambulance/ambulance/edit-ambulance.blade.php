@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Ambulance</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-ambulance-details') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $ambulance->id }}">
                    <div class="form-group col-md-4">
                        <label for="vehicle_number" class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number"  value="{{ $ambulance->vehicle_number }}">
                        @error('vehicle_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="vehicle_model" class="form-label">Vehicle Model <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model"  value="{{ $ambulance->vehicle_model }}">
                        @error('vehicle_model')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="year_made" class="form-label">Year Made<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="year_made" name="year_made"  value="{{ $ambulance->year_made }}">
                        @error('year_made')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="driver_name" class="form-label">Driver Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name"  value="{{ $ambulance->driver_name }}">
                        @error('driver_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="driver_license" class="form-label">Driver License <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_license" name="driver_license"  value="{{ $ambulance->driver_license }}">
                        @error('driver_license')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>   

                    <div class="form-group col-md-4">
                        <label for="vehicle_type" class="form-label"> Vehicle Type <span class="text-danger">*</span></label>
                        <select id="vehicle_type" class="form-control" name="vehicle_type">
                            <option value="">Select</option>
                            @foreach (Config::get('static.vehicle_type_name') as $lang => $item)
                            <option value="{{$item}}" {{ $item == $ambulance->vehicle_type ? 'selected' : " "}}> {{$item}}</option> 
                            @endforeach
                        </select>
                        @error('vehicle_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-4">
                        <label for="note" class="form-label"> Note <span class="text-danger">*</span></label>
                        <textarea name="note" class="form-control"> {{ $ambulance->note}} </textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Edit Ambulance</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

@endsection