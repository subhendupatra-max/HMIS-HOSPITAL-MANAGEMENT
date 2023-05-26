
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Referral Person </h4>
        </div>
        <!-- ================== message============================== -->
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                action="<?php echo e(route('update-referral')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="refferal_id" value="<?php echo e(@$referral->id); ?>"/>
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 newaddappon">
                                    <input type="text" name="referral_name"
                                        id="referral_name" required="" value="<?php echo e(@$referral->referral_name); ?>">
                                    <label for="referral_name">Referral Name <span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['referral_name'];
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

                                <div class="col-md-6 newaddappon">

                                    <input type="text" value="<?php echo e(@$referral->phone_no); ?>"  name="phone_no" id="phone_no"
                                        required="">
                                    <label for="phone_no">Enter Phone No<span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['phone_no'];
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
                                <div class="col-md-12 newaddappon">

                                    <input type="text" value="<?php echo e(@$referral->address); ?>"  name="address" id="address"
                                        required="">
                                    <label for="address">Address<span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['address'];
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

                                <div class="col-md-6 newaddappon">

                                    <input type="text" value="<?php echo e(@$referral->standard_commission); ?>"
                                        name="standard_commission" id="standard_commission" required="">
                                    <label for="standard_commission">Standard Commission (%)<span
                                            class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['standard_commission'];
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
                                <div class="col-md-6 text-right">
                                    <div class="d-block mt-3">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                        <a href="#" onclick="getall_data()" class="btn btn-warning btn-sm"> Apply To All</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->opd_commission); ?>" name="opd_commission"
                                        id="opd_commission" required="">
                                    <label for="opd_commission">OPD Commission (%)<span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['opd_commission'];
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

                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->emg_commission); ?>"name="emg_commission" id="emg_commission"
                                        required="">
                                    <label for="emg_commission">EMG Commission (%)<span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['emg_commission'];
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

                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->ipd_commission); ?>" name="ipd_commission" id="ipd_commission"
                                        required="">
                                    <label for="ipd_commission">IPD Commission (%)<span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['ipd_commission'];
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

                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->pharmacy_commission); ?>"
                                        name="pharmacy_commission" id="pharmacy_commission" required="">
                                    <label for="pharmacy_commission">Pharmacy Commission (%)<span
                                            class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['pharmacy_commission'];
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
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->pathology_commission); ?>"
                                        name="pathology_commission" id="pathology_commission" required="">
                                    <label for="pathology_commission">Pathology Commission (%)<span
                                            class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['pathology_commission'];
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
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->radiology_commission); ?>"
                                        name="radiology_commission" id="radiology_commission" required="">
                                    <label for="radiology_commission">Radiology Commission (%)<span
                                            class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['radiology_commission'];
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
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->blood_bank_commission); ?>"
                                        name="blood_bank_commission" id="blood_bank_commission" required="">
                                    <label for="blood_bank_commission">Blood Bank Commission (%)<span
                                            class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['blood_bank_commission'];
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
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="<?php echo e(@$referral->ambulance_commission); ?>"
                                        name="ambulance_commission" id="ambulance_commission" required="">
                                    <label for="ambulance_commission">Ambulance Commission (%)<span
                                            class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['ambulance_commission'];
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
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update
                                Referral</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function getall_data() {
        let value = $('#standard_commission').val();
        $('#opd_commission').val(value);
        $('#emg_commission').val(value);
        $('#ipd_commission').val(value);
        $('#pharmacy_commission').val(value);
        $('#pathology_commission').val(value);
        $('#radiology_commission').val(value);
        $('#blood_bank_commission').val(value);
        $('#ambulance_commission').val(value);
    }
</script>



<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/referral/edit-referral.blade.php ENDPATH**/ ?>