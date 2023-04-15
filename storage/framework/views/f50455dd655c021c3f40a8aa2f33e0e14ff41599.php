
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Creation Form</h4>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="<?php echo e(route('UserCreateAction')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                    <label for="inputName" class="col-md-3 form-label">User Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                        <?php $__errorArgs = ['name'];
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
                <div class="form-group row">
                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
                        <?php $__errorArgs = ['email'];
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
                <div class="form-group row">
                    <label for="inputPassword3" class="col-md-3 form-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
                        <?php $__errorArgs = ['password'];
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
                <div class=" mb-0 row justify-content-end">
                    <label for="inputPassword3" class="col-md-3 form-label">Role</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true" name="role">
                                <optgroup label="Users">
                                    <?php $__currentLoopData = $all_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            </select>
                            <?php $__errorArgs = ['role'];
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
                <div class="form-group mb-0 mt-4 row justify-content-end">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User List</h4>
        </div>
        <div class="card-body">
            <table id="example" class="table table-borderless text-nowrap key-buttons">
                <thead>
                    <tr>
                        <th scope="col">Sl No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($all_user)): ?>
                    <?php $__currentLoopData = $all_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($loop->iteration); ?></th>
                        <td><?php echo e(@$item->name); ?></td>
                        <td><?php echo e(@$item->email); ?></td>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ame_inventory\resources\views/appPages/Users/userCreation.blade.php ENDPATH**/ ?>