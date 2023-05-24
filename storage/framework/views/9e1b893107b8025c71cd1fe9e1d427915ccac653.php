
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header  d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    EMG
                    // <span><?php echo e(date('d-m-Y',strtotime($date))); ?></span>
                </div>


            </div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0  mt-3">
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-xl-3 border-right">
                        <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i> EMG
                            Registation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="<?php echo e(route('registation-false-emg')); ?>">
                                <?php echo csrf_field(); ?>

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

                                            <div class="form-group col-md-12 opd-bladedesign ">
                                                <button class="btn btn-primary btn-sm text-center ml-2" type="button"
                                                    onclick="validate()" name="save" value="save"><i
                                                        class="fa fa-plus"></i> Add EMG Registation</button>
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

                                <input type="hidden" id="pathology_date" name="pathology_date" value="<?php echo e($date); ?>" />
                                <div class="row">

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
                                        <button class="btn btn-primary btn-sm text-center ml-2"
                                             type="button"
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

                                <input type="hidden" id="radiology_date" name="radiology_date" value="<?php echo e($date); ?>" />
                           
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
                                                    value="save"><i class="fa fa-plus"></i> Add Radiology</button>
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
                                                aria-hidden="true"></i> Today's total Emg Patient : <?php echo e(@$todays_total_emg); ?> <br>
                                            <span class="badge badge-success badge-pill">Original : <?php echo e(@$todays_total_emg_ori); ?></span> <span
                                                class="badge badge-danger badge-pill">False : <?php echo e(@$todays_total_emg_sys); ?></span>
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
                $ori_pathlogy = DB::table('pathology_patient_tests')->join('pathology_tests', 'pathology_tests.id', 'pathology_patient_tests.test_id')->where('pathology_tests.catagory_id', $value->id)->where('pathology_patient_tests.ins_by', 'ori')->where('pathology_patient_tests.date', 'like', $date . '%')->count();

                $sys_pathlogy = DB::table('pathology_patient_tests')->join('pathology_tests', 'pathology_tests.id', 'pathology_patient_tests.test_id')->where('pathology_tests.catagory_id', $value->id)->where('pathology_patient_tests.ins_by', 'sys')->where('pathology_patient_tests.date', 'like', $date . '%')->count();
                ?>
                            <div class="col-md-2"><?php echo e($value->catagory_name); ?><br>
                                <span class="badge badge-success"><?php echo e($ori_pathlogy); ?></span>
                                <span class="badge badge-danger"><?php echo e($sys_pathlogy); ?></span>
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
                            <?php $__currentLoopData = $radiology_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                $ori_radiology = DB::table('radiology_patient_tests')->join('radiology_tests', 'radiology_tests.id', 'radiology_patient_tests.test_id')->where('radiology_tests.catagory_id', $value->id)->where('radiology_patient_tests.ins_by', 'ori')->where('radiology_patient_tests.date', 'like', $date . '%')->count();

                $sys_radiology = DB::table('radiology_patient_tests')->join('radiology_tests', 'radiology_tests.id', 'radiology_patient_tests.test_id')->where('radiology_tests.catagory_id', $value->id)->where('radiology_patient_tests.ins_by', 'sys')->where('radiology_patient_tests.date', 'like', $date . '%')->count();
                ?>
                            <div class="col-md-2"><?php echo e($value->catagory_name); ?><br>
                                <span class="badge badge-success"><?php echo e($ori_radiology); ?></span>
                                <span class="badge badge-danger"><?php echo e($sys_radiology); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th scope="col">EMG Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Last Visit Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($emg_registaion_list)): ?>
                            <?php $__currentLoopData = $emg_registaion_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a class="textlink"
                                        href="<?php echo e(route('emg-patient-profile', ['id' => base64_encode($value->id)])); ?>"><?php echo e(@$value->id); ?></a>
                                    <br>
                                    <a href="#" onclick="showAllTest(<?php echo e($value->case_id); ?>)"
                                        class="badge badge-primary">Investigation</a>
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
                                  
                                    
                                    <?php if(isset($value->all_emg_visit_details->appointment_date)): ?>
                                    <i class="fa fa-calendar text-primary"></i>
                                    <?php echo e(date('d-m-Y h:i A',
                                    strtotime($value->all_emg_visit_details->appointment_date))); ?>

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
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">All Investigation</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <ul class="list-group" id="investigation">
                        

                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    function showAllTest(case_id) {
        var div_pathology_radiology = '';
        $.ajax({
            url: "<?php echo e(route('false-pathology-test-show-in_modal-emg')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                caseId: case_id,
            },
            success: function(response) {
                $.each(response.pathology_test_deatils, function(key, value) {
                    div_pathology_radiology += `<li class="list-group-item"><i class="fa fa-flask text-info"
                                aria-hidden="true"></i> ${value.test_name}
                        </li>`
                });
                $.each(response.radiology_test_deatils, function(key, value) {
                    div_pathology_radiology += `<li class="list-group-item"><i class="fa fa-flask text-info"
                                aria-hidden="true"></i> ${value.test_name}
                        </li>`
                });
                $('#modaldemo1').modal('show');
                $('#investigation').html(div_pathology_radiology);
            },
            error: function(error) {
                alert(response.message);
            }

        });
    }

    function validate_for_investigation_pathology() {
        var pathology_category = $('#pathology_category').val();
        var no_of_patient_for_pathology_test = $('#no_of_patient_for_pathology_test').val();
        if (pathology_category == "") {
            alert("Select Pathology Category");
            return false;
        }
        if (no_of_patient_for_pathology_test == "") {
            alert("Enter no of patient");
            return false;
        }
        savePatientemgpathology();
    }

    function savePatientemgpathology() {

        var no_of_patient_for_pathology_test_ = $('#no_of_patient_for_pathology_test').val();
        var pathology_category_ = $('#pathology_category').val();
        var pathology_date_ = $('#pathology_date').val();
        var pathology_department_id_ = $('#pathology_department_id').val();

        $.ajax({
            url: "<?php echo e(route('false-pathology-test-add-emg')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                no_of_patient_for_pathology_test: no_of_patient_for_pathology_test_,
                pathology_category: pathology_category_,
                pathology_date: pathology_date_,
                pathology_department_id: pathology_department_id_,
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
        var radiology_category = $('#radiology_category').val();
        var no_of_patient_for_radiology_test = $('#no_of_patient_for_radiology_test').val();

        if (radiology_category == "") {
            alert("Select Radiology Category");
            return false;
        }
        if (no_of_patient_for_radiology_test == "") {
            alert("Enter no of patient");
            return false;
        }
        savePatientemgradiology();
    }

    function savePatientemgradiology() {

        var no_of_patient_for_radiology_test_ = $('#no_of_patient_for_radiology_test').val();
        var radiology_category_ = $('#radiology_category').val();
        var radiology_date_ = $('#radiology_date').val();

        $.ajax({
            url: "<?php echo e(route('false-radiology-test-add-emg')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',

                no_of_patient_for_radiology_test: no_of_patient_for_radiology_test_,
                radiology_category: radiology_category_,
                radiology_date: radiology_date_,
               

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

        if (visit_type_ == "") {
            alert("Select Visit Type !!");
            return false;
        }
        if (to_age_ == "") {
            alert("Enter To Age");
            return false;
        }
        if (from_age_ == "") {
            alert("Enter From Age");
            return false;
        }
        if (gender_ == "") {
            alert("Select To Gender");
            return false;
        }
        if (no_of_patient_ == "") {
            alert("Enter No of patient");
            return false;
        }
        if (date_ == "") {
            alert("Select Date");
            return false;
        }
        // if (departmentId == "") {
        //     alert("Select Department");
        //     return false;
        // }
        savePatientemg();
    }

    function savePatientemg() {
        var visit_type_ = $('#visit_type').val();
        var to_age_ = $('#to_age').val();
        var from_age_ = $('#from_age').val();
        var gender_ = $('#gender').val();
        var no_of_patient_ = $('#no_of_patient').val();
        var date_ = $('#date').val();
        var departmentId = $('#department_id').val();

        $.ajax({
            url: "<?php echo e(route('registation-false-emg')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                visit_type: visit_type_,
                to_age: to_age_,
                from_age: from_age_,
                gender: gender_,
                no_of_patient: no_of_patient_,
                date: date_,
                department_id: departmentId,

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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/false/emg/false_patient_list.blade.php ENDPATH**/ ?>