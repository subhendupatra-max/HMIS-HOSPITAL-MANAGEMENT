

<?php $__env->startSection('content'); ?>


<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-header">
            <h4 class="card-title">Edit Vendor</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('update-Inventory-vendor')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group">
                        <label for="vendor_name" class="medicinelabel">Vendor Name</label>

                        <input type="text"  id="name" name="name" value="<?php echo e($data->vendor_name); ?>" required>

                        <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo e($data->id); ?>">
                        <?php $__errorArgs = ['vendor_name'];
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

                    <div class="row row-sm">
                        <div class="col-lg addvendoredit">
                            <label for="role">Vendor Email</label>
                            <input class=" mb-4" placeholder="Enter Vendor Email" id="email" name="email" type="text" value="<?php echo e($data->email); ?>">
                            <?php $__errorArgs = ['email'];
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
                        <div class="col-lg">
                            <label for="role" class="form-label">Vendor Phone no.</label>

                            <input class="form-control mb-4" placeholder="Enter Vendor Mobile No" id="vendor_ph_no" name="vendor_ph_no" type="text" value="<?php echo e($data->vendor_ph_no); ?>">
                            <?php $__errorArgs = ['vendor_ph_no'];
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
                        <div class="col-lg">
                            <label for="role" class="form-label">Pincode.</label>
                            <input class="form-control mb-4" placeholder="Vendor pincode" id="pin" name="pin" type="text" value="<?php echo e($data->pin); ?>">
                            <?php $__errorArgs = ['pin'];
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

                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="role" class="form-label">GSTIN</label>

                            <input class="form-control mb-4" placeholder="Input box" id="vendor_gst" name="vendor_gst" value="<?php echo e($data->vendor_gst); ?>" type="text">
                            <?php $__errorArgs = ['vendor_gst'];
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
                        <div class="col-lg">
                            <label for="role" class="form-label">Contact Person name</label>
                            <input class="form-control mb-4" placeholder="Input box" name="contact_name" type="text" value="<?php echo e($data->contact_name); ?>">
                            <?php $__errorArgs = ['contact_name'];
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

                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="vendor_address" class="form-label">Vendor Address</label>
                            <textarea class="form-control mb-4" placeholder="Enter Vendor Address" id="vendor_address" name="vendor_address" rows="3"><?php echo e($data->vendor_address); ?></textarea>

                        </div>
                        <?php $__errorArgs = ['vendor_address'];
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
                <button type="submit" class="btn btn-primary mt-4 mb-0">Edit Vendor</button>
            </form>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/Inventory/vendor/edit-vendor.blade.php ENDPATH**/ ?>