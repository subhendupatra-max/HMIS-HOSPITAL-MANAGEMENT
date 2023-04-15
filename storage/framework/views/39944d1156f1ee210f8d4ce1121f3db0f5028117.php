
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Blood Components</div>
        </div>

        <form method="POST" action="<?php echo e(route('save-blood-components-details')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="blood_group_id" value="<?php echo e($blood_groups_id->id); ?>" />

                        <div class="form-group col-md-3">
                            <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                            <select id="blood_group" class="form-control" name="blood_group">
                                <option value=" ">Select </option>
                                <?php $__currentLoopData = $blood_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $blood_groups_id->id ? 'selected' : " "); ?>> <?php echo e($item->blood_group_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['blood_group'];
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

                        <div class="form-group col-md-3">
                            <label for="bag" class="form-label">Bag <span class="text-danger">*</span></label>
                            <select id="bag" class="form-control" name="bag">
                                <option value=" ">Select </option>
                                <?php $__currentLoopData = $getBag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->bag); ?>"> <?php echo e($item->bag); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['bag'];
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

                    <div class="form-group">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col">#<span class="text-danger">*</span></th>
                                    <th scope="col"> Components Name <span class="text-danger">*</span></th>
                                    <th scope="col">Bag<span class="text-danger">*</span></th>
                                    <th scope="col">Volume<span class="text-danger">*</span></th>
                                    <th scope="col">Unit<span class="text-danger">*</span></th>
                                    <th scope="col">Lot<span class="text-danger">*</span></th>
                                    <th scope="col">Institution<span class="text-danger">*</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $component_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $components_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="componests_id[]" id="componests_id" value="<?php echo e($components_name->id); ?>" />
                                    </td>
                                    <td><?php echo e($components_name->component_name); ?></td>
                                    <td>
                                        <input type="text" class="form-control" name="bags[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="volumes[]" />
                                    </td>
                                    <td>
                                        <select id="unitTypes" class="form-control" name="unitTypes[]">
                                            <option value=" ">Select Unit Type</option>
                                            <?php $__currentLoopData = $unit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"> <?php echo e($item->blood_unit_types); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" name="lots[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="institution[]" />
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>


                </div>

                <div class="text-center">

                    <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
                </div>
                <!-- End Table with stripped rows -->
            </div>


        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Blood_Bank/blood-components/add-blood-components.blade.php ENDPATH**/ ?>