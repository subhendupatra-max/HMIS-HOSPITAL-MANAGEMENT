
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

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Item Issue Inventory')): ?>
                        <a href="<?php echo e(route('item-issue-listing-inventory')); ?>" class="btn btn-primary"> <i class="fa fa-cart-arrow-down"></i> Issue Item</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Requisition')): ?>
                        <a href="<?php echo e(route('all-inventory-requisition-listing')); ?>" class="btn btn-primary"><i class="fa fa-file"></i> Requisition</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Purchase Order')): ?>
                        <a href="<?php echo e(route('Purchase-Order-list-inventory')); ?>" class="btn btn-primary"><i class="fa fa-file-invoice"></i> Purchase Order</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('GRN Inventory')): ?>
                        <a href="<?php echo e(route('grm-list-inven')); ?>" class="btn btn-primary"><i class="fa fa-list"></i> GRN</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Return PO Item')): ?>
                        <a href="<?php echo e(route('return-list-inventory')); ?>" class="btn btn-primary"><i class="fa fa-undo"></i> Return</a>
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
                                <th scope="col">Item Type</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Part No</th>
                                <th scope="col">Low Order Level</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update stock from back inventory')): ?>
                                <th class="border-bottom-0">Stock Update</th>
                                <?php endif; ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($item_stock_list)): ?>
                            <?php $__currentLoopData = $item_stock_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="#" style="color:blue"><?php echo e(@$value->item_name); ?>(<?php echo e($value->item_description); ?>)</a></td>
                                <td><?php echo e(@$value->fetch_itemTypes_details->item_type_name); ?></td>
                                <?php
                                $item_stock = DB::table('inventory_item_stocks')
                                    ->where('item_id', $value->id)->sum('quantity');

                                $item_issue = DB::table('inventory_item_issue_details')
                                    ->where('item_id', $value->id)->sum('quantity');

                                $stock = ($item_stock - $item_issue);

                                ?>
                                <td>
                                    <?php echo e(@$stock); ?> <?php echo e(@$value->item_unit_name->units); ?>

                                </td>
                                <td>
                                    <?php echo e(@$value->part_no); ?>

                                </td>
                                <td>
                                    <?php echo e(@$value->loworder_level); ?>

                                </td>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update stock from back inventory')): ?>
                                <td>
                                    <a class="btn btn-success btn-sm" href="<?php echo e(route('update-inventory-stock',['item_id' => $value->id ])); ?>">Update Stock</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/item-stock-details.blade.php ENDPATH**/ ?>