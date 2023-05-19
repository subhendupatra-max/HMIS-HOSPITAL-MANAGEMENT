
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">EMG</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <form method="post" action="<?php echo e(route('false-emg-registation')); ?>">
                <?php echo csrf_field(); ?>
                <div class="options px-5 pt-1  border-bottom pb-3">
                    <div class="row">

                        <div class="form-group col-md-6 newaddappon ">
                            <label class="date-format"> Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="<?php echo e(date('Y-m-d H:s')); ?>" required />
                            <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></sma>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group col-md-12 opd-bladedesign ">
                            <button class="btn btn-primary btn-sm text-center ml-2" type="submit" name="save" value="save"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/false/emg/index.blade.php ENDPATH**/ ?>