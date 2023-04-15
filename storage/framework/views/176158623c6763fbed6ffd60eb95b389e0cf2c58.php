
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <!-- =================================== Message =======================================    -->
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <!-- =================================== Message =======================================    -->

        <!-- =================================== heading =======================================    -->
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Add Item Transfer
                </div>
            </div>
        </div>
        <!-- =================================== heading =======================================    -->
        <div class="card-body">
            <div class="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">From Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="from_workshop">
                                <option value="">Select Workshop</option>
                                <?php if($workshop_list): ?>
                                <?php $__currentLoopData = $workshop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['from_workshop'];
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
                            <label class="form-label">To Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="to_workshop">
                                <option value="">Select Workshop</option>
                                <?php if($workshop_list): ?>
                                <?php $__currentLoopData = $workshop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['to_workshop'];
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
                            <input type="date" required name="tranfer_date" class="form-control">
                            <?php $__errorArgs = ['tranfer_date'];
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
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['requested_by'];
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
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo e(route('item_transfer_add')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap bhsv" id="subhendu">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 13%">Item Type <span class="text-danger">*</span></th>
                                                <th scope="col" style="width: 40%">Item <span class="text-danger">*</span></th>
                                                <th scope="col" style="width: 10%">UOM <span class="text-danger">*</span></th>
                                                <th scope="col" style="width: 15%">Rate <span class="text-danger">*</span></th>
                                                <th scope="col" style="width: 15%">QTY <span class="text-danger">*</span></th>
                                                <th scope="col" style="width: 10%">Amount <span class="text-danger">*</span></th>
                                                <th scope="col" style="width: 2%">
                                                    <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- dynamic row -->
                                        </tbody>
                                    </table>
                                    <div class="container mt-5">
                                        <div class="d-flex justify-content-end">
                                            <span class="biltext">Total</span>
                                            <input type="text" required name="total" readonly id="total_am" class="form-control myfld">
                                            <?php $__errorArgs = ['total'];
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
                                    <div class="text-right  mt-5">
                                        <button class="btn btn-success" onclick="gettotal()" type="button"><i class="fa fa-calculator"></i> Calculate</button>
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    var i = 1;
    function addnewrow()
    {
        $('#total_am').val('');

        var html = '<tr class="amefld_area" id="rowid' + i + '"><td><select required  onchange="getitem(' + i + ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i + '"><option value="">Select Item type</option> <?php if(isset($item_type_list)): ?> <?php $__currentLoopData = $item_type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->item_type); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select onchange="getbrandandall(' + i + ')" name="item[]" required class="form-control select2-show-search" id="item' + i + '"><option value="">Select item</option></select></td><td><input type="text" name="unit[]" readonly required id="unit' + i + '" class="form-control"><input type="hidden" name="unit_id[]" readonly required id="unit_id' + i + '" class="form-control"></td><td><input type="hidden"  name="gst[]" required class="form-control" id="gst' + i + '"><select onchange="getAviQty(' + i + ')" name="rate[]" required class="form-control select2-show-search" id="rate' + i + '"><option value="">Select item</option></select></td><td><input type="text" id="qty' + i + '"  onkeyup="writeReqQty(this.value,' + i + ')" onchange="getamount(' + i + ')" required name="qty[]" class="form-control"></td><td><input type="text" readonly required name="amount[]" class="form-control" id="amount'+i+'"></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td><td class="avi_td"><span class="avqty_area" id="available_qty' + i + '"></span><input type="hidden" name="available_qty" id="available_qtyyy' + i + '"></td></tr>';

        $('#subhendu').append(html);
        i = i + 1;
    }
</script>
<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    function remove(i) {
        $('#total_am').val('');
        $('#rowid' + i).remove();
    }
</script>
<script type="text/javascript">
    function getitem(rowno) {

        $('#total_am').val('');
        $('#item' + rowno).empty();
        $('#qty' + rowno).val('');
        $('#unit' + rowno).val('');
        $('#unit_id' + rowno).val('');
        $('#gst' + rowno).val('');
        $('#rate' + rowno).empty();
        $('#available_qtyyy' + rowno).val('');
        $('#amount' + rowno).val('');
        $('#available_qty' + rowno).text('');
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
        $('#total_am').val('');
        $('#rate' + rowno).empty();
        $('#amount' + rowno).val('');
        var item = $('#item' + rowno).val();
        
        var div_dataa = '<option value="">Select One</option>';

        $.ajax({

            url: "<?php echo e(route('get-item-unit-gst-all')); ?>",
            type: "post",
            data: {
                item_id: item,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);

                $.each(res.rate, function(i, objj) {
                    div_dataa += "<option value=" + objj.rate + ">" + objj.rate+" </option>";
                });

                $('#rate' + rowno).append(div_dataa);
                $('#gst' + rowno).val(res.gst.gst);
                $('#unit' + rowno).val(res.base_unit_name);
                $('#unit_id' + rowno).val(res.unit_id);




            }
        });
    }
</script>
<script type="text/javascript">
    function getAviQty(rowno)
    {
        $('#total_am').val('');
        $('#qty' + rowno).val('');
        $('#amount' + rowno).val('');
        $('#unit_id' + rowno).val('');
        var item = $('#item' + rowno).val();
        var gst = $('#gst' + rowno).val();
        var rate = $('#rate' + rowno).val();
        var unit = $('#unit' + rowno).val();
        $.ajax({

            url: "<?php echo e(route('get-item-avi-qty')); ?>",
            type: "post",
            data: {
                item_id: item,
                gst_id: gst,
                rate_id: rate,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res)
                $('#available_qty' + rowno).text('Available qty : '+res+' '+unit);
                $('#available_qtyyy' + rowno).val(res);
            }
        });
    }
    
    function writeReqQty(requer_qty,rowno)
    {
        $('#total_am').val('');
        $('#amount'+rowno).val('');

        var avilb_qty = $('#available_qtyyy'+rowno).val();
        if(parseFloat(requer_qty) > parseFloat(avilb_qty))
        {
         alert("You don't have enough stock for your requirement");
         $('#qty' + rowno).val('');
     }

 }
</script>
<script type="text/javascript">
    function getamount(i)
    {
        $('#total_am').val('');
        $('#amount' + i).val('');
        var rate =  $('#rate'+i).val();
        console.log(rate);
        var qty =  $('#qty'+i).val();
        console.log(qty);
        var t_amnt = (parseFloat(rate) * parseFloat(qty));

        $('#amount'+i).val(t_amnt);


    }
</script>
<script type="text/javascript">
    function gettotal()
    {
        $('#total_am').val('');
        var no_of_row = $('#subhendu tr').length;
        console.log(no_of_row);
        var t = 0;
        for(var i = 1 ; i < no_of_row ; i++)
        {
           // var total = $('#amount'+i).val();
           var qty = $('#amount'+i).val();

           var t = parseFloat(qty) + parseFloat(t);

       }
       // console.log(t);


       var grnd_total = parseFloat(t);
       $('#total_am').val(t);
   }
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Jquery js-->
<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/item/transfer/item-transfer-form.blade.php ENDPATH**/ ?>