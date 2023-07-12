
<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Work Station : <?php echo e(@$work_details->work_station_name); ?></h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add work station user')): ?>
                        <a class="btn btn-primary btn-sm" data-target="#modaldemo1" data-toggle="modal" href="#"><i class="fa fa-file"></i> Add Staff</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($work_details_user)): ?>
                            <?php $__currentLoopData = $work_details_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(@$value->staff_details->first_name); ?> <?php echo e(@$value->staff_details->last_name); ?></td>
                                    <td><?php echo e(@$value->staff_details->role); ?></td>

                                    <td>
                                        <a class="btn btn-danger btn-sm" href="<?php echo e(route('work-station-staff-delete',['id'=>$value->id,'station_id'=>$value->station_id])); ?>"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Staff For Work Station</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?php echo e(route('add-work-station-staff')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                            <input type="hidden" name="station_id" value="<?php echo e($id); ?>"  />
                            <div class="form-group col-md-12 d-inline-block">
                                <label class="form-label">Staff <span class="text-danger">*</span></label>
                                <select name="staff_id[]" multiple="multiple"
                                    class="form-control multi-select select2-show-search">
                                    <option value="">Select One</option>
                                    <?php if($user_list): ?>
                                        <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->first_name); ?>

                                                <?php echo e($value->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['staff_id'];
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
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-indigo" type="submit">Save</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/work-station/work-station-details.blade.php ENDPATH**/ ?>