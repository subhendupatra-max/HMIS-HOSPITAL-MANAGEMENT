
<?php $__env->startSection('content'); ?>
<?php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
<div class="card">
    <div class="card-header">
        <div class="card-title">
            Item Details
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <span class="requisition_header">Item Name : </span><span class="requisition_text"><?php echo e(@$item_details->item_name); ?></span>
                    </div>
                    <div class="col-md-12">
                        <span class="requisition_header">Brand : </span><span class="requisition_text"><?php echo e(@$item_details->brand_name); ?></span>
                    </div>
                    <div class="col-md-12">
                        <span class="requisition_header">Manufacturer : </span><span class="requisition_text"><?php echo e(@$item_details->manufacturar_name); ?></span>
                    </div>
                    <div class="col-md-12">
                        <span class="requisition_header">HSN or SAC No : </span><span class="requisition_text"><?php echo e(@$item_details->hsn_or_sac_no); ?></span>
                    </div>
                    <div class="col-md-12">
                        <span class="requisition_header">Stored : </span><span class="requisition_text"><?php echo @$item_details->stored; ?></span>
                    </div>
                    <div class="col-md-12">
                        <span class="requisition_header">Uses : </span><span class="requisition_text"><?php echo @$item_details->uses; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode($item_details->product_code, $generatorPNG::TYPE_CODE_128))); ?>"><br><?php echo e($item_details->product_code); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>GST</th>
                                <th>Rate</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($item_stock_details) && $item_stock_details != ''): ?>
                            <?php $__currentLoopData = $item_stock_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $unit = DB::table('item_units')->where('id',$item->unit_id)->first();
                                ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e(@$item->gst); ?></td>
                                <td><?php echo e(@$item->rate); ?></td>
                                <td><?php echo e(@$item->total_qty); ?> <?php echo e($unit->units); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!--  item details -->
                </div>
            </div>
            <br>
            <hr>
    <div class="d-md-flex">
        <div class="">
            <div class="panel panel-primary tabs-style-4">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab21" class="active" data-toggle="tab"><i class="fe fe-airplay"></i> Stock</a></li>
                            <li><a href="#tab22" data-toggle="tab"><i class="fe fe-package"></i> Return</a></li>
                   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabs-style-4">
            <div class="panel-body tabs-menu-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab21">
                        <h5>Stock Details</h5>
                     <div class="table-responsive"> 
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>GRM ID</th>
                                <th>PO ID</th>
                                <th>Entry Date</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($item_stock_report) && $item_stock_report != ''): ?>
                            <?php $__currentLoopData = $item_stock_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(url('grm-details')); ?>/<?php echo e(base64_encode($items->grmId)); ?>"  style="color: blue;"><?php echo e(@$items->grm_prefix); ?><?php echo e(@$items->grmId); ?></a></td>
                                <td><a href="<?php echo e(url('purchase-order-details')); ?>/<?php echo e(base64_encode($items->p_id)); ?>"  style="color: blue;"><?php echo e(@$items->po_prefix); ?><?php echo e(@$items->p_id); ?></a></td>
                                <td><?= date('d-m-Y',strtotime($items->grm_date)); ?></td>
                                 <td><?php echo e($items->quantity); ?> <?php echo e($items->units); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!--  item details -->
                </div>
                    </div>
                    <div class="tab-pane" id="tab22">
                        <h5>Return Details</h5>
                    <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Return ID</th>
                                <th>PO ID</th>
                                <th>Rejection Date</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($item_return_report) && $item_return_report != ''): ?>
                            <?php $__currentLoopData = $item_return_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(url('return-details')); ?>/<?php echo e(base64_encode($items->retId)); ?>"  style="color: blue;"><?php echo e(@$items->return_prefix); ?><?php echo e(@$items->retId); ?></a></td>
                                <td><a href="<?php echo e(url('purchase-order-details')); ?>/<?php echo e(base64_encode($items->p_id)); ?>"  style="color: blue;"><?php echo e(@$items->po_prefix); ?><?php echo e(@$items->p_id); ?></a></td>
                                <td><?= date('d-m-Y',strtotime($items->rejection_date)); ?></td>
                                <td><?php echo e($items->quantity); ?> <?php echo e($items->units); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!--  item details -->
                </div>
                    </div>
                  
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/item-stock-details.blade.php ENDPATH**/ ?>