
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Preparing Discharge Form Edit
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('ipd.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="text-danger" style="0px 0px 0px 17px;">**Before Discharged Please Check patient all bill**</span>
        <div class="card-body">

            <form action="<?php echo e(route('update-discharged-patient-in-ipd')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <input type="hidden" name="ipd_id" value="<?php echo e($ipdId); ?>" />
                    <input type="hidden" name="case_id" value="<?php echo e($ipd_patient_details->case_id); ?>" />
                    <input type="hidden" name="patient_id" value="<?php echo e($ipd_patient_details->patient_id); ?>" />
                    <input type="hidden" name="discharged_patient_id" value="<?php echo e($patient_discharge_details->id); ?>" />



                    <div class="form-group col-md-4">
                        <label for="doctor_name" class="form-label">Treating Consultant's Name<span class="text-danger">*</span></label>
                        <select name="doctor_name" class="form-control" id="doctor_name">
                            <option value="">Select...</option>
                            <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($name->id); ?>" <?php echo e(@$name->id == @$patient_discharge_details->doctor_name ? 'selected':''); ?>> <?php echo e($name->first_name); ?> <?php echo e($name->last_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['doctor_name'];
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
                        <label for="discharge_date" class="form-label">Discharge Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" required style="margin: 0px 0px 0px 0px;" class="form-control" id="discharge_date" name="discharge_date" value="<?php echo e(date('Y-m-d H:i A',strtotime( $patient_discharge_details->discharge_date))); ?>" />
                        <?php $__errorArgs = ['discharge_date'];
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
                        <label for="icd_code" class="form-label">Final Diagnosis at the time of Discharge </label>
                        <select name="icd_code" class="form-control" id="icd_code" required>
                            <option value="">Select...</option>
                            <?php $__currentLoopData = $icd_code; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icd_codes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($icd_codes->id); ?>" <?php echo e($icd_codes->id == @$patient_discharge_details->icd_code ? 'selected' : " "); ?>> <?php echo e($icd_codes->diagonasis_name); ?>(<?php echo e($icd_codes->icd_code); ?>)
                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['icd_code'];
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
                        <label for="complaiints_duraiton" class="form-label">Presenting Complaints with Duration and
                            Reason for Admission </label>
                        <textarea class="form-control" id="complaiints_duraiton" name="complaiints_duraiton"><?php echo e(@$patient_discharge_details->diagonsis_admission_time); ?> </textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="presenting_illness" class="form-label">Summary of Presenting Illness</label>
                        <textarea class="form-control" id="presenting_illness" name="presenting_illness" value="<?php echo e(old('presenting_illness')); ?> "><?php echo e(@$patient_discharge_details->presenting_illness); ?></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="physical_examinaiton_at_admission" class="form-label">Key findings, on physical
                            examination at the time of admission</label>
                        <textarea class="form-control" id="physical_examinaiton_at_admission" name="physical_examinaiton_at_admission"><?php echo e(@$patient_discharge_details->physical_examinaiton_at_admission); ?></textarea>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="summary_inves_during_hos" class="form-label"> Summary of key invesigations during
                            Hospitalization<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="summary_inves_during_hos" name="summary_inves_during_hos"><?php echo e(@$patient_discharge_details->summary_inves_during_hos); ?></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="course_complications" class="form-label"> Course in the Hospital including
                            complicaiotns if any</label>
                        <textarea class="form-control" id="course_complications" name="course_complications"><?php echo e(@$patient_discharge_details->course_complications); ?></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dischage_advice" class="form-label">Advice on Discharge</label>
                        <textarea class="form-control" id="dischage_advice" name="dischage_advice"><?php echo e(@$patient_discharge_details->dischage_advice); ?></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="discharge_status" class="form-label">Discharge Status <span class="text-danger">*</span></label>
                        <select name="discharge_status" class="form-control" id="discharge_status" required onchange="hide(this.value)">
                            <option value="">Select...</option>
                            <?php $__currentLoopData = Config::get('static.discharge_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $dischargeType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dischargeType); ?>" <?php echo e($dischargeType == @$patient_discharge_details->discharge_status ? 'selected' : " "); ?>> <?php echo e($dischargeType); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['discharge_status'];
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

                    <div class="form-group col-md-4" style="display:none" id="referral_hospital">
                        <label for="refferal_hospital_name" class="form-label">Refferal Hospital Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="refferal_hospital_name" name="refferal_hospital_name" value="<?php echo e(old('refferal_hospital_name')); ?>" />
                    </div>
                    <div class="form-group col-md-4" id="referral_hospital">
                        <label for="next_appointment_date" class="form-label">Next Appointment Date </label>
                        <input style="margin: 0px 0px 0px 0px;" type="date" class="form-control" id="next_appointment_date" name="next_appointment_date" value="<?php echo e(date('Y-m-d',strtotime( $patient_discharge_details->discharge_date))); ?>" />
                    </div>
                </div>
                <script>
                    function getMedicine_name(cat_id = null, row_no = null, med_id = null, dose = null) {
                        $("#medicine_name").html('<option value=" ">Select Medicine Name...</option>');
                        $("#dose").html('<option value=" ">Select dose...</option>');
                        var div_data = '';
                        var div_dataa = '';
                        var selll = '';
                        var sel = '';
                        $.ajax({
                            url: "<?php echo e(route('find-medicine-name-by-medicine-catagory-dose')); ?>",
                            type: "POST",
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                medicine_catagory_id: cat_id,
                            },

                            success: function(response) {
                                $.each(response.medicine_name, function(key, value) {
                                    if (med_id == value.id) {
                                        sel = 'selected';
                                    }

                                    div_data += `<option value="${value.id}" ${sel}>${value.medicine_name}</option>`;
                                });
                                $('#medicine_name' + row_no).append(div_data);

                                $.each(response.dose, function(key, value) {
                                    if (dose == value.dose + ' ' + value.medicine_unit_name) {
                                        selll = 'selected';
                                    }
                                    div_dataa += `<option value="${value.dose} ${value.medicine_unit_name}" ${selll}>${value.dose} ${value.medicine_unit_name}</option>`;
                                });
                                $('#dose' + row_no).append(div_dataa);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                </script>
                <div class="border-bottom border-top mt-2">
                    <h6>Medicine :</h6>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">Medicine Catagory
                                    </th>
                                    <th scope="col" style="width: 28%">Medicine Name
                                    </th>
                                    <th scope="col" style="width: 20%">Dosage
                                    </th>
                                    <th scope="col" style="width: 20%">Dose Interval
                                    </th>
                                    <th scope="col" style="width: 20%">Dose Duration
                                    </th>
                                    <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm" onclick="addNewrow()" type="button"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="chargeTable">
                                <?php if($medicine_discharge_details[0]->medicine_category_id != null): ?>
                                <?php $__currentLoopData = $medicine_discharge_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <script>
                                    getMedicine_name({
                                        {
                                            $value - > medicine_category_id
                                        }
                                    }, {
                                        {
                                            $key
                                        }
                                    }, {
                                        {
                                            $value - > medicine_id
                                        }
                                    }, '<?php echo e($value->dose); ?>')
                                </script>

                                <tr id="row<?php echo e($key); ?>">
                                    <td>
                                        <select class="form-control select2-show-search" onchange="getMedicine_name(this.value,<?php echo e($key); ?>,<?php echo e($value->medicine_id); ?>,<?php echo e($value->dose); ?>)" name="medicine_catagory_id[]" id="medicine_catagory_id<?php echo e($key); ?>" required>
                                            <option value=" ">Select Medicine Category</option>
                                            <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == @$value->medicine_category_id ? 'selected' : " "); ?>><?php echo e($item->medicine_catagory_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="medicine_name[]" id="medicine_name<?php echo e($key); ?>" class="form-control select2-show-search">
                                            <option value="">Select Medicine Name</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="dose[]" id="dose<?php echo e($key); ?>" class="form-control select2-show-search">
                                            <option value="">Select Dosage</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="dose_interval[]" id="dose_interval<?php echo e($key); ?>" class="form-control select2-show-search">
                                            <option value="">Select Dose Interval</option>
                                            <?php $__currentLoopData = $DoseInterval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->dose_interval); ?>" <?php echo e($item->dose_interval == @$value->interval ? 'selected' : " "); ?>><?php echo e($item->dose_interval); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="dose_duration[]" id="dose_duration<?php echo e($key); ?>" class="form-control select2-show-search">
                                            <option value="">Select Dose Duration</option>
                                            <?php $__currentLoopData = $DoseDuration; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->dose_duration); ?>" <?php echo e($item->dose_duration == @$value->duration ? 'selected' : " "); ?>><?php echo e($item->dose_duration); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="rowRemove(<?php echo e($key); ?>)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border-bottom">
                                <h6>Pathology Test :</h6>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 98%">Test Name
                                                </th>
                                                <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm" onclick="addNewrowPathology()" type="button"><i class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="addPathologyTable">
                                            <?php if($pathology_discharge_details[0]->test_id != null): ?>
                                            <?php $__currentLoopData = $pathology_discharge_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="rowpathology<?php echo e($key); ?>">
                                                <td>
                                                    <select class="form-control select2-show-search" name="pathology_test_id[]" id="pathology_test_id<?php echo e($key); ?>" required>
                                                        <option value=" ">Select test</option>
                                                        <?php $__currentLoopData = $pathology_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == @$value->test_id ? 'selected' : " "); ?>><?php echo e($item->test_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" type="button" onclick="rowRemovepathology(<?php echo e($key); ?>)"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border-bottom">
                                <h6>Radiology Test :</h6>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 98%">Test Name
                                                </th>
                                                <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm" onclick="addNewrowradiology()" type="button"><i class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRadiologyTable">
                                            <?php if($radiology_discharge_details[0]->test_id != null): ?>
                                            <?php $__currentLoopData = $radiology_discharge_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="rowradiology<?php echo e($key); ?>">
                                                <td>
                                                    <select class="form-control select2-show-search" name="radiology_test_id[]" id="radiology_test_id<?php echo e($key); ?>" required>
                                                        <option value=" ">Select test</option>
                                                        <?php $__currentLoopData = $radiology_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == @$value->test_id ? 'selected' : " "); ?>><?php echo e($item->test_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" type="button" onclick="rowRemoveradiology(<?php echo e($key); ?>)"><i class="fa fa-times"></i></button>
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


                <hr>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Discharged Patient</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<script>
    var i = $('#chargeTable tr').length;
    var j = $('#addPathologyTable tr').length;
    var k = $('#addRadiologyTable tr').length;

    function addNewrow() {
        var html = `<tr id="row${i}">
                        <td>
                            <select class="form-control select2-show-search" onchange="getMedicine_name(this.value,${i})"  name="medicine_catagory_id[]" id="medicine_catagory_id${i}" required>
                                    <option value=" ">Select Medicine Category</option>
                                    <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->medicine_catagory_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <select name="medicine_name[]" id="medicine_name${i}" class="form-control select2-show-search">
                                <option value="">Select Medicine Name</option>
                            </select>
                        </td>
                        <td>
                            <select name="dose[]" id="dose${i}" class="form-control select2-show-search">
                                <option value="">Select Dosage</option>
                            </select>
                        </td>
                        <td>
                            <select name="dose_interval[]" id="dose_interval${i}" class="form-control select2-show-search">
                                <option value="">Select Dose Interval</option>
                                <?php $__currentLoopData = $DoseInterval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->dose_interval); ?>"><?php echo e($item->dose_interval); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <select name="dose_duration[]" id="dose_duration${i}" class="form-control select2-show-search">
                                <option value="">Select Dose Duration</option>
                                <?php $__currentLoopData = $DoseDuration; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->dose_duration); ?>"><?php echo e($item->dose_duration); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemove(${i})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    </tr>`;
        $('#chargeTable').append(html);
        i = i + 1;

    }

    function rowRemove(row_id) {
        $(`#row${row_id}`).remove();
    }

    function addNewrowPathology() {
        var html = `<tr id="rowpathology${j}">
                        <td>
                            <select class="form-control select2-show-search" name="pathology_test_id[]" id="pathology_test_id${j}" required>
                                    <option value=" ">Select test</option>
                                    <?php $__currentLoopData = $pathology_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->test_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemovepathology(${j})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    `;
        $('#addPathologyTable').append(html);
        j = j + 1;
    }

    function rowRemovepathology(row_id) {
        $(`#rowpathology${row_id}`).remove();
    }

    function addNewrowradiology() {
        var html = `<tr id="rowradiology${k}">
                        <td>
                            <select class="form-control select2-show-search" name="radiology_test_id[]" id="radiology_test_id${k}" required>
                                    <option value=" ">Select test</option>
                                    <?php $__currentLoopData = $radiology_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->test_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemoveradiology(${k})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>`;
        $('#addRadiologyTable').append(html);
        j = j + 1;
    }

    function rowRemoveradiology(row_id) {
        $(`#rowradiology${row_id}`).remove();
    }
</script>

<script>
    function hide(val) {
        if (val == 'Refferal') {
            $('#referral_hospital').removeAttr('style', true);
        } else {
            $('#referral_hospital').attr('style', 'display:none !important', true);

        }
    }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Ipd/discharge-patient/edit-discharge-patient.blade.php ENDPATH**/ ?>