
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Edit Physical Condition
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

        <div class="card-body">
            <form action="<?php echo e(route('update-physical-condition-in-ipd')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo e($editIpdPhysicalDetails->id); ?>" />
                    <input type="hidden" name="ipd_id" value="<?php echo e($editIpdPhysicalDetails->ipd_id); ?>" />

                    <div class="form-group col-md-4">
                        <label for="height" class="form-label">Height(cm)</label>
                        <input type="text" class="form-control" id="height" name="height" value="<?php echo e($editIpdPhysicalDetails->height); ?>" />
                        <?php $__errorArgs = ['height'];
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
                        <label for="weight" class="form-label">Weight(kg)</label>
                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo e($editIpdPhysicalDetails->weight); ?>" />
                        <?php $__errorArgs = ['weight'];
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
                        <label for="bp" class="form-label">BP</label>
                        <input type="text" class="form-control" id="bp" name="bp" value="<?php echo e($editIpdPhysicalDetails->bp); ?>" />
                        <?php $__errorArgs = ['weight'];
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
                        <label for="pulse" class="form-label">Pulse</label>
                        <input type="text" class="form-control" id="pulse" name="pulse" value="<?php echo e($editIpdPhysicalDetails->pulse); ?>" />
                        <?php $__errorArgs = ['pulse'];
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
                        <label for="temperature" class="form-label">Temperature</label>
                        <input type="text" class="form-control" id="temperature" name="temperature" value="<?php echo e($editIpdPhysicalDetails->temperature); ?>" />
                        <?php $__errorArgs = ['pulse'];
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
                        <label for="respiration" class="form-label">Respiration</label>
                        <input type="text" class="form-control" id="respiration" name="respiration" value="<?php echo e($editIpdPhysicalDetails->respiration); ?>" />
                        <?php $__errorArgs = ['respiration'];
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
                    <button type="submit" class="btn btn-primary">Update Physical Condition</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/physical-condition/edit-physical-condition.blade.php ENDPATH**/ ?>