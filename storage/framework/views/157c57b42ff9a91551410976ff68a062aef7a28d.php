
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Vendor List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Inventory Vendor')): ?>
                        <a href="<?php echo e(route('add-inventory-vendor')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add New Vendor </a>
                        <?php endif; ?>
                    </div>
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
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Details</th>
                                <th class="border-bottom-0">Status</th>


                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Inventory Vendor')): ?>
                                <th class="border-bottom-0">Remove</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Inventory Vendor')): ?>
                                <th class="border-bottom-0">Edit</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->vendor_name); ?></td>
                                <td><?php echo e($item->vendor_address); ?></td>

                                <td>
                                    <a href="#" class="btn btn-info" data-toggle="tooltip-primary" data-bs-placement="top" title="PnNo - <?php echo e($item->pnno); ?>  Email - <?php echo e($item->email); ?> Contact Person - <?php echo e($item->contact_name); ?>"><i class="fa fa-eye"></i></a>

                                </td>


                                <td><?php if($item->is_active == '1'): ?>

                                    <a href="<?php echo e(route('vendorStatusActionInventory',$item->id)); ?>" class="btn btn-success btn-sm">Active</a>

                                    <?php else: ?>

                                    <a href="<?php echo e(route('vendorStatusActionInventory',$item->id)); ?>" class="btn btn-danger btn-sm">Deactive</a>

                                </td>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Inventory Vendor')): ?>
                                <td>
                                    <form action="<?php echo e(route('delete-Inventory-vendor')); ?>" method="POST" id="delete">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-danger" data-toggle="tooltip-primary" data-placement="top" title="Remove Vendor" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                        <input type="hidden" name="vendorId" value="<?php echo e($item->id); ?>">
                                    </form>
                                </td>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Inventory Vendor')): ?>
                                <td>
                                    <a href="<?php echo e(route('edit-Inventory-vendor',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top" title="Edit Vendor Details"><i class="fa fa-edit"></i></a>
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
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/Inventory/vendor/vendor-listing.blade.php ENDPATH**/ ?>