
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Job Card</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="<?php echo e(route('addJobAction')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Workshop Name<span class="required">
                                            *</span></label>
                                    <select class="form-control select2-show-search" name="workshop_name" data-placeholder="Choose one">
                                            <option value="">---Select---</option>
                                            <?php if(isset($workshop)): ?>
                                            <?php $__currentLoopData = $workshop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                    </select>
                                    <?php $__errorArgs = ['workshop_name'];
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
                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="form-label">Date<span class="required"> *</span></label>
                                <div class="input-group">
                                    <input type="datetime-local" class="form-control" name="job_date" >
                                </div>
                                <?php $__errorArgs = ['job_date'];
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Vehicle Registration No.<span class="required">
                                            *</span></label>
                                    <select class="form-control select2-show-search" name="vehicle_reg_no" data-placeholder="Choose one">
                                            <option value="">---Select---</option>
                                            <?php if(isset($vehicle_reg_no)): ?>
                                            <?php $__currentLoopData = $vehicle_reg_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->registration_no); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                    </select>
                                    <?php $__errorArgs = ['vehicle_reg_no'];
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
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="form-label">Reference No.<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="reference_no" name="reference_no" placeholder="Enter Reference No.">
                                    </div>
                                    <?php $__errorArgs = ['reference_no'];
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
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="form-label">Driver Name<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Enter Driver Name">
                                    </div>
                                    <?php $__errorArgs = ['driver_name'];
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
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Mechnaic & Helper Name<span class="required">
                                            *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="mechanic_helper_name" name="mechanic_helper_name" placeholder="Enter Mechnaic & Helper Name">
                                    </div>
                                    <?php $__errorArgs = ['reference_no'];
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

                            <div class="col-12">
                                <table class="table table-bordered" id="dynamicTable">
                                    <tr>
                                        <th>Description of Work</th>
                                        <th><button type="button" onclick="adddesc()" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </table>
                            </div>

                            <div class="text-right mt-3 ml-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<script>
    var i = 1;

    function adddesc() {

        var html = '<tr id="row' + i + '"><td><textarea name="description[]" id="description" class="form-control"></textarea></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-remove"></i></button></td></tr>';

        console.log(html);
        $('#dynamicTable').append(html);
        i = i + 1;

    }

    function remove(i) {
        $('#row' + i).remove();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/job/add-job.blade.php ENDPATH**/ ?>