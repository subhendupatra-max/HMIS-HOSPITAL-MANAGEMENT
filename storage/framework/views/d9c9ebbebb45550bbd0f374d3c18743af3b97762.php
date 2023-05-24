
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Oxygen Monitoring
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="d-block" style="border-bottom: 1px">

                        <div class="col-md-12 ">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap" id="example">
                                    <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Duration (In Seconds)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $seconds = 0;
                                         $total_duration = 0;
                                         ?>
                                        <?php if(@$oxygen_monitering[0]->start_time != null): ?>
                                        <?php $__currentLoopData = $oxygen_monitering; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                             $seconds += $value->duration;
                                             $total_duration = floor($seconds / 60);
                                             ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td> <?php echo e(date('d-m-Y h:i a',strtotime($value->start_time ))); ?></td>
                                            <td>
                                                <?php if($value->end_time == null): ?>
                                                <form action="<?php echo e(route('end-oxygen-in-ipd')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="datetime-local" name="end_time" required />
                                                            </div>
                                                            <input type="hidden" name="id" value="<?php echo e($value->id); ?>" />
                                                            <input type="hidden" name="ipd_id" value="<?php echo e($ipdId); ?>" />
                                                            <input type="hidden" name="start_time"
                                                                value="<?php echo e($value->start_time); ?>" />
                                                            <div class="col-md-4">
                                                                <button class="btn btn-primary  btn-sm"
                                                                    type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php else: ?>
                                                <?php if(@$value->end_time != null): ?>
                                                <?php echo e(@date('d-m-Y h:i a',strtotime($value->end_time ))); ?>

                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(@$value->duration); ?></td>

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php if(@$oxygen_monitering_last->end_time != null ||
                                        !isset($oxygen_monitering_last)): ?>
                                        <tr>
                                            <td>New Start</td>
                                            <td>
                                                <form action="<?php echo e(route('start-oxygen-in-ipd')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="datetime-local" name="start_time"
                                                                    required />
                                                            </div>
                                                            <input type="hidden" name="ipd_id" value="<?php echo e($ipdId); ?>" />

                                                            <div class="col-md-4">
                                                                <button class="btn btn-primary  btn-sm"
                                                                    type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>End Time</td>
                                            <td>Duration (In Seconds)</td>

                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <span style="color:blue;font-weight:700;font-size:15px;margin:19px 17px 14px 33px">Total
                                    : <?php echo e(@$total_duration.' min'); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Ipd/add-oxygen-monitoring.blade.php ENDPATH**/ ?>