
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header  d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    OPD // <span style="color:blue"><?php echo e(@$department_details->department_name); ?></span>
                    // <span><?php echo e(date('d-m-Y',strtotime($date))); ?></span>
                </div>

                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('opd-false-generation')); ?>"><i
                                class="fa fa-reply"></i> Change Department</a>
                    </div>
                </div>

            </div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0  mt-3">
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-xl-3 border-right">
                        <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i> OPD
                            Registation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="<?php echo e(route('registation-false-opd')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" id="department_id" name="department_id"
                                    value="<?php echo e($department_id); ?>" />
                                <input type="hidden" id="date" name="date" value="<?php echo e($date); ?>" />
                                <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></sma>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></sma>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <div class="row">
                                            <div class="form-group col-md-6 newaddappon ">
                                                <label class="date-format"> No. Of Patient <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="no_of_patient" name="no_of_patient" required />
                                                <?php $__errorArgs = ['no_of_patient'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></sma>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6 newuserlisttchange ">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control select2-show-search"
                                                    id="gender" required>
                                                    <option value="" for="gender">gender</option>
                                                    <?php $__currentLoopData = Config::get('static.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $genders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($genders); ?>"> <?php echo e($genders); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6 newaddappon ">
                                                <label class="date-format"> From Age(in year) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="from_age" id="from_age" required />
                                                <?php $__errorArgs = ['from_age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></sma>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6 newaddappon ">
                                                <label class="date-format"> To Age(in year) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="to_age" id="to_age" required />
                                                <?php $__errorArgs = ['to_age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></sma>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-12 newaddappon">
                                                <label for="visit_type">Visit Type <span
                                                        class="text-danger">*</span></label>
                                                <select name="visit_type" id="visit_type"
                                                    class="form-control select2-show-search" id="visit_type" required>
                                                    <option value="">Select One</option>
                                                    <option value="New Visit">New-Visit</option>
                                                    <option value="Revisit">Revisit</option>
                                                </select>
                                                <?php $__errorArgs = ['visit_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></sma>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-12 opd-bladedesign ">
                                                <button
                                                    class="btn btn-primary btn-sm text-center ml-2" type="button"
                                                    onclick="validate()" name="save" value="save"><i
                                                        class="fa fa-plus"></i> Add OPD Registation</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 border-right">
                        <span class="ml-2" style="color: brown;font-size: 14px;font-weight: 700;"><i
                                class="fa fa-cube"></i> Pathology Investigation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="#">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" id="pathology_department_id" name="pathology_department_id"
                                    value="<?php echo e($department_id); ?>" />
                                <input type="hidden" id="pathology_date" name="pathology_date" value="<?php echo e($date); ?>" />
                                <div class="row">
                                    <div class="form-group col-md-12 newaddappon">
                                        <label class="date-format ml-3"> Test Date<span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="pathology_test_date" id="pathology_test_date"
                                            required />
                                    </div>
                                    <div class="form-group col-md-12 newuserlisttchange ">
                                        <label for="gender"> Catagory <span class="text-danger">*</span></label>
                                        <select name="pathology_category" class="form-control select2-show-search"
                                            id="pathology_category" required>
                                            <option value="">Select Category..</option>
                                            <?php $__currentLoopData = $pathology_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"> <?php echo e($value->catagory_name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['pathology_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-12 newaddappon ">
                                        <label class="date-format"> No. of patient<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="no_of_patient_for_pathology_test"
                                            id="no_of_patient_for_pathology_test" required />
                                        <?php $__errorArgs = ['no_of_patient_for_pathology_test'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></sma>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    
                                    
                                    

                                    <div class="form-group col-md-12 opd-bladedesign ">
                                        <button class="btn btn-primary btn-sm text-center ml-2" type="button"
                                            onclick="validate_for_investigation_pathology()" name="save" value="save"><i
                                                class="fa fa-plus"></i> Add Pathology</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 border-right">
                        <span class="ml-2" style="color: brown;font-size: 14px;font-weight: 700;"><i
                                class="fa fa-cube"></i> Radiology Investigation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="#">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" id="radiology_department_id" name="radiology_department_id"
                                    value="<?php echo e($department_id); ?>" />
                                <input type="hidden" id="radiology_date" name="radiology_date" value="<?php echo e($date); ?>" />
                                <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></sma>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></sma>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <div class="row">
                                            <div class="form-group col-md-12 newaddappon">
                                                <label class="date-format ml-3"> Test Date<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" name="radiology_test_date" id="radiology_test_date"
                                                    required />
                                            </div>
                                            <div class="form-group col-md-12 newuserlisttchange ">
                                                <label for="gender"> Catagory <span class="text-danger">*</span></label>
                                                <select name="radiology_category"
                                                    class="form-control select2-show-search" id="radiology_category"
                                                    required>
                                                    <option value="">Select Category..</option>
                                                    <?php $__currentLoopData = $radiology_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>"> <?php echo e($value->catagory_name); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['radiology_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-12 newaddappon ">
                                                <label class="date-format"> No. of patient<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="no_of_patient_for_radiology_test"
                                                    id="no_of_patient_for_radiology_test" required />
                                                <?php $__errorArgs = ['no_of_patient_for_radiology_test'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></sma>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            

                                            <div class="form-group col-md-12 opd-bladedesign ">
                                                <button class="btn btn-primary btn-sm text-center ml-2" type="button"
                                                    onclick="validate_for_investigation_radiology()" name="save"
                                                    value="save"><i class="fa fa-plus"></i> Add Pathology</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li class="list-group-item"><i class="fa fa-cog text-danger"
                                                aria-hidden="true"></i> Today's total OPD Patient : <?php echo e(@$todays_total_opd); ?> <br>
                                            <span class="badge badge-success badge-pill">Original : <?php echo e(@$todays_total_opd_ori); ?></span> <span
                                                class="badge badge-danger badge-pill">False : <?php echo e(@$todays_total_opd_sys); ?></span>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-primary"
                                                aria-hidden="true"></i> New Patient : <?php echo e(@$todays_new); ?>

                                            <br>
                                            <span class="badge badge-success badge-pill">Original : <?php echo e(@$todays_new_ori); ?></span> <span class="badge badge-danger badge-pill">False : <?php echo e(@$todays_new_sys); ?></span>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-success"
                                                aria-hidden="true"></i> Revisit Patient : <?php echo e(@$todays_revisit); ?>

                                            <br> <span class="badge badge-success badge-pill">Original : <?php echo e(@$todays_revisit_ori); ?></span> <span
                                                class="badge badge-danger badge-pill">False : <?php echo e(@$todays_revisit_sys); ?></span>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-warning"
                                                aria-hidden="true"></i> Total for this Department : <?php echo e(@$todays_total_for_this_department); ?>

                                            <br> <span class="badge badge-success badge-pill">Original : <?php echo e(@$todays_total_for_this_department_ori); ?></span> <span
                                                class="badge badge-danger badge-pill">False : <?php echo e(@$todays_total_for_this_department_sys); ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i>
                        Pathology</span>
                    <div class="col-md-12">
                        <div class="row">
                            <?php $__currentLoopData = $pathology_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                             $ori_pathlogy = DB::table('pathology_patient_tests')->join('pathology_tests','pathology_tests.id','pathology_patient_tests.test_id')->where('pathology_tests.catagory_id',$value->id)->where('pathology_patient_tests.ins_by','ori')->where('date', 'like', $date .'%')->count();

                             $sys_pathlogy = DB::table('pathology_patient_tests')->join('pathology_tests','pathology_tests.id','pathology_patient_tests.test_id')->where('pathology_tests.catagory_id',$value->id)->where('pathology_patient_tests.ins_by','sys')->where('date', 'like', $date .'%')->count();
                              ?>
                                <div class="col-md-2"><?php echo e($value->catagory_name); ?><br>
                                    <span class="badge badge-success"><?php echo e($ori_pathlogy); ?></span>
                                    <span class="badge badge-success"><?php echo e($sys_pathlogy); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i>
                        Radiology</span>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">dd</div>
                            <div class="col-md-2">dd</div>
                            <div class="col-md-2">dd</div>
                            <div class="col-md-2">dd</div>
                            <div class="col-md-2">dd</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th scope="col">OPD Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Last Visit Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($opd_registaion_list)): ?>
                            <?php $__currentLoopData = $opd_registaion_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a class="textlink"
                                        href="<?php echo e(route('opd-profile', ['id' => base64_encode($value->id)])); ?>"><?php echo e(@$value->id); ?></a>
                                </td>
                                <td>
                                    <?php echo e(@$value->all_patient_details->prefix); ?>

                                    <?php echo e(@$value->all_patient_details->first_name); ?>

                                    <?php echo e(@$value->all_patient_details->middle_name); ?>

                                    <?php echo e(@$value->all_patient_details->last_name); ?>(<?php echo e(@$value->all_patient_details->id); ?>)<br>
                                    <i class="fa fa-venus-mars text-primary"></i>
                                    <?php echo e(@$value->all_patient_details->gender); ?> <i
                                        class="fa fa-calendar-plus-o text-primary"></i>
                                    <?php if(@$value->all_patient_details->year != 0): ?>
                                    <?php echo e(@$value->all_patient_details->year); ?>y
                                    <?php endif; ?>
                                    <?php if(@$value->all_patient_details->month != 0): ?>
                                    <?php echo e(@$value->all_patient_details->month); ?>m
                                    <?php endif; ?>
                                    <?php if(@$value->all_patient_details->day != 0): ?>
                                    <?php echo e(@$value->all_patient_details->day); ?>d
                                    <?php endif; ?>

                                </td>
                                <td><?php echo e(@$value->all_patient_details->guardian_name); ?></td>
                                <td><?php echo e(@$value->all_patient_details->phone); ?></td>
                                <td><?php echo e(@$value->case_id); ?></td>
                                <td>
                                    <?php if(isset($value->latest_opd_visit_details_for_patient->department_id)): ?>
                                    <i class="fa fa-cubes text-primary"></i>
                                    <?php echo e(@$value->latest_opd_visit_details_for_patient->department_details->department_name); ?>

                                    <br>
                                    <?php endif; ?>
                                    <?php if(isset($value->latest_opd_visit_details_for_patient->cons_doctor)): ?>
                                    <i class="fas fa-user-md text-primary"></i>
                                    <?php echo e(@$value->latest_opd_visit_details_for_patient->doctor->first_name); ?>

                                    <?php echo e(@$value->latest_opd_visit_details_for_patient->doctor->last_name); ?><br>
                                    <?php endif; ?>
                                    <?php if(isset($value->latest_opd_visit_details_for_patient->appointment_date)): ?>
                                    <i class="fa fa-calendar text-primary"></i>
                                    <?php echo e(date('d-m-Y h:i A',
                                    strtotime($value->latest_opd_visit_details_for_patient->appointment_date))); ?>

                                    <?php endif; ?>
                                </td>


                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validate_for_investigation_pathology() {
    // var pathology_test_date = $('#pathology_test_date').val();
    var pathology_category = $('#pathology_category').val();
    var no_of_patient_for_pathology_test = $('#no_of_patient_for_pathology_test').val();

    //   if( pathology_test_date == "" ) {
    //      alert( "Select test date !!" );
    //      return false;
    //   }
      if( pathology_category == "" ) {
         alert( "Select Pathology Category" );
         return false;
      }
      if( no_of_patient_for_pathology_test == "" ) {
         alert( "Enter no of patient" );
         return false;
      }
      savePatientopdpathology();
   }

   function savePatientopdpathology()
   {
    // var pathology_visit_type_ = $('#pathology_visit_type').val();
    // var pathology_to_age_ = $('#pathology_to_age').val();
    // var pathology_from_age_ = $('#pathology_from_age').val();
    // var pathology_gender_ = $('#pathology_gender').val();
    var no_of_patient_for_pathology_test_ = $('#no_of_patient_for_pathology_test').val();
    var pathology_category_ = $('#pathology_category').val();
    // var pathology_test_date_ = $('#pathology_test_date').val();
    var pathology_date_ = $('#pathology_date').val();
    var pathology_department_id_ = $('#pathology_department_id').val();

        $.ajax({
                url: "<?php echo e(route('false-pathology-test-add-opd')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    // pathology_visit_type : pathology_visit_type_,
                    // pathology_to_age : pathology_to_age_,
                    // pathology_from_age : pathology_from_age_,
                    // pathology_gender : pathology_gender_,
                    no_of_patient_for_pathology_test : no_of_patient_for_pathology_test_,
                    pathology_category : pathology_category_,
                    // pathology_test_date : pathology_test_date_,
                    pathology_date : pathology_date_,
                    pathology_department_id : pathology_department_id_,
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(error) {
                    alert(response.message);
                }
            });
   }
   function validate_for_investigation_radiology() {
    // var radiology_test_date = $('#radiology_test_date').val();
    var radiology_category = $('#radiology_category').val();
    var no_of_patient_for_radiology_test = $('#no_of_patient_for_radiology_test').val();

    //   if( radiology_test_date == "" ) {
    //      alert( "Select test date !!" );
    //      return false;
    //   }
      if( radiology_category == "" ) {
         alert( "Select Radiology Category" );
         return false;
      }
      if( no_of_patient_for_radiology_test == "" ) {
         alert( "Enter no of patient" );
         return false;
      }
      savePatientopdradiology();
   }
   function savePatientopdradiology()
   {
    // var radiology_visit_type_ = $('#radiology_visit_type').val();
    // var radiology_to_age_ = $('#radiology_to_age').val();
    // var radiology_from_age_ = $('#radiology_from_age').val();
    // var radiology_gender_ = $('#radiology_gender').val();
    var no_of_patient_for_radiology_test_ = $('#no_of_patient_for_radiology_test').val();
    var radiology_category_ = $('#radiology_category').val();
    // var radiology_test_date_ = $('#radiology_test_date').val();
    var radiology_date_ = $('#radiology_date').val();
    var radiology_department_id_ = $('#radiology_department_id').val();

        $.ajax({
                url: "<?php echo e(route('false-radiology-test-add-opd')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    // radiology_visit_type : radiology_visit_type_,
                    // radiology_to_age : radiology_to_age_,
                    // radiology_from_age : radiology_from_age_,
                    // radiology_gender : radiology_gender_,
                    no_of_patient_for_radiology_test : no_of_patient_for_radiology_test_,
                    radiology_category : radiology_category_,
                    // radiology_test_date : radiology_test_date_,
                    radiology_date : radiology_date_,
                    radiology_department_id : radiology_department_id_,

                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(error) {
                    alert(response.message);
                }
            });
    
   }
   function validate() {
    var visit_type_ = $('#visit_type').val();
    var to_age_ = $('#to_age').val();
    var from_age_ = $('#from_age').val();
    var gender_ = $('#gender').val();
    var no_of_patient_ = $('#no_of_patient').val();
    var date_ = $('#date').val();
    var departmentId = $('#department_id').val();

      if( visit_type_ == "" ) {
         alert( "Select Visit Type !!" );
         return false;
      }
      if( to_age_ == "" ) {
         alert( "Enter To Age" );
         return false;
      }
      if( from_age_ == "" ) {
         alert( "Enter From Age" );
         return false;
      }
      if( gender_ == "" ) {
         alert( "Select To Gender" );
         return false;
      }
      if( no_of_patient_ == "" ) {
         alert( "Enter No of patient" );
         return false;
      }
      if( date_ == "" ) {
         alert( "Select Date" );
         return false;
      }
      if( departmentId == "" ) {
         alert( "Select Department" );
         return false;
      }
      savePatientopd();
   }
function savePatientopd()
{
    var visit_type_ = $('#visit_type').val();
    var to_age_ = $('#to_age').val();
    var from_age_ = $('#from_age').val();
    var gender_ = $('#gender').val();
    var no_of_patient_ = $('#no_of_patient').val();
    var date_ = $('#date').val();
    var departmentId = $('#department_id').val();

        $.ajax({
                url: "<?php echo e(route('registation-false-opd')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    visit_type : visit_type_,
                    to_age : to_age_,
                    from_age : from_age_,
                    gender : gender_,
                    no_of_patient : no_of_patient_,
                    date : date_,
                    department_id : departmentId,

                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                    var visit_type_ = $('#visit_type').prop('selectedIndex', -1);;
                    var to_age_ = $('#to_age').val('');
                    var from_age_ = $('#from_age').val('');
                    var gender_ = $('#gender').prop('selectedIndex', -1);;
                    var no_of_patient_ = $('#no_of_patient').val('');
                    var date_ = $('#date').val('');
                    var departmentId = $('#department_id').val('');
                },
                error: function(error) {
                    alert(response.message);
                }
            });
    
}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/false/opd/false_patient_list.blade.php ENDPATH**/ ?>