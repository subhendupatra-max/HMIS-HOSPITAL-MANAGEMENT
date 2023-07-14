
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
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?php echo e(route('user-update')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($user_details->id); ?>">
                <div class="col-md-12">
                    <div class="row">
                        <!-- //password  -->

                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fas fa-user"></i> Personal Information</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                        <div class="col-md-2 useraddd">

                            <input type="text" id="employee_id" value="<?php echo e($user_details->employee_id); ?>" name="employee_id" required="">
                            <label for="employee_id"> Employee Id <span class="text-danger">*</span></label>

                            <?php $__errorArgs = ['employee_id'];
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

                        <div class="col-md-2 useradddone">
                            <label> Role <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search " tabindex="-1" aria-hidden="true" name="role" id="role">
                                <optgroup>
                                    <option value=" ">Select Role </option>
                                    <?php if(isset($all_role)): ?>
                                    <?php $__currentLoopData = $all_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->name); ?>" <?php echo e(@$item->name == $user_details->role ? 'selected' : ' '); ?>>
                                        <?php echo e($item->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </optgroup>
                            </select>
                            <?php $__errorArgs = ['role'];
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

                        <div class="col-md-2 useradddone">
                            <label class="form-label">Designation <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="designation"
                                id="designation">
                                <option value="">Select Designation</option>
                                <?php $__currentLoopData = $designation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"  <?php echo e(@$item->id == $user_details->designation ? 'selected' : ' '); ?>><?php echo e($item->designation_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['designation'];
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

                        <div class="col-md-3  useradddone">
                            <label class="form-label">Department </label>
                            <select class="form-control select2-show-search " tabindex="-1" aria-hidden="true" name="department" id="department">
                                <option value=" ">Select Department</option>
                                <?php if(isset($department)): ?>
                                <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e(@$item->id == $user_details->department ? 'selected' : ' '); ?>>
                                    <?php echo e($item->department_name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['role'];
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

                        <div class="col-md-3 useraddd">
                            <input type="text" id="specialist" value="<?php echo e($user_details->specialist); ?>" name="specialist">
                            <label for="specialist"> Specialist </label>
                            <?php $__errorArgs = ['specialist'];
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

                        <div class="col-md-3 useradddtwo">

                            <input type="text" name="first_name" value="<?php echo e($user_details->first_name); ?>" id="first_name" required="">
                            <label for="first_name"> First Name <span class="text-danger">*</span></label>
                            <?php $__errorArgs = ['first_name'];
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

                        <div class="col-md-3 useradddtwo">

                            <input type="text" name="last_name" value="<?php echo e($user_details->last_name); ?>" id="last_name" required="">
                            <label for="last_name"> Last Name <span class="text-danger">*</span></label>
                            <?php $__errorArgs = ['last_name'];
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

                        <div class="col-md-3 useradddtwo ">


                            <input type="text" name="father_name" value="<?php echo e($user_details->father_name); ?>" id="father_name" required="">
                            <label for="father_name"> Father Name</label>
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

                        <div class="col-md-3 useradddtwo ">

                            <input type="text" name="mother_name" value="<?php echo e($user_details->mother_name); ?>" id="mother_name">
                            <label for="mother_name"> Mother Name</label>
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
                        <div class="col-md-2 newuserchange">
                            <label >Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="">Gender <span class="text-danger">*</span></option>

                                <?php $__currentLoopData = Config::get('static.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $genders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($genders); ?>" <?php echo e(@$genders == $user_details->gender ? 'selected' : ' '); ?>>
                                    <?php echo e($genders); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

                        <div class="col-md-2 newuserchange ">
                            <label>Metrial Status </label>
                            <select name="marital_status" class="form-control" id="marital_status">
                                <option value="">Metrial Status</option>
                                <?php $__currentLoopData = Config::get('static.marital_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $marital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($marital); ?>" <?php echo e(@$marital == $user_details->marital_status ? 'selected' : ' '); ?>>
                                    <?php echo e($marital); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

                        <div class="form-group col-md-2 newuserchange ">
                            <label for="blood_group" >Blood Group <span
                                class="text-danger">*</span></label>
                            <select name="blood_group" class="form-control" id="blood_group">
                                <option value="">Blood Group</option>
                                <?php $__currentLoopData = Config::get('static.blood_groups'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $blood_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($blood_group); ?>" <?php echo e(@$blood_group == $user_details->blood_group ? 'selected' : ' '); ?>>
                                    <?php echo e($blood_group); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-2 useraddthree">



                        <label >Date Of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" id="date_of_birth" <?php if(isset($user_details->date_of_birth)): ?> value="<?php echo e(date('Y-m-d', strtotime($user_details->date_of_birth))); ?>" <?php endif; ?>>

                            <?php $__errorArgs = ['date_of_birth'];
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

                        <div class="col-md-2 useraddthree">
                            <label >Date Of joining <span class="text-danger">*</span></label>

                            <input type="date" name="date_of_joining" id="date_of_joining" <?php if(isset($user_details->date_of_joining)): ?> value="<?php echo e(date('Y-m-d', strtotime($user_details->date_of_joining))); ?>" <?php endif; ?>>
                            <?php $__errorArgs = ['date_of_joining'];
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

                        <div class="col-md-2 useradddtwoo">

                            <input type="number" name="phone_no" id="phone_no" value="<?php echo e($user_details->phone_no); ?>" required="">
                            <label for="phone_no"> Phone</label>
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

                        <div class="col-md-3 newuserlisttchangee">

                            <input type="number" name="whatsapp_no" id="whatsapp_no" value="<?php echo e($user_details->whatsapp_no); ?>">
                            <label for="whatsapp_no">Whatsapp No </label>
                            <?php $__errorArgs = ['whatsapp_no'];
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

                        <div class="col-md-3 newuserlisttchangee ">

                            <input type="number" name="emg_phone_no" id="emg_phone_no" value="<?php echo e($user_details->emg_phone_no); ?>">
                            <label for="whatsapp_no">Emergency Phone No. </label>
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

                        <div class="col-md-3 newuserlisttchangee ">

                            <input type="email" name="email" id="email" value="<?php echo e($user_details->email); ?>" required="">
                            <label for="email">Email </label>
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

                        <div class="col-md-3">


                            <lable class="datetype">Photo (512 x 512)</lable>
                            <input type="file" onchange="readURL(this);" name="profile_image" id="profile_image">
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
                                </div>
                            </div>
                        </div>
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i> Address</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                        <div class="col-md-6 newuserrchange ">

                            <input type="text" name="current_address" id="current_address" value="<?php echo e($user_details->current_address); ?>">
                            <label for="current_address">Current Address </label>
                            <?php $__errorArgs = ['current_address'];
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

                        <div class="col-md-6 newuserchange ">

                            <input type="text" name="permanent_address" id="permanent_address" <?php echo e($user_details->permanent_address); ?> >
                            <label for="permanent_address">Permanent Address </label>
                            <?php $__errorArgs = ['permanent_address'];
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
                            </div>
                        </div>
                        <div class="card-body hospital_allcardbodydesign">
                            <h5 class="font-weight-bold"><i class="fa fa-cube "></i> Others</h5>
                            <div class="main-profile-bio mb-0">
                                <div class="row">
                        <div class="col-md-2 newuserchange">

                            <input type="text" name="qualification" id="qualification" <?php echo e($user_details->qualification); ?> >
                            <label for="qualification">Qualification</label>
                            <?php $__errorArgs = ['qualification'];
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

                        <div class="col-md-3 newuserchange ">

                            <input type="text" name="experience" id="experience" <?php echo e($user_details->experience); ?> >
                            <label for="experience">Work Experience</label>
                            <?php $__errorArgs = ['experience'];
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

                        <div class="col-md-3 newuserchange ">

                            <input type="text" name="specialization" id="specialization" <?php echo e($user_details->specialization); ?> >
                            <label for="specialization">Specialization</label>
                            <?php $__errorArgs = ['specialization'];
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

                        <div class="col-md-4 newuserchange">

                            <input type="text" name="note" id="note" <?php echo e($user_details->note); ?> >
                            <label for="note">Note</label>
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
                </div>
            </div>
            <div class="card-body hospital_allcardbodydesign">
                <h5 class="font-weight-bold"><i class="fas fa-tasks"></i>Identification Details</h5>
                <div class="main-profile-bio mb-0">
                    <div class="row">
                        <div class="col-md-4 newuserchange ">

                            <input type="text" name="pan_number" id="pan_number" value="<?php echo e($user_details->pan_number); ?>">
                            <label for="pan_number">Pan Number</label>
                            <?php $__errorArgs = ['pan_number'];
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

                        <div class="col-md-4 newuserchange">

                            <input type="text" name="identification_name" id="identification_name" value="<?php echo e($user_details->identification_name); ?>">
                            <label for="identification_name">Identification Name</label>
                            <?php $__errorArgs = ['identification_name'];
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

                        <div class="col-md-4 newuserchange">

                            <input type="text" name="local_identification_number" id="local_identification_number" value="<?php echo e($user_details->local_identification_number); ?>">
                            <label for="identification_number"> Identification Number</label>
                            <?php $__errorArgs = ['local_identification_number'];
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
                </div>
            </div>
            </div>
            <div class="row border-top">
                <div class="card-body hospital_allcardbodydesign">
                    <h5 class="font-weight-bold"><i class="fa fa-bank"></i> Bank Information</h5>
                    <div class="main-profile-bio mb-0">
                        <div class="row">
                            <div class="col-md-3 useraddd">
                                <input type="text" id="bank_account_no" value="<?php echo e(@$user_details->bank_account_no); ?>"
                                    name="bank_account_no">
                                <label for="bank_account_no"> Bank Account No. </label>
                                <?php $__errorArgs = ['bank_account_no'];
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
                            <div class="col-md-3 useraddd">
                                <input type="text" id="bank_name" value="<?php echo e(@$user_details->bank_name); ?>"
                                    name="bank_name">
                                <label for="bank_name"> Bank Name. </label>
                                <?php $__errorArgs = ['bank_name'];
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
                            <div class="col-md-3 useraddd">
                                <input type="text" id="ifsc_code" value="<?php echo e(@$user_details->ifsc_code); ?>"
                                    name="ifsc_code">
                                <label for="ifsc_code"> IFSC Code </label>
                                <?php $__errorArgs = ['ifsc_code'];
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

                            <div class="col-md-3 useraddd">
                                <input type="text" id="bank_branch_name" value="<?php echo e(@$user_details->bank_branch_name); ?>"
                                    name="bank_branch_name">
                                <label for="bank_branch_name"> Bank Branch Name </label>
                                <?php $__errorArgs = ['bank_branch_name'];
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
                    </div>
                </div>
            </div>

            <div class="row border-top">
                <div class="card-body hospital_allcardbodydesign">
                    <h5 class="font-weight-bold"><i class="fa fa-star"></i> Payroll</h5>
                    <div class="main-profile-bio mb-0">
                        <div class="row">
                            <div class="col-md-3 useraddd">
                                <input type="text" id="epf_no" value="<?php echo e(@$user_details->epf_no); ?>"
                                    name="epf_no">
                                <label for="epf_no"> EPF No. </label>
                                <?php $__errorArgs = ['epf_no'];
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
                            <div class="col-md-3 useraddd">
                                <input type="text" id="basic_salary" value="<?php echo e(@$user_details->basic_salary); ?>"
                                    name="basic_salary">
                                <label for="basic_salary">  Basic Salary </label>
                                <?php $__errorArgs = ['basic_salary'];
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
                            <div class="col-md-3 useraddd">
                                <select name="contract_type" class="form-control" id="contract_type"
                               >
                                    <option value="">Select One.....  </option>
                                    <?php $__currentLoopData = Config::get('static.contract_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $contract_types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($contract_types); ?>" <?php echo e($contract_types == $user_details->contract_type ? 'selected':''); ?>> <?php echo e($contract_types); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label for="ifsc_code"> Contract Type </label>
                                <?php $__errorArgs = ['ifsc_code'];
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
                    </div>
                </div>
            </div>
            <div class="row border-top">
                <div class="card-body hospital_allcardbodydesign">
                    <h5 class="font-weight-bold"><i class="fa fa-leaf"></i> Leave</h5>
                    <div class="main-profile-bio mb-0">
                        <div class="row">
                            <div class="col-md-2 useraddd">
                                <input type="text" id="casual_leave" value="<?php echo e(@$user_details->casual_leave); ?>"
                                    name="casual_leave">
                                <label for="casual_leave"> Casual Leave </label>
                                <?php $__errorArgs = ['casual_leave'];
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
                            <div class="col-md-2 useraddd">
                                <input type="text" id="privilege_leave" value="<?php echo e(@$user_details->privilege_leave); ?>"
                                    name="privilege_leave">
                                <label for="privilege_leave">  Privilege Leave </label>
                                <?php $__errorArgs = ['privilege_leave'];
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
                            <div class="col-md-2 useraddd">
                                <input type="text" id="sick_leave" value="<?php echo e(@$user_details->sick_leave); ?>"
                                    name="sick_leave">
                                <label for="sick_leave">  Sick Leave </label>
                                <?php $__errorArgs = ['sick_leave'];
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
                            <div class="col-md-2 useraddd">
                                <input type="text" id="maternity_leave" value="<?php echo e(@$user_details->maternity_leave); ?>"
                                    name="maternity_leave">
                                <label for="maternity_leave">  Maternity Leave </label>
                                <?php $__errorArgs = ['maternity_leave'];
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
                            <div class="col-md-2 useraddd">
                                <input type="text" id="paternity_leave" value="<?php echo e(@$user_details->paternity_leave); ?>"
                                    name="paternity_leave">
                                <label for="paternity_leave">  Paternity Leave </label>
                                <?php $__errorArgs = ['paternity_leave'];
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
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card-body hospital_allcardbodydesign">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>
                        Create
                        User</button>
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

            reader.onload = function(e) {
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/appPages/Users/edit-user.blade.php ENDPATH**/ ?>