
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title"> Add Appointment</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('add_new_patient')); ?>"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="options px-5 pt-5  border-bottom pb-3">

                        <form method="post" action="<?php echo e(route('add-appointments-details')); ?>">

                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select class="form-control  select2-show-search" name="patient_id">
                                        <option value="">Select One Patient</option>
                                        <?php if(isset($all_patient)): ?>
                                        <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$patient->id); ?>" <?php echo e(@$patient_details_information->id == $patient->id ? 'Selected' : ''); ?>> <?php echo e(@$patient->prefix); ?> <?php echo e(@$patient->first_name); ?> <?php echo e(@$patient->middle_name); ?> <?php echo e(@$patient->last_name); ?> ( <?php echo e(@$patient->id); ?> ) </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <?php if(isset($patient_details_information)): ?>
                    
                    <?php $__errorArgs = ['patientId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="options px-5  pb-3">
                        <div class="row">

                            <hr class="hr_line">

                            <div class="card-body text-center">
                                <div class="pro-user">
                                    <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                        <?php echo e($patient_details_information->prefix); ?> <?php echo e($patient_details_information->first_name); ?>

                                        <?php echo e($patient_details_information->middle_name); ?> <?php echo e($patient_details_information->last_name); ?>

                                    </h4>
                                    <h6 class="pro-user-desc textlink">
                                        <?php echo e($patient_details_information->patient_prefix); ?><?php echo e($patient_details_information->id); ?>

                                    </h6>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                    <a href="<?php echo e(route('edit-new-patient-opd', base64_encode($patient_details_information->id))); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Patient Profile"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->gender); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5">
                                                <?php echo e(@$patient_details_information->year == '0'?'':$patient_details_information->year.'y'); ?>

                                                <?php echo e(@$patient_details_information->month == '0'?'':$patient_details_information->month.'m'); ?>

                                                <?php echo e(@$patient_details_information->day == '0'?'':$patient_details_information->day.'d'); ?>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->guardian_name_realation); ?>

                                                <?php echo e(@$patient_details_information->guardian_name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->blood_group); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->phone); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php endif; ?>

                </div>

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="<?php echo e(route('save-appointments-details')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="row">
                                <input type="hidden" name="patient_id" value="<?php echo e(@$patient_details_information->id); ?>" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Appointment Date <span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="appointment_date" value="<?php echo e(old('appointment_date')); ?>" required />

                                    <?php $__errorArgs = ['appointment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="doctor">Doctor <span class="text-danger">*</span></label>
                                    <select name="doctor" class="form-control select2-show-search" id="doctor" required>
                                        <option value=" ">Select Doctor</option>
                                        <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['doctor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></sma>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="appointment_priority">Appointment Priority <span class="text-danger">*</span></label>
                                    <select name="appointment_priority" class="form-control select2-show-search" id="appointment_priority" required>
                                        <option value="">Select Appointment Priority</option>
                                        <?php $__currentLoopData = Config::get('static.appointment_priority'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item); ?>"> <?php echo e($item); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['appointment_priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></sma>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                             
                                <!-- <div class="form-group col-md-4 newaddappon">
                                    <label for="slot">Slot <span class="text-danger">*</span></label>
                                    <select name="slot" class="form-control select2-show-search" id="slot" required>
                                        <option value=" ">Select slot</option>
                                        <?php $__currentLoopData = $slot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['slot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></sma>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="shift">Shift <span class="text-danger">*</span></label>
                                    <select name="shift" class="form-control select2-show-search" id="shift" required>
                                        <option value=" ">Select shift</option>
                                        <?php $__currentLoopData = $shift; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['shift'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></sma>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div> -->

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="message">Message </label>
                                    <input type="text" class="form-control" name="message" value="<?php echo e(old('message')); ?>" id="message" />

                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></sma>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>



                </div>
            </div>
            <div class="btn-list p-3">
                <button class="btn btn-primary btn-sm float-right ml-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/appointment/add-appointment.blade.php ENDPATH**/ ?>