
<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Scrap Items</div>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($item_details)): ?>
                            <?php $__currentLoopData = $item_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $status = DB::table('scrap_details')->where('item_id',$value->item_id)->where('is_stock_in_scrab','1')->first();

                            ?>
                
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(url('scrap-item-details')); ?>/<?php echo e($value->item_id); ?>" style="color:blue" ><?php echo e($value->item_name); ?>(<?php echo e($value->item_description); ?>)</a></td>
                                <td>
                                    <?php if($status != null): ?>
                                        <span class="text-danger">Scrab Avilable</span>
                                    <?php else: ?>
                                        <span class="text-warning">Scrab Unavilable</span>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/item/scrap/scrap_item_list.blade.php ENDPATH**/ ?>