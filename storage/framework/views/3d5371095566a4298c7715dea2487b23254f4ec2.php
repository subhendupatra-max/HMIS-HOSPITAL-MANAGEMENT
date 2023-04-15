
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
            <div class="card-title">Add Item Type</div>
            <div class="card-body">

            </div>
        </div>

        <div class="card-body">
            <div class="">
                <form action="<?php echo e(route('addItemTypeAction')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="input-group">
                            <label class="form-label">Item Type<span class="required"> *</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="item_type" name="item_type" placeholder="Enter Item Type">
                            </div>
                            <?php $__errorArgs = ['item_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="mt-3 ml-3">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                    </div>
                </form>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item Type List</div>
            <div class="card-body">

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
                            <?php if(isset($data)): ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e(@$item->item_type); ?></td>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item')): ?>
                            <td>
                                <a href="<?php echo e(route('editItemType',$item->id)); ?>" class="btn btn-success btn-sm" data-toggle="tooltip-primary" data-placement="top" title="Edit Item Type"><i class="fa fa-pencil"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item')): ?>
                                <a href="<?php echo e(route('deleteItemType',$item->id)); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')" data-toggle="tooltip-primary" data-placement="top" title="Remove Item Type"><i class="fa fa-trash"></i></a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/master/item/item-type-list.blade.php ENDPATH**/ ?>