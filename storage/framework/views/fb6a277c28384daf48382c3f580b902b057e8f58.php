
<?php $__env->startSection('content'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function getbrandandall(rowno,item) {     
        $('#unit' + rowno).empty();
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

                    var sel = "";
                    if (objj.unit_id == item) {
                    sel = "selected";
                    }
                    div_dataa += "<option value=" + objj.unit_id + " " + sel+">" + objj.units+" </option>";
                });
           
                $('#unit' + rowno).append(div_dataa);
     
    
            }
        });
    }
</script>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Requisition</div>
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
        <form method="POST" action="<?php echo e(route('edit-requisition')); ?>">
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
                                <option <?php if($requisition_details->workshop_id == $value->id){ echo "selected"; } ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
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
                        <input type="hidden" name="requisition_id" value="<?php echo e($requisition_details->req_no); ?>">
                        <div class="col-md-4">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" required value="<?= date('Y-m-d',strtotime($requisition_details->date)); ?>" name="requisition_date" class="form-control">
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
                            <select class="form-control select2-show-search" required name="requested_by">
                                <option value="">Select One </option>
                                <?php if($user_list): ?>
                                <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php if($requisition_details->requested_by == $value->id){ echo "selected"; } ?> ><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                 
                        <div class="col-md-6">
                            <label class="form-label">Permission Authority <span class="text-danger">*</span></label>
                            <select name="permission_authority[]" required multiple="multiple" class="multi-select select2-show-search">
                                <option value="">Select One</option>
                                <?php if($user_list): ?>
                                <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php 
                    foreach ($permisison_users as $key => $res) {
                 
                      if($res->user_id == $value->id)
                        { echo "selected"; } } ?> 
                    ><?php echo e($value->name); ?></option>
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
                        <div class="col-md-6">
                            <label class="form-label">Permission Type <span class="text-danger">*</span></label>
                            <select name="permission_type" required class="select2-show-search">
                                <option value="">Select One</option>
                                <option value="Parallal" <?php if($permisison_users[0]->permission_type_user_all == 'Parallal'){ echo"selected";} ?> >Parallal</option>
                                <option value="Sequential" <?php if($permisison_users[0]->permission_type_user_all == 'Sequential'){ echo"selected";} ?> >Sequential</option>
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
                        <div class="col-md-6">
                            <label class="form-label">Item code</label>
                            <input type="text" id="item_code" onblur="addnew()" placeholder="Enter Item code" class="form-control">
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
                                    <th scope="col" style="width: 60%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 23%">Quantity <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
<?php
$i = 1;
foreach ($requisition_item as $key => $item_value) {
    ?>


<tr id="rowid<?php echo $i; ?>">
    <td>
        <select required disabled class="form-control select2-show-search" name="item_type[]" id="item_type<?php echo $i; ?>">
            <option value="<?php echo e($item_value->item_type_id); ?>" selected><?php echo e($item_value->item_type); ?></option>
        </select>
    </td>
    <td>
        <input type="hidden" name="item[]" value="<?php echo e($item_value->item_id_no); ?>">
        <select disabled onchange="getbrandandall(<?php echo $i; ?>,<?php echo $item_value->item_id_no; ?>)"   required class="form-control select2-show-search" id="item<?php echo $i; ?>">
            <option value="<?php echo e($item_value->item_id_no); ?>" selected><?php echo e($item_value->item_name); ?>(Brand :<?php echo e($item_value->brand_name); ?> )(Manufacturer :<?php echo e($item_value->manufacturar_name); ?>)(<?php echo e($item_value->item_description); ?>)</option>
        </select>
    </td>
    <td>
        <input type="text" required name="qty[]" value="<?php echo e($item_value->quantity); ?>" class="form-control" style="width: 60%; float: left;">
         <select name="unit[]" style="width: 40%; float: left;" required id="unit<?php echo $i; ?>" class="form-control select2-show-search">  
        </select>
    </td>
    <td>
        <button class="btn btn-danger" onclick="remove(<?php echo $i; ?>)"><i class="fa fa-trash"></i></button>
    </td>
</tr>

<?php
$i++;
 }
?>
                            </tbody>
                        </table>
                        <hr>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Note</label>
                                    <textarea name="note" class="form-control"><?php echo $requisition_details->notes; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" text-right">
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

    function addnew() {
        var table = document.getElementById("subhendu");
        var table_len = (table.rows.length);
        var i = parseInt(table_len);
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
    
                        var html = '<tr id="rowid' + i + '"><td><select class="form-control" name="item_type[]" required readonly ><option value="' + res.item_details.item_type_id + '">' + res.item_details.item_type + ' </option></select></td><td><select name="item[]" required class="form-control" readonly><option value="' + res.item_details.item_id + '">' + res.item_details.item_name + '(Brand : '+res.item_details.brand_name+')(Manufacturer : '+res.item_details.manufacturar_name+')(' + res.item_details.item_description + ')</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" id="unit'+i+'" required class="form-control" style="width: 40%; float: left;"></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
    
    
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
        var table = document.getElementById("subhendu");
        var table_len = (table.rows.length);
        var i = parseInt(table_len);
        var html = '<tr id="rowid' + i + '"><td><select required  onchange="getitem(' + i + ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i + '"><option value="">Select Item type</option> <?php if(isset($item_type_list)): ?> <?php $__currentLoopData = $item_type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->item_type); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select onchange="getbrandandall(' + i +',this.value)" name="item[]" required class="form-control select2-show-search" id="item' + i + '"><option value="">Select item</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" style="width: 40%; float: left;" required id="unit' + i + '" class="form-control select2-show-search"><option value="">Select Unit</option></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
    
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
    
        var item_type = $('#item_type'+rowno).val();
        $('#item' + rowno).empty();
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/requisition/edit-requisition.blade.php ENDPATH**/ ?>