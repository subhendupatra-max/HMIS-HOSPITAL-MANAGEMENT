
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Creation Form</h4>
        </div>
<!-- ================== message============================== -->
        <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
<!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" method="POST" action="<?php echo e(route('user-update')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($user_details->id); ?>">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">User Name <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('name', $user_details->name)); ?>" required class="form-control"  name="name" placeholder="Name">
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

                        <div class="col-md-4">
                            <label class="form-label">Workshop <span class="text-danger">*</span></label>
                            <select class="form-control" required name="workshop">
                                <option value="" <?php echo e($user_details->workshop =='' ? "selected" : ""); ?>>Select One</option>
                                <option value="0" <?php echo e($user_details->workshop =='0' ? "selected" : ""); ?>>All Workshop</option>
                                <?php if(isset($workshops)): ?>
                                <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(@$value->id); ?>" <?php echo e($user_details->workshop ==$value->id ? "selected" : ""); ?>><?php echo e(@$value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                
                            </select>
                            <?php $__errorArgs = ['workshop'];
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

                        <div class="col-md-4">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select class="form-control" required name="gender">
                                <option value="" <?php echo e($user_details->gender =='' ? "selected" : ""); ?> >Select One</option>
                                <option value="Male" <?php echo e($user_details->gender =='Male' ? "selected" : ""); ?>>Male</option>
                                <option value="Female" <?php echo e($user_details->gender =='Female' ? "selected" : ""); ?>>Female</option>
                                <option value="Others" <?php echo e($user_details->gender =='Others' ? "selected" : ""); ?>>Others</option>
                            </select>
                            <?php $__errorArgs = ['gender'];
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
                        <div class="col-md-4">
                            <label class="form-label">Metrial Status <span class="text-danger">*</span></label>
                            <select class="form-control" required name="metrial_status">
                                <option value="" <?php echo e($user_details->metrial_status =='' ? "selected" : ""); ?>>Select One</option>
                                <option value="Single" <?php echo e($user_details->metrial_status =='Single' ? "selected" : ""); ?>>Single</option>
                                <option value="Married" <?php echo e($user_details->metrial_status =='Married' ? "selected" : ""); ?>>Married</option>
                                <option value="Widowed" <?php echo e($user_details->metrial_status =='Widowed' ? "selected" : ""); ?>>Widowed</option>
                                <option value="Separated" <?php echo e($user_details->metrial_status =='Separated' ? "selected" : ""); ?>>Separated</option>
                            </select>
                            <?php $__errorArgs = ['metrial_status'];
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
                        <div class="col-md-4">
                            <label class="form-label">Father's Name </label>
                            <input type="text" class="form-control" value="<?php echo e(old('father_name', $user_details->father_name)); ?>" id="father_name" name="father_name" placeholder="Father's Name">
                            <?php $__errorArgs = ['father_name'];
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
                        <div class="col-md-4">
                            <label class="form-label">Mother's Name </label>
                            <input type="text" value="<?php echo e(old('mother_name', $user_details->mother_name)); ?>" class="form-control"  name="mother_name" placeholder="Mother's Name">
                            <?php $__errorArgs = ['mother_name'];
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
                        <div class="col-md-4">
                            <label class="form-label">Age <span class="text-danger">*</span></label>
                            <input type="date" value="<?= date('Y-m-d',strtotime($user_details->age)); ?>" required class="form-control"  name="age" >
                            <?php $__errorArgs = ['age'];
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
                        <div class="col-md-4">
                            <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                            <input type="number" value="<?php echo e(old('phone_no', $user_details->phone_no)); ?>" required class="form-control"  name="phone_no" >
                            <?php $__errorArgs = ['phone_no'];
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
                        <div class="col-md-4">
                            <label class="form-label">Emergency Phone No. </label>
                            <input type="number" class="form-control" value="<?php echo e(old('emg_phone_no', $user_details->emg_phone_no)); ?>" name="emg_phone_no" >
                            <?php $__errorArgs = ['emg_phone_no'];
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
                          <div class="col-md-4">
                            <label class="form-label">WhatsApp No. <span class="text-danger">*</span></label>
                            <input type="number" value="<?php echo e(old('whatapps_no', $user_details->whatapps_no)); ?>" required class="form-control"  name="whatapps_no" >
                            <?php $__errorArgs = ['whatapps_no'];
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
                        <div class="col-md-4">
                            <label class="form-label">Profile Image</label>
                            <input type="file" onchange="readURL(this);" name="profile_image" >
                            <?php $__errorArgs = ['profile_image'];
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
                         <div class="col-md-4 mt-2">
                            <img id="blah"  width="60px" height="40px"  src="<?php echo e(asset('profile_picture')); ?>/<?php echo e($user_details->profile_image); ?>" alt="your image" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Highest Qualification <span class="text-danger">*</span></label>
                            <textarea required class="form-control" name="highest_qualification"><?php echo e(old('highest_qualification', $user_details->highest_qualification)); ?></textarea>
                            <?php $__errorArgs = ['highest_qualification'];
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
                        <div class="col-md-6">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" required name="address"> <?php echo e(old('address', $user_details->address)); ?></textarea>
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
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update User</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(50)
                    .height(50);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/Users/edit-user.blade.php ENDPATH**/ ?>