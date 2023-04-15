
<?php $__env->startSection('content'); ?>

<script>
    var i = 1;

    function addattr() {

        var html = '<tr id="row' + i + '"><td><select class="form-control" name="item_attribute[]"><option>Select One</option> <?php if(isset($item_attribute)): ?> <?php $__currentLoopData = $item_attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->attribute_name); ?>"><?php echo e($value->attribute_name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><input type="text" class="form-control" name="attribute_value[]"></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-remove"></i></button></td></tr>';

        console.log(html);
        $('#dynamicTable').append(html);
        i = i + 1;

    }

    function remove(i) {
        $('#row' + i).remove();
    }
</script>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Item</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="<?php echo e(route('editItemAction',$item->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label class="form-label">Item Type<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="item_type_id" class="form-control">
                                            <option>Select One</option>
                                            <?php if(isset($item_type)): ?>
                                            <?php $__currentLoopData = $item_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $item->item_type_id ? 'selected' : ''); ?>><?php echo e($value->item_type); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
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
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label class="form-label">Item Name<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?php echo e($item->item_name); ?>" id="item_name" name="item_name" placeholder="Enter Item Name">
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
      
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Loworder Level<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?php echo e($item->loworder_level); ?>" id="loworder_level" name="loworder_level" placeholder="Enter Loworder Level">
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
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Brand<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="brand_id" class="form-control select2">
                                            <option value="" selected>---Select---</option>
                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $item->brand_id ? 'selected' : ''); ?>><?php echo e($value->brand_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['brand_id'];
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
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Manufacturer<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="manufacturer" class="form-control select2">
                                            <option value="">---Select---</option>
                                            <?php $__currentLoopData = $manufacturer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"
                                          
                                             <?php echo e($value->id == $item->manufacturer ? 'selected' : ''); ?>


                                             ><?php echo e($value->manufacturar_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['manufacturer'];
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
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Item Unit<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select id="unit" name="unit[]" class="form-control select2" multiple>
                                        <option value="">---Select---</option>
                                            <?php foreach ($units as $values)
                                                { ?>
                                            <option value="<?php echo e($values->id); ?>" 
                                                <?php foreach ($item_unit as $value)
                                                {
                                                  if($values->id == $value->unit_id)
                                                  {
                                                    echo 'selected';
                                                  }
                                                } ?>


                                                ><?php echo e($values->units); ?></option>
                                           <?php } ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['unit'];
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
                                <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <label class="form-label">Stored<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <textarea name="stored" class="form-control"><?php echo e(@$item->stored); ?></textarea>
                                    </div>
                                    <?php $__errorArgs = ['stored'];
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
                               <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <label class="form-label">Uses<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <textarea name="uses" class="form-control"><?php echo e(@$item->uses); ?></textarea>
                                    </div>
                                    <?php $__errorArgs = ['uses'];
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
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Product Code<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?php echo e($item->product_code); ?>" readonly name="product_code" placeholder="Generate Product code">
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
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <label class="form-label">HSN or SAC No<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?php echo e($item->hsn_or_sac_no); ?>" id="hsn_or_sac_no" name="hsn_or_sac_no" placeholder="Enter HSN or SAC No">
                                    </div>
                                    <?php $__errorArgs = ['hsn_or_sac_no'];
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
                               <hr>
                        <table class="table table-bordered" id="dynamicTable">
                            <tr>
                                <th>Attribute Name</th>
                                <th>Value</th>
                                <th><button type="button" onclick="addattr()" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                            </tr>
                            <?php 
                            if(!empty($item_description))
                            { $i = 1;
                            foreach($item_description as $values){
                             ?>
                            <tr id="row<?php echo $i; ?>">
                            <td>
                                <select class="form-control" name="item_attribute[]">
                                    <option value="">Select One</option>
                                    <?php if(isset($item_attribute)): ?>
                                    <?php $__currentLoopData = $item_attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option <?php if($value->attribute_name == $values->attribute_name ){ echo"Selected";} ?> value="<?php echo e($value->attribute_name); ?>"><?php echo e($value->attribute_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="attribute_value[]" value="<?php echo e($values->attribute_value); ?>">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="remove(<?php echo $i; ?>)"><i class="fa fa-remove"></i></button>
                                </td>
                            </tr>

                            <?php $i++; }  } ?>

                        </table>


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
    function genrate_random_number() {
        var gen = Math.floor(Math.random() * 900000) + 100000;
        $('#gjhjtihjitji').val(gen);

    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/master/item/edit-item.blade.php ENDPATH**/ ?>