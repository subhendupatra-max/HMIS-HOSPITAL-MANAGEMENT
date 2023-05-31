
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Bed Status </h4>
                </div>
            
            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <table class="table table-bordered text-nowrap" id="example">
                <thead>
                    <tr>
                        <th scope="col">Bed</th>
                        <th scope="col">Ward</th>
                        <th scope="col">Bed Status</th>
                        <th scope="col">Patient Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($beds)): ?>
                    <?php $__currentLoopData = $beds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                     if ($value->is_used == 'yes'){
                        $ipd_patient_details = App\Models\IpdDetails::where('bed',$value->id)->where('discharged','no')->first();
                     }
                     ?>
                    <tr>
                        <td class="text-center">
                            <?php if($value->is_used == 'no'): ?>
                            <i class="fa fa-bed fa-2x text-success"></i>
                            <?php elseif($value->is_used == 'yes'): ?>
                            <i class="fa fa-bed fa-2x text-danger"></i>
                            <?php else: ?>
                            <i class="fa fa-bed fa-2x text-warning"></i>
                            <?php endif; ?>
                             <?php echo e(@$value->bed_name); ?>

                        </td>
                        <td><?php echo e(@$value->bed_ward->ward_name); ?></td>
                        <td>
                            <?php if($value->is_used == 'no'): ?>
                            <span class="badge badge-success">Free Bed</span>
                            <?php elseif($value->is_used == 'yes'): ?>
                            <span class="badge badge-danger">Patient Admitted</span>
                            <?php else: ?>
                            <span class="badge badge-warning" onclick="changeBedStatus(<?php echo e($value->id); ?>)">Under Maintenance</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($value->is_used == 'yes'): ?>
                            <a class="textlink" href="<?php echo e(route('ipd-profile',['id'=>base64_encode($ipd_patient_details->id)])); ?>"> <?php echo e(@$ipd_patient_details->all_patient_details->prefix); ?> <?php echo e(@$ipd_patient_details->all_patient_details->first_name); ?> <?php echo e(@$ipd_patient_details->all_patient_details->middle_name); ?> <?php echo e(@$ipd_patient_details->all_patient_details->last_name); ?>(<?php echo e(@$ipd_patient_details->all_patient_details->id); ?>) -- <?php echo e(@date('d-m-Y h:i A',strtotime(@$ipd_patient_details->appointment_date))); ?> -- <?php echo e(@$ipd_patient_details->all_patient_details->phone); ?></a>
                             -- 
                            <?php echo @$ipd_patient_details->ins_by == 'ori' ? '<span class="badge badge-info">Original</span>':'<span class="badge badge-secondary">False</span>'; ?>

                            <?php endif; ?>
                        </td>
                     
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Bed Status Change
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('update-status-bed')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select......</option>
                                <option value="no">Ready For Use</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <input type="hidden" id="bed_id" name="bed_id"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function changeBedStatus(bed_id)
    {
        $('#bed_id').val(bed_id);
        $("#exampleModal").modal('show');
    }
</script>

<script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/bed-status.blade.php ENDPATH**/ ?>