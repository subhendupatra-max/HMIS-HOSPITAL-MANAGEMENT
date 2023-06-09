
<?php $__env->startSection('content'); ?>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Medicine Billing</div>
            </div>
            <div class="card-body p-0">
                <div class="row no-gutters">


                    <div class="col-lg-12 col-xl-12">
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                
                                <div class="options px-5 pt-5  border-right pb-3">
                                    <form method="post" action="<?php echo e(route('add-pharmacy-billing-for-a-patient')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <select class="form-control  select2-show-search" name="patient_id">
                                                    <option value="">Search Patient...</option>
                                                    <?php if(isset($all_patient)): ?>
                                                        <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(@$patient->id); ?>"
                                                                <?php echo e(@$patient_details_information->id == $patient->id ? 'Selected' : ''); ?>>
                                                                <?php echo e(@$patient->prefix); ?> <?php echo e(@$patient->first_name); ?>

                                                                <?php echo e(@$patient->middle_name); ?>

                                                                <?php echo e(@$patient->last_name); ?> (
                                                                <?php echo e(@$patient->id); ?> ) </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <input type="text" id="prescription_no" />
                                                <label for="prescription_no">Search By Prescription No.</label>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <button type="submit" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-search"></i>
                                                    Search</button>
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
                                                            <td class="py-2 px-5">
                                                                <?php echo e(@$patient_details_information->gender); ?></td>
                                                            <td class="py-2 px-5">
                                                                <span class="font-weight-semibold w-50">Age </span>
                                                            </td>
                                                            <td class="py-2 px-5">
                                                                <?php echo e(@$patient_details_information->year); ?>y
                                                                <?php echo e(@$patient_details_information->month); ?>m
                                                                <?php echo e(@$patient_details_information->day); ?>d
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="py-2 px-5">
                                                                <span class="font-weight-semibold w-50">Guardian Name
                                                                </span>
                                                            </td>
                                                            <td class="py-2 px-5">
                                                                <?php echo e(@$patient_details_information->guardian_name_realation); ?>

                                                                <?php echo e(@$patient_details_information->guardian_name); ?>

                                                            </td>

                                                            <td class="py-2 px-5">
                                                                <span class="font-weight-semibold w-50">Phone </span>
                                                            </td>
                                                            <td class="py-2 px-5">
                                                                <?php echo e(@$patient_details_information->phone); ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php endif; ?>

                            </div>
                        </div>
                        <form method="post" action="<?php echo e(route('save-pathology-billing')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="options px-5 pt-1  border-bottom pb-3">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 10%">Category <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 20%">Name <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 10%">Batch No <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 10%">Expiry Date <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 8%">MRP <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 8%">Sale Price <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 8%">Qty <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 8%">Unit <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 8%">Tax <span
                                                                class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 8%">Amount <span
                                                            class="text-danger">*</span></th>
                                                    <th scope="col" style="width: 2%">
                                                        <button class="btn btn-success btn-sm" type="button"
                                                            onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="subhendu">

                                                <!-- dynamic row -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="patientId" value="<?php echo e(@$patient_details_information->id); ?>" />
                            <div class="options px-5 pt-5  border-bottom pb-3">
                                <div class="container mt-5">
                                    <div class="d-flex justify-content-end">
                                        <span class="biltext">Total</span>
                                        <input type="text" name="total" readonly id="total_am"
                                            class="form-control myfld">
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
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
                                        <?php $__errorArgs = ['grnd_total'];
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
                            <div class="btn-list p-3">
                                <button class="btn btn-primary btn-sm float-right" type="button" onclick="gettotal()"><i
                                        class="fa fa-calculator"></i> Calculate</button>
                                <button class="btn btn-primary btn-sm float-right " type="submit" name="save"><i
                                        class="fa fa-file"></i> Save</button>
                                <button class="btn btn-primary btn-sm float-right mr-2" name="save_and_print"
                                    type="submit"><i class="fa fa-paste"></i> Save & Print</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===========================Add New Item Using New Row=========================== -->
    <script type="text/javascript">
        var i = 0;
        function addnewrow() {
            var html = `  <tr id="row${i}">
                        <td>
                            <select id="medicine_category${i}" onchange="getMedicineName(this.value,${i})"
                                name="medicine_category[]"
                                class="form-control select2-show-search">
                                <option value="">Select One...</option>
                                <?php if(isset($medicine_category)): ?>
                                    <?php $__currentLoopData = $medicine_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>">
                                            <?php echo e($value->medicine_catagory_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select></td>
                        <td><select onchange="getMedicineBatchDetails(this.value,${i})" name="medicine_name[]" id="medicine_name${i}"
                                class="form-control select2-show-search">
                                <option value="">Select One...</option>
                            </select></td>
                        <td><select name="medicine_batch[]" onchange="getMedicineDetailsbyBatch(this.value,${i})" id="medicine_batch${i}"
                                class="form-control select2-show-search">
                                <option value="">Select One...</option>
                            </select></td>
                        <td><input type="text" readonly name="medicine_expiry_date[]" id="medicine_expiry_date${i}"
                                class="form-control" /></td>
                        <td><input name="mrp[]" readonly id="mrp${i}" class="form-control" type="text"></td>
                        <td><input name="sale_price[]" readonly type="text" id="sale_price${i}" class="form-control" /></td>
                        <td class="avlqty_area">
                            <input type="text" class="form-control" onkeyup="getamount(${i})" id="qty${i}" name="qty[]" />
                            <span id="avi_qty${i}" class="avlqty_text">Avilable Qty : </span>
                        </td>
                        <td><input type="text" readonly name="unit[]" id="unit${i}" class="form-control" /><input type="hidden" name="unit_id[]" id="unit_id${i}" class="form-control" />
                                </td>
                                <td>
                            <input class="form-control" value="0" id="tax${i}" onkeyup="getamount(${i})" name="tax[]" type="text"/>
                        </td>
                        <td>
                            <input class="form-control" readonly id="amount${i}" name="amount[]" type="text" />
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" type="button" onclick="removerow()"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>`;
            $('#subhendu').append(html);
            i = i + 1;

        }

        function getamount(rowid)
        {
            var qty = $('#qty'+rowid).val();
            var tax = $('#tax'+rowid).val();
            var price = $('#sale_price'+rowid).val();
            var qty_p = parseFloat(qty) * parseFloat(price);
            var tax_a = parseFloat(qty_p)*(parseFloat(tax)/100);
           var amount = parseFloat(qty_p) + parseFloat(tax_a);

            $('#amount' + rowid).val(amount);
        }

        function getMedicineName(category_id, rowid) {
            $('#medicine_name' + rowid).html('<option value="">Select One...</option>');
            $('#medicine_batch' + rowid).html('<option value="">Select One...</option>');
            $('#medicine_expiry_date' + rowid).val('');
            $('#mrp' + rowid).val('');
            $('#sale_price' + rowid).val('');
            $('#unit_id' + rowid).val('');
            $('#unit' + rowid).val('');
            $('#avi_qty' + rowid).val('');

            $.ajax({
                url: "<?php echo e(route('find-medicine-name-by-category')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    medicine_category_id: category_id,
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

        function getMedicineBatchDetails(medicine_name, rowid) {
            $.ajax({
                url: "<?php echo e(route('find-medicine-batch-by-medicine-name')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    medicine_name_id: medicine_name,
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#medicine_batch' + rowid).append(
                            `<option value="${value.batch_no}">${value.batch_no}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function getMedicineDetailsbyBatch(batch_no, rowid) {
            var medicine_id = $('#medicine_name' + rowid).val();
            $.ajax({
                url: "<?php echo e(route('find-medicine-details-by-medicine-batch')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    medicine_batch_no: batch_no,
                    medicineId: medicine_id,
                },
                success: function(response) {
                    console.log(response);
                    $('#medicine_expiry_date' + rowid).val(response.medicine_details.expiry_date);
                    $('#mrp' + rowid).val(response.medicine_details.mrp);
                    $('#sale_price' + rowid).val(response.medicine_details.sale_price);
                    $('#unit' + rowid).val(response.medicine_details.medicine_unit_name);
                    $('#unit_id' + rowid).val(response.medicine_details.unit_id);
                    $('#avi_qty' + rowid).html('<h6 class="avlqty_text">Available Qty :'+response.medicine_stock.available_quantity+' '+response.medicine_details.medicine_unit_name+' </h6>')
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
    <!-- ===========================Add New Item Using New Row=========================== -->
    <script type="text/javascript">
        function removerow(i) {
            $('#rowid' + i).remove();
            gettotal();
        }
    </script>
    <script type="text/javascript">
        function gettotal() {
            var no_of_row = $('#subhendu tr').length;
            console.log('aaa=>', no_of_row);

            var t = 0;
            $("input[name='amount[]']").map(function() {
                t = t + parseFloat($(this).val());
            }).get();
            $('#total_am').val(t);

            var total_discount = $('#total_discount').val();
            if ($('#discount_type').val() == 'percentage') {
                var r = parseFloat(t) + ((parseFloat(t)) * (parseFloat(
                    total_discount) / 100));
            } else {
                var r = parseFloat(t) + parseFloat(total_discount);
            }
            var total_tax = $('#total_tax').val();
            if (total_tax != 0) {
                var grnd_total = r + (r * (total_tax / 100));
            } else {
                var grnd_total = r;
            }

            $('#grnd_total').val(grnd_total);

        }
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/generate-bill/add-medicine-bill.blade.php ENDPATH**/ ?>