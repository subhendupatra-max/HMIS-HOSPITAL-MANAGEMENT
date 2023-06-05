

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine rack')): ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">

            <div class="col-md-12 row">
                <div class="col-md-6 card-title">
                    Expiry Medicine Details
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('add-bad-medicine',['medicine_id'=>$medicine_details->id])); ?>"><i class="fa fa-plus"></i> Add Bad Medicine</a>
                </div>
            </div>
        </div>


        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Medicine Name</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Batch No </th>
                                <th class="border-bottom-0">Date </th>

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
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/medicine/bad-medicine-details.blade.php ENDPATH**/ ?>