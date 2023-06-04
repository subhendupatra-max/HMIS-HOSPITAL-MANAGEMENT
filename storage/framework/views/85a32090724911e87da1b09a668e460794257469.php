
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">OPD Patient Report</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="<?php echo e(route('fetch-opd-patient-report')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="visit_type">Visit Type <span
                                                    class="text-danger">*</span></label>
                                            <select name="visit_type" class="form-control select2-show-search"
                                                id="visit_type">
                                                <option value="">Visit Type.....</option>
                                                <option value="New Visit" <?php echo e(@$all_search_data['visit_type'] == 'New Visit' ? 'selected':''); ?> >New-Visit</option>
                                                <option value="Revisit" <?php echo e(@$all_search_data['visit_type'] == 'Revisit' ? 'selected':''); ?> >Revisit</option>
                                            </select>
                                            <?php $__errorArgs = ['visit_type'];
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
                                            <label for="patient_type">Patient Type <span
                                                    class="text-danger">*</span></label>
                                            <select name="patient_type" onchange="getDetailsAccordingType(this.value)"
                                                class="form-control select2-show-search" id="patient_type">
                                                <option value="">Patient Type..... </option>
                                                <?php $__currentLoopData = Config::get('static.patient_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $patient_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($patient_type); ?>" <?php echo e(@$all_search_data['patient_type'] == 'Revisit' ? 'selected':''); ?> > <?php echo e($patient_type); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php $__errorArgs = ['patient_type'];
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
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="department"> Department <span
                                                    class="text-danger">*</span></label>
                                            <select name="department" class="form-control select2-show-search"
                                                id="department">
                                                <option value="">Department</option>
                                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($department->id); ?>" <?php echo e(@$all_search_data['department'] == $department->id ? 'selected':''); ?>> <?php echo e($department->department_name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['department'];
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
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="cons_doctor">Consultant Doctor <span
                                                    class="text-danger">*</span></label>
                                            <select name="cons_doctor" class="form-control select2-show-search"
                                                id="cons_doctor">
                                                <option value="">Consultant Doctor</option>
                                                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($doctor->id); ?>" <?php echo e(@$all_search_data['cons_doctor'] == $doctor->id ? 'selected':''); ?> > <?php echo e($doctor->first_name); ?>

                                                    <?php echo e($doctor->last_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['cons_doctor'];
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
                                            <label>From Date <span class="text-danger">*</span></label>
                                            <input type="date" name="from_date" value="<?php echo e(date(@$all_search_data['from_date'])); ?>" required />
                                            <?php $__errorArgs = ['from_date'];
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
                                        
                                        <div class="form-group col-md-4 addopdd ">
                                            <label>To Date  <span class="text-danger">*</span></label>
                                            <input type="date" name="to_date" value="<?php echo e(date(@$all_search_data['to_date'])); ?>" required />
                                            <?php $__errorArgs = ['to_date'];
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
                                    </div>

                                </div>
                                <div class="row">
                                    <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i
                                            class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 border-right">
                            <canvas id="myChart" style="width:100%;max-width:300px"></canvas>
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
                                <th scope="col">OPD Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Patient Type</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Department</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Visit Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php if(@$opd_patient_report[0]->id != null): ?>
                            <?php $__currentLoopData = $opd_patient_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <tr>
                                <td><?php echo e(@$value->opd_details_data->opd_prefix); ?><?php echo e(@$value->opd_details_data->id); ?></td>
                                <td><?php echo e(@$value->opd_details_data->all_patient_details->prefix); ?>

                                    <?php echo e(@$value->opd_details_data->all_patient_details->first_name); ?>

                                    <?php echo e(@$value->opd_details_data->all_patient_details->middle_name); ?>

                                    <?php echo e(@$value->opd_details_data->all_patient_details->last_name); ?>(<?php echo e(@$value->opd_details_data->all_patient_details->id); ?>)</td>
                                <td> <?php if(@$value->opd_details_data->all_patient_details->year != 0): ?>
                                    <?php echo e(@$value->opd_details_data->all_patient_details->year); ?>y
                                    <?php endif; ?>
                                    <?php if(@$value->opd_details_data->all_patient_details->month != 0): ?>
                                    <?php echo e(@$value->opd_details_data->all_patient_details->month); ?>m
                                    <?php endif; ?>
                                    <?php if(@$value->opd_details_data->all_patient_details->day != 0): ?>
                                    <?php echo e(@$value->opd_details_data->all_patient_details->day); ?>d
                                    <?php endif; ?></td>
                                <td><?php echo e(@$value->opd_details_data->all_patient_details->guardian_name); ?></td>
                                <td><?php echo e(@$value->opd_details_data->all_patient_details->phone); ?></td>
                                <td><?php echo e(@$value->patient_type); ?></td>
                                <td><?php echo e(@$value->opd_details_data->case_id); ?></td>
                                <td><?php echo e(date('d-m-Y h:i A',
                                    strtotime(@$value->appointment_date))); ?></td>
                                <td> <?php echo e(@$value->department_details->department_name); ?>

                                </td>
                                <td><?php echo e(@$value->doctor->first_name); ?>

                                    <?php echo e(@$value->doctor->last_name); ?></td>
                                <td>
                                    <?php echo e(@$value->visit_type); ?>

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
<script>
    var xValues = ["No of Patient"];
    var yValues = ['<?php echo $i ?>'];
    var barColors = [
      "#1e7145"
    ];
    
    new Chart("myChart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/report/opd_patient_report.blade.php ENDPATH**/ ?>