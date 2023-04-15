

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit charges')): ?>
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Charges</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('update-charges-details')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($editCharges->id); ?>">
                <div class="">
                <div class="form-group">
                        <label for="charges_catagory_id" class="form-label">Charges Catagory </label>
                        <select id="charges_catagory_id" class="form-control select2-show-search" name="charges_catagory_id">
                        <option value=" ">Select Charges Catagory </option>
                            <?php $__currentLoopData = @$charges_catagory_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $editCharges->charges_catagory_id ? 'selected' : " "); ?>><?php echo e($item->charges_catagories_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['charges_catagory_id'];
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

                    <div class="form-group">
                        <label for="charges_sub_catagory_id" class="form-label">Charges Sub Catagory</label>
                        <select id="charges_sub_catagory_id" class="form-control select2-show-search" name="charges_sub_catagory_id">
                            <option value=" ">Select Charges Sub Catagory </option>
                            <?php $__currentLoopData = $charges_sub_catagory_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $editCharges->charges_sub_catagory_id ? 'selected' : " "); ?>><?php echo e($item->charges_sub_catagories_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['charges_sub_catagory_id'];
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

                    <div class="form-group">
                        <label for="charges_units_id" class="form-label">Charges Unit</label>
                        <select id="charges_units_id" class="form-control select2-show-search" name="charges_units_id">
                            <option value=" ">Select Charges Unit </option>
                            <?php $__currentLoopData = $charges_units_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $editCharges->charges_unit_id ? 'selected' : " "); ?>><?php echo e($item->charges_units_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['charges_units_id'];
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

                    <div class="form-group">
                        <label for="charges_name" class="form-label">Charges name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="charges_name" name="charges_name" placeholder="Enter Charges Name" value="<?php echo e($editCharges->charges_name); ?>" required>
                        <?php $__errorArgs = ['charges_name'];
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
                    
                    <div class="form-group">
                        <label for="standard_charges" class="form-label">Standard Charges  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="standard_charges" name="standard_charges" value="<?php echo e($editCharges->standard_charges); ?>" required>
                        <?php $__errorArgs = ['standard_charges'];
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
                    
                    <div class="form-group ">
                        <label for="standard_charges" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" <?php if(isset($editCharges->date)): ?> value="<?php echo e(date('Y-m-d',strtotime($editCharges->date))); ?>" <?php endif; ?>>
                        <small class="text-danger"><?php echo e($errors->first('date')); ?></small>
                    </div>

                    <div class="form-group ">
                        <label for="description" class="form-label">Description</label>
                        <textarea  class="form-control" id="description" name="description"> <?php echo e(@$editCharges->description); ?> </textarea>
                        <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
                    </div>


                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Bed</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Bed List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Sub Catagory Name</th>
                                <th class="border-bottom-0">Unit Name</th>
                                <th class="border-bottom-0">Charges name</th>
                                <th class="border-bottom-0">Standard Charges </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Description</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete charges','edit charges')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->charges_catagory->charges_catagories_name); ?></td>
                                <td><?php echo e($item->charges_sub_catagory->charges_sub_catagories_name); ?></td>
                                <td><?php echo e(@$item->charges_unit->charges_units_name); ?></td>
                                <td><?php echo e($item->charges_name); ?></td>
                                <td><?php echo e($item->standard_charges); ?></td>
                                <td><?php echo e($item->date); ?></td>
                                <td><?php echo e($item->description); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit charges')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-charges-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete charges')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-charges-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/charges/edit-charges.blade.php ENDPATH**/ ?>