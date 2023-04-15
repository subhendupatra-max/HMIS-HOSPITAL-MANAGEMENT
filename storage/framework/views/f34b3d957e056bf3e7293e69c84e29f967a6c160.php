
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Item Stock
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Requisition')): ?>
                        <a href="<?php echo e(route('all-inventory-requisition-listing')); ?>" class="btn btn-primary"><i class="fa fa-file"></i> Requisition</a>
                    <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Item Stock')): ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($item)): ?>
                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="#" style="color:blue"><?php echo e($value->item_name); ?>(<?php echo e($value->item_description); ?>)</a></td>

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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Inventory/item-stock-details.blade.php ENDPATH**/ ?>