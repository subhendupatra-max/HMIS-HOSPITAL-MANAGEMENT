@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">IPD</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <form method="post" action="{{route('false-ipd-registation')}}">
                @csrf
                <div class="options px-5 pt-1  border-bottom pb-3">
                    <div class="row">
                        <div class="form-group col-md-6 newaddappon">
                            <label for="department_id">Department <span class="text-danger">*</span></label>
                            <select name="department_id" class=" select2-show-search" id="department_id"
                                required>
                                <option value="">Select Department.......</option>
                                @foreach ($departments as $key => $department)
                                <option value="{{$department->id}}"> {{$department->department_name}}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <small class="text-danger">{{ $message }}</sma>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 newaddappon ">
                            <label class="date-format"> Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="{{ date('Y-m-d H:s') }}" required />
                            @error('date')
                            <small class="text-danger">{{ $message }}</sma>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 opd-bladedesign ">
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