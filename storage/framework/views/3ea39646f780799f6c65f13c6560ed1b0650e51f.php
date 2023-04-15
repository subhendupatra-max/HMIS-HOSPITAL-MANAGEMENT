<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add item')): ?>
    <div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Item</h4>

            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session()->has('error')): ?>
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
                <?php endif; ?>

               <?php echo $__env->make('appPages.item.add_new_item',['item_list_edit'=>$item_list_edit], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Item List</div>

            </div>
<?php
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
?>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Bar</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Reorder Lavel</th>
                            <th scope="col">Loworder Lavel</th>
                            <th scope="col">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item || delete item')): ?>
                              Action
                            <?php endif; ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($item_list) && $item_list != ''): ?>
                        <?php $__currentLoopData = $item_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e(@$item->item_name); ?></td>
                                <td><img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode($item->product_code, $generatorPNG::TYPE_CODE_128))); ?>">
                                    <br><span style="margin-left: 20px"><?php echo e(@$item->product_code); ?></span></td>
                                <td><?php echo e(@$item->categories); ?></td>
                                <td><?php echo e(@$item->reorder_level); ?></td>
                                <td><?php echo e(@$item->low_level); ?></td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item')): ?>
                                <td>
                                    <a href="<?php echo e(url('/item-edit')); ?>/<?php echo e($item->item_id); ?>"
                                        class="btn btn-success btn-sm" data-toggle="tooltip-primary" data-placement="top"
                                        title="Edit Item"><i
                                            class="fa fa-pencil"></i></a>

                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item')): ?>
                                <a href="<?php echo e(url('/item-delete')); ?>/<?php echo e($item->item_id); ?>"
                                    class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')" data-toggle="tooltip-primary" data-placement="top"
                                    title="Remove Item"><i
                                        class="fa fa-trash"></i></a>
                                </td>
                                <?php endif; ?>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ame_inventory\resources\views/appPages/item/addItem.blade.php ENDPATH**/ ?>