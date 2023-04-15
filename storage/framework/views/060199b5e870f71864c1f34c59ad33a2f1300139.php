
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Blood Issue</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('add_new_patient')); ?>"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="options px-5 pt-5  border-bottom pb-3">

                        <form method="post" action="<?php echo e(route('add-blood-issue-belling-for-a-patient',['blood_group_id'=> base64_encode($blood_groups_id->id), 'id'=> base64_encode($blood_details->id)  ])); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select class="form-control  select2-show-search" name="patient_id">
                                        <option value="">Select One Patient</option>
                                        <?php if(isset($all_patient)): ?>
                                        <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$patient->id); ?>" <?php echo e(@$patient_details_information->id == $patient->id ? 'Selected' : ''); ?>> <?php echo e(@$patient->prefix); ?> <?php echo e(@$patient->first_name); ?> <?php echo e(@$patient->middle_name); ?> <?php echo e(@$patient->last_name); ?> ( <?php echo e(@$patient->id); ?> ) </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    

                    <?php if(isset($patient_details_information)): ?>
                    
                    <?php $__errorArgs = ['patientId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="options px-5  pb-3">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->gender); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->year); ?>y
                                                <?php echo e(@$patient_details_information->month); ?>m
                                                <?php echo e(@$patient_details_information->day); ?>d
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->guardian_name_realation); ?>

                                                <?php echo e(@$patient_details_information->guardian_name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->blood_group); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->phone); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php endif; ?>
                </div>

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="<?php echo e(route('save-blood-issue-details')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <input type="hidden" name="patient_id" value="<?php echo e(@$patient_details_information->id); ?>" />
                                <input type="hidden" name="blood_group_id" value="<?php echo e($blood_groups_id->id); ?>" />
                                <input type="hidden" name="blood_id" value="<?php echo e($blood_id); ?>" />
                                <div class="form-group col-md-3">
                                    <label for="issue_date" class="form-label">Issue Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="issue_date" value="<?php echo e(old('issue_date')); ?>" name="issue_date">
                                    <small class="text-danger"><?php echo e($errors->first('issue_date')); ?></small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="doctor" class="form-label">Hospital Doctor <span class="text-danger">*</span></label>
                                    <select id="doctor" class="form-control" name="doctor">
                                        <option value=" ">Select </option>
                                        <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></option>
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

                                <div class="form-group col-md-3">
                                    <label for="reference_name" class="form-label">Reference Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="reference_name" value="<?php echo e(old('reference_name')); ?>" name="reference_name">
                                    <small class="text-danger"><?php echo e($errors->first('reference_name')); ?></small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="technician" class="form-label">Technician <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="technician" value="<?php echo e(old('technician')); ?>" name="technician">
                                    <small class="text-danger"><?php echo e($errors->first('technician')); ?></small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                                    <select id="blood_group" class="form-control" name="blood_group">
                                        <option value=" ">Select </option>
                                        <?php $__currentLoopData = $blood_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $blood_details->blood_group_id ? 'selected' : " "); ?>> <?php echo e($item->blood_group_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['blood_group'];
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
                                    <label for="bag" class="form-label">Bag <span class="text-danger">*</span></label>
                                    <select id="bag" class="form-control" name="bag">
                                        <option value=" ">Select </option>
                                        <?php $__currentLoopData = $getBag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->bag); ?>" <?php echo e($item->bag == $blood_details->bag ? 'selected' : " "); ?>> <?php echo e($item->bag); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['bag'];
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

                            </div>
                        </div>
                        <input type="hidden" name="patientId" value="<?php echo e(@$patient_details_information->id); ?>" />
                        <div class="options px-5 pt-5  border-bottom pb-3">
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

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Blood Qty</label>
                                            <input type="text" name="blood_qty" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 d-block">
                                            <label class="form-label">Note</label>
                                            <textarea name="note" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="btn-list p-3">

                            <button class="btn btn-primary btn-sm float-right " type="button" onclick="gettotal()"><i class="fa fa-calculator"></i> Calculate</button>
                            <button class="btn btn-primary btn-sm float-right mr-2" type="submit" name="save"><i class="fa fa-file"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Blood_Bank/add-blood-issue-details.blade.php ENDPATH**/ ?>