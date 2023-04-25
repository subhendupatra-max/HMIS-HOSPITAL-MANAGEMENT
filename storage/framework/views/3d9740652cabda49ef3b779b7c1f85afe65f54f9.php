
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-4 card-title">
                        Discount Details
                    </div>
                    <div class="col-md-8 text-right">
                        <div class="d-block">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row no-gutters">
                    
                    <div class="col-lg-4 col-xl-4 border-right">
                        <div class="mt-2">
                            <div class="col-md-12 mt-3 mb-3">
                                <span class="requisition_header">Patient details : </span><span
                                    class="requisition_text"><?php echo e($discount->patient_details->prefix . ' ' . $discount->patient_details->first_name . ' ' . $discount->patient_details->middle_name . ' ' . $discount->patient_details->last_name); ?><br><?php echo e($discount->patient_details->patient_prefix . ' ' . $discount->patient_details->id); ?></span>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <span class="requisition_header">Section : </span>
                                <?php if($discount->section == 'OPD'): ?>
                                    <span class="badge badge-success"><?php echo e($discount->section); ?></span>
                                <?php elseif($discount->section == 'IPD'): ?>
                                    <span class="badge badge-danger"><?php echo e($discount->section); ?></span>
                                <?php elseif($discount->section == 'EMG'): ?>
                                    <span class="badge badge-info"><?php echo e($discount->section); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-primary"><?php echo e($discount->section); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <span class="requisition_header">Discount Status : </span>
                                <?php if($discount->discount_status == 'Pending'): ?>
                                    <span class="badge badge-warning"><?php echo e($discount->discount_status); ?></span>
                                <?php elseif($discount->discount_status == 'Approved'): ?>
                                    <span class="badge badge-success"><?php echo e($discount->discount_status); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?php echo e($discount->discount_status); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <span class="requisition_header">Discount Requested By : </span><span
                                    class="requisition_text"><span
                                        class="requisition_text"><?php echo e($discount->request_by_details->first_name); ?>

                                        <?php echo e($discount->request_by_details->last_name); ?></span>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <span class="requisition_header">Discount Request Date : </span><span
                                    class="requisition_text"><span
                                        class="requisition_text"><?php echo e(date('d-m-Y h:i A', strtotime($discount->asking_discount_time))); ?></span>
                            </div>
                            <?php if($discount->discount_status == 'Approved'): ?>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Discount Approved By : </span><span
                                        class="requisition_text"><span
                                            class="requisition_text"><?php echo e($discount->request_by_details->first_name); ?>

                                            <?php echo e($discount->request_by_details->last_name); ?></span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Discount Approved Date : </span><span
                                        class="requisition_text"><span
                                            class="requisition_text"><?php echo e(date('d-m-Y h:i A', strtotime($discount->asking_discount_time))); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($discount->discount_status == 'Rejected'): ?>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Discount Rejected By : </span><span
                                        class="requisition_text"><span
                                            class="requisition_text"><?php echo e($discount->request_by_details->first_name); ?>

                                            <?php echo e($discount->request_by_details->last_name); ?></span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Discount Rejected Date : </span><span
                                        class="requisition_text"><span
                                            class="requisition_text"><?php echo e(date('d-m-Y h:i A', strtotime($discount->asking_discount_time))); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-12 mt-3 mb-3">
                                <a href="#" data-target="#modaldemo1" data-toggle="modal"
                                    class="btn btn-primary btn-sm">Give Discount</a>
                            </div>

                        </div>
                    </div>
                    

                    
                    <div class="col-lg-8 col-xl-8 border-right">
                        
                        <div class="options px-5 pt-2  border-bottom pb-1">
                            <div class="row">

                                <div class="table-responsive">
                                    <table class="table table-striped card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Bill Id</th>
                                                <th>Bill Date</th>
                                                <th>Bill Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t_bill = 0; ?>
                                            <?php if(isset($discount_details) && $discount_details != ''): ?>
                                                <?php $__currentLoopData = $discount_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill_deta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $t_bill = $t_bill + $bill_deta->bill_amount; ?>
                                                    <tr>
                                                        <th scope="row"><?php echo e($loop->iteration); ?></th>
                                                        <td><?php echo e(@$bill_deta->bill->bill_prefix); ?><?php echo e(@$bill_deta->bill->id); ?>

                                                        </td>
                                                        <td><?php echo e(date('d-m-Y h:i A', strtotime($bill_deta->bill->bill_date))); ?>

                                                        </td>
                                                        <td><?php echo e(@$bill_deta->bill_amount); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="container mt-5">
                                        <div class="d-flex ">
                                            <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                                                <?php echo e($t_bill); ?></span>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="d-flex ">
                                            <span class="bilpo_name">Requested Discount </span><span class="bilpo_value"> :
                                                <?php

                                                if ($discount->discount_type == 'percentage') {
                                                    $discount_rupees = $t_bill * ($discount->asking_discount_amount / 100);
                                                    echo $discount->asking_discount_amount . ' % (' . $discount_rupees . ' Rs)';
                                                } else {
                                                    echo $discount->asking_discount_amount . ' Rs';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php if($discount->discount_status == 'Approved'): ?>
                                    <div class="container">
                                        <div class="d-flex ">
                                            <span class="bilpo_name">Given Discount </span><span class="bilpo_value"> :
                                                <?php

                                                if ($discount->discount_type == 'percentage') {
                                                    $discount_rupees = $t_bill * ($discount->asking_discount_amount / 100);
                                                    echo $discount->asking_discount_amount . ' % (' . $discount_rupees . ' Rs)';
                                                } else {
                                                    echo $discount->asking_discount_amount . ' Rs';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div><!-- bd -->
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Give Discount</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form method="post" action="<?php echo e(route('given-discount')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="discount_id" value="<?php echo e($discount->id); ?>" />
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Discount Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="given_discount_status" required name="given_discount_status"
                                onchange="getTotal()">
                                <option value=" ">Select One.. </option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Total </label>
                            <input type="text" id="total" readonly value="<?php echo e($t_bill); ?>" name="total"
                                class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">Discount Amount </label>
                            <input type="text" name="given_discount_amount" id="given_discount_amount"
                                onkeyup="getTotal()" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Discount Type </label>
                            <select class="form-control" id="given_discount_type" name="given_discount_type"
                                onchange="getTotal()">
                                <option value=" ">Select One.. </option>
                                <option value="percentage" selected>%</option>
                                <option value="flat">Flat</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <input type="text" readonly id="total_amount_with_discount" name="total"
                                class="form-control" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Remark <span class="text-danger">*</span></label>
                            <textarea name="remark" required class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-indigo" type="submit">Save</button> <button class="btn btn-secondary"
                        data-dismiss="modal" type="button">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        function getTotal() {
            var given_discount_amount = $('#given_discount_amount').val();
            if (given_discount_amount != '') {
                var g_t = 0;
                var total = $('#total').val();
                var given_discount_amount = $('#given_discount_amount').val();
                var given_discount_type = $('#given_discount_type').val();
                if (given_discount_type == 'flat') {
                    var g_t = parseFloat(total) - parseFloat(given_discount_amount);
                } else if (given_discount_type == 'percentage') {
                    var g_t = parseFloat(total) - (parseFloat(total) * (parseFloat(given_discount_amount) / 100));
                }
                $('#total_amount_with_discount').val(g_t);
            }

        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/discount/discount_details.blade.php ENDPATH**/ ?>