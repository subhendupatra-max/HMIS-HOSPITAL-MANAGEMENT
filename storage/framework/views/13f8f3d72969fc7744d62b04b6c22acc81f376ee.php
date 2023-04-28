
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Medication
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                        <a href="<?php echo e(route('add-medicaiton-dose',['ipd_id' => base64_encode($ipd_details->id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Medication</a>
                        <?php endif; ?>

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body ">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sl. No</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Time</th>
                                    <th class="border-bottom-0">Medicine Catagory</th>
                                    <th class="border-bottom-0">Medicine Name</th>
                                    <th class="border-bottom-0">Dosage</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $medication_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border-bottom-0"><?php echo e($loop->iteration); ?></td>
                                    <td class="border-bottom-0"> <?php echo e($item->date); ?> </td>
                                    <td class="border-bottom-0"> <?php echo e($item->time); ?> </td>
                                    <td class="border-bottom-0"><?php echo e(@$item->medicine_catagory_name->medicine_catagory_name); ?></td>
                                    <td class="border-bottom-0"><?php echo e(@$item->all_medicine_name->medicine_name); ?></td>
                                    <td class="border-bottom-0"><?php echo e(@$item->dosage_name->dose); ?></td>

                                    <td class="border-bottom-0">
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit operation theatre')): ?>
                                                <a class="dropdown-item">
                                                    <i class="fa fa-edit"></i> Edit</a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete operation theatre')): ?>
                                                <a class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
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
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/show-medication-dose.blade.php ENDPATH**/ ?>