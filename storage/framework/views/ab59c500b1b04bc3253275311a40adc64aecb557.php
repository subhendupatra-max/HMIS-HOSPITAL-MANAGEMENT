
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
        <div class="card-header">
            <div class="card-title">Job Work List</div>

            <div class="card-body">
        
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Job Description</th> 
                                <th scope="col">Starting Time</th>
                                <th scope="col">Ending Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($job_list)): ?>
                            <?php $__currentLoopData = $job_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="d-none">
                                        <?php echo e($count = DB::table('job_tracks')->where('job_id','=',$item->job_id)->where('job_desc_id','=',$item->id)->count()); ?>

                                    
                                        <!-- END TIME -->
                                        <?php echo e($start = DB::table('job_tracks')->select('job_time')->where('job_id','=',$item->job_id)->where('job_desc_id','=',$item->id)->where('status','=','S')->get()); ?>

                                        <!-- STARTIND TIME -->
                                        <?php echo e($end = DB::table('job_tracks')->select('job_time')->where('job_id','=',$item->job_id)->where('job_desc_id','=',$item->id)->where('status','=','E')->get()); ?>

                            </span>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->desc); ?></td>
                                <td><?php echo e(@$start[0]->job_time); ?></td>
                                <td><?php echo e(@$end[0]->job_time); ?></td>
                                <td></td>
                                <td>
                                    
                                    <?php if($count == 0): ?>
                                    
                                    <button class="btn btn-success timer" id="p<?php echo e(@$item->job_id); ?>" data-toggle="tooltip-primary" data-placement="top" title="Start Time" data-descid="<?php echo e(@$item->id); ?>" data-jobcardid="<?php echo e(@$item->job_id); ?>"><i class="fa fa-clock-o"></i></button>
                                    <?php endif; ?>
                                    <?php if($count == 1): ?>
                                    <button class="btn btn-danger timer" id="p<?php echo e(@$item->job_id); ?>" data-toggle="tooltip-primary" data-placement="top" title="End Task" data-descid="<?php echo e(@$item->id); ?>" data-jobcardid="<?php echo e(@$item->job_id); ?>"><i class="fa fa-clock-o"></i></button>
                                    <?php endif; ?>
                                    <?php if($count == 2): ?>
                                    <button class="btn btn-warning " data-toggle="tooltip-primary" data-placement="top" title="Task has ended">
                                        <i class="fa fa-warning text-danger"></i>
                                    </button>
                                    <?php endif; ?>
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
                    swal(response);
                    window.setTimeout(function() {
                        location.reload(true)
                    }, 500)
                }
            });
        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/job/job-desc-list.blade.php ENDPATH**/ ?>