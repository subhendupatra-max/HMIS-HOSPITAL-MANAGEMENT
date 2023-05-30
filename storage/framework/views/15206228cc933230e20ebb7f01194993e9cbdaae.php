

<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add charges')): ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Charges</h4>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-charges-details')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group">
                                        <label for="charges_catagory_id">Charges Catagory <span
                                                class="text-danger">*</span></label>
                                        <select id="charges_catagory_id" class="form-control"
                                            name="charges_catagory_id">
                                            <option value=" ">Select Charges Catagory </option>
                                            <?php $__currentLoopData = $charges_catagory_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->charges_catagories_name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['charges_catagory_id'];
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
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group">
                                        <label for="charges_sub_catagory_id">Charges Sub Catagory <span
                                                class="text-danger">*</span></label>
                                        <select id="charges_sub_catagory_id" class="form-control"
                                            name="charges_sub_catagory_id">
                                            <option value=" ">Select Charges Sub Catagory </option>
                                            <?php $__currentLoopData = $charges_sub_catagory_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->charges_sub_catagories_name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['charges_sub_catagory_id'];
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
                                <div class="col-md-4 addchargedesignin">
                                    <div class="form-group ">
                                        <label for="standard_charges">Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="<?php echo e(old('date')); ?>">
                                        <small class="text-danger"><?php echo e($errors->first('date')); ?></small>
                                    </div>
                                </div>
                                <div class="col-md-8 addchargedesign">
                                    <div class="form-group ">
                                        
                                        <input type="text" value="<?php echo e(old('charges_name')); ?>" id="charges_name"
                                            name="charges_name">
                                        <label for="charges_name">Enter Charges Name <span
                                                class="text-danger">*</span></label>
                                        <?php $__errorArgs = ['charges_name'];
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
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group ">
                                        
                                        <input type="text" value=" <?php echo e(old('description')); ?> " id="sdescription"
                                            name="description">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <?php if($charges_type[0]->id != null): ?>
                                <?php $__currentLoopData = $charges_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input name="charge_type_id[]" type="hidden" value="<?php echo e(@$value->id); ?>" />
                                <div class="col-md-12 addchargedesign">
                                    <div class="form-group">
                                        <label for="charge_type">Charge for <?php echo e(@$value->charge_type_name); ?> Patient<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="charge_amount[]" />
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Charges</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/charges/add-charges.blade.php ENDPATH**/ ?>