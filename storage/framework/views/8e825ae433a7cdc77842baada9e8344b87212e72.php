
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Item</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="<?php echo e(route('itemAdd')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="form-label">Item Type<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="item_type_id" class="form-control">
                                            <option>Select One</option>
                                            <?php if(isset($item_type)): ?>
                                            <?php $__currentLoopData = $item_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->item_type); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['item_type_id'];
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
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="form-label">Item Name<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name">
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
   
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Loworder Level<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="loworder_level" name="loworder_level" placeholder="Enter Loworder Level">
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
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Item Unit<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select id="unit" name="unit[]" class="form-control select2" multiple>
                                        <option value="">---Select---</option>
                                            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->units); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Brand<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="brand_id" class="form-control select2">
                                            <option value="">---Select---</option>
                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->brand_name); ?></option>
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
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <label class="form-label">Manufacturer<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="manufacturer" class="form-control select2">
                                            <option value="" selected>---Select---</option>
                                            <?php $__currentLoopData = $manufacturer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->manufacturar_name); ?></option>
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
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <label class="form-label">Stored<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <textarea name="stored" class="form-control"></textarea>
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
                                        <textarea name="uses" class="form-control"></textarea>
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
                                        <input type="text" class="form-control" id="gjhjtihjitji" readonly name="product_code" placeholder="Generate Product code"><button type="button" onclick="genrate_random_number()" class="btn btn-success"><i class="fa fa-random"></i></button>
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
                                        <input type="text" class="form-control" id="hsn_or_sac_no" name="hsn_or_sac_no" placeholder="Enter HSN or SAC No">
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


                        </div>
                        <hr>
                        <table class="table table-bordered" id="dynamicTable">
                            <tr>
                                <th>Attribute Name</th>
                                <th>Value</th>
                                <th><button type="button" onclick="addattr()" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                            </tr>
                        </table>
                    </div>

                    <div class="text-right mt-3 ml-3">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $("#removeIcon").click(function(e) {
            e.preventDefault();
            $("#delete").submit();
        });
    });
</script>
<script>
    function genrate_random_number() {
        var gen = Math.floor(Math.random() * 900000) + 100000;
        $('#gjhjtihjitji').val(gen);

    }
</script>
<script>
    var i = 1;

    function addattr() {

        var html = '<tr id="row' + i + '"><td><select required class="form-control" name="item_attribute[]"><option>Select One</option> <?php if(isset($item_attribute)): ?> <?php $__currentLoopData = $item_attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->attribute_name); ?>"><?php echo e($value->attribute_name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><input type="text" class="form-control" required name="attribute_value[]"></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-remove"></i></button></td></tr>';

        console.log(html);
        $('#dynamicTable').append(html);
        i = i + 1;

    }

    function remove(i) {
        $('#row' + i).remove();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/master/item/add-item.blade.php ENDPATH**/ ?>