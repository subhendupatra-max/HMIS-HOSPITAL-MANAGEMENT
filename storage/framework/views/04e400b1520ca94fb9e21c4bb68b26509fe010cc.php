
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Operaiton Report</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="<?php echo e(route('fetch-operation-report')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="discharge_status">Operation Catagory </label>
                                            <select name="operatoin_catagory" class="form-control select2-show-search" id="operatoin_catagory">
                                                <option value="">Select Operation Catagory</option>
                                                <?php $__currentLoopData = $operation_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $catagory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($catagory->id); ?>" <?php echo e(@$all_search_data['operatoin_catagory'] == $catagory->id ? 'selected':''); ?>><?php echo e($catagory->operation_catagory_name); ?>

                                                </option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['operatoin_catagory'];
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
                                            <label for="operation_name">Operation Name </label>
                                            <select name="operation_name" class="form-control select2-show-search" id="operation_name">
                                                <option value="">Select Operation Catagory</option>
                                                <?php $__currentLoopData = $operation_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $operation_ids): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($operation_ids->id); ?>" <?php echo e(@$all_search_data['operation_name'] == $operation_ids->id ? 'selected':''); ?>><?php echo e($operation_ids->operation_name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['operation_name'];
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
                                            <label for="operation_status">Operation Status </label>
                                            <select name="operation_status" class="form-control select2-show-search" id="operation_status">
                                                <option value="">Select Discharge Status</option>
                                                <?php $__currentLoopData = Config::get('static.main_operation_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $operation_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($operation_status); ?>" <?php echo e(@$all_search_data['operation_status'] == $operation_status ? 'selected':''); ?>><?php echo e($operation_status); ?>

                                                </option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['operation_status'];
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
                                            <label>To Date <span class="text-danger">*</span></label>
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
                                    <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i class="fa fa-search"></i> Search</button>
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
                                <th class="border-bottom-0">SL. No</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Operation Name</th>
                                <th class="border-bottom-0">Operation Department</th>
                                <th class="border-bottom-0">Operation Catagory </th>
                                <th class="border-bottom-0">Consultant Doctor</th>
                                <th class="border-bottom-0">Date From</th>
                                <th class="border-bottom-0">Date To</th>
                                <th class="border-bottom-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php if(@$operation_details[0]->operation_name != null): ?>
                            <?php $__currentLoopData = $operation_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($operation_detail->first_name); ?> <?php echo e($operation_detail->middle_name); ?> <?php echo e($operation_detail->last_name); ?></td>
                                <td> <?php echo e(@$operation_detail->operation_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->department_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->operation_catagory_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->doctor_first_name); ?> <?php echo e(@$operation_detail->doctor_last_name); ?> </td>
                                <td> <?php echo e(@$operation_detail->operation_date_from); ?> </td>
                                <td> <?php echo e(@$operation_detail->operation_date_to); ?> </td>

                                <td> <?php if($operation_detail->status == 'Pending'): ?>
                                    <span class="badge badge-warning"> <?php echo e($operation_detail->status); ?></span>
                                    <?php elseif($operation_detail->status == 'Complete'): ?>
                                    <span class="badge badge-success"> <?php echo e($operation_detail->status); ?></span>
                                    <?php else: ?>
                                    <span class="badge badge-secondary"> <?php echo e($operation_detail->status); ?></span>
                                    <?php endif; ?>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/report/operation-report.blade.php ENDPATH**/ ?>