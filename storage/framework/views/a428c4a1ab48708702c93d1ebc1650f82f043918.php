

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

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="<?php echo e(route('addItem')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <label>Item Category</label><span class="required"> *</span>
                            <select name="itemcategory" class="form-control" id="itemcategory">
                                <option value="">Select Category</option>
                                <?php if(@$itemcategory_list): ?>

                                <?php $__currentLoopData = $itemcategory_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($itemcategory->id); ?>"><?php echo e($itemcategory->categories); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['itemcategory'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($itemcategory_message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <label>Item Name</label><span class="required"> *</span>
                            <input type="text" class="form-control" id="item_name" name="item_name"
                            placeholder="Enter Item Name" required>
                            <?php $__errorArgs = ['item_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($item_name_message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <label>Store</label>
                            <select name="store" class="form-control">
                                <option value="">Select Store</option>
                                <?php if(@$store_list): ?>

                                <?php $__currentLoopData = $store_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($store_->id); ?>"><?php echo e($store_->store); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['store'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($store_message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                            <label>Rack</label>
                            <select name="rack" class="form-control">
                                <option value="">Select Rack</option>
                                <?php if(@$rack_list): ?>

                                <?php $__currentLoopData = $rack_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rack_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($rack_->id); ?>"><?php echo e($rack_->rack); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['rack'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($rack_message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <label>Reorder Level</label>
                            <input type="text" class="form-control" id="reorder_level" name="reorder_level"
                                placeholder="Enter Reorder Level" required>
                            <?php $__errorArgs = ['reorder_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($reorder_level_message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <label>Loworder Level</label><span class="required"> *</span>
                            <input type="text" class="form-control" id="loworder_level" name="loworder_level"
                                placeholder="Enter Loworder Level" required>
                            <?php $__errorArgs = ['loworder_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($loworder_level_message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <label>Unit</label><span class="required"> *</span>
                            <select name="unit" id="unit" class="form-control">
                                <option value="">Select Unit</option>
                                <?php if(@$unit_list): ?>

                                <?php $__currentLoopData = $unit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($unit_->id); ?>"><?php echo e($unit_->unit); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($unit_message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="text-start mt-3 ml-3">
                        <button type="submit" class="btn btn-primary"><i class="ri-add-circle-fill"></i>&nbsp;Add
                            Item</button>
                    </div>
                </form><!-- End floating Labels Form -->

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
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Store</th>
                            <th scope="col">Rack</th>
                            <th scope="col">Reorder Lavel</th>
                            <th scope="col">Loworder Lavel</th>
                            <th scope="col">Unit</th>
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
                                <td><?php echo e(@$item->categories); ?></td>
                                <td><?php echo e(@$item->store); ?></td>
                                <td><?php echo e(@$item->rack); ?></td>
                                <td><?php echo e(@$item->reorder_level); ?></td>
                                <td><?php echo e(@$item->low_level); ?></td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item')): ?>
                                <td>
                                    <a href="<?php echo e(route('itemEdit', ['id' => base64_encode($item->id)])); ?>"
                                        class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top"
                                        title="Edit Item"><i
                                            class="fa fa-pencil"></i></a>

                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item')): ?>

                                    <form action="<?php echo e(route('itemPermission')); ?>" method="POST" id="delete">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"
                                            data-toggle="tooltip-primary" data-placement="top" title=""
                                            data-title="Remove Item"><i
                                                class="fa fa-trash"></i></button>
                                        <input type="hidden" name="permId" value="<?php echo e($item->id); ?>">
                                    </form>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ame_inventory\resources\views/appPages/item/addItem.blade.php ENDPATH**/ ?>