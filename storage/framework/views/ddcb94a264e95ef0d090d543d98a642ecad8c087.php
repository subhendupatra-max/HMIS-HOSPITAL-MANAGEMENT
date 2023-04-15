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
                        <a href="<?php echo e(route('add-pathology-test-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i>Add Pathology Test </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Parameter Name</th>
                                <th class="border-bottom-0">Test Value</th>

                            </tr>

                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $pathologyparameterDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->parameter_name); ?><?php echo e($item->formula); ?></td>
                                <td>
                                    <input type="text" name="<?php echo e($item->parameter_name); ?>" id="<?php echo e($item->parameter_name); ?>" />
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('resources\views\pathology\test-formula\test_formula.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/pathology/add-pathology-report.blade.php ENDPATH**/ ?>