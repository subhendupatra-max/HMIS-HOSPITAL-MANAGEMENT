
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
                                        <div class="col-md-12 mb-2">
                                            <select class="form-control  select2-show-search" name="patient_id">
                                                <option value="">Search Patient...</option>
                                                <?php if(isset($all_patient)): ?>
                                                <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(@$patient->id); ?>" <?php echo e(@$patient_details_information->id
                                                    == $patient->id ? 'Selected' : ''); ?>>
                                                    <?php echo e(@$patient->prefix); ?> <?php echo e(@$patient->first_name); ?>

                                                    <?php echo e(@$patient->middle_name); ?>

                                                    <?php echo e(@$patient->last_name); ?>(
                                                        <?php echo e(@$patient->phone); ?> ) (
                                                    <?php echo e(@$patient->id); ?> ) </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
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
                            

                            <div class="options px-5  pb-3">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="py-2 px-5">
                                                        <span class="font-weight-semibold w-50">Case Id </span>
                                                    </td>
                                                    <td class="py-2 px-5">
                                                        <span style="color:blue"><?php echo e(@$patient_reg_details->id); ?></span>
                                                    </td>
                                                    <td class="py-2 px-5">
                                                        <span class="font-weight-semibold w-50">Section </span>
                                                    </td>
                                                    <td class="py-2 px-5">
                                                        <span style="color:rgb(36, 136, 11)"><?php echo e(@$patient_reg_details->section); ?></span>
                                                    </td>
                                                    <td class="py-2 px-5">
                                                        <span class="font-weight-semibold w-50">Gender </span>
                                                    </td>
                                                    <td class="py-2 px-5">
                                                        <?php echo e(@$patient_details_information->gender); ?></td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td class="py-2 px-5">
                                                        <span class="font-weight-semibold w-50">Age </span>
                                                    </td>
                                                    <td class="py-2 px-5">
                                                        <?php echo e(@$patient_details_information->year); ?>y
                                                        <?php echo e(@$patient_details_information->month); ?>m
                                                        <?php echo e(@$patient_details_information->day); ?>d
                                                    </td>
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
                    <form method="post" action="<?php echo e(route('save-pharmacy-billing')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="options px-5 pt-1  border-bottom pb-3">
                          
                            <div class="row">
                                <div class="col-md-4 mt-2 grncreateadd">
                                  
                                    <input type="date" required name="bill_date" class="form-control">
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
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                
                                                <th scope="col" style="width: 20%">Name <span
                                                        class="text-danger">*</span></th>
                                                <th scope="col" style="width: 10%">Batch No <span
                                                        class="text-danger">*</span></th>
                                                <th scope="col" style="width: 10%">Expiry Date <span
                                                        class="text-danger">*</span></th>
                                                <th scope="col" style="width: 8%">MRP <span class="text-danger">*</span>
                                                </th>
                                                <th scope="col" style="width: 8%">Sale Price <span
                                                        class="text-danger">*</span></th>
                                                <th scope="col" style="width: 8%">Qty <span class="text-danger">*</span>
                                                </th>
                                                <th scope="col" style="width: 8%">Unit <span
                                                        class="text-danger">*</span></th>
                                                <th scope="col" style="width: 8%">CGST <span class="text-danger">*</span>
                                                    <th scope="col" style="width: 8%">SGST <span class="text-danger">*</span>
                                                </th>
                                                <th scope="col" style="width: 8%">IGST <span class="text-danger">*</span>
                                                </th>
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

                        <input type="hidden" name="patientId" value="<?php echo e(@$patient_reg_details->patient_id); ?>" />
                        <input type="hidden" name="section" value="<?php echo e(@$patient_reg_details->section); ?>" />
                        <input type="hidden" name="case_id" value="<?php echo e(@$patient_reg_details->id); ?>" />

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                  
                                                
                                    <div class="col-md-12 mt-5 mb-3">
                                        <div class="row">
                                            <div class="col-md-6 ml-2">
                                                <input type="text" style="width:520px;margin-left:10px" id="note" name="note">
                                                <label for="note" style="margin-left:10px">Note </label>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="biltext">Total </span>
                                                <input type="text" style="    margin: -34px 0px 12px 212px;
                                            width: 208px;" name="total_value" value="0" id="total_value" class="form-control" />
                                                <span class="biltext">Total CGST Amount</span>
                                                <input type="text" style="    margin: -34px 0px 12px 212px;
                                                width: 208px;" name="total_cgst_amount" value="0" id="total_cgst_amount"
                                                class="form-control" />
                                                <span class="biltext">Total SGST Amount</span>
                                                <input type="text" style="    margin: -34px 0px 12px 212px;
                                                width: 208px;" name="total_sgst_amount" value="0" id="total_sgst_amount"
                                                class="form-control" />
                                                <span class="biltext">Total IGST Amount</span>
                                                <input type="text" style="    margin: -34px 0px 12px 212px;
                                                width: 208px;" name="total_igst_amount" value="0" id="total_igst_amount"
                                                class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 


                        <div class="btn-list p-3">
                            <button class="btn btn-primary btn-sm float-right" type="button" onclick="gettotal()"><i
                                    class="fa fa-calculator"></i> Calculate</button>
                            <button class="btn btn-primary btn-sm float-right mr-2" type="submit" value="save"
                                name="save"><i class="fa fa-file"></i> Save</button>
                            
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
                      
                        <td><select onchange="getMedicineBatchDetails(this.value,${i})" name="medicine_name[]" id="medicine_name${i}"
                                class="form-control select2-show-search">
                                <option value="">Select One...</option>
                                <?php if(isset($medicine_name)): ?>
                                    <?php $__currentLoopData = $medicine_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->medicine_id); ?>">
                                            <?php echo e($value->medicine_name); ?>(<?php echo e($value->medicine_catagory_name); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
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
                            <input class="form-control" value="0" id="cgst${i}" onkeyup="getamount(${i})" name="cgst[]" type="text"/>
                            <input class="form-control" value="0" id="cgst_value${i}" name="cgst_value[]" type="hidden"/>
                        </td>
                        <td>
                            <input class="form-control" value="0" id="sgst${i}" onkeyup="getamount(${i})" name="sgst[]" type="text"/>
                            <input class="form-control" value="0" id="sgst_value${i}"  name="sgst_value[]" type="hidden"/>
                        </td>
                        <td>
                            <input class="form-control" value="0" id="igst${i}" onkeyup="getamount(${i})" name="igst[]" type="text"/>
                            <input class="form-control" value="0" id="igst_value${i}" name="igst_value[]" type="hidden"/>
                        </td>
                        <td>
                            <input class="form-control" readonly id="amount${i}" name="amount[]" type="text" />
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" type="button" onclick="removerow(${i})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>`;
            $('#subhendu').append(html);
            i = i + 1;

        }

        function getamount(rowid) {
            var qty = $('#qty' + rowid).val();
            console.log(qty);
            var cgst = $('#cgst' + rowid).val();
            console.log(cgst);
            var igst = $('#igst' + rowid).val();
            console.log(igst);
            var sgst = $('#sgst' + rowid).val();
            console.log(sgst);
            var price = $('#sale_price' + rowid).val();
            console.log(price);
            var qty_p = parseFloat(qty) * parseFloat(price);
            console.log(qty_p);
            var gst = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst);
            var tax_a = parseFloat(qty_p) * (parseFloat(gst) / 100);


            var igst_value = parseFloat(qty_p) * (parseFloat(igst) / 100);
            var cgst_value = parseFloat(qty_p) * (parseFloat(cgst) / 100);
            var sgst_value = parseFloat(qty_p) * (parseFloat(sgst) / 100);
            $('#igst_value' + rowid).val(igst_value);
            $('#cgst_value' + rowid).val(cgst_value);
            $('#sgst_value' + rowid).val(sgst_value);

            console.log(tax_a);
            var amount = parseFloat(qty_p) + parseFloat(tax_a);
            console.log(amount);
            $('#amount' + rowid).val(amount);
            gettotal();
        }

        function getMedicineName(category_id, rowid) {
            $('#medicine_name' + rowid).html('');
            $('#medicine_name' + rowid).html('');
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
            $('#medicine_batch' + rowid).html('');
            $('#medicine_batch' + rowid).html('<option value="">Select One...</option>');
            $.ajax({
                url: "<?php echo e(route('find-medicine-batch-by-medicine-name')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    medicine_name_id: medicine_name,
                },
                success: function(response) {
                    console.log(response);
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
                    var avi_q = response
                        .medicine_stock.available_quantity -  ( response.exp_medi + response.issue_medi);
                    $('#medicine_expiry_date' + rowid).val(response.medicine_details.exp_date);
                    $('#mrp' + rowid).val(response.medicine_details.mrp);
                    $('#sale_price' + rowid).val(response.medicine_details.s_rate);
                    $('#cgst' + rowid).val(response.medicine_details.cgst);
                    $('#sgst' + rowid).val(response.medicine_details.sgst);
                    $('#igst' + rowid).val(response.medicine_details.igst);
                    $('#unit' + rowid).val(response.medicine_details.medicine_unit_name);
                    $('#unit_id' + rowid).val(response.medicine_details.unit_id);
                    $('#avi_qty' + rowid).html('<h6 class="avlqty_text">Available Qty :' + avi_q + ' ' + response.medicine_details
                        .medicine_unit_name + ' </h6>')
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
            $('#row' + i).remove();
            gettotal();
        }
</script>
<script type="text/javascript">
    function gettotal() {
            var no_of_row = $('#subhendu tr').length;

            var t = 0;
            $("input[name='amount[]']").map(function() {
                t = t + parseFloat($(this).val());
            }).get();
            $('#total_value').val(t);

            var cgst_value = 0;
            $("input[name='cgst_value[]']").map(function() {
                cgst_value = parseFloat(cgst_value + parseFloat($(this).val())).toFixed(2);
            }).get();
            $('#total_cgst_amount').val(cgst_value);

            var sgst_value = 0;
            $("input[name='sgst_value[]']").map(function() {
                sgst_value = parseFloat(sgst_value + parseFloat($(this).val())).toFixed(2);
            }).get();
            $('#total_sgst_amount').val(sgst_value);

            var igst_value = 0;
            $("input[name='igst_value[]']").map(function() {
                igst_value = parseFloat(igst_value + parseFloat($(this).val())).toFixed(2);
            }).get();
            $('#total_igst_amount').val(igst_value);


        }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pharmacy/generate-bill/add-medicine-bill.blade.php ENDPATH**/ ?>