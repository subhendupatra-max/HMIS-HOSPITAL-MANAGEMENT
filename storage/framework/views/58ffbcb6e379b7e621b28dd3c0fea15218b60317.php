
<?php $__env->startSection('content'); ?>


<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Donor Details
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">

                        



                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Blood Donar')): ?>
                        <a href="<?php echo e(route('add-blood-donor')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Donor Details</a>
                        <?php endif; ?>
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
                                <th scope="col">Donor Name</th>
                                <th scope="col">Date Of Birth</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Contact No</th>
                                <th scope="col">Father Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $bloodDonorDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->donor_name); ?> </td>
                                <td><?php echo e(@$item->date_of_birth); ?> </td>
                                <td><?php echo e(@$item->blood_group); ?> </td>
                                <td><?php echo e(@$item->gender); ?> </td>
                                <td><?php echo e(@$item->father_name); ?> </td>
                                <td><?php echo e(@$item->ph_no); ?> </td>
                                <td><?php echo e(@$item->address); ?> </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine requisition')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-blood-donor',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine requisition')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-blood-donor',['id'=> base64_encode($item->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Blood_bank/blood-donor/blood-donor-listing.blade.php ENDPATH**/ ?>