

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <div class="card-title">Asign Permission To : <?php echo e($userInfo->name); ?> </div>
    </div>
    <div class="card-body">
         <ul class="list-group">
            <?php $__currentLoopData = $all_permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item">
                <?php echo e($item->name); ?>

                <div class="custom-control custom-switch pull-right ">
                    <input type="checkbox" class="permission custom-control-input form-control-lg" id="customSwitch1_<?php echo e($item->id); ?>" name="perm" data-id="<?php echo e($item->id); ?>" data-user="<?php echo e($userInfo->id); ?>" <?php if($PermissionOfUser->contains($item->id)): ?> checked <?php endif; ?>>
                    <label class="custom-control-label" for="customSwitch1_<?php echo e($item->id); ?>"></label>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </ul>
    </div>
</div>

<?php $__env->stopSection(); ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- Jquery js-->
   <script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
<script>
    $(document).ready(function () {

        $(".permission").click(function (e) { 
            e.preventDefault();
            let userData = $(this).data('user');
            let permission = $(this).data('id');

            if (userData != "" && permission !="") {
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('PermissionAsignToUserAction')); ?>",
                    data: {
                            "_token":"<?php echo e(csrf_token()); ?>",
                            'Id': userData,
                            'permission': permission,            
                        },
                    success: function (response) {
                        if(response === "1"){
                            swal("Good job!", "Permission Asigned ", "success");
                            window.location.reload(2000);
                        }else{
                            swal("Good job!", "Permission Revoked ", "success");
                            window.location.reload(2000);
                        }
                    }
                });

            }else{
                swal("Something Went Wrong");
            }

        });
    });
</script>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/permission/asignPermissionToUser.blade.php ENDPATH**/ ?>