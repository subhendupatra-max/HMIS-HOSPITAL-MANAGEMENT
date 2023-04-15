

<!-- Floating Labels Form -->
<form class="row g-3" method="POST" action="<?php echo e(route('addItem-variant')); ?>">
    <?php echo csrf_field(); ?>
<div class="col-md-12">
    <div class="input-group">
        <label  class="form-label">Item <span class="required">*</span></label>
        <div class="input-group">
            <select name="item" class="form-control" id="item">
                <option value="">Select item</option>
                <?php if(@$item_list): ?>

                <?php $__currentLoopData = $item_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>" <?php if($item_variant_edit != ''  && $item_variant_edit != null){ if($item_variant_edit['item_id'] == $item->id){ echo"selected";} } ?> ><?php echo e($item->item_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>
            </select>


        </div>
             <?php $__errorArgs = ['item'];
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
    <input type="hidden" class="form-control" id="item_variant_id" name="item_variant_id" value="<?php if($item_variant_edit != ''  && $item_variant_edit != null){ if($item_variant_edit['item_variant_id'] != null ){ echo $item_variant_edit['item_variant_id'] ;} } ?>">
    <div class="input-group">
        <label  class="form-label">Item Type<span class="required"> *</span></label>
        <div class="input-group">
            <input type="text" class="form-control" id="item_type" name="item_type" placeholder="Enter Item Type" >

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
    <div class="input-group">
        <label  class="form-label">Item Size</label>
        <div class="input-group">
            <input type="text" name="item_size" class="form-control" placeholder="Enter Item Size">

        </div>
          <?php $__errorArgs = ['reorder_level'];
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
    <div class="input-group">
        <label  class="form-label">Item Brand</label>
        <div class="input-group">
            <input type="text" name="item_size" class="form-control" placeholder="Enter Item Size">

        </div>
          <?php $__errorArgs = ['reorder_level'];
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


    <div class="input-group">
        <label  class="form-label">Item Variant Code<span class="required"> *</span></label>
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

    <div class="text-right mt-3 ml-3">
        <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
    </div>
</div>
</form><!-- End floating Labels Form -->

<script>
    function genrate_random_number()
    {
        var gen = Math.floor(Math.random()*900000) + 100000;
        $('#gjhjtihjitji').val(gen);

    }
</script>


<?php /**PATH E:\xampp\ame_inventory\resources\views/appPages/item/add_new_item_variant.blade.php ENDPATH**/ ?>