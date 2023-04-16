
<?php $__env->startSection('content'); ?>




    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Purchase Order List</div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Purchase Order')): ?>
                <div class="btn-list ggdtretew">
                    <a href="<?php echo e(route('create-po')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>  Create Purchase Order</a>
                </div>
                <?php endif; ?>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Purchase Order')): ?>

            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Purchase Order No.</th>
                            <th scope="col">Generated By</th>
                            <th scope="col">Workshop</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($po_list) && $po_list != ''): ?>
                        <?php $__currentLoopData = $po_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $po): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(url('po-details')); ?>/<?php echo e($po->req_no); ?>"  style="color: blue;"><?php echo e($prefix->prefix); ?><?php echo e(@$po->po_id); ?></a></td>
                                <td><?php echo e($po->name); ?></td>
                                <td><?php echo e(@$po->workshop_name); ?></td>
                                <td><?= date('d-m-Y h:i',strtotime($po->po_date)); ?></td>
                                <td><?php echo @$po->status; ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#"  class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>    View</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i>   Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash"></i>    Delete</a>
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
    <?php endif; ?>
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









<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/item/purchase-order/purchase-order-list.blade.php ENDPATH**/ ?>