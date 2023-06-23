
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
                        <a href="<?php echo e(route('add_new_patient')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-hospital-user"></i></i> Add New Patient </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header d-block">
            <form action="<?php echo e(route('patient_details')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_first_name" value="<?php echo e(@$request_data['patient_first_name']); ?>" placeholder="Search By Patient Name ....." />
                    </div>
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_uhid"  value="<?php echo e(@$request_data['patient_uhid']); ?>" placeholder="Search By Patient UHID ....." />
                    </div>
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_phone_no"  value="<?php echo e(@$request_data['patient_phone_no']); ?>" placeholder="Search By Patient Phone No ....." />
                    </div>
                    <div class="col-md-3 card-title">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> Search</button>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('patient_details')); ?>"><i class="fa fa-list"></i> All Patient</a>
                    </div>
                </div>
            </form>
        </div>

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap border-left border-right border-bottom">
                        <thead class="bg-primary text-white">
                            <tr class="border-left">
                                <th  class="text-white">UHID</th>
                                <th  class="text-white">Patient Name</th>
                                <th  class="text-white">Guardian Name </th>
                                <th  class="text-white">Gender</th>
                                <th  class="text-white">Age</th>
                                <th  class="text-white">Phone</th>
                                <th  class="text-white">Address</th>
                                <th  class="text-white">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(@$all_patient[0]->id != null): ?>
                            <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_patients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a href="<?php echo e(route('patient-details-profile', base64_encode($all_patients->id))); ?>" class="textlink"><?php echo e($all_patients->id); ?></a>
                                </td>
                                <td><?php echo e($all_patients->prefix); ?> <?php echo e($all_patients->first_name); ?>

                                    <?php echo e($all_patients->middle_name); ?> <?php echo e($all_patients->last_name); ?>

                                </td>
                                <td><?php echo e($all_patients->guardian_name_realation); ?> <?php echo e($all_patients->guardian_name); ?>

                                </td>
                                <td><?php echo e($all_patients->gender); ?></td>
                                <td><?php echo e($all_patients->year); ?>y <?php echo e($all_patients->month); ?>m <?php echo e($all_patients->day); ?>d
                                </td>
                                <td><?php echo e($all_patients->phone); ?></td>
                                <td><?php echo e($all_patients->address); ?>,<?php echo e(@$all_patients->_district->name); ?>,<br><?php echo e(@$all_patients->_state->name); ?>,<?php echo e($all_patients->pin_no); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href="<?php echo e(route('patient-details-profile', base64_encode($all_patients->id))); ?>"><i class="fa fa-eye"></i> View</a>
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
                            <?php else: ?>
                            <tr>
                                <td colspan="8" style="text-align: center;">
                                    <img src="<?php echo e(asset('public/no_found_data/no_data.png')); ?>" alt="loader" width="400px"
                                    height="160px">
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="mt-2">
                         <?php echo $all_patient->links(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/patient/patient_list.blade.php ENDPATH**/ ?>