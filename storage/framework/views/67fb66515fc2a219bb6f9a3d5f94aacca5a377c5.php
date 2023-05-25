
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit IPD Patient</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    

                    <div class="options px-5  pb-3">
                        <div class="row">
                            <hr class="hr_line">
                            <div class="card-body text-center">
                                <div class="pro-user">
                                    <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                        <?php echo e($visit_details->all_patient_details->prefix); ?>

                                        <?php echo e($visit_details->all_patient_details->first_name); ?>

                                        <?php echo e($visit_details->all_patient_details->middle_name); ?>

                                        <?php echo e($visit_details->all_patient_details->last_name); ?>

                                    </h4>
                                    <h6 class="pro-user-desc textlink">
                                        <?php echo e($visit_details->all_patient_details->patient_prefix); ?><?php echo e($visit_details->all_patient_details->id); ?>

                                    </h6>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e($visit_details->all_patient_details->gender); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5">
                                                <?php echo e(@$visit_details->all_patient_details->year ==
                                                '0'?'':$visit_details->all_patient_details->year.'y'); ?>

                                                <?php echo e(@$visit_details->all_patient_details->month ==
                                                '0'?'':$visit_details->all_patient_details->month.'m'); ?>

                                                <?php echo e(@$visit_details->all_patient_details->day ==
                                                '0'?'':$visit_details->all_patient_details->day.'d'); ?>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$visit_details->all_patient_details->guardian_name_realation); ?>

                                                <?php echo e(@$visit_details->all_patient_details->guardian_name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$visit_details->all_patient_details->blood_group); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$visit_details->all_patient_details->phone); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="<?php echo e(route('update-ipd-registation')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="ipd_details_id" value="<?php echo e($visit_details->id); ?>" />
                        <input type="hidden" name="patient_id" value="<?php echo e($visit_details->all_patient_details->id); ?>" />
                        <input type="hidden" name="patient_source_id" value="<?php echo e($visit_details->patient_source_id); ?>" />
                        <input type="hidden" name="patient_source" value="<?php echo e($visit_details->patient_source); ?>" />
                        <input type="hidden" name="case_id" value="<?php echo e($visit_details->case_id); ?>" />

                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <div class="form-group col-md-2 newaddappon">
                                    <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                                    <input type="date" required class="form-control" id="date_of_birth" name="date_of_birth" onchange="getagefromdate(this.value)" value="<?php echo e(date('Y-m-d',strtotime($visit_details->all_patient_details->date_of_birth))); ?>" />
                                    <small class="text-danger"><?php echo e($errors->first('date_of_birth')); ?></small>
                                </div>

                                <div class="form-group col-md-4 ">
                                    <div class="row">
                                        <div class="col-lg-4 newdesignadd">
                                            <input type="text" required onkeyup="getage()" id="date_of_birth_year" value="<?php echo e($visit_details->all_patient_details->year); ?>" name="date_of_birth_year">
                                            <label for="date_of_birth_year"> Year</label>
                                            <small class="text-danger"><?php echo e($errors->first('date_of_birth_year')); ?></small>
                                        </div>

                                        <div class="col-lg-4 newdesignadd">
                                            <input type="text" required onkeyup="getage()" id="date_of_birth_month" value="<?php echo e($visit_details->all_patient_details->month); ?>" name="date_of_birth_month">
                                            <label for="date_of_birth_month"> Month</label>
                                            <small class="text-danger"><?php echo e($errors->first('date_of_birth_month')); ?></small>

                                        </div>
                                        <div class="col-lg-4 newdesignadd">
                                            <input type="text" required onkeyup="getage()" id="date_of_birth_day" value="<?php echo e($visit_details->all_patient_details->day); ?>" name="date_of_birth_day">
                                            <label for="date_of_birth_day"> Day</label>
                                            <small class="text-danger"><?php echo e($errors->first('date_of_birth_day')); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 newdesignadd">
                                    <input type="text" required id="admitted_by" value="<?php echo e($visit_details->all_patient_details->local_guardian_name); ?>" name="admitted_by">
                                    <label for="admitted_by"> Admitted By</label>
                                    <small class="text-danger"><?php echo e($errors->first('admitted_by')); ?></small>
                                </div>
                                <div class="col-md-3 newdesignadd">
                                    <input type="text" required id="admitted_by_contact_no" value="<?php echo e($visit_details->all_patient_details->local_guardian_contact_no); ?>" name="admitted_by_contact_no">
                                    <label for="admitted_by_contact_no"> Admitted By Contact No.</label>
                                    <small class="text-danger"><?php echo e($errors->first('admitted_by_contact_no')); ?></small>
                                </div>

                            </div>
                        </div>
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="row">
                                <div class="col-md-4 ipd-registrationproaddd">
                                    <label for="height">Admission Date <span class="text-danger">*</span></label>
                                    <?php if(auth()->user()->can('appointment date')): ?>
                                    

                                    <input type="datetime-local" id="appointment_date" name="appointment_date" <?php if(isset($visit_details->appointment_date)): ?> value="<?php echo e(date('Y-m-d h:m:s', strtotime($visit_details->appointment_date))); ?>" <?php endif; ?> >
                                    <?php else: ?>
                                    <input type="datetime-local" id="appointment_date" name="appointment_date" <?php if(isset($visit_details->appointment_date)): ?> value="<?php echo e(date('Y-m-d h:m:s', strtotime($visit_details->appointment_date))); ?>" <?php endif; ?> >
                                    <?php endif; ?>

                                    <?php $__errorArgs = ['appointment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-4 ipd-registrationproaddin">

                                    <input type="text" value="<?php echo e(20000); ?>" id="credit_limit" name="credit_limit">
                                    <label for="credit_limit">Credit Limit <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="patient_type">Patient Type <span class="text-danger">*</span></label>
                                    <select name="patient_type" onchange="getDetailsAccordingType(this.value)" class="form-control select2-show-search" id="patient_type">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = Config::get('static.patient_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $patient_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($patient_type); ?>" <?php echo e($patient_type == $visit_details->patient_type ? 'selected' : " "); ?>> <?php echo e($patient_type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <?php $__errorArgs = ['patient_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>
                                <div class="col-md-4 frefesd ipd-registrationproadd" style="display:none">
                                    <label for="tpa_organization">TPA Organization <span class="text-danger">*</span></label>
                                    <select name="tpa_organization" class="form-control select2-show-search" id="tpa_organization">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $tpa_management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tpaManagement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tpaManagement->id); ?>" <?php echo e($tpaManagement->id == $visit_details->tpa_organization ? 'selected' : " "); ?>>
                                            <?php echo e($tpaManagement->TPA_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4 frefesds ipd-registrationproadd" style="display:none">
                                    <label for="type_no"><span id="lableName"></span><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="type_no" value="<?php echo e(old('type_no')); ?>" id="type_no" />
                                </div>
                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="reference">Reference</label>
                                    <select name="reference" class="form-control select2-show-search" id="reference">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $referer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($reference->id); ?>" <?php echo e($reference->id == $visit_details->refference ? 'selected' : " "); ?>> <?php echo e($reference->referral_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4 ipd-registrationproadd ">
                                    <label for="department">Department <span class="text-danger">*</span></label>
                                    <select name="department" class="form-control select2-show-search" id="department" onchange="getDoctor_ward(this.value,<?php echo e($visit_details->cons_doctor); ?>,<?php echo e($visit_details->bed_ward_id); ?>)">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php echo e($department->id == $visit_details->department_id ? 'selected' : " "); ?>>
                                            <?php echo e($department->department_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="cons_doctor"> Doctor <span class="text-danger">*</span></label>
                                    <select name="cons_doctor" class="form-control select2-show-search" id="cons_doctor">
                                        <option value="">Select..</option>
                                    </select>
                                    <?php $__errorArgs = ['cons_doctor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="ward"> Ward <span class="text-danger">*</span></label>
                                    <select name="ward" onchange="getBed(<?php echo e($visit_details->bed); ?>)" class="form-control select2-show-search" id="bed_ward">
                                        <option value="">Select..</option>
                                    </select>
                                    <?php $__errorArgs = ['ward'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-4 ipd-registrationproadd">
                                    <label for="unit"> Unit <span class="text-danger">*</span></label>
                                    <select name="unit" onchange="getBed(<?php echo e($visit_details->bed); ?>)" class="form-control select2-show-search" id="unit">
                                        <option value="">Select..</option>
                                        <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($unit->id); ?>" <?php echo e($unit->id == $visit_details->bed_unit_id ? 'selected' : " "); ?>> <?php echo e($unit->bedUnit_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <div class="col-md-4 ipd-registrationproadd">
                                    <label> Bed <span class="text-danger">*</span></label>
                                    <select name="bed" class="form-control select2-show-search" id="bed">
                                        <option value="">Select..</option>
                                    </select>
                                    <?php $__errorArgs = ['bed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ipd-registrationproaddd">
                                    <input type="text" id="note" name="note" value="<?php echo e($visit_details->note); ?>">
                                    <label for="note">Note</label>
                                </div>
                                <div class="col-md-6 ipd-registrationproaddd">
                                    <input type="text" id="any_known_allergies" name="any_known_allergies" value="<?php echo e($visit_details->known_allergies); ?>">
                                    <label for="any_known_allergies">Any Known Allergies</label>
                                </div>
                            </div>
                            <div class="mt-5 text-right">

                                <button name="save" value="save" class="btn btn-primary" type="submit"><i class="fa fa-file"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    function show_physical_condition() {
        if (document.getElementById('isAgeSelected').checked) {
            $('#physical_condition').removeAttr('style', true);
        } else {
            $('#physical_condition').attr('style', 'display:none', true);
        }
    }

    function show_Symptoms() {
        if (document.getElementById('show_Symptoms_button').checked) {
            $('#show_Symptoms').removeAttr('style', true);
        } else {
            $('#show_Symptoms').attr('style', 'display:none', true);
        }
    }

    function getDetailsAccordingType(val) {

        if (val == 'TPA') {
            $('.frefesd').removeAttr('style', true);
            $('.frefesds').removeAttr('style', true);
            $('#lableName').text('TPA ID');
            $('#type_no').attr('required', 'required', true);
            $('#tpa_organization').attr('required', 'required', true);
        } else if (val == 'Swasthya Sathi') {
            $('.frefesds').removeAttr('style', true);
            $('.frefesd').attr('style', 'display:none', true);
            $('#lableName').text('Swasthya Sathi ID');
            $('#type_no').attr('required', 'required', true);
        } else {
            $('.frefesd').attr('style', 'display:none', true);
            $('.frefesds').attr('style', 'display:none', true);
        }
    }
</script>

<script>
    function getDoctor_ward(department, doctor_id, bed_ward_id) {
        $('#cons_doctor').html('<option value="" >Select...</option>');
        $('#bed_ward').html('<option value="" >Select...</option>');
        $.ajax({
            url: "<?php echo e(route('find-doctor-and-ward-by-department-in-ipd')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                department_id: department,
            },
            success: function(response) {
                console.log(response);
                $.each(response.doctor, function(key, value) {
                    let sel = (value.id == doctor_id ? 'selected' : '');
                    $('#cons_doctor').append(
                        `<option value="${value.id}" ${sel}>${value.first_name} ${value.last_name }</option>`
                    );
                });
                $.each(response.ward, function(key, values) {
                    let sel = (values.id == bed_ward_id ? 'selected' : '');
                    $('#bed_ward').append(
                        `<option value="${values.id}" ${sel}>${values.ward_name}</option>`);
                });
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
    $(document).ready(function() {
        $("#symptoms_type").change(function(event) {
            event.preventDefault();
            let symptoms_type = $(this).val();
            $('#symptoms_title').html('<option value="" >Select...</option>');
            $.ajax({
                url: "<?php echo e(route('find-symptoms-title-by-symptoms-type')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    symptoms_type_id: symptoms_type,
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#symptoms_title').append(
                            `<option value="${value.symptoms_head_name	}">${value.symptoms_head_name }</option>`
                        );
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

    function getBed(bed) {
        var bedward = $('#bed_ward').val();
        var bedunit = $('#unit').val();
        $('#bed').empty();
        $('#bed').html(`<option value="">Select.....</option>`)
        $.ajax({
            url: "<?php echo e(route('find-bed-by-bed-ward')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                bed_ward: bedward,
                bed_unit: bedunit,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == bed ? 'selected' : '');
                    $('#bed').append(`<option value="${value.id	}" ${sel}>${value.bed_name }</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
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




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Ipd/edit-ipd-patient.blade.php ENDPATH**/ ?>