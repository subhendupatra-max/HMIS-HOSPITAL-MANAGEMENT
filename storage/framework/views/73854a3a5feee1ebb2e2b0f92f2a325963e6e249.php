
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Requisiton List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add medicine requisition')): ?>
                        <a href="<?php echo e(route('add-medicine-requisition-details')); ?>" class="btn btn-primary btn-sm "><i class="fa fa-plus mr-1"></i>Add Requision</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine purchase order')): ?>
                        <a href="<?php echo e(route('all-medicine-purchase-order-listing')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i>Purchase Order</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('GRN')): ?>
                        <a href="<?php echo e(route('medicine-grn-list')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> GRN </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Requisition No.</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Generate By</th>
                                <th class="border-bottom-0">Status</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine requisition','delete medicine requisition')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $medicine_requisition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><a href="<?php echo e(route('medicine-requisition-details',['id'=> ($item->id)])); ?>" style="color: blue;"><?php echo e($item->requisition_prefix); ?><?php echo e(@$item->id); ?></a></td>
                                <td><?php echo e(@$item->date); ?> </td>
                                <td><?php echo e(@$item->generate_by_name->first_name); ?> <?php echo e(@$item->generate_by_name->last_name); ?> </td>
                                <td><?php echo @$item->working_status->status; ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view medicine requisition')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('medicine-requisition-details',['id'=> ($item->id)])); ?>"><i class="fa fa-eye"></i> View</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine requisition')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-medicine-requisition-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine requisition')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-medicine-requisition-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/purchase/requisition/medicine-requisition-listing.blade.php ENDPATH**/ ?>