
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Requisition</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('update-medicine-requisition-details')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo e($editMedicineRequisition->id); ?>" />
                    <div class="col-md-3">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required <?php if(isset($editMedicineRequisition->date)): ?> value="<?php echo e(date('Y-m-d h:m:s',strtotime($editMedicineRequisition->date))); ?>" <?php endif; ?>>
                        <?php $__errorArgs = ['date'];
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


                    <div class="col-md-3">
                        <label class="form-label">Permission Authority <span class="text-danger">*</span></label>
                        <select name="permission_authority[]" required multiple="multiple" class="multi-select select2-show-search">
                            <option value="">Select One</option>
                            <?php if($user_list): ?>
                            <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->first_name); ?> <?php echo e($value->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['permission_authority'];
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

                    <div class="col-md-3">
                        <label class="form-label">Permission Type <span class="text-danger">*</span></label>
                        <select name="permission_type" required class="select2-show-search">
                            <option value="">Select</option>
                            <?php $__currentLoopData = Config::get('static.permission_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $permissiton_types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($permissiton_types); ?>" <?php echo e($permissiton_types == $editMedicineRequisition->permission_type ? 'selected' : " "); ?>> <?php echo e($permissiton_types); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['permission_type'];
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


                    <div class="form-group col-md-12">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Medicine Catagory<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Neme<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Qty<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $editMedicineRequisitionQty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="rowid<?php echo $key ?>">
                                    <td>
                                        <select class="form-control select2-show-search " value="<?php echo e(old('medicine_catagory')); ?>" data-medicine_name="<?php echo e($value->medicine_name); ?>" onchange="getCatagoryId(this.value,<?php echo $key ?>)" name="medicine_catagory[]" id="medicine_catagory${i}" required>
                                            <optgroup>
                                                <option value=" ">Select Medicine Catagory </option>
                                                <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $value->medicine_catagory ? 'selected' : " "); ?>><?php echo e($item->medicine_catagory_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                        </select>
                                    </td>

                                    <td>
                                        <select name="medicine_name[]" class="form-control select2-show-search" id="medicine_name${i}" required onchange="getMedicineNameId(this.value,<?php echo $key ?>)">
                                            <option value="">Select Medicine Name...</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select name="medicine_unit[]" class="form-control select2-show-search" id="medicine_unit${i}" required value="<?php echo e($value->medicine_unit); ?>">
                                            <option value="">Select Medicine Unit...</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" id="qty${i}" name="qty[]" required value="<?php echo e($value->qty); ?>">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removerow('<?php echo e($key); ?>')"><i class="fa fa-trash"></i></button>
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Requisition </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>



<script>
    var p = 1;

    function addnewrow() {
        var table = document.getElementById("subhendu");
        var table_len = (table.rows.length);
        var i = parseInt(table_len);
        i = i + 1;
        var html = `   
                        <tr id="rowid${i}">
                        <td>
                        <select class="form-control select2-show-search " value="<?php echo e(old('medicine_catagory')); ?>" onchange="getCatagoryId(this.value,${i})" name="medicine_catagory[]" id="medicine_catagory${i}" required>
                            <optgroup>
                                <option value=" ">Select Medicine Catagory </option>
                                <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->medicine_catagory_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        </select>
                        </td>

                        <td>
                        <select name="medicine_name[]" class="form-control select2-show-search" id="medicine_name${i}" required onchange="getMedicineNameId(this.value,${i})">
                            <option value="">Select Medicine Name...</option>
                        </select>
                        </td>

                        <td>
                        <select name="medicine_unit[]" class="form-control select2-show-search" id="medicine_unit${i}" required>
                            <option value="">Select Medicine Unit...</option>
                        </select>
                        </td>

                        <td>
                        <input type="text" class="form-control" id="qty${i}" name="qty[]" required>
                        </td>
                                                     
                        <td>
                        <button type="button" class="btn btn-danger" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>
                       
                        </tr>`;

        $('#subhendu').append(html);
        p = p + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>

<script>
    function getCatagoryId(catagory, rowid) {

        // alert(rowid);
        $('#medicine_name' + rowid).empty();
        var name = $(this).attr("data-medicine_name");
        // alert(name);
        $('#medicine_name' + rowid).html('<option value="" >Select...</option>');

        $.ajax({
            url: "<?php echo e(route('find-medicine-name-by-medicine-catagory-in-requisition')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                catagory_id: catagory,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == name ? 'selected' : '');
                    $('#medicine_name' + rowid).append(`<option value="${value.id}" ${sel}>${value.medicine_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    function getMedicineNameId(medicineName, lineid) {

        $('#medicine_unit' + lineid).empty();
        $('#medicine_unit' + lineid).html('<option value="" >Select...</option>');

        $.ajax({
            url: "<?php echo e(route('find-medicine-unit-by-medicine-name-in-requisition')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                medicineName_id: medicineName,
            },
            success: function(response) {

                // console.log(response);
                $.each(response, function(key, value) {

                    $('#medicine_unit' + lineid).append(`<option value="${value.id}">${value.medicine_unit_name}</option>`);

                });
            },
            error: function(error) {
                console.log(error);
            }
        });


    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/purchase/requisition/edit-medicine-requisition.blade.php ENDPATH**/ ?>