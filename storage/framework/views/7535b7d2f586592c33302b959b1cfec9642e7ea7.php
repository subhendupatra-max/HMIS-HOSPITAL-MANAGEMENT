
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Bill Summary
                </div>

                <div class="col-md-8 text-right">
               
                </div>
            </div>

        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body ">
            <form action="<?php echo e(route('save-medicaiton-dose')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="case_id_or_uhid_no" class="form-label">Case Id / UHID No. <span class="text-danger">*</span></label>
                        <input type="number" class="form-control billsummary" id="case_id_or_uhid_no" name="case_id_or_uhid_no" required>
                        <?php $__errorArgs = ['case_id_or_uhid_no'];
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
                    <div class="form-group col-md-6">
                        <label for="case_id_or_uhid_no_select" class="form-label">Case Id / UHID No. <span class="text-danger">*</span></label>
                        <select name="" id="case_id_or_uhid_no_select" class="form-control select2-show-search">
                            <option value="">Select One....</option>
                            <option value="uhid_no">UHID No.</option>
                            <option value="case_id">Case Id</option>
                        </select>
                        <?php $__errorArgs = ['case_id_or_uhid_no_select'];
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
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/bill_summary/bill-summary.blade.php ENDPATH**/ ?>