
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item Type List</div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add item')): ?>
            <div class="btn-list ggdtretew">
                <a href="<?php echo e(route('addItemType')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Item Type</a>
            </div>

            <?php endif; ?>
            <div class="card-body">
                <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session()->has('error')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
                <?php endif; ?>
            </div>
        </div>
       
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Item Type</th>
                                <th scope="col">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item || delete item')): ?>
                                    Action
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e(@$list->item_type); ?></td>
                                                               
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item')): ?>
                                <td>
                                    <a href="#"
                                        class="btn btn-success btn-sm" data-toggle="tooltip-primary" data-placement="top"
                                        title="Edit Item"><i
                                        class="fa fa-pencil"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item')): ?>
                                    <a href="<?php echo e(route('deleteItemType',@$list->id)); ?>"
                                        class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')" data-toggle="tooltip-primary" data-placement="top"
                                        title="Remove Item"><i
                                        class="fa fa-trash"></i></a>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ame_inventory\resources\views/appPages/master/item/item-type-list.blade.php ENDPATH**/ ?>