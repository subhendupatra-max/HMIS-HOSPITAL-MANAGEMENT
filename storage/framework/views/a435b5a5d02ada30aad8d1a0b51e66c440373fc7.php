
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold"> Blood And Components </h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('ipd.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="options px-5 pt-2  border-bottom pb-1">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h5>
                            Blood Issue Details
                        </h5>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-white">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th class="text-white">Blood Group</th>
                                        <th class="text-white">Date</th>
                                        <th class="text-white">Bag</th>
                                        <th class="text-white">Blood Quentity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = @$blood_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><?php echo e(@$item->blood_group_details->blood_group_name); ?></td>
                                        <td> <?php echo e(@$item->issue_date); ?></td>
                                        <td> <?php echo e(@$item->bag); ?></td>
                                        <td> <?php echo e(@$item->blood_qty); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
            <div class="options px-5 pt-2  border-bottom pb-1">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h5>
                            Blood Components Issue Details
                        </h5>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-white">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th class="text-white">Blood Group</th>
                                        <th class="text-white">Date</th>
                                        <th class="text-white">Bag</th>
                                        <th class="text-white">Blood Components Quentity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = @$components_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><?php echo e(@$item->blood_group_details->blood_group_name); ?></td>
                                        <td> <?php echo e(@$item->issue_date); ?></td>
                                        <td> <?php echo e(@$item->bag); ?></td>
                                        <td> <?php echo e(@$item->components_qty); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/ipd/blood-bank/blood-details.blade.php ENDPATH**/ ?>