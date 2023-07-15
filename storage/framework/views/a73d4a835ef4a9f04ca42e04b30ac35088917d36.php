
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
                        <a href="<?php echo e(route('add-ipd-payment-details',['ipd_id' => base64_encode($ipd_details->id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Total Payment Slip</a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('add-ipd-payment-details',['ipd_id' => base64_encode($ipd_details->id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-rupee-sign"></i> Add new Payment</a>
                        <?php endif; ?>

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-header">
            <?php echo $__env->make('ipd.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body ">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead class="bg-primary text-white">
                                <tr class="border-left">
                                    <th class="text-white">Sl. No</th>
                                    <th class="text-white">Date</th>
                                    <th class="text-white">Amount</th>
                                    <th class="text-white">Payement Mode</th>
                                    <th class="text-white">Note</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $paymentDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border-bottom-0"><?php echo e($loop->iteration); ?></td>
                                    <td class="border-bottom-0"><?php echo e(@$item->payment_date); ?> </td>
                                    <td class="border-bottom-0"><?php echo e(@$item->payment_amount); ?></td>
                                    <td class="border-bottom-0"><?php echo e(@$item->payment_mode); ?></td>
                                    <td class="border-bottom-0"><?php echo e(@$item->note); ?></td>
                                    <td class="border-bottom-0">
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit ipd payment')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('edit-ipd-payment-details',['ipd_id' => base64_encode($ipd_details->id) , 'id' => base64_encode($item->id)])); ?>">
                                                    <i class="fa fa-edit"></i> Edit</a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete ipd payment')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('delete-ipd-payment-details',['id' => base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                                <?php endif; ?>


                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print-payment-in-ipd')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('print-payment-in-ipd',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Print</a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/payment/payment-listing.blade.php ENDPATH**/ ?>