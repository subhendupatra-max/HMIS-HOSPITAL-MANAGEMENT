
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                       Referral Person List
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Referral Payment List')): ?>
                            <a href="<?php echo e(route('referral-payment-list')); ?>" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i> Referral Payment</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                <a href="<?php echo e(route('add-referral')); ?>" class="btn btn-primary btn-sm"><i
                                        class="fa fa-user"></i> Add Referral Person</a>
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
                                    <th class="border-bottom-0">Sl No.</th>
                                    <th class="border-bottom-0">Referral Name</th>
                                    <th class="border-bottom-0">Phone No</th>
                                    <th class="border-bottom-0">Address</th>
                                    <th class="border-bottom-0">Standard Commission(%)</th>
                                    <th class="border-bottom-0">OPD Commission(%)</th>
                                    <th class="border-bottom-0">EMG Commission(%)</th>
                                    <th class="border-bottom-0">IPD Commission(%)</th>
                                    <th class="border-bottom-0">Pharmacy Commission(%)</th>
                                    <th class="border-bottom-0">Pathology Commission(%)</th>
                                    <th class="border-bottom-0">Radiology Commission(%)</th>
                                    <th class="border-bottom-0">Blood Bank Commission(%)</th>
                                    <th class="border-bottom-0">Ambulance Commission(%)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(@$refferal_person): ?>
                                <?php $__currentLoopData = $refferal_person; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(@$value->referral_name); ?></td>
                                    <td><?php echo e(@$value->phone_no); ?></td>
                                    <td><?php echo e(@$value->address); ?></td>
                                    <td><?php echo e(@$value->standard_commission); ?></td>
                                    <td><?php echo e(@$value->opd_commission); ?></td>
                                    <td><?php echo e(@$value->emg_commission); ?></td>
                                    <td><?php echo e(@$value->ipd_commission); ?></td>
                                    <td><?php echo e(@$value->pharmacy_commission); ?></td>
                                    <td><?php echo e(@$value->pathology_commission); ?></td>
                                    <td><?php echo e(@$value->radiology_commission); ?></td>
                                    <td><?php echo e(@$value->blood_bank_commission); ?></td>
                                    <td><?php echo e(@$value->ambulance_commission); ?></td>
                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                <a class="dropdown-item" href="<?php echo e(route('view-refferal',['id'=>base64_encode($value->id)])); ?>">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                <a class="dropdown-item" href="<?php echo e(route('edit-refferal',['id'=>base64_encode($value->id)])); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a class="dropdown-item" href="<?php echo e(route('delete-refferal-person',['id'=>base64_encode($value->id)])); ?>">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/referral/referral-listing.blade.php ENDPATH**/ ?>