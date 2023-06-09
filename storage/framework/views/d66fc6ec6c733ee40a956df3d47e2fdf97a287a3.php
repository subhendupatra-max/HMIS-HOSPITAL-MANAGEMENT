
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Billing
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add opd billing')): ?>
                        <a href="<?php echo e(route('add-opd-billing', ['id' => base64_encode($opd_id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add Billing </a>
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
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Bill No.</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Grand Total(Rs)</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Discount Status</th>
                                <th class="border-bottom-0">Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$opd_billing_details): ?>
                            <?php $__currentLoopData = $opd_billing_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a class="text-info" href="<?php echo e(route('opd-bill-details', ['bill_id' => base64_encode($value->id)])); ?>"><?php echo e($value->bill_prefix); ?><?php echo e($value->id); ?></a>
                                </td>
                                <td><?php echo e(date('d-m-Y h:i A', strtotime($value->bill_date))); ?></td>
                                <td><?php echo e($value->grand_total); ?></td>
                                <td><?php echo e($value->created_details->first_name); ?>

                                    <?php echo e($value->created_details->last_name); ?>

                                </td>

                                <td>
                                    <?php if($value->discount_status != 'Not applied'): ?>
                                    <?php if($value->discount_status == 'Approved'): ?>
                                    <span class="badge badge-success">Approved</span>
                                    <?php elseif($value->discount_status == 'Requested'): ?>
                                    <span class="badge badge-warning">Requested</span>
                                    <?php else: ?>
                                    <span class="badge badge-danger">Rejected</span>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <span class="badge badge-primary">Not Applied</span>
                                    <?php endif; ?>
                                </td>

                                <td><span class="badge badge-success"><?php echo e($value->payment_status); ?></span></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="<?php echo e(route('opd-bill-details', ['bill_id' => base64_encode($value->id)])); ?>">
                                            <i class="fa fa-eye"></i> View
                                            </a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print opd billing')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('print-opd-bill',['bill_id'=>base64_encode($value->id)])); ?>">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                            <?php endif; ?>
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete opd billing')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-opd-bill',['bill_id'=>base64_encode($value->id)])); ?>">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                            <?php endif; ?>

                                        </div>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/OPD/billing/billing-list.blade.php ENDPATH**/ ?>