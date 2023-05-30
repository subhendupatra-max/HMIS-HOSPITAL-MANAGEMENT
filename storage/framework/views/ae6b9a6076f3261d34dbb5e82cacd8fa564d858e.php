
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Pathology Test
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add radiology test')): ?>
                        <a href="<?php echo e(route('add-pathology-test')); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Add Pathology Test</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view pathology group test')): ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Test Name</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($all_test)): ?>
                            <?php $__currentLoopData = $all_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><a class="textlink" href=""><?php echo e($value->test_name); ?>(<?php echo e($value->short_name); ?>)</a></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo e(route('view-pathology-test-details',['id'=> base64_encode($value->id)])); ?>"><i class="fa fa-eye"></i> View</a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit pathology test')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-pathology-test-details',['id'=> base64_encode($value->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete pathology test')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-pathology-test-details',['id'=> base64_encode($value->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pathology/test/list.blade.php ENDPATH**/ ?>