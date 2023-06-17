
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <?php if(session('success')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Item List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item')): ?>
                        <a href="<?php echo e(route('add-Inventory-item')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Item</a>
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
                                <th scope="col">Sl No.</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Category</th>
                                <th scope="col">Part No.</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Manufacturer Name</th>
                                <th scope="col">Stored</th>
                                <th scope="col">HSN or SAC No</th>
                                <th scope="col">Loworder Level</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Delete' , 'Inventory Item Edit')): ?>
                                    Action
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->item_name); ?></td>
                                <td><?php echo e(@$item->fetch_catagory_name->item_catagory_name); ?></td>
                                <td><?php echo e(@$item->part_no); ?></td>
                                <td><?php echo e(@$item->fetch_brand_name->item_brand_name); ?></td>
                                <td><?php echo e(@$item->fetch_manufacture_name->manufacture_name); ?></td>
                                <td><?php echo e(@$item->stored); ?></td>
                                <td><?php echo e(@$item->hsn_or_sac_no); ?></td>
                                <td><?php echo e(@$item->loworder_level); ?></td>
                                <td><?php echo e(@$item->product_code); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Edit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-Inventory-item',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Delete')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-Inventory-item',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/Inventory/item/item-listing.blade.php ENDPATH**/ ?>