

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine rack')): ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Bad Medicine</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-bad-medicine')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <select class="form-control select2-show-search" onchange="getDetails(this.value)" id="batch_no" name="batch_no" required>
                                    <option value="">Select Batch No</option>
                                    <?php if($medicine_stock): ?>
                                    <?php $__currentLoopData = $medicine_stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->batch_no); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <label for="batch_no">Batch No<span class="text-danger">*</span></label>
                                <?php $__errorArgs = ['batch_no'];
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

                            <div class="col-md-4 form-group">
                                <input type="date" id="expiry_date" name="expiry_date" required />
                                <label for="expiry_date">Expiry Date<span class="text-danger">*</span> </label>

                                <?php $__errorArgs = ['expiry_date'];
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

                            <div class="col-md-4 form-group">
                                <input type="text" id="unit" name="unit" />
                                <label for="unit">Unit<span class="text-danger">*</span> </label>

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

                            <div class="col-md-4 form-group">
                                <input type="text" id="qty" name="qty" />
                                <label for="qty">Quantity<span class="text-danger">*</span> </label>

                                <?php $__errorArgs = ['qty'];
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
                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Medicine Stock </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    function getSaleRate() {
        var mrp = $('#mrp').val();
        var discount = $('#discount').val();
        var sale_rate = parseFloat(parseFloat(mrp) - (parseFloat(mrp) * (parseFloat(discount) / 100))).toFixed(2);
        $('#sale_price').val(sale_rate);
    }

    function getAmount() {
        var sgst = $('#sgst').val();
        var cgst = $('#cgst').val();
        var igst = $('#igst').val();
        var purchase_price = $('#purchase_price').val();
        var quantity = $('#quantity').val();

        var total_qty_pri = (purchase_price * quantity);
        console.log(total_qty_pri);
        var total_cgst = (total_qty_pri * ((parseFloat(cgst)) / 100));
        var total_igst = (total_qty_pri * ((parseFloat(igst)) / 100));
        var total_sgst = (total_qty_pri * ((parseFloat(sgst)) / 100));
        var total_tax = parseFloat(total_sgst) + parseFloat(total_cgst) + parseFloat(total_igst);
        var total_amount = total_qty_pri + total_tax;

        $('#amount').val(total_amount);
        $('#total_igst').val(total_igst);
        $('#total_sgst').val(total_sgst);
        $('#total_cgst').val(total_cgst);
    }

    function getDetails(batch_no) {
        // alert(batch_no);
        $.ajax({
            url: "<?php echo e(route('find-expiry-date-by-batch-no')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                batch_id: batch_no,
            },
            success: function(response) {
                console.log(response);

                $('#expiry_date').val(response.exp_date);
                $('#unit').val(response.unit);
                $('#qty').val(response.qty);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/medicine/add-bad-medicines.blade.php ENDPATH**/ ?>