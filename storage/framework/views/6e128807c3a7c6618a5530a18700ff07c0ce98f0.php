
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
                   Job Details
                </div>
 
                <div class="col-md-6 text-right">
                    <div class="d-block">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Item Issue For a job')): ?>
                        <td><a href="<?php echo e(route('issue_item',$job_description->job_id)); ?>" class="btn btn-primary">Issue Item</a></td>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Item Issue with job print')): ?>
                        <a href="<?php echo e(route('job_with_issue_item',$job_description->job_id)); ?>" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                 <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-4">
                        <span class="requisition_header">Job Card No : </span><span class="requisition_text"><?php echo e(@$job_description->prefix); ?><?php echo e(@$job_description->job_id); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Vehicle Registration No: </span><span class="requisition_text"><a href="<?php echo e(route('vehicleDetails',$job_description->vehical_id)); ?>" data-placement="top" data-toggle="tooltip" title="Show Vehical Details" style="color:blue"><?php echo e(@$job_description->registration_no); ?> </a></span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Gate In : </span><span class="requisition_text"><?php echo e(date('d-m-Y h:i'),strtotime($job_description->job_date)); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Workshop Name: </span><span class="requisition_text"><?php echo e(@$job_description->name); ?></span>
                    </div>
                    
                    <div class="col-md-4">
                        <span class="requisition_header">Reference No: </span><span class="requisition_text"><?php echo e(@$job_description->reference_no); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Driver Name: </span><span class="requisition_text"><?php echo e(@$job_description->driver_name); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Mechnaic & Helper Name: </span><span class="requisition_text"><?php echo e(@$job_description->mechanic_helper_name); ?></span>
                    </div>
                    <?php if($job_description->job_started != null): ?>
                    <div class="col-md-4">
                        <span class="requisition_header">Job Started: </span><span class="requisition_text"><?php echo e(@$job_description->job_started); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($job_description->job_completed != null): ?>
                    <div class="col-md-4">
                        <span class="requisition_header">Job Completed: </span><span class="requisition_text"><?php echo e(@$job_description->job_completed); ?></span>
                    </div>
                     <?php endif; ?>
                    </div>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('job status change')): ?>
                    <div class="row">
                    <div class="col-md-4">
                        <form method="POST" action="<?php echo e(route('job-status-change')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="job_id" value="<?php echo e($job_description->job_id); ?>">
                        <label class="requisition_header">Job Status<span class="required">*</span></label>

                        <select class="form-control" name="job_status" >
                            <option value="not_started" <?php if(@$job_description->job_status == 'not_started'){ echo"Selected";} ?>>Not Started</option>
                            <option value="job_started" <?php if(@$job_description->job_status == 'job_started'){ echo"Selected";} ?>>Job Started</option>
                            <option value="job_completed" <?php if(@$job_description->job_status == 'job_completed'){ echo"Selected";} ?> >Job Completed</option>
                        </select>
                         <button class="btn btn-success mt-4" type="submit">Job Status</button>
                             </form> 
                    </div>
                    </div>
                <?php endif; ?>



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
<?php if(@$item->item_name): ?>
                <hr>

                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>UOM</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount(Rs)</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php $__currentLoopData = $issue_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                             
                                <td><?php echo e(@$item->item_name); ?><br>(<?php echo e(@$item->item_description); ?>)(Brand : <?php echo e(@$item->brand_name); ?>)(Manufacturer : <?php echo e(@$item->manufacturar_name); ?>)</td>
                                <td> <?php echo e(@$item->unit_name); ?></td>
                                <td><?php echo e(@$item->quantity); ?></td>
                                <td><?php echo e(@$item->rate); ?></td>
                                <td><?php echo e(@$item->amount); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div><!-- bd -->
  <?php endif; ?>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/job/job-desc-list.blade.php ENDPATH**/ ?>