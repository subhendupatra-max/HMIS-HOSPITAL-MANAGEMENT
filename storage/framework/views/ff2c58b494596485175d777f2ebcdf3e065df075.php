
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Vehicle Details</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Vehicle Model:</b> <?php echo e($vehicle->vehicle_model); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Engine No:</b> <?php echo e($vehicle->engine_no); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Date of Manufacture:</b> <?php echo e($vehicle->date_of_manufacture); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Registration No:</b> <?php echo e($vehicle->registration_no); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Chasis No:</b> <?php echo e($vehicle->chasis_no); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Purchase Date:</b> <?php echo e($vehicle->purchase_date); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Insurance Date:</b> <?php echo e($vehicle->insurance_date); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>PUC Date:</b> <?php echo e($vehicle->pollution_under_control); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Depreciation Rate:</b> <?php echo e($vehicle->depreciation_rate); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Depreciation Value:</b> <?php echo e($vehicle->depreciation_value); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Fuel Type:</b> <?php echo e($vehicle->fuel_type); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Engine CC:</b> <?php echo e($vehicle->engine_cc); ?></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Registration Certificate:</b><a href="<?php echo e(url('public/website/vehicle/'.@$vehicle->registration_certificate_details)); ?>" target="_blank" class="text text-info">  <i class="fa fa-eye"></i> View File...</a></label>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span>
                                    <label><b>Insurance:</b><a href="<?php echo e(url('public/website/vehicle/'.@$vehicle->insurance_details)); ?>" target="_blank" class="text text-info">  <i class="fa fa-eye"></i> View File...</a></label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Job details for this vehical')): ?>
                    <hr>
                    <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Job No</th>
                                    <th>Job Date</th>
                                    <th>Driver Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($jobdetails)): ?>
                                <?php $__currentLoopData = $jobdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><a href="<?php echo e(route('view_job',$value->id)); ?>" class="text-info"><?php echo e($value->prefix); ?><?php echo e($value->id); ?></a></td>
                                    <td><?php echo e($value->job_date); ?></td>
                                    <td><?php echo e($value->driver_name); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/vehicle/vehicle-details.blade.php ENDPATH**/ ?>