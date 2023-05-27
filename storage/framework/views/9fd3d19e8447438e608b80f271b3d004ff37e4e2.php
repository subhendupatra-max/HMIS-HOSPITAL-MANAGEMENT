
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Ipd Biliing Report</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="<?php echo e(route('fetch-ipd-billing-report')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12">
                                    <div class="row">

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
                                <th scope="col">Bill Id</th>
                                <th scope="col">Patient Name </th>
                                <th scope="col">Bill Amount(Rs)</th>
                                <th scope="col">Billing Date</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col"> Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $due = 0;
                            $payment = 0;
                            ?>
                            <?php if(@$billing_report[0]->id != null): ?>
                            <?php $__currentLoopData = $billing_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i = $i + $value->grand_total; ?>
                            <?php

                            if ($value->payment_status == 'Due') {
                                $due = $due + $value->grand_total;
                            } else {
                                $payment = $payment + $value->grand_total;
                            }
                            ?>
                            <tr>
                                <td><?php echo e(@$value->bill_prefix); ?><?php echo e(@$value->id); ?></td>
                                <td><?php echo e(@$value->patient_details->first_name); ?> <?php echo e(@$value->patient_details->middle_name); ?> <?php echo e(@$value->patient_details->last_name); ?></td>
                                <td><?php echo e(@$value->grand_total); ?></td>

                                <td><?php echo e(date('d-m-Y h:i A',strtotime(@$value->bill_date))); ?></td>
                                <td>
                                    <?php echo e(@$value->payment_status); ?>

                                </td>
                                <td>
                                    <?php echo e(@$value->status); ?>

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
<!-- <script>
    var xValues = ["Total Payment", "Total Due"];
    var yValues = ['<?php echo $payment ?>', '<?php echo $due ?>'];
    var barColors = [
        "#1e7145",
        "#b91d47",
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
</script> -->

<script>
    var xValues = ["Total Payment", "Total Due"];
    var yValues = ['<?php echo $payment ?>', '<?php echo $due ?>'];
    var barColors = [
        "#b91d47",
        "#00aba9",

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
        options: {
            title: {
                display: true,
                text: "Total Belling Report"
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/report/billing-report/ipd_billing_report.blade.php ENDPATH**/ ?>