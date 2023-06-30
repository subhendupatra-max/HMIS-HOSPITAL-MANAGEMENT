
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Slots List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add slots')): ?>
                        <a href="<?php echo e(route('add-slots-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-clock"></i> Add New Slots </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Doctor</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Slot</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit slots','delete slots')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->fetch_doctor_name->first_name); ?> <?php echo e(@$item->fetch_doctor_name->last_name); ?></td>
                                <td><?php echo e(date('d-m-Y',strtotime($item->date))); ?></td>
                                <td>
                                    <?php if($item->status == 'active'): ?>
                                    <a class="badge badge-success" href="<?php echo e(route('doctor-slot-status-change',['status'=>'deactive','slot_id'=>$item->id])); ?>">Activeted</a>
                                    <?php else: ?>
                                    <a class="badge badge-danger" href="<?php echo e(route('doctor-slot-status-change',['status'=>'active','slot_id'=>$item->id])); ?>">Deactiveted</a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(date('h:i A',strtotime($item->from_time))); ?> - 
                                <?php echo e(date('h:i A',strtotime($item->to_time))); ?></td>
                          
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit slots')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-slots-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete slots')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-slots-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/appointment/slots/slots-listing.blade.php ENDPATH**/ ?>