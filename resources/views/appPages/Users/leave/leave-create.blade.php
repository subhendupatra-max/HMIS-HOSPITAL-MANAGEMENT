@extends('layouts.layout')
@section('content')
<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="border-0">
        <div class="tab-content">
            <div class="tab-pane active" id="tab-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Application For Leave</h4>
                    </div>
                    @include('message.notification')
                    <form method="POST" action="{{route('apply-leave-application')}}">
                        @csrf
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Apply Date <span class="text-danger">*</span></label>
                                        <input type="date"  class="form-control" name="apply_date">
                                        @error('apply_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Type <span class="text-danger">*</span></label>
                                        <select  class="form-control select2-show-search select2-hidden-accessible" name="leave_type">
                                            <option value="">Select Leave Type..</option>
                                            @foreach (Config::get('static.leave_type') as $lang => $leave_value)
                                            <option value="{{ $leave_value }}"> {{ $leave_value }}</option>
                                            @endforeach
                                        </select>
                                        @error('leave_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Single Day/Multiple Days <span class="text-danger">*</span></label>
                                        <select  onchange="gettype(this.value)" class="form-control select2-show-search select2-hidden-accessible" name="single_day_multiple_day">
                                            <option value="">Select Leave Type..</option>
                                            <option value="single_day">Single Day</option>
                                            <option value="multiple_day">Multiple Days</option>
                                        </select>
                                        @error('single_day_multiple_day')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="single_day">
                                    <div class="col-md-4">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="singleDate">
                                        @error('singleDate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Half Day/Full Day <span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" name="half_day_full_day">
                                            <option value="full_day">Full Day</option>
                                            <option value="half_day">Half Days</option>
                                        </select>
                                        @error('half_day_full_day')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="multiple_day">
                                    <div class="col-md-4">
                                        <label class="form-label">From Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="from_date">
                                        @error('from_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">To Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="to_date">
                                        @error('to_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="form-label">Purpose<span class="text-danger">*</span></label>
                                        <textarea  class="form-control" name="purpose"></textarea>
                                        @error('purpose')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Resume duty on <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="resume_duty_on">
                                        @error('resume_duty_on')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Need Permission From <span class="text-danger">*</span></label>
                                    <select name="permission_authority[]"  multiple="multiple" class="multi-select select2-show-search">
                                        <option value="">Select One</option>
                                        @if($user_list)
                                        @foreach ($user_list as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('permission_authority')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <input type="submit" class="btn btn-success mt-3" value="Submit" />
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function gettype(val) {

        $('#multiple_day').attr('style', 'display:none');
        $('#single_day').attr('style', 'display:none');
        if (val == 'multiple_day') {

            $('#multiple_day').removeAttr('style', true);
        }
        if (val == 'single_day') {
            $('#single_day').removeAttr('style', true);
        }
    }
</script>
@endsection