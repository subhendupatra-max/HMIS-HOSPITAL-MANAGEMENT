<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('revoke roleToUser')): ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title  fs-3 fw-bolder" style="padding-left: 1%">Revoke Role</h5>
                <form action="<?php echo e(route('revokeRoleAction')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select User</label>
                        <input type="hidden" name="hiddenRole" id="hiddenRole">
                        <div class="col-sm-10">
                            <select class="form-select form-control" id="revoke_role_user" name="revoke_role_user"
                                aria-label="Default select example">
                                <option selected disabled>--Select--</option>
                                <?php $__currentLoopData = $userHaveRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userHaveRoles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($userHaveRoles->id); ?>">
                                        <?php echo e($userHaveRoles->name . '  (' . $userHaveRoles->email . ')'); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-danger roleOfEmployee fs-3 fw-bold"></small>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Revoke Role</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asign roleToUser')): ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fs-3 fw-bolder">Asign Role</h5>
                <form action="<?php echo e(route('asignRoleAction')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select User</label>
                        <input type="hidden" name="hiddenRole" id="hiddenRole">
                        <div class="col-sm-10">
                            <select class="form-select form-control" name="user" aria-label="Default select example">
                                <option selected disabled>--Select--</option>
                                <?php $__currentLoopData = $userDosentHaveRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userDosentHaveRoles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($userDosentHaveRoles->id); ?>">
                                        <?php echo e($userDosentHaveRoles->name . '  (' . $userDosentHaveRoles->email . ')'); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select Role</label>
                        <input type="hidden" name="hiddenRole" id="hiddenRole">
                        <div class="col-sm-10">
                            <select class="form-select form-control" name="role" aria-label="Default select example">
                                <option selected disabled>--Select--</option>
                                <?php $__currentLoopData = $allRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allRoles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($allRoles->name); ?>"><?php echo e($allRoles->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Asign Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Jquery js-->
<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
<script>
    $(document).ready(function() {

        $("#revoke_role_user").change(function(e) {
            e.preventDefault();
            let user = $(this).val()

            $.ajax({
                type: "POST",
                url: "<?php echo e(route('getRole')); ?>",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "userId": user
                },
                success: function(response) {
                    console.log(response);

                    $.each(response, function(key, val) {
                        $(".roleOfEmployee").html("User Role Is :" + val);
                        $("#hiddenRole").val(val);
                    });

                }
            });
        });

    });
</script>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supratim/php_projects/example-app/resources/views/role/asignRole.blade.php ENDPATH**/ ?>