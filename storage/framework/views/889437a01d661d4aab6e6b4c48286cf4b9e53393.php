
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Issue Item</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('issue_form_action')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="row">
                 
                        <input type="hidden" name="issue_by" value="<?php echo Auth::id(); ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-label">Issue to</label>
                                <select name="issue_to" class="form-control">
                                    <option value="">---Select---</option>
                                    <?php if(isset($user)): ?>
                                    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($list->id); ?>"><?php echo e($list->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['issue_to'];
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
     
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-label">Issue Date</label>
                                <input type="date" name="issue_date" class="form-control">
                                <?php $__errorArgs = ['issue_date'];
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-label">Workshop Name</label>
                                <select name="workshop_name" class="form-control">
                                    <option value="">---Select---</option>
                                    <?php if(isset($workshop_name)): ?>
                                    <?php $__currentLoopData = $workshop_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($list->id); ?>"><?php echo e($list->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['workshop_name'];
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
                      <!--   <div class="col-md-6">
                            <label class="form-label">Item code</label>
                            <input type="text" id="item_code" onblur="addnew()" placeholder="Enter Item code" class="form-control">
                        </div> -->
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 60%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 23%">Quantity <span class="text-danger">*</span></th>
                                    
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- dynamic row -->
                            </tbody>
                        </table>
                        <hr>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Note</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- End Table with stripped rows -->
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
            </form>
        </div>

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
    
                        var html = '<tr id="rowid' + i + '"><td><select name="item[]" required class="form-control" readonly><option value="' + res.item_details.item_id + '">' + res.item_details.item_name + '(Brand : '+res.item_details.brand_name+')(Manufacturer : '+res.item_details.manufacturar_name+')(' + res.item_details.item_description + ')</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" id="unit'+i+'" required class="form-control" style="width: 40%; float: left;"></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
    
    
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
        var html = '<tr id="rowid' + i + '"><td><select required  onchange="getbrandandall(' + i + ')" class="form-control select2-show-search" name="item[]" id="item' + i + '"><option value="">Select Item</option> <?php if(isset($item_list)): ?> <?php $__currentLoopData = $item_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->item_id); ?>" ><?php echo($value->item_name."( Brand :".$value->brand_name.")(Manufacturer :".$value->manufacturar_name.")(".$value->item_description.")"); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" style="width: 40%; float: left;" required id="unit' + i + '" class="form-control select2-show-search"><option value="">Select Unit</option></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
    
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
</script>
<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/tools-management/item-issue-form.blade.php ENDPATH**/ ?>