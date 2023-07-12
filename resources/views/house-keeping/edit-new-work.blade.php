@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Work Details </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-new-work') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="work_id" value="{{ @$house_keeping_work->id }}" />
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" id="work_details" value="{{ @$house_keeping_work->working_details }}" name="work_details" required="" style="
                        margin: -3px 0px 0px 0px;">
                        <label for="work_details"> Work Details<span class="text-danger">*</span></label>
                        @error('work_details')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" value="{{ date('Y-m-d H:i',strtotime($house_keeping_work->date)) }}" id="date" name="date" style="
                        margin: 0px 0px 0px 0px;">
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="assign_house_keeper" class="form-label">Assign house keeper<span class="text-danger">*</span></label>
                        <select  class="form-control multi-select select2-show-search" multiple="multiple" name="assign_house_keeper[]">
                            <option value="">Select House keeper.....</option>
                            @if(@$assign_keeper)
                                @foreach ($assign_keeper as $value)
                                    <option value="{{ $value->id }}"
                                        @foreach ($house_keeping_user as $u_value)
                                            @if($u_value->user_id == $value->id)
                                            selected
                                            @endif
                                        @endforeach
                                        >{{ $value->first_name }} {{ $value->last_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('assign_house_keeper')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
         
                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Update </button>
                </div>
        </div>
        </form>
    </div>

</div>
</div>

@endsection