
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Postal Receive
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add postal receive')): ?>
                        <a href="<?php echo e(route('add-postal-receive-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Receive </a>
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
                                <th class="border-bottom-0">From Title</th>
                                <th class="border-bottom-0">Reference No</th>
                                <th class="border-bottom-0">To Title</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Date</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit complain','delete complain')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $receive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->from_title); ?> </td>
                                <td><?php echo e(@$item->reference_no); ?> </td>
                                <td><?php echo e(@$item->to_title); ?> </td>
                                <td><?php echo e(@$item->address); ?> </td>
                                <td><?php echo e(@$item->date); ?> </td>
                            <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit postal receive')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-postal-receive-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete postal receive')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-postal-receive-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/front-office/postal/receive-postal-listing.blade.php ENDPATH**/ ?>