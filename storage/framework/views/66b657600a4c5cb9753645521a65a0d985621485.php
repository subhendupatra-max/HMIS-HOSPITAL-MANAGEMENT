
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Change Password</h4>
        </div>
<!-- ================== message============================== -->
        <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
<!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" method="POST" action="<?php echo e(route('save-change-password')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Old Password <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="<?php echo e(old('old_password')); ?>"  name="old_password" placeholder="Old Password">
                            <?php $__errorArgs = ['old_password'];
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
                        <div class="col-md-12">
                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="<?php echo e(old('new_password')); ?>"  name="new_password" placeholder="New Password">
                            <?php $__errorArgs = ['new_password'];
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
                        <div class="col-md-12">
                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="<?php echo e(old('confirm_password')); ?>" name="confirm_password" placeholder="Confirm Password">
                            <?php $__errorArgs = ['confirm_password'];
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
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Change Password</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/Users/change-password.blade.php ENDPATH**/ ?>