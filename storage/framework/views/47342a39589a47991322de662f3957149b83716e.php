

<?php $__env->startSection('content'); ?>

<!-- INTERNAL Select2 css -->
<link href="<?php echo e(asset('assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine storeroom')): ?>
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit StoreRoom</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('update-medicine-store-room-details')); ?>">
                <?php echo csrf_field(); ?>

                <div class="">
                    <div class="form-group">
                        
                        <input type="text"id="name" name="name" value="<?php echo e($editStoreRoom->name); ?>"  >
                        <label for="name">Enter Store Room Name</label>
                        <input type="hidden" name="store_room_id" value="<?php echo e($editStoreRoom->id); ?>">
                        <?php $__errorArgs = ['name'];
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

                    <div>
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control mb-4" id="address" name="address" placeholder="Store Room Address" rows="3"><?php echo e($editStoreRoom->address); ?></textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control mb-4" id="desc" name="desc" placeholder="Store Room Description" rows="3"><?php echo e($editStoreRoom->desc); ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Store Room</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Store Room List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Store Room Name</th>
                                <th class="border-bottom-0">Store Room Address

                                </th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine storeroom')): ?>
                                <th class="border-bottom-0">Remove</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine storeroom')): ?>
                                <th class="border-bottom-0">Edit</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $allStoreRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->address); ?></td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine storeroom')): ?>
                                <td>
                                    <form action="<?php echo e(route('delete-medicine-store-room-details')); ?>" method="POST" id="delete">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-danger" data-toggle="tooltip-primary" data-placement="top" title="Remove  workshop" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                        <input type="hidden" name="store_room_id" value="<?php echo e($item->id); ?>">
                                    </form>
                                </td>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine storeroom')): ?>
                                <td>
                                    <a href="<?php echo e(route('edit-medicine-store-room-details',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top" title="Edit workshop"><i class="fa fa-edit"></i></a>
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
<!-- INTERNAL Select2 js -->
<script src="<?php echo e(asset('assets/plugins/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/pharmacy/store-room/edit-store-room.blade.php ENDPATH**/ ?>