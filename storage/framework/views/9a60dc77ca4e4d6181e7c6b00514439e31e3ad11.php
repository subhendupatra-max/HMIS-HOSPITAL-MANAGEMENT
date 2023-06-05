
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Medicine Stock Details</div>
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
                                        <?php echo e(@$medicine_details->medicine_names->medicine_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Medicine Catagory </span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->medicine_names->catagory_name->medicine_catagory_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Store Room</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->medicine_store_room->name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Unit</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->medicine_unit->medicine_unit_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Batch No</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->batch_no); ?>

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
                                        <span class="font-weight-semibold w-50">Medicine Expiry Date</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->exp_date); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Quantity</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->qty); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Mrp</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->mrp); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Discount</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->discount); ?>


                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Amount</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <?php echo e(@$medicine_details->amount); ?>

                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/medicine/medicine-stock-details.blade.php ENDPATH**/ ?>