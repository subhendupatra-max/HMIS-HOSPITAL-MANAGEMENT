

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add medicine dosage')): ?>
<div class="col-lg-12 col-xl-5 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Medicine Dosage</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-medicine-dosage-details')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">

                    <div class="form-group">
                        <label for="medicine_catagory_id" class="form-label"> Medicine Catagory <span class="text-danger">*</span></label>
                        <select name="medicine_catagory_id" class="form-control select2-show-search" id="medicine_catagory_id">
                            <option value="">Select Catagory Name ... </option>
                            <?php $__currentLoopData = $catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($items->id); ?>"><?php echo $items->medicine_catagory_name; ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['medicine_catagory_id'];
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

                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Dose<span class="text-danger">*</span></th>
                                <th scope="col">Unit <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 2%">

                                </th>
                            </tr>
                        </thead>
                        <tbody id="subhendu">
                            <tr id="rowid0">
                                <td>
                                    <input type="text" class="form-control" id="dose" name="dose[]" value="<?php echo e(old('dose')); ?>" required>
                                </td>
                                <td>
                                    <select name="medicine_unit_id[]" class="form-control select2-show-search" id="medicine_unit_id">
                                        <option value="">Select Unit Name ... </option>
                                        <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($items->id); ?>"><?php echo $items->medicine_unit_name; ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                            <!-- dynamic row -->
                        </tbody>
                    </table>


                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Dosage</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-7 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title"></div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0"> Medicine Catagory</th>
                                <th class="border-bottom-0"> Unit</th>
                                <th class="border-bottom-0"> Dose</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine dosage','delete medicine dosage')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $dosage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->catagory_name->medicine_catagory_name); ?></td>
                                <td><?php echo e(@$item->unit_name->medicine_unit_name); ?></td>
                                <td><?php echo e(@$item->dose); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine dosage')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-medicine-dosage-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine dosage')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-medicine-dosage-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>
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

<script>
    var rowid = 1;

    function addnewrow() {

        var html = ` <tr id="rowid${rowid}">
                                <td><input type="text" class="form-control" id="dose" name="dose[]" value="<?php echo e(old('dose')); ?>" required></td>
                                <td>
                                <select name="medicine_unit_id[]" class="form-control select2-show-search" id="medicine_unit_id">
                                        <option value="">Select Unit Name ... </option>
                                        <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($items->id); ?>"><?php echo $items->medicine_unit_name; ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                <button type="button" class="btn btn-danger" onclick="removerow(${rowid})"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;
        $('#subhendu').append(html);
        rowid = rowid + 1;
    }

    function removerow(rowid) {
        $('#rowid' + rowid).empty();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/setup/pharmacy/medicine-dosage/medicine-dosage-listing.blade.php ENDPATH**/ ?>