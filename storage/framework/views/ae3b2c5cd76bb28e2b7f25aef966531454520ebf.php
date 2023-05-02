
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Edit Medication
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
            <form action="<?php echo e(route('update-medicaiton-dose')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="ipd_id" value="<?php echo e($ipd_details->id); ?>" />
                <input type="hidden" name="id" value="<?php echo e($editMedicationDetails->id); ?>" />
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" required <?php if(isset($editMedicationDetails->date)): ?> value="<?php echo e(date('Y-m-d',strtotime($editMedicationDetails->date))); ?>" <?php endif; ?>>
                        <?php $__errorArgs = ['date'];
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

                    <div class="form-group col-md-6">
                        <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="time" name="time" required <?php if(isset($editMedicationDetails->time)): ?> value="<?php echo e(date('h:m:s',strtotime($editMedicationDetails->time))); ?>" <?php endif; ?>>
                        <?php $__errorArgs = ['time'];
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

                    <div class="form-group col-md-6">
                        <label for="medicine_catagory_id" class="form-label">Medicine Category <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" name="medicine_catagory_id" id="medicine_catagory_id" required onchange="getMedicineCatagory(this.value,<?php echo e($editMedicationDetails->medicine_name); ?>)">
                            <optgroup>
                                <option value=" ">Select Medicine Category</option>
                                <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $editMedicationDetails->medicine_catagory_id ? 'selected': " "); ?>><?php echo e($item->medicine_catagory_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        </select>
                        <?php $__errorArgs = ['medicine_catagory_id'];
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

                    <div class="form-group col-md-6">
                        <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                        <select name="medicine_name" id="medicine_name" class="form-control select2-show-search" onchange="getMedicineName(<?php echo e($editMedicationDetails->medicine_catagory_id); ?> , <?php echo e($editMedicationDetails->dosage); ?>)">
                            <option value="">Select Medicine Name</option>
                        </select>
                        <?php $__errorArgs = ['medicine_name'];
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

                    <div class="form-group col-md-6">
                        <label for="dosage" class="form-label">Dosage <span class="text-danger">*</span></label>
                        <select name="dosage" id="dosage" class="form-control select2-show-search">
                            <option value="">Select Dosage</option>
                        </select>
                        <?php $__errorArgs = ['dosage'];
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

                    <div class="form-group col-md-6">
                        <label for="remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                        <textarea name="remarks" id="remarks" class="form-control" rowsapan="1"> <?php echo e($editMedicationDetails->remarks); ?></textarea>
                        <?php $__errorArgs = ['remarks'];
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
                    <button type="submit" class="btn btn-primary">Save Medication</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- <script>
    $(document).ready(function() {
        $("#medicine_catagory_id").change(function(event) {
            event.preventDefault();
            let medicine_catagory_id = $(this).val();

            $("#dosage").html('<option value=" ">Select Dose...</option>');
            $.ajax({
                url: "<?php echo e(route('find-dosage-by-medicine-catagory')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    medicine_catagory_id_for_dose: medicine_catagory_id,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#dosage').append(`<option value="${value.id}">${value.dose}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script> -->

<script>
    function getMedicineCatagory(medicineCatagoryId, medicineName) {
        // alert(medicineCatagoryId);
        $('#medicine_name').val('');
        $("#medicine_name").html("<option value=''>Select... </option>");
        $.ajax({
            url: "<?php echo e(route('find-medicine-name-by-medicine-catagory')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                medicine_catagory_id: medicineCatagoryId,
            },

            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == medicineName ? 'selected' : '');
                    $('#medicine_name').append(`<option value="${value.id}" ${sel}>${value.medicine_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function getMedicineName(medicineCatagory, dosage) {
        // $('#dosage').val('');
        // alert(medicineCatagory);
        $("#dosage").html("<option value=''>Select... </option>");
        $.ajax({
            url: "<?php echo e(route('find-dosage-by-medicine-catagory')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                medicine_catagory_id_for_dose: medicineCatagory,
            },

            success: function(response) {
                $.each(response, function(key, values) {
                    let sel = (values.id == dosage ? 'selected' : '');
                    $('#dosage').append(`<option value="${values.id}" ${sel}>${values.dose}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/edit-medication-dose.blade.php ENDPATH**/ ?>