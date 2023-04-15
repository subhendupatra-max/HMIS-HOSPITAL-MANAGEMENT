@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Ambulance</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-ambulance-details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="vehicle_number" class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" placeholder="Enter Vehicle Number" required>
                        @error('vehicle_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="vehicle_model" class="form-label">Vehicle Model <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" placeholder="Enter Vehicle Model" required>
                        @error('vehicle_model')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="year_made" class="form-label">Year Made<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="year_made" name="year_made" placeholder="Enter Year Made">
                        @error('year_made')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="driver_name" class="form-label">Driver Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Enter Driver Name">
                        @error('driver_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="driver_license" class="form-label">Driver License <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_license" name="driver_license" placeholder="Enter Driver License">
                        @error('driver_license')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>   

                    <div class="form-group col-md-4">
                        <label for="vehicle_type" class="form-label"> Vehicle Type <span class="text-danger">*</span></label>
                        <select id="vehicle_type" class="form-control" name="vehicle_type">
                            <option value="">Select</option>
                            @foreach (Config::get('static.vehicle_type_name') as $lang => $item)
                            <option value="{{$item}}"> {{$item}}</option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-4">
                        <label for="note" class="form-label"> Note <span class="text-danger">*</span></label>
                        <textarea name="note" class="form-control"> </textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Ambulance</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

@endsection