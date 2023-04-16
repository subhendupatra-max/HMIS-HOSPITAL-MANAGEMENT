
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <?php if(session('success')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item List</div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add item')): ?>
            <div class="btn-list create_req">
                <a href="<?php echo e(route('additemList')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Item</a>
            </div>
            <?php endif; ?>
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
                                <th scope="col">Stored</th>
                                <th scope="col">Uses</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Manufacturer Name</th>
                                <th scope="col">HSN or SAC No</th>
                                <th scope="col">Loworder Level</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item || delete item')): ?>
                                    Action
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($itemList)): ?>
                            <?php $__currentLoopData = $itemList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e(@$item->item_name); ?> (<?php echo e(@$item->item_description); ?>)</td>
                                <td><?php echo @$item->stored; ?></td>
                                <td><?php echo @$item->uses; ?></td>
                                <td><?php echo e(@$item->brand_name); ?></td>
                                <td><?php echo e(@$item->manufacturar_name); ?></td>
                                <td><?php echo e(@$item->hsn_or_sac_no); ?></td>
                                <td><?php echo e(@$item->loworder_level); ?></td>
                                <td>
                                    <div class="text-center">
                                        <img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode($item->product_code, $generatorPNG::TYPE_CODE_128))); ?>"><br><?php echo e($item->product_code); ?>

                                    </div>
                                </td>
                                <td>

                                    <a href="#"  class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('editItem',$item->id)); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('deleteItem',$item->id)); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>
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

<script>
    $(document).ready(function() {
        $("#removeIcon").click(function(e) {
            // e.preventDefault();
            $("#delete").submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/master/item/item-list.blade.php ENDPATH**/ ?>