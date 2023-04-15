
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Vehicle</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="<?php echo e(route('vehicleAddAction')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label class="form-label">Vehicle Model<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" placeholder="Enter Vehicle Model">
                                    </div>
                                    <?php $__errorArgs = ['vehicle_model'];
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
                                <div class="input-group">
                                    <label class="form-label">Engine No<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="engine_no" name="engine_no" placeholder="Enter Engine No">
                                    </div>
                                    <?php $__errorArgs = ['engine_no'];
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
                                <div class="input-group">
                                    <label class="form-label">Date of Manufacture<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="date_of_manufacture" name="date_of_manufacture" placeholder="Enter Date of Manufacture">
                                    </div>
                                    <?php $__errorArgs = ['date_of_manufacture'];
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
                                <div class="input-group">
                                    <label class="form-label">Registration No<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="registration_no" name="registration_no" placeholder="Enter Registration No">
                                    </div>
                                    <?php $__errorArgs = ['registration_no'];
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
                                <div class="input-group">
                                    <label class="form-label">Chasis No<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="chasis_no" name="chasis_no" placeholder="Enter Chasis No">
                                    </div>
                                    <?php $__errorArgs = ['chasis_no'];
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
                                <div class="input-group">
                                    <label class="form-label">Purchase Date<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" placeholder="Enter Purchase Date">
                                    </div>
                                    <?php $__errorArgs = ['purchase_date'];
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
                                <div class="input-group">
                                    <label class="form-label">Registration Certificate Details<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="registration_certificate_details" name="registration_certificate_details">
                                    </div>
                                    <?php $__errorArgs = ['registration_certificate_details'];
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
                                <div class="input-group">
                                    <label class="form-label">Insurance Details<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="insurance_details" name="insurance_details">
                                    </div>
                                    <?php $__errorArgs = ['insurance_details'];
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
                                <div class="input-group">
                                    <label class="form-label">Insurance Date<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="insurance_date" name="insurance_date" placeholder="Enter Insurance Date">
                                    </div>
                                    <?php $__errorArgs = ['insurance_date'];
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
                                <div class="input-group">
                                    <label class="form-label">PUC<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="pollution_under_control" name="pollution_under_control">
                                    </div>
                                    <?php $__errorArgs = ['pollution_under_control'];
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
                                <div class="input-group">
                                    <label class="form-label">Depreciation Rate<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="depreciation_rate" name="depreciation_rate" placeholder="Enter Depreciation Rate">
                                    </div>
                                    <?php $__errorArgs = ['depreciation_rate'];
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
                                <div class="input-group">
                                    <label class="form-label">Depreciation Value<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="depreciation_value" name="depreciation_value" placeholder="Depreciation Value">
                                    </div>
                                    <?php $__errorArgs = ['depreciation_value'];
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
                                    <label class="form-label">Fuel Type<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fuel_type" name="fuel_type" placeholder="Fuel Type">
                                    </div>
                                    <?php $__errorArgs = ['fuel_type'];
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
                                    <label class="form-label">Engine CC<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="engine_cc" name="engine_cc" placeholder="Engine CC">
                                    </div>
                                    <?php $__errorArgs = ['engine_cc'];
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ame_inventory\resources\views/appPages/vehicle/add-vehicle-reg.blade.php ENDPATH**/ ?>