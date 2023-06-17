
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
        <div class="card-header d-block">
            <form method="POST" action="<?php echo e(route('search-by-bed-and-ward')); ?>">
                <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-4 card-title">
                    <input name="bed_ward" type="text" value="<?php echo e(@$request_data['bed_ward']); ?>" placeholder="Search By Ward..." />
        
                </div>
                <div class="col-md-4 card-title">
                    <input name="bed" type="text" value="<?php echo e(@$request_data['bed']); ?>" placeholder="Search By Bed No..." />
                </div>
                <div class="col-md-4 card-title">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
            </form>
        </div>
        <!-- ================================ Alert Message===================================== -->

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php $__currentLoopData = $bed_and_ward; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($value[0]->bed_name)): ?>
        <div class="card-header" style="background-color: rgb(223, 223, 223)">
            <h4 class="card-title" ><?php echo e(@$key); ?> </h4>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if ($item->is_used != 'no'){
                       $ipd_patient_details = App\Models\IpdDetails::where('bed',$item->id)->where('discharged','no')->first();
                    }
                    ?>

                        <div class="col-md-1">
                            <?php if(isset($ipd_patient_details)): ?>
                            <a href="<?php echo e(route('ipd-profile',['id'=>base64_encode($ipd_patient_details->id)])); ?>"
                                data-placement="top" data-toggle="tooltip" title="<?php echo 'P Name : '.@$ipd_patient_details->all_patient_details->prefix .' '.
                                    @$ipd_patient_details->all_patient_details->first_name .' '. @$ipd_patient_details->all_patient_details->middle_name
                                    .' '. @$ipd_patient_details->all_patient_details->last_name .' ( '. @$ipd_patient_details->all_patient_details->id .') // DOA : ' . @date('d-m-Y h:i A',strtotime(@$ipd_patient_details->appointment_date)).' // PH : '. @$ipd_patient_details->all_patient_details->phone; ?>" >
                            <?php endif; ?>
                                <?php if($item->is_used == 'no'): ?>
                                    <?php if(@$ipd_patient_details->ins_by == 'sys'): ?>
                                        <i class="fa fa-bed fa-3x text-info"></i>
                                    <?php else: ?>
                                        <i class="fa fa-bed fa-3x text-success"></i>
                                    <?php endif; ?>
                                <?php elseif($item->is_used == 'yes'): ?>
                                <i class="fa fa-bed fa-3x text-danger"></i>
                                <?php else: ?>
                                <i class="fa fa-bed fa-3x text-warning"></i>
                                <?php endif; ?>
                                <h3 class="appointment-heading"> <?php echo e($item->bed_name); ?></h3>
                            <?php if(isset($ipd_patient_details)): ?>
                            </a>
                            <?php endif; ?>
                        </div>
                
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                        <input type="hidden" id="bed_id" name="bed_id" />
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/bed-status.blade.php ENDPATH**/ ?>