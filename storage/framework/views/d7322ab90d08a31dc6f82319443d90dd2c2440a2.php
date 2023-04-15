

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add tpa management')): ?>
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Tpa Management</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-tpa-management-details')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group">
                        <label for="TPA_name" class="form-label">TPA Name</label>
                        <input type="text" class="form-control" id="TPA_name" name="TPA_name" placeholder="Enter Tpa Name" value="<?php echo e(old('TPA_name')); ?>" required>
                        <?php $__errorArgs = ['TPA_name'];
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

                    <div class="form-group">
                        <label for="contact_person_name" class="form-label">Contact Person Name</label>
                        <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" placeholder="Enter Contact Person Name " value="<?php echo e(old('contact_person_name')); ?>" required>
                        <?php $__errorArgs = ['contact_person_name'];
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

                    <div class="form-group">
                        <label for="contact_person_ph_no" class="form-label">Contact Person Phone No</label>
                        <input type="text" class="form-control" id="contact_person_ph_no" name="contact_person_ph_no" placeholder="Enter Contact Person Ph No" value="<?php echo e(old('contact_person_ph_no')); ?>" required>
                        <?php $__errorArgs = ['contact_person_ph_no'];
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
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Tpa Management</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tpa Management List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">TPA Name</th>
                                <th class="border-bottom-0">Contact Person Name</th>
                                <th class="border-bottom-0">Contact Person Phone No</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete tpa management','edit tpa management')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->TPA_name); ?></td>
                                <td><?php echo e(@$item->contact_person_name); ?></td>
                                <td><?php echo e(@$item->contact_person_ph_no); ?></td>
                                <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit tpa management')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('edit-tpa-management-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete tpa management')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('delete-tpa-management-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/setup/tpa-management/tpa-management.blade.php ENDPATH**/ ?>