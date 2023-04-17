
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Patient List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                        <a href="<?php echo e(route('import-patient')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i>
                            Import Patient </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                        <a href="<?php echo e(route('add_new_patient')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add New Patient </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">UHID</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Guardian Name </th>
                                <th class="border-bottom-0">Gender</th>
                                <th class="border-bottom-0">Age</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_patients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td><a href="<?php echo e(route('patient-details-profile', base64_encode($all_patients->id))); ?>" class="textlink"><?php echo e($all_patients->patient_prefix); ?><?php echo e($all_patients->id); ?></a></td>
                                <td><?php echo e($all_patients->prefix); ?> <?php echo e($all_patients->first_name); ?>

                                    <?php echo e($all_patients->middle_name); ?> <?php echo e($all_patients->last_name); ?>

                                </td>
                                <td><?php echo e($all_patients->guardian_name_realation); ?> <?php echo e($all_patients->guardian_name); ?>

                                </td>
                                <td><?php echo e($all_patients->gender); ?></td>
                                <td><?php echo e($all_patients->year); ?>y <?php echo e($all_patients->month); ?>m <?php echo e($all_patients->day); ?>d
                                </td>
                                <td><?php echo e($all_patients->address); ?>,<?php echo e(@$all_patients->_district->name); ?>,<br><?php echo e(@$all_patients->_state->name); ?>,<?php echo e($all_patients->pin_no); ?></td>
                                <td>


                                    <div class="card-options">

                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="<?php echo e(route('view-new-patient', base64_encode($all_patients->id))); ?>"><i class="fa fa-eye"></i> View</a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-patient-details', base64_encode($all_patients->id))); ?>">
                                                <i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete patient')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-patient-details', base64_encode($all_patients->id))); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('OPD registation')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('opd-registration', base64_encode($all_patients->id))); ?>"><i class="fa fa-file-alt"></i> OPD Registation</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Emg registation')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('emg-registation', base64_encode($all_patients->id))); ?>"><i class="fa fa-file-alt"></i> EMG Registation</a>
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


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/patient/patient_list.blade.php ENDPATH**/ ?>