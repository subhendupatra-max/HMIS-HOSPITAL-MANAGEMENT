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
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('UserCreateAction') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <!-- //password  -->

                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fas fa-user"></i> Personal Information</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                           <div class="col-md-2 useraddd">

                            {{-- <label class="form-label">Employee Id <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="employee_id"  value="{{old('employee_id')}}" name="employee_id" placeholder="Employee Id" > --}}
                            <input type="text" id="employee_id" value="{{ old('employee_id') }}" name="employee_id">
                            <label for="employee_id"> Employee Id <span class="text-danger">*</span></label>
                            @error('employee_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 useradddone">
                             <label>Role <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search " value="{{ old('role') }}" tabindex="-1" aria-hidden="true" name="role" id="role">
                                <optgroup>
                                    @foreach ($all_role as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 useraddd">
                            <input type="text" id="designation" value="{{ old('designation') }}" name="designation" >
                            <label for="designation"> Designation </label>
                            @error('designation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 useradddone">
                            <label class="form-label">Department </label>
                            <select class="form-control select2-show-search" name="department" id="department">
                                <option value="">Select Department</option>
                                @foreach ($department as $item)
                                <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                @endforeach
                            </select>
                            @error('department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 useraddd">
                            <input type="text" id="specialist" value="{{ old('specialist') }}" name="specialist">
                            <label for="specialist"> Specialist </label>
                            @error('specialist')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 useradddtwo">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" id="first_name" required="">
                            <label for="first_name"> First Name <span class="text-danger">*</span></label>
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 useradddtwo">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" id="last_name" required="">
                            <label for="last_name"> Last Name <span class="text-danger">*</span></label>
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 useradddtwo ">
                            <input type="text" name="father_name" value="{{ old('father_name') }}" id="father_name">
                            <label for="father_name"> Father Name</label>
                            @error('father_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 useradddtwo ">
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}" id="mother_name">
                            <label for="mother_name"> Mother Name</label>
                            @error('mother_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2 newuserchange">
                             <label >Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control" id="gender" value="{{ old('gender') }}">
                                <option value="">Gender <span class="text-danger">*</span> </option>
                                @foreach (Config::get('static.gender') as $lang => $genders)
                                <option value="{{ $genders }}"> {{ $genders }}</option>
                                @endforeach
                            </select>
                            @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 newuserchange">
                         <label>Metrial Status </label>
                            <select name="marital_status" class="form-control" id="marital_status" value="{{ old('marital_status') }}">
                                <option value="">Metrial Status <span class="text-danger">*</span> </option>
                                @foreach (Config::get('static.marital_status') as $lang => $marital)
                                <option value="{{ $marital }}"> {{ $marital }}</option>
                                @endforeach
                            </select>
                            @error('metrial_status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2 newuserchange">
                             <label for="blood_group" >Blood Group <span
                                        class="text-danger">*</span></label>
                            <select name="blood_group" class="form-control" id="blood_group" value="{{ old('blood_group') }}">
                                <option value="">Blood Group<span class="text-danger">*</span> </option>
                                @foreach (Config::get('static.blood_groups') as $lang => $blood_group)
                                <option value="{{ $blood_group }}"> {{ $blood_group }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 useraddthree">
                             <label >Date Of Birth <span class="text-danger">*</span></label>

                            <input type="date" name="date_of_birth" id="date_of_birth">
                            @error('date_of_birth')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 useraddthree">

                            <label >Date Of joining <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_joining" id="date_of_joining" value="{{ old('date_of_joining') }}">
                            @error('date_of_joining')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 useradddtwoo">

                            <input type="number" name="phone_no" id="phone_no" value="{{ old('phone_no') }}" required="">
                            <label for="phone_no"> Phone</label>
                            @error('phone_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3  newuserlisttchangee">

                            <input type="number" name="whatsapp_no" id="whatsapp_no" value="{{ old('whatsapp_no') }}">
                            <label for="whatsapp_no">Whatsapp No </label>
                            @error('whatsapp_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserlisttchangee ">

                         <input type="number" name="emg_phone_no" id="emg_phone_no"
                                    value="{{ old('emg_phone_no') }}" required="">
                            <label for="whatsapp_no">Emergency Phone No. </label>

                            @error('emg_phone_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserlisttchangee ">

                            <input type="email" name="email" id="email" value="{{ old('email') }}" required="">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserlisttfour">
                            <label class="form-label">Photo (512 x 512)</label>
                                <input type="file" onchange="readURL(this);" name="profile_image" id="profile_image">


                            @error('profile_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i> Address</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                        <div class="col-md-6 newuserchange ">

                            <input type="text" name="current_address" id="current_address" required="">
                            <label for="current_address">Current Address </label>
                            @error('current_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 newuserchange">

                            <input type="text" name="permanent_address" id="permanent_address">
                            <label for="permanent_address">Permanent Address </label>
                            @error('permanent_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Others</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                        <div class="col-md-2 newuserchange ">

                            <input type="text" name="qualification" id="qualification">
                            <label for="qualification">Qualification</label>
                            @error('qualification')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserchange ">

                            <input type="text" name="experience" id="experience">
                            <label for="experience">Work Experience</label>
                            @error('experience')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 newuserchange ">

                            <input type="text" name="specialization" id="specialization" >
                            <label for="specialization">Specialization</label>
                            @error('specialization')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 newuserchange ">

                            <input type="text" name="note" id="note">
                            <label for="note">Note</label>
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fas fa-tasks"></i>Identification Details</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">

                        <div class="col-md-4 newuserchange ">

                            <input type="text" name="pan_number" id="pan_number" value="{{ old('pan_number') }}">
                            <label for="pan_number">Pan Number</label>
                            @error('pan_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 newuserchange  ">
                            {{-- <label class="form-label">National Identification Number </label>
                                <input type="text"
                                    name="identification_number"id="identification_number"
                                    value="{{ old('identification_number') }}"> --}}
                            <input type="text" name="identification_number" id="identification_number" value="{{ old('identification_number') }}" >
                            <label for="identification_number">Identification Number</label>
                            @error('identification_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 newuserchange ">

                            <input type="text" name="identification_number" id="identification_number" value="{{ old('local_identification_number') }}">
                            <label for="identification_number">Identification Number</label>
                            @error('local_identification_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                </div>
                            </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Create
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
