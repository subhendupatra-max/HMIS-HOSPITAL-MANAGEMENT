
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Blood Bank Status
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Blood Donar')): ?>
                        <a href="<?php echo e(route('all-blood-donor-details-listing')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i>
                            Donor Details </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('pathology-test-list')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-vials"></i> Blood Issue Details </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('pathology-test-master-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-mortar-pestle"></i> Components Issue </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2 " style="display:inline-block">
                            <?php $__currentLoopData = $blood_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blood_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <a href="<?php echo e(route('blood-details',['id'=> base64_encode($blood_group->id) ])); ?>" class="<?php if(@$blood_group_id == $blood_group->id): ?> btn btn-secondary <?php else: ?> btn btn-primary <?php endif; ?> btn-sm d-block  mb-1 btnclr_area"><i class="fa fa-file"></i>
                                <?php echo e($blood_group->blood_group_name); ?> </a>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(@$blood_group_id): ?>
                        <div class="col-md-5" style="display:inline-block">
                            <div class="card cstmcard_area">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <div class="row">
                                            <h4 style="float:left"><?php echo e(@$blood_groups_details_for_this_blood_group->blood_group_name); ?>

                                                Blood Details</h4>
                                            <div class="plsbtndesign">
                                                <a href="<?php echo e(route('add-blood',['id'=> base64_encode($blood_groups_details_for_this_blood_group->id) ])); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-primary table-white ">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="text-white">ID</th>
                                                <th class="text-white">Bags</th>
                                                <th class="text-white">Lot</th>
                                                <th class="text-white">Institution</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $blood; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e(@$item->bag); ?></td>
                                                <td><?php echo e(@$item->lot); ?></td>
                                                <td><?php echo e(@$item->institution); ?></td>
                                                <td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                                    <a href="<?php echo e(route('add-blood-issue-details',['blood_group_id'=> base64_encode($blood_groups_details_for_this_blood_group->id) , 'id'=> base64_encode($item->id)  ])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Issue </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table-responsive -->
                            </div>
                        </div>
                        <div class="col-md-5" style="display:inline-block">
                            <div class="card cstmcard_area">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <div class="row">
                                            <h4 style="float:left"><?php echo e(@$blood_groups_details_for_this_blood_group->blood_group_name); ?> Components Details</h4>
                                            <div class="plsbtndesign">
                                                <a href="<?php echo e(route('add-blood-components-details',['id'=> base64_encode($blood_groups_details_for_this_blood_group->id) ])); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-danger">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="text-white">ID</th>
                                                <th class="text-white">Bags</th>
                                                <th class="text-white">Lot</th>
                                                <th class="text-white">Institution</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table-responsive -->
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/Blood_Bank/blood-bank-listing.blade.php ENDPATH**/ ?>