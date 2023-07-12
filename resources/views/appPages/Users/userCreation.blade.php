@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Creation Form</h4>
        </div>
        <!-- ================== message============================== -->
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button>{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button>{{ session('error') }}</div>
        @endif
        <!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                action="{{ route('UserCreateAction') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <!-- //password  -->
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fas fa-user"></i> Personal Information</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                                    <div class="col-md-2 useraddd">

                               
                                        <input type="text" id="employee_id" value="{{ old('employee_id') }}"
                                            name="employee_id">
                                        <label for="employee_id"> Employee Id <span class="text-danger">*</span></label>
                                        @error('employee_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 useradddone">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search " value="{{ old('role') }}"
                                            tabindex="-1" aria-hidden="true" name="role" id="role">
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

                                    <div class="col-md-2 useradddone">
                                        <label class="form-label">Designation <span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search" name="designation"
                                            id="designation">
                                            <option value="">Select Designation</option>
                                            @foreach ($designation as $item)
                                            <option value="{{ $item->id }}">{{ $item->designation_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('designation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 useradddone">
                                        <label class="form-label">Department <span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search" name="department"
                                            id="department">
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
                                        <input type="text" id="specialist" value="{{ old('specialist') }}"
                                            name="specialist">
                                        <label for="specialist"> Specialist </label>
                                        @error('specialist')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 useradddtwo">
                                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                                            id="first_name" required="">
                                        <label for="first_name"> First Name <span class="text-danger">*</span></label>
                                        @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 useradddtwo ">
                                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                                            id="last_name" required="">
                                        <label for="last_name"> Last Name <span class="text-danger">*</span></label>
                                        @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 useradddtwo ">
                                        <input type="text" name="father_name" value="{{ old('father_name') }}"
                                            id="father_name">
                                        <label for="father_name"> Father Name</label>
                                        @error('father_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 useradddtwo ">
                                        <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                            id="mother_name">
                                        <label for="mother_name"> Mother Name</label>
                                        @error('mother_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 newuserchange">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control" id="gender"
                                            value="{{ old('gender') }}">
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
                                        <select name="marital_status" class="form-control" id="marital_status"
                                            value="{{ old('marital_status') }}">
                                            <option value="">Metrial Status  </option>
                                            @foreach (Config::get('static.marital_status') as $lang => $marital)
                                            <option value="{{ $marital }}"> {{ $marital }}</option>
                                            @endforeach
                                        </select>
                                        @error('metrial_status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-2 newuserchange">
                                        <label for="blood_group">Blood Group</label>
                                        <select name="blood_group" class="form-control" id="blood_group"
                                            value="{{ old('blood_group') }}">
                                            <option value="">Blood Group </option>
                                            @foreach (Config::get('static.blood_groups') as $lang => $blood_group)
                                            <option value="{{ $blood_group }}"> {{ $blood_group }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2 useraddthree">
                                        <label>Date Of Birth </label>

                                        <input type="date" name="date_of_birth" id="date_of_birth">
                                        @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 useraddthree">

                                        <label>Date Of joining </label>
                                        <input type="date" name="date_of_joining" id="date_of_joining"
                                            value="{{ old('date_of_joining') }}">
                                        @error('date_of_joining')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 useradddtwoo">

                                        <input type="number" name="phone_no" id="phone_no" value="{{ old('phone_no') }}"
                                            required="">
                                        <label for="phone_no"> Phone <span class="text-danger">*</span></label>
                                        @error('phone_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3  newuserlisttchangee">

                                        <input type="number" name="whatsapp_no" id="whatsapp_no"
                                            value="{{ old('whatsapp_no') }}">
                                        <label for="whatsapp_no">Whatsapp No </label>
                                        @error('whatsapp_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 newuserlisttchangee ">

                                        <input type="number" name="emg_phone_no" id="emg_phone_no"
                                            value="{{ old('emg_phone_no') }}">
                                        <label for="whatsapp_no">Emergency Phone No. </label>

                                        @error('emg_phone_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 newuserlisttchangee ">

                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            required="">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 newuserlisttfour">
                                        <label class="form-label">Photo (512 x 512)</label>
                                        <input type="file" onchange="readURL(this);" name="profile_image"
                                            id="profile_image">


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

                                        <input type="text" name="current_address" id="current_address" >
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

                                        <input type="text" name="specialization" id="specialization">
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

                                        <input type="text" name="pan_number" id="pan_number"
                                            value="{{ old('pan_number') }}">
                                        <label for="pan_number">Pan Number</label>
                                        @error('pan_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 newuserchange  ">
                                        <input type="text" name="identification_name" id="identification_name"
                                            value="{{ old('identification_name') }}">
                                        <label for="identification_name">Identification Name</label>
                                        @error('identification_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 newuserchange ">

                                        <input type="text" name="identification_number" id="identification_number"
                                            value="{{ old('local_identification_number') }}">
                                        <label for="identification_number">Identification Number</label>
                                        @error('local_identification_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row border-top">
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fa fa-bank"></i> Bank Information</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                                    <div class="col-md-3 useraddd">
                                        <input type="text" id="bank_account_no" value="{{ old('bank_account_no') }}"
                                            name="bank_account_no">
                                        <label for="bank_account_no"> Bank Account No. </label>
                                        @error('bank_account_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 useraddd">
                                        <input type="text" id="bank_name" value="{{ old('bank_name') }}"
                                            name="bank_name">
                                        <label for="bank_name"> Bank Name. </label>
                                        @error('bank_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 useraddd">
                                        <input type="text" id="ifsc_code" value="{{ old('ifsc_code') }}"
                                            name="ifsc_code">
                                        <label for="ifsc_code"> IFSC Code </label>
                                        @error('ifsc_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 useraddd">
                                        <input type="text" id="bank_branch_name" value="{{ old('bank_branch_name') }}"
                                            name="bank_branch_name">
                                        <label for="bank_branch_name"> Bank Branch Name </label>
                                        @error('bank_branch_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row border-top">
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fa fa-star"></i> Payroll</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                                    <div class="col-md-3 useraddd">
                                        <input type="text" id="epf_no" value="{{ old('epf_no') }}"
                                            name="epf_no">
                                        <label for="epf_no"> EPF No. </label>
                                        @error('epf_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 useraddd">
                                        <input type="text" id="basic_salary" value="{{ old('basic_salary') }}"
                                            name="basic_salary">
                                        <label for="basic_salary">  Basic Salary </label>
                                        @error('basic_salary')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 useraddd">
                                        <select name="contract_type" class="form-control" id="contract_type"
                                        value="{{ old('contract_type') }}">
                                            <option value="">Select One.....  </option>
                                            @foreach (Config::get('static.contract_types') as $lang => $contract_types)
                                            <option value="{{ $contract_types }}"> {{ $contract_types }}</option>
                                            @endforeach
                                        </select>
                                        <label for="ifsc_code"> Contract Type </label>
                                        @error('ifsc_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top">
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fa fa-leaf"></i> Leave</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                                    <div class="col-md-2 useraddd">
                                        <input type="text" id="casual_leave" value="{{ old('casual_leave') }}"
                                            name="casual_leave">
                                        <label for="casual_leave"> Casual Leave </label>
                                        @error('casual_leave')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 useraddd">
                                        <input type="text" id="privilege_leave" value="{{ old('privilege_leave') }}"
                                            name="privilege_leave">
                                        <label for="privilege_leave">  Privilege Leave </label>
                                        @error('privilege_leave')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 useraddd">
                                        <input type="text" id="sick_leave" value="{{ old('sick_leave') }}"
                                            name="sick_leave">
                                        <label for="sick_leave">  Sick Leave </label>
                                        @error('sick_leave')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 useraddd">
                                        <input type="text" id="maternity_leave" value="{{ old('maternity_leave') }}"
                                            name="maternity_leave">
                                        <label for="maternity_leave">  Maternity Leave </label>
                                        @error('maternity_leave')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 useraddd">
                                        <input type="text" id="paternity_leave" value="{{ old('paternity_leave') }}"
                                            name="paternity_leave">
                                        <label for="paternity_leave">  Paternity Leave </label>
                                        @error('paternity_leave')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body hospital_allcardbodydesign">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>
                                Create
                                User</button>
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