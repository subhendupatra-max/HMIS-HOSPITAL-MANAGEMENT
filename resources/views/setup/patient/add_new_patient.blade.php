@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <form action="{{ route('submit_new_patient_details') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="border-0">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Add Patient</h4>
                                    </div>
                                    <div class="card-body hospital_allcardbodydesign">
                                        <h5 class="font-weight-bold"><i class="fas fa-user"></i> Personal Information</h5>
                                        <div class="main-profile-bio mb-0">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <!-- <label-top for="prefix">Prefix <span class="text-danger">*</span></label> -->
                                                    <select name="prefix" class="form-control" id="prefix">
                                                        <option value="">prefix<span class="text-danger">*</span>
                                                        </option>
                                                        @foreach (Config::get('static.prefix') as $lang => $prefixs)
                                                            <option value="{{ $prefixs }}"> {{ $prefixs }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2 custom-field">
                                                    <!-- <label for="first_name">First Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="first_name" value="{{ old('first_name') }}" name="first_name" placeholder="Enter first Name">
                                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>    -->
                                                    <input type="text" id="first_name" value="{{ old('first_name') }}"
                                                        name="first_name" required />
                                                    <label for="first_name"> Enter Your First name<span
                                                            class="text-danger">*</span> </label>
                                                </div>


                                                <div class="form-group col-md-2">
                                                    <!-- <label for="middle_name">Middle Name </label>
                                                        <input type="text" class="form-control" id="middle_name" value="{{ old('middle_name') }}" name="middle_name" placeholder="Enter Middle Name"> -->
                                                    <input type="text"id="middle_name" value="{{ old('middle_name') }}"
                                                        name="middle_name" required />
                                                    <label for="middle_name"> Enter Your Middile name <span
                                                            class="text-danger">*</span></label>
                                                    <small class="text-danger">{{ $errors->first('middle_name') }}</small>

                                                </div>


                                                <div class="form-group col-md-2">
                                                    <!-- <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="last_name" value="{{ old('last_name') }}" name="last_name" placeholder="Enter Last Name"> -->
                                                    <input type="text" id="last_name" value="{{ old('last_name') }}"
                                                        name="last_name" required />
                                                    <label for="last_name"> Enter Your Last name <span
                                                            class="text-danger">*</span></label>
                                                    <small class="text-danger">{{ $errors->first('last_name') }}</small>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <!-- <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="last_name" value="{{ old('last_name') }}" name="last_name" placeholder="Enter Last Name"> -->
                                                    <input type="email" id="email_no" value="{{ old('email_no') }}"
                                                        name="email_no" required />
                                                    <label for="email_no"> Enter Your Email_no<span
                                                            class="text-danger">*</span></label>
                                                    <small class="text-danger">{{ $errors->first('last_name') }}</small>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <!-- <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="last_name" value="{{ old('last_name') }}" name="last_name" placeholder="Enter Last Name"> -->
                                                    <input type="text" id="Phone_no" required />
                                                    <label for="phone_no"> Enter Your Phone No<span
                                                            class="text-danger">*</span></label>
                                                    <small class="text-danger">{{ $errors->first('last_name') }}</small>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <!-- <label-top for="marital_status">Marital Status </label> -->
                                                    <select name="marital_status" class="form-control select2-show-search"
                                                        id="marital_status">
                                                        <option value="">marital_status</option>
                                                        @foreach (Config::get('static.marital_status') as $lang => $marital)
                                                            <option value="{{ $marital }}"> {{ $marital }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label-top for="blood_group">Blood Group </label>  -->
                                                    <select name="blood_group" class="form-control" id="blood_group">
                                                        <option value="" for="blood_group">blood_group</option>
                                                        @foreach (Config::get('static.blood_groups') as $lang => $blood_group)
                                                            <option value="{{ $blood_group }}"> {{ $blood_group }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label-top for="gender">Gender <span class="text-danger">*</span></label> -->
                                                    <select name="gender" class="form-control select2-show-search"
                                                        id="gender">
                                                        <option value=""for="gender">gender</option>
                                                        @foreach (Config::get('static.gender') as $lang => $genders)
                                                            <option value="{{ $genders }}"> {{ $genders }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label-top for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label> -->
                                                    <!-- <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" onchange="getage(this.value)" value="{{ old('date_of_birth') }}"> -->
                                                    <input type="date"class="form-control"
                                                        id="date_of_birth"id="date_of_birth" name="date_of_birth"
                                                        onchange="getage(this.value)" value="{{ old('date_of_birth') }}"
                                                        required />

                                                    <small
                                                        class="text-danger">{{ $errors->first('date_of_birth') }}</small>

                                                </div>

                                                <div class="form-group col-md-4">
                                                    <!-- <label1>Age (yy-mm-dd) <span class="text-danger">*</span></label>  -->

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <!-- <input type="text" class="form-control" id="date_of_birth_year" name="year" placeholder="Year" required>  -->
                                                            <small
                                                                class="text-danger">{{ $errors->first('date_of_birth_year') }}</small>
                                                            <input type="text" id="date_of_birth_year" required />
                                                            <label for="date_of_birth_year"> Year</label>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <!-- <input type="text" class="form-control" id="date_of_birth_month" name="month" placeholder="Month" required>  -->
                                                            <input type="text" id="date_of_birth_month" required />
                                                            <label for="date_of_birth_month"> Month</label>
                                                            <small
                                                                class="text-danger">{{ $errors->first('date_of_birth_month') }}</small>

                                                        </div>
                                                        <div class="col-lg-4">
                                                            <!-- <input type="text" class="form-control" id="date_of_birth_day" name="day" placeholder="Day" required>  -->
                                                            <input type="text" id="date_of_birth_day" required />
                                                            <label for="date_of_birth_day"> Day</label>
                                                            <small
                                                                class="text-danger">{{ $errors->first('date_of_birth_day') }}</small>

                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-top hospital_allcardbodydesign">

                                        <div class="row">
                                            <div class="col-lg-6 ">
                                                <h5 class="font-weight-bold"><i class="fas fa-users-cog"></i> Gurdian
                                                    Details</h5>
                                                <div class="main-profile-contact-list ">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">

                                                            <input type="text" id="guardian_name"
                                                                value="{{ old('guardian_name') }}" name="guardian_name"
                                                                required />
                                                            <label for="guardian_name">Enter Guardian Name<span
                                                                    class="text-danger">*</span></label>
                                                            <small
                                                                class="text-danger">{{ $errors->first('guardian_name') }}</small>

                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <!-- <label for="guardian_contact_no"> Gurdian Contact No <span class="text-danger">*</span></label>
                                                 <input type="text" class="form-control" id="guardian_contact_no" value="{{ old('guardian_contact_no') }}" name="guardian_contact_no" placeholder="Enter Gurdian Phone No"> -->
                                                            <input type="text" id="guardian_contact_no"
                                                                value="{{ old('guardian_contact_no') }}"
                                                                name="guardian_contact_no"required />
                                                            <label for="guardian_contact_no">Enter Gurdian Phone No<span
                                                                    class="text-danger">*</span></label>
                                                            <small
                                                                class="text-danger">{{ $errors->first('guardian_contact_no') }}</small>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">




                                                <h5 class="font-weight-bold"> <i class="fas fa-user-circle"></i> Local
                                                    Gurdian Name</h5>
                                                <div class="main-profile-contact-list ">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">

                                                            <input type="text" id="local_guardian_name"
                                                                value="{{ old('local_guardian_name') }}"
                                                                name="local_guardian_name" required />
                                                            <label for="local_guardian_name">Enter local Gurdian Name<span
                                                                    class="text-danger">*</span></label>
                                                            <small
                                                                class="text-danger">{{ $errors->first('local_guardian_name') }}</small>

                                                        </div>

                                                        <div class="form-group col-md-6">

                                                            <input type="text" id="local_guardian_contact_no"
                                                                value="{{ old('local_guardian_contact_no') }}"
                                                                name="local_guardian_contact_no" required />
                                                            <label for="Local Gurdian Contact No">Enter local Gurdian Phone
                                                                No<span class="text-danger">*</span></label>
                                                            <small
                                                                class="text-danger">{{ $errors->first('local_guardian_contact_no') }}</small>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-top hospital_allcardbodydesign">
                                        <h5 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Address</h5>
                                        <div class="main-profile-contact-list ">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <!-- <label for="address">Address <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="address" value="{{ old('address') }}" name="address" placeholder="Enter Address"> -->
                                                    <input type="text" id="address" value="{{ old('address') }}"
                                                        name="address" required />
                                                    <label for="address">Address<span
                                                            class="text-danger">*</span></label>
                                                    <small class="text-danger">{{ $errors->first('address') }}</small>

                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label for="country">Country <span class="text-danger">*</span></label> -->
                                                    <select name="country" class="form-control select2-show-search"
                                                        id="country" onchange="showDetails(this.value)">
                                                        <option value="">Select Country... </option>
                                                        @foreach ($country as $countrys)
                                                            <option value="{{ $countrys->id }}"
                                                                {{ $countrys->id == '1' ? 'selected' : ' ' }}>
                                                                {{ $countrys->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('country') }}</small>
                                                </div>


                                                <div class="form-group col-md-2">
                                                    <!-- <label for="state">State <span class="text-danger">*</span></label> -->
                                                    <select name="state" class="form-control select2-show-search"
                                                        id="state" required>
                                                        <option value="">Select State...</option>
                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('state') }}</small>
                                                </div>


                                                <div class="form-group col-md-2">
                                                    <!-- <label for="district">District <span class="text-danger">*</span></label> -->
                                                    <select name="district" class="form-control select2-show-search"
                                                        id="district" required>
                                                        <option value="">Select District...</option>
                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('district') }}</small>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label for="pin_no">Pin No. <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="pin_no" name="pin_no" value="{{ old('pin_no') }}"> -->
                                                    <input type="text" id="pin_no"id="pin_no" name="pin_no"
                                                        value="{{ old('pin_no') }}" required />
                                                    <label for="pin_no">Pin No.<span
                                                            class="text-danger">*</span></label>
                                                    <small class="text-danger">{{ $errors->first('pin_no') }}</small>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body border-top hospital_allcardbodydesign">
                                        <h6 class="font-weight-bold">Is Address And Local Address Same ?

                                        </h6>

                                        <h5 class="font-weight-bold"><i class="fas fa-map-marker"></i>Local Address</h5>
                                        <div class="main-profile-contact-list ">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <!-- <label for="local_address">Local Address <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="local_address" value="{{ old('local_address') }}" name="local_address" placeholder="Enter Local Address"> -->
                                                    <input type="text" id="local_address"
                                                        value="{{ old('local_address') }}" name="local_address"
                                                        required />
                                                    <label for="local_address">Enter Local Address<span
                                                            class="text-danger">*</span></label>
                                                    <small
                                                        class="text-danger">{{ $errors->first('local_address') }}</small>

                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label for="country_local">Country <span class="text-danger">*</span></label> -->
                                                    <select name="country_local" class="form-control select2-show-search"
                                                        id="country_local" onchange="showDetails(this.value)">
                                                        <option value="">Select Country... </option>
                                                        @foreach ($country as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == '1' ? 'selected' : ' ' }}>
                                                                {{ $item->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small
                                                        class="text-danger">{{ $errors->first('country_local') }}</small>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label for="state_local">State <span class="text-danger">*</span></label> -->
                                                    <select name="state_local" class="form-control select2-show-search"
                                                        id="state_local">
                                                        <option value="">Select State...</option>
                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('state_local') }}</small>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label for="district_local">District <span class="text-danger">*</span></label> -->
                                                    <select name="district_local" class="form-control select2-show-search"
                                                        id="district_local">
                                                        <option value="">Select District...</option>
                                                    </select>
                                                    <small
                                                        class="text-danger">{{ $errors->first('district_local') }}</small>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <!-- <label for="local_pin_no">Pin No. <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="local_pin_no" name="local_pin_no" value="{{ old('local_pin_no') }}"> -->
                                                    <input type="text" id="local_pin_no" name="local_pin_no"
                                                        value="{{ old('local_pin_no') }}" required />
                                                    <label for="local_pin_no">Pin No.<span
                                                            class="text-danger">*</span></label>
                                                    <small
                                                        class="text-danger">{{ $errors->first('local_pin_no') }}</small>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body border-top hospital_allcardbodydesign">
                                        <h5 class="font-weight-bold"><i class="fas fa-tasks"></i>Identification</h5>
                                        <div class="main-profile-contact-list ">
                                            <!-- <div class="row"> -->
                                            <div class="form-group col-md-12 " id="indentification">
                                                <div class="form-group col-md-5 d-inline-block">
                                                    <!-- <label for="identification_name"> Identification Name </label> -->
                                                    <select name="identification_name"
                                                        class="form-control select2-show-search" id="identification_name">
                                                        <option value="">Select One...</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-5 d-inline-block">
                                                    <!-- <label for="identification_number"> National Identification Number </label>
                                                        <input type="text" class="form-control" value="{{ old('identification_number') }}" id="identification_number" name="identification_number" placeholder="Enter National Identification Number"> -->
                                                    <input type="email" value="{{ old('identification_number') }}"
                                                        id="identification_number" name="identification_number"
                                                        required />
                                                    <label for="identification_number">National Identification Number<span
                                                            class="text-danger">*</span></label>
                                                    <small class="text-danger">{{ $errors->first('phone') }}</small>

                                                </div>
                                            </div>

                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <div class="card-body border-top hospital_allcardbodydesign">
                                        <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Registration</h5>
                                        <div class="main-profile-contact-list ">
                                            <div class="form-group col-md-6">
                                                <!-- <label for="type"> <SPAN style="color:blue;font-weight: 600;">TYPE</SPAN> </label> -->
                                                <select name="type" class="form-control select2-show-search"
                                                    id="type">
                                                    <option value=""
                                                        @if (isset($type)) {{ $type == '' ? 'selected' : '' }} @endif>
                                                        Select One.....</option>
                                                    <option value="opd"
                                                        @if (isset($type)) {{ $type == 'opd' ? 'selected' : '' }} @endif>
                                                        OPD Registation</option>
                                                    <option value="emg"
                                                        @if (isset($type)) {{ $type == 'emg' ? 'selected' : '' }} @endif>
                                                        EMG Registation</option>
                                                </select>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button class="btn btn-indigo" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>

    <script>
        $(document).ready(function() {
            $("#state").change(function(event) {
                // alert('ok')
                event.preventDefault();
                let state = $(this).val();
                // alert(state);
                $('#district').html('<option vaule="" >Select District...</option>');
                $.ajax({
                    url: "{{ route('find-fr-district-by-state') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        state_id: state,
                    },

                    success: function(response) {


                        $.each(response, function(key, value) {
                            $('#district').append(
                                `<option value="${value.id}">${value.name}</option>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        function getage(dob_) {
            const dob = new Date(dob_);
            const nw = new Date();



            let dob_year = dob.getFullYear();
            let dob_month = dob.getMonth() + 1;
            let dob_day = dob.getDate();

            let nw_year = nw.getFullYear();
            let nw_month = nw.getMonth() + 1;
            let nw_day = nw.getDate();

            let dob_in_date = ((parseInt(dob_year) * parseInt(365)) + (parseInt(dob_month) * parseInt(30)) + parseInt(
                dob_day));
            let now_in_date = ((parseInt(nw_year) * parseInt(365)) + (parseInt(nw_month) * parseInt(30)) + parseInt(
                nw_day));
            if (now_in_date >= dob_in_date) {
                let diffe_date = parseInt(parseInt(now_in_date) - parseInt(dob_in_date));

                let year = parseInt(diffe_date / 365);
                let remnder = diffe_date % 365;

                let month = parseInt(remnder / 30);
                let days = remnder % 30;

                $('#date_of_birth_year').val(year);
                $('#date_of_birth_month').val(month);
                $('#date_of_birth_day').val(days);
            } else {

                alert('Enter a Valid Date');
                $('#date_of_birth').reset();
            }

        }
    </script>

    <script>
        function myFunction() {
            if (document.getElementById("myCheckbox").checked) {
                var GurdianName = $('#guardian_name').val();
                var GurdianContactNo = $('#guardian_contact_no').val();

                $('#local_guardian_name').val(GurdianName);
                $('#local_guardian_contact_no').val(GurdianContactNo);

            } else {
                $('#local_guardian_name').val(' ');
                $('#local_guardian_contact_no').val(' ');
            }
        }
    </script>

    <script>
        function localAddress() {
            if (document.getElementById("checkboxforaddress").checked) {
                var address = $('#address').val();
                // var country = $('#country').val();
                // var state = $('#state').val();
                // var district = $('#district').val();
                var pin_no = $('#pin_no').val();

                $('#local_address').val(address);
                // $('#country_local').val(country);
                // $('#state_local').val(state);
                // $('#district_local').val(district);
                $('#local_pin_no').val(pin_no);
            } else {
                $('#local_address').val(' ');
                // $('#country_local').val(' ');
                // $('#state_local').val(' ');
                // $('#district_local').val(' ');
                $('#local_pin_no').val(' ');
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#country").change(function(event) {
                // alert('ok')
                event.preventDefault();
                let country = $(this).val();
                // alert(state);
                $('#state').html('<option vaule="" >Select State...</option>');
                $.ajax({
                    url: "{{ route('find-state-by-country') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        countries_id: country,
                    },

                    success: function(response) {

                        $.each(response, function(key, value) {
                            $('#state').append(
                                `<option value="${value.id}">${value.name}</option>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#country_local").change(function(event) {
                // alert('ok')
                event.preventDefault();
                let country_local = $(this).val();
                // alert(state);
                $('#state_local').html('<option vaule="" >Select State...</option>');
                $.ajax({
                    url: "{{ route('find-local-state-by-country') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        country_id_local: country_local,
                    },

                    success: function(response) {

                        $.each(response, function(key, value) {
                            $('#state_local').append(
                                `<option value="${value.id}">${value.name}</option>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#state_local").change(function(event) {
                // alert('ok')
                event.preventDefault();
                let state_local = $(this).val();
                // alert(state);
                $('#district_local').html('<option vaule="" >Select District...</option>');
                $.ajax({
                    url: "{{ route('find-local-district-by-state') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        state_ids: state_local,
                    },

                    success: function(response) {


                        $.each(response, function(key, value) {
                            $('#district_local').append(
                                `<option value="${value.id}">${value.name}</option>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        function showDetails(value) {

            let in_india = `<option value="">Select One...</option>
        <option value="Voter Card">Voter Card</option>
        <option value="Aadhar Card">Aadhar Card</option>
        <option value="Ration Card">Ration Card</option>`;

            let out_india = `<option value="Passport">Passport</option>
        `;

            if (value == '1') {
                $('#identification_name').html(in_india);
            } else {
                $('#identification_name').html(out_india);
            }
        }
    </script>
@endsection
