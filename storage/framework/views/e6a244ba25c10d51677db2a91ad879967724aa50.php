
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Timeline
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add timeline ipd')): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('add-timeline-ipd', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-plus"></i> Add Timeline </a>
                        <?php endif; ?>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="col-xl-12 col-lg-12 col-md-12 mt-3">
                <div class="latest-timeline scrollbar3" id="scrollbar3">
                    <ul class="timeline mb-0">
                        <?php $__currentLoopData = $timelineDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mt-0">
                            <div class="d-flex"><span class="time-data"><?php echo e($item->title); ?></span>

                                <span class="ml-auto text-muted fs-11">

                                    <?php echo e(date('d-m-Y h:i A',strtotime( $item->date ))); ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit timeline ipd')): ?>
                                    <a href="<?php echo e(route('edit-timeline-ipd',['ipd_id' => base64_encode($ipd_details->id) ,  'id' => base64_encode($item->id)])); ?>"><i class="fa fa-edit ml-4"></i> Edit</a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete timeline ipd')): ?>
                                    <a href="<?php echo e(route('delete-timeline-ipd',['id' => base64_encode($item->id)])); ?>"><i class="fa fa-trash ml-2"></i> Delete</a>
                                    <?php endif; ?>

                                </span>
                            </div>
                            <p class="text-muted fs-12"> <?php echo e($item->description); ?></p>
                            <?php if(isset($item->attach_document) && !empty($item->attach_document)): ?>
                            <a href="<?php echo e(asset('public/assets/images/ipd-timeline')); ?>/<?php echo e(@$item->attach_document); ?>" target="_blank">
                                <span> <?php if(isset($item->attach_document)): ?> <img src="<?php echo e(asset('public/assets/images/ipd-timeline')); ?>/<?php echo e(@$item->attach_document); ?>" style="width: 30px;  height: 30px;"> <?php endif; ?></span>
                            </a>

                            <?php endif; ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/ipd/timeline.blade.php ENDPATH**/ ?>