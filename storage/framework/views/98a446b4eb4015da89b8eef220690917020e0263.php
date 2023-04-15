<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('main stock')): ?>



    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Item Stock</div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view requisition')): ?>
                <div class="btn-list ggdtretew">
                    <a href="<?php echo e(route('requisition-list')); ?>" class="btn btn-primary"><i class="fa fa-file"></i>  Requisition</a>
                </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Purchase Order')): ?>
                <div class="btn-list fgrgreyreyr">
                    <a href="<?php echo e(route('Purchase-Order-list')); ?>" class="btn btn-primary"><i class="fa fa-envira"></i>  Purchase Order</a>
                </div>
            <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Total Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($item_list) && $item_list != ''): ?>
                        <?php $__currentLoopData = $item_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e(@$item->item_name); ?></td>
                                <td>hero</td>
                                <td>12</td>
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
<?php endif; ?>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ame_inventory\resources\views/appPages/item/main-stock.blade.php ENDPATH**/ ?>