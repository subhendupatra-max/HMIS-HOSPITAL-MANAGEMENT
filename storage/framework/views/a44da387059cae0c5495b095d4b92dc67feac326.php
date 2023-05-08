
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Bed History
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body ">
            <form action="<?php echo e(route('save-bed-transfar-history')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <!-- <input type="hidden" name="ipd_id" value="<?php echo e($ipd_details->id); ?>" /> -->

                <input type="hidden" name="patient_id" value="<?php echo e($ipd_details->patient_id); ?>" />
                <input type="hidden" name="case_id" value="<?php echo e($ipd_details->case_id); ?>" />
                <input type="hidden" name="ipd_id" value="<?php echo e($ipd_details->id); ?>" />
                <input type="hidden" name="previous_bed_id" value="<?php echo e($ipd_details->bed_details->id); ?>" />
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="from_time" class="form-label"> Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="from_time" name="from_time" required>
                        <?php $__errorArgs = ['from_time'];
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

                    <div class="form-group  col-md-6">
                        <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                        <select name="department" class="form-control select2-show-search" id="department" onchange="getDoctor_ward(this.value,<?php echo $ipd_details->bed_ward_id ?>)">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->id); ?>"> <?php echo e($department->department_name); ?></option>
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

                    <div class="form-group  col-md-6">
                        <label for="ward" class="form-label"> Ward <span class="text-danger">*</span></label>
                        <select name="ward" onchange="getBed()" class="form-control select2-show-search" id="bed_ward">
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

                    <div class="form-group  col-md-6">
                        <label for="unit" class="form-label"> Unit <span class="text-danger">*</span></label>
                        <select name="unit" onchange="getBed()" class="form-control select2-show-search" id="unit">
                            <option value="">Select..</option>
                            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($unit->id); ?>"> <?php echo e($unit->bedUnit_name); ?></option>
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

                    <div class="form-group  col-md-6">
                        <label class="form-label"> Bed <span class="text-danger">*</span></label>
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

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Bed History</button>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
    function getDoctor_ward(department, ward) {
        // alert(department);
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
                $.each(response.ward, function(key, values) {
                    $('#bed_ward').append(`<option value="${values.id}"  >${values.ward_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });


    }

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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/ipd/bed-history/add-bed-history.blade.php ENDPATH**/ ?>