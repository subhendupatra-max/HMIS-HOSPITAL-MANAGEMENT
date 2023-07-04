
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Appointment of Dr. Wise</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-12 border-right">
                            <form method="POST" action="<?php echo e(route('fetch-appointments-details-dr-wise')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="form-group col-md-4 addopdd">
                                            <label> Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" id="date" style="margin: 11px 0px 0px 0px;" value="<?php echo e(date('Y-m-d',strtotime($all_search_data['date']))); ?>" required />
                                            <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group col-md-4 addopdd">
                                            <label>Doctor<span class="text-danger">*</span></label>
                                            <select name="doctor" onchange="getSlot(this.value,<?php echo e(@$all_search_data['slot']); ?>)" class="form-control select2-show-search" id="doctor">
                                                <option value="">Select Doctor</option>
                                                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($doctor->id); ?>" <?php echo e(@$all_search_data['doctor'] == $doctor->id ? 'selected':''); ?>> <?php echo e($doctor->first_name); ?> <?php echo e($doctor->last_name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['doctor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group col-md-4 addopdd">
                                            <label for="slot">Slot <span class="text-danger">*</span></label>
                                            <select name="slot" class="form-control select2-show-search" id="slot" required>
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
                                    </div>

                                </div>
                                <div class="row">
                                    <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th scope="col">Sl. No</th>
                                <th scope="col">Patient Name </th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Appointment Priority</th>
                                <th scope="col">Slot</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$appointment[0]->id != null): ?>
                            <?php $__currentLoopData = $appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $slot_details = DB::table('slots')->where('id',$item->slot)->first();
                            $slot_time =  date('H:i A',strtotime($slot_details->from_time))." - ".date('H:i A',strtotime($slot_details->to_time));
                           ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->patient_details->first_name); ?> <?php echo e($item->patient_details->middle_name); ?> <?php echo e($item->patient_details->last_name); ?></td>
                                <td><?php echo e($item->doctor_details->first_name); ?> <?php echo e($item->doctor_details->last_name); ?></td>
                                <td><?php echo e($item->appointment_date); ?></td>
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
                                <td><?php echo e($slot_time); ?></td>
                                <td><?php echo $item->message; ?></td>

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
<script>
    function getSlot(doctor_id,slot=null)
    {
        var appointment_date = $('#date').val();
         var sel = '';
        var div_data = '';
        $('#slot').html('<option value="">Select One....</option>');
        $.ajax({
            url: "<?php echo e(route('get-slot-details-using-doctor_id')); ?>",
            type: "POST",
            data: {
                _token : '<?php echo e(csrf_token()); ?>',
                appointmentDate : appointment_date,
                doctorId : doctor_id,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    if(slot == value.id)
                    {
                         sel = 'Selected';
                    }
                    div_data += `<option value="${value.id}" ${sel}>${value.from_time} - ${value.to_time}</option>`;
                });
                $('#slot').append(div_data);
            },
            error: function(error) {
                console.log(error);
            }
        });
       
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/appointment/dr-wise-appointment.blade.php ENDPATH**/ ?>