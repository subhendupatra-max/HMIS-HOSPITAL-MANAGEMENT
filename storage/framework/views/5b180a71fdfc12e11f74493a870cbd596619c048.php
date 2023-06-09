
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Emg Registation</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('add_new_patient')); ?>"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="options px-5 pt-5  border-bottom pb-3">

                        <form method="post" action="<?php echo e(route('emg-registation')); ?>">

                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select class="form-control  select2-show-search" name="patient_id">
                                        <option value="">Select One Patient</option>
                                        <?php if(isset($all_patient)): ?>
                                        <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$patient->id); ?>" <?php echo e(@$patient_details_information->id == $patient->id ? 'Selected' : ''); ?>> <?php echo e(@$patient->prefix); ?> <?php echo e(@$patient->first_name); ?> <?php echo e(@$patient->middle_name); ?> <?php echo e(@$patient->last_name); ?> ( <?php echo e(@$patient->id); ?> ) </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <?php if(isset($patient_details_information)): ?>
                    
                    <div class="options px-5  pb-3">
                        <div class="row">

                            <hr class="hr_line">

                            <div class="card-body text-center">
                          
                                <div class="pro-user">
                                    <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                        <?php echo e($patient_details_information->prefix); ?> <?php echo e($patient_details_information->first_name); ?>

                                        <?php echo e($patient_details_information->middle_name); ?> <?php echo e($patient_details_information->last_name); ?>

                                    </h4>
                                    <h6 class="pro-user-desc textlink">
                                        <?php echo e($patient_details_information->patient_prefix); ?><?php echo e($patient_details_information->id); ?>

                                    </h6>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                    <a href="<?php echo e(route('edit-patient-details-emg', base64_encode($patient_details_information->id))); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Patient Profile"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->gender); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5">
                                                <?php echo e(@$patient_details_information->year == '0'?'':$patient_details_information->year.'y'); ?>

                                                <?php echo e(@$patient_details_information->month == '0'?'':$patient_details_information->month.'m'); ?>

                                                <?php echo e(@$patient_details_information->day == '0'?'':$patient_details_information->day.'d'); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->guardian_name_realation); ?>

                                                <?php echo e(@$patient_details_information->guardian_name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->blood_group); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->phone); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php endif; ?>

                </div>

                <div class="col-lg-8 col-xl-8">
                    <div class="options px-5 pt-1 pb-3">
                    <div class="row">
                        <?php $__errorArgs = ['patient_id'];
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
                    <form method="post" action="<?php echo e(route('add-emg-registation')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                    
                                <input type="hidden" name="patient_id" value="<?php echo e(@$patient_details_information->id); ?>" />

                                <div class="form-group col-md-4 emgdesign">
                                     <label for="height" class="form-label">Appointment Date <span class="text-danger">*</span></label>

                                    <?php if(auth()->user()->can('appointment date')): ?>
                                    <input type="datetime-local" name="appointment_date" value="<?php echo e(old('appointment_date')); ?>" required />
                                    <?php else: ?>
                                    <input type="datetime-local"name="appointment_date" value="<?php echo e(old('appointment_date')); ?>" required />
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

                                <div class="form-group col-md-4 emgregischeck">
                                    <label for="medico_legal_case">Medico Legal Case <span class="text-danger">*</span></label>
                                    
                                     <input type="radio"name="medico_legal_case" value="yes"><span class="font-weight-bold;">Yes</span>
                                     <input type="radio"name="medico_legal_case" value="no"><span class="font-weight-bold;">No</span>
                                    <?php $__errorArgs = ['medico_legal_case'];
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

                                
                                    
                                    
                                <div class="form-group col-md-4 emgdesignselect">
                                     <label for="patient_type">Patient Type <span class="text-danger">*</span></label>
                                    <select name="patient_type" onchange="getDetailsAccordingType(this.value)" class="form-control select2-show-search" id="patient_type">
                                        <option value="">Select Patient Type... </option>
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
                                <div class="form-group  col-md-4  emgdesignselect" style="display: none" id="tpa_organizationcxvc">
                                     <label for="tpa_organization" >TPA Organization <span class="text-danger">*</span></label>
                                    <select name="tpa_organization" class="form-control select2-show-search" id="tpa_organization">
                                        <option value="">Select Tpa organization...</option>
                                        <?php $__currentLoopData = $tpa_management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tpaManagement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tpaManagement->id); ?>">
                                            <?php echo e($tpaManagement->TPA_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 emgdesignselect" id="frefesd" style="display: none">
                                    <label for="type_no" ><span id="lableName"></span><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="type_no" value="<?php echo e(old('type_no')); ?>" id="type_no" />
                                </div>
                                <div class="form-group col-md-4 emgdesignselect">
                                     <label for="reference" class="form-label">Reference</label>
                                    <select name="reference" class="form-control select2-show-search" id="reference">
                                        <option value="">Select Reference Name.....</option>
                                        <?php $__currentLoopData = $referer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($reference->id); ?>"> <?php echo e($reference->referral_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                <div class="form-group col-md-4 emgdesignselect">
                                    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                    <select name="department" class="form-control select2-show-search" id="department">
                                        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($departments->id); ?>">
                                            <?php echo e($departments->department_name); ?>

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

                                <div class="form-group col-md-4 emgdesignselect">
                                    <label for="cons_doctor" class="form-label">Consultant Doctor <span class="text-danger">*</span></label>
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
                                <div class="form-group col-md-4 emgdesignin ">
                                    <label class="form-label">Ticket Fees</label>
                                    <input type="text" name="ticket_fees" value="<?php echo e(@$ticket_fees->ticket_fees); ?>" class="form-control" />
                                </div>

                            </div>
                        </div>

                        <div class="options px-5">
                            <div class="container ">



                                <!-- <hr class="hr_line"> -->
                                <!-- <input type="checkbox" onchange="show_physical_condition()" id="isAgeSelected" /><span style="font-weight: 500;color:blue"> Are You Want to
                                    Share Patient's Physical Condition
                                    ?</span>
 -->

                                <!-- <div class="row" id="physical_condition" style="display: none">
                                    <div class="col-md-2 emgcondition">
                                        <label for="height" class="form-label">Height(cm)</label>
                                        <input type="text" class="form-control" id="height" name="height" value="<?php echo e(old('height')); ?>" />
                                    </div>
                                    <div class="col-md-2 emgcondition">
                                        <label for="weight" class="form-label">Weight(kg)</label>
                                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo e(old('weight')); ?>" />
                                    </div>
                                    <div class="col-md-2 emgcondition">
                                        <label for="bp" class="form-label">BP</label>
                                        <input type="text" class="form-control" id="bp" name="bp" value="<?php echo e(old('bp')); ?>" />
                                    </div>
                                    <div class="col-md-2 emgcondition">
                                        <label for="pulse" class="form-label">Pulse</label>
                                        <input type="text" class="form-control" id="pulse" name="pulse" value="<?php echo e(old('pulse')); ?>" />
                                    </div>
                                    <div class="col-md-2 emgcondition">
                                        <label for="temperature" class="form-label">Temperature</label>
                                        <input type="text" class="form-control" id="temperature" name="temperature" value="<?php echo e(old('temperature')); ?>" />
                                    </div>
                                    <div class="col-md-2 emgcondition">
                                        <label for="respiration" class="form-label">Respiration</label>
                                        <input type="text" class="form-control" id="respiration" name="respiration" value="<?php echo e(old('respiration')); ?>" />
                                    </div>
                                </div>

                                <hr class="hr_line">
                                <input type="checkbox" onchange="show_Symptoms()" id="show_Symptoms_button" /><span style="font-weight: 500;color:blue"> Are You Want to Share Patient's Symptoms
                                    ?</span>

                                <div class="row" id="show_Symptoms" style="display: none">
                                    <div class="col-md-3 emgdesignselect">
                                         <label for="symptoms_type" class="form-label">Symptoms Type</label>
                                        <select name="symptoms_type" class="form-control select2-show-search" id="symptoms_type">
                                            <option value="">Symptoms Type</option>
                                            <?php $__currentLoopData = $symptoms_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $symptoms_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($symptoms_type->id); ?>">
                                                <?php echo e($symptoms_type->symptoms_type_name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3 emgdesignselect ">
                                         <label for="symptoms_title" class="form-label">Symptoms Title</label>

                                        <select name="symptoms_title" id="symptoms_title" class="form-control select2-show-search">
                                            <option value="">Symptoms Title</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 emgdesignnin">
                                        
                                        <input type="text" id="symptoms_description"  name="symptoms_description"  required="">
                                        <label for="symptoms_description"> Symptoms
                                            Description<span class="text-danger">*</span> </label>
                                    </div>
                                </div> -->


                                <!-- <hr class="hr_line"> -->
                                <div class="row">
                                    <div class="col-md-6 emgregistext ">
                                        
                                        <input type="text" id="Note"  name="Note" >
                                        <label for="Note">Note </label>
                                    </div>
                                    <div class="col-md-6 emgregistext">
                                        
                                        <input type="text" id="any_known_allergies"  name="any_known_allergies" >
                                        <label for="Any Known Allergies">Any Known Allergies</label>
                                    </div>
                                </div>

                                <hr class="hr_line">
                                <input type="checkbox" id="opd_belling" name="emg_billing_from_emg" value="emg_billing_from_emg" />
                                <span style="font-weight: 500;color:blue"> Are You Want To Create <b> Billing</b> now
                                    ?</span>

                            </div>
                        </div>
                        <div class="btn-list p-3">
                            <button class="btn btn-primary btn-sm float-right ml-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Save</button>

                            <button class="btn btn-primary btn-sm float-right" type="submit" name="save" value="save_and_print"><i class="fa fa-file"></i> Save & Print</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function takeTicketFees() {
        if (document.getElementById('show_taketicketFees').checked) {
            $('#taketicketFees').removeAttr('style', true);
        } else {
            $('#taketicketFees').attr('style', 'display:none', true);
        }
    }

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
            $('#frefesd').removeAttr('style', true);
            $('#lableName').text('TPA ID');
            $('#tpa_organizationcxvc').removeAttr('style', true);
        } else if (val == 'Swasthya Sathi') {
            
            $('#frefesd').attr('style', 'display:none', true);
            $('#tpa_organizationcxvc').attr('style', 'display:none', true);
            $('#lableName').text('Swasthya Sathi ID');
        } else {
            $('#frefesd').attr('style', 'display:none', true);
            $('#tpa_organizationcxvc').attr('style', 'display:none', true);
            
        }
    }
    
</script>
<script>
    $(document).ready(function() {
        $("#department").change(function(event) {
            event.preventDefault();
            let department = $(this).val();
            $('#cons_doctor').html('<option vaule="" >Select...</option>');
            $.ajax({
                url: "<?php echo e(route('find-doctor-by-department')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    department_id: department,
                },
                success: function(response) {
                    $.each(response.cons_doctor, function(key, value) {
                        $('#cons_doctor').append(
                            `<option value="${value.id}">${value.first_name} ${value.last_name}</option>`
                        );
                    });
                    $.each(response.opd_units, function(key, value) {
                        $('#unit').append(
                            `<option value="${value.unit_name}">${value.unit_name}</option>`
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
</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/emg/emg-registration.blade.php ENDPATH**/ ?>