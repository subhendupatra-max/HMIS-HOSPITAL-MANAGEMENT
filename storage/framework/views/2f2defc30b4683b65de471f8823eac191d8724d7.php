
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Operation Details
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                        <a href="<?php echo e(route('add-operation')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-hospital-user"></i></i> Operation Booking </a>
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
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Operation Name</th>
                                <th class="border-bottom-0">Operation Department</th>
                                <th class="border-bottom-0">Operation Catagory </th>
                                <th class="border-bottom-0">Consultant Doctor</th>
                                <th class="border-bottom-0">Date From</th>
                                <th class="border-bottom-0">Date To</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $operation_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($operation_detail->first_name); ?> <?php echo e($operation_detail->middle_name); ?> <?php echo e($operation_detail->last_name); ?></td>
                                <td> <?php echo e(@$operation_detail->operation_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->department_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->operation_catagory_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->doctor_first_name); ?> <?php echo e(@$operation_detail->doctor_last_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->operation_date_from); ?> </td>
                                <td> <?php echo e(@$operation_detail->operation_date_to); ?> </td>
                                <td> <?php if($operation_detail->status == 'Pending'): ?>
                                    <span class="badge badge-warning"> <?php echo e($operation_detail->status); ?></span>
                                    <?php elseif($operation_detail->status == 'Complete'): ?>
                                    <span class="badge badge-success">  <?php echo e($operation_detail->status); ?></span>
                                    <?php else: ?>
                                    <span class="badge badge-secondary">  <?php echo e($operation_detail->status); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view operation main')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('view-operation-booking-details', base64_encode($operation_detail->booking_id))); ?>">
                                                <i class="fa fa-eye"></i> View</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit operation main')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-operation-booking-details',['id' => base64_encode($operation_detail->booking_id)])); ?>">
                                                <i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete operation main')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-operation-booking-details', base64_encode(@$operation_detail->booking_id))); ?>"><i class="fa fa-trash"></i>
                                                Delete</a>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/main-operation/operation-details.blade.php ENDPATH**/ ?>