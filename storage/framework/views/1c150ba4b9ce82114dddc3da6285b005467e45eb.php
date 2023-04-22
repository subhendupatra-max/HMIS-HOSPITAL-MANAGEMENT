
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Ambulance Call List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('add-ambulance-call-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Ambulance Call </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('ambulance-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Ambulance List </a>
                        <?php endif; ?>
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
                                <th class="border-bottom-0">Vehicle Model</th>
                                <th class="border-bottom-0">Driver Name</th>
                                <th class="border-bottom-0">Charges Catagory </th>
                                <th class="border-bottom-0">Charges Sub Catagory</th>
                         
                                <th class="border-bottom-0">Total Amount</th>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit ambulance call','delete ambulance call')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ambulanceCall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->vehicle_model); ?> </td>
                                <td><?php echo e(@$item->driver_name); ?> </td>
                                <td><?php echo e(@$item->catagory->charges_catagories_name); ?> </td>
                                <td><?php echo e(@$item->subCatagory->charges_sub_catagories_name); ?> </td>
                                <td><?php echo e(@$item->total_amount); ?> </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit ambulance call')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-ambulance-call-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete ambulance call')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-ambulance-call-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HMIS-HOSPITAL-MANAGEMENT\resources\views/ambulance/ambulance-call/ambulance-call-listing.blade.php ENDPATH**/ ?>