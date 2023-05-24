
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Operation Details
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                        <a href="<?php echo e(route('add-operation')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-hospital-user"></i></i> Operation Booking </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">UHID</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Guardian Name </th>
                                <th class="border-bottom-0">Gender</th>
                                <th class="border-bottom-0">Age</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/main-operation/operation-details.blade.php ENDPATH**/ ?>