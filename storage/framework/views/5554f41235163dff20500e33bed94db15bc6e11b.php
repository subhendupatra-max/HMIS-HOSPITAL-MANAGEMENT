<?php $__env->startSection('content'); ?>

<!--div-->
<div class="card">
    <div class="card-header">
        <div class="card-title">User List</div>
    </div>
    <div class="card-body">
        <div class="">
            <div class="table-responsive">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">Sl. No</th>
                            <th class="border-bottom-0">Name</th>
                            <th class="border-bottom-0">Email</th>
                            <th class="border-bottom-0">Asign Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->email); ?></td>
                                <td> 
                                    <a href="<?php echo e(route('PermissionAsignToUser',['role'=>base64_encode($item->id)])); ?>" class="btn btn-info"  data-bs-toggle="tooltip" data-bs-placement="top" title="Asign Permission To This User"><i class="fa fa-link fa-spin"></i></a> 
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/div-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supratim/php_projects/example-app/resources/views/permission/userPermissionAsignList.blade.php ENDPATH**/ ?>