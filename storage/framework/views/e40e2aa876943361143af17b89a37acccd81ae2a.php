
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Ambulance</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('update-ambulance-details')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo e($ambulance->id); ?>">
                    <div class="form-group col-md-4">
                        <!-- <label for="vehicle_number" class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number"  value="<?php echo e($ambulance->vehicle_number); ?>"> -->
                        <input type="text" id="vehicle_number" name="vehicle_number"  value="<?php echo e($ambulance->vehicle_number); ?>"  required="">
                        <label for="vehicle_number">Vehicle Number<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['vehicle_number'];
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
                        <!-- <label for="vehicle_model" class="form-label">Vehicle Model <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model"  value="<?php echo e($ambulance->vehicle_model); ?>"> -->
                        <input type="text" id="vehicle_model" name="vehicle_model"  value="<?php echo e($ambulance->vehicle_model); ?>"required="">
                        <label for="vehicle_model">Vehicle Model <span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['vehicle_model'];
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
                        <!-- <label for="year_made" class="form-label">Year Made<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="year_made" name="year_made"  value="<?php echo e($ambulance->year_made); ?>"> -->
                        <input type="text" id="year_made" name="year_made"  value="<?php echo e($ambulance->year_made); ?>"required="">
                        <label for="year_made">Year Made <span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['year_made'];
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
                        <!-- <label for="driver_name" class="form-label">Driver Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name"  value="<?php echo e($ambulance->driver_name); ?>"> -->
                        <input type="text" id="driver_name" name="driver_name"  value="<?php echo e($ambulance->driver_name); ?>"required="">
                        <label for="driver_name">Driver Name<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['driver_name'];
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
                        <!-- <label for="driver_license" class="form-label">Driver License <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_license" name="driver_license"  value="<?php echo e($ambulance->driver_license); ?>"> -->
                        <input type="text" id="driver_licensee" name="driver_license" value="<?php echo e($ambulance->driver_license); ?>"required="">
                        <label for="driver_license">Driver License<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['driver_license'];
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
                        <!-- <label for="vehicle_type" class="form-label"> Vehicle Type <span class="text-danger">*</span></label> -->
                        <select id="vehicle_type" class="form-control" name="vehicle_type">
                            <option value=""> Vehicle Type </option>
                            <?php $__currentLoopData = Config::get('static.vehicle_type_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>" <?php echo e($item == $ambulance->vehicle_type ? 'selected' : " "); ?>> <?php echo e($item); ?></option> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['vehicle_type'];
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
                        <!-- <label for="note" class="form-label"> Note <span class="text-danger">*</span></label>
                        <textarea name="note" class="form-control"> <?php echo e($ambulance->note); ?> </textarea> -->
                        <input type="text" id="note" name="note"  <?php echo e($ambulance->note); ?> required="">
                        <label for="note">Note<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['note'];
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
                    <button type="submit" class="btn btn-primary">Edit Ambulance</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/ambulance/ambulance/edit-ambulance.blade.php ENDPATH**/ ?>