
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">View Patient</h4>
        </div>
        <div class="card-body">
            
                <div class="row">

                    <div class="form-group col-md-3">
                        <label for="prefix">Prefix <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prefix" value="<?php echo e(@$patient->prefix); ?>"  >
                    </div>

                    <div class="form-group col-md-3">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="first_name"  value="<?php echo e(@ $patient->first_name); ?>" name="first_name" >
                        <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="middle_name">Middle Name </label>
                        <input type="text" class="form-control" id="middle_name"  value="<?php echo e(@$patient->middle_name); ?>" name="middle_name" >
                        <small class="text-danger"><?php echo e($errors->first('middle_name')); ?></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="last_name"  value="<?php echo e(@$patient->last_name); ?>" name="last_name" >
                        <small class="text-danger"><?php echo e($errors->first('last_name')); ?></small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="guardian_name">Guardian Name <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-lg-4 pr-0">
                            <input type="text" class="form-control" id="prefix" value="<?php echo e(@$patient->guardian_name_realation); ?>" >
                            </div>
                            <div class="col-lg-8 pl-0">
                            <input type="text" class="form-control" id="prefix" value="<?php echo e(@$patient->guardian_name); ?>" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="marital_status">Marital Status </label>
                        <input type="text" class="form-control" id="prefix" value="<?php echo e(@$patient->marital_status); ?>" >
                    </div>

                    <div class="form-group col-md-2">
                        <label for="blood_group">Blood Group </label>
                        <input type="text" class="form-control" id="prefix" value="<?php echo e(@$patient->blood_group); ?>" >
                    </div>

                    <div class="form-group col-md-2">
                        <label for="gender">Gender <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prefix" value="<?php echo e(@$patient->gender); ?>" >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prefix" value="<?php echo e(@$patient->date_of_birth); ?>" >
                    </div>

                    <div class="form-group col-md-6">
                        <label>Age (yy-mm-dd) <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php echo e(@$patient->year); ?>" id="date_of_birth_year" name="year"  > 
                            </div>

                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php echo e(@$patient->month); ?>" id="date_of_birth_month" name="month"  >
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php echo e(@$patient->day); ?>" id="date_of_birth_day" name="day" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?php echo e(@$patient->phone); ?>" id="phone" name="phone" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Email </label>
                        <input type="email" class="form-control" value="<?php echo e(@$patient->email); ?>" id="email" name="email">
                        <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" value="<?php echo e(@$patient->address); ?>" name="address" >
                        <small class="text-danger"><?php echo e($errors->first('address')); ?></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="state">State <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="state" value="<?php echo e(@$patient->state); ?>" >
                    </div>

                    <div class="form-group col-md-3">
                        <label for="district">District <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="district" value="<?php echo e(@$patient->district); ?>" >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="pin_no">Pin No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pin_no" name="pin_no"  value="<?php echo e(@$patient->pin_no); ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="identification_name"> Identification Name </label>
                        <input type="text" class="form-control" id="identification_name" value="<?php echo e(@$patient->identification_name); ?>" >

                    </div>
                    <div class="form-group col-md-6">
                        <label for="identification_number"> National Identification Number </label>
                        <input type="text" class="form-control" value="<?php echo e(@$patient->identification_number); ?>" name="identification_number" >
                        
                    </div>
                    <div class="form-group col-md-6">
                        <label for="remarks">Remarks </label>
                        <textarea type="text" class="form-control"  id="remarks" name="remarks"> <?php echo e(@$patient->remarks); ?> </textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="known_allergies"> Any Known Allergies </label>
                        <textarea type="text" class="form-control" id="known_allergies" name="known_allergies"> <?php echo e(@$patient->known_allergies); ?></textarea>
                    </div>

                   
                </div>
           
        </div>


    </div>

</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/patient/view-patient.blade.php ENDPATH**/ ?>