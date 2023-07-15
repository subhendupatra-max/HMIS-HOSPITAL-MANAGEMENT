
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Medicine Details</div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Name</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->medicine_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Medicine Catagory </span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->catagory_name->medicine_catagory_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Company</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->medicine_company); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Tax</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->tax); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Note</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->note); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Medicine Composition</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->medicine_composition); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Group</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->medicine_group); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Min Level</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->min_level); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Unit</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->unit_name->medicine_unit_name); ?>


                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Medicine Photo</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php if(@$medicine_details->medicine_photo != null): ?>
                                        <img src="<?php echo e(asset('public/assets/images/medicine')); ?>/<?php echo e(@$medicine_details->medicine_photo); ?>" style="width: 50px;  height: 40px;">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50 text-success">Avilable Stock</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <span class="text-success"><?php echo e(@$avilable_stock); ?></span>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <div class="card-body p-0 border-top">
            <div class="col-md-12">
                <div class="btn-list p-3">
                    <a class="btn btn-success btn-sm" href="<?php echo e(route('medicine-stock-details',['medicine_id'=>$medicine_details->id])); ?>"><i class="fa fa-capsules"></i> Medicine Stock</a>
                    <a class="btn btn-danger btn-sm" href="<?php echo e(route('bad-medicine-details',['medicine_id'=>$medicine_details->id])); ?>"><i class="fa fa-certificate"></i> Medicine Bad Stock</a>
                </div>
            </div>
        </div>

        <?php if(@$status == 'good_medicine'): ?>
        <div class="card-body">
            <h5>Medicine Stock Details</h5>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Batch No</th>
                                <th class="border-bottom-0">Expire Date</th>
                                <th class="border-bottom-0">QTY</th>
                                <th class="border-bottom-0">MRP</th>
                                <th class="border-bottom-0">Discount</th>
                                <th class="border-bottom-0">Purchase Rate</th>
                                <th class="border-bottom-0">Sale Rate</th>
                                <th class="border-bottom-0">CGST</th>
                                <th class="border-bottom-0">SGST</th>
                                <th class="border-bottom-0">IGST</th>
                                <th class="border-bottom-0">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$medicine_details_stock[0]->id != null): ?>
                            <?php $__currentLoopData = $medicine_details_stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(@$value->batch_no); ?></td>
                                <td><?php echo e(@$value->exp_date); ?></td>
                                <td><?php echo e(@$value->qty); ?></td>
                                <td><?php echo e(@$value->mrp); ?></td>
                                <td><?php echo e(@$value->discount); ?></td>
                                <td><?php echo e(@$value->p_rate); ?></td>
                                <td><?php echo e(@$value->s_rate); ?></td>
                                <td><?php echo e(@$value->cgst); ?></td>
                                <td><?php echo e(@$value->sgst); ?></td>
                                <td><?php echo e(@$value->igst); ?></td>
                                <td><?php echo e(@$value->amount); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <?php endif; ?>



        <?php if(@$status == 'bad_medicine'): ?>
        <div class="card-body">
            <div class="card-header">

                <div class="col-md-12 row">
                    <div class="col-md-6 card-title">
                        Expiry Medicine Details
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('add-bad-medicine',['medicine_id'=>$medicine_details->id])); ?>"><i class="fa fa-plus"></i> Add Bad Medicine</a>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Batch No</th>
                                <th class="border-bottom-0">Qty</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$medicine_bad_stock[0]->id != null): ?>
                            <?php $__currentLoopData = $medicine_bad_stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->batch_no); ?></td>
                                <td><?php echo e($value->qty); ?></td>
                   
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/medicine/medicine-details.blade.php ENDPATH**/ ?>