
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
        <?php if(true): ?>
        <?php echo $__env->make('pharmacy.medicine.medicine-bad-stock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(true): ?>
        <?php echo $__env->make('pharmacy.medicine.medicine-good-stock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/medicine/medicine-details.blade.php ENDPATH**/ ?>