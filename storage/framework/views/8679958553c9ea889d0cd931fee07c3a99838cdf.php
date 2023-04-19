<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Medicine</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('update-medicine-details')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo e($editMedicine->id); ?>" />
                    <div class="form-group col-md-3">
                        <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo e($editMedicine->medicine_name); ?>" required>
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
                                <option value=" ">Select Vehicle Model </option>
                                <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $editMedicine->medicine_catagory ? 'selected' : " "); ?>><?php echo e($item->medicine_catagory_name); ?></option>
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
                        <label for="medicine_company" class="form-label">Medicine Company </label>
                        <input type="text" class="form-control" id="medicine_company" name="medicine_company" value="<?php echo e($editMedicine->medicine_company); ?>" placeholder="Enter Medicine Company ">
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
                        <label for="medicine_composition" class="form-label">Medicine Composition </label>
                        <input type="text" class="form-control" id="medicine_composition" name="medicine_composition" value="<?php echo e($editMedicine->medicine_composition); ?>" placeholder="Enter Medicine Composition">
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
                        <input type="text" class="form-control" id="medicine_group" name="medicine_group" value="<?php echo e($editMedicine->medicine_group); ?>" placeholder="Enter Medicine Group">
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
                        <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="unit" name="unit" value="<?php echo e($editMedicine->unit); ?>" placeholder="Enter Unit ">
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
                        <label for="min_level" class="form-label">Low Level <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="min_level" name="min_level" value="<?php echo e($editMedicine->min_level); ?>" placeholder="Enter Min Level">
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
                        <label for="tax" class="form-label">Tax</label>
                        <input type="text" class="form-control" id="tax" name="tax" value="<?php echo e($editMedicine->tax); ?>" placeholder="Enter Tax">
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
                        <textarea name="note" class="form-control"> <?php echo e($editMedicine->note); ?> </textarea>
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
                                <?php $__currentLoopData = $medicine_box_strip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $medicine_box_strips): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="boxstripsmedicine<?php echo $key ?>">
                                    <td><input type="text" name="medicine_box_per_strips[]" value="<?php echo e($medicine_box_strips->medicine_box_per_strips); ?>" class="form-control " />
                                    <td><input type="text" name="medicine_strips_per_box[]" value="<?php echo e($medicine_box_strips->medicine_strips_per_box); ?>" class="form-control " />
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removeboxstripMedicne('<?php echo e($key); ?>')"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div> -->

                    <div class="form-group col-md-4">
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
                                <?php $__currentLoopData = $editSimilarMedicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="similarMedicine<?php echo $key ?>">
                                    <td>
                                        <select id="similiar_medicine_name" class="form-control select2-show-search" name="similiar_medicine_name[]">
                                            <option value="">Select Medicine Name</option>
                                            <?php $__currentLoopData = $similarMedicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == @$value->medicine_name ? 'selected' : " "); ?>><?php echo e($item->medicine_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removesimilermedicine('<?php echo e($key); ?>')"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        var table = document.getElementById("subhendu");
        var table_len = (table.rows.length);
        var i = parseInt(table_len);
        i = i + 1;
        var html = `
                        <tr id="boxstripsmedicine${i}">
                        <td>
                        <input type="text" class="form-control" name="medicine_box_per_strips[]" id="boxStrips${i}" />
                        </td>
                        <td>
                        <input type="text" class="form-control" name="medicine_strips_per_box[]" id="stripsBox${i}" />
                        </td>

                        <td>
                        <button type="button" class="btn btn-danger" onclick="removeboxstripMedicne(${i})"><i class="fa fa-times"></i></button>
                        </td>

                        </tr>`;

        $('#subhendu').append(html);
        // i = i + 1;

    }

    function removeboxstripMedicne(i) {
        $('#boxstripsmedicine' + i).remove();
    }
</script> -->



<script>
    var i = 1;

    function addnewrowSimiliarMedicine() {
        var table = document.getElementById("simiarmedicine");
        var table_len = (table.rows.length);
        var j = parseInt(table_len);
        j = j + 1;
        var html = `
                        <tr id="similarMedicine${j}">
                        <td>
                        <select id="similiar_medicine_name${j}" class="form-control select2-show-search"
                        name="similiar_medicine_name[]">
                        <option value="">Select Medicine Name</option>
                        <?php $__currentLoopData = $similarMedicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" ><?php echo e($item->medicine_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </td>

                        <td>
                        <button type="button" class="btn btn-danger" onclick="removesimilermedicine(${j})"><i class="fa fa-times"></i></button>
                        </td>

                        </tr>`;

        $('#simiarmedicine').append(html);


    }

    function removesimilermedicine(k) {
        $('#similarMedicine' + k).remove();
    }
</script>


<script>
    var p = 1;

    function addnewrowBaseUnit() {
        var table = document.getElementById("baseUnit");
        var table_len = (table.rows.length);
        var p = parseInt(table_len);
        p = p + 1;
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
                        <button type="button" class="btn btn-danger" onclick="removeBaseUnitrow(${p})"><i class="fa fa-times"></i></button>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/medicine/edit-medicine.blade.php ENDPATH**/ ?>