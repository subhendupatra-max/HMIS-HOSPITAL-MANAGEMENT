
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Operation Booking</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    

                    
                    <?php if(isset($patient_details_information)): ?>
                    
                    <?php $__errorArgs = ['patientId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <form method="post" action="<?php echo e(route('update-operation-booking-details')); ?>">
                        <?php echo csrf_field(); ?>

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
                                <input type="hidden" name="operation_booking_id" value="<?php echo e(@$operation_booking->id); ?>" />
                                <input type="hidden" name="operation_theater_id" value="<?php echo e(@$operation_theathers->id); ?>" />

                                <input type="hidden" name="patient_id" value="<?php echo e(@$operation_theathers->id); ?>" />
                                <input type="hidden" name="case_id" value="<?php echo e(@$operation_theathers->id); ?>" />

                                <input type="hidden" name="section" value="<?php echo e(@$operation_theathers->section); ?>" />
                                <input type="hidden" name="opd_id" value="<?php echo e(@$operation_theathers->opd_id); ?>" />


                                <input type="hidden" name="ipd_id" value="<?php echo e(@$operation_theathers->ipd_id); ?>" />


                                <input type="hidden" name="emg_id" value="<?php echo e(@$operation_theathers->emg_id); ?>" />





                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Operation Date From<span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="operation_date_from" value="<?php echo e(old('operation_date_from')); ?>" <?php if(isset($operation_booking->operation_date_from)): ?> value="<?php echo e(date('Y-m-d H:i', strtotime($operation_booking->operation_date_from))); ?>" <?php endif; ?> required />

                                    <?php $__errorArgs = ['operation_date_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Operation Date To<span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="operation_date_to" value="<?php echo e(old('operation_date_to')); ?>" <?php if(isset($operation_booking->operation_date_to)): ?> value="<?php echo e(date('Y-m-d H:i', strtotime($operation_booking->operation_date_to))); ?>" <?php endif; ?> required />

                                    <?php $__errorArgs = ['operation_date_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_department">Operation Department <span class="text-danger">*</span></label>
                                    <select name="operation_department" class="form-control select2-show-search" id="operation_department" onchange="getOperation(this.value,<?php echo e($operation_theathers->operation_category_id); ?>)">
                                        <option value="">Operation Department</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_theathers->operation_department ? 'selected' : ' '); ?>><?php echo e($item->department_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['operation_department'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_category_id">Operation Catagory <span class="text-danger">*</span></label>
                                    <select name="operation_category_id" class="form-control select2-show-search" id="operation_category_id" onchange="getOperationCatagory(<?php echo e($operation_theathers->operation_category_id); ?>,<?php echo e($operation_theathers->operation_id); ?>)">
                                        <option value="">Operation Catagory</option>

                                    </select>
                                    <?php $__errorArgs = ['operation_category_id'];
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


                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_id">Operation Name <span class="text-danger">*</span></label>
                                    <select name="operation_id" class="form-control select2-show-search" id="operation_id">
                                        <option value="">Select Operation Name</option>

                                    </select>
                                    <?php $__errorArgs = ['operation_id'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_type">Operation Type <span class="text-danger">*</span></label>
                                    <select name="operation_type" class="form-control select2-show-search" id="operation_type">
                                        <option value="">Operation Type</option>
                                        <?php $__currentLoopData = $operation_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_theathers->operation_type ? 'selected' : ' '); ?>><?php echo e($item->operation_type_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['operation_type'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="consultant_doctor">Consultant Doctor <span class="text-danger">*</span></label>
                                    <select name="consultant_doctor" class="form-control select2-show-search" id="consultant_doctor">
                                        <option value="">Consultant Doctor</option>
                                        <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_booking->consultant_doctor ? 'selected' : ' '); ?>><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['consultant_doctor'];
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
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ass_consultant_1">Nurse 1<span class="text-danger">*</span></label>
                                    <select name="ass_consultant_1" class="form-control select2-show-search" id="ass_consultant_1">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $nurse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_booking->ass_consultant_1 ? 'selected' : ' '); ?>><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['ass_consultant_1'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ass_consultant_2">Nurse 2 <span class="text-danger">*</span></label>
                                    <select name="ass_consultant_2" class="form-control select2-show-search" id="ass_consultant_2">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $nurse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_booking->ass_consultant_2 ? 'selected' : ' '); ?>><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['ass_consultant_2'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="anesthetist">Anesthetist <span class="text-danger">*</span></label>
                                    <select name="anesthetist" class="form-control select2-show-search" id="anesthetist">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_booking->anesthetist ? 'selected' : ' '); ?>><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['anesthetist'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="anaethesia_type">Anaethesia Type <span class="text-danger">*</span></label>
                                    <input type="text" name="anaethesia_type" value="<?php echo e($operation_booking->anaethesia_type); ?>" />
                                    <?php $__errorArgs = ['anaethesia_type'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ot_technician">OT Technician <span class="text-danger">*</span></label>
                                    <select name="ot_technician" class="form-control select2-show-search" id="ot_technician">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_booking->ot_technician ? 'selected' : ' '); ?>><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['ot_technician'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ot_assistant">OT Assistant <span class="text-danger">*</span></label>
                                    <select name="ot_assistant" class="form-control select2-show-search" id="ot_assistant">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $operation_booking->ot_assistant ? 'selected' : ' '); ?>><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['ot_assistant'];
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

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2-show-search" id="status">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = Config::get('static.main_operation_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item); ?>" <?php echo e(@$item == $operation_booking->status ? 'selected' : ' '); ?>><?php echo e($item); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['status'];
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

                                <div class="form-group col-md-4 opd-condition">
                                    <input type="text" id="remark" name="remark" value="<?php echo e($operation_booking->remark); ?>">
                                    <label for="remark">Remarks </label>
                                </div>


                            </div>
                            <div class="btn-list ">
                                <button class="btn btn-primary btn-sm float-right ml-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Save</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function getOperation(department, catagory) {

        // alert(department);
        $('#operation_category_id').html('<option value="" >Select...</option>');

        $.ajax({
            url: "<?php echo e(route('find-operation-catagory-by-department')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                department_id: department,
            },
            success: function(response) {

                $.each(response.operation_catagory, function(key, value) {
                    let sel = (value.id == catagory ? 'selected' : '');
                    $('#operation_category_id').append(`<option value="${value.id}"  ${sel}>${value.operation_catagory_name	}</option>`);
                });

            },
            error: function(error) {
                console.log(error);
            }
        });


    }
</script>


<script>
    function getOperationCatagory(catagory, operation_name) {

        // alert(catagory);
        // alert(department);
        $('#operation_id').html('<option value="" >Select...</option>');

        $.ajax({
            url: "<?php echo e(route('find-operation-name-by-catagory')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                catagory_id: catagory,
            },
            success: function(response) {

                $.each(response.operation_name, function(key, values) {
                    let sel = (values.id == operation_name ? 'selected' : '');
                    $('#operation_id').append(`<option value="${values.id}"  ${sel}>${values.operation_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/main-operation/edit-operation-booking.blade.php ENDPATH**/ ?>