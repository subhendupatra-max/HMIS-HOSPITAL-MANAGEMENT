<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit New Slots</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('update-slots-details')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo e($editSlots->id); ?>">
                    <div class="form-group col-md-4">
                        <label for="doctor">Doctor <span class="text-danger">*</span></label>
                        <select id="doctor" class="form-control" name="doctor">
                            <option value=" ">Select Doctor</option>
                            <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $editSlots->doctor ? 'selected' : " "); ?>><?php echo e($item->first_name); ?> <?php echo e($item->middle_name); ?> <?php echo e($item->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['doctor'];
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

                    <div class="form-group col-md-4 appoinmentdays ">
                        <label for="days">Days <span class="text-danger">*</span></label>
                        <select id="days" class="form-control" name="days">
                            <option value="">Select</option>
                            <?php $__currentLoopData = Config::get('static.weeks'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>" <?php echo e($item == $editSlots->days ? 'selected' : " "); ?>> <?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['days'];
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

                    <div class="form-group col-md-4 appointtimeedit">
                        <label for="from_time">From Time<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="from_time" name="from_time" required <?php if(isset($editSlots->from_time)): ?> value="<?php echo e($editSlots->from_time); ?>" <?php endif; ?>>
                        <?php $__errorArgs = ['from_time'];
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

                    <div class="form-group col-md-4 appointtimeeditfrom">
                        <label for="to_time">From To<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="to_time" name="to_time" required <?php if(isset($editSlots->to_time)): ?> value="<?php echo e($editSlots->to_time); ?>" <?php endif; ?>>
                        <?php $__errorArgs = ['to_time'];
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

                    <div class="form-group col-md-4 appoinmentadd">
                        <label for="charge_category">Charges Catagory <span class="text-danger">*</span></label>
                        <select id="charge_category" onchange="getSubCategory(this.value,<?php echo e($editSlots->charge_sub_category); ?>,<?php echo e($editSlots->charge); ?>)" class="form-control select2-show-search" name="charge_category">
                            <option value=" ">Select Catagory</option>
                            <?php $__currentLoopData = $catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $editSlots->charge_category ? 'selected':" "); ?>><?php echo e($item->charges_catagories_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['charge_category'];
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

                    <div class="form-group col-md-4 appoinmentadd">
                        <label for="charge_sub_category">Charges Sub Catagory <span class="text-danger">*</span></label>
                        <select name="charge_sub_category" class="form-control select2-show-search" onchange="getChargeName(this.value,<?php echo e($editSlots->charge); ?>)" id="charge_sub_category" required>
                            <option value="">Select Sub Catagory...</option>
                        </select>
                        <small class="text-danger"><?php echo e($errors->first('charge_sub_category')); ?></small>
                    </div>

                    <div class="form-group col-md-4 appoinmentadd">
                        <label for="charge">Charges <span class="text-danger">*</span></label>
                        <select name="charge" onchange="getStandardCharges(this.value)" class="form-control select2-show-search" id="charge" required>
                            <option value="">Select charge...</option>
                        </select>
                        <small class="text-danger"><?php echo e($errors->first('charge')); ?></small>
                    </div>

                    <div class="form-group col-md-4 appoinmentaddd">
                        <label for="tax">Tax<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?php echo e($editSlots->tax); ?>" id="tax" value="<?php echo e(old('tax')); ?>" onkeyup="totalAmount()" name="tax" placeholder="Enter Tax">
                        <small class="text-danger"><?php echo e($errors->first('tax')); ?></small>
                    </div>

                    <div class="form-group col-md-4 appoinmentaddd">
                        <label for="standard_charges">Charge Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="standard_charges" onkeydown="fdsfds()" onkeyup="totalAmount()" name="standard_charges">

                        <div class="mt-3" style="display:none;" id="pop">
                            <input type="checkbox" value="on" id="button1" name="button1" style="margin-right: 5px;" /><label for="permission" class="textlink">Are You Want To Change This ? </label>
                        </div>

                        <small class="text-danger"><?php echo e($errors->first('standard_charges')); ?></small>
                    </div>

                    <div class="form-group col-md-4 appoinmentaddd">
                        <label for="total_amount">Total Amount<span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo e($editSlots->total_amount); ?>" id="total_amount" name="total_amount" readonly>
                        <small class="text-danger"><?php echo e($errors->first('total_amount')); ?></small>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Solts</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

<script>
    function getSubCategory(charge_category,sub_category,charge_name)
    {
        $('#charge_sub_category').val('');
        $("#charge_sub_category").html("<option value='l'>loading... </option>");
        $.ajax({
                url: "<?php echo e(route('find-sub-catagory-by-catagory')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    catagory_id: charge_category,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        let sel = (value.id == sub_category ? 'selected' : '');
                        $('#charge_sub_category').append(`<option value="${value.id}" ${sel}>${value.charges_sub_catagories_name}</option>`);
                    });
                    getChargeName(sub_category,charge_name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>

<script>
    function getChargeName(charge_Sub_category,charge_name)
    {
        var div_data = '';
        $('#charge').val('');
        $("#charge").html("<option value='l'>loading... </option>");
        var ijij =  $('#charge_Sub_category').val();
        $.ajax({
                url: "<?php echo e(route('find-charge-by-sub-catagory')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    charge_id: charge_Sub_category,
                },

                success: function(response) {
                  //  console.log(response);
                    console.log('nvifei'+response);
                    $.each(response, function(key, value) {
                        let sel = (value.id == charge_name ? 'selected' : '');
                        div_data += `<option value="${value.id}" ${sel}>${value.charges_name}</option>`;
                    });
                    $('#charge').append(div_data);
                    getStandardCharges(charge_name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>
<script>
    function getStandardCharges(charge)
    {
        $.ajax({
                url: "<?php echo e(route('find-charge-by-statndard-charges')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    charges: charge,
                },

                success: function(response) {
                    console.log(response);
                    $('#standard_charges').val(response.standard_charges);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>





<script>
    function totalAmount() {
        $("#total_amount").val(00);
        var taxAmount = $("#tax").val();
        var chargeAmount = $("#standard_charges").val();
        var totalAmount = parseInt(chargeAmount * taxAmount / 100) + parseInt(chargeAmount);
        $("#total_amount").val(totalAmount);
    }
</script>

<script>
    function fdsfds() {
        $('#pop').removeAttr('style', true);
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/appointment/slots/edit-slots.blade.php ENDPATH**/ ?>