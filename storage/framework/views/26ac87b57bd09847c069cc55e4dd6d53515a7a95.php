
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create Requisition</div>
            <div class="ggdtretew">
                <a href="<?php echo e(route('itemList')); ?>" class="btn btn-primary" data-placement="left" data-toggle="tooltip" title="Add New Item"><i class="fa fa-plus"></i></a>
            </div>
            <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>
        </div>
        <form method="POST" action="<?php echo e(route('save-requisition')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="workshop">
                                <option value="">Select Workshop</option>
                                <?php if($workshop_list): ?>
                                <?php $__currentLoopData = $workshop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="requisition_date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Requested By <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="requested_by">
                                <option value="">......................... Select One ............................</option>
                                <?php if($user_list): ?>
                                <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Item code</label>
                            <input type="text" name="item_code" id="item_code" onblur="addnew()" placeholder="Enter Item code" class="form-control">
                        </div>
                        <!--   <div class="col-md-4"  style="margin-top: 26px;">
                <div class="row">
                <div class="col-md-6">
            <label  class="form-label">
               Single Permission </label> <input type="radio" name="item_permission" value="1"  >
           </div>
            <div class="col-md-6">
            <label  class="form-label"> Multiple Permission </label> <input type="radio" name="item_permission" value="2"  ></div>
            </div>  
            </div> -->
                        <div class="col-md-4">
                            <label class="form-label">Permission Authority</label>
                            <select name="permission_authority[]" multiple="multiple" class="multi-select select2-show-search">
                                <option value="">......................... Select One ............................</option>
                                <?php if($user_list): ?>
                                <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
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
                                    <th scope="col" style="width: 15%">Brand <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 15%">Manufacturer <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 40%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 13%">Quantity <span class="text-danger">*</span></th>
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
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Note</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" text-right">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var i = 1;

    function addnew() {
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
                    console.log(res);

                    if (res.item_type_id != null && res.item_id != null) {

                        var html = '<tr id="rowid' + i + '"><td><select class="form-control" name="item_type[]" required readonly ><option value="' + res.item_type_id + '">' + res.item_type + ' </option></select></td><td><select name="brand[]" required class="form-control" readonly><option value="' + res.brand_id + '">' + res.brand_name + '</option></select></td><td><select name="manufacturer[]" required class="form-control" readonly><option value="' + res.manufacturer_id + '">' + res.manufacturar_name + '</option></select></td><td><select name="item[]" required class="form-control" readonly><option value="' + res.item_id + '">' + res.item_name + '(' + res.item_description + ')</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><input type="text" name="unit[]" required value="' + res.units + '" readonly class="form-control" style="width: 40%; float: left;"></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';
                        $('#subhendu').append(html);
                        i = i + 1;
                    } else {
                        alert('Enter a valid Item Code');
                    }

                }
            });


        }
    }
</script>

<script type="text/javascript">
    function addnewrow()

    {
        var html = '<tr id="rowid' + i + '"><td><select required class="form-control select2-show-search" name="item_type[]" id="item_type' + i + '"><option value="">Select Item type</option> <?php if(isset($item_type_list)): ?> <?php $__currentLoopData = $item_type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->item_type); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select name="brand[]" required id="brand' + i + '" class="form-control select2-show-search"><option value="">Select brand</option><?php if(isset($brand_list)): ?> <?php $__currentLoopData = $brand_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->brand_name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select name="manufacturer[]" required class="form-control select2-show-search" id="manufacturer' + i + '" onchange="getitem(' + i + ')"><option value="">Select Manufacturer</option><?php if(isset($manufacturer_list)): ?> <?php $__currentLoopData = $manufacturer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->manufacturar_name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select name="item[]" required class="form-control select2-show-search" id="item' + i + '"><option value="">Select item</option></select></td><td><input type="hidden" name="rowid_no" id="rowid_no' + i + '" value="' + i + '" /><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><input type="text" required name="unit[]" id="unit' + i + '" class="form-control" style="width: 40%; float: left;"></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';
        $('#subhendu').append(html);
        i = i + 1;
    }
</script>
<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
    }
</script>
<script type="text/javascript">
    function getitem(rowno) {

        var item_type = $('#item_type' + rowno).val();
        var brand = $('#brand' + rowno).val();
        var manufacturer = $('#manufacturer' + rowno).val();
        var div_data = '';
        var unit = '';
        $.ajax({

            url: "<?php echo e(route('get-item')); ?>",
            type: "post",
            data: {
                item_type_id: item_type,
                brand_id: brand,
                manufacturer_id: manufacturer,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $.each(res, function(i, obj) {
                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name + "(" + obj.item_description + ") </option>";
                    unit = obj.units;
                });

                $('#item' + rowno).append(div_data);
                $('#unit' + rowno).val(unit);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/item/requisition/requisition-create.blade.php ENDPATH**/ ?>