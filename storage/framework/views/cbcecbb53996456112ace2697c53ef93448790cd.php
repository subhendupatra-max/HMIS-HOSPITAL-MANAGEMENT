

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add item unit')): ?>
<div class="col-lg-12 col-xl-4 col-md-6 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Item Unit</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('UnitAddAction')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group">
                        <label for="role" class="form-label">Item Unit <span class="required" >*</span></label>
                        <input type="text" class="form-control" id="item_unit" name="item_unit" placeholder="Enter Item Unit" required>
                        <?php $__errorArgs = ['item_Unit'];
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
                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label">Base Unit</label>
                            <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" name="base_val" id="base_val">
                                <optgroup label="Base Unit">
                                    <option value="">--select--</option>
                                    <?php $__currentLoopData = $allItemUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->units); ?>"><?php echo e($item->units); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            </select>
                        </div>
                        <?php $__errorArgs = ['base_val'];
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
                    <div class="optional_value">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label">Operator</label>
                                <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" id="operator" name="operator" id="operator">
                                    <optgroup label="Mountain Time Zone">
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                        <option value="*">*</option>
                                        <option value="/">/</option>
                                    </optgroup>
                                </select>
                                <?php $__errorArgs = ['operator'];
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
                        <div class="form-group">
                            <label for="role" class="form-label">Operation Value</label>
                            <input type="text" class="form-control" id="operation_value" name="operation_value" placeholder="Enter Operation Value" >
                            <?php $__errorArgs = ['operation_value'];
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
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Item Unit</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-6 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item Unit List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Units</th>
                                <th class="border-bottom-0">Base Unit</th>
                                <th class="border-bottom-0">Operation Value</th>
                                <th class="border-bottom-0">Operations</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item unit')): ?>
                                    <th class="border-bottom-0">Remove Unit</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item unit')): ?>
                                    <th class="border-bottom-0">Edit Unit</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $allItemUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->units); ?></td>
                                    <td><?php echo e($item->base_unit); ?></td>
                                    <td><?php echo e($item->operation_value); ?></td>
                                    <td><?php echo e($item->operator); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete item unit')): ?>
                                      <td>
                                        <form action="<?php echo e(route('UnitDelete')); ?>" method="POST" id="delete">
                                          <?php echo csrf_field(); ?>
                                          <button class="btn btn-danger"  data-toggle="tooltip-primary" data-placement="top" title="Remove  Item unit" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                          <input type="hidden" name="item_unit" value="<?php echo e($item->id); ?>">
                                        </form>
                                      </td>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item unit')): ?>
                                      <td>
                                        <a href="<?php echo e(route('UnitEdit',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning"  data-toggle="tooltip-primary" data-placement="top" title="Edit Item unit"><i class="fa fa-pencil"></i></a>
                                      </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery js-->
<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $(".optional_value").addClass("d-none");
        $("#base_val").change(function (e) { 

            var baseUnit = $("#base_val").val();
            console.log("df");
            if (baseUnit != "") {
                $(".optional_value").removeClass("d-none");
                
            }else{
                $(".optional_value").addClass("d-none");
            }
            
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/master/itemUnit/itemUnit.blade.php ENDPATH**/ ?>