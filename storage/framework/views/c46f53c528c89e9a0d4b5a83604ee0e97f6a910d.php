
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Call Log </h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('save-call-log-details')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <div class="form-group col-md-4 newaddcalltext">
                        <!-- <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required> -->
                        <input type="text"  id="name" name="name" required="">
                        <label for="name">Enter Name<span class="text-danger">*</span></label>
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

                    <div class="form-group col-md-4 newaddcalltext">
                        <!-- <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required> -->
                        <input type="text"  id="phone" name="phone" required="">
                        <label for="phone">Enter Phone<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['phone'];
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

                    <div class="form-group col-md-4">
                        <!-- <label for="date" class="form-label">Date<span class="text-danger">*</span></label> -->
                        <h6>Date<span class="text-danger">*</span></h6>
                        <input type="date" class="form-control" id="date" name="date">
                        <?php $__errorArgs = ['date'];
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

                    <div class="form-group col-md-4 newaddcalltext">
                        <!-- <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"> </textarea> -->
                        <input type="text"  id="description" name="description" required="">
                        <label for="description">Description</label>
                        <?php $__errorArgs = ['description'];
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

                    <div class="form-group col-md-4">
                        <!-- <label for="next_fllow_up_date" class="form-label">Next Follow Up Date<span class="text-danger">*</span></label> -->
                        <h6>Next Follow Up Date<span class="text-danger">*</span></h6>
                        <input type="date" class="form-control" id="next_fllow_up_date" name="next_fllow_up_date">
                        <?php $__errorArgs = ['next_fllow_up_date'];
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


                    <div class="form-group col-md-4 newaddcalltext ">
                        <!-- <label for="call_duraiton" class="form-label">Call Duraiton<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="call_duraiton" name="call_duraiton" placeholder="Enter Call Duraiton"> -->
                        <input type="text"  id="call_duraiton" name="call_duraiton" required="">
                        <label for="call_duraiton">Call Duraiton<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['call_duraiton'];
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

                    <div class="form-group col-md-4">
                        <label for="call_type" class="form-label">Call Type<span class="text-danger">*</span></label>
                        <input type="radio" name="call_type" value="incoming" class="from-control"><span class="font-weight-bold;">Incoming</span>
                        <input type="radio" name="call_type" value="outgoing" class="from-control" checked><span class="fw-bold;">Outgoing</span>
                        <?php $__errorArgs = ['call_type'];
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

                    <div class="form-group col-md-4">
                        <!-- <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"> </textarea> -->
                        <input type="text"  id="note" name="note" required="">
                        <label for="note">Note<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['note'];
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

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Call </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/front-office/call-log/add-call.blade.php ENDPATH**/ ?>