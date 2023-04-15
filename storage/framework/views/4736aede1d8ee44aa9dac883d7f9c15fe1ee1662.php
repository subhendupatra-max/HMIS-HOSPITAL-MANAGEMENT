

<?php $__env->startSection('content'); ?>
            

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>
        <div class="card-header">
            <h4 class="card-title">Add Vendor</h4>
        </div>
        <div class="card-body">
            <form method="POST"  action="<?php echo e(route('vendorAddAction')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group">
                        <label for="vendor_name" class="form-label">Vendor Name</label>
                        <input type="text" value="" class="form-control" id="name" name="name" placeholder="Enter Vendor Name" required>
                        <?php $__errorArgs = ['name'];
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

                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="role" class="form-label">Vendor Email</label>
                            <input class="form-control mb-4" placeholder="Enter Vendor Email" id="email" name="email" type="text">
                            <?php $__errorArgs = ['email'];
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
                        <div class="col-lg">
                            <label for="role" class="form-label">Vendor Phone no.</label>
                            <input class="form-control mb-4" placeholder="Enter Vendor Mobile No"  id="pnno" name="pnno" type="text">
                            <?php $__errorArgs = ['pnno'];
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
                        <div class="col-lg">
                            <label for="role" class="form-label">Pincode.</label>
                            <input class="form-control mb-4" placeholder="Vendor pincode" id="pin" name="pin"  type="text">
                            <?php $__errorArgs = ['pin'];
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
                    
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="role" class="form-label">GSTIN</label>
                            <input class="form-control mb-4" placeholder="Input box" id="gst" name="gst" value="" type="text">
                            <?php $__errorArgs = ['gst'];
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
                        <div class="col-lg">
                            <label for="role" class="form-label">Contact Person name</label>
                            <input class="form-control mb-4" placeholder="Input box" value="" name="contact_name" type="text">
                            <?php $__errorArgs = ['contact_name'];
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
                    
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="vendor_address" class="form-label">Vendor Address</label>
                            <textarea class="form-control mb-4" placeholder="Enter Vendor Address" id="address"  name="address"  rows="3"></textarea>
                        </div>
                        <?php $__errorArgs = ['address'];
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
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Vendor</button>
            </form>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/master/vendor/vendorAdd.blade.php ENDPATH**/ ?>