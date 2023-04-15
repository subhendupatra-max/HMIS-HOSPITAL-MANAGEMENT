<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item List</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="<?php echo e(route('addItem')); ?>">
                    <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                        <div class="input-group">
                            <label  class="form-label">Item Category <span class="required">*</span></label>
                            <div class="input-group">
                                <select name="itemcategory" class="form-control" id="itemcategory">
                                    <option value="">Select Category</option>
                                    <?php if(@$itemcategory_list): ?>
                                    <?php $__currentLoopData = $itemcategory_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($itemcategory->id); ?>" ><?php echo e($itemcategory->categories); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['itemcategory'];
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
                       <div class="col-md-4">
                        <div class="input-group">
                            <label  class="form-label">Item Name<span class="required"> *</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="item_name" name="item_name"
                                    placeholder="Enter Item Name" >
                            </div>
                            <?php $__errorArgs = ['item_name'];
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
                    
                    <div class="col-md-4">
                        <div class="input-group">
                            <label  class="form-label">Product Code<span class="required"> *</span></label>
                            <div class="input-group">
                                <input  type="text" class="form-control" id="gjhjtihjitji" name="product_code" placeholder="Generate Product code"><button type="button" onclick="genrate_random_number()" class="btn btn-success"><i class="fa fa-random"></i></button>
                            </div>
                            <?php $__errorArgs = ['product_code'];
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
                        <div class="text-right mt-3 ml-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                        </div>
                    </div>
                    </div>
                </form>
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
<script>
    function genrate_random_number()
    {
        var gen = Math.floor(Math.random()*900000) + 100000;
        $('#gjhjtihjitji').val(gen);

    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ame_inventory\resources\views/appPages/master/item/add_new_item.blade.php ENDPATH**/ ?>