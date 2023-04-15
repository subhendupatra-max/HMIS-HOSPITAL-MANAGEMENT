

<!-- Floating Labels Form -->
<form class="row g-3" method="POST" action="<?php echo e(route('addItem')); ?>">
    <?php echo csrf_field(); ?>
<div class="col-md-12">
    <div class="input-group">
        <label  class="form-label">Item Category <span class="required">*</span></label>
        <div class="input-group">
            <select name="itemcategory" class="form-control" id="itemcategory">
                <option value="">Select Category</option>
                <?php if(@$itemcategory_list): ?>

                <?php $__currentLoopData = $itemcategory_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($itemcategory->id); ?>" <?php if($item_list_edit != ''  && $item_list_edit != null){ if($item_list_edit['category_id'] == $itemcategory->id){ echo"selected";} } ?> ><?php echo e($itemcategory->categories); ?></option>
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
    <input type="hidden" class="form-control" id="item_id" name="item_id" value="<?php if($item_list_edit != ''  && $item_list_edit != null){ if($item_list_edit['item_id'] != null ){ echo $item_list_edit['item_id'] ;} } ?>">
    <div class="input-group">
        <label  class="form-label">Item Name<span class="required"> *</span></label>
        <div class="input-group">
            <input type="text" class="form-control" id="item_name" name="item_name" value="<?php if($item_list_edit != ''  && $item_list_edit != null){ if($item_list_edit['item_name'] != null ){ echo $item_list_edit['item_name'] ;} } ?>"
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
    <div class="input-group">
        <label  class="form-label">Reorder Level</label>
        <div class="input-group">
            <input type="text" class="form-control" value="<?php if($item_list_edit != ''  && $item_list_edit != null){ if($item_list_edit['reorder_level'] != null ){ echo $item_list_edit['reorder_level'];} } ?>" id="reorder_level" name="reorder_level"
                placeholder="Enter Reorder Level">

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
        <label  class="form-label">Loworder Level</label>
        <div class="input-group">
            <input type="text" class="form-control" value="<?php if($item_list_edit != ''  && $item_list_edit != null){ if($item_list_edit['low_level'] != null ){ echo $item_list_edit['low_level'];} } ?>" id="loworder_level" name="loworder_level"
                placeholder="Enter Loworder Level">

        </div>
         <?php $__errorArgs = ['loworder_level'];
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
        <label  class="form-label">Product Code<span class="required"> *</span></label>
        <div class="input-group">
            <input  type="text" value="<?php if($item_list_edit != ''  && $item_list_edit != null){ if($item_list_edit['product_code'] != null ){ echo $item_list_edit['product_code'];} } ?>" class="form-control" id="gjhjtihjitji" name="product_code" placeholder="Generate Product code"><button type="button" onclick="genrate_random_number()" class="btn btn-success"><i class="fa fa-random"></i></button>
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


<?php /**PATH E:\xampp\ame_inventory\resources\views/appPages/item/add_new_item.blade.php ENDPATH**/ ?>