
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Payment</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('save-payment-in-opd')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" name="opd_id" value="<?php echo e($opd_id); ?>" />
                    <div class="form-group col-md-6">
                        <label for="payment_date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required>
                        <?php $__errorArgs = ['payment_date'];
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
                        <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="amount" name="amount" value="<?php echo e(old('amount')); ?>">
                        <?php $__errorArgs = ['amount'];
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
                        <label for="payment_mode" class="form-label">Payment Mode </label>
                        <select id="payment_mode" class="form-control" name="payment_mode">
                            <option value="">Select Payment Mode... </option>
                            <?php $__currentLoopData = Config::get('static.payment_mode_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"> <?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="note" class="form-label">Note </label>
                        <textarea name="note" id="note" class="form-control"> </textarea>
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
                    <button type="submit" class="btn btn-primary">Save Payment</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/OPD/payment/add-payment.blade.php ENDPATH**/ ?>