
<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('ipd-registation')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="patient_id" value="<?php echo e($visit_details->all_patient_details->id); ?>" />
        <input type="hidden" name="patient_source_id" value="<?php echo e($patient_source_id); ?>" />
        <input type="hidden" name="patient_source" value="<?php echo e($patient_source); ?>" />
        <input type="hidden" name="case_id" value="<?php echo e($visit_details->case_id); ?>" />

        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-12">
                            <span style=" color: #6f6f6f;font-size: 18px;font-weight: 500; margin-left: 45px;">IPD
                                REGISTATION</span>

                            <hr class="hr_line">
                            <div class="widget-user-image mx-auto mt-1"><img alt="User Avatar" class="rounded-circle"
                                    src="<?php echo e(asset('public/patient_image/patient_icon.png')); ?>"
                                    style="height: 100px;width: 117px;"></div>
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

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                        <a href="<?php echo e(route('edit-patient-details', base64_encode($visit_details->all_patient_details->id))); ?>"
                                            class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                            title="Edit Patient Profile"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-0">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-0"><?php echo e($visit_details->all_patient_details->gender); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-0">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-0"><?php echo e($visit_details->all_patient_details->year); ?>y
                                                <?php echo e($visit_details->all_patient_details->month); ?>m
                                                <?php echo e($visit_details->all_patient_details->day); ?>d

                                                <a href="#" class="btn btn-default btn-sm" data-target="#editAge"
                                                    data-toggle="modal"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-0">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-0">
                                                <?php echo e($visit_details->all_patient_details->guardian_name_realation); ?>

                                                <?php echo e($visit_details->all_patient_details->guardian_name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-0">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-0"><?php echo e($visit_details->all_patient_details->blood_group); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-0">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-0"><?php echo e($visit_details->all_patient_details->phone); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-9 col-lg-9 col-md-12 vl_line">
                            <div class="main-profile-body">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-4 ipd-registrationproaddd">
                                            <label for="height">Admission Date <span
                                                    class="text-danger">*</span></label>
                                            <?php if(auth()->user()->can('appointment date')): ?>
                                                
                                                    <input type="datetime-local"value="<?php echo e(old('appointment_date')); ?>" id="appointment_date" name="appointment_date">
                                            <?php else: ?>
                                                    <input type="datetime-local"value="<?php echo e(old('appointment_date')); ?>" id="appointment_date" name="appointment_date">
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
                                            
                                                <input type="text"  value="<?php echo e(20000); ?>"id="credit_limit" name="credit_limit">
                                                <label for="credit_limit">Credit Limit <span class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-4 ipd-registrationproadd">
                                            <label for="patient_type">Patient Type <span
                                                    class="text-danger">*</span></label>
                                            <select name="patient_type" onchange="getDetailsAccordingType(this.value)"
                                                class="form-control select2-show-search" id="patient_type">
                                                <option value="">Select</option>
                                                <?php $__currentLoopData = Config::get('static.patient_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $patient_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($patient_type); ?>"> <?php echo e($patient_type); ?></option>
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
                                            <label for="tpa_organization">TPA Organization <span
                                                    class="text-danger">*</span></label>
                                            <select name="tpa_organization" class="form-control select2-show-search"
                                                id="tpa_organization">
                                                <option value="">Select</option>
                                                <?php $__currentLoopData = $tpa_management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tpaManagement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($tpaManagement->id); ?>">
                                                        <?php echo e($tpaManagement->TPA_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 frefesds ipd-registrationproadd" style="display:none">
                                            <label for="type_no"><span id="lableName"></span><span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="type_no"
                                                value="<?php echo e(old('type_no')); ?>" id="type_no" />
                                        </div>
                                        <div class="col-md-4 ipd-registrationproadd">
                                            <label for="reference">Reference</label>
                                            <select name="reference" class="form-control select2-show-search"
                                                id="reference">
                                                <option value="">Select</option>
                                                <?php $__currentLoopData = $referer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($reference->id); ?>"> <?php echo e($reference->referral_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 ipd-registrationproadd ">
                                            <label for="department">Department <span
                                                    class="text-danger">*</span></label>
                                            <select name="department" class="form-control select2-show-search"
                                                id="department" onchange="getDoctor_ward(this.value)">
                                                <option value="">Select</option>
                                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($department->id); ?>">
                                                        <?php echo e($department->department_name); ?></option>
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
                                            <label for="cons_doctor"> Doctor <span
                                                    class="text-danger">*</span></label>
                                            <select name="cons_doctor" class="form-control select2-show-search"
                                                id="cons_doctor">
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
                                            <label for="ward"> Ward <span
                                                    class="text-danger">*</span></label>
                                            <select name="ward" onchange="getBed()"
                                                class="form-control select2-show-search" id="bed_ward">
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
                                            <label for="unit"> Unit <span
                                                    class="text-danger">*</span></label>
                                            <select name="unit" onchange="getBed()"
                                                class="form-control select2-show-search" id="unit">
                                                <option value="">Select..</option>
                                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($unit->id); ?>"> <?php echo e($unit->bedUnit_name); ?>

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
                                            <select name="bed" class="form-control select2-show-search"
                                                id="bed">
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


                                    <hr class="hr_line">
                                    <input type="checkbox" onchange="show_physical_condition()"
                                        id="isAgeSelected" /><span style="font-weight: 500;color:blue"> Are You Want to
                                        Share Patient's Physical Condition
                                        ?</span>

                                    <div class="row" id="physical_condition" style="display: none">
                                        <div class="col-md-2 ipd-condition">
                                            <label for="height" class="form-label">Height(cm)</label>
                                            <input type="text" class="form-control" id="height" name="height"
                                                value="<?php echo e(old('height')); ?>" />

                                        </div>
                                        <div class="col-md-2 ipd-condition">
                                            <label for="weight" class="form-label">Weight(kg)</label>
                                            <input type="text" class="form-control" id="weight" name="weight"
                                                value="<?php echo e(old('weight')); ?>" />
                                        </div>
                                        <div class="col-md-2 ipd-condition">
                                            <label for="bp" class="form-label">BP</label>
                                            <input type="text" class="form-control" id="bp" name="bp"
                                                value="<?php echo e(old('bp')); ?>" />
                                        </div>
                                        <div class="col-md-2 ipd-condition">
                                            <label for="pulse" class="form-label">Pulse</label>
                                            <input type="text" class="form-control" id="pulse" name="pulse"
                                                value="<?php echo e(old('pulse')); ?>" />
                                        </div>
                                        <div class="col-md-2 ipd-condition">
                                            <label for="temperature" class="form-label">Temperature</label>
                                            <input type="text" class="form-control" id="temperature"
                                                name="temperature" value="<?php echo e(old('temperature')); ?>" />
                                        </div>
                                        <div class="col-md-2 ipd-condition">
                                            <label for="respiration" class="form-label">Respiration</label>
                                            <input type="text" class="form-control" id="respiration"
                                                name="respiration" value="<?php echo e(old('respiration')); ?>" />
                                        </div>
                                    </div>

                                    <hr class="hr_line">
                                    <input type="checkbox" onchange="show_Symptoms()" id="show_Symptoms_button" /><span
                                        style="font-weight: 500;color:blue"> Are You Want to Share Patient's Symptoms
                                        ?</span>

                                    <div class="row" id="show_Symptoms" style="display: none">
                                        <div class="col-md-3 ipd-registrationpro">
                                            <label for="symptoms_type">Symptoms Type</label>
                                            <select name="symptoms_type" class="form-control select2-show-search"
                                                id="symptoms_type">
                                                <option value="">Select</option>
                                                <?php $__currentLoopData = $symptoms_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $symptoms_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($symptoms_type->id); ?>">
                                                        <?php echo e($symptoms_type->symptoms_type_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 ipd-registrationpro">
                                            <label for="symptoms_title">Symptoms Title</label>

                                            <select name="symptoms_title" id="symptoms_title"
                                                class="form-control select2-show-search">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 ipd-symtomsadd">
                                            
                                            <input type="text"id="symptoms_description" name="symptoms_description">
                                            <label for="symptoms_description">Symptoms Description</label>
                                        </div>
                                    </div>
                                    <hr class="hr_line">
                                    <div class="row">
                                        <div class="col-md-6 ipd-registrationproaddd">
                                            
                                            <input type="text"id="note" name="note">
                                            <label for="note">Note</label>
                                        </div>
                                        <div class="col-md-6 ipd-registrationproaddd">
                                            
                                            <input type="text"id="any_known_allergies" name="any_known_allergies">
                                            <label for="any_known_allergies">Any Known Allergies</label>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-right">
                                        <button name="save" value="save_and_print" class="btn btn-primary"
                                            type="submit"><i class="fa fa-print"></i> Save & Print</button>
                                        <button name="save" value="save" class="btn btn-primary" type="submit"><i
                                                class="fa fa-file"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="<?php echo e(route('patient-age-edit')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal" id="editAge">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Age</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="patient_id"
                                value="<?php echo e(@$visit_details->all_patient_details->id); ?>" />
                            <div class="form-group col-md-12">
                                <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    onchange="getage(this.value)"
                                    value="<?php echo e(@$visit_details->all_patient_details->date_of_birth); ?>">
                                <small class="text-danger"><?php echo e($errors->first('date_of_birth')); ?></small>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Age (yy-mm-dd) <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" id="date_of_birth_year"
                                            name="year" placeholder="Year"
                                            value="<?php echo e(@$visit_details->all_patient_details->year); ?>" required>
                                        <small class="text-danger"><?php echo e($errors->first('date_of_birth_year')); ?></small>
                                    </div>

                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" id="date_of_birth_month"
                                            name="month" placeholder="Month"
                                            value="<?php echo e(@$visit_details->all_patient_details->month); ?>" required>
                                        <small class="text-danger"><?php echo e($errors->first('date_of_birth_month')); ?></small>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control"
                                            value="<?php echo e(@$visit_details->all_patient_details->day); ?>"
                                            id="date_of_birth_day" name="day" placeholder="Day" required>
                                        <small class="text-danger"><?php echo e($errors->first('date_of_birth_day')); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-indigo" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
        function getDoctor_ward(department) {
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
                        $('#cons_doctor').append(
                            `<option value="${value.id}">${value.first_name} ${value.last_name }</option>`
                        );
                    });
                    $.each(response.ward, function(key, values) {
                        $('#bed_ward').append(
                            `<option value="${values.id}">${values.ward_name}</option>`);
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

        function getBed() {
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
                        $('#bed').append(`<option value="${value.id	}">${value.bed_name }</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/ipd-registration.blade.php ENDPATH**/ ?>