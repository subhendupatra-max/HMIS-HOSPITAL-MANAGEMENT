

<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Prescription
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('Ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('save-prescription-in-ipd')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <input type="hidden" name="ipd_id" value="<?php echo e($ipd_id); ?>" />
                    <input type="hidden" name="section" value="IPD" />
                    <input type="hidden" name="patient_id" value="<?php echo e($ipd_details->patient_id); ?>" />
                    <input type="hidden" name="case_id" value="<?php echo e($ipd_details->case_id); ?>" />
                    <!-- <div class="border-bottom border-top mt-2"> -->
                    <!-- <h6>Medicine :</h6> -->
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

                            </tbody>
                        </table>
                    </div>
                    <!-- </div> -->
                    <div class="col-md-12 mt-2 mb-3">
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

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row  mt-5 col-md-12">
                        <div class="form-group col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="date" name="date" required>
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

                        <div class="form-group col-md-6">
                            <label for="note" class="form-label">Note </label>
                            <input name="note" id="note" class="form-control" />
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
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Prescription</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


<script>
    var i = 1;
    var j = 1;
    var k = 1;

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
                    `;
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
<script>
    function getMedicine_name(cat_id, row_no) {
        $("#medicine_name").html('<option value=" ">Select Medicine Name...</option>');
        $("#dose").html('<option value=" ">Select dose...</option>');
        var div_data = '';
        var div_dataa = '';
        $.ajax({
            url: "<?php echo e(route('find-medicine-name-by-medicine-catagory-dose')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                medicine_catagory_id: cat_id,
            },

            success: function(response) {
                $.each(response.medicine_name, function(key, value) {
                    div_data += `<option value="${value.id}">${value.medicine_name}</option>`;
                });
                $('#medicine_name' + row_no).append(div_data);

                $.each(response.dose, function(key, value) {
                    div_dataa += `<option value="${value.dose} ${value.medicine_unit_name}">${value.dose} ${value.medicine_unit_name}</option>`;
                });
                $('#dose' + row_no).append(div_dataa);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $("#medicine_catagory_id").change(function(event) {
            event.preventDefault();
            let medicine_catagory_id = $(this).val();

            $("#dosage").html('<option value=" ">Select Dose...</option>');
            $.ajax({
                url: "<?php echo e(route('find-dosage-by-medicine-catagory')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    medicine_catagory_id_for_dose: medicine_catagory_id,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#dosage').append(`<option value="${value.id}">${value.dose}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/IPD/prescription/add-prescription.blade.php ENDPATH**/ ?>