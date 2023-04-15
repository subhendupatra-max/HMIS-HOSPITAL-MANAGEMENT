
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('main stock')): ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Item Stock</div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view requisition')): ?>
                <div class="btn-list ggdtretew">
                    <a href="<?php echo e(route('requisition-list')); ?>" class="btn btn-primary"><i class="fa fa-file"></i> Requisition</a>
                </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Purchase Order')): ?>
                <div class="btn-list fgrgreyreyr">
                    <a href="<?php echo e(route('Purchase-Order-list')); ?>" class="btn btn-primary"><i class="fa fa-envira"></i>  Purchase Order</a>
                </div>
            <?php endif; ?>
                <div class="btn-list fgrgeyr">
                    <a href="#"  class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                          <a class="dropdown-item" href="#"><i class="fa fa-home"></i>  Full Stock</a>
                            <?php if(isset($workshops)): ?>
                            <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item" href="#"><i class="fa fa-home"></i>    <?php echo e($value->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                              
                    </div>
                </div>
            </div>
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

                            <tr>
                                <th scope="row">1</th>
                                <td style="color:blue">Front Wheel</td>
                                <td>12</td>
                            </tr>

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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ame_inventory\resources\views/appPages/item/main-stock.blade.php ENDPATH**/ ?>