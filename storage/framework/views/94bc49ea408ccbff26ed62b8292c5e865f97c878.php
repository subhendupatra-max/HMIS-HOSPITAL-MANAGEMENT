
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Discount List </h4>
                </div>
            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="card-body">
            <table id="example" class="table table-borderless text-nowrap key-buttons">
                <thead>
                    <tr>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Section</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Bill Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Requested By </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($discountList[0]->section): ?>
                    <?php $__currentLoopData = $discountList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $discount_details = App\Models\DiscountDetails::where('discount_id', $value->id);
                                $total_bill_amount = $discount_details->sum('bill_amount');

                                ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('view-discount-details',['discount_id'=>base64_encode($value->id)])); ?>">
                                <span style="color:blue"><?php echo e($value->patient_details->prefix . ' ' .
                                    $value->patient_details->first_name . ' ' . $value->patient_details->middle_name . '
                                    ' . $value->patient_details->last_name); ?><br><?php echo e($value->patient_details->patient_prefix . ' ' . $value->patient_details->id); ?></span></a>

                        </td>
                        <td>
                            <?php if($value->section == 'OPD'): ?>
                            <span class="badge badge-success"><?php echo e($value->section); ?></span>
                            <?php elseif($value->section == 'IPD'): ?>
                            <span class="badge badge-danger"><?php echo e($value->section); ?></span>
                            <?php elseif($value->section == 'EMG'): ?>
                            <span class="badge badge-info"><?php echo e($value->section); ?></span>
                            <?php else: ?>
                            <span class="badge badge-primary"><?php echo e($value->section); ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($value->patient_details->phone); ?></td>
                        <td><?php echo e($total_bill_amount); ?></td>
                        <td>
                            <?php if($value->discount_status == 'Pending'): ?>
                            <span class="badge badge-warning"><?php echo e($value->discount_status); ?></span>
                            <?php elseif($value->discount_status == 'Approved'): ?>
                            <span class="badge badge-success"><?php echo e($value->discount_status); ?></span>
                            <?php else: ?>
                            <span class="badge badge-danger"><?php echo e($value->discount_status); ?></span>
                            <?php endif; ?>

                        </td>
                        <td><?php echo e($value->request_by_details->first_name . ' ' . $value->request_by_details->last_name); ?>

                        </td>
                        <td><a class="btn btn-primary btn-sm"
                                href="<?php echo e(route('view-discount-details',['discount_id'=>base64_encode($value->id)])); ?>"><i
                                    class="fa fa-eye"></i> View</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/discount/discount_list.blade.php ENDPATH**/ ?>