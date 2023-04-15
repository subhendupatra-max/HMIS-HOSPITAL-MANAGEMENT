
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Manufacture</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="<?php echo e(route('editManufactureAction',$manufacture->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <label class="form-label">Manufacture Name<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?php echo e($manufacture->manufacturar_name); ?>" id="manufacturar_name" name="manufacturar_name" placeholder="Enter Manufacture Name">
                                    </div>
                                    <?php $__errorArgs = ['manufacturar_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                                                
                            <div class="text-right mt-3 ml-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/master/manufacture/edit-manufacture.blade.php ENDPATH**/ ?>