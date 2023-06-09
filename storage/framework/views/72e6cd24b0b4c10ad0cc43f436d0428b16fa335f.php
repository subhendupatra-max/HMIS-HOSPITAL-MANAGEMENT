
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                   E-Prescirption
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ipd prescription')): ?>
                        <a href="<?php echo e(route('add-prescription-in-ipd',['id'=> base64_encode($ipd_id)])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-prescription"></i> Create Prescription </a>
                        <?php endif; ?>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('Ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('Ipd.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Medicine Name</th>
                                <th class="border-bottom-0">Medicine Catagory</th>
                                <th class="border-bottom-0">Dose</th>
                                <th class="border-bottom-0">Interval</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit ipd payment','delete ipd payment')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ipdPrescription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(date('d-m-Y h:i a',strtotime(@$item->prescription_date))); ?></td>
                                <td><?php echo e(@$item->eprescription_details->medicine_details->medicine_name); ?></td>
                                <td><?php echo e(@$item->eprescription_details->medicine_details->catagory_name->medicine_catagory_name); ?></td>
                                <td><?php echo e(@$item->eprescription_details->dose); ?></td>
                                <td><?php echo e(@$item->eprescription_details->interval); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-payment-in-ipd')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('prescription-view-in-ipd',['id'=> base64_encode($item->id),'ipd_id'=> base64_encode($ipd_details->id)])); ?>"><i class="fa fa-edit"></i> View</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-prescription-in-ipd')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-prescription-in-ipd',['id'=> base64_encode($item->id),'ipd_id'=> base64_encode($ipd_details->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-payment-in-ipd')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-prescription-in-ipd',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print-prescription-in-ipd')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('print-prescription-in-ipd',['id'=> base64_encode($item->id), 'ipd_id'=> base64_encode($ipd_details->id)])); ?>"><i class="fa fa-trash"></i> Print</a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo $ipdPrescription->links(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Ipd/prescription/prescription-listing.blade.php ENDPATH**/ ?>