
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Death Record </h4>
                </div>

            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <table class="table table-bordered text-nowrap" id="example">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Guardian Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date Of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($discharge_patient)): ?>
                    <?php $__currentLoopData = $discharge_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                        <td> <?php echo e(@$value->patient_details->first_name); ?> <?php echo e(@$value->patient_details->middle_name); ?> <?php echo e(@$value->patient_details->last_name); ?></td>

                        <td> <?php echo e(@$value->patient_details->guardian_name); ?></td>
                        <td> <?php echo e(@$value->patient_details->phone); ?></td>
                        <td> <?php echo e(@$value->patient_details->gender); ?></td>
                        <td> <?php echo e(@$value->patient_details->year); ?>Y <?php echo e(@$value->patient_details->month); ?>M <?php echo e(@$value->patient_details->day); ?>D </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/record/death-record.blade.php ENDPATH**/ ?>