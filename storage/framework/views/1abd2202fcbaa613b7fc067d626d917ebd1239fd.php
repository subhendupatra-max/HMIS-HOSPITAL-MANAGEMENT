
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Requisition</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('save-medicine-requisition-details')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <div class="col-md-3 newuserrchange">
                        <label class="form-label">Checked By <span class="text-danger">*</span></label>
                        <select name="checked_by" class="form-control select2-show-search">
                            <option value="">Select One</option>
                            <?php if($user_list): ?>
                            <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->first_name); ?> <?php echo e($value->last_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['checked_by'];
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

                    <div class="col-md-3 newuserrchange">
                        <label class="form-label">Requested By <span class="text-danger">*</span></label>
                        <select name="requested_by" class="form-control select2-show-search ">
                            <option value="">Select One</option>
                            <?php if($user_list): ?>
                            <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->first_name); ?> <?php echo e($value->last_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['requested_by'];
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

                    <div class="col-md-3 newuserrchange ">
                        <label for="store_room" class="form-label">Store Room <span class="text-danger">*</span></label>
                        <select name="store_room" class="form-control select2-show-search">
                            <option value="">Select One</option>
                            <?php if($store_room_list): ?>
                            <?php $__currentLoopData = $store_room_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-md-3  addrequistiondate">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>

                        <input type="datetime-local" class="form-control" id="date" name="date" required>
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

                    

                


    


    <div class="form-group col-md-12">
        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
            <thead>
                <tr>
                    <th scope="col" style="width: 60%">Medicine Name<span class="text-danger">*</span></th>
                    <th scope="col" style="width: 30%">Medicine Unit<span class="text-danger">*</span></th>
                    <th scope="col" style="width: 30%">Qty<span class="text-danger">*</span></th>
                    <th scope="col" style="width: 2%">
                        <button type="button" class="btn btn-success  btn-sm" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                    </th>
                </tr>
            </thead>
            <tbody id="trLength">

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



<!-- medicne add model -->

<script>
    var i = $('#trLength tr').length;
    i = i + 1;

    function addnewrow() {
        var html = `<tr id="rowid${i}">
                        <td>
                        <select name="medicine_name[]" class="form-control select2-show-search" id="medicine_name${i}" required onchange="getMedicineNameId(this.value,${i})">
                            <option value="">Select Medicine Name...</option>
                            <?php $__currentLoopData = $medicine_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e(@$item->medicine_name); ?>(<?php echo e(@$item->catagory_name->medicine_catagory_name); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <button type="button" class="btn btn-danger btn-sm" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>`;

        $('#trLength').append(html);
        i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>
</script>

<script>
    function getCatagoryId(catagory, rowid) {

        // alert(rowid);
        $('#medicine_name' + rowid).empty();
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
                    $('#medicine_name' + rowid).append(
                        `<option value="${value.id}">${value.medicine_name}</option>`);

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

                $('#medicine_unit' + lineid).append(
                    `<option value="${response.id}">${response.medicine_unit_name}</option>`);
            },
            error: function(error) {
                console.log(error);
            }
        });


    }
</script>

<script>
    function fdsfds(value) {

        if (value == 'yes') {
            $('#pop').removeAttr('style', true);
        } else {
            $('#pop').attr('style', 'display:none');
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/purchase/requisition/add-medicine-requisition.blade.php ENDPATH**/ ?>