
<?php $__env->startSection('content'); ?>

<?php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Item Issue Details
            </div>
        </div>

        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="requisition_header">Workshop : </span><span class="requisition_text"><?php echo e(@$item_issue->store_room_details->item_store_room); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Issued By. : </span><span class="requisition_text"><?php echo e(@$item_issue->issue_by_details->first_name); ?><?php echo e(@$item_issue->issue_by_details->last_name); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Issue To : </span><span class="requisition_text"><?php echo e(@$item_issue->issue_by_details->first_name); ?><?php echo e(@$item_issue->issue_by_details->last_name); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Generated By : </span><span class="requisition_text"><?php echo e(@$item_issue->generated_by_details->first_name); ?><?php echo e(@$item_issue->generated_by_details->last_name); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Issue Date : </span><span class="requisition_text"><?php echo e(@$item_issue->issue_date); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Note : </span><span class="requisition_text"><?php echo e(@$item_issue->note); ?></span>
                            </div>

                        </div>

                    </div>
                    <?php $qr_details = 'Issue No. - ' . @$item_issue->issue_prefix . '' . @$item_issue->id . ' , Issue Date - ' . date('d-m-Y h:i', strtotime(@$item_issue->issue_date)) . ' , Generated By - ' . @$grm_list->generated_by_details->first_name . @$grm_list->generated_by_details->last_name; ?>
                    <div class="col-md-4">
                        <div class="col-md-6">
                            <?php echo QrCode::size(100)->generate($qr_details); ?>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Item Name</th>
                            <th>Brand</th>
                            <th>Manufacturer</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($issue_item) && $issue_item != ''): ?>
                        <?php $__currentLoopData = $issue_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($loop->iteration); ?></th>
                            <td><?php echo e(@$item->item_details->item_name); ?><br>(<?php echo e(@$item->item_details->item_description); ?>)</td>
                            <td><?php echo e(@$item->item_details->fetch_brand_name->item_brand_name); ?></td>
                            <td><?php echo e(@$item->item_details->fetch_manufacture_name->manufacture_name); ?></td>
                            <td><?php echo e(@$item->quantity); ?> <?php echo e(@$item->unit_details->units); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <hr>

            </div><!-- bd -->
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/item-issue/item-issue-details.blade.php ENDPATH**/ ?>