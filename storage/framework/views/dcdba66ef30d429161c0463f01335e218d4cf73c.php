
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Patient Physical Condition
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add ipd physical condition')): ?>
                        <a href="<?php echo e(route('add-physical-condition-in-ipd',['ipd_id'=> base64_encode(@$ipd_id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Physical Condition </a>
                        <?php endif; ?>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                <th class="border-bottom-0">Height</th>
                                <th class="border-bottom-0">Weight</th>
                                <th class="border-bottom-0">Pulse</th>
                                <th class="border-bottom-0">BP</th>
                                <th class="border-bottom-0">Temperature</th>
                                <th class="border-bottom-0">Respiration</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit physical condition','delete physical condition')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $PhysicalDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->height); ?></td>
                                <td><?php echo e($item->weight); ?></td>
                                <td><?php echo e($item->pulse); ?></td>
                                <td><?php echo e($item->bp); ?></td>
                                <td><?php echo e($item->temperature); ?></td>
                                <td><?php echo e($item->respiration); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit physical condition')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-physical-condition-in-ipd',['id'=> base64_encode($item->id),'ipd_id'=> base64_encode($ipd_patient_details->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete physical condition')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-physical-condition-in-ipd',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/physical-condition/physical-condition-listing.blade.php ENDPATH**/ ?>