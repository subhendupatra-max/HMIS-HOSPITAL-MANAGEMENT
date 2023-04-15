
<?php $__env->startSection('content'); ?>


<?php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
?>



    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Rejection Item Details
                    </div>  
                </div>
         
            <div class="card-body"> 
                <div class="col-md-12">
                    <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="requisition_header">Workshop : </span><span class="requisition_text"><?php echo e(@$rejection_list->workshop_name); ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Rejection Date : </span><span class="requisition_text"><?= date('d-m-Y h:i',strtotime(@$rejection_list->rejection_date)); ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Rejection No. : </span><span class="requisition_text"><?php echo e(@$rejection_list->return_prefix); ?><?php echo e(@$rejection_list->return_id); ?></span>
                        </div>

                        <div class="col-md-6">
                            <span class="requisition_header">Generated By : </span><span class="requisition_text"><?php echo e(@$rejection_list->name); ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Materials Rec. Date : </span><span class="requisition_text"><?php echo date('d-m-Y h:i',strtotime(@$rejection_list->material_rec_date)) ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Bill Rec. Date : </span><span class="requisition_text"><?php echo date('d-m-Y h:i',strtotime(@$rejection_list->bill_rec_date)) ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Challan No. : </span><span class="requisition_text"><?php echo @$rejection_list->challan_no; ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Challan Date : </span><span class="requisition_text"><?php echo date('d-m-Y h:i',strtotime(@$rejection_list->challan_date)) ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Invoice Date : </span><span class="requisition_text"><?php echo date('d-m-Y h:i',strtotime(@$rejection_list->invoice_date)) ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Invoice No : </span><span class="requisition_text"><?php echo @$rejection_list->invoice_no; ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">Invoice Value : </span><span class="requisition_text"><?php echo @$rejection_list->invoice_value; ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="requisition_header">PO. Value : </span><span class="requisition_text"><?php echo @$rejection_list->po_value; ?></span>
                        </div>
                  
                        <div class="col-md-12">
                            <span class="requisition_header">Note : </span><span class="requisition_text"><?php echo e(@$rejection_list->note); ?></span>
                        </div>  
                        <div class="col-md-6">
                            <a href="<?php echo e(asset('Challan_copy/')); ?>/<?php echo e(@$rejection_list->challan_copy); ?>" target="_blank" style="color: blue;font-size: 15px;"><i class="fa fa-eye"><b> View Challan</b></i></a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo e(asset('invoice_copy/')); ?>/<?php echo e(@$rejection_list->invoice_copy); ?>" target="_blank" style="color: blue;font-size: 15px;"><i class="fa fa-eye"><b> View Invoice</b></i></a>
                        </div> 
 
                    </div>

                   
                </div>
                <?php $qr_details = 'GRM No. - '.@$rejection_list->return_prefix.''.@$rejection_list->return_id .' , GRM Date - '.date('d-m-Y h:i',strtotime(@$rejection_list->rejection_date)).' , Generated By - '.@$rejection_list->name ; ?>
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
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Brand</th>
                                <th>Manufacturer</th>
                                <th>Quantity</th>
                                <th>GST</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($rejection_item) && $rejection_item != ''): ?>
                            <?php $__currentLoopData = $rejection_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e(@$item->req_id); ?></td>
                                <td><?php echo e(@$item->item_name); ?><br>(<?php echo e(@$item->item_description); ?>)</td>
                                <td><?php echo e(@$item->brand_name); ?></td>
                                <td><?php echo e(@$item->manufacturar_name); ?></td>
                                <td><?php echo e(@$item->quantity); ?> <?php echo e(@$item->units); ?></td>
                                <td><?php echo e(@$item->gst); ?></td>
                                <td><?php echo e(@$item->rate); ?></td>
                                <td><?php echo e(@$item->amount); ?></td>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/purchase-order/return-item-details.blade.php ENDPATH**/ ?>