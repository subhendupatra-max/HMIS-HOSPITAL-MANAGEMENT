
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Charges
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add ipd charges')): ?>
                        <a href="<?php echo e(route('add-ipd-charges', ['id' => base64_encode($ipd_id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add Charges </a>
                        <?php endif; ?>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
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
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Charge Name</th>
                                <th class="border-bottom-0">Amount</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Bill Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$ipd_charges_details): ?>
                            <?php $__currentLoopData = $ipd_charges_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@date('d-m-Y h:i A', strtotime($value->charges_date))); ?></td>
                                <td><?php echo e(@$value->charges_category_details->charges_catagories_name); ?></td>
                                <td><?php echo e(@$value->charge_details->charges_name); ?></td>
                                <td><?php echo e(@$value->amount); ?></td>
                                <td><?php echo e(@$value->generated_by_details->first_name); ?> <?php echo e(@$value->generated_by_details->last_name); ?></td>
                                <td>
                                    <?php if($value->billing_status == '0'): ?>
                                    <span class="badge badge-warning">Billing Not Created</span>
                                    <?php else: ?>
                                    <span class="badge badge-success">Billing Created</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="<?php echo e(route('opd-bill-details', ['bill_id' => base64_encode($value->id)])); ?>">
                                                <i class="fa fa-eye"></i> View
                                            </a>

                                            <a class="dropdown-item" href="">
                                                <i class="fa fa-print"></i> Print
                                            </a>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit opd charges')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-opd-charges',['id'=>base64_encode($ipd_id),'charge_id'=>base64_encode($value->id)])); ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete opd billing')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-opd-bill',['bill_id'=>$value->id])); ?>">
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Ipd/charges/charges-list.blade.php ENDPATH**/ ?>