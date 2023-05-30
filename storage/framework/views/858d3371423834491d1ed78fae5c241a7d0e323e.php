
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Ambulance List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add ambulance')): ?>
                        <a href="<?php echo e(route('add-ambulance-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-ambulance"></i> Add Ambulance </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Vehicle Number</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Vehicle Model</th>
                                <th class="border-bottom-0">Year Made</th>
                                <th class="border-bottom-0">Driver Name</th>
                                <th class="border-bottom-0">Driver License</th>
                                <th class="border-bottom-0">Vehicle Type</th>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit ambulance ','delete ambulance ')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ambulance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->vehicle_number); ?> </td>
                                <td><?php echo $item->status == 'Unavailable' ? '<span class="badge badge-danger">Unavailable</span>' : '<span class="badge badge-success">Available</span>'; ?> </td>
                                <td><?php echo e(@$item->vehicle_model); ?> </td>
                                <td><?php echo e(@$item->year_made); ?> </td>
                                <td><?php echo e(@$item->driver_name); ?> </td>
                                <td><?php echo e(@$item->driver_license); ?> </td>
                                <td><?php echo e(@$item->vehicle_type); ?> </td>

                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit ambulance')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-ambulance-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete ambulance')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-ambulance-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/ambulance/ambulance/ambulance-lisitng.blade.php ENDPATH**/ ?>