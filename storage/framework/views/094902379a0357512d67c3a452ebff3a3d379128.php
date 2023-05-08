
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Medicine Details</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="col-md-12">
                ce
            </div>
        </div>
        <div class="card-body p-0 border-top">
            <div class="col-md-12">
                <div class="btn-list p-3">
                    <a class="btn btn-success btn-sm"><i class="fa fa-capsules"></i> Medicine Stock</a>
                    <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i> Medicine Bad Stock</a>
                </div>
            </div>
        </div>
        <?php if(true): ?>
             <?php echo $__env->make('pharmacy.medicine.medicine-bad-stock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(true): ?>
            <?php echo $__env->make('pharmacy.medicine.medicine-good-stock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/medicine/medicine-details.blade.php ENDPATH**/ ?>