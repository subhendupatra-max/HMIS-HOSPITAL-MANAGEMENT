
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title"> Edit Appointment</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    

                    



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
                <script>
                    function getSlot(doctor_id,slot=null)
                    {
                        // alert(slot);
                        var appointment_date = $('#appointment_date').val();
                       // alert(patient_type);
                        var div_data = '';
                        var sel = '';
                        $('#slot').html('<option value="">Select One....</option>');
                        $.ajax({
                            url: "<?php echo e(route('get-slot-details-using-doctor_id-edit')); ?>",
                            type: "POST",
                            data: {
                                _token : '<?php echo e(csrf_token()); ?>',
                                appointmentDate : appointment_date,
                                doctorId : doctor_id,
                                slotId : slot,
                            },
                            success: function(response) {
                                $.each(response, function(key, value) {
                                    if(slot == value.id)
                                    {
                                        sel = 'selected';
                                    }
                                    else{
                                        sel = '';
                                    }
                                    div_data += `<option value="${value.id}" ${sel}>${value.from_time} - ${value.to_time}</option>`;
                                });
                                getAppointmentFees(slot)
                                $('#slot').append(div_data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                       
                    }
                    function getAppointmentFees(slot_id)
                    {
                        alert(slot_id);
                        $.ajax({
                            url: "<?php echo e(route('get-appointment-fees-by-slot')); ?>",
                            type: "POST",
                            data: {
                                _token : '<?php echo e(csrf_token()); ?>',
                                slotId : slot_id,
                            },
                            success: function(response) {
                                $('#appointment_fees').val(response.standard_charges);
                                $('#payment_amount').val(response.standard_charges);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                </script>
                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="<?php echo e(route('update-appointments-details')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="options px-5 pt-1  border-bottom pb-3">

                            <div class="row">
                                <input type="hidden" name="patient_id" value="<?php echo e(@$editAppointment->patient_id); ?>" />
                                <input type="hidden" name="id" value="<?php echo e(@$editAppointment->id); ?>" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Appointment Date <span class="text-danger">*</span></label>

                                    <input type="date" style="margin:9px 0px 0px 0px" name="appointment_date" id="appointment_date"  required value="<?php echo e(date('Y-m-d',strtotime($editAppointment->appointment_date))); ?>" />

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
                                    <select name="doctor" onchange="getSlot(this.value,<?php echo e($editAppointment->slot); ?>)" class="form-control select2-show-search" id="doctor" required>
                                        <option value=" ">Select Doctor</option>
                                        <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $editAppointment->doctor ? 'selected' : " "); ?>><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?>

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
                                    <label for="slot">Slot <span class="text-danger">*</span></label>
                                    <select name="slot" onchange="getAppointmentFees(this.value)" class="form-control select2-show-search" id="slot" required>
                                        <option value=" ">Select slot...</option>
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
                                    <label for="appointment_priority">Appointment Priority <span class="text-danger">*</span></label>
                                    <select name="appointment_priority" class="form-control select2-show-search" id="appointment_priority" required>
                                        <option value="">Select Appointment Priority</option>
                                        <?php $__currentLoopData = Config::get('static.appointment_priority'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item); ?>" <?php echo e($item == $editAppointment->appointment_priority ? 'selected' : " "); ?>> <?php echo e($item); ?></option>
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
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="appointment_fees">Appointment Fees <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="appointment_fees" value="<?php echo e(@$editAppointment->appointment_fees); ?>" id="appointment_fees" style="margin:0px 0px 0px 0px;" />
                                    <?php $__errorArgs = ['appointment_fees'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($appointment_fees); ?></sma>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="message">Message </label>
                                    <input type="text" class="form-control" name="message" style="margin:0px 0px 0px 0px" value="<?php echo e($editAppointment->message); ?>" id="message" />

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
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="appointment_fees">Payment Mode <span class="text-danger">*</span></label>
                                    <select class="form-control" name="payment_mode">
                                        <option value="">Select One...</option>
                                        <?php $__currentLoopData = Config::get('static.payment_mode_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $payment_mode_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($payment_mode_name); ?>" <?php echo e($editAppointment->payment_mode == $payment_mode_name?'selected':''); ?>> <?php echo e($payment_mode_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['payment_mode'];
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
                                    <label class="form-label">Payment Amount </label>
                                    <input type="text" value="<?php echo e($editAppointment->payment_amount); ?>" name="payment_amount" id="payment_amount" class="form-control" />
                                    <?php $__errorArgs = ['payment_amount'];
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
                                    <label class="form-label">Note </label>
                                    <input type="text" name="note" value="<?php echo e($editAppointment->note); ?>" class="form-control" />
                                </div>
                            </div>
                        </div>



                </div>
            </div>
            <div class="" style="text-align: center;">
                <button class="btn btn-primary btn-sm mb-3" type="submit" name="save" value="save"><i class="fa fa-file"></i> Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/appointment/edit-appointment.blade.php ENDPATH**/ ?>