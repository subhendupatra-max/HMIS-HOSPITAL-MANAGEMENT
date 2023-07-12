
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Leave List
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create leave')): ?>
                        <a href="<?php echo e(route('hr-create-leave')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>
                            Apply Leave</a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================================= Message ======================================== -->
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <!-- ================================= Message ======================================== -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave list')): ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Leave No.</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">Apply Date</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($my_leave) && $my_leave != ''): ?>
                            <?php $__currentLoopData = $my_leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><a href="<?php echo e(route('user-leave-request-list-details',['id'=>$leave->id])); ?>" style="color: blue;"><?php echo e($leave_prefix->prefix); ?><?php echo e($leave->id); ?></a>
                                </td>
                                <td><?php echo e(@$leave->leave_type); ?></td>
                                <td><?= date('d-m-Y', strtotime($leave->apply_date)) ?></td>
                                <td> <?php echo e(@$leave->from_date); ?> - <?php echo e(@$leave->to_date); ?></td>
                                <td> <span class="badge badge-danger"> <?php echo e($leave->leave_status); ?> </span></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href="<?php echo e(route('user-leave-request-list-details',['id'=>$leave->id])); ?>"><i class="fa fa-eye"></i> View</a>
                                            
                                            <?php if($leave->leave_status != 'Approved' ): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit leave')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-leave',['id'=>$leave->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if($leave->leave_status != 'Approved' ): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit leave')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-leave',['id'=>$leave->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/appPages/Users/leave-request/request-leave-list.blade.php ENDPATH**/ ?>