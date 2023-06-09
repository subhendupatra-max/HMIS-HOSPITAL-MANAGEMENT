
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Billing
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('Ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="<?php echo e(route('add-new-ipd-billing')); ?>">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="case_id" value="<?php echo e($ipd_details->case_id); ?>" />
            <input type="hidden" name="section" value="IPD" />
            <input type="hidden" name="ipd_id" value="<?php echo e($ipd_details->id); ?>" />
            <input type="hidden" name="patient_id" value="<?php echo e($ipd_details->patient_id); ?>" />
            <div class="card-body">
                <div class="col-md-12 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Billing Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" required class="form-control" name="bill_date" value="<?php echo e(date('Y-m-d H:i')); ?>" />
                            <?php $__errorArgs = ['bill_date'];
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
                <div class="border-bottom border-top">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    
                                    <th scope="col" style="width: 10%">Category <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 17%">Subcategory <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 25">Charge Name <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">Charge <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">Qty <span class="text-danger">*</span></th>
                          
                                    <th scope="col" style="width: 10%">CGST <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">SGST <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">IGST <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 8%">Amount <span class="text-danger">*</span></th>
                                    
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="chargeTable">
                                <?php if(@$old_applied_charges): ?>
                                <?php $__currentLoopData = $old_applied_charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="row<?php echo e($key); ?>" style="background-color:#e6f5ed">
                                    <input type="hidden" name="old_or_new[]" value="old" />
                                    <input type="hidden" name="charge_id_old[]" value="<?php echo e($value->id); ?>" />
                                    
                                    <td>
                                        <select class="form-control select2-show-search" name="charge_category[]" id="charge_category<?php echo e($key); ?>">
                                            <option value="<?php echo e($value->charge_category); ?>"><?php echo e($value->charges_category_details->charges_catagories_name); ?></option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" name="charge_sub_category[]" id="charge_sub_category<?php echo e($key); ?>">
                                            <option value="<?php echo e($value->charge_sub_category); ?>"><?php echo e($value->charges_sub_category_details->charges_sub_catagories_name); ?></option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" name="charge_name[]" id="charge_name<?php echo e($key); ?>">
                                            <option value=<?php echo e($value->charge_name); ?>><?php echo e($value->charges_name_details->charges_name); ?></option>
                                        </select>
                                    </td>

                                    <td>
                                        <input class="form-control" value="<?php echo e($value->qty); ?>" readonly name="qty[]" id="qty<?php echo e($key); ?>" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="<?php echo e($value->standard_charges); ?>" readonly name="standard_charges[]" id="standard_charges<?php echo e($key); ?>" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="<?php echo e($value->cgst); ?>" readonly name="cgst[]" id="cgst<?php echo e($key); ?>" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="<?php echo e($value->sgst); ?>" readonly name="sgst[]" id="sgst<?php echo e($key); ?>" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="<?php echo e($value->igst); ?>" readonly name="igst[]" id="igst<?php echo e($key); ?>" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="<?php echo e($value->amount); ?>" readonly name="amount[]" id="amount<?php echo e($key); ?>" />
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="rowRemove(<?php echo e($key); ?>)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="border-bottom border-top">
                    <span style="color: #ff6014;font-size: 14px;"> Are You want to add Medicine Bill ?<input type="checkbox" id="add_medicine_bill" name="add_medicine_bill" onchange="addMedicineBill(<?php echo e($ipd_details->case_id); ?>)" value="yes" /></span>
                    <div class="table-responsive" id="fjafiao" style="display: none">
                        <?php if(@$medicine_charges[0]->id != null || @$medicine_charges[0]->id != '' ): ?>
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%"> # <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Bill No. <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 30%">Date <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 20%">Amount <span class="text-danger">*</span>
                                    <th scope="col" style="width: 10%"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $medicine_charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input text="hidden" class="form-control" name="medicine_bill_id[]" id="medicine_bill_id<?php echo e($key); ?>" value="<?php echo e($value->id); ?>" />
                                <tr id="medicineRow<?php echo e($key); ?>">
                                    
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($value->bill_prefix); ?><?php echo e($value->id); ?></td>
                                    <td><?php echo e(date('d-m-Y h:i a',strtotime($value->bill_date))); ?></td>
                                    <td><input text="text" readonly class="form-control" name="medicine_amount[]" id="medicine_amount<?php echo e($key); ?>" value="<?php echo e($value->total_amount); ?>" /></td>
                                    <td><button class="btn btn-danger btn-sm" type="button" onclick="medicinerowRemove(<?php echo e($key); ?>)"><i class="fa fa-times"></i></button></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <span style="color:blue">Don't Have any bill !!</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-md-6">
                        <div class="options px-5 pt-5 pb-3">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Note </label>
                                        <input class="form-control" name="note" />
                                    </div>
                                    <div class="col-md-6" style="margin: 44px 0px 0px 0px">
                                        <label class="form-label">Payment Amount </label>
                                        <input type="text" name="payment_amount" class="form-control" />
                                        <?php $__errorArgs = ['payment_amount'];
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
                                    <div class="col-md-6" style="margin: 35px 0px 0px 0px">
                                        <label class="form-label">Payment Mode</label>
                                        <select class="form-control" name="payment_mode">
                                            <option value="">Select One...</option>
                                            <?php $__currentLoopData = Config::get('static.payment_mode_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $payment_mode_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($payment_mode_name); ?>"> <?php echo e($payment_mode_name); ?>

                                            </option>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="options px-5 pt-5 pb-3">
                            <div class="container mt-5">
                                <div class="d-flex justify-content-end">
                                    <span class="biltext">Total</span>
                                    <input type="text" name="total" readonly id="total_am" class="form-control myfld">
                                </div>
                                <span class="d-flex justify-content-end" style="color:blue;padding: 10px 0px 0px 0px;">Are are want to apply discount?&nbsp; <input type="checkbox" id="take_discount" name="take_discount" onchange="takeDiscount()" value="yes" /></span>
                                <div class="d-flex justify-content-end mt-2" id="discount_section" style="display:none !important;">
                                    <span class="biltext">Discount (% / flat)</span>
                                    <input type="text" name="total_discount" onkeyup="gettotal()" value="0" id="total_discount" class="form-control myfld">
                                    <select name="discount_type" onchange="gettotal()" id="discount_type" class="form-control myfld" style="width: 75px">
                                        <option value="percentage" selected>%</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                                

                                <div class="d-flex justify-content-end thrdarea">
                                    <span class="biltext">Grand Total</span>
                                    <input type="text" name="grand_total" readonly id="grnd_total" value="00" class="form-control myfld">
                                    <?php $__errorArgs = ['grand_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <br>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="btn-list p-3">
                    <button class="btn btn-primary btn-sm float-right" type="button" onclick="gettotal()"><i class="fa fa-calculator"></i> Calculate</button>
                    <button class="btn btn-primary btn-sm float-right mr-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Save</button>
                  
                </div>
            </div>
        </form>
    </div>
</div>

</div>
<script>
    function takeDiscount() {
        if (document.getElementById("take_discount").checked) {
            $('#discount_section').removeAttr('style', true);

        } else {
            $('#discount_section').attr('style', 'display:none !important', true);
            $('#total_discount').val(0);
            gettotal();
        }
    }
</script>
<script>
    function addMedicineBill(case_id) {
        // alert('ok');
        if (document.getElementById("add_medicine_bill").checked) {
            $('#fjafiao').removeAttr('style', true);
            gettotal();
        } else {
            $('#fjafiao').attr('style', 'display:none', true);
            gettotal();
        }
    }
</script>

<script type="text/javascript">
    var i = $('#chargeTable tr').length;
    i = i + 1;

    function addNewrow() {
        var html = `<tr id="row${i}">
                        <input type="hidden" name="old_or_new[]" value="new" />
                        <input type="hidden" name="charge_id[]" value="" />
                            <td>
                                <select class="form-control select2-show-search" onchange="getChargeCategory(${i})" name="charge_set[]" id="charge_set${i}">
                                    <option value="" disable >Select One..</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Package">Package</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" name="charge_type[]" id="charge_type${i}" onchange="getchargetype_details(${i})">
                                    <option value=" " selected disable >Select One... </option>
                                    <?php $__currentLoopData = Config::get('static.charges_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $charges_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($charges_type); ?>" > <?php echo e($charges_type); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" onchange="getSub_cate_by_cate(${i})" name="charge_category[]" id="charge_category${i}">
                                    <option value="">Select One..</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" name="charge_sub_category[]" id="charge_sub_category${i}" onchange="get_charges_name(${i})" >
                                    <option value="">Select One..</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" onchange=getcharges(${i}) name="charge_name[]" id="charge_name${i}">
                                    <option value="">Select One..</option>
                                </select>
                            </td>

                            <td>
                                <input class="form-control" onkeyup="getamountwithtax(${i})" name="standard_charges[]" id="standard_charges${i}" />
                            </td>
                            <td>
                                <input class="form-control" value="1" onkeyup="getamountwithtax(${i})"  name="qty[]" id="qty${i}" />
                            </td>
                            <td>
                                <input class="form-control" value="0" onkeyup="getamountwithtax(${i})"  name="tax[]" id="tax${i}" />
                            </td>
                            <td>
                                <input class="form-control" name="amount[]" id="amount${i}" />
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm"  type="button"
                                        onclick="rowRemove(${i})"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>`;
        $('#chargeTable').append(html);
        i = i + 1;
    }

    function rowRemove(row_id) {
        $('#total_discount' + row_id).val('0');
        $('#total_am' + row_id).val('0');
        $('#grnd_total' + row_id).val('0');
        // $('#total_cgst' + row_id).val('0');
        // $('#total_sgst' + row_id).val('0');
        // $('#total_igst' + row_id).val('0');
        $(`#row${row_id}`).remove();
        gettotal();
    }

    function medicinerowRemove(row_id) {
        $('#total_discount' + row_id).val('0');
        $('#total_am' + row_id).val('0');
        $('#grnd_total' + row_id).val('0');
        // $('#total_cgst' + row_id).val('0');
        // $('#total_sgst' + row_id).val('0');
        // $('#total_igst' + row_id).val('0');
        $(`#medicineRow${row_id}`).remove();
        gettotal();
    }

    function getchargetype_details(row_id) {
        $('#total_discount' + row_id).val('');
        $('#total_am' + row_id).val('');
        $('#grnd_total' + row_id).val('');
        // $('#total_cgst' + row_id).val('');
        // $('#total_sgst' + row_id).val('');
        // $('#total_igst' + row_id).val('');
        $('#charge_sub_category' + row_id).empty();
        $('#charge_name' + row_id).empty();
        $('#amount' + row_id).val('');
        $('#tax' + row_id).val('');
        $('#standard_charges' + row_id).val('');
        $('#charge_category' + row_id).val('');
    }

    function getChargeCategory(row_id) {
        $('#total_discount' + row_id).val('');
        $('#total_am' + row_id).val('');
        $('#grnd_total' + row_id).val('');
        // $('#total_cgst' + row_id).val('');
        // $('#total_sgst' + row_id).val('');
        // $('#total_igst' + row_id).val('');
        let charge_set = $('#charge_set' + row_id).val();
        $('#charge_sub_category' + row_id).empty();
        $('#charge_name' + row_id).empty();
        $('#amount' + row_id).val('');
        $('#tax' + row_id).val('');
        $('#standard_charges' + row_id).val('');
        $('#charge_type' + row_id).val('');
        $('#charge_category' + row_id).empty();
        var div_data = '<option value="" >Select One..</option>';
        $.ajax({
            url: "<?php echo e(route('get-category')); ?>",
            type: "post",
            data: {
                chargeSet: charge_set,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                $.each(res, function(i, obj) {
                    div_data += `<option value="${obj.category_id}">${obj.category_name}</option>`;
                });
                $('#charge_category' + row_id).append(div_data);
            }
        });
    }

    function getSub_cate_by_cate(row_id) {
        $('#total_discount' + row_id).val('');
        $('#total_am' + row_id).val('');
        $('#grnd_total' + row_id).val('');
        // $('#total_cgst' + row_id).val('');
        // $('#total_sgst' + row_id).val('');
        // $('#total_igst' + row_id).val('');
        $('#charge_name' + row_id).empty();
        $('#amount' + row_id).val('');
        $('#tax' + row_id).val('');
        $('#standard_charges' + row_id).val('');
        $('#charge_sub_category' + row_id).empty();
        let category_id = $('#charge_category' + row_id).val();
        let charge_set = $('#charge_set' + row_id).val();
        var div_data = '<option value="">Select One..</option>';
        $.ajax({
            url: "<?php echo e(route('get-subcategory-by-category')); ?>",
            type: "post",
            data: {
                categoryId: category_id,
                chargeSet: charge_set,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                $.each(res, function(i, obj) {
                    div_data +=
                        `<option value="${obj.sub_category_id}">${obj.sub_category_name}</option>`;
                });
                $('#charge_sub_category' + row_id).append(div_data);
            }
        });
    }

    function get_charges_name(row_id) {
        $('#total_discount' + row_id).val('');
        $('#total_am' + row_id).val('');
        $('#grnd_total' + row_id).val('');
        // $('#total_cgst' + row_id).val('');
        // $('#total_sgst' + row_id).val('');
        // $('#total_igst' + row_id).val('');
        $('#tax' + row_id).val('');
        $('#standard_charges' + row_id).val('');
        $('#amount' + row_id).val('');
        let charge_set = $('#charge_set' + row_id).val();
        let charge_type = $('#charge_type' + row_id).val();
        let charge_category = $('#charge_category' + row_id).val();
        let charge_sub_category = $('#charge_sub_category' + row_id).val();
        $('#charge_name' + row_id).empty();
        var div_data = '<option value="">Select One..</option>';
        $.ajax({
            url: "<?php echo e(route('get-charge-name')); ?>",
            type: "post",
            data: {
                chargeSet: charge_set,
                chargeType: charge_type,
                chargeCategory: charge_category,
                chargeSubCategory: charge_sub_category,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                $.each(res, function(i, obj) {
                    div_data += `<option value="${obj.charge_id}">${obj.charges_name}</option>`;
                });
                $('#charge_name' + row_id).append(div_data);
            }
        });

    }

    function getcharges(row_id) {
        $('#total_discount' + row_id).val('');
        $('#total_am' + row_id).val('');
        $('#grnd_total' + row_id).val('');
        // $('#total_cgst' + row_id).val('');
        // $('#total_sgst' + row_id).val('');
        // $('#total_igst' + row_id).val('');

        $('#amount' + row_id).val('');
        $('#tax' + row_id).val('');
        $('#amount' + row_id).val('');
        let charge_name = $('#charge_name' + row_id).val();
        let charge_set = $('#charge_set' + row_id).val();
        $('#standard_charges' + row_id).empty();

        $.ajax({
            url: "<?php echo e(route('get-charge-amount')); ?>",
            type: "post",
            data: {
                chargeName: charge_name,
                chargeSet: charge_set,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                $('#standard_charges' + row_id).val(res.charge_amount);
            }
        });
    }

    function getamountwithtax(row_id) {

        let standard_chargesss = $('#standard_charges' + row_id).val();
        // let cgst = $('#cgst' + row_id).val();
        // let igst = $('#igst' + row_id).val();
        // let sgst = $('#sgst' + row_id).val();
        let qty = $('#qty' + row_id).val();
        var standard_charges = parseFloat(standard_chargesss) * qty;
        var tax = 0 ;
    //    var tax = parseFloat(standard_charges) * ((parseFloat(cgst) + parseFloat(sgst) + (parseFloat(igst)) / 100));
        let amount = parseFloat(standard_charges) + parseFloat(tax);
        let amount_ = parseFloat(amount).toFixed(2);
        $('#amount' + row_id).val(amount_);
        gettotal(row_id);
    }
</script>
<script type="text/javascript">
    function gettotal() {
        var no_of_row = $('#chargeTable tr').length;
        console.log('aaa=>', no_of_row);

        var t = 0;
        var m = 0;
        $("input[name='amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        if (document.getElementById("add_medicine_bill").checked) {
            $("input[name='medicine_amount[]']").map(function() {
                m = m + parseFloat($(this).val());
            }).get();
        }

        var t_m = parseFloat(t) + parseFloat(m)
        $('#total_am').val(t_m.toFixed(2));

        var total_discount = $('#total_discount').val();
        if ($('#discount_type').val() == 'percentage') {
            var r = parseFloat(t_m) - ((parseFloat(t_m)) * (parseFloat(total_discount) / 100));
        } else {
            var r = parseFloat(t_m) - parseFloat(total_discount);
        }
        // var total_tax = $('#total_tax').val();
        // let cgst = $('#total_cgst').val();
        // let igst = $('#total_igst').val();
        // let sgst = $('#total_sgst').val();
        // var total_tax = parseFloat(cgst) + parseFloat(sgst) + (parseFloat(igst));
        var total_tax = 0 ;
        if (total_tax != 0) {
            var grnd_total = parseFloat(r + (r * (total_tax / 100)));
        } else {
            var grnd_total = parseFloat(r);
        }

        $('#grnd_total').val(grnd_total.toFixed(2));
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/billing/create-billing.blade.php ENDPATH**/ ?>