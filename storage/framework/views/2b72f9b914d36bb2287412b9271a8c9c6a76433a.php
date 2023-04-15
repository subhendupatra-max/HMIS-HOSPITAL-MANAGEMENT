

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add item categories')): ?>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-label">Issue By</label>
                                <select name="issue_by" class="form-control">
                                    <option value="">---Select---</option>
                                    <?php if(isset($user)): ?>
                                    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($list->id); ?>"><?php echo e($list->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['issue_by'];
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
                    </div>
                    <div class="row">
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
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 15%">Item Type <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 60%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 23%">Quantity <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 23%">Unit <span class="text-danger">*</span></th>
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
<?php endif; ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Issue Item List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Issue By</th>
                                <th class="border-bottom-0">Issue To</th>
                                <th class="border-bottom-0">Issue Date</th>
                                <th class="border-bottom-0">Workshop</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $issue_form_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <?php
                                $issue_by = DB::table('users')->where('id', $item->issue_by)->first();
                                ?>
                                <td><?php echo e($issue_by->name); ?></td>
                                <?php
                                $issue_to = DB::table('users')->where('id', $item->issue_to)->first();
                                ?>
                                <td><?php echo e($item->issue_to); ?></td>
                                <td><?php echo e($item->issue_date); ?></td>
                                <?php
                                $workshop = DB::table('workshops')->where('id', $item->workshop_name)->first();

                                ?>
                                <td><?php echo e($workshop->name); ?></td>
                                <td>
                                    <div class="text-wrap">
                                        <div>
                                            <div class="btn-list">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-caret-down"></i> Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a>
                                                        <a class="dropdown-item" href="<?php echo e(route('edit_issue_form', $item->id)); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
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

                        var html = '<tr id="rowid' + i + '"><td><select class="form-control" name="item_type[]" required readonly ><option value="' + res.item_type_id + '">' + res.item_type + ' </option></select></td><td><select name="brand[]" required id="brand' + i + '" class="form-control select2-show-search"><option value="">Select brand</option><?php if(isset($brand_list)): ?> <?php $__currentLoopData = $brand_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->brand_name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select name="manufacturer[]" required class="form-control select2-show-search" id="manufacturer' + i + '" onchange="getitem(' + i + ')"><option value="">Select Manufacturer</option><?php if(isset($manufacturer_list)): ?> <?php $__currentLoopData = $manufacturer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->manufacturar_name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select name="brand[]" required class="form-control" readonly><option value="' + res.brand_id + '">' + res.brand_name + '</option></select></td><td><select name="manufacturer[]" required class="form-control" readonly><option value="' + res.manufacturer_id + '">' + res.manufacturar_name + '</option></select></td><td><select name="item[]" required class="form-control" readonly><option value="' + res.item_id + '">' + res.item_name + '(' + res.item_description + ')</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><input type="text" name="unit[]" required value="' + res.units + '" readonly class="form-control" style="width: 40%; float: left;"></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';
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
    function addnewrow() {
        var html = '<tr id="rowid' + i + '"><td><select required  onchange="getitem(' + i + ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i + '"><option value="">Select Item type</option> <?php if(isset($item_type_list)): ?> <?php $__currentLoopData = $item_type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->item_type); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><select onchange="getbrandandall(' + i + ')" name="item[]" required class="form-control select2-show-search" id="item' + i + '"><option value="">Select item</option></select></td><td><input type="hidden" name="rowid_no" id="rowid_no' + i + '" value="' + i + '" /><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" style="width: 40%; float: left;" required id="unit' + i + '" class="form-control select2-show-search"><option value="">Select Unit</option></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';

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
                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name + "(Brand:" + obj.brand_name + ")(Manufacturer:" + obj.manufacturar_name + ")" + "(" + obj.item_description + ") </option>";
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
                    div_dataa += "<option value=" + objj.unit_id + ">" + objj.units + " </option>";
                });

                $('#unit' + rowno).append(div_dataa);

            }
        });
    }
</script>

<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/item/tools-management/item-issue-form.blade.php ENDPATH**/ ?>