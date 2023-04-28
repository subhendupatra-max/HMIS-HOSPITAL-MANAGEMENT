
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Donor Details</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('save-blood-donor')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="donor_name" class="form-label">Donor Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="donor_name" value="<?php echo e(old('donor_name')); ?>" name="donor_name" placeholder="Enter Donor Name">
                        <small class="text-danger"><?php echo e($errors->first('donor_name')); ?></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="date_of_birth" class="form-label">Date Of Birth<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        <?php $__errorArgs = ['date_of_birth'];
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

                    <div class="form-group col-md-4">
                        <label for="blood_group" class="form-label"> Blood Group <span class="text-danger">*</span></label>
                        <select id="blood_group" class="form-control" name="blood_group">
                            <option value="">Select</option>
                            <?php $__currentLoopData = Config::get('static.blood_groups'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"> <?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['blood_group'];
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

                    <div class="form-group col-md-4">
                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                        <select id="gender" class="form-control" name="gender">
                            <option value="">Select</option>
                            <?php $__currentLoopData = Config::get('static.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $genders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($genders); ?>"> <?php echo e($genders); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['gender'];
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

                    <div class="form-group col-md-4">
                        <label for="father_name" class="form-label">Father Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="father_name" value="<?php echo e(old('father_name')); ?>" name="father_name" placeholder="Enter Father Name">
                        <small class="text-danger"><?php echo e($errors->first('father_name')); ?></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="ph_no" class="form-label">Contact No</label>
                        <input type="text" class="form-control" id="ph_no" value="<?php echo e(old('ph_no')); ?>" name="ph_no" placeholder="Enter Contact No">
                        <small class="text-danger"><?php echo e($errors->first('ph_no')); ?></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" class="form-control"></textarea>
                        <small class="text-danger"><?php echo e($errors->first('address')); ?></small>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Blood Donor</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/Blood_bank/blood-donor/add-blood-donor.blade.php ENDPATH**/ ?>