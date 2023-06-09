
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
                                <a href="<?php echo e(route('add-opd-billing', ['id' => base64_encode($opd_id)])); ?>"
                                    class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add Billing </a>
                            <?php endif; ?>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" style="">
                                <?php echo $__env->make('OPD.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>


            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered text-nowrap key-buttons">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Bill No.</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Total Amount</th>
                                    <th class="border-bottom-0">Generated By</th>
                                    <th class="border-bottom-0">Billing Status</th>
                                    <th class="border-bottom-0">Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(@$opd_billing_details): ?>
                                    <?php $__currentLoopData = $opd_billing_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><a class="text-info"
                                                    href="<?php echo e(route('opd-bill-details', ['bill_id' => base64_encode($value->id)])); ?>"><?php echo e($value->bill_prefix); ?><?php echo e($value->id); ?></a>
                                            </td>
                                            <td><?php echo e(date('d-m-Y h:i A', strtotime($value->bill_date))); ?></td>
                                            <td><?php echo e($value->total_amount); ?></td>
                                            <td><?php echo e($value->created_details->first_name); ?>

                                                <?php echo e($value->created_details->last_name); ?></td>
                                            <td><span class="badge badge-success"><?php echo e($value->status); ?></span></td>
                                            <td><span class="badge badge-success"><?php echo e($value->payment_status); ?></span></td>
                                            <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"> Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">

                                                    <a class="dropdown-item" href="">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit opd billing')): ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('edit-opd-bill',['bill_id'=>$value->id])); ?>">
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
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/OPD/billing/billing-list.blade.php ENDPATH**/ ?>