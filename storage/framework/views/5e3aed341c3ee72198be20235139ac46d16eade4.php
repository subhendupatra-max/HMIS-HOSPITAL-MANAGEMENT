
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->

    <div class="card">
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Job Card List
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Job Add')): ?>
                <div class="col-md-6 text-right">
                    <div>
                        <a href="<?php echo e(route('addJob')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Job Card</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
        ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Job List')): ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Job Card No.</th>
                                <th scope="col">Job Status</th>
                                <th scope="col">Vehicle Reg. No.</th>
                                <th scope="col">Reference No.</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Mechanic & helper</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Item Issue For a job')): ?>
                                <th scope="col">Issue Item</th>
                                <?php endif; ?>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($job_card)): ?>
                            <?php $__currentLoopData = $job_card; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <th scope="row"><a href="<?php echo e(route('view_job',$item->job_id)); ?>" class="text-info"><?php echo e(@$item->prefix); ?><?php echo e(@$item->job_id); ?></a></th>
                                <td>

                                    <?php if(@$item->job_status == 'not_started'): ?>
                                    <button type="button" class="btn btn-warning btn-sm">Not Started</button>
                                        
                                    <?php elseif(@$item->job_status == 'job_started'): ?>
                                    <button type="button" class="btn  btn-info btn-sm">Job Started</button>
                                        
                                    <?php else: ?>
                                    <button type="button" class="btn btn-secondary btn-sm">Job Completed</button>
                                       
                                    <?php endif; ?>

                                </td>
                                <td><?php echo e(@$item->registration_no); ?></td>
                                <td><?php echo e(@$item->reference_no); ?></td>
                                <td><?php echo e(@$item->driver_name); ?></td>
                                <td><?php echo e(@$item->mechanic_helper_name); ?></td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Item Issue For a job')): ?>
                                <td><a href="<?php echo e(route('issue_item',$item->job_id)); ?>" class="btn btn-primary btn-sm">Issue Item</a></td>
                                <?php endif; ?>
                                <td>
                                    <div class="text-wrap">
                                        <div>
                                            <div class="btn-list">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                       <i class="fa fa-caret-down"></i> Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Job Details View')): ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('view_job',$item->job_id)); ?>"><i class="fa fa-eye"></i> View</a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Job edit')): ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('editJob',$item->job_id)); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Job delete')): ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('deleteJobAction',$item->job_id)); ?>"><i class="fa fa-trash"></i> Delete</a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Job Print')): ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('job_card_pdf',$item->job_id)); ?>"><i class="fa fa-print"></i> Print</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Jquery js-->
<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $(".timer").click(function(e) {
            e.preventDefault();
            var descid = $(this).data("descid");
            var jobcardid = $(this).data("jobcardid");

            $.ajax({
                type: "POST",
                url: "<?php echo e(route('StartTimerAction')); ?>",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "descid": descid,
                    "jobcardid": jobcardid,
                },
                success: function(response) {
                    swal('Timer Started Successfully.');
                    window.setTimeout(function() {
                        location.reload(true)
                    }, 500)
                }
            });
        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/job/job-list.blade.php ENDPATH**/ ?>