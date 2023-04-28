<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add charges')): ?>
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Charges</h4>
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
                    <form method="POST" action="<?php echo e(route('save-charges-details')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12">
                            <div class="row">
                             <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">Type <span
                                            class="text-danger">*</span></label>
                                        <select id="type" class="form-control" name="type">
                                            <option value=" ">Select type </option>
                                            <?php $__currentLoopData = Config::get('static.charges_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $charges_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($charges_type); ?>"> <?php echo e($charges_type); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['type'];
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="charges_catagory_id">Charges Catagory <span
                                            class="text-danger">*</span></label>
                                        <select id="charges_catagory_id" class="form-control" name="charges_catagory_id">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group ">
                                        
                                            <input type="text" value="<?php echo e(old('charges_name')); ?>"id="charges_name" name="charges_name">
                                            <label for="charges_name">Enter Charges Name <span class="text-danger">*</span></label>
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
                                    <div class="form-group">
                                        
                                            <input type="text" value="<?php echo e(old('standard_charges')); ?>"id="standard_charges" name="standard_charges">
                                            <label for="standard_charges">Enter Charges Name <span class="text-danger">*</span></label>
                                        <?php $__errorArgs = ['standard_charges'];
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
                                <div class="col-md-4 addchargedesign">
                                    <div class="form-group ">
                                        
                                        <input type="text" value=" <?php echo e(old('description')); ?> "id="sdescription" name="description">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
                                    </div>
                                </div>
                            </div>
                            <hr>

                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-0">Add Charges</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/charges/add-charges.blade.php ENDPATH**/ ?>