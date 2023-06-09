

<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add opd setup')): ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">OPD Set-up</h4>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-opd-setup-details')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" value="1" name="id">
                    <div class="col-md-6 form-group">
                        <label for="ticket_no_calculate" class=""> Ticket No Calculate <span class="text-danger">*</span></label>
                        <select name="ticket_no_calculate" class="form-control select2-show-search" id="ticket_no_calculate">
                            <option value="">Select</option>
                            <?php $__currentLoopData = Config::get('static.opd_setup'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $setup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($setup); ?>" <?php echo e($setup == $opdSetup->ticket_no_calculate ? 'selected' : ' '); ?>>
                                <?php echo e($setup); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['ticket_no_calculate'];
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
                    <div class="col-md-6 form-group opdsetupdesign">
                        <label for="ticket_fees" class="form-label">Ticket Fees<span class="text-danger">*</span></label>
                        <input name="ticket_fees" value="<?php echo e($opdSetup->ticket_fees); ?>" type="text" class="form-control" />
                        <?php $__errorArgs = ['ticket_fees'];
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
                    <div class="col-md-6 form-group opdsetupdesign">
                        <label for="registration_type" class=""> Registation Type <span class="text-danger">*</span></label>
                        <select name="registration_type" class="form-control select2-show-search" id="registration_type">
                            <option value="">Select</option>
                            <?php $__currentLoopData = Config::get('static.registration_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" <?php echo e($type == $opdSetup->registration_type ? 'selected' : ' '); ?>>
                                <?php echo e($type); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>


                        <?php $__errorArgs = ['registration_type'];
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
                <button type="submit" class="btn btn-primary btn-sm mt-4 mb-0">Update OPD Setup</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/opd/opd-setup/opd-setup-listing.blade.php ENDPATH**/ ?>