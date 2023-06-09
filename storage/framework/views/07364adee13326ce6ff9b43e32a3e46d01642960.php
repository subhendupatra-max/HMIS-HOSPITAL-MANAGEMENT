
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
                        <a href="<?php echo e(route('doctor-wise-appointments-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-medkit"></i> Dr. Wise </a>
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
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                                <th class="text-white">Sl. No</th>
                                <th class="text-white">Patient Name</th>
                                <th class="text-white">Doctor Name</th>
                                <th class="text-white">Appointment Date</th>
                                <th class="text-white">Slot</th>
                                <th class="text-white">Appointment Priority</th>
                                <th class="text-white">Appointment Fees</th>
                                <th class="text-white">Message</th>
                                <th class="text-white">Payment Mode</th>
                                <th class="text-white">Payment Amount</th>
                                <th class="text-white">Note</th>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment','delete appointment')): ?>
                                <th class="text-white">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                             $slot_details = DB::table('slots')->where('id',$item->slot)->first();
                             $slot_time =  date('H:i A',strtotime($slot_details->from_time))." - ".date('H:i A',strtotime($slot_details->to_time));
                            ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->patient_details->first_name); ?> <?php echo e($item->patient_details->middle_name); ?> <?php echo e($item->patient_details->last_name); ?></td>
                                <td><?php echo e($item->doctor_details->first_name); ?> <?php echo e($item->doctor_details->last_name); ?></td>
                                <td><?php echo e(date('d-m-Y',strtotime($item->appointment_date))); ?></td>
                                <td><?php echo e($slot_time); ?></td>
                                <td>
                                    <?php if($item->appointment_priority == 'Normal'): ?>
                                        <span class="badge badge-success">Normal</span>
                                    <?php elseif($item->appointment_priority == 'Urgent'): ?>
                                        <span class="badge badge-warning">Urgent</span>
                                    <?php elseif($item->appointment_priority == 'Very Urgent'): ?>
                                        <span class="badge badge-danger">Very Urgent</span>
                                    <?php else: ?>
                                        <span class="badge badge-info">Low</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->appointment_fees); ?></td>
                                <td><?php echo e($item->message); ?></td>
                                <td><?php echo e($item->payment_mode); ?></td>
                                <td><?php echo e($item->payment_amount); ?></td>
                                <td><?php echo e($item->note); ?></td>
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