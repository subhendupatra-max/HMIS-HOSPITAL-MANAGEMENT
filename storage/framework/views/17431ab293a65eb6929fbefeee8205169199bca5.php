

<?php $__env->startSection('content'); ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session()->has('error')): ?>
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
                <?php endif; ?>
                <h5 class="card-title  fs-3 fw-bolder" style="padding-left: 1%">Edit Permission</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3"  method="POST" action="<?php echo e(route('permissionEditAction')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" value="<?php echo e($permission->name); ?>" class="form-control" id="permission" name="permission"
                                placeholder="Enter Permission" required>
                            <input type="hidden" name="id" value="<?php echo e($permission->id); ?>">
                            <?php $__errorArgs = ['permission'];
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
                    <div class="text-start mt-3 ml-3">
                        <button type="submit" class="btn btn-primary"><i class="ri-add-circle-fill"></i>&nbsp;Edit
                            Permission</button>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body fw-bold">
                <div class="text-left ">
                    <h5 class="card-title fs-3 fw-bolder">Permission List</h5>
                </div>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Permission</th>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit permission')): ?>
                            <th scope="col">Edit Role</th>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete permission')): ?>
                            <th scope="col">Delete Role</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e($item->name); ?></td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit permission')): ?>
                                <td>
                                    <a href="<?php echo e(route('permissionEdit', ['id' => base64_encode($item->id)])); ?>"
                                        class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top"
                                        title="Edit Permission"><i
                                            class="fa fa-pencil"></i></a>
                                </td>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete permission')): ?>
                                <td>
                                    <form action="<?php echo e(route('deletePermission')); ?>" method="POST" id="delete">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"
                                            data-toggle="tooltip-primary" data-placement="top" title=""
                                            data-title="Remove Permission"><i
                                                class="fa fa-trash"></i></button>
                                        <input type="hidden" name="permId" value="<?php echo e($item->id); ?>">
                                    </form>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $("#removeIcon").click(function(e) {
                e.preventDefault();
                $("#delete").submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ame_inventory\resources\views/permission/editPermission.blade.php ENDPATH**/ ?>