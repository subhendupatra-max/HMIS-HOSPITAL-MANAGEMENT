
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold"><?php echo e(@$patient_details->prefix); ?> <?php echo e(@$patient_details->first_name); ?> <?php echo e(@$patient_details->middle_name); ?> <?php echo e(@$patient_details->last_name); ?> ( <?php echo e(@$patient_details->patient_prefix); ?><?php echo e(@$patient_details->id); ?> ) <i class="fa fa-check-circle text-success"></i></h4>
                </div>

                <div class="col-md-6 text-right">
                </div>

            </div>
        </div>

        <div class="card-body p-0">
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Patient's Details </h5>
              
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Gender </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo $patient_details->gender; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Age </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php if($patient_details->year != 0): ?>
                                            <?php echo e(@$patient_details->year); ?>y
                                            <?php endif; ?>
                                            <?php if($patient_details->month != 0): ?>
                                            <?php echo e(@$patient_details->month); ?>m
                                            <?php endif; ?>
                                            <?php if($patient_details->day != 0): ?>
                                            <?php echo e(@$patient_details->day); ?>d
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Phone no </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$patient_details->phone); ?>

                                        </td>
                                    </tr>
                           
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Blood Group </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$patient_details->blood_group); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Phone </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$patient_details->phone); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Address </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo $patient_details->address; ?>,<?php echo $patient_details->pin_no; ?>,<?php echo @$patient_details->_district->name; ?>,<?php echo @$patient_details->_state->name; ?>,<?php echo @$patient_details->_country->country_name; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                  
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Case Id </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo $patient_details->case_id; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Section </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$radiology_patient_test_details->section); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Date </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@date('d-m-Y h:i A', strtotime($radiology_patient_test_details->date))); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Test Staus </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php if($radiology_patient_test_details->test_status == '0'): ?>
                                            <span class="badge badge-warning">Sample Not Collected</span>
                                            <?php else: ?>
                                            <span class="badge badge-success">Sample Collected</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Bill Status </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php if($radiology_patient_test_details->billing_status == '0'): ?>
                                            <span class="badge badge-warning">Billing Not Done</span>
                                            <?php elseif($radiology_patient_test_details->billing_status == '1'): ?>
                                            <span class="badge badge-warning">Billing Done</span>
                                            <?php else: ?>
                                            <span class="badge badge-warning">Charge Added</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr style="margin: 0px 0px 22px 0px !important;">
                <h5 class="font-weight-bold text-center">       <?php echo e(@$radiology_patient_test_details->test_details->test_name); ?>(<?php echo e(@$radiology_patient_test_details->test_details->short_name); ?>) </h5>
            <form action="<?php echo e(route('update-radiology-report')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="content" ><?php echo e(@$radiology_patient_test_details->description != null ? $radiology_patient_test_details->description : $radio_test->description); ?></textarea>
                </div>
                <input name="p_test_id" value="<?php echo e($p_id); ?>" type="hidden" />

                <div class="col-md-12">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap" >
                                <thead  class="bg-success text-white">
                                    <tr>
                                        <th class="text-white">Parameter Name</th>
                                        <th class="text-white">Referance Range</th>
                                        <th class="text-white">Unit</th>
                                        <th class="text-white">Result</th>
                                        <th class="text-white">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $radiologyParameterResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="id[]" value="<?php echo e($value->id); ?>" />
                                        <tr>
                                            <td><?php echo e(@$value->parameter_name); ?></td>
                                            <td><?php echo @$value->reference_range; ?>

                                            </td>
                                            <td><?php echo @$value->unit; ?></td>
                                            <td><input type="text" name="report_value[]" value="<?php echo e(@$value->report_value); ?>" required="" /></td>
                                            <td><textarea class="form-control" name="parameter_description[]"><?php echo e(@$value->parameter_description); ?></textarea></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center m-auto mb-4">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Save Test Result</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
    function result1(val){
            var parameter2 = ($('#parameter1').val()) * (10/100);
            $('#parameter2').val(parameter2); 
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/radiology/add-radiology-test-result-details.blade.php ENDPATH**/ ?>