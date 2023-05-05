

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine rack')): ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Medicine Stock</h4>
        </div>
        <div class="card-header">
            <h4 class="card-title">Update Medicine Stock</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-medicine-rack-details')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name">Store Room</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="<?php echo e(old('medicine_rack_name')); ?>">
                               
                                <?php $__errorArgs = ['medicine_rack_name'];
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
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name"> Batch No.</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="<?php echo e(old('medicine_rack_name')); ?>">
                               
                                <?php $__errorArgs = ['medicine_rack_name'];
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
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name"> Expiry Date</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="<?php echo e(old('medicine_rack_name')); ?>">
                               
                                <?php $__errorArgs = ['medicine_rack_name'];
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
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name"> Quantity</label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="<?php echo e(old('medicine_rack_name')); ?>">
                               
                                <?php $__errorArgs = ['medicine_rack_name'];
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
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name">Unit </label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="<?php echo e(old('medicine_rack_name')); ?>">
                               
                                <?php $__errorArgs = ['medicine_rack_name'];
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
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="medicine_rack_name">MRP </label>
                                <input type="text" id="medicine_rack_name" name="medicine_rack_name"
                                    value="<?php echo e(old('medicine_rack_name')); ?>">
                               
                                <?php $__errorArgs = ['medicine_rack_name'];
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
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="sale_price">Sale Price </label>
                                <input type="text" id="sale_price" name="sale_price"
                                    value="<?php echo e(old('sale_price')); ?>">
                               
                                <?php $__errorArgs = ['sale_price'];
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
                            <div class="col-md-4 form-group">
                                <label class="medicinerackinput" for="purchase_price">Purchase Price </label>
                                <input type="text" id="purchase_price" name="purchase_price"
                                    value="<?php echo e(old('purchase_price')); ?>">
                               
                                <?php $__errorArgs = ['purchase_price'];
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
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Medicine Rack</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/update-stock.blade.php ENDPATH**/ ?>