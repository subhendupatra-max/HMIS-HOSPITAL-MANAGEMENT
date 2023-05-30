@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Ambulance Call</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-ambulance-call-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" value="{{ $editAmbulanceCall->id }}" name="id">
                    <div class="form-group col-md-4">
                        <label for="vehicle_model" class="form-label">Vehicle Model <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search" value="{{ old('vehicle_model') }}" name="vehicle_model" id="vehicle_model" required>
                           
                                <option value=" ">Select Vehicle Model </option>
                                @foreach ($ambulance as $item)
                                <option value="{{$item->id}}" {{ $item->id == $editAmbulanceCall->vehicle_model ? 'selected' : " "}}>{{$item->vehicle_number}}</option>
                                @endforeach
                            
                        </select>
                        @error('vehicle_model')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="driver_name" class="form-label">Driver Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{ $editAmbulanceCall->driver_name }}"  required>
                        @error('driver_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label >Start Date & time<span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" value="{{ @$item->start_date_and_time != null ? date('Y-m-d H:i',strtotime($item->start_date_and_time)):''}}" id="start_date_and_time" name="start_date_and_time" required>
                        @error('start_date_and_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label >Return Date & time</label>
                        <input type="datetime-local" value="{{ @$item->return_date_and_time != null ? date('Y-m-d H:i',strtotime($item->return_date_and_time)):''}}" class="form-control" id="return_date_and_time" name="return_date_and_time">
                        @error('return_date_and_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="form-group col-md-4">
                        <label >Place<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="place" value="{{ $editAmbulanceCall->place }}" name="place" required>
                        @error('place')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label >Purpose<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $editAmbulanceCall->purpose }}" id="purpose" name="purpose" required>
                        @error('purpose')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-4">
                        <input type="text" id="note" value="{{ $editAmbulanceCall->note }}" name="note" >
                        <label for="note">Note</label>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
        </div>

        <div class="text-center m-auto">
            <button type="submit" class="btn btn-primary">Save Ambulance Call</button>
        </div>
    </div>
    </form>
</div>

</div>

</div>


@endsection