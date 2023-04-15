
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Blood Donor Details</div>
        </div>

        <form method="POST" action="<?php echo e(route('save-blood')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="blood_group_id" value="<?php echo e($blood_groups_id->id); ?>" />

                        <div class="form-group col-md-3">
                            <label for="blood_donor_id" class="form-label">Blood Donor <span class="text-danger">*</span></label>
                            <select id="blood_donor_id" class="form-control" name="blood_donor_id">
                                <option value=" ">Select </option>
                                <?php $__currentLoopData = $bloodDonorDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->donor_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['blood_donor_id'];
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
                            <label for="donate_date" class="form-label">Donate Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="donate_date" value="<?php echo e(old('donate_date')); ?>" name="donate_date">
                            <small class="text-danger"><?php echo e($errors->first('donate_date')); ?></small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="bag" class="form-label">Bag <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bag" value="<?php echo e(old('bag')); ?>" name="bag">
                            <small class="text-danger"><?php echo e($errors->first('bag')); ?></small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="volume" class="form-label">Volume <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="volume" value="<?php echo e(old('volume')); ?>" name="volume">
                            <small class="text-danger"><?php echo e($errors->first('volume')); ?></small>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="unit_type" class="form-label">Unit Type <span class="text-danger">*</span></label>
                            <select id="unit_type" class="form-control" name="unit_type">
                                <option value=" ">Select Unit Type</option>
                                <?php $__currentLoopData = $unit_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"> <?php echo e($item->blood_unit_types); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['unit_type'];
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
                            <label for="lot" class="form-label">lot <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lot" value="<?php echo e(old('lot')); ?>" name="lot">
                            <small class="text-danger"><?php echo e($errors->first('lot')); ?></small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="charge_category" class="form-label">Charges Catagory <span class="text-danger">*</span></label>
                            <select id="charge_category" class="form-control select2-show-search" name="charge_category" onchange="getCatagory(this.value)">
                                <option value=" ">Select Catagory</option>
                                <?php $__currentLoopData = $catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->charges_catagories_name); ?></option>
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

                        <div class="form-group col-md-3">
                            <label for="charge_name" class="form-label">Charge Name<span class="text-danger">*</span></label>
                            <select name="charge_name" class="form-control select2-show-search" id="charge_name">
                                <option value="">Select Charge Name...</option>
                            </select>
                            <small class="text-danger"><?php echo e($errors->first('charge_name')); ?></small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="standard_charges" class="form-label"> Standard Charges<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" onkeyup="getStandardCharges()" id="standard_charges" name="standard_charges" value=" ">
                            <small class="text-danger"><?php echo e($errors->first('standard_charges')); ?></small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="institution" class="form-label">Institution <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="institution" value="<?php echo e(old('institution')); ?>" name="institution">
                            <small class="text-danger"><?php echo e($errors->first('institution')); ?></small>
                        </div>

                    </div>

                </div>
                <hr>

                <div class="container mt-5">
                    <div class="d-flex justify-content-end">
                        <span class="biltext">Total</span>
                        <input type="text" readonly class="form-control myfld" id="total" name="total">
                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="text" name="getdiscount" onkeyup="discountCalculate()" placeholder="Enter Discount" class="form-control myfld2" id="getdiscount">
                        <input type="text" class="form-control myfld1" id="calculateDiscount" name="discount">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="text" name="taxfeildid" placeholder="Enter Tax" onkeyup="calculateTax()" class="form-control myfld2" id="taxfeildid">
                        <input type="text" class="form-control myfld1" id="taxid" name="taxid">
                    </div>

                    <div class="d-flex justify-content-end thrdarea">
                        <span class="biltext">Net Amount</span>
                        <input type="text" class="form-control myfld" id="net_amount" name="net_amount" readonly>
                    </div>

                    <div class="d-flex justify-content-end thrdarea">
                        <!-- <span class="biltext">Payment Mode</span> -->
                        <select id="payment_mode" class="form-control myfld2" name="payment_mode">
                            <option value="">Select Payment Amount</option>
                            <?php $__currentLoopData = Config::get('static.payment_mode_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"> <?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <input type="text" class="form-control myfld1" id="payment_amount" name="payment_amount" placeholder="Enter Payment Amount" readonly>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 d-block">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class=" text-right">
                    <button class="btn btn-success" onclick="gettotal()" type="button"><i class="fa fa-calculator"></i> Calculate</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
                </div>
                <!-- End Table with stripped rows -->
            </div>
    </div>
</div>
</form>
</div>
</div>

<script type="text/javascript">
    function getStandardCharges() {
        let standard_charges = $('#standard_charges').val();
        $('#total').val(standard_charges);
        $("#net_amount").val(' ');
        $("#payment_amount").val(' ');
        discountCalculate();
        calculateTax();

    }

    function gettotal() {
        var total = $('#total').val();
        var total_with_discount = $('#calculateDiscount').val();
        var total_with_discount_with_tax = $('#taxid').val();
        let net_amount = parseFloat(parseFloat(total) + parseFloat(total_with_discount) + parseFloat(total_with_discount_with_tax)).toFixed(2);
        $('#net_amount').val(net_amount);
        $('#payment_amount').val(net_amount);
    }
</script>

<script type="text/javascript">
    function discountCalculate() {
        var discountFeild = $('#getdiscount').val();
        var totalAmount = $("#total").val();
        var totalDiscount = parseFloat(totalAmount * (discountFeild / 100)).toFixed(2);
        $("#calculateDiscount").val(totalDiscount);
        calculateTax();
    }
</script>

<script type="text/javascript">
    function calculateTax() {

        var totalAmount = $("#total").val();
        var totalDiscount = $('#calculateDiscount').val();
        var total_plus_discount = parseFloat(totalAmount) + parseFloat(totalDiscount);
        var discount_percentage = $("#taxfeildid").val();
        var totalTax = parseFloat(total_plus_discount * (discount_percentage / 100)).toFixed(2);

        $("#taxid").val(totalTax);
        $("#net_amount").val(' ');
        $("#payment_amount").val(' ');
        discountCalculate();
    }
</script>

<script>
    function getCatagory(catagory) {

        $('#charge_name').html('<option value="" >Select...</option>');

        $.ajax({
            url: "<?php echo e(route('find-charge-name-by-charge-catagory-in-blood')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                catagory_id: catagory,
            },
            success: function(response) {
                // console.log(response);
                $.each(response, function(key, values) {
                    $('#charge_name').append(`<option value="${values.id}"  >${values.charges_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    $(document).ready(function() {
        $("#charge_name").change(function(event) {
            event.preventDefault();
            let charge_name = $(this).val();

            $.ajax({
                url: "<?php echo e(route('find-charge-by-statndard-charges-in-blood-bank')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    charge_id: charge_name,
                },

                success: function(response) {
                    console.log(response);
                    $('#standard_charges').val(response.standard_charges);
                    $('#total').val(response.standard_charges);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Blood_Bank/add-blood.blade.php ENDPATH**/ ?>