
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
           
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap" >
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 60%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 15%">Unit <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 23%">Quantity <span class="text-danger">*</span></th>
                                    
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="subhendu">
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

<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    function addnewrow()
    {
        let i = 0;
        var html = '<tr id="rowid' + i + '"><td><select required  onchange="getbrandandall(' + i + ')" class="form-control select2-show-search" name="item[]" id="item' + i + '"><option value="">Select Item</option> <?php if(isset($item_list)): ?> <?php $__currentLoopData = $item_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->item_id); ?>" ><?php echo($value->item_name."( Brand :".$value->brand_name.")(Manufacturer :".$value->manufacturar_name.")(".$value->item_description.")"); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select name="unit[]" onchange="getAviQty(' + i + ')" required id="unit' + i + '" class="form-control select2-show-search"><option value="">Select Unit</option></select></td><td><span class="avqty_area" id="available_qty' + i + '"></span><input type="text" id="qty'+i+'"  onkeyup="writeReqQty(this.value,' + i + ')" required name="qty[]" class="form-control"></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button><input type="hidden" name="available_qty" id="available_qtyyy' + i + '"></td></tr>';
    
        $('#subhendu').append(html);
        i = i + 1;
    }
</script>

<script type="text/javascript">
    function getAviQty(rowno)
    {
        var item = $('#item' + rowno).val();
        var unit = $('#unit' + rowno).val();

        $.ajax({
    
            url: "<?php echo e(route('get-tools-avi-qty')); ?>",
            type: "post",
            data: {
                item_id: item,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res)
                $('#available_qty' + rowno).text('Available qty : '+res );
                $('#available_qtyyy' + rowno).val(res);

            }
        });
    }
    
    function writeReqQty(requer_qty,rowno)
    {
         
        var avilb_qty = $('#available_qtyyy'+rowno).val();
        if(parseFloat(requer_qty) > parseFloat(avilb_qty))
        {
           alert("You don't have enough stock for your requirement");
           $('#qty' + rowno).val('');
        }
       
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/item/tools-management/item-issue-form.blade.php ENDPATH**/ ?>