
<?php $__env->startSection('content'); ?>


<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Purchase Order Details
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Print Purchase Order')): ?>
                        <a href="<?php echo e(route('po-print-inven',['po_id'=> base64_encode($po_list->po_id) ])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Send PO with feedback form')): ?>
                        <a href="#" class="btn btn-primary btn-sm " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope"></i> Mail <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item" href="<?php echo e(route('send-po-feedback-inven',['po_id' =>base64_encode($po_list->po_id) ,'vendor_id'=> base64_encode($po_list->vendor_id) ])); ?>"><i class="fa fa-envelope"></i> PO Send to Vendor With Feedback Form</a>
                        </div>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission on po section')): ?>
                        <a href="#" class="btn btn-primary btn-sm " data-target="#modaldemo1241" data-toggle="modal"><i class="fa fa-user"> Permission</i></a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('New Vendor Add in PO section')): ?>
                        <?php if(!empty($po_list->po_status >= 18)): ?>
                        <a class="btn btn-primary btn-sm " data-target="#modaldemo3fgfg" data-toggle="modal" href="#"><i class="fa fa-list"></i> Vendors/Quatations</a>
                        <?php endif; ?>
                        <?php endif; ?>


                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- ================================= Message ======================================== -->
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <!-- ================================= Message ======================================== -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view requisition')): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view requisition details')): ?>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="requisition_header">Workshop : </span><span class="requisition_text"><?php echo e(@$po_list->workshop_name); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Purchase Order No. : </span><span class="requisition_text"><?php echo e($po_list->po_prefix); ?><?php echo e(@$po_list->po_id); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Purchase Order Date : </span><span class="requisition_text"><?= date('d-m-Y h:i', strtotime($po_list->po_date)); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Generated By : </span><span class="requisition_text"><?php echo e(@$po_list->first_name); ?> <?php echo e(@$po_list->last_name); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Vendor : </span><span class="requisition_text"><?php echo e(@$po_list->vendor_name); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Note : </span><span class="requisition_text"><?php echo e(@$po_list->note); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_text"><?php echo @$po_list->status; ?></span>
                            </div>
                        </div>

                        <div style="padding: 26px 0px 0px 0px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('save feedback')): ?>
                                        <?php if($po_list->po_status == 13 || $po_list->po_status == 19): ?>
                                        <a class="btn btn-primary btn-sm" data-target="#modaldemo3" data-toggle="modal" href="#"><i class="fa fa-envelope"></i> Upload Feedback</a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(!empty($po_list->feedback)): ?>
                                        <a href="<?php echo e(asset('public/inventory-po/feedback/')); ?>/<?php echo e($po_list->feedback); ?>" target="_blank" style="color: blue;font-size: 15px;"><i class="fa fa-eye"><b> View Feedback</b></i></a>
                                        <?php endif; ?>
                                    </div>

                                    <?php if(!empty($po_list->feedback)): ?>
                                    <div class="col-md-6">
                                        <span data-toggle="tooltip-primary" data-placement="top" title="Upload Expected Delivary Date">
                                            <?php if($po_list->po_status > 11 && $po_list->po_status < 15 || $po_list->po_status == 19): ?>
                                                <a class="btn btn-primary btn-sm" data-target="#modaldemo12" data-toggle="modal" href="#"><i class="fa fa-calendar"></i></a></span>
                                        <?php endif; ?>
                                        <?php if(!empty($po_list->expected_delivery_date)): ?>
                                        <span class="requisition_header">Expected Delivary Date : </span><span class="requisition_text"><?= date('d-m-Y', strtotime($po_list->expected_delivery_date)); ?></span>
                                        <?php endif; ?>

                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $qr_details = 'PO No. - ' . $po_list->po_prefix . '' . $po_list->po_id . ' , PO Date - ' . date('d-m-Y h:i', strtotime($po_list->date)) . ' , Generated By - ' . $po_list->first_name; ?>
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
                            <th>Requisition Id</th>
                            <th>Item Name</th>
                            <th>Part No</th>
                            <th>HSN No.</th>
                            <th>Brand</th>
                            <th>Manufacturer</th>
                            <th>Quantity</th>
                            <th>GST</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($po_item) && $po_item != ''): ?>
                        <?php $__currentLoopData = $po_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($loop->iteration); ?></th>
                            <td><?php echo e(@$item->req_id); ?></td>
                            <td><?php echo e(@$item->item_name); ?><br>(<?php echo e(@$item->item_description); ?>)</td>
                            <td><?php echo e(@$item->part_no); ?></td>
                            <td><?php echo e(@$item->hsn_or_sac_no); ?></td>
                            <td><?php echo e(@$item->item_brand_name); ?></td>
                            <td><?php echo e(@$item->manufacture_name); ?></td>
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
                <div class="container mt-5" style="margin-left: -53px;">
                    <div class="d-flex justify-content-end">
                        <span class="bilpo_name">Total </span><span class="bilpo_value"> : <?php echo e(@$po_list->total); ?></span>

                    </div>
                    <?php if(!empty($po_list->extra_charges_name) && !empty($po_list->extra_charges_value)): ?>
                    <div class="d-flex justify-content-end">
                        <span class="bilpo_name"><?php echo e(@$po_list->extra_charges_name); ?></span><span class="bilpo_value"> : <?php echo e(@$po_list->extra_charges_value); ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-end" style="color:#0101c5">
                        <span class="bilpo_name">Grand Total </span><span class="bilpo_value"> : <?php echo e(@$po_list->grand_total); ?></span>

                    </div>
                </div>
            </div><!-- bd -->
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal" id="modaldemo3">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Feedback</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="<?php echo e(route('feedback-save-inven')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="po_id" value="<?php echo e($po_list->po_id); ?>">
                <div class="modal-body">
                    <div class="col-md-12">
                        <label class="form-label">Feedback <span class="text-danger">*</span></label>
                        <input type="file" value="<?php echo e(@$po_list->feedback); ?>" required name="feedback_file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-indigo" type="submit"><i class="fa fa-paper-plane"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo12">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Expected Delivery Date</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="<?php echo e(route('expected-delivery-date-inven')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="po_id" value="<?php echo e($po_list->po_id); ?>">
                <div class="modal-body">
                    <div class="col-md-12">
                        <label class="form-label">Expected Delivery Date <span class="text-danger">*</span></label>
                        <input type="date" value="<?php echo e(@$po_list->expected_delivery_date); ?>" required name="expected_delivery_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-indigo" type="submit"><i class="fa fa-paper-plane"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo1241">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Purchase Order</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="<?php echo e(route('po-status-change-inven')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="po_id" value="<?php echo e($po_list->po_id); ?>">
                <input type="hidden" name="vendor_id" value="<?php echo e($po_list->vendor_id); ?>">
                <div class="modal-body">
                    <div class="col-md-12">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search" name="status">
                            <option vlue="" disabled>Select One</option>
                            <option value="16" <?php if ($po_list->po_status == 16) {
                                                    echo "selected";
                                                } ?>>Purchase Order Holded</option>
                            <option value="15" <?php if ($po_list->po_status == 15) {
                                                    echo "selected";
                                                } ?>>Purchase Order Cancelled</option>
                            <option value="17" <?php if ($po_list->po_status == 17) {
                                                    echo "selected";
                                                } ?>>Purchase Order Confirmed</option>
                            <option value="18" <?php if ($po_list->po_status == 18) {
                                                    echo "selected";
                                                } ?>>Purchase Order Vendor Change</option>

                            <option value="20" <?php if ($po_list->po_status == 20) {
                                                    echo "selected";
                                                } ?>>New Vendor Approved</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-indigo" type="submit"><i class="fa fa-paper-plane"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ================================ vendor quatation details========================= -->
<div class="modal" id="modaldemo3fgfg">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Vendor/Quatation</h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Vendor Details</th>
                                <th>Quatation</th>
                                <th>Select Quatation</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($sl_vender)): ?>
                            <?php $__currentLoopData = $sl_vender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->vendor_name); ?>

                                    <br>
                                    <?php if($value->quatation_status == 1): ?>
                                    <a class="btn btn-pill btn-secondary btn-sm" href="#" type="button">Selected</a>
                                    <?php endif; ?>
                                    <?php if($value->quatation_status == 2): ?>
                                    <a class="btn btn-pill btn-warning btn-sm" href="#" type="button">Hold</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($value->vendor_quatation != null): ?>
                                    <a style="color:blue" href="<?php echo e(asset('public/quatation/')); ?>/<?php echo e(@$value->vendor_quatation); ?>" target="_blank"><i class="fa fa-eye"></i> View Quatation</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo e(route('vendor-select-change-afetr-po-inven')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <textarea name="note" class="form-control"><?php echo e(@$value->comment); ?></textarea>
                                        <input type="hidden" name="po_id" value="<?php echo e(@$po_list->po_id); ?>">
                                        <br>
                                        <select name="selection" class="form-control" required>
                                            <option value="">Select One</option>
                                            <option value="1" <?php if ($value->quatation_status == 1) {
                                                                    echo "Selected";
                                                                } ?>>Selected</option>
                                            <option value="2" <?php if ($value->quatation_status == 2) {
                                                                    echo "Selected";
                                                                } ?>>Hold</option>
                                        </select>
                                        <br>
                                        <!--       <select name="item_quataion" required class="select2-show-search" class="form-control">
                                            <option value="0" selected>All Item</option>
                                            <?php if(isset($requisition_item) && $requisition_item != ''): ?>
                                            <?php $__currentLoopData = $requisition_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($requisition->requisition_details_id); ?>"><?php echo e(@$requisition->item_name); ?><br>(<?php echo e(@$requisition->item_description); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select> -->

                                        <input type="hidden" name="vendor_id" value="<?php echo e($value->vendor_id); ?>">
                                        <input type="hidden" name="req_no" value="<?php echo e($value->req_id); ?>">
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Select</button>
                                        <br>
                                    </form>
                                </td>

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
<!-- ================================ vendor quatation details========================= -->

<!--  -->
<?php endif; ?>
</div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/purchase-order/po-details-in-inventory.blade.php ENDPATH**/ ?>