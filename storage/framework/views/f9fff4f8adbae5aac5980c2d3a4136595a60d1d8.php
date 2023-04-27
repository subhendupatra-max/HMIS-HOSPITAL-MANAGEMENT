
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

    <form action="<?php echo e(route('update-new-patient-details')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input name="id" value="<?php echo e($patient->id); ?>" type="hidden">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="border-0">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Patient</h4>
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Personal Information</h5>
                                    <div class="main-profile-bio mb-0">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="prefix">Prefix <span class="text-danger">*</span></label>
                                                <select name="prefix" class="form-control" id="prefix">
                                                    <option value="">Select</option>
                                                    <?php $__currentLoopData = Config::get('static.prefix'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $prefixs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($prefixs); ?>" <?php echo e(@$prefixs == $patient->prefix ? 'selected' : " "); ?>> <?php echo e($prefixs); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="first_name" value="<?php echo e(@$patient->first_name); ?>" name="first_name" placeholder="Enter first Name">
                                                <small class="text-danger"><?php echo e($errors->first('first_name')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="middle_name">Middle Name </label>
                                                <input type="text" class="form-control" id="middle_name" value="<?php echo e(@$patient->middle_name); ?>" name="middle_name" placeholder="Enter Middle Name">
                                                <small class="text-danger"><?php echo e($errors->first('middle_name')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="last_name" value="<?php echo e(@$patient->last_name); ?>" name="last_name" placeholder="Enter Last Name">
                                                <small class="text-danger"><?php echo e($errors->first('last_name')); ?></small>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="marital_status">Marital Status </label>
                                                <select name="marital_status" class="form-control select2-show-search" id="marital_status">
                                                    <option value="">Select</option>
                                                    <?php $__currentLoopData = Config::get('static.marital_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $marital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($marital); ?>" <?php echo e(@$marital == $patient->marital_status ? 'selected' : " "); ?>> <?php echo e($marital); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="blood_group">Blood Group </label>
                                                <select name="blood_group" class="form-control" id="blood_group">
                                                    <option value="">Select</option>
                                                    <?php $__currentLoopData = Config::get('static.blood_groups'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $blood_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($blood_group); ?>" <?php echo e(@$blood_group == $patient->blood_group ? 'selected' : " "); ?>> <?php echo e($blood_group); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control select2-show-search" id="gender">
                                                    <option value="">Select</option>
                                                    <?php $__currentLoopData = Config::get('static.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $genders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($genders); ?>" <?php echo e(@$genders == $patient->gender ? 'selected' : " "); ?>> <?php echo e($genders); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" onchange="getage(this.value)" value="<?php echo e(old('date_of_birth')); ?>">
                                                <small class="text-danger"><?php echo e($errors->first('date_of_birth')); ?></small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Age (yy-mm-dd) <span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control" id="date_of_birth_year" name="year" placeholder="Year" required value="<?php echo e(@$patient->year); ?>">
                                                        <small class="text-danger"><?php echo e($errors->first('date_of_birth_year')); ?></small>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control" id="date_of_birth_month" name="month" placeholder="Month" required value="<?php echo e(@$patient->month); ?>">
                                                        <small class="text-danger"><?php echo e($errors->first('date_of_birth_month')); ?></small>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control" id="date_of_birth_day" name="day" placeholder="Day" required value="<?php echo e(@$patient->day); ?>">
                                                        <small class="text-danger"><?php echo e($errors->first('date_of_birth_day')); ?></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" value="<?php echo e(@$patient->phone); ?>" id="phone" name="phone" placeholder="Enter Your Phone No.">
                                                <small class="text-danger"><?php echo e($errors->first('phone')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="email">Email </label>
                                                <input type="email" class="form-control" value="<?php echo e(@$patient->email); ?>" id="email" name="email" placeholder="Enter Your Eamil">
                                                <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h6 class="font-weight-bold">Is Gurdian And Local Gurdian Same ?

                                        <input type="checkbox" id="myCheckbox" onchange="myFunction()" />
                                    </h6>
                                    <h5 class="font-weight-bold"><i class="fa fa-cube"></i> Gurdian Details</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="address">Gurdian Details <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="guardian_name" value="<?php echo e(@$patient->guardian_name); ?>" name="guardian_name" placeholder="Enter Guardian Name">
                                                <small class="text-danger"><?php echo e($errors->first('guardian_name')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="guardian_contact_no"> Gurdian Contact No <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="guardian_contact_no" value="<?php echo e(@$patient->guardian_contact_no); ?>" name="guardian_contact_no" placeholder="Enter Gurdian Phone No">
                                                <small class="text-danger"><?php echo e($errors->first('guardian_contact_no')); ?></small>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="card-body border-top">

                                    <h5 class="font-weight-bold"><i class="fa fa-cube"></i> Local Gurdian Name</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="address"> Local Gurdian Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="local_guardian_name" value="<?php echo e(@$patient->local_guardian_name); ?>" name="local_guardian_name" placeholder="Enter Guardian Name">
                                                <small class="text-danger"><?php echo e($errors->first('local_guardian_name')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="local_guardian_contact_no">Local Gurdian Contact No <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="local_guardian_contact_no" value="<?php echo e(@$patient->local_guardian_contact_no); ?>" name="local_guardian_contact_no" placeholder="Enter Local Gurdian Name">
                                                <small class="text-danger"><?php echo e($errors->first('local_guardian_contact_no')); ?></small>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Address</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="address">Address <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="address" value="<?php echo e(@$patient->address); ?>" name="address" placeholder="Enter Address">
                                                <small class="text-danger"><?php echo e($errors->first('address')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="country">Country <span class="text-danger">*</span></label>
                                                <select name="country" class="form-control select2-show-search" id="country" onchange="getCountry(this.value,<?php echo e($patient->state); ?> , <?php echo e($patient->district); ?>)" onchange="showDetails(this.value)">
                                                    <option value="">Select Country... </option>
                                                    <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($countrys->id); ?>" <?php echo e(@$countrys->id == $patient->country ? 'selected' : " "); ?>><?php echo e($countrys->country_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <small class="text-danger"><?php echo e($errors->first('country')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="state">State <span class="text-danger">*</span></label>
                                                <select name="state" class="form-control select2-show-search" id="state" onchange="getDistricts(this.value,<?php echo e($patient->district); ?>)" required>
                                                    <option value="">Select State...</option>
                                                </select>
                                                <small class="text-danger"><?php echo e($errors->first('state')); ?></small>
                                            </div>


                                            <div class="form-group col-md-3">
                                                <label for="district">District <span class="text-danger">*</span></label>
                                                <select name="district" class="form-control select2-show-search" id="district" required>
                                                    <option value="">Select District...</option>
                                                </select>
                                                <small class="text-danger"><?php echo e($errors->first('district')); ?></small>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="pin_no">Pin No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pin_no" name="pin_no" value="<?php echo e(@$patient->pin_no); ?>" required>
                                                <small class="text-danger"><?php echo e($errors->first('pin_no')); ?></small>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body border-top">
                                    <h6 class="font-weight-bold">Is Address And Local Address Same ?
                                        <input type="checkbox" id="checkboxforaddress" onchange="localAddress()" />
                                    </h6>
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Local Address</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="local_address">Local Address <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="local_address" value="<?php echo e(@$patient->local_address); ?>" name="local_address" placeholder="Enter Local Address">
                                                <small class="text-danger"><?php echo e($errors->first('local_address')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="country_local">Country <span class="text-danger">*</span></label>
                                                <select name="country_local" class="form-control select2-show-search" id="country_local" onchange="getLocalCountry(this.value,<?php echo e($patient->state); ?> , <?php echo e($patient->district); ?>)" onchange="showDetails(this.value)">
                                                    <option value="">Select Country... </option>
                                                    <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $patient->country_local ? 'selected' : " "); ?>><?php echo e($item->country_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <small class="text-danger"><?php echo e($errors->first('country_local')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="state_local">State <span class="text-danger">*</span></label>
                                                <select name="state_local" class="form-control select2-show-search" id="state_local" onchange="getLocalDistricts(this.value,<?php echo e($patient->district); ?>)">
                                                    <option value="">Select State...</option>
                                                </select>
                                                <small class="text-danger"><?php echo e($errors->first('state_local')); ?></small>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="district_local">District <span class="text-danger">*</span></label>
                                                <select name="district_local" class="form-control select2-show-search" id="district_local">
                                                    <option value="">Select District...</option>
                                                </select>
                                                <small class="text-danger"><?php echo e($errors->first('district_local')); ?></small>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="local_pin_no">Pin No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="local_pin_no" name="local_pin_no" value="<?php echo e($patient->local_pin_no); ?>">
                                                <small class="text-danger"><?php echo e($errors->first('local_pin_no')); ?></small>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body border-top">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Other Details</h5>
                                    <div class="main-profile-contact-list ">
                                        <!-- <div class="row"> -->
                                        <div class="form-group col-md-12 " id="indentification">
                                            <div class="form-group col-md-5 d-inline-block">
                                                <label for="identification_name"> Identification Name </label>
                                                <select name="identification_name" class="form-control select2-show-search" id="identification_name">
                                                    <option value="">Select One...</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-5 d-inline-block">
                                                <label for="identification_number"> National Identification Number </label>
                                                <input type="text" class="form-control" value="<?php echo e($patient->identification_number); ?>" id="identification_number" name="identification_number" placeholder="Enter National Identification Number">
                                                <small class="text-danger"><?php echo e($errors->first('identification_number')); ?></small>
                                            </div>
                                        </div>

                                        <!-- </div> -->
                                    </div>
                                </div>


                                <div class="card-body border-top">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Select Type</h5>
                                    <div class="main-profile-contact-list ">
                                        <div class="form-group col-md-6">
                                            <label for="type"> <SPAN style="color:blue;font-weight: 600;">TYPE</SPAN> </label>
                                            <select name="type" class="form-control select2-show-search" id="type">
                                                <option value="" <?php if(isset($type)): ?> <?php echo e($type == '' ? 'selected' : ''); ?> <?php endif; ?>>Select One.....</option>
                                                <option value="opd" <?php if(isset($type)): ?> <?php echo e($type == 'opd' ? 'selected' : ''); ?> <?php endif; ?>>OPD Registation</option>
                                                <option value="emg" <?php if(isset($type)): ?> <?php echo e($type == 'emg' ? 'selected' : ''); ?> <?php endif; ?>>EMG Registation</option>
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
<script>
    function getCountry(country_id, state_id, district_id) {
        $('#state').val('');
        $("#state").html("<option value='l'>Select... </option>");
        $.ajax({
            url: "<?php echo e(route('find-state-by-country')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
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
        $("#district").html("<option value='l'>Select District... </option>");
        var ijij = $('#state').val();
        $.ajax({
            url: "<?php echo e(route('find-fr-district-by-state')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
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
    function getage(dob_) {
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
                url: "<?php echo e(route('find-state-by-country')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
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
    function getLocalCountry(local_country_id, local_state_id, local_district_id) {
        $('#state_local').val('');
        $("#state_local").html("<option value='l'>Select... </option>");
        $.ajax({
            url: "<?php echo e(route('find-local-state-by-country')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
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
    }
</script>

<script>
    function getLocalDistricts(state_local, district_local) {
        var div_data = '';
        $('#district_local').val('');
        $("#district_local").html("<option value='l'>Select District... </option>");
        var ijij = $('#state_local').val();
        $.ajax({
            url: "<?php echo e(route('find-local-district-by-state')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
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

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/patient/edit-patient.blade.php ENDPATH**/ ?>