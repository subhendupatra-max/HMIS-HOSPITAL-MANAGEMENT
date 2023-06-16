
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    GRN List
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('grm-create-inven')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create GRN</a>
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
                                    <th scope="col">GRN No.</th>
                                    <th scope="col">Workshop</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($grm_list) && $grm_list != ''): ?>
                                <?php $__currentLoopData = $grm_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                  
                                    <td><a   href="<?php echo e(route('grm-details-inven',['id'=> base64_encode($grm->id)])); ?>" style="color: blue;"><?php echo e($grm->grm_prefix); ?><?php echo e(@$grm->id); ?></a></td>
                                    <td><?php echo e(@$grm->store_room->item_store_room); ?></td>
                                    <td><?= date('d-m-Y h:i', strtotime($grm->grm_date)); ?></td>
                                    <td>
                                        <?php if($grm->stock_update_status == '0'): ?>
                                        <span class="badge badge-warning">Stocks Not Updated</span>
                                        <?php else: ?>
                                        <span class="badge badge-success">Stocks Updated</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">

                                                <a class="dropdown-item" href="<?php echo e(route('grm-details-inven',['id'=> base64_encode($grm->id)])); ?>" ><i class="fa fa-eye"></i> View</a>

                                                <a class="dropdown-item" href="<?php echo e(route('grm-edit-inven',['id'=> base64_encode($grm->id)])); ?>" ><i class="fa fa-edit"></i> Edit</a>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('GRN delete')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('grm-delete-inven',['id'=> base64_encode($grm->id)])); ?>" ><i class="fa fa-trash"></i> Delete</a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('GRN print')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('grm-print-inven',['id'=> base64_encode($grm->id)])); ?>" ><i class="fa fa-print"></i> Print</a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Stock Update After GRN')): ?>
                                                <?php if($grm->stock_update_status == '0'): ?>
                                                <a class="dropdown-item" onclick="return confirm('Are You Sure to add Item in Stock?')" href="<?php echo e(route('stock-update-after-grm-inven',['id'=> base64_encode($grm->id)])); ?>" ><i class='fa fa-area-chart'></i> Stock Update</a>
                                                <?php endif; ?>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/grn/grn-lisiting-inventory.blade.php ENDPATH**/ ?>