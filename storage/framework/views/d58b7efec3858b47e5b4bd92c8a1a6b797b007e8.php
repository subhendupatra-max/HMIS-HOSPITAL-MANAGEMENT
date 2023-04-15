

<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title ">Vendor List</div>
                <div>
                    <a href="<?php echo e(route('vendorAdd')); ?>" class="btn btn-primary mt-4 mb-0 ">Add Vendor</a>
                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Status</th>
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete role')): ?>
                                <th class="border-bottom-0">Remove Role</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit role')): ?>
                                <th class="border-bottom-0">Edit Role</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $vendorInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->vendor_name); ?></td>
                                <td><?php echo e($item->vendor_address); ?></td>
                                
                                <td><?php if($item->is_active == '1'): ?>

                                    <a href="<?php echo e(route('vendorStatusAction',$item->id)); ?>" class="btn btn-success btn-sm">Active</a>

                                    <?php else: ?>

                                    <a href="<?php echo e(route('vendorStatusAction',$item->id)); ?>" class="btn btn-danger btn-sm">Deactive</a>

                                </td>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete role')): ?>
                                <td>
                                    <form action="<?php echo e(route('vendorDelete')); ?>" method="POST" id="delete">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-danger" data-toggle="tooltip-primary" data-placement="top" title="Remove Vendor" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                        <input type="hidden" name="vendorId" value="<?php echo e($item->id); ?>">
                                    </form>
                                </td>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit role')): ?>
                                <td>
                                    <a href="<?php echo e(route('vendorEdit',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top" title="Edit Vendor Details"><i class="fa fa-pencil"></i></a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/master/vendor/vendorList.blade.php ENDPATH**/ ?>