
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Referral Payment List
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('add-referral-payment')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                            Add Referral Payment </a>
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
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Referral Name</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Bill No.</th>
                                <th class="border-bottom-0">Bill Amount ($)</th>
                                <th class="border-bottom-0">Commission Amount ($)</th>
                                
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($payment_list)): ?>
                            <?php $__currentLoopData = $payment_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$value->referral_details->referral_name); ?></td>
                                <td><?php echo e(@$value->all_patient_details->prefix); ?> <?php echo e(@$value->all_patient_details->first_name); ?> <?php echo e(@$value->all_patient_details->middle_name); ?> <?php echo e(@$value->all_patient_details->last_name); ?><br>
                                    <?php echo e(@$value->all_patient_details->patient_prefix); ?><?php echo e(@$value->all_patient_details->id); ?>

                                </td>
                                <td><?php echo e(@$value->bill_id); ?></td>
                                <td><?php echo e(@$value->bill_amount); ?></td>
                                <td><?php echo e(@$value->commission_amount); ?></td>
                                
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                            <a class="dropdown-item" href=""><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                            <a class="dropdown-item" href=""><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/referral/referral-payment-list.blade.php ENDPATH**/ ?>