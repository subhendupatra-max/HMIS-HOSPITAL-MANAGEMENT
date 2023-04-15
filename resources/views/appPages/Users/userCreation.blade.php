@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Creation Form</h4>
        </div>
        <!-- ================== message============================== -->
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('UserCreateAction') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <!-- //password  -->


                        <div class="col-md-2">
                            <label class="form-label">Employee Id <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="employee_id"  value="{{old('employee_id')}}" name="employee_id" placeholder="Employee Id" >
                            @error('employee_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('role') }}" tabindex="-1" aria-hidden="true" name="role" id="role">
                                <optgroup>
                                    @foreach ($all_role as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Designation </label>
                            <input type="text" class="form-control" id="designation" value="{{ old('designation') }}" name="designation" placeholder="Designation">
                            @error('designation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="department" id="department">
                                <option value="">Select Department</option>
                                    @foreach ($department as $item)
                                    <option value="{{$item->id}}">{{$item->department_name}}</option>
                                    @endforeach
                            </select>
                            @error('department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Specialist </label>
                            <input type="text" class="form-control" id="specialist" value="{{ old('specialist') }}" name="specialist" placeholder="Specialist">
                            @error('specialist')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="first_name" placeholder="First Name">
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name') }}"  name="last_name" id="last_name" placeholder="Last Name">
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Father Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('father_name') }}"  name="father_name" id="father_name" placeholder="Father Name">
                            @error('father_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Mother Name </label>
                            <input type="text" class="form-control" value="{{ old('mother_name') }}"  name="mother_name" id="mother_name" placeholder="Mother Name">
                            @error('mother_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control" id="gender" value="{{ old('gender') }}" >
                                <option value="">Select</option>
                                @foreach (Config::get('static.gender') as $lang => $genders)
                                <option value="{{$genders}}"> {{$genders}}</option>
                                @endforeach
                            </select>
                            @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Metrial Status </label>
                            <select name="marital_status" class="form-control" id="marital_status" value="{{ old('marital_status') }}" >
                            <option value="">Select</option>
                            @foreach (Config::get('static.marital_status') as $lang => $marital)
                            <option value="{{$marital}}"> {{$marital}}</option>
                            @endforeach
                            </select>
                            @error('metrial_status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                            <select name="blood_group" class="form-control" id="blood_group" value="{{ old('blood_group') }}" >
                                <option value="">Select</option>
                                @foreach (Config::get('static.blood_groups') as $lang => $blood_group)
                                <option value="{{$blood_group}}"> {{$blood_group}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" >
                            @error('date_of_birth')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Date Of Joining </label>
                            <input type="date" class="form-control" name="date_of_joining" id="date_of_joining" value="{{ old('date_of_joining') }}" >
                            @error('date_of_joining')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="phone_no" id="phone_no" value="{{ old('phone_no') }}" >
                            @error('phone_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Whatsapp No </label>
                            <input type="number" class="form-control" name="whatsapp_no" id="whatsapp_no" value="{{ old('whatsapp_no') }}" >
                            @error('whatsapp_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Emergency Phone No. </label>
                            <input type="number" class="form-control" name="emg_phone_no" id="emg_phone_no" value="{{ old('emg_phone_no') }}" >
                            @error('emg_phone_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" >
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Photo (512 x 512)</label>
                            <input type="file" onchange="readURL(this);" name="profile_image" id="profile_image">
                            @error('profile_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Current Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="current_address" id="current_address"></textarea>
                            @error('current_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Permanent Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="permanent_address" id="permanent_address"></textarea>
                            @error('permanent_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label"> Qualification </label>
                            <textarea class="form-control" name="qualification" id="qualification"></textarea>
                            @error('qualification')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Work Experience </label>
                            <textarea class="form-control" name="experience" id="experience"></textarea>
                            @error('experience')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Specialization </label>
                            <textarea class="form-control" name="specialization" id="specialization"></textarea>
                            @error('specialization')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Note </label>
                            <textarea class="form-control" name="note" id="note"></textarea>
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Pan Number </label>
                            <input type="text" class="form-control" name="pan_number" id="pan_number" value="{{ old('pan_number') }}" >
                            @error('pan_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">National Identification Number </label>
                            <input type="text" class="form-control" name="identification_number" id="identification_number" value="{{ old('identification_number') }}" >
                            @error('identification_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Local Identification Number </label>
                            <input type="text" class="form-control" name="local_identification_number" id="local_identification_number" value="{{ old('local_identification_number') }}" >
                            @error('local_identification_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Create User</button>
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
