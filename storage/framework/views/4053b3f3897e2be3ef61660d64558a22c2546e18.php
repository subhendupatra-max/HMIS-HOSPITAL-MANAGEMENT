
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Medicines Stock
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('import-medicine')); ?>" class="btn btn-primary btn-sm "><i class="fa fa-upload mr-1"></i>Import Medicines</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add medicine')): ?>
                        <a href="<?php echo e(route('add-medicine-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i>Add Medicine</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('all-medicine-requisition-listing')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Purchase </a>
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
                                <th class="border-bottom-0">Medicine Name </th>
                                <th class="border-bottom-0">Medicine Category</th>
                                <th class="border-bottom-0">Medicine Company </th>
                                <th class="border-bottom-0">Medicine Composition</th>
                                <th class="border-bottom-0">Medicine Group </th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine','delete medicine')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $medicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->medicine_name); ?> </td>
                                <td><?php echo e(@$item->catagory_name->medicine_catagory_name); ?> </td>
                                <td><?php echo e(@$item->medicine_company); ?> </td>
                                <td><?php echo e(@$item->medicine_composition); ?> </td>
                                <td><?php echo e(@$item->medicine_group); ?> </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-medicine-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-medicine-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/medicine/medicine-listing.blade.php ENDPATH**/ ?>