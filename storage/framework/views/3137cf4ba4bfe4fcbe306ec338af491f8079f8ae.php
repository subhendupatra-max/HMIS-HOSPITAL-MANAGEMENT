
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Radiology Test
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('OPD.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('OPD.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Test Name</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Billing Status</th>
                                <th class="border-bottom-0">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$radiology_patient_test): ?>
                            <?php $__currentLoopData = $radiology_patient_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@date('d-m-Y h:i A', strtotime($value->date))); ?></td>
                                <td><?php echo e(@$value->test_details->test_name); ?></td>
                                <td><?php echo e(@$value->test_details->test_name); ?></td>
                                <td><?php echo e(@$value->generator_details->first_name); ?> <?php echo e(@$value->generator_details->last_name); ?></td>
                                <td>
                                    <?php echo $value->billing_status == '0' ? '<span class="badge badge-warning">Billing Not Done</span>':'<span class="badge badge-success">Billing Done</span>'; ?>

                                </td>
                                <td><?php echo @$value->test_status; ?></td>
                                <td>
                                    <div class="card-options">
                                        <a class="btn btn-success btn-sm" href="#">
                                            <i class="fa fa-print"></i> Print Report
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/OPD/radiology/test-list.blade.php ENDPATH**/ ?>