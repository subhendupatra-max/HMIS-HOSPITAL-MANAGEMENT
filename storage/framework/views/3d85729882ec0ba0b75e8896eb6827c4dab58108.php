
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
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ame_inventory\resources\views/appPages/vehicle/vehicle-details.blade.php ENDPATH**/ ?>