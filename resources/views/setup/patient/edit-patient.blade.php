@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

    <form action="{{ route('update-new-patient-details') }}" method="POST">
        @csrf
        <input name="id" value="{{ $patient->id }}" type="hidden">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="border-0">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Patient</h4>
                                </div>
                                <div class="card-body hospital_allcardbodydesign">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Personal Information</h5>
                                    <div class="main-profile-bio mb-0">
                                        <div class="row">
                                            <div class="form-group col-md-2 newdesign">
                                                <label for="prefix">Prefix <span class="text-danger">*</span></label>
                                                <select name="prefix" class="form-control" id="prefix">
                                                    <option value="">Select</option>
                                                    @foreach (Config::get('static.prefix') as $lang => $prefixs)
                                                    <option value="{{$prefixs}}" {{ @$prefixs==$patient->prefix ?
                                                        'selected' : " " }}> {{$prefixs}}</option>
                                                    @endforeach
                                                </select>
                                                @error('prefix')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-2 newdesignadd ">
                                                <input type="text" id="first_name" value="{{ @$patient->first_name }}" name="first_name">
                                                <label for="first_name"> Pateient's First name<span class="text-danger">*</span> </label>
                                                <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 newdesignadd">

                                                <input type="text" id="middle_name" value="{{ @$patient->middle_name }}" name="middle_name">
                                                <label for="middle_name"> Pateient's Middile name </label>

                                            </div>

                                            <div class="form-group col-md-2 newdesignadd">

                                                <input type="text" id="last_name" value="{{ @$patient->last_name }}" name="last_name">
                                                <label for="last_name"> Pateient's Last name <span class="text-danger">*</span></label>
                                                <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                            </div>


                                            <div class="form-group col-md-2 newdesignadd">

                                                <input type="email" id="email_no" value="{{ @$patient->email }}" name="email_no">
                                                <label for="email_no"> Email Id </label>

                                            </div>

                                            <div class="form-group col-md-2 newdesignadd">

                                                <input type="text" id="Phone_no" name="phone" value="{{ @$patient->phone }}">
                                                <label for="phone_no"> Pateient's Phone No<span class="text-danger">*</span></label>
                                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 newdesign ">
                                                <label for="marital_status">Marital Status </label>
                                                <select name="marital_status" class="form-control select2-show-search" id="marital_status">
                                                    <option value="">Select One...</option>
                                                    @foreach (Config::get('static.marital_status') as $lang => $marital)
                                                    <option value="{{$marital}}" {{ @$marital==$patient->marital_status
                                                        ? 'selected' : " "}}> {{$marital}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2 newdesign  ">
                                                <label for="blood_group">Blood Group </label>
                                                <select name="blood_group" class="form-control" id="blood_group">
                                                    <option value="">Select One...</option>
                                                    @foreach (Config::get('static.blood_groups') as $lang =>
                                                    $blood_group)
                                                    <option value="{{$blood_group}}" {{ @$blood_group==$patient->
                                                        blood_group ? 'selected' : " "}}> {{$blood_group}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2 newuserlisttchange">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" required class="form-control select2-show-search" id="gender">
                                                    <option value="">Select</option>
                                                    @foreach (Config::get('static.gender') as $lang => $genders)
                                                    <option value="{{$genders}}" {{ @$genders==$patient->gender ?
                                                        'selected' : " "}}> {{$genders}}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-2 newaddappon">
                                                <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" onchange="getagefromdate(this.value)" value="{{ date('Y-m-d',strtotime($patient->date_of_birth)) }}" required>

                                                <small class="text-danger">{{ $errors->first('date_of_birth') }}</small>
                                            </div>

                                            <div class="form-group col-md-4 newdesignadd">

                                                <div class="row">
                                                    <div class="col-lg-4">

                                                        <input type="text" id="date_of_birth_year" onkeyup="getage()" required name="date_of_birth_year" value=" {{
                                                            @$patient->year }}">
                                                        <label for="date_of_birth_year"> Year <span class="text-danger">*</span></label>
                                                        <small class="text-danger">{{
                                                            $errors->first('date_of_birth_year') }}</small>
                                                    </div>

                                                    <div class="col-lg-4 ">

                                                        <input type="text" id="date_of_birth_month" value="{{ @$patient->month }}" onkeyup="getage()" required name="date_of_birth_month">
                                                        <label for="date_of_birth_month"> Month <span class="text-danger">*</span></label>
                                                        <small class="text-danger">{{
                                                            $errors->first('date_of_birth_month') }}</small>
                                                    </div>
                                                    <div class="col-lg-4  ">

                                                        <input type="text" id="date_of_birth_day" onkeyup="getage()" required name="date_of_birth_day" value="{{ @$patient->day }}">
                                                        <label for="date_of_birth_day"> Day <span class="text-danger">*</span></label>
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

                                                        <input type="text" id="guardian_name" value="{{ @$patient->guardian_name }}" name="guardian_name" required />
                                                        <label for="guardian_name"> Guardian's Name<span class="text-danger">*</span></label>
                                                        <small class="text-danger">{{ $errors->first('guardian_name')
                                                            }}</small>

                                                    </div>

                                                    <div class="form-group col-md-6 newuserchangee">

                                                        <input type="text" id="guardian_contact_no" value="{{ @$patient->guardian_contact_no }}" name="guardian_contact_no">
                                                        <label for="guardian_contact_no"> Guardian's Phone No<span class="text-danger">*</span></label>
                                                        <small class="text-danger">{{
                                                            $errors->first('guardian_contact_no') }}</small>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <h5 class="font-weight-bold"> <input type="checkbox" id="myCheckbox" onchange="myFunction()"> <i class="fas fa-user-circle"></i> Local
                                                Gurdian Name</h5>
                                            <div class="main-profile-contact-list ">
                                                <div class="row">
                                                    <div class="form-group col-md-6 newuserchangeedesign">

                                                        <input type="text" id="local_guardian_name" value="{{ @$patient->local_guardian_name }}" name="local_guardian_name">
                                                        <label for="local_guardian_name"> Local Guardian's Name<span class="text-danger">*</span></label>
                                                        <small class="text-danger">{{
                                                            $errors->first('local_guardian_name') }}</small>

                                                    </div>

                                                    <div class="form-group col-md-6 newuserchangeedesign ">

                                                        <input type="text" id="local_guardian_contact_no" value="{{ @$patient->local_guardian_contact_no }}" name="local_guardian_contact_no">
                                                        <label for="Local Gurdian Contact No"> Local Guardian's Phone
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
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Address</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="row">
                                            <div class="form-group col-md-4 newuserchangee ">

                                                <input type="text" id="address" value="{{ @$patient->address }}" name="address" required>
                                                <label for="address">Address<span class="text-danger">*</span></label>
                                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 addpatientdesign">
                                                <label for="country">Country <span class="text-danger">*</span></label>
                                                <select name="country" class="form-control select2-show-search" id="country" onchange="getCountry(this.value,{{$patient->state}} , {{$patient->district}})" required>
                                                    <option value="">Select Country... </option>
                                                    @foreach($country as $countrys)
                                                    <option value="{{$countrys->id}}" {{ @$countrys->id ==
                                                        @$patient->country ? 'selected' : " "}}>{{
                                                        $countrys->country_name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger">{{ $errors->first('country') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 addpatientdesign">
                                                <label for="state">State <span class="text-danger">*</span></label>
                                                <select name="state" class="form-control select2-show-search" id="state" onchange="getDistricts(this.value,{{$patient->district}})" required>
                                                    <option value="">Select State...</option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('state') }}</small>
                                            </div>


                                            <div class="form-group col-md-2 addpatientdesign ">
                                                <label for="district">District <span class="text-danger">*</span></label>
                                                <select name="district" class="form-control select2-show-search" id="district" required>
                                                    <option value="">Select District...</option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('district') }}</small>
                                            </div>

                                            <div class="form-group col-md-2 addpatientdesignpin ">

                                                <input type="text" id="pin_no" id="pin_no" name="pin_no" value="{{ @$patient->pin_no }}" required>
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

                                                <input type="text" id="local_address" value="{{ @$patient->local_address }}" name="local_address">
                                                <label for="local_address">Enter Local Address<span class="text-danger">*</span></label>
                                                <small class="text-danger">{{ $errors->first('local_address') }}</small>

                                            </div>

                                            <div class="form-group col-md-2 addpatientdesignpin">
                                                <label for="country_local">Country <span class="text-danger">*</span></label>
                                                <select name="country_local" class="form-control select2-show-search" id="country_local" onchange="getLocalCountry(this.value,{{$patient->state}} , {{$patient->district}})">
                                                    <option value="">Select Country... </option>
                                                    @foreach($country as $item)
                                                    <option value="{{$item->id}}" {{ @$item->id ==
                                                        $patient->country_local ? 'selected' : " "}}>{{
                                                        $item->country_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>


                                            <div class="form-group col-md-2 addpatientdesignpin">
                                                <label for="state_local">State <span class="text-danger">*</span></label>
                                                <select name="state_local" class="form-control select2-show-search" id="state_local" onchange="getLocalDistricts(this.value,{{$patient->district}})">
                                                    <option value="">Select State...</option>
                                                </select>

                                            </div>


                                            <div class="form-group col-md-2 addpatientdesignpin">
                                                <label for="district_local">District <span class="text-danger">*</span></label>
                                                <select name="district_local" class="form-control select2-show-search" id="district_local">
                                                    <option value="">Select District...</option>
                                                </select>

                                            </div>

                                            <div class="form-group col-md-2 addpin">
                                                <label for="local_pin_no">Pin No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="local_pin_no" name="local_pin_no" value="{{ $patient->local_pin_no }}">


                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body border-top hospital_allcardbodydesign ">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Other Details</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="form-group col-md-12 " id="indentification">
                                            <div class="form-group col-md-5 addpatientdesignin d-inline-block">
                                                <label for="identification_name"> Identification Name </label>
                                                <select name="identification_name" class="form-control select2-show-search" id="identification_name">
                                                    <option value="">Select One...</option>
                                                    <option value="Voter Card" @if( $patient->identification_name ==
                                                        'Voter Card') selected @endif>Voter Card</option>
                                                    <option value="Aadhar Card" @if( $patient->identification_name ==
                                                        'Aadhar Card') selected @endif>Aadhar Card</option>
                                                    <option value="Ration Card" @if( $patient->identification_name ==
                                                        'Ration Card') selected @endif>Ration Card</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-5 addpatientdesign d-inline-block">
                                                <input type="text" value="{{ $patient->identification_number }}" id="identification_number" name="identification_number">
                                                <label for="identification_number">National Identification Number
                                                </label>
                                            </div>
                                        </div>

                                        <!-- </div> -->
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
    function getage() {
        var year = $('#date_of_birth_year').val();
        var month = $('#date_of_birth_month').val();
        var days = $('#date_of_birth_day').val();
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
    function showDetails(value, identification_name = null) {
        var sel = '';
        if (identification_name == "Voter Card") {
            var sel = 'selected';
        }
        if (identification_name == "Aadhar Card") {
            var sel = 'selected';
        }
        if (identification_name == "Ration Card") {
            var sel = 'selected';
        }
        let in_india = `<option value="">Select One...</option>
        <option value="Voter Card" ${sel} >Voter Card</option>
        <option value="Aadhar Card" ${sel} >Aadhar Card</option>
        <option value="Ration Card" ${sel}>Ration Card</option>`;

        let out_india = `<option value="Passport">Passport</option>
        `;

        if (value == '1') {
            $('#identification_name').html(in_india);
        } else {
            $('#identification_name').html(out_india);
        }
    }
</script>
<script>
    function getCountry(country_id, state_id, district_id) {
        $('#state').val('');
        $("#state").html("<option value=''>Select... </option>");
        $("#district").html("<option value=''>Select... </option>");
        $.ajax({
            url: "{{ route('find-state-by-country') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                countries_id: country_id,
            },

            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == state_id ? 'selected' : '');
                    $('#state').append(`<option value="${value.id}" ${sel}>${value.name}</option>`);
                });

                getDistricts(state_id, district_id);
            },
            error: function(error) {
                console.log(error);
            }

        });
    }
</script>

<script>
    function getDistricts(state, districts_id) {
        var div_data = '';
        $('#district').val('');
        $("#district").html("<option value=''>Select District... </option>");
        var ijij = $('#state').val();
        $.ajax({
            url: "{{ route('find-fr-district-by-state') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                state_id: state,
            },
            success: function(response) {
                //  console.log(response);
                console.log('nvifei' + response);
                $.each(response, function(key, value) {
                    let sel = (value.id == districts_id ? 'selected' : '');
                    div_data += `<option value="${value.id}" ${sel}>${value.name}</option>`;
                });
                $('#district').append(div_data);

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
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

        let dob_in_date = ((parseInt(dob_year) * parseInt(365)) + (parseInt(dob_month) * parseInt(30)) + parseInt(dob_day));
        let now_in_date = ((parseInt(nw_year) * parseInt(365)) + (parseInt(nw_month) * parseInt(30)) + parseInt(nw_day));
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
    $(document).ready(function() {
        $("#country").change(function(event) {
            // alert('ok')
            event.preventDefault();
            let country = $(this).val();
            let states_id = $(this).attr("data-state_id");
            // alert(states_id);
            $('#state').html('<option vaule="" >Select State...</option>');
            $.ajax({
                url: "{{ route('find-state-by-country') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    country_id: country,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        let sel = (value.id == states_id ? 'selected' : '');
                        $('#state').append(`<option value="${value.id}" ${sel}>${value.name}</option>`);
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
    function getLocalCountry(local_country_id, local_state_id, local_district_id, identification_name = null) {
        $('#state_local').val('');
        $("#state_local").html("<option value='l'>Select... </option>");
        $.ajax({
            url: "{{ route('find-local-state-by-country') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                country_id_local: local_country_id,
            },

            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == local_state_id ? 'selected' : '');
                    $('#state_local').append(`<option value="${value.id}" ${sel}>${value.name}</option>`);
                });
                getLocalDistricts(local_state_id, local_district_id);
            },
            error: function(error) {
                console.log(error);
            }
        });
        // showDetails(local_country_id,identification_name);
    }
</script>

<script>
    function getLocalDistricts(state_local, district_local) {

        var div_data = '';
        $('#district_local').val('');
        $("#district_local").html("<option value='l'>Select District... </option>");
        var ijij = $('#state_local').val();
        $.ajax({
            url: "{{ route('find-local-district-by-state') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                state_ids: state_local,
            },
            success: function(response) {
                //  console.log(response);
                console.log('nvifei' + response);
                $.each(response, function(key, value) {
                    let sel = (value.id == district_local ? 'selected' : '');
                    div_data += `<option value="${value.id}" ${sel}>${value.name}</option>`;
                });
                $('#district_local').append(div_data);

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function same_as_address_localaddress() {
        if (document.getElementById("vjrvervre").checked) {
            ;
            $('#same_address').attr('style', 'display:none', true);
        } else {
            $('#same_address').removeAttr('style', true);
        }
    }
</script>



@endsection