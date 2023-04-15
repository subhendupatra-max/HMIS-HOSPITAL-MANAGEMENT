
<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User List </h4>
            </div>
            <!-- ================================ Alert Message===================================== -->

            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <!-- ================================ Alert Message===================================== -->
            
            
            
            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Department</th>
                            <th scope="col">Status</th>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user profile || user active deactive || user edit || user delete')): ?>
                                <th scope="col"> Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($all_user)): ?>
                            <?php $__currentLoopData = $all_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                    <td><img alt="User Avatar" style="height:25px;width: 25px" class="rounded-circle"
                                            src="<?php echo e(asset('public/profile_picture')); ?>/<?php echo e($item->profile_image); ?>">
                                        <?php echo e(@$item->first_name); ?> <?php echo e(@$item->last_name); ?></td>
                                    <td><?php echo e(@$item->email); ?></td>
                                    <td><?php echo e(@$item->role); ?></td>
                                    <td><?php echo e(@$item->department->department_name); ?></td>
                                    <td>
                                        <?php if($item->is_active == '1'): ?>
                                            <span class="badge badge-success">Enable</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Disable</span>
                                        <?php endif; ?>

                                    </td>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user profile || user active deactive || user edit || user delete')): ?>
                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user profile')): ?>
                                                        <a class="dropdown-item"
                                                            href="<?php echo e(route('user-profile')); ?>/<?php echo e(base64_encode($item->id)); ?>"><i
                                                                class="fa fa-eye"></i> View</a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user active deactive')): ?>
                                                        <?php if($item->id != Auth::id()): ?>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('user-enable-disable', base64_encode($item->id))); ?>"><i
                                                                    class="fa fa-user-lock"></i> Enable/Disable</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if(auth()->user()->can('user edit') || $item->id == Auth::id()): ?>
                                                        <a class="dropdown-item"
                                                            href="<?php echo e(route('user-edit', base64_encode($item->id))); ?>"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user delete')): ?>
                                                        <?php if($item->id != Auth::id()): ?>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('user-delete', base64_encode($item->id))); ?>"><i
                                                                    class="fa fa-trash"></i> Delete</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    <script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/appPages/Users/user-list.blade.php ENDPATH**/ ?>