
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Item Issue
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Item Issue Inventory')): ?>
                        <a href="<?php echo e(route('add-item-issue-inventory')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Issue Item</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body ">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sl. No</th>
                                    <th class="border-bottom-0">ISSUE SLIP NO</th>
                                    <th class="border-bottom-0">ISSUE FROM</th>
                                    <th class="border-bottom-0">ISSUE TO</th>
                                    <th class="border-bottom-0">GENERATED BY</th>
                                    <th class="border-bottom-0">ISSUED BY</th>
                                    <th class="border-bottom-0">ISSUE DATE</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $item_issue_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><a href="<?php echo e(route('item-issue-details-inventory',['issue_id' => $item->id ])); ?>" style="color: blue;"><?php echo e($item->issue_prefix); ?><?php echo e(@$item->id); ?></a></td>
                                    <td><?php echo e($item->store_room_details->item_store_room); ?></td>
                                    <td><?php echo e($item->issue_to_details->first_name); ?> <?php echo e($item->issue_to_details->last_name); ?></td>
                                    <td><?php echo e($item->generated_by_details->first_name); ?> <?php echo e($item->generated_by_details->last_name); ?></td>
                                    <td><?php echo e($item->issue_by_details->first_name); ?> <?php echo e($item->issue_by_details->last_name); ?></td>
                                    <td><?php echo e(@$item->issue_date); ?> </td>
                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view item issue inventory')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('item-issue-details-inventory',['issue_id' => $item->id ])); ?>"><i class="fa fa-eye"></i> View</a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item issue inventory')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('edit-item-issue-inventory',['issue_id'=> base64_encode($item->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item issue inventory')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('delete-item-issue-inventory',['issue_id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Inventory/item-issue/item-issue-list.blade.php ENDPATH**/ ?>