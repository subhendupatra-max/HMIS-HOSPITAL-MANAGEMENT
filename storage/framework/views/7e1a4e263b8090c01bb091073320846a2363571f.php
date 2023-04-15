

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add item unit')): ?>
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Prefix</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('addPrefix')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group">
                        <label for="role" class="form-label">Name</label>
                        <input type="text" class="form-control" id="prefix_name" name="prefix_name" placeholder="Enter Name" value="<?php echo e(old('prefix_name')); ?>" required>
                        <?php $__errorArgs = ['prefix_name'];
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
                        <label for="role" class="form-label">Prefix</label>
                        <input type="text" class="form-control" id="prefix" name="prefix" placeholder="Enter prefix" required>
                        <?php $__errorArgs = ['prefix'];
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
                        <label for="role" class="form-label">Year</label>
                        <input type="text" class="form-control" id="year" name="year" value="<?php echo e(date('Y')); ?>" placeholder="Enter Year" required readonly>
                        <?php $__errorArgs = ['year'];
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
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Prefix</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Prefix List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Unit</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item unit')): ?>
                                    <th class="border-bottom-0">Remove Unit</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item unit')): ?>
                                    <th class="border-bottom-0">Edit Unit</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $allPrefix; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->prefix); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete prefix')): ?>
                                      <td>
                                        <form action="<?php echo e(route('deletePrefix')); ?>" method="POST" id="delete">
                                          <?php echo csrf_field(); ?>
                                          <button class="btn btn-danger"  data-toggle="tooltip-primary" data-placement="top" title="Remove Item unit" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                          <input type="hidden" name="prefix_id" value="<?php echo e(base64_encode($item->id)); ?>">
                                        </form>
                                      </td>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit prefix')): ?>
                                      <td>
                                        <a href="<?php echo e(route('editPrefix',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning"  data-toggle="tooltip-primary" data-placement="top" title="Edit Item unit"><i class="fa fa-edit"></i></a>
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
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/setup/prefix/prefixList.blade.php ENDPATH**/ ?>