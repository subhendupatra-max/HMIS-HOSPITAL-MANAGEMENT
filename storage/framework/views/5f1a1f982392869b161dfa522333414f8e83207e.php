

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine rack')): ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Item Stock</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-update-inventory-stock')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 form-group">

                                <select class="form-control select2-show-search" id="stored_room" name="stored_room" required>
                                    <option value="">Select Store Room</option>
                                    <?php if($store_room): ?>
                                    <?php $__currentLoopData = $store_room; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->item_store_room); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <label for="stored_room">Store Room <span class="text-danger">*</span></label>
                                <?php $__errorArgs = ['stored_room'];
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
                            <input type="hidden" name="unit" value="<?php echo e($item_details->unit_id); ?>" />

                            <div class="col-md-4 form-group">
                                <select class="form-control select2-show-search" name="item_catagory" id="item_catagory" required>
                                    <option value="<?php echo e(@$item_details->id); ?>"><?php echo e(@$item_details->fetch_catagory_name->item_catagory_name); ?></option>
                                </select>
                                <label for="item_catagory">Item Catagory<span class="text-danger">*</span> </label>
                                <?php $__errorArgs = ['item_catagory'];
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
                                <select name="item_name" required id="item_name" class="form-control select2-show-search">
                                    <option value="<?php echo e(@$item_details->id); ?>"><?php echo e(@$item_details->item_name); ?></option>
                                </select>
                                <label for="batch_no">Item Name<span class="text-danger">*</span> </label>
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

                            <div class="col-md-4 form-group">

                                <input type="text" id="part_no" name="part_no" value="<?php echo e(old('part_no')); ?>" required />
                                <label for="part_no">Part No<span class="text-danger">*</span> </label>

                                <?php $__errorArgs = ['part_no'];
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
                            <!-- 
                            <div class="col-md-4 form-group">
                                <input type="date" id="expiry_date" name="expiry_date" value="<?php echo e(old('expiry_date')); ?>" required />
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
                            </div> -->

                            <div class="col-md-4 form-group">

                                <input type="text" id="quantity" name="quantity" onkeyup="getAmount()" value="<?php echo e(old('quantity')); ?>" required />
                                <label for="quantity">Quantity<span class="text-danger">*</span> </label>

                                <?php $__errorArgs = ['quantity'];
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
                                <input type="text" id="rate" name="rate" value="<?php echo e(old('rate')); ?>" required />
                                <label for="rate">Rate <span class="text-danger">*</span> </label>
                                <?php $__errorArgs = ['rate'];
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
                                <input type="text" id="discount" name="discount" value="<?php echo e(old('discount')); ?>" required />
                                <label for="discount">Discount(%) <span class="text-danger">*</span> </label>
                                <?php $__errorArgs = ['discount'];
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
                            <!-- <div class="col-md-4 form-group">
                                <input type="text" id="sale_price" name="sale_price" value="<?php echo e(old('sale_price')); ?>" required />
                                <label for="sale_price">Sale Price<span class="text-danger">*</span> </label>
                                <?php $__errorArgs = ['sale_price'];
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
                            <div class="col-md-4 form-group">
                                <input type="text" id="purchase_price" onkeyup="getAmount()" name="purchase_price" value="<?php echo e(old('purchase_price')); ?>" required />
                                <label for="purchase_price">Purchase Price/quantity<span class="text-danger">*</span> </label>

                                <?php $__errorArgs = ['purchase_price'];
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
                                <input type="text" id="igst" name="igst" onkeyup="getAmount()" value="0" required />
                                <label for="igst">IGST </label>
                                <?php $__errorArgs = ['igst'];
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
                                <input type="text" id="cgst" name="cgst" onkeyup="getAmount()" value="0" required />
                                <label for="cgst">CGST </label>
                                <?php $__errorArgs = ['cgst'];
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
                                <input type="text" id="sgst" name="sgst" onkeyup="getAmount()" value="0" required />
                                <label for="sgst">SGST </label>
                                <?php $__errorArgs = ['sgst'];
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
                                <input type="hidden" id="total_cgst" name="total_cgst" value="0" required />
                                <input type="hidden" id="total_sgst" name="total_sgst" value="0" required />
                                <input type="hidden" id="total_igst" name="total_igst" value="0" required />
                                <input type="text" id="amount" name="amount" value="<?php echo e(old('amount')); ?>" required />
                                <label for="amount">Amount<span class="text-danger">*</span> </label>

                                <?php $__errorArgs = ['amount'];
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
                    <button type="submit" class="btn btn-primary">Update Item Stock </button>
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
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/stock-update/update-stock-inventory.blade.php ENDPATH**/ ?>