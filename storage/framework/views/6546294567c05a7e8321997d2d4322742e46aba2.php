
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Pharmacy Bill
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add pharmacy bill')): ?>
                        <a href="<?php echo e(route('all-medicine-listing')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i>Generate Bill</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine')): ?>
                        <a href="<?php echo e(route('all-medicine-listing')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i>Medicines</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/generate-bill/generate-bill-listing.blade.php ENDPATH**/ ?>