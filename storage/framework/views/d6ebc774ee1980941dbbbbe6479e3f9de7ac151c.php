
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Payment
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd payment')): ?>
                        <a href="<?php echo e(route('add-payment-in-opd',['id'=> base64_encode($opd_id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-rupee-sign"></i> Add Payment </a>
                        <?php endif; ?>
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
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead class="bg-primary text-white">
                            <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Date</th>
                                <th class="text-white">Amount</th>
                                <th class="text-white">Received By</th>
                                <th class="text-white">Payment Mode</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit opd payment','delete opd payment')): ?>
                                <th class="text-white" >Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $opdPaymentDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(date('d-m-Y h:i a',strtotime($item->payment_date))); ?></td>
                                <td><?php echo e($item->payment_amount); ?></td>
                                <td><?php echo e($item->generated_by->first_name); ?> <?php echo e($item->generated_by->last_name); ?></td>
                                <td><?php echo e($item->payment_mode); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-payment-in-opd')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-payment-in-opd',['id'=> base64_encode($item->id),'opd_id'=> base64_encode($opd_patient_details->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-payment-in-opd')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-payment-in-opd',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print-payment-in-opd')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('print-payment-in-opd',['id'=> base64_encode($item->id),'opd_id'=> base64_encode($opd_patient_details->id)])); ?>"><i class="fa fa-print"></i> Print</a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo $opdPaymentDetails->links(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/OPD/payment/payment-listing.blade.php ENDPATH**/ ?>