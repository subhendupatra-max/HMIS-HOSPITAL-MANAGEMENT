
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-4 card-title">
                        Add Billing
                    </div>
                </div>
            </div>
            <form method="post" action="<?php echo e(route('add-new-billing')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="patient_id" value="<?php echo e(@$patient_id); ?>" />
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
                                        <th scope="col" style="width: 10%">Category <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 13%">Subcategory <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 25%">Charge Name <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 10%">Charge <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 10%">Qty <span class="text-danger">*</span></th>
                                       
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
                                            <label>Billing Note </label>
                                            <textarea class="form-control" name="note"></textarea>
                                        </div>
                                        <div class="col-md-6" style="margin: 33px 0px 0px 0px">
                                            <label>Payment Amount </label>
                                            <input type="text" name="payment_amount" class="form-control" id="payment_amount" />
                                 
                                        </div>
                                        <div class="col-md-6" style="margin: 25px 0px 0px 0px">
                                            <label>Payment Mode</label>
                                            <select class="form-control" name="payment_mode">
                                                <option value="">Select One...</option>
                                                <?php $__currentLoopData = Config::get('static.payment_mode_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $payment_mode_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($payment_mode_name); ?>"> <?php echo e($payment_mode_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12" style="margin: 25px 0px 0px 0px">
                                            <label>Payment Note </label>
                                            <input class="form-control" type="text" name="payment_note" />
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
                        <button class="btn btn-primary btn-sm float-right mr-2" type="submit" name="save" value="save"><i
                                class="fa fa-file"></i> Save</button>
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
            if (document.getElementById("add_medicine_bill").checked) {
                $('#fjafiao').removeAttr('style',true);
                gettotal();
            } else {
                $('#fjafiao').attr('style','display:none',true);
                gettotal();
            }
        }
    </script>

    <script type="text/javascript">
        var i = $('#chargeTable tr').length;
        i = i + 1;
        function addNewrow() {
            var html = `<tr id="row${i}">
                            <td>
                                <select class="form-control select2-show-search" onchange="getSub_cate_by_cate(${i})" name="charge_category[]" id="charge_category${i}">
                                    <option value="">Select One..</option>
                                    <?php if($charge_category[0]->id != null): ?>
                                    <?php $__currentLoopData = $charge_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->charges_catagories_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
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
                                <input class="form-control" onkeyup="getamount(${i})" name="standard_charges[]" id="standard_charges${i}" />
                            </td>
                            <td>
                                <input class="form-control"  onkeyup="getamount(${i})"  name="qty[]" id="qty${i}" />
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
            $(`#row${row_id}`).remove();
            gettotal();
        }


        function getSub_cate_by_cate(row_id) {
            $('#total_discount' + row_id).val('');
            $('#total_am' + row_id).val('');
            $('#grnd_total' + row_id).val('');
            $('#charge_name' + row_id).empty();
            $('#amount' + row_id).val('');
            $('#standard_charges' + row_id).val('');
            $('#charge_sub_category' + row_id).html('<option value="">Select One..</option>');
            let category_id = $('#charge_category' + row_id).val();
            var div_data = '';
            $.ajax({
                url: "<?php echo e(route('get-subcategory-by-category')); ?>",
                type: "post",
                data: {
                    categoryId: category_id,
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
            $('#standard_charges' + row_id).val('');
            $('#amount' + row_id).val('');
            let charge_category = $('#charge_category' + row_id).val();
            let charge_sub_category = $('#charge_sub_category' + row_id).val();
            $('#charge_name' + row_id).empty();
            var div_data = '<option value="">Select One..</option>';
            $.ajax({
                url: "<?php echo e(route('get-charge-name')); ?>",
                type: "post",
                data: {
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
            $('#amount' + row_id).val('');
            $('#amount' + row_id).val('');
            let charge_name = $('#charge_name' + row_id).val();
            $('#standard_charges' + row_id).empty();

            $.ajax({
                url: "<?php echo e(route('get-charge-amount-patient')); ?>",
                type: "post",
                data: {
                    chargeName: charge_name,
                    _token: '<?php echo e(csrf_token()); ?>',
                },
                dataType: 'json',
                success: function(res) {
                    $('#standard_charges' + row_id).val(res.charge_amount);
                    gettotal();
                }
            });
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

            var t_m = parseFloat(t);
            $('#total_am').val(t_m.toFixed(2));

            var total_discount = $('#total_discount').val();
            var _discount = $('#take_discount').val();

            if ( _discount == 'yes' ) {
                if ($('#discount_type').val() == 'percentage') {
                    var r = parseFloat(t_m) - ((parseFloat(t_m)) * (parseFloat(total_discount) / 100));
                } else {
                    var r = parseFloat(t_m) - parseFloat(total_discount);
                }
            }
            else{
                var r = parseFloat(t_m);
            }

            var grnd_total = parseFloat(r);
            $('#grnd_total').val(grnd_total);
            $('#payment_amount').val(grnd_total);
        }

        function getamount(row_id)
        {
            var standard_charges = $('#standard_charges' + row_id).val();
            var qty = $('#qty' + row_id).val();
            var amount = parseFloat(standard_charges * qty).toFixed(2);

            $('#amount' + row_id).val(amount);
            gettotal();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/patient/add-billing.blade.php ENDPATH**/ ?>