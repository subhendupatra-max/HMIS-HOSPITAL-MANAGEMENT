
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Work List </h4>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add new house keeping work')): ?>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('add-new-house-keeping-work')); ?>"><i class="fa fa-plus"></i> Add </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ================================ Alert Message===================================== -->
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap" id="example">
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                            <th class="text-white">Work Id</th>
                            <th class="text-white">Date</th>
                            <th class="text-white">Work Details</th>
                            <th class="text-white">House Keeper Name</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$house_keeping_work[0]->id != null): ?>
                        <?php $__currentLoopData = $house_keeping_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $house_keeper = DB::table('house_keeping_users')->join('users','users.id','=','house_keeping_users.user_id')->where('house_keeping_id',$value->id)->get(); ?>
                        <tr>
                            <td><?php echo e(@$value->id); ?></td>
                            <td>
                                <?php if(isset($value->date)): ?>
                                <?php echo e(date('d-m-Y h:i A',strtotime($value->date))); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(@$value->working_details); ?>

                            </td>
                            <td>
                                <?php if(auth()->user()->can('work status change')): ?> 
                                    <?php if(@$house_keeper[0]->id != null): ?>
                                    <?php $__currentLoopData = $house_keeper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $house_keep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e(@$house_keep->first_name); ?> <?php echo e(@$house_keep->last_name); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    <?php else: ?>
                                    <span class="badge badge-success" >Assign House Keeper</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(@$house_keeper[0]->id != null): ?>
                                    <?php $__currentLoopData = $house_keeper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $house_keep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e(@$house_keep->first_name); ?> <?php echo e(@$house_keep->last_name); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    <?php else: ?>
                                    <span class="badge badge-success">Assign House Keeper</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(auth()->user()->can('work status change')): ?>    

                                    <?php if($value->status == 'incomplete'): ?>
                                    <a href="<?php echo e(route('change-status-houseing-allowence',
                                    ['status'=>'complete','work_id'=>$value->id ])); ?>"><span class="badge badge-danger"><?php echo e(@$value->status); ?></span></a>
                                    <?php else: ?>
                                    <a href="<?php echo e(route('change-status-houseing-allowence',
                                    ['status'=>'incomplete','work_id'=>$value->id ])); ?>"><span class="badge badge-info"><?php echo e(@$value->status); ?></span></a>
                                    <?php endif; ?>

                                <?php else: ?>

                                    <?php if($value->status == 'incomplete'): ?>
                                    <a href="#"><span class="badge badge-danger"><?php echo e(@$value->status); ?></span></a>
                                    <?php else: ?>
                                    <a href="#"><span class="badge badge-info"><?php echo e(@$value->status); ?></span></a>
                                    <?php endif; ?>

                                <?php endif; ?>

                            
                            </td>
                            <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit work details')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('edit-new-house-keeping-work',base64_encode($value->id))); ?>">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete work details')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('delete-new-house-keeping-work',base64_encode($value->id))); ?>"><i class="fa fa-trash"></i> Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">
                                <img src="<?php echo e(asset('public/no_found_data/no_data.png')); ?>" alt="loader" width="400px"
                                height="160px">
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
        
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add House Keeper</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div> 
        <form action="<?php echo e(route('assign-house-keeper')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="work_id" id="work_id" />
                <div class="form-group col-md-12">
                    <select name="house_keeper[]" multiple="multiple"
                        class="form-control multi-select select2-show-search">
                        <option value="">Select House Keeper ....</option>
                        <?php if($user_list): ?>

                            <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->first_name); ?>

                                    <?php echo e($value->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-indigo" type="submit">Save</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo11211">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add House Keeper</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div> 
        <form action="<?php echo e(route('assign-house-keeper')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="work_id" id="work_id" />
                <div class="form-group col-md-12">
                    <select name="house_keeper[]" multiple="multiple"
                        class="form-control multi-select select2-show-search">
                        <option value="">Select House Keeper ....</option>
                        <?php if($user_list): ?>

                            <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->first_name); ?>

                                    <?php echo e($value->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-indigo" type="submit">Save</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>

    function assign_house_keeper(work_id)
    {
        $('#work_id').val(work_id);                                                                 
        $('#modaldemo1').modal('show');
    }
</script>
<script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/house-keeping/work-list.blade.php ENDPATH**/ ?>