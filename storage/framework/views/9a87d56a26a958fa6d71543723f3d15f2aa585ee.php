
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-2">
                        <div class="row">

                                <a class="btn btn-primary btn-sm mb-2" href=""><i class="fa fa-edit"></i> Edit</a>

                                <a class="btn btn-primary btn-sm ml-2 mb-2" href=""><i class="fa fa-trash"></i> Delete</a>

                        </div>
                    </div>
                </div>
                <hr class="ipd_header_border">
                <div class="row">
                    <div class="col-md-6">
                        <span class="head_name">Patient Name </span> : <span
                            class="value_name"><?php echo e(@$medicine_bill->all_patient_details->prefix); ?> <?php echo e(@$medicine_bill->all_patient_details->first_name); ?> <?php echo e(@$medicine_bill->all_patient_details->middle_name); ?> <?php echo e(@$medicine_bill->all_patient_details->last_name); ?>(
                            <?php echo e(@$medicine_bill->all_patient_details->patient_prefix); ?><?php echo e(@$medicine_bill->all_patient_details->id); ?>  )</span>
                    </div>
                    <div class="col-md-3">
                        <span class="head_name">Patient Age</span> : <span
                            class="value_name"><?php echo e(@$medicine_bill->all_patient_details->year); ?></span>
                    </div>
                    <div class="col-md-3">
                        <span class="head_name"> Gender</span> : <span
                            class="value_name"><?php echo e(@$medicine_bill->all_patient_details->gender); ?></span>
                    </div>
                </div>
               
                <hr class="ipd_header_border ">
                <?php if(isset($medicine_bill_details[0]->medicine_name)): ?>
                <div class="table-responsive mt-5">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Medicine Name</th>
                                <th scope="col">Medicine category</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $medicine_bill_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$value->medicine_name); ?></td>
                                    <td><?php echo @$value->medicine_catagory_name; ?></td>
                                    <td><?php echo @$value->qty; ?> <?php echo @$value->unit; ?></td>
                                    <td><?php echo @$value->amount; ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/generate-bill/bill-details.blade.php ENDPATH**/ ?>