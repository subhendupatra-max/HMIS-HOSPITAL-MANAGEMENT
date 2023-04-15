

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit opd unit')): ?>
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Opd Unit</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('update-opd-unit-details')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <input type="hidden" name="id" value="<?php echo e($editOpdUnit->id); ?>">
                    <div class="form-group">
                        <label for="department_id" class="form-label">Department<span class="text-danger">*</span></label>
                        <select id="department_id" class="form-control" name="department_id">
                            <option value=" ">Select Department</option>
                            <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $editOpdUnit->department_id ? 'selected' : " "); ?>><?php echo e($item->department_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['department_id'];
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
                        <label for="department_id" class="form-label">Days<span class="text-danger">*</span></label>
                        <select name="days" class="form-control" id="days">
                            <option value="">Select</option>
                            <?php $__currentLoopData = Config::get('static.weeks'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($week); ?>" <?php echo e($week == $editOpdUnit->days ? 'selected' : " "); ?>> <?php echo e($week); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="department_id" class="form-label">Unit<span class="text-danger">*</span></label>
                        <table class="table" id="dynamic_field">
                        <td><button type="button" name="add" id="add" class="btn btn-success" onclick="addmore()"><i class="fa fa-plus"></i></button></td>
                            <?php $__currentLoopData = $opdUnitDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="row1">
                                <td><input type="text" name="unit[]" value="<?php echo e(@$item->unit_name); ?>" class="form-control name_list" /></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </table>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Opd Unit</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Opd Unit List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Department</th>
                                <th class="border-bottom-0">Days</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete opd unit','edit opd unit')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $opdUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->department_id); ?></td>
                                <td><?php echo e($item->days); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit opd unit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-opd-unit-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete opd unit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-opd-unit-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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

<script>
    var i = 2;

    function addmore() {

        $('#dynamic_field').append(
            `<tr id="row${i}">
                <td><input type="text" name="unit[]" placeholder="Enter Unit" class="form-control name_list" /></td>
                <td><button type="button" id="add" class="btn btn-danger" onclick="remove(${i})"><i class="fa fa-trash"></i></button></td>
            </tr>`
        );
        i = i + 1;

    }

    function remove(row_no) {
        $('#row' + row_no).remove();
    }
</script>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/setup/opd/opd-unit/edit-unit.blade.php ENDPATH**/ ?>