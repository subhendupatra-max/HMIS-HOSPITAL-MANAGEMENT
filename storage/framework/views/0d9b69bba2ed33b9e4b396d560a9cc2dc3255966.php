<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Package Name</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('save-charges-package-name-details')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select id="type" class="form-control" name="type">
                                <option value=" ">Select type </option>
                                <?php $__currentLoopData = Config::get('static.charges_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $charges_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($charges_type); ?>" > <?php echo e($charges_type); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['type'];
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
                    <div class="form-group col-md-3">
                        <label for="charge_package_catagory_id" class="form-label">Charges Package Catagory <span class="text-danger">*</span></label>
                        <select id="charge_package_catagory_id" class="form-control" name="charge_package_catagory_id" onchange="getChargersPackageCatagoryId(this.value)">
                            <option value=" ">Select Charges Package Catagory </option>
                            <?php $__currentLoopData = $catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->charges_package_catagories_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['charge_package_catagory_id'];
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
                        <label for="charge_package_sub_catagory_id" class="form-label">Charges Package Sub Catagory <span class="text-danger">*</span></label>
                        <select id="charge_package_sub_catagory_id" class="form-control" name="charge_package_sub_catagory_id">
                            <option value=" ">Select Charges Package Sub Catagory... </option>
                        </select>
                        <?php $__errorArgs = ['charge_package_sub_catagory_id'];
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
                        <label for="package_name" class="form-label">Charges Package Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="package_name" name="package_name" placeholder="Enter Charges Package Name" value="<?php echo e(old('package_name')); ?>" required>
                        <?php $__errorArgs = ['package_name'];
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
                                    <th scope="col" style="width: 30%">Charge Name<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 40%">Charge Amount<span class="text-danger">*</span></th>
                                    </th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tax">Tax<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="tax" value="<?php echo e(0); ?>" name="tax" placeholder="Enter Tax">
                        <small class="text-danger"><?php echo e($errors->first('tax')); ?></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="total_amount">Total Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" >
                        <small class="text-danger"><?php echo e($errors->first('total_amount')); ?></small>
                    </div>
                </div>

                <div class="text-center m-auto">
                    <button type="button" class="btn btn-success" onclick="gettotal()">Calculate</button>
                    <button type="submit" class="btn btn-primary">Save Package</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

<script>
    function gettotal() {
        var t = 0;
        $("input[name='charge_amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        // alert(t);
        var taxAmount = $("#tax").val();

        var tchargeAmount = parseFloat(t);
        var totalAmount = parseInt(tchargeAmount * taxAmount / 100) + parseInt(tchargeAmount);

        $('#total_amount').val(totalAmount);
    }
</script>

<script>
    var i = 1;

    function addnewrow() {
        var html = `
                        <tr id="rowid${i}">
                        <td><select id="charge_name${i}" onchange="getParameter(${i})" class="form-control select2-show-search"
                        name="charge_name[]">
                        <option value="">Select </option>
                        <?php $__currentLoopData = $chargeName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->charges_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="charge_amount[]" id="charge_amount${i}" />

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
</script>

<script>
    function getParameter(i) {
        var charges = $('#charge_name' + i).val();
        $.ajax({
            url: "<?php echo e(route('find-charge-amount-by-charge-name')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                charges_id: charges,
            },

            success: function(response) {
                $('#charge_amount' + i).val(response.standard_charges);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function getChargersPackageCatagoryId(chargeCatagoryId) {
        $('#charge_package_sub_catagory_id').html('<option value="" >Select Charges Package Sub Catagory...</option>');
        $.ajax({
            url: "<?php echo e(route('find-charges-package-sub-catagory-by-charges-package-catagory')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                catagory_id: chargeCatagoryId,
            },
            success: function(response) {
                $.each(response, function(key, values) {
                    $('#charge_package_sub_catagory_id').append(`<option value="${values.id}">${values.charges_package_sub_catagory_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/setup/charges-package/package-name/add-charges-package-name.blade.php ENDPATH**/ ?>