
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Return Item List
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Return PO Item Inventory')): ?>
                        <a href="<?php echo e(route('return-create-inventory')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create GRN</a>
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
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">Return Form No.</th>
                                    <th scope="col">Workshop</th>
                                    <th scope="col">Rejection Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($return_list) && $return_list != ''): ?>
                                <?php $__currentLoopData = $return_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                                                        
                                    <td><a href="<?php echo e(route('return-details-inventory',['id'=> base64_encode($value->id)])); ?>" style="color: blue;"><?php echo e($value->return_prefix); ?><?php echo e(@$value->id); ?></a></td>

                                    <td><?php echo e(@$value->store_room->item_store_room); ?></td>
                                    <td><?= date('d-m-Y h:i', strtotime($value->rejection_date)); ?></td>

                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">

                                                <a class="dropdown-item"  href="<?php echo e(route('return-details-inventory',['id'=> base64_encode($value->id)])); ?>"><i class="fa fa-eye"></i> View</a>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit Return PO Item')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('return-edit-inventory',['id'=> base64_encode($value->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete Return PO Item')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('return-delete-inventory',['id'=>base64_encode($value->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/return/item-return-list.blade.php ENDPATH**/ ?>