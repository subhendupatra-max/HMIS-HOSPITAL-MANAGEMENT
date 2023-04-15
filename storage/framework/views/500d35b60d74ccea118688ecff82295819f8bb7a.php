

<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Vehicle Registration List
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vehicle add')): ?>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a href="<?php echo e(route('vehicleAdd')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vehicle</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Vehicle No</th>
                                <th>Vehicle Model</th>
                                <th>Registration Certificate</th>
                                <th>Insurance</th>
                                <th>Registration No</th>
                                <th>Pollution Under Control</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($all_data)): ?>
                            <?php $__currentLoopData = $all_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(route('vehicleDetails',$list->id)); ?>" class="text text-primary"><?php echo e(@$list->prefix); ?><?php echo e(@$list->id); ?></a></td>
                                <td><?php echo e(@$list->vehicle_model); ?></td>
                                <td>
                                    <a href="<?php echo e(url('public/website/vehicle/'.@$list->registration_certificate_details)); ?>" target="_blank" class="text text-primary">View File...</a>
                                </td>
                                <td>
                                    <a href="<?php echo e(url('public/website/vehicle/'.@$list->insurance_details)); ?>" target="_blank" class="text text-primary">View File...</a>
                                </td>
                                <td><?php echo e(@$list->registration_no); ?></td>
                                <?php if(@$list->REMAINING_DAY < 1): ?> <td>

                                    <span class="btn btn-danger btn-sm" data-toggle="tooltip-primary" data-placement="top" title="Expired <?php echo e(str_replace('-','',$list->REMAINING_DAY)); ?> Days Ago"><i class="fa fa-lock"></i> <?php echo e(str_replace('-','',$list->REMAINING_DAY)); ?> Days Ago</span>
                                    </button>
                                    </td>
                                    <?php elseif(@$list->REMAINING_DAY == 0): ?>

                                    <td>
                                        <span class="btn btn-info btn-sm" data-toggle="tooltip-primary" data-placement="top" title="Expires Today"><i class="fa fa-trophy"></i> Expires Today</span>
                                    </td>

                                    <?php else: ?>
                                    <td>
                                        <span class="btn btn-success btn-sm" data-toggle="tooltip-primary" data-placement="top" title="<?php echo e($list->REMAINING_DAY); ?> Days Left"><i class="fa fa-trophy"></i> <?php echo e($list->REMAINING_DAY); ?> Days Left</span>
                                    </td>
                                    <?php endif; ?>
                                   
                                    <td>
                                    <td>
                                        <div class="text-wrap">
                                            <div>
                                                <div class="btn-list">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="<?php echo e(route('vehicleDetails',$list->id)); ?>"><i class="fa fa-eye"></i> View</a>
                                                            <a class="dropdown-item" href="<?php echo e(route('vehicleEdit',$list->id)); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                            <a class="dropdown-item" href="<?php echo e(route('vehicleDelete',$list->id)); ?>"><i class="fa fa-trash"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    </td>
                                    

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/vehicle/vehicle-reg-list.blade.php ENDPATH**/ ?>