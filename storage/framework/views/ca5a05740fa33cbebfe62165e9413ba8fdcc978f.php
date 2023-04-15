
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        Pathology Test List
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add pathology test')): ?>
                                <a href="<?php echo e(route('add-pathology-test-details')); ?>" class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"></i> Add Pathology Test </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>
            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view pathology test list')): ?>
                <div class="card-body">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl. No</th>
                                        <th class="border-bottom-0">Test Name</th>
                                        <th class="border-bottom-0">Test Type</th>
                                        <th class="border-bottom-0">Pathology Category</th>
                                        <th class="border-bottom-0">Charges Amount</th>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit pathology test ', 'delete pathology test')): ?>
                                            <th>Action</th>
                                        <?php endif; ?>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $pathologyTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><a class="textlink" href="<?php echo e(route('view-pathology-test-details', ['id' => $item->id])); ?>"><?php echo e($item->test_name); ?></a></td>
                                            <td><?php echo e($item->test_type); ?></td>
                                            <td><?php echo e($item->pathology_catagory->catagory_name); ?></td>
                                            <td><?php echo e($item->total_amount); ?></td>
                                            <td>
                                                <div class="card-options">
                                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">Action <i
                                                            class="fa fa-caret-down"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?php echo e(route('view-pathology-test-details', ['id' => $item->id])); ?>"><i
                                                                class="fa fa-eye"></i> View</a>


                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit pathology test')): ?>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('edit-pathology-test-details', ['id' => $item->id])); ?>"><i
                                                                    class="fa fa-edit"></i> Edit</a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete pathology test')): ?>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('delete-pathology-test-details', ['id' => $item->id])); ?>"><i
                                                                    class="fa fa-trash"></i> Delete</a>
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
            <?php endif; ?>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/pathology/test-pathology/pathology-test-listing.blade.php ENDPATH**/ ?>