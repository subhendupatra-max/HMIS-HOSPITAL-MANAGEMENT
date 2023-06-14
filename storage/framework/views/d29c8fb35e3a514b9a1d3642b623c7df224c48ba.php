
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Billing Summery</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">


                <div class="col-lg-12 col-xl-12">
                    <div class="options px-5 pt-1  border-bottom pb-3">
                        <div class="row">
                            
                            <div class="options px-5 pt-5  border-right pb-3">
                                <form method="post" action="<?php echo e(route('summery-bill-pharmacy')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <select class="form-control  select2-show-search" name="case_id" required>
                                                <option value="">Search Case Id...</option>
                                                <?php if(isset($case_id)): ?>
                                                <?php $__currentLoopData = $case_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(@$item->id); ?>">
                                                    <?php echo e($item->id); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php $__errorArgs = ['case_id'];
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

                                        <div class="col-md-12 mb-2">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            

                            <?php if(isset($patient_details_information)): ?>
                            


                            
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="options px-5 pt-1  border-bottom pb-3">

                        <div class="row">

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            
                                            <!-- <th scope="col">Name</th> -->
                                            <th scope="col">Name</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Batch No</th>
                                            <th scope="col">Expiry Date</th>
                                            <th scope="col">MRP
                                            </th>
                                            <th scope="col">Sale Price</th>
                                            <th scope="col">Qty
                                            </th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">CGST
                                            <th scope="col">SGST
                                            </th>
                                            <th scope="col">IGST
                                            </th>
                                            <th scope="col">Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if(@$medicine_billing[0]->id != null): ?>
                                        <?php $__currentLoopData = $medicine_billing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>

                                            <td> <?php echo e(@$value->all_patient_details->first_name); ?> <?php echo e(@$value->all_patient_details->middle_name); ?> <?php echo e(@$value->all_patient_details->last_name); ?> </td>

                                            <td> <?php echo e(@$value->section); ?> </td>

                                            <td> <?php echo e(@$value->medicine_billing_details->medicine_batch); ?> </td>
                                            <td> <?php echo e(@$value->medicine_billing_details->medicine_expiry_date); ?> </td>
                                            <td> <?php echo e(@$value->medicine_billing_details->mrp); ?> </td>

                                            <td> <?php echo e(@$value->medicine_billing_details->sale_price); ?> </td>

                                            <td> <?php echo e(@$value->medicine_billing_details->qty); ?> </td>

                                            <td> <?php echo e(@$value->medicine_billing_details->unit_name->medicine_unit_name); ?> </td>

                                            <td> <?php echo e(@$value->medicine_billing_details->cgst); ?> </td>
                                            <td> <?php echo e(@$value->medicine_billing_details->sgst); ?> </td>
                                            <td> <?php echo e(@$value->medicine_billing_details->igst); ?> </td>
                                            <td> <?php echo e(@$value->medicine_billing_details->amount); ?> </td>

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
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/summery-bill/listing-summery-bill.blade.php ENDPATH**/ ?>