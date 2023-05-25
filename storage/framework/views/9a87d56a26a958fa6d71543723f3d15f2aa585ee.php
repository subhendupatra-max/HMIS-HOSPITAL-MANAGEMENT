
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold"><?php echo e(@$medicine_bill->all_patient_details->prefix); ?> <?php echo e(@$medicine_bill->all_patient_details->first_name); ?> <?php echo e(@$medicine_bill->all_patient_details->middle_name); ?> <?php echo e(@$medicine_bill->all_patient_details->last_name); ?>(
                        <?php echo e(@$medicine_bill->all_patient_details->patient_prefix); ?><?php echo e(@$medicine_bill->all_patient_details->id); ?>  ) <i class="fa fa-check-circle text-success"></i></h4>
                </div>

                <div class="col-md-6 text-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine bill')): ?>
                    <a href="<?php echo e(route('delete-medicine-bill',['bill_id'=>base64_encode($medicine_bill->id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i> Delete</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                    <a href="<?php echo e(route('edit-patient-details', base64_encode($medicine_bill->all_patient_details->id))); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print medicine bill')): ?>
                    <a href="<?php echo e(route('print-medicine-bill',['bill_id'=>base64_encode($medicine_bill->id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</a>
                    <?php endif; ?>
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
                                        <td class="py-2 px-5"><?php echo $medicine_bill->all_patient_details->gender; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Age </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php if($medicine_bill->all_patient_details->year != 0): ?>
                                            <?php echo e(@$medicine_bill->all_patient_details->year); ?>y
                                            <?php endif; ?>
                                            <?php if($medicine_bill->all_patient_details->month != 0): ?>
                                            <?php echo e(@$medicine_bill->all_patient_details->month); ?>m
                                            <?php endif; ?>
                                            <?php if($medicine_bill->all_patient_details->day != 0): ?>
                                            <?php echo e(@$medicine_bill->all_patient_details->day); ?>d
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Phone no </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$medicine_bill->all_patient_details->phone); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Guardian Name </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$medicine_bill->all_patient_details->guardian_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Guardian Contact No. </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$medicine_bill->all_patient_details->guardian_contact_no); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Local Guardian Name </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$medicine_bill->all_patient_details->local_guardian_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Local Guardian Contact No </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$medicine_bill->all_patient_details->local_guardian_contact_no); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Blood Group </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$medicine_bill->all_patient_details->blood_group); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Phone </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$medicine_bill->all_patient_details->phone); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Address </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo $medicine_bill->all_patient_details->address; ?>,<?php echo $medicine_bill->all_patient_details->pin_no; ?>,<?php echo @$medicine_bill->all_patient_details->_district->name; ?>,<?php echo @$medicine_bill->all_patient_details->_state->name; ?>,<?php echo @$medicine_bill->all_patient_details->_country->country_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Local Address </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo $medicine_bill->all_patient_details->address; ?>,<?php echo $medicine_bill->all_patient_details->pin_no; ?>,<?php echo @$medicine_bill->all_patient_details->local_district->name; ?>,<?php echo @$medicine_bill->all_patient_details->local_state->name; ?>,<?php echo @$medicine_bill->all_patient_details->local_country->country_name; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Identification details </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$medicine_bill->all_patient_details->identification_name); ?> : <?php echo e(@$medicine_bill->all_patient_details->identification_number); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Case Id </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$medicine_bill->case_id); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Bill Date </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(date('d-m-Y H:i a',strtotime($medicine_bill->bill_date))); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Bill No </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$medicine_bill->bill_prefix); ?><?php echo e(@$medicine_bill->id); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Total Bill Amount </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$medicine_bill->total_amount); ?> Rs
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Medicine Bill Details </h5>
                <div class="col-md-12">
                    <table class="table card-table table-vcenter text-nowrap table-default">
                        <thead>
                            <tr>
                                <th scope="col">Medicine Name</th>
                                <th scope="col">Medicine category</th>
                                <th scope="col">Batch No</th>
                                <th scope="col">Qty</th>
                                <th scope="col">CGST</th>
                                <th scope="col">SGST</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $medicine_bill_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(@$value->med_nam); ?></td>
                                <td><?php echo @$value->medicine_catagory_name; ?></td>
                                <td><?php echo e(@$value->medicine_batch); ?></td>
                                <td><?php echo @$value->qty; ?> <?php echo @$value->unit; ?></td>
                                <td><?php echo e(@$value->cgst); ?></td>
                                <td><?php echo e(@$value->sgst); ?></td>
                                <td><?php echo @$value->amount; ?> Rs</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/generate-bill/bill-details.blade.php ENDPATH**/ ?>