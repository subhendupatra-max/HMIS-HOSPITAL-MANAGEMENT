@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Creation Form</h4>
        </div>
        <!-- ================== message============================== -->
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('error') }}</div>
        @endif
        <!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('user-update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user_details->id }}">
                <div class="col-md-12">
                    <div class="row">
                        <!-- //password  -->


                        <div class="col-md-2">

                            <input type="text" id="employee_id" value="{{ $user_details->employee_id }}" name="employee_id" required="">
                            <label for="employee_id"> Employee Id <span class="text-danger">*</span></label>

                            @error('employee_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label> Role <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search " tabindex="-1" aria-hidden="true" name="role" id="role">
                                <optgroup>
                                    <option value=" ">Select Role </option>
                                    @if (isset($all_role))
                                    @foreach ($all_role as $item)
                                    <option value="{{ $item->name }}" {{ @$item->name == $user_details->role ? 'selected' : ' ' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">

                            <input type="text" id="designation" value="{{ $user_details->designation }}" name="designation">
                            <label for="first_name"> Designation </label>
                            @error('designation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Department </label>
                            <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="department" id="department">
                                <option value=" ">Select Department</option>
                                @if (isset($department))
                                @foreach ($department as $item)
                                <option value="{{ $item->id }}" {{ @$item->id == $user_details->department ? 'selected' : ' ' }}>
                                    {{ $item->department_name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <input type="text" id="specialist" value="{{ $user_details->specialist }}" name="specialist">
                            <label for="specialist"> Specialist </label>
                            @error('specialist')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserlistchange">

                            <input type="text" name="first_name" value="{{ $user_details->first_name }}" id="first_name" required="">
                            <label for="first_name"> First Name <span class="text-danger">*</span></label>
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserlistchange ">

                            <input type="text" name="last_name" value="{{ $user_details->last_name }}" id="last_name" required="">
                            <label for="last_name"> Last Name <span class="text-danger">*</span></label>
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserlistchange ">


                            <input type="text" name="father_name" value="{{ $user_details->father_name }}" id="father_name" required="">
                            <label for="father_name"> Father Name</label>
                            @error('father_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserlistchange ">

                            <input type="text" name="mother_name" value="{{ $user_details->mother_name }}" id="mother_name">
                            <label for="mother_name"> Mother Name</label>
                            @error('mother_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2 newuserchangee">

                            <select name="gender" class="form-control" id="gender">
                                <option value="">Gender <span class="text-danger">*</span></option>

                                @foreach (Config::get('static.gender') as $lang => $genders)
                                <option value="{{ $genders }}" {{ @$genders == $user_details->gender ? 'selected' : ' ' }}>
                                    {{ $genders }}
                                </option>
                                @endforeach
                            </select>
                            @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 newuserchangee ">

                            <select name="marital_status" class="form-control" id="marital_status">
                                <option value="">Metrial Status</option>
                                @foreach (Config::get('static.marital_status') as $lang => $marital)
                                <option value="{{ $marital }}" {{ @$marital == $user_details->marital_status ? 'selected' : ' ' }}>
                                    {{ $marital }}
                                </option>
                                @endforeach
                            </select>
                            @error('metrial_status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2 newuserchangee ">

                            <select name="blood_group" class="form-control" id="blood_group">
                                <option value="">Blood Group</option>
                                @foreach (Config::get('static.blood_groups') as $lang => $blood_group)
                                <option value="{{ $blood_group }}" {{ @$blood_group == $user_details->blood_group ? 'selected' : ' ' }}>
                                    {{ $blood_group }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 ">



                            {{-- <h6 class="Heading">Date Of Birth <span class="text-danger">*</span></h6>  --}}
                            <lable class="datetype">Date</lable>
                            <input type="date" name="date_of_birth" id="date_of_birth" @if (isset($user_details->date_of_birth)) value="{{ date('Y-m-d', strtotime($user_details->date_of_birth)) }}" @endif>

                            @error('date_of_birth')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 datetypeform">

                            <lable class="datetype">Date of Joining</lable>
                            <input type="date" name="date_of_joining" id="date_of_joining" @if (isset($user_details->date_of_joining)) value="{{ date('Y-m-d', strtotime($user_details->date_of_joining)) }}" @endif>
                            @error('date_of_joining')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 newuserchangeeli">

                            <input type="number" name="phone_no" id="phone_no" value="{{ $user_details->phone_no }}" required="">
                            <label for="phone_no"> Phone</label>
                            @error('phone_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserchangeeli">

                            <input type="number" name="whatsapp_no" id="whatsapp_no" value="{{ $user_details->whatsapp_no }}">
                            <label for="whatsapp_no">Whatsapp No </label>
                            @error('whatsapp_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserchangeeli ">

                            <input type="number" name="emg_phone_no" id="emg_phone_no" value="{{ $user_details->emg_phone_no }}">
                            <label for="whatsapp_no">Emergency Phone No. </label>
                            @error('emg_phone_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserrchange ">

                            <input type="email" name="email" id="email" value="{{ $user_details->email }}" required="">
                            <label for="email">Email </label>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">


                            <lable class="datetype">Photo (512 x 512)</lable>
                            <input type="file" onchange="readURL(this);" name="profile_image" id="profile_image">
                            @error('profile_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 newuserrchange ">

                            <input type="text" name="current_address" id="current_address" value="{{ $user_details->current_address }}">
                            <label for="current_address">Current Address </label>
                            @error('current_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 newuserchange ">

                            <input type="text" name="permanent_address" id="permanent_address" {{ $user_details->permanent_address }} >
                            <label for="permanent_address">Permanent Address </label>
                            @error('permanent_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserchange">

                            <input type="text" name="qualification" id="qualification" {{ $user_details->qualification }} >
                            <label for="qualification">Qualification</label>
                            @error('qualification')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserchange ">

                            <input type="text" name="experience" id="experience" {{ $user_details->experience }} >
                            <label for="experience">Work Experience</label>
                            @error('experience')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 newuserchange ">

                            <input type="text" name="specialization" id="specialization" {{ $user_details->specialization }} >
                            <label for="specialization">Specialization</label>
                            @error('specialization')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 newuserchange">

                            <input type="text" name="note" id="note" {{ $user_details->note }} >
                            <label for="note">Note</label>
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 newuserchange ">

                            <input type="text" name="pan_number" id="pan_number" value="{{ $user_details->pan_number }}">
                            <label for="pan_number">Pan Number</label>
                            @error('pan_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 newuserchange">

                            <input type="text" name="identification_number" id="identification_number" value="{{ $user_details->identification_number }}">
                            <label for="identification_number">Identification Number</label>
                            @error('identification_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 newuserchange">

                            <input type="text" name="local_identification_number" id="local_identification_number" value="{{ $user_details->local_identification_number }}">
                            <label for="identification_number">Local Identification Number</label>
                            @error('local_identification_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update
                                User</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(50)
                    .height(50);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
