
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create EMG Challan</div>
<!-- ================================ Add Item===================================== -->
            <div class="create_req">
                <a href="<?php echo e(route('itemList')); ?>" class="btn btn-primary" data-placement="left" data-toggle="tooltip" title="Add New Item"><i class="fa fa-plus"></i></a>
            </div>
<!-- ================================ Add Item===================================== -->            
<!-- ================================ Alert Message===================================== -->
            <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>
<!-- ================================ Alert Message===================================== -->
        </div>
<!-- ================================Save Requisition===================================== -->
        <form method="POST" action="<?php echo e(route('save-emg-challan-details')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="workshop">
                                <option value="">Select Workshop</option>
                                <?php if($workshop_list): ?>
                                <?php $__currentLoopData = $workshop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['workshop'];
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
                        <div class="col-md-4">
                            <label class="form-label">Vendor <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="vendor">
                                <option value="">Select One </option>
                                <?php if($vendor_list): ?>
                                <?php $__currentLoopData = $vendor_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->vendor_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Permission Authority</label>
                            <select name="permission_authority[]" multiple="multiple" class="multi-select select2-show-search">
                                <option value="">Select One</option>
                                <?php if($user_list): ?>
                                <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['permission_authority'];
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
                        <div class="col-md-4">
                            <label class="form-label">Permission Type</label>
                            <select name="permission_type" class="select2-show-search">
                                <option value="">Select One</option>
                                <option value="Parallal">Parallal</option>
                                <option value="Sequential">Sequential</option>
                            </select>
                            <?php $__errorArgs = ['permission_type'];
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
                        <div class="col-md-4">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" name="requisition_date" class="form-control">
                            <?php $__errorArgs = ['requisition_date'];
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
                        <div class="col-md-4">
                            <label class="form-label">Requested By <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="requested_by">
                                <option value="">Select One </option>
                                <?php if($user_list): ?>
                                <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>

                                 <div class="col-md-4">
                <label  class="requisition_header">Materials Rec. Date<span class="text-danger">*</span></label>
                <input type="date" name="material_rec_date" class="form-control">
            <?php $__errorArgs = ['material_rec_date'];
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
            <div class="col-md-4">
                <label  class="requisition_header">Bill Rec. Date<span class="text-danger">*</span></label>
                <input type="date" name="bill_rec_date" class="form-control">
            <?php $__errorArgs = ['bill_rec_date'];
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
            <div class="col-md-4">
                <label  class="requisition_header">Challan No.</label>
                <input type="text" name="challan_no" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Challan Date</label>
                <input type="date" name="challan_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Challan Copy</label>
                <input type="file" name="challan_copy">
            </div>


            <div class="col-md-4">
                <label  class="requisition_header">Invoice No.</label>
                <input type="text" name="invoice_no" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Invoice Date</label>
                <input type="date" name="invoice_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Invoice Copy</label>
                <input type="file" name="invoice_copy">
            </div>
                        <div class="col-md-4">
                            <label class="form-label">Item code</label>
                            <input type="text" name="item_code" id="item_code" onblur="addnew()" placeholder="Enter Item code" class="form-control">
                        </div>
          
              
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 15%">Item Type <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 35%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width:20%">Quantity <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 7%">GST <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Rate/pic <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Amount<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- dynamic row -->
                            </tbody>
                        </table>
                        <hr>
            <div class="container mt-5">
               <div class="d-flex justify-content-end">
                   <span class="biltext">Total</span>
                   <input type="text" name="total" readonly id="total_am" class="form-control myfld">
               </div>
               <div class="d-flex justify-content-end">
                   <input type="text" name="extra_charges_name" placeholder="Enter Extra Charges Name" class="form-control myfld2">
                   <input type="text" name="extra_charges_value" value="00" class="form-control myfld1" id="extra_chages">
               </div>
               <div class="d-flex justify-content-end thrdarea">
                   <span class="biltext">Grand Total</span>
                   <input type="text" name="grand_total" readonly id="grnd_total" value="00" class="form-control myfld">
               </div>
          </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Note</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" text-right">
                            <button class="btn btn-success" onclick="gettotal()" type="button"><i class="fa fa-calculator"></i> Calculate</button>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </form>
<!-- ============================== Save Requisition ===================================== -->
    </div>
</div>

<!-- ===========================Add New Item Using item Code=========================== -->
<script type="text/javascript">
    var i = 1;
    
    function addnew() {
        var div_da = '';
        var div_manu = '';
        var div_unit = '';
        const itemcode = $("#item_code").val();
        if (itemcode != null) {
            $.ajax({
    
                url: "<?php echo e(route('get-item-details')); ?>",
                type: "post",
                data: {
                    item_code: itemcode,
                    _token: '<?php echo e(csrf_token()); ?>',
                },
                dataType: 'json',
                success: function(res) {
    
                    
                    if (res.item_details.item_type_id != null && res.item_details.item_id != null) {
    
                        var html = '<tr id="rowid' + i + '"><td><select class="form-control" name="item_type[]" required readonly ><option value="' + res.item_details.item_type_id + '">' + res.item_details.item_type + ' </option></select></td><td><select name="item[]" required class="form-control" readonly><option value="' + res.item_details.item_id + '">' + res.item_details.item_name + '(Brand : '+res.item_details.brand_name+')(Manufacturer : '+res.item_details.manufacturar_name+')(' + res.item_details.item_description + ')</option></select></td><td><input type="text" required name="qty[]" id="qty'+i+'" class="form-control" onkeyup="getamount('+i+')" style="width: 40%; float: left;"><select name="unit[]" id="unit'+i+'" required class="form-control" style="width: 60%; float: left;"></select></td><td><input type="text" onkeyup="getamount('+i+')" required name="gst[]" id="gst'+i+'" class="form-control"></td><td><input type="text"  onkeyup="getamount('+i+')" id="rate'+i+'" required name="rate[]" class="form-control"></td><td><input type="text" required name="amount[]" id="amount'+i+'" class="form-control"></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
    
    
                        $.each(res.item_unit, function(i, objjj) {
    
                         div_unit += "<option value='" + objjj.unit_id + "'>" + objjj.units + "</option>";
    
                         });
    
                         
                        $('#subhendu').append(html);
                        $('#unit' + i).append(div_unit);
                        i = i + 1;
                    } else {
                        alert('Enter a valid Item Code');
                    }
    
                }
            });
    
    
        }
    }
</script>
<!-- ===========================Add New Item Using item Code=========================== -->

<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    function addnewrow()
    
    {
        var html = '<tr id="rowid' + i + '"><td><select required  onchange="getitem(' + i + ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i + '"><option value="">Select Item type</option> <?php if(isset($item_type_list)): ?> <?php $__currentLoopData = $item_type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->item_type); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select onchange="getbrandandall(' + i + ')" name="item[]" required class="form-control select2-show-search" id="item' + i + '"><option value="">Select item</option></select></td><td><input type="hidden" name="rowid_no" id="rowid_no' + i + '" value="' + i + '" /><input type="text" required name="qty[]" id="qty'+i+'" onkeyup="getamount('+i+')" class="form-control" style="width: 60%; float: left;"><select name="unit[]" style="width: 40%; float: left;" required id="unit' + i + '" class="form-control select2-show-search"><option value="">Select Unit</option></select></td><td><input type="text" onkeyup="getamount('+i+')" required name="gst[]" id="gst'+i+'" class="form-control"></td><td><input type="text"  onkeyup="getamount('+i+')" id="rate'+i+'" required name="rate[]" class="form-control"></td><td><input type="text" required name="amount[]" id="amount'+i+'" class="form-control"></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
    
        $('#subhendu').append(html);
        i = i + 1;
    }
</script>
<!-- ===========================Add New Item Using New Row=========================== -->

<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
    }
</script>

<script type="text/javascript">
    function getitem(rowno) {
    
    
        $('#item' + rowno).empty();
        var item_type = $('#item_type' + rowno).val();
        console.log(item_type);
        var div_data = '<option value="">Select One</option>';
        var unit = '';
        $.ajax({
    
            url: "<?php echo e(route('get-item')); ?>",
            type: "post",
            data: {
                item_type_id: item_type,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $.each(res, function(i, obj) {
                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name+"(Brand:"+obj.brand_name+")(Manufacturer:"+obj.manufacturar_name+")" + "(" + obj.item_description + ") </option>";
                });
    
                $('#item' + rowno).append(div_data);
    
            }
        });
    }
</script>
<script type="text/javascript">
    function getbrandandall(rowno) {
        $('#unit' + rowno).empty();
        var item = $('#item' + rowno).val();
        
        var div_dataa = '<option value="">Select One</option>';
    
        $.ajax({
    
            url: "<?php echo e(route('get-item-brand-all')); ?>",
            type: "post",
            data: {
                item_id: item,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
         
                $.each(res.item_unit, function(i, objj) {
                    div_dataa += "<option value=" + objj.unit_id + ">" + objj.units+" </option>";
                });
           
                $('#unit' + rowno).append(div_dataa);
     
    
            }
        });
    }

    function gettotal()
    {

        var no_of_row = $('#subhendu tr').length;
        console.log(no_of_row);
        var t = 0;
        for(var i = 1 ; i < no_of_row ; i++)
        {
            var total = $('#amount'+i).val();
            console.log(total);
            var t = parseFloat(total) + parseFloat(t);

        }
       console.log(t);
       var extra = $('#extra_chages').val();

       var grnd_total = parseFloat(t) + parseFloat(extra);
       $('#total_am').val(t);
       $('#grnd_total').val(grnd_total);
    }
</script>
<script type="text/javascript">
    function getamount(i)
    {
        var gst =  $('#gst'+i).val();
        console.log(gst);
        var rate =  $('#rate'+i).val();
         console.log(rate);
        var qty =  $('#qty'+i).val();
         console.log(qty);

        var amnt = ( parseFloat(rate) * parseFloat(qty) * parseFloat(gst) ) / 100;
        var t_amnt = parseFloat(amnt) + (parseFloat(rate) * parseFloat(qty));

        $('#amount'+i).val(t_amnt);


    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/emg_challan/emg-item-create.blade.php ENDPATH**/ ?>