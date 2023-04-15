

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add item unit')): ?>
<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Item Unit</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('UnitAddAction')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group">
                        <label for="role" class="form-label">Item Unit</label>
                        <input type="text" class="form-control" id="item_unit" name="item_unit" placeholder="Enter Item Unit" required>
                        <?php $__errorArgs = ['item_Unit'];
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
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Item Unit</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item Unit List</div>
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
                            <?php $__currentLoopData = $allItemUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->units); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item unit')): ?>
                                      <td>
                                        <form action="<?php echo e(route('UnitDelete')); ?>" method="POST" id="delete">
                                          <?php echo csrf_field(); ?>
                                          <button class="btn btn-danger"  data-toggle="tooltip-primary" data-placement="top" title="Remove  Item unit" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                          <input type="hidden" name="item_unit" value="<?php echo e($item->id); ?>">
                                        </form>
                                      </td>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item unit')): ?>
                                      <td>
                                        <a href="<?php echo e(route('UnitEdit',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning"  data-toggle="tooltip-primary" data-placement="top" title="Edit Item unit"><i class="fa fa-pencil"></i></a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ame_inventory\resources\views/appPages/master/itemUnit/itemUnit.blade.php ENDPATH**/ ?>