
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Appointment List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add appointment main')): ?>
                        <a href="<?php echo e(route('add-appointments-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Add Appointment </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dotor wise appointment main')): ?>
                        <a href="<?php echo e(route('doctor-wise-appointments-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Dr. Wise </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Doctor Name</th>
                                <th class="border-bottom-0">Appointment Date</th>
                                <th class="border-bottom-0">Appointment Priority</th>
                                <th class="border-bottom-0">Message</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment','delete appointment')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->patient_details->first_name); ?> <?php echo e($item->patient_details->middle_name); ?> <?php echo e($item->patient_details->last_name); ?></td>
                                <td><?php echo e($item->doctor_details->first_name); ?> <?php echo e($item->doctor_details->last_name); ?></td>
                                <td><?php echo e($item->appointment_date); ?></td>
                                <td><?php echo e($item->appointment_priority); ?></td>
                                <td><?php echo e($item->message); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointments emg')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-appointments-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointments details')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-appointments-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/appointment/appointment-listing.blade.php ENDPATH**/ ?>