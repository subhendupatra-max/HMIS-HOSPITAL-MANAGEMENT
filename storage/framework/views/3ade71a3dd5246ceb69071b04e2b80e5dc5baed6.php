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
                        
                        <input type="text" id="medicine_name" name="medicine_name" value="<?php echo e(old('medicine_name')); ?>" required />
                        <label for="medicine_name">Medicine Name<span class="text-danger">*</span> </label>
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
                        
                        <select class="form-control select2-show-search select2-hidden-accessible" value="<?php echo e(old('medicine_catagory')); ?>" name="medicine_catagory" id="medicine_catagory" required>
                            <optgroup>
                                <option value=" ">Select Medicine Catagory<span class="text-danger">*</span> </option>
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
                        
                        <input type="text" id="medicine_company" name="medicine_company"  value="<?php echo e(old('medicine_company')); ?>" required />
                        <label for="medicine_company">Medicine Company </label>
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
                        
                        <input type="text" id="medicine_composition" name="medicine_composition" value="<?php echo e(old('medicine_composition')); ?>"  required />
                        <label for="medicine_company">Medicine Composition  </label>
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
                        
                        <input type="text" id="medicine_group" name="medicine_group" value="<?php echo e(old('medicine_group')); ?>"  required />
                        <label for="medicine_company">Medicine Group</label>
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

                  <div class="form-group col-md-3">
                        
                        <input type="text" id="unit" name="unit" value="<?php echo e(old('unit')); ?>"  required />
                        <label for="medicine_company">Unit<span class="text-danger">*</span></label>
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

                    <div class="form-group col-md-3">
                        
                        <input type="text" id="min_level" name="min_level" value="<?php echo e(old('min_level')); ?>"  required />
                        <label for="min_level">Enter Min Level<span class="text-danger">*</span></label>
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
                        
                        <input type="text" id="tax" name="tax" value="<?php echo e(old('tax')); ?>"  required />
                        <label for="tax">Tax</label>
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
                        
                        <input type="text" id="note" name="note"  required />
                        <label for="note">Note</label>
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
                        
                        <input type="file" id="medicine_photo" name="medicine_photo" value="<?php echo e(old('medicine_photo')); ?>"  required />
                        <label for="medicine_photo">Medicine Photo</label>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/medicine/add-medicine.blade.php ENDPATH**/ ?>