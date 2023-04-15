

<?php $__env->startSection('content'); ?>
            
<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
    <div class="card">
            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>
        <div class="card-header">
            <h4 class="card-title">Add Role</h4>
        </div>
        <div class="card-body">
            <form method="POST"  action="<?php echo e(route('editRoleAction')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" value="<?php echo e($role->name); ?>" class="form-control" id="role" name="role" placeholder="Enter Role" required>
                        <?php $__errorArgs = ['role'];
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
                    <input type="hidden" name="roleId" value="<?php echo e($role->id); ?>">
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Role</button>
            </form>
        </div>
    </div>
</div>

<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Role List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Role</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asign roleBasedPermission')): ?>
                                    <th class="border-bottom-0">Asign Permission</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete role')): ?>
                                    <th class="border-bottom-0">Remove Role</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit role')): ?>
                                    <th class="border-bottom-0">Edit Role</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $allRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asign roleBasedPermission')): ?>
                                        <td>
                                            <a href="<?php echo e(route('PermissionAsign',['role'=>base64_encode($item->name)])); ?>" class="btn btn-info"  data-toggle="tooltip-primary" data-bs-placement="top" title="Asign Permission To This Role"><i class="fa fa-check"></i></a> 
                                        </td> 
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete role')): ?>
                                      <td>
                                        <form action="<?php echo e(route('deleteRole')); ?>" method="POST" id="delete">
                                          <?php echo csrf_field(); ?>
                                          <button class="btn btn-danger"  data-toggle="tooltip-primary" data-placement="top" title="Remove Role" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                          <input type="hidden" name="roleId" value="<?php echo e($item->id); ?>">
                                        </form>
                                      </td>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit role')): ?>
                                      <td>
                                        <a href="<?php echo e(route('editRole',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning"  data-toggle="tooltip-primary" data-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>
                                      </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/role/editRole.blade.php ENDPATH**/ ?>