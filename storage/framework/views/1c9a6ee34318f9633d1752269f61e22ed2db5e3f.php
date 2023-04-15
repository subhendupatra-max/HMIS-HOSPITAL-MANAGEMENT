
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Medicine</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('save-medicine-details')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo e(old('medicine_name')); ?>" placeholder="Enter Vehicle Number" required>
                        <?php $__errorArgs = ['medicine_name'];
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

                    <div class="form-group col-md-3">
                        <label for="medicine_catagory" class="form-label">Medicine Category <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" value="<?php echo e(old('medicine_catagory')); ?>" name="medicine_catagory" id="medicine_catagory" required>
                            <optgroup>
                                <option value=" ">Select Medicine Catagory </option>
                                <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->medicine_catagory_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        </select>
                        <?php $__errorArgs = ['medicine_catagory'];
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

                    <div class="form-group col-md-3">
                        <label for="medicine_company" class="form-label">Medicine Company <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medicine_company" name="medicine_company" value="<?php echo e(old('medicine_company')); ?>" placeholder="Enter Medicine Company ">
                        <?php $__errorArgs = ['medicine_company'];
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

                    <div class="form-group col-md-3">
                        <label for="medicine_composition" class="form-label">Medicine Composition <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medicine_composition" name="medicine_composition" value="<?php echo e(old('medicine_composition')); ?>" placeholder="Enter Medicine Composition">
                        <?php $__errorArgs = ['medicine_composition'];
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

                    <div class="form-group col-md-3">
                        <label for="medicine_group" class="form-label">Medicine Group </label>
                        <input type="text" class="form-control" id="medicine_group" name="medicine_group" value="<?php echo e(old('medicine_group')); ?>" placeholder="Enter Medicine Group">
                        <?php $__errorArgs = ['medicine_group'];
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

                    <!-- <div class="form-group col-md-3">
                        <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="unit" name="unit" value="<?php echo e(old('unit')); ?>" placeholder="Enter Unit ">
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
                    </div> -->

                    <div class="form-group col-md-3">
                        <label for="min_level" class="form-label">Min Level </label>
                        <input type="text" class="form-control" id="min_level" name="min_level" value="<?php echo e(old('min_level')); ?>" placeholder="Enter Min Level">
                        <?php $__errorArgs = ['min_level'];
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

                    <div class="form-group col-md-3">
                        <label for="re_order_level" class="form-label">Re-Order Level </label>
                        <input type="text" class="form-control" id="re_order_level" name="re_order_level" value="<?php echo e(old('re_order_level')); ?>" placeholder="Enter Min Level">
                        <?php $__errorArgs = ['re_order_level'];
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

                    <div class="form-group col-md-3">
                        <label for="tax" class="form-label">Tax</label>
                        <input type="text" class="form-control" id="tax" name="tax" value="<?php echo e(old('tax')); ?>" placeholder="Enter Tax">
                        <?php $__errorArgs = ['tax'];
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


                    <div class="form-group col-md-3">
                        <label for="note" class="form-label"> Note </label>
                        <textarea name="note" class="form-control"> </textarea>
                        <?php $__errorArgs = ['note'];
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

                    <div class="form-group col-md-6">
                        <label for="medicine_photo" class="form-label">Medicine Photo </label>
                        <input type="file" id="medicine_photo" name="medicine_photo" value="<?php echo e(old('medicine_photo')); ?>">
                        <?php $__errorArgs = ['medicine_photo'];
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

                    <hr class="hr_line" />

                    <!-- <div class="form-group col-md-6">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Box/Strip<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 40%">Strip/Box<span class="text-danger">*</span></th>
                                    </th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> -->

                    <div class="form-group col-md-4 mb-2">
                        <table class="table card-table table-vcenter text-nowrap" id="simiarmedicine">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Similar Medicine<span class="text-danger">*</span></th>
                                    </th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrowSimiliarMedicine()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <hr class="hr_line">

                    <div class="form-group col-md-8">
                        <table class="table card-table table-vcenter text-nowrap" id="baseUnit">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Base Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Value<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrowBaseUnit()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Medicine </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

<!-- <script>
    var i = 1;

    function addnewrow() {
        var html = `
                        <tr id="rowid${i}">
                        <td>
                        <input type="text" class="form-control" name="medicine_box_per_strips[]" id="boxStrips${i}" />
                        </td>
                        <td>
                        <input type="text" class="form-control" name="medicine_strips_per_box[]" id="stripsBox${i}" />
                        </td>
                               
                        <td>
                        <button type="button" class="btn btn-danger" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>
                       
                        </tr>`;

        $('#subhendu').append(html);
        i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script> -->



<script>
    var i = 1;

    function addnewrowSimiliarMedicine() {
        var html = `
                        <tr id="rowid${i}">
                        <td>
                        <select id="similiar_medicine_name${i}" class="form-control select2-show-search"
                        name="similiar_medicine_name[]">
                        <option value="">Select Medicine Name</option>
                        <?php $__currentLoopData = $similarMedicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->medicine_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </td>
                                                      
                        <td>
                        <button type="button" class="btn btn-danger" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>
                       
                        </tr>`;

        $('#simiarmedicine').append(html);
        i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>

<script>
    var p = 1;

    function addnewrowBaseUnit() {
        var html = `
                        <tr id="tabletrid${p}">
                        <td>
                        <select id="medicine_base_unit${p}" class="form-control select2-show-search"
                        name="medicine_base_unit[]">
                        <option value="">Select Base Unit</option>
                        <?php $__currentLoopData = $baseUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->medicine_unit_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </td>

                        <td>
                        <select id="medicine_unit${p}" class="form-control select2-show-search"
                        name="medicine_unit[]">
                        <option value="">Select Base Unit</option>
                        <?php $__currentLoopData = $baseUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->medicine_unit_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </td>
                         
                        <td>
                        <input type="text" class="form-control" name="value[]" id="value${p}" />
                        </td>
                        
                        <td>
                        <button type="button" class="btn btn-danger" onclick="removeBaseUnitrow(${p})"><i class="fa fa-trash"></i></button>
                        </td>
                       
                        </tr>`;

        $('#baseUnit').append(html);
        p = p + 1;

    }

    function removeBaseUnitrow(i) {
        $('#tabletrid' + i).empty();
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/medicine/add-medicine.blade.php ENDPATH**/ ?>