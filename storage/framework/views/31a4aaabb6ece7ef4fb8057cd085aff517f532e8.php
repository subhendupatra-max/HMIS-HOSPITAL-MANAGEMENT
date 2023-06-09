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
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" style="">
                                <?php echo $__env->make('OPD.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="<?php echo e(route('add-new-opd-billing')); ?>">
                <?php echo csrf_field(); ?>

                <input type="hidden" name="case_id" value="<?php echo e($opd_patient_details->case_id); ?>" />
                <input type="hidden" name="section" value="OPD" />
                <input type="hidden" name="opd_id" value="<?php echo e($opd_patient_details->id); ?>" />
                <input type="hidden" name="patient_id" value="<?php echo e($opd_patient_details->patient_id); ?>" />
                <div class="card-body">
                    <div class="col-md-12 mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Billing Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" required class="form-control" name="bill_date" />
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
                                        <th scope="col" style="width: 10%"> # <span class="text-danger">*</span></th>
                                        <th scope="col" style="width: 10%">Charge Type <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 15%">Category <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 13%">Subcategory <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 20%">Charge Name <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 10%">Charges <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 10%">Tax <span class="text-danger">*</span></th>
                                        <th scope="col" style="width: 10%">Amount <span class="text-danger">*</span></th>
                                        <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm"
                                                onclick="addNewrow()" type="button"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="chargeTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-md-6">
                            <div class="options px-5 pt-5 pb-3">
                                <div class="container mt-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Note </label>
                                            <textarea class="form-control" name="note"></textarea>
                                        </div>
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
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
                                        <input type="text" name="total" readonly id="total_am"
                                            class="form-control myfld">
                                    </div>
                                    <span class="d-flex justify-content-end" style="color:blue;padding: 10px 0px 0px 0px;">Are are want to apply discount?&nbsp; <input type="checkbox" id="take_discount" name="take_discount" onchange="takeDiscount()" value="yes" /></span>
                                    <div class="d-flex justify-content-end mt-2" id="discount_section" style="display:none !important;">
                                        <span class="biltext">Discount (% / flat)</span>
                                        <input type="text" name="total_discount" onkeyup="gettotal()" value="0"
                                            id="total_discount" class="form-control myfld">
                                        <select name="discount_type" onchange="gettotal()" id="discount_type"
                                            class="form-control myfld" style="width: 75px">
                                            <option value="percentage" selected>%</option>
                                            <option value="flat">Flat</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <span class="biltext">Tax</span>
                                        <input type="text" name="total_tax" onkeyup="gettotal()" value="0"
                                            id="total_tax" class="form-control myfld">
                                    </div>
                                    <div class="d-flex justify-content-end thrdarea">
                                        <span class="biltext">Grand Total</span>
                                        <input type="text" name="grand_total" readonly id="grnd_total" value="00"
                                            class="form-control myfld">
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
                        <button class="btn btn-primary btn-sm float-right" type="button" onclick="gettotal()"><i
                                class="fa fa-calculator"></i> Calculate</button>
                        <button class="btn btn-primary btn-sm float-right " type="submit" name="save" value="save"><i
                                class="fa fa-file"></i> Save</button>
                        <button class="btn btn-primary btn-sm float-right mr-2" name="save_and_print" type="submit"  value="save_and_print"><i
                                class="fa fa-paste"></i> Save & Print</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
    <script>
        function takeDiscount() {
           // alert('ok');
            if (document.getElementById("take_discount").checked) {
                $('#discount_section').removeAttr('style', true);

            } else {
                $('#discount_section').attr('style', 'display:none !important', true);
                $('#total_discount').val(0);
                gettotal();
            }
        }
    </script>

    <script type="text/javascript">
        var i = 1;

        function addNewrow() {
            var html = `<tr id="row${i}">
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
                                <input class="form-control"  onkeyup="getamountwithtax(${i})"  name="tax[]" id="tax${i}" />
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
            $('#total_tax' + row_id).val('0');
            $(`#row${row_id}`).remove();
        }

        function getchargetype_details(row_id) {
            $('#total_discount' + row_id).val('');
            $('#total_am' + row_id).val('');
            $('#grnd_total' + row_id).val('');
            $('#total_tax' + row_id).val('');
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
            $('#total_tax' + row_id).val('');
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
            $('#total_tax' + row_id).val('');
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
            $('#total_tax' + row_id).val('');
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
            $('#total_tax' + row_id).val('');

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

            let standard_charges = $('#standard_charges' + row_id).val();
            let tax = $('#tax' + row_id).val();
            let amount = parseFloat(standard_charges) + (parseFloat(standard_charges) * (parseFloat(tax) / 100));
            let amount_ = parseFloat(amount).toFixed(2);
            $('#amount' + row_id).val(amount_);
        }
    </script>
    <script type="text/javascript">
        function gettotal() {
            var no_of_row = $('#chargeTable tr').length;
            console.log('aaa=>', no_of_row);

            var t = 0;
            $("input[name='amount[]']").map(function() {
                t = t + parseFloat($(this).val());
            }).get();
            $('#total_am').val(t);

            var total_discount = $('#total_discount').val();
            if ($('#discount_type').val() == 'percentage') {
                var r = parseFloat(t) - ((parseFloat(t)) * (parseFloat(total_discount) / 100));
            } else {
                var r = parseFloat(t) - parseFloat(total_discount);
            }
            var total_tax = $('#total_tax').val();
            if (total_tax != 0) {
                var grnd_total = parseFloat(r + (r * (total_tax / 100)));
            } else {
                var grnd_total = parseFloat(r);
            }

            $('#grnd_total').val(grnd_total);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/OPD/billing/create-billing.blade.php ENDPATH**/ ?>