
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Visitor List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add visit')): ?>
                        <a href="<?php echo e(route('add-visit-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Visitor </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('call log')): ?>
                        <a href="<?php echo e(route('all-phone-call-log-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Call Log </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complain')): ?>
                        <a href="<?php echo e(route('all-complain-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Complain </a>
                        <?php endif; ?>

                        <div class="card-options carddrpdwn_area">
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                                 Postal
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('postal receive')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('all-postal-receive-details')); ?>"><i class="fa fa-users"></i> Receive</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('postal dispatch')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('all-postal-dispatch-details')); ?>"><i class="fa fa-file-alt"></i>Dispatch</a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Purpose</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Year Made</th>
                                <th class="border-bottom-0">Driver Name</th>
                                <th class="border-bottom-0">Driver License</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit visit ','delete visit ')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $visit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->purpose); ?> </td>
                                <td><?php echo e(@$item->name); ?> </td>
                                <td><?php echo e(@$item->phone); ?> </td>
                                <td><?php echo e(@$item->in_time); ?> </td>
                                <td><?php echo e(@$item->out_time); ?> </td>

                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit visit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-visit-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete visit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-visit-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/front-office/visit/visit-details-listing.blade.php ENDPATH**/ ?>