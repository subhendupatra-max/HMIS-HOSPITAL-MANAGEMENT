
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!-- ================== message============================== -->
    <?php if(session('success')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <!-- ================== message============================== -->

    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    All Header
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

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
                                <th class="border-bottom-0">Id</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <?php $__currentLoopData = $allheader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $allheaders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e(@$allheaders->header_name); ?></td>
                                <td>
                                  <?php if(isset($allheaders->logo)): ?>  <img src="<?php echo e(asset('public/assets/images/header')); ?>/<?php echo e(@$allheaders->logo); ?>" style="width: 50px;  height: 40px;"> <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('all-header-details', base64_encode($allheaders->id))); ?>">
                                        <button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/setup/all-header/all-header-listing.blade.php ENDPATH**/ ?>