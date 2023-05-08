@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">OPD // <span style="color:blue">{{ @$department_details->department_name }}</span>
                // <span>{{ date('d-m-Y',strtotime($date))}}</span></div>
        </div>
        @include('message.notification')
        <div class="card-body p-0  mt-3">
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-xl-4 border-right">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('registation-false-opd') }}">
                                @csrf
                                <input type="hidden" name="department_id" value="{{ $department_id }}" />
                                <input type="hidden" name="date" value="{{ $date }}" />
                                @error('department_id')
                                <small class="text-danger">{{ $message }}</sma>
                                @enderror
                                @error('date')
                                <small class="text-danger">{{ $message }}</sma>
                                @enderror
                                <div class="row">
                                    <div class="form-group col-md-6 newaddappon ">
                                        <label class="date-format"> No. Of Patient <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="no_of_patient" required />
                                        @error('no_of_patient')
                                        <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 newuserlisttchange ">
                                        <label for="gender">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control select2-show-search" id="gender" required>
                                            <option value="" for="gender">gender</option>
                                            @foreach (Config::get('static.gender') as $lang => $genders)
                                            <option value="{{ $genders }}"> {{ $genders }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 newaddappon ">
                                        <label class="date-format"> From Age(in year) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="from_age" required />
                                        @error('from_age')
                                        <small class="text-danger">{{ $message }}</sma>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6 newaddappon ">
                                        <label class="date-format"> To Age(in year) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="to_age" required />
                                        @error('to_age')
                                        <small class="text-danger">{{ $message }}</sma>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-12 newaddappon">
                                        <label for="visit_type">Visit Type <span class="text-danger">*</span></label>
                                        <select name="visit_type" class="form-control select2-show-search"
                                            id="visit_type" required >
                                            <option value="" >Select One</option>
                                            <option value="New Visit" >New-Visit</option>
                                            <option value="Revisit">Revisit</option>
                                        </select>
                                        @error('visit_type')
                                        <small class="text-danger">{{ $message }}</sma>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-12 opd-bladedesign ">
                                        <button class="btn btn-primary btn-sm text-center ml-2" type="submit"
                                            name="save" value="save"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-8">
                        vnfdjn
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3 mt-3">
                cnd
            </div>
        </div>
    </div>
</div>

@endsection