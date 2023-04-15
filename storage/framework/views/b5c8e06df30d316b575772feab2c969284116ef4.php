
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                   Item Transfer List 
                </div>
                
                <div class="col-md-8 text-right">
                    <div class="d-block">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Tranfer')): ?>
                        <a href="<?php echo e(route('item_transfer_form')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Tranfer</a>
                    <?php endif; ?>

                    <?php if(Auth::user()->workshop == 0): ?>
                    <a href="#"  class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                              <a class="dropdown-item" href="<?php echo e(route('item_main_stock')); ?>"><i class="fa fa-home"></i>  Full Stock</a>
                                <?php if(isset($workshops)): ?>
                                <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item" href="<?php echo e(url('item-main-stock')); ?>/<?php echo e(base64_encode( $value->id)); ?>"><i class="fa fa-home"></i>    <?php echo e($value->name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                  
                        </div>
                    <?php endif; ?>

                    </div>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/item/transfer/item-transfer-list.blade.php ENDPATH**/ ?>