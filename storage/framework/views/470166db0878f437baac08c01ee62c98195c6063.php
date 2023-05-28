
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Bill Details
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" href="" data-placement="top" data-toggle="tooltip" title="Edit Bill"><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-primary btn-sm" href="" data-placement="top" data-toggle="tooltip" title="Print Bill Copy"><i class="fa fa-print"></i> Print</a>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                            
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('OPD.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                
                <div class="col-lg-4 col-xl-4 border-right">
                    <div class="mt-2">
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Bill No : </span><span class="requisition_text"><?php echo e(@$bill_details->bill_prefix); ?><?php echo e(@$bill_details->id); ?></span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Bill Date : </span><span class="requisition_text">
                                <?= date('d-m-Y h:i', strtotime($bill_details->bill_date)) ?>
                            </span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Created By : </span><span class="requisition_text"><?php echo e(@$bill_details->created_details->first_name); ?>

                                <?php echo e(@$bill_details->created_details->last_name); ?></span>
                        </div>

                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Payment Status </span><span class="badge badge-success"><?php echo e($bill_details->payment_status); ?></span>
                        </div>

                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Discount Status </span><span class="badge badge-success"><?php echo e($bill_details->discount_status); ?></span>
                        </div>
                        <?php if($bill_details->discount_status != 'Not applied'): ?>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Requested Discount Amount : </span><span style="color:red">
                                <?php echo e($discount_details->discount->asking_discount_amount); ?> <?php echo e($discount_details->discount->discount_type == 'flat' ? 'Rs' : '%'); ?></span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Requested Discount Date </span><span
                                class="requisition_text"> :
                                <?= date('d-m-Y h:i', strtotime($discount_details->discount->asking_discount_time)) ?>
                            </span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Requested Discount By </span><span
                                class="requisition_text"> : <?php echo e($discount_details->discount->request_by_details->first_name); ?> <?php echo e($discount_details->discount->request_by_details->last_name); ?> </span>
                        </div>
                        <?php endif; ?>
                        <?php if($bill_details->discount_status == 'Approved'): ?>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Appoved Discount Amount </span><span
                                class=requisition_text"> : <?php echo e($discount_details->discount->given_discount_amount); ?> <?php echo e($discount_details->discount->given_discount_type == 'flat' ? 'Rs' : '%'); ?></span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Appoved Discount Date </span><span
                                class="requisition_text"> :
                                <?= date('d-m-Y h:i', strtotime($discount_details->discount->given_discount_time)) ?>
                            </span>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <span class="requisition_header">Appoved Discount By </span><span class="requisition_text">
                                : <?php echo e(@$discount_details->discount->given_by_details->first_name); ?> <?php echo e(@$discount_details->discount->given_by_details->last_name); ?> </span>
                        </div>
                        <?php endif; ?>



                    </div>
                </div>
                

                
                <div class="col-lg-8 col-xl-8 border-right">
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">

                            <div class="table-responsive">

                                <table class="table table-striped card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Charge Name</th>
                                            <th>Charge Amount</th>
                                            <th>Qty</th>
                                            <th>Tax</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($patient_charge_details) && $patient_charge_details != ''): ?>
                                        <?php $__currentLoopData = $patient_charge_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($loop->iteration); ?></th>
                                            <td><?php echo e(@$charge->charges_name); ?></td>
                                            <td><?php echo e(@$charge->standard_charges); ?></td>
                                            <td><?php echo e(@$charge->qty); ?></td>
                                            <td><?php echo e(@$charge->tax); ?></td>
                                            <td><?php echo e(@$charge->amount); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <?php if(isset($medicine_bill_details) && $medicine_bill_details != ''): ?>
                                <?php if(@$medicine_bill_details[0]->id != null): ?>
                                <hr>

                                <span><b>Medicine Bill</b></span>
                                <table class="table table-striped card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bill Id</th>
                                            <th>Bill Date</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $medicine_bill_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine_bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($loop->iteration); ?></th>
                                            <td><?php echo e(@$medicine_bill->bill_prefix); ?><?php echo e(@$medicine_bill->id); ?></td>
                                            <td><?php echo e(@date('d-m-Y h:i A',strtotime($medicine_bill->bill_date))); ?></td>
                                            <td><?php echo e(@$medicine_bill->total_amount); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                                <?php endif; ?>
                                <?php endif; ?>
                                <hr>
                                <div class="container mt-5" style="margin-left: -53px;">
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                                            <?php echo e(@$bill_details->total_amount); ?> Rs</span>
                                    </div>
                                    <?php if($bill_details->discount_status == 'Approved' ): ?>
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Discount </span><span class="bilpo_value"> :
                                            <?php echo e(@$discount_details->discount->given_discount_amount); ?> <?php echo e(@$discount_details->discount->given_discount_type == 'flat' ? 'Rs': '%'); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Tax </span><span class="bilpo_value"> :
                                            <?php echo e(@$bill_details->tax); ?> %</span>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <span class="bilpo_name">Grand Total </span><span class="bilpo_value"> :
                                            <?php echo e(number_format((float) $bill_details->grand_total, 2, '.', '')); ?>

                                            Rs</span>
                                    </div>

                                </div>
                            </div><!-- bd -->

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/OPD/billing/billing-details.blade.php ENDPATH**/ ?>