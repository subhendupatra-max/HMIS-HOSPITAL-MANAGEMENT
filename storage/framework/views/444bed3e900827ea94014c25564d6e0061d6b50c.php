
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
     
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <form method="post" action="<?php echo e(route('create-roster')); ?>">
                <?php echo csrf_field(); ?>
                <div class="options px-5 pt-1  border-bottom pb-3">
                    <div class="row">
                        <div class="form-group col-md-4 newaddappon">
                            <label for="work_station_id">Choose Work Station <span class="text-danger">*</span></label>
                            <select name="work_station_id" class=" select2-show-search" id="work_station_id"
                                required>
                                <option value="">Select your work station.......</option>
                                <?php $__currentLoopData = $work_station; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"> <?php echo e($value->work_station_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['work_station_id'];
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
                        <div class="form-group col-md-4 newaddappon" style="margin: 39px 0px 0px 0px;">
                            <label class="date-format">From Date <span class="text-danger">*</span></label>
                            <input type="date"  name="from_date" value="<?php echo e(date('Y-m-d')); ?>" required />
                            <?php $__errorArgs = ['from_date'];
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
                        <div class="form-group col-md-4 newaddappon" style="margin: 39px 0px 0px 0px;">
                            <label class="date-format">To Date <span class="text-danger">*</span></label>
                            <input type="date" name="to_date" value="<?php echo e(date('Y-m-d')); ?>" required />
                            <?php $__errorArgs = ['to_date'];
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
                        <div class="form-group col-md-12 opd-bladedesign text-center">
                            <button class="btn btn-primary btn-sm text-center ml-2" type="submit" name="save"
                                value="save"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/roster/choose_work_station.blade.php ENDPATH**/ ?>