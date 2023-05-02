

<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Emg setUp')): ?>
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting</h4>
                </div>
                <?php if(session('success')): ?>
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session()->has('error')): ?>
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
                <?php endif; ?>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('save-emg-setup-details')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="">
                            <input type="hidden" value="<?php echo e($setup_details->id); ?>" name="id">

                            <div class="col-md-4 form-group">
                                <label for="ticket_fees" class="form-label">Ticket Fees<span
                                        class="text-danger">*</span></label>
                                <input name="ticket_fees" type="text" class="form-control" value="<?php echo e(@$setup_details->ticket_fees); ?>" />
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

                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-0">Add Setup</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/emg/emg-setup.blade.php ENDPATH**/ ?>