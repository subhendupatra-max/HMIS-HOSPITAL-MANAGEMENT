
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        Radiology List
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                <a href="<?php echo e(route('import-patient')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i>
                                    Generate Bill </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                <a href="<?php echo e(route('radiology-test-details')); ?>" class="btn btn-primary btn-sm"><i
                                        class="fa fa-user"></i> Radiology Test </a>
                            <?php endif; ?>
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                <a href="<?php echo e(route('add_new_patient')); ?>" class="btn btn-primary btn-sm"><i
                                        class="fa fa-user"></i> Pending Test </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example1">
                            <thead>
                                <tr>
                                   
                                </tr>
                            </thead>

                                <tbody>
                                   

                                </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/radiology/radiology-listing.blade.php ENDPATH**/ ?>