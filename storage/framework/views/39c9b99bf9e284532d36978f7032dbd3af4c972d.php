
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Pharmacy Bill
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add pharmacy bill')): ?>
                        <a href="<?php echo e(route('generate-medicine-bill')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-invoice-dollar"></i> Generate Bill</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine stock')): ?>
                        <a href="<?php echo e(route('all-medicine-stock')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-capsules"></i> Medicine Stock</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine')): ?>
                        <a href="<?php echo e(route('all-medicine-listing')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pills"></i></i> Medicines</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Bill No</th>
                                <th class="border-bottom-0">Case Id </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Patient Name </th>
                                <th class="border-bottom-0">Amount</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine','delete medicine')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$medicine_bill): ?>
                            <?php $__currentLoopData = $medicine_bill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$value->bill_prefix); ?><?php echo e(@$value->id); ?></td>
                                    <td><?php echo e(@$value->case_id); ?></td>
                                    <td><?php echo e(date('d-m-Y h:i a',strtotime($value->bill_date))); ?></td>
                                    <td><?php echo e(@$value->all_patient_details->prefix); ?> <?php echo e(@$value->all_patient_details->first_name); ?> <?php echo e(@$value->all_patient_details->middle_name); ?> <?php echo e(@$value->all_patient_details->last_name); ?><br>
                                        <?php echo e(@$value->all_patient_details->patient_prefix); ?><?php echo e(@$value->all_patient_details->id); ?>

                                    </td>
                                    <td><?php echo e(@$value->total_amount); ?></td>
                                    <td>d</td>
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
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/generate-bill/generate-bill-listing.blade.php ENDPATH**/ ?>