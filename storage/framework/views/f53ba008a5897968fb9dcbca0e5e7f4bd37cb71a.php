
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Add Charges Package Name
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add package name')): ?>
                        <a href="<?php echo e(route('add-charges-package-name-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Charges Package </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Catagory</th>
                                <th class="border-bottom-0">Sub Catagory</th>
                                <th class="border-bottom-0">Charges Package Name</th>
                                <th class="border-bottom-0">Tax</th>
                                <th class="border-bottom-0">Total Amount</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit package name','delete package name')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $chargePackageName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->chargesPackageCatagoryName->charges_package_catagories_name); ?></td>
                                <td><?php echo e($item->chargesPackageSubCatagoryName->charges_package_sub_catagory_name); ?></td>
                                <td><?php echo e($item->package_name); ?></td>
                                <td><?php echo e($item->tax); ?></td>
                                <td><?php echo e($item->total_amount); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit package name')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-charges-package-name-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete package name')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-charges-package-name-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/charges-package/package-name/package-name-listing.blade.php ENDPATH**/ ?>