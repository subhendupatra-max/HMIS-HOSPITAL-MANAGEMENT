
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

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Medicine GRN Create')): ?>

                        <a href="<?php echo e(route('medicine-grn-create')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create GRN</a>

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
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">GRN No.</th>
                                <th scope="col">Store Room</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($grn_list) && $grn_list != ''): ?>
                            <?php $__currentLoopData = $grn_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(route('medicine-grn-details')); ?>/<?php echo e(base64_encode($grn->id)); ?>" style="color: blue;"><?php echo e($grn->grn_prefix); ?><?php echo e(@$grn->id); ?></a></td>
                                <td><?php echo e(@$grn->store_room_details->name); ?></td>
                                <td><?= date('d-m-Y h:i', strtotime($grn->grn_date)); ?></td>
                                <td>
                                    <?php if($grn->stock_update_status == '0'): ?>
                                    <span class="badge badge-warning">Stocks Not Updated</span>
                                    <?php else: ?>
                                    <span class="badge badge-success">Stocks Updated</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="<?php echo e(route('medicine-grn-details',['id'=> base64_encode($grn->id)])); ?>"><i class="fa fa-eye"></i> View</a>

                                            <a class="dropdown-item" href="<?php echo e(route('grn-edit',['id'=> base64_encode($grn->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('GRN Medicine delete')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('grn-delete',['id'=> base64_encode($grn->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Stock Update After GRN')): ?>
                                            <?php if($grn->stock_update_status == '0'): ?>
                                            <a class="dropdown-item" onclick="return confirm('Are You Sure to add Item in Stock?')" href="<?php echo e(route('stock-update-after-grn',['id'=> base64_encode($grn->id)])); ?>"><i class='fa fa-area-chart'></i> Stock Update</a>
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
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $("#removeIcon").click(function(e) {
            e.preventDefault();
            $("#delete").submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/purchase/grn/grn-list.blade.php ENDPATH**/ ?>