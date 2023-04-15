
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User List</h4>
        </div>
<!-- ================================ Alert Message===================================== -->

    <?php if(session('success')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
    <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
    <?php endif; ?>

<!-- ================================ Alert Message===================================== -->
         <div class="card-body" style="padding:0px 0px 0px 0px">
            <button class="btn btn-default" onclick="card_view_contect()"><i class="fa fa-address-card"></i> Card View</button>
            <button class="btn btn-default" onclick="list_view_contect()" ><i class="fa fa-list"></i> List View</button>
            
        </div>
        <div class="card-body" id="card_view">
            <div class="row">
                <?php if(isset($all_user)): ?>
                <?php $__currentLoopData = $all_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-12 col-xl-4 col-sm-12">
                    <div class="card  mb-5">
                        <div class="card-body">
                            <div class="media mt-0">
                                <figure class="rounded-circle align-self-start mb-0">
                                    <img src="<?php echo e(asset('profile_picture')); ?>/<?php echo e($item->profile_image); ?>" class="avatar brround avatar-md mr-3">
                                </figure>
                                <div class="media-body time-title1 ">
                                    <h6 class="time-title p-0 mb-0 font-weight-semibold leading-normal"><?php echo e(@$item->name); ?></h6>
                                    <?php echo e(@$item->role_as); ?>

                <?php if($item->is_active == '1'): ?>
                  <span class="badge badge-success">Enable</span>
                <?php else: ?>
                  <span class="badge badge-secondary">Disable</span>
                <?php endif; ?>
                                </div>
                                <a href="<?php echo e(route('user-profile')); ?>/<?php echo e(base64_encode($item->id)); ?>" class="btn btn-info btn-sm d-none d-sm-block mr-2"><i class="fa fa-address-card" data-placement="top" data-toggle="tooltip" title="View Profile"></i> </a>
                                <a href="tel:<?php echo e($item->phone_no); ?>" class="btn btn-primary btn-sm d-none d-sm-block" data-placement="top" data-toggle="tooltip" title="Call"><i class="fa fa-phone"></i></a>
                              
                            </div>
                        </div>
                        <div class="card-footer text-secondary border-top">
                            Email: <a class="text-primary" href="mailto:<?php echo e(@$item->email); ?>"><?php echo e(@$item->email); ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
<div class="card-body" style="display:none" id="list_view">
    <table id="example" class="table table-borderless text-nowrap key-buttons">
        <thead>
            <tr>
                <th scope="col">Sl No.</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Designation</th>
                <th scope="col">Status</th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user profile || user active deactive || user edit || user delete')): ?>
                 <th scope="col"> Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($all_user)): ?>
            <?php $__currentLoopData = $all_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($loop->iteration); ?></th>
                <td><?php echo e(@$item->name); ?></td>
                <td><?php echo e(@$item->email); ?></td>
                <td><?php echo e(@$item->role_as); ?></td>
                <td>
                <?php if($item->is_active == '1'): ?>
                  <span class="badge badge-success">Enable</span>
                <?php else: ?>
                  <span class="badge badge-secondary">Disable</span>
                <?php endif; ?>

                </td>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user profile || user active deactive || user edit || user delete')): ?>
                <td>
                    <div class="card-options">
                        <a href="#"  class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user profile')): ?>  
                            <a class="dropdown-item" href="<?php echo e(route('user-profile')); ?>/<?php echo e(base64_encode($item->id)); ?>"><i class="fa fa-eye"></i>  View</a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user active deactive')): ?>
                        <?php if($item->id != Auth::id()): ?>
                            <a class="dropdown-item" href="<?php echo e(route('user-enable-disable',base64_encode($item->id))); ?>"><i class="fa fa-user-circle-o"></i> Enable/Disable</a>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('user edit') || $item->id == Auth::id()): ?>
                            <a class="dropdown-item" href="<?php echo e(route('user-edit',base64_encode($item->id))); ?>"><i class="fa fa-pencil"></i> Edit</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user delete')): ?>
                        <?php if($item->id != Auth::id()): ?>
                            <a class="dropdown-item" href="<?php echo e(route('user-delete',base64_encode($item->id))); ?>"><i class="fa fa-trash"></i>  Delete</a>
                        <?php endif; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </td>
                <?php endif; ?> 
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</div>
</div>

<script type="text/javascript">
    function card_view_contect()
    {
        $('#list_view').attr('style','display:none');
        $('#card_view').removeAttr('style',true);
    }

    function list_view_contect()
    {
        $('#card_view').attr('style','display:none');
        $('#list_view').removeAttr('style',true);
    }

</script>

<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/Users/user-list.blade.php ENDPATH**/ ?>