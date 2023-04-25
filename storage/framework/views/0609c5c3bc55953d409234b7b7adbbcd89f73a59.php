
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Referral Person </h4>
        </div>
        <!-- ================== message============================== -->
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?php echo e(route('save-referral')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="col-md-10">
                                <!-- <label class="form-label">Referral Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?php echo e(old('referral_name')); ?>" name="referral_name" id="referral_name" placeholder="Referral Name"> -->
                                <input type="text"value="<?php echo e(old('referral_name')); ?>" name="referral_name" id="referral_name"required="">
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

                            <div class="col-md-10 newaddappon ">
                                <!-- <label class="form-label">contact No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?php echo e(old('phone_no')); ?>" name="phone_no" id="phone_no" placeholder="Enter Phone No"> -->
                                <input type="text" value="<?php echo e(old('phone_no')); ?>" name="phone_no" id="phone_no"required="">
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

                            <div class="col-md-10 newaddappon">
                                <!-- <label class="form-label">Standard Commission (%)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?php echo e(old('standard_commission')); ?>" name="standard_commission" id="standard_commission" placeholder="Standard Commission"> -->
                                <input type="text"  value="<?php echo e(old('standard_commission')); ?>" name="standard_commission" id="standard_commission"required="">
                                <label for="standard_commission">Standard Commission (%)<span class="text-danger">*</span></label>
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

                            <div class="col-md-6">
                                <div class="col-md-6 text-right">
                                    <div class="d-block mt-3">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                        <a href="#" onclick="getall_data()" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Apply To All</a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>


                        </div>


                        <div class="col-md-6">
                            <?php if($model): ?>
                            <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-10">
                                <label class="form-label"><?php echo e($value->modules_name); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control m_raf_mod" require value="" name="ref_commision[]" id="<?php echo e($value->modules_name); ?>">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Add Referral</button>
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
        $('.m_raf_mod').val(value);
    }
</script>



<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/referral/add-referral.blade.php ENDPATH**/ ?>