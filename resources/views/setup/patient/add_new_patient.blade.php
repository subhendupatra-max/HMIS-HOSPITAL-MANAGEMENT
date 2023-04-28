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
                                            <div class="form-group col-md-2 newdesign">
                                                <label for="prefix">Prefix <span class="text-danger">*</span></label>
                                                <select name="prefix" class="form-control" id="prefix" required>
                                                    <option value="">Prefix</option>
                                                    @foreach (Config::get('static.prefix') as $lang => $prefixs)
                                                    <option value="{{ $prefixs }}"> {{ $prefixs }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('prefix')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-2 custom-field newdesignadd">
                                                <input type="text" id="first_name" class="text-capitalize" value="{{ old('first_name') }}"
                                                    name="first_name" required>
                                                <label for="first_name"> Pateient's First name<span
                                                        class="text-danger">*</span> </label>
                                                @error('first_name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <div class="form-group col-md-2 newdesignadd">
                                                <input type="text" id="middle_name" class="text-capitalize" value="{{ old('middle_name') }}"
                                                    name="middle_name">
                                                <label for="middle_name"> Pateient's Middile name </label>
                                            </div>


                                            <div class="form-group col-md-2 newdesignadd">
                             
                                                <input type="text" id="last_name" class="text-capitalize" value="{{ old('last_name') }}"
                                                    name="last_name" required>
                                                <label for="last_name"> Pateient's Last name <span
                                                        class="text-danger">*</span></label>
                                                @error('last_name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>
                                            <div class="form-group col-md-2 newdesignadd">
                                                <input type="email" id="email_no" value="{{ old('email_no') }}"
                                                    name="email_no">
                                                <label for="email_no"> Email Id </label>
                                            </div>
                                            <div class="form-gsroup col-md-2 newdesignadd ">
                                                <input type="text" id="patient_ph_no" name="phone" required>
                                                <label for="patient_ph_no"> Pateient's Phone No<span
                                                        class="text-danger">*</span></label>
                                                @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-2 newdesign">
                                                <label for="marital_status">Marital Status </label>
                                                <select name="marital_status" class="form-control select2-show-search"
                                                    id="marital_status">
                                                    <option value="">Marital Status</option>
                                                    @foreach (Config::get('static.marital_status') as $lang => $marital)
                                                    <option value="{{ $marital }}"> {{ $marital }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2 newdesign ">
                                                <label for="blood_group">Blood Group </label>
                                                <select name="blood_group" class="form-control" id="blood_group">
                                                    <option value="" for="blood_group">Blood Group</option>
                                                    @foreach (Config::get('static.blood_groups') as $lang =>
                                                    $blood_group)
                                                    <option value="{{ $blood_group }}"> {{ $blood_group }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2 newuserlisttchange ">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control select2-show-search"
                                                    id="gender" required>
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

                                            <div class="form-group col-md-2 newaddappon">
                                                <label for="date_of_birth">Date Of Birth <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" required class="form-control" id="date_of_birth"
                                                     name="date_of_birth"
                                                    onchange="getagefromdate(this.value)" value="{{ old('date_of_birth') }}"
                                                    required />
                                                <small class="text-danger">{{ $errors->first('date_of_birth') }}</small>
                                            </div>

                                            <div class="form-group col-md-4 ">
                                              
                                                <div class="row">
                                                    <div class="col-lg-4 newdesignadd">
                                                        <input type="text" required value="0" onkeyup="getage()" id="date_of_birth_year" name="date_of_birth_year">
                                                        <label for="date_of_birth_year"> Year</label>
                                                        <small class="text-danger">{{
                                                            $errors->first('date_of_birth_year') }}</small>
                                                    </div>

                                                    <div class="col-lg-4 newdesignadd">
                                                        <input type="text" required value="0" onkeyup="getage()" id="date_of_birth_month" name="date_of_birth_month">
                                                        <label for="date_of_birth_month"> Month</label>
                                                        <small class="text-danger">{{
                                                            $errors->first('date_of_birth_month') }}</small>

                                                    </div>
                                                    <div class="col-lg-4 newdesignadd">
                                                        <input type="text" required onkeyup="getage()" value="0" id="date_of_birth_day"  name="date_of_birth_day">
                                                        <label for="date_of_birth_day"> Day</label>
                                                        <small class="text-danger">{{
                                                            $errors->first('date_of_birth_day') }}</small>
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
                                                    <div class="form-group col-md-6 newuserchangee">
                                                        <input type="text" class="text-capitalize" id="guardian_name"
                                                            value="{{ old('guardian_name') }}" name="guardian_name"
                                                            required />
                                                        <label for="guardian_name"> Guardian Name<span
                                                                class="text-danger">*</span></label>
                                                        <small class="text-danger">{{ $errors->first('guardian_name')
                                                            }}</small>
                                                    </div>

                                                    <div class="form-group col-md-6 newuserchangee">
                                                        <input type="text" id="guardian_contact_no"
                                                            value="{{ old('guardian_contact_no') }}"
                                                            name="guardian_contact_no" required>
                                                        <label for="guardian_contact_no"> Guardian Phone No<span
                                                                class="text-danger">*</span></label>
                                                        <small class="text-danger">{{
                                                            $errors->first('guardian_contact_no') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <h5 class="font-weight-bold"> <input type="checkbox"  id="myCheckbox" onchange="myFunction()"> <i
                                                    class="fas fa-user-circle"></i> Local
                                                Gurdian Name</h5>
                                            <div class="main-profile-contact-list ">
                                                <div class="row">
                                                    <div class="form-group col-md-6 newuserchangeedesign">

                                                        <input type="text" class="text-capitalize" id="local_guardian_name"
                                                            value="{{ old('local_guardian_name') }}"
                                                            name="local_guardian_name" required>
                                                        <label for="local_guardian_name"> Local Gurdian Name<span
                                                                class="text-danger">*</span></label>
                                                        <small class="text-danger">{{
                                                            $errors->first('local_guardian_name') }}</small>
 
                                                    </div>

                                                    <div class="form-group col-md-6 newuserchangeedesign ">
                                                        <input type="text" id="local_guardian_contact_no"
                                                            value="{{ old('local_guardian_contact_no') }}"
                                                            name="local_guardian_contact_no" required>
                                                        <label for="Local Gurdian Contact No"> Local Gurdian Phone
                                                            No<span class="text-danger">*</span></label>
                                                        <small class="text-danger">{{
                                                            $errors->first('local_guardian_contact_no') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top hospital_allcardbodydesign">
                                    <h5 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Address</h5>
                                    <div class="main-profile-contact-list">
                                        <div class="row">
                                            <div class="form-group col-md-4 newuserchangee">
                                                <input type="text" id="address" value="{{ old('address') }}"
                                                    name="address" required>
                                                <label for="address">Address<span class="text-danger">*</span></label>
                                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 addpatientdesign">
                                                <label for="country">Country <span class="text-danger">*</span></label>
                                                <select name="country" class="form-control select2-show-search"
                                                    id="country" onchange="showDetails(this.value)" required>
                                                    <option value="">Select Country... </option>
                                                    @foreach ($country as $countrys)
                                                    <option value="{{ $countrys->id }}" >
                                                        {{ $countrys->country_name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger">{{ $errors->first('country') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 addpatientdesign ">
                                                <label for="state">State <span class="text-danger">*</span></label>
                                                <select required name="state" class="form-control select2-show-search"
                                                    id="state">
                                                    <option value="">Select State...</option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('state') }}</small>
                                            </div>


                                            <div class="form-group col-md-2 addpatientdesign ">
                                                <label for="district">District <span
                                                        class="text-danger">*</span></label>
                                                <select name="district" class="form-control select2-show-search"
                                                    id="district" required>
                                                    <option value="">Select District...</option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('district') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 addpatientdesignpin">
                                                <input type="text" id="pin_no" id="pin_no" name="pin_no"
                                                    value="{{ old('pin_no') }}" required>
                                                <label for="pin_no">Pin No.<span class="text-danger">*</span></label>
                                                <small class="text-danger">{{ $errors->first('pin_no') }}</small>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body border-top hospital_allcardbodydesign">
                                        <input type="checkbox" name="localaddress_and_address_are_same" onchange="same_as_address_localaddress()" id="vjrvervre" value="yes" />
                                        <span style="font-weight: bold !important;
                                            font-size: 15px;color:#0a1272; margin-bottom:3px;">Is
                                            Address And Local Address Same ?
                                        </span>
                                    </div>
                                    <div class="card-body border-top hospital_allcardbodydesign" id="same_address">
                                        <h5 class="font-weight-bold"><i class="fas fa-map-marker"></i>Local Address</h5>
                                        <div class="main-profile-contact-list ">
                                            <div class="row">
                                                <div class="form-group col-md-4 addpatientdesignaddress  ">
                                                    <input type="text" id="local_address"
                                                        value="{{ old('local_address') }}" name="local_address">
                                                    <label for="local_address">Enter Local Address<span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="form-group col-md-2 addpatientdesignpin">
                                                    <label for="country_local">Country <span
                                                            class="text-danger">*</span></label>
                                                    <select name="country_local"
                                                        class="form-control select2-show-search" id="country_local"
                                                       >
                                                        <option value="" >Select Country... </option>
                                                        @foreach ($country as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == '1' ? 'selected'
                                                            : ' ' }}>
                                                            {{ $item->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                
                                                </div>

                                                <div class="form-group col-md-2 addpatientdesignpin  ">
                                                    <label for="state_local">State <span
                                                            class="text-danger">*</span></label>
                                                    <select name="state_local" class="form-control select2-show-search"
                                                        id="state_local">
                                                        <option value="">Select State...</option>
                                                    </select>
                                              
                                                </div>

                                                <div class="form-group col-md-2 addpatientdesignpin">
                                                    <label for="district_local">District <span
                                                            class="text-danger">*</span></label>
                                                    <select name="district_local"
                                                        class="form-control select2-show-search" id="district_local">
                                                        <option value="">Select District...</option>
                                                    </select>
                                              
                                                </div>

                                                <div class="form-group col-md-2 addpin">
                                                    <input type="text" id="local_pin_no" name="local_pin_no"
                                                        value="{{ old('local_pin_no') }}">
                                                    <label for="local_pin_no">Pin No.<span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>

                                        </div>
                                </div>

                                <div class="card-body border-top hospital_allcardbodydesign">
                                    <h5 class="font-weight-bold"><i class="fas fa-tasks"></i>Identification Details</h5>
                                    <div class="main-profile-contact-list ">
                                        <!-- <div class="row"> -->
                                        <div class="form-group col-md-12 " id="indentification">
                                            <div class="form-group col-md-5 addpatientdesignin d-inline-block">
                                                <label for="identification_name"> Identification Name </label>
                                                <select name="identification_name"
                                                    class="form-control select2-show-search" id="identification_name">
                                                    <option value="">Select One...</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-5 addpatientdesign d-inline-block">
                                                <input type="text" value="{{ old('identification_number') }}"
                                                    id="identification_number" name="identification_number" />
                                                <label for="identification_number">National Identification Number</label>
                                                <small class="text-danger">{{ $errors->first('phone') }}</small>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body border-top hospital_allcardbodydesign">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Registration Type</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="form-group col-md-6 addpatientdesigntype">
                                        
                                            <select name="type" class="form-control select2-show-search" id="type">
                                                <option value="" @if (isset($type)) {{ $type=='' ? 'selected' : '' }}
                                                    @endif>
                                                    Select One.....</option>
                                                <option value="opd" @if (isset($type)) {{ $type=='opd' ? 'selected' : ''
                                                    }} @endif>
                                                    OPD Registation</option>
                                                <option value="emg" @if (isset($type)) {{ $type=='emg' ? 'selected' : ''
                                                    }} @endif>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    function getage(){
        var year =  $('#date_of_birth_year').val();
        var month =  $('#date_of_birth_month').val();
        var days =  $('#date_of_birth_day').val();
        // var duration = {years: 40, months: 2, days: 3}; // duration object
        var currentDate = new Date(); // current date object
        var date = new Date(currentDate.getFullYear() - year, 
                    currentDate.getMonth() - month, 
                    currentDate.getDate() - days); // subtracting duration from current date
        var yyyy = date.getFullYear().toString(); // extracting year
        var mm = (date.getMonth() + 1).toString().padStart(2, '0'); // extracting month and padding with 0 if needed
        var dd = date.getDate().toString().padStart(2, '0'); // extracting day and padding with 0 if needed
        var formattedDate = yyyy + '-' + mm + '-' + dd; // formatting date string
        $('#date_of_birth').val(formattedDate);
    }
</script>

<script>
    $(document).ready(function() {
            $("#state").change(function(event) {
                event.preventDefault();
                let state = $(this).val();
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
    function getagefromdate(dob_) {
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
    function same_as_address_localaddress() {
            if (document.getElementById("vjrvervre").checked) {;
                $('#same_address').attr('style','display:none',true);
            } else {
                $('#same_address').removeAttr('style',true);
            }
        }
</script>
<script>
    $(document).ready(function() {
            $("#country").change(function(event) {
                event.preventDefault();
                let country = $(this).val();
                $('#state').html('<option value="" >Select State...</option>');
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
                $('#state_local').html('<option value="" >Select State...</option>');
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
                $('#district_local').html('<option value="" >Select District...</option>');
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