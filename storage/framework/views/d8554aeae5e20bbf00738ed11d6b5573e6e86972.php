
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Operation Booking Details
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('emg.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('emg.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Operation Name</th>
                                <th class="text-white">Operation Catagory </th>
                                <th class="text-white">Consultant Doctor </th>
                                <th class="text-white">Operaiton Type</th>
                                <th class="text-white">From Date</th>
                                <th class="text-white">To Date</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit physical condition','delete physical condition')): ?>
                                <th class="text-white">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$operation_details[0]->operation_name != null ): ?>
                            <?php $__currentLoopData = $operation_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(route('emg-operation-details',['emg_id' => base64_encode($item->emg_id)])); ?>" style="color:blue"><?php echo e($item->booking_id); ?></a>
                                </td>
                                <td><?php echo e($item->operation_name); ?></td>
                                <td><?php echo e($item->operation_catagory_name); ?></td>
                                <td><?php echo e($item->doctor_first_name); ?> <?php echo e($item->doctor_last_name); ?></td>
                                <td><?php echo e($item->operation_type_name); ?></td>
                                <td><?php echo e($item->operation_date_from); ?></td>
                                <td><?php echo e($item->operation_date_to); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit operation details')): ?>
                                            <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Edit</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/emg/operation-emg/operation-listing-in-emg.blade.php ENDPATH**/ ?>