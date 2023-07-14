
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Work Details </h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('update-new-work')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="work_id" value="<?php echo e(@$house_keeping_work->id); ?>" />
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" id="work_details" value="<?php echo e(@$house_keeping_work->working_details); ?>" name="work_details" required="" style="
                        margin: -3px 0px 0px 0px;">
                        <label for="work_details"> Work Details<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['work_details'];
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
                    <div class="form-group col-md-3">
                        <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" value="<?php echo e(date('Y-m-d H:i',strtotime($house_keeping_work->date))); ?>" id="date" name="date" style="
                        margin: 0px 0px 0px 0px;">
                        <?php $__errorArgs = ['date'];
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
                    <div class="form-group col-md-3">
                        <label for="assign_house_keeper" class="form-label">Assign house keeper<span class="text-danger">*</span></label>
                        <select  class="form-control multi-select select2-show-search" multiple="multiple" name="assign_house_keeper[]">
                            <option value="">Select House keeper.....</option>
                            <?php if(@$assign_keeper): ?>
                                <?php $__currentLoopData = $assign_keeper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"
                                        <?php $__currentLoopData = $house_keeping_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($u_value->user_id == $value->id): ?>
                                            selected
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        ><?php echo e($value->first_name); ?> <?php echo e($value->last_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['assign_house_keeper'];
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
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Update </button>
                </div>
        </div>
        </form>
    </div>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/house-keeping/edit-new-work.blade.php ENDPATH**/ ?>