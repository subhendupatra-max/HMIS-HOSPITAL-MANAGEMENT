
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">OPD // <span style="color:blue"><?php echo e(@$department_details->department_name); ?></span>
                // <span><?php echo e(date('d-m-Y',strtotime($date))); ?></span></div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body p-0  mt-3">
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-xl-4 border-right">
                        <div class="col-md-12">
                            <form method="post" action="<?php echo e(route('registation-false-opd')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" id="department_id" name="department_id" value="<?php echo e($department_id); ?>" />
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
                                        <select name="gender" class="form-control select2-show-search" id="gender" required>
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
                                        <label for="visit_type">Visit Type <span class="text-danger">*</span></label>
                                        <select name="visit_type" id="visit_type" class="form-control select2-show-search"
                                            id="visit_type" required >
                                            <option value="" >Select One</option>
                                            <option value="New Visit" >New-Visit</option>
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
                                        <button class="btn btn-primary btn-sm text-center ml-2" type="button" onclick="validate()"
                                            name="save" value="save"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-8">
                        vnfdjn
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3 mt-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" >
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
                    window.reload();
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