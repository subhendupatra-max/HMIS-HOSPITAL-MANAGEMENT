
<?php $__env->startSection('content'); ?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <form action="<?php echo e(route('billing-summary')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row mt-5 ml-2">
                    <div class="form-group col-md-6">
                      
                        <input type="number" style="margin: 0px 0px 0px 0px;" class="form-control billsummary" id="uhid_no_case_id"
                            name="uhid_no_case_id" required placeholder="Patient's Bill Search">
                        <?php $__errorArgs = ['uhid_no_case_id'];
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
                    <div class="form-group col-md-5">
                        <select name="case_id_or_uhid_select" class="form-control">
                            <option value="">Select One...</option>
                            <option value="case_id">Case Id</option>
                            <option value="uhid">UHID</option>
                        </select>
                    </div>
                 
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-sm ml-6 mb-3"> <i class="fa fa-search"></i>
                    Search</button>
                </div>
              
            </form>
            </div>
        </div>
        <div class="col-lg-8">
        <?php if(@$uhid_no_case_id == null): ?>
            <div class="card">
                <img src="<?php echo e(asset('public/no_found_data/no_data.png')); ?>" alt="loader" width="400px"
                height="160px" style="margin: 146px 0px 210px 253px;">
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-header d-block">
                    <div class="row">
                        <div class="col-md-4 card-title">
                            Bill Details
                        </div>
                        <div class="col-md-8 text-right">
                            <div class="d-block">
                                
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('print-patient-bill',['bill_id'=>base64_encode($bill_details->id)])); ?>" data-placement="top" data-toggle="tooltip" title="Print Bill Copy"><i class="fa fa-print"></i> Print</a>
        
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('print-patient-payement-slip',['bill_id'=>base64_encode($bill_details->id)])); ?>" data-placement="top" data-toggle="tooltip" title="Print Payment Slip"><i class="fa fa-print"></i> Payment Slip</a>
        
                                <?php if($bill_details->payment_status == 'Due'): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('take Payment')): ?>
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('add-payment-bill',['bill_id'=>base64_encode($bill_details->id)])); ?>" data-placement="top" data-toggle="tooltip" title="add payment"><i class="fa fa-rupee"></i> Add Payment</a>
                                <?php endif; ?>
                                <?php endif; ?>
                   
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
        
                                <?php if($bill_details->payment_status != 'Due'): ?>
                                <div class="col-md-12">
                                    <img src="<?php echo e(asset('public/others/paid.png')); ?>" style="margin: 47px 0px 0px 125px;">
                                </div>
                                <?php endif; ?>
        
        
        
                            </div>
                        </div>
                        
        
                        
                        <div class="col-lg-8 col-xl-8 border-right">
                            
                            <div class="options px-5 pt-2  border-bottom pb-1">
                                <div class="row">
                                   
                                    <div class="table-responsive">
                                        <h5>Charge details</h5>
                                        <table class="table table-striped card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Charge Name</th>
                                                    <th>Charge Amount</th>
                                                    <th>Qty</th>
                                      
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
                             
                                                    <td><?php echo e(@$charge->amount); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="container mt-5" style="margin-left: -53px;">
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                                                    ₹ <?php echo e(@$bill_details->total_amount); ?> </span>
                                            </div>
                                            <?php if($bill_details->discount_status == 'Approved' ): ?>
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Discount </span><span class="bilpo_value"> :
                                                    <?php echo e(@$discount_details->discount->given_discount_amount); ?> <?php echo e(@$discount_details->discount->given_discount_type == 'flat' ? 'Rs': '%'); ?></span>
                                            </div>
                                            <?php endif; ?>
            
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Grand Total </span><span class="bilpo_value"> :
                                                    ₹ <?php echo e(number_format((float) $bill_details->grand_total, 2, '.', '')); ?>

                                                    </span>
                                            </div>
        
                                        </div>
                                        <h5>Payment details</h5>
                                        <table class="table table-striped card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Payment Id</th>
                                                    <th>Payment Date</th>
                                                    <th>Payment Amount</th>
                                                    <th>Payment Mode</th>
                                                    <th>Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $payment_total = 0; ?>
                                                <?php if(isset($payment_details) && $payment_details != ''): ?>
                                                <?php $__currentLoopData = $payment_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $payment_total += $payment->payment_amount;  ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                                    <td><?php echo e(@$payment->payment_prefix); ?><?php echo e(@$payment->id); ?></td>
                                                    <td><?php echo e(date('Y-m-d h:i A',strtotime(@$payment->payment_date))); ?></td>
                                                    <td><?php echo e(@$payment->payment_amount); ?></td>
                                                    <td><?php echo e(@$payment->payment_mode); ?></td>
                                                    <td><?php echo e(@$payment->note); ?></td>
                                                    <td>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit Payment')): ?>
                                                            <a class="text-success" href="<?php echo e(route('edit-bill-payment',base64_encode($payment->id))); ?>"><i class="fa fa-edit"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete Payment')): ?>
                                                        <a class="text-danger" href="<?php echo e(route('delete-bill-payment',base64_encode($payment->id))); ?>"><i class="fa fa-trash"></i></a>
                                                        <?php endif; ?>
                                              
                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="container mt-5" style="margin-left: -53px;">
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Total 0Paid </span><span class="bilpo_value"> :
                                                   ₹ <?php echo e(@$payment_total); ?> </span>
                                            </div>
                                         
                                        <?php if($bill_details->payment_status == 'Due'): ?>
                                        <?php $due_amount = $bill_details->grand_total - $payment_total  ?>
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Total Due </span><span class="bilpo_value"> :
                                                   ₹ <?php echo e(@$due_amount); ?> </span>
                                            </div>
                                        <?php endif; ?>
                                        </div>
                                  
                                    </div><!-- bd -->
                                </div>
        
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/bill_summary/bill-summary.blade.php ENDPATH**/ ?>