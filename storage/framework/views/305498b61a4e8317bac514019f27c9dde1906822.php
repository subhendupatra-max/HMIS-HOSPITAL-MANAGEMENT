
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Blood Issue Details
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">


                    </div>
                </div>
            </div>
        </div>
        <!-- ================================= Message ======================================== -->
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <!-- ================================= Message ======================================== -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Blood Donar')): ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Issue Date</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Refference Name</th>
                                <th scope="col">Technician</th>
                                <th scope="col">Payment Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $blood_issue_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->patient_details->first_name); ?> <?php echo e(@$item->patient_details->last_name); ?></td>
                                <td><?php echo e(@$item->blood_group_details->blood_group_name); ?> </td>
                                <td><?php echo e(@$item->issue_date); ?> </td>
                                <td><?php echo e(@$item->doctor_details->first_name); ?> <?php echo e(@$item->doctor_details->last_name); ?></td>
                                <td><?php echo e(@$item->reference_name); ?> </td>
                                <td><?php echo e(@$item->technician); ?> </td>
                                <td><?php echo e(@$item->payment_amount); ?> </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-blood-issue-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-blood-issue-details',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Blood_Bank/listing-blood-issue.blade.php ENDPATH**/ ?>