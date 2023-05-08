
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Medicine Stock
                </div>
                <div class="col-md-6 text-right">

                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Medicine Name</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">Medicine Composition</th>
                                <th class="border-bottom-0">Stock </th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update stock from back')): ?>
                                    <th class="border-bottom-0">Stock Update</th>
                                <?php endif; ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$medicine_stock): ?>
                            <?php $__currentLoopData = $medicine_stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if($value->available_quantity <= $value->min_level && $value->available_quantity > 0)
                            {
                                $stock_status = $value->available_quantity.' '.$value->medicine_unit_name.' <span class="badge badge-warning">Low Stock</span>';
                            }
                            elseif ($value->available_quantity <= 0 ) {
                                $stock_status = ' <span class="badge badge-danger">Out Of Stock</span>';
                            }
                            else {
                                $stock_status = $value->available_quantity .' '.$value->medicine_unit_name;
                            }

                             ?>
                                <tr>
                                    <td><a href= "<?php echo e(route('medicine-details',['medicine_id'=>$value->id])); ?>" class="text-info"><?php echo e($value->medicine_name); ?></a></td>
                                    <td><?php echo e($value->medicine_catagory_name); ?></td>
                                    <td><?php echo e($value->medicine_composition); ?></td>
                                    <td><?php echo $stock_status; ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update stock from back')): ?>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="<?php echo e(route('update-medicine-stock',['medicine_id'=>$value->id])); ?>">Update Stock</a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/medicine-stock.blade.php ENDPATH**/ ?>