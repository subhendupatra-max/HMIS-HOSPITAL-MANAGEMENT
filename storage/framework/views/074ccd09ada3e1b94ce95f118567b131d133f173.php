
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">EMG Patient Report</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="<?php echo e(route('fetch-emg-patient-report')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="medico_legal_case">Medico Legal Case <span
                                                    class="text-danger">*</span></label>
                                            <select name="medico_legal_case" class="form-control select2-show-search"
                                                id="medico_legal_case">
                                                <option value="">Medico Legal Case.....</option>
                                                <option value="yes" <?php echo e(@$all_search_data['medico_legal_case']=='yes'
                                                    ? 'selected' :''); ?>>Yes</option>
                                                <option value="no" <?php echo e(@$all_search_data['medico_legal_case']=='no'
                                                    ? 'selected' :''); ?>>No</option>
                                            </select>
                                            <?php $__errorArgs = ['medico_legal_case'];
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
                                                <option value="<?php echo e($patient_type); ?>"
                                                    <?php echo e(@$all_search_data['patient_type']=='Revisit' ? 'selected' :''); ?>>
                                                    <?php echo e($patient_type); ?></option>
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
                                        
                                        
                                        <div class="form-group col-md-4 addopdd">
                                            <label>From Date <span class="text-danger">*</span></label>
                                            <input type="date" name="from_date"
                                                value="<?php echo e(date(@$all_search_data['from_date'])); ?>" required />
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
                                            <label>To Date <span class="text-danger">*</span></label>
                                            <input type="date" name="to_date"
                                                value="<?php echo e(date(@$all_search_data['to_date'])); ?>" required />
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
                                <th scope="col">EMG Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Patient Type</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Department</th>
                                <th scope="col">Doctor</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php if(@$emg_patient_report[0]->id != null): ?>
                            <?php $__currentLoopData = $emg_patient_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <tr>
                                <td><?php echo e(@$value->emg_details_data->emg_prefix); ?><?php echo e(@$value->emg_details_data->id); ?></td>
                                <td><?php echo e(@$value->emg_details_data->all_patient_details->prefix); ?>

                                    <?php echo e(@$value->emg_details_data->all_patient_details->first_name); ?>

                                    <?php echo e(@$value->emg_details_data->all_patient_details->middle_name); ?>

                                    <?php echo e(@$value->emg_details_data->all_patient_details->last_name); ?>(<?php echo e(@$value->emg_details_data->all_patient_details->id); ?>)</td>
                                <td> <?php if(@$value->emg_details_data->all_patient_details->year != 0): ?>
                                    <?php echo e(@$value->emg_details_data->all_patient_details->year); ?>y
                                    <?php endif; ?>
                                    <?php if(@$value->emg_details_data->all_patient_details->month != 0): ?>
                                    <?php echo e(@$value->emg_details_data->all_patient_details->month); ?>m
                                    <?php endif; ?>
                                    <?php if(@$value->emg_details_data->all_patient_details->day != 0): ?>
                                    <?php echo e(@$value->emg_details_data->all_patient_details->day); ?>d
                                    <?php endif; ?></td>
                                <td><?php echo e(@$value->emg_details_data->all_patient_details->guardian_name); ?></td>
                                <td><?php echo e(@$value->emg_details_data->all_patient_details->phone); ?></td>
                                <td><?php echo e(@$value->patient_type); ?></td>
                                <td><?php echo e(@$value->emg_details_data->case_id); ?></td>
                                <td><?php echo e(date('d-m-Y h:i A',
                                    strtotime(@$value->appointment_date))); ?></td>
                                <td> <?php echo e(@$value->patient_department_details->department_name); ?>

                                </td>
                                <td><?php echo e(@$value->doctor->first_name); ?>

                                    <?php echo e(@$value->doctor->last_name); ?></td>

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
      "#dc3545"
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/report/emg_patient_report.blade.php ENDPATH**/ ?>