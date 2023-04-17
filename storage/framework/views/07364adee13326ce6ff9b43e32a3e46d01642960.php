
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Appointment List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add appointment main')): ?>
                        <a href="<?php echo e(route('add-appointments-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Appointment  </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/appointment/appointment-listing.blade.php ENDPATH**/ ?>