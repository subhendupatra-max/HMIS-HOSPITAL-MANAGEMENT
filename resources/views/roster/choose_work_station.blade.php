@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
     
        @include('message.notification')
        <div class="card-body p-0">
            <form method="post" action="{{route('create-roster')}}">
                @csrf
                <div class="options px-5 pt-1  border-bottom pb-3">
                    <div class="row">
                        <div class="form-group col-md-4 newaddappon">
                            <label for="work_station_id">Choose Work Station <span class="text-danger">*</span></label>
                            <select name="work_station_id" class=" select2-show-search" id="work_station_id"
                                required>
                                <option value="">Select your work station.......</option>
                                @foreach ($work_station as $key => $value)
                                <option value="{{$value->id}}"> {{$value->work_station_name}}</option>
                                @endforeach
                            </select>
                            @error('work_station_id')
                            <small class="text-danger">{{ $message }}</sma>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 newaddappon" style="margin: 39px 0px 0px 0px;">
                            <label class="date-format">From Date <span class="text-danger">*</span></label>
                            <input type="date"  name="from_date" value="{{ date('Y-m-d') }}" required />
                            @error('from_date')
                            <small class="text-danger">{{ $message }}</sma>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 newaddappon" style="margin: 39px 0px 0px 0px;">
                            <label class="date-format">To Date <span class="text-danger">*</span></label>
                            <input type="date" name="to_date" value="{{ date('Y-m-d') }}" required />
                            @error('to_date')
                            <small class="text-danger">{{ $message }}</sma>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 opd-bladedesign text-center">
                            <button class="btn btn-primary btn-sm text-center ml-2" type="submit" name="save"
                                value="save"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection