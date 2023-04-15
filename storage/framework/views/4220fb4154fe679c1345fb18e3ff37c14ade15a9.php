
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Pathology Billing</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-5 col-xl-4 border-right">
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('add_new_patient')); ?>"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="options px-5 pt-5  border-bottom pb-3">
                        <form method="post" action="<?php echo e(route('add-pathology-billing-for-a-patient')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select class="form-control  select2-show-search" name="patient_id">
                                        <option value="">Select One Patient</option>
                                        <?php if(isset($all_patient)): ?>
                                        <?php $__currentLoopData = $all_patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$patient->id); ?>" <?php echo e(@$patient_details_information->id == $patient->id ? 'Selected' : ''); ?>><?php echo e(@$patient->prefix); ?> <?php echo e(@$patient->first_name); ?> <?php echo e(@$patient->middle_name); ?> <?php echo e(@$patient->last_name); ?> ( <?php echo e(@$patient->id); ?> ) </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    

                    <?php if(isset($patient_details_information)): ?>
                    
                    <?php $__errorArgs = ['patientId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="options px-5  pb-3">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->gender); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->year); ?>y
                                                <?php echo e(@$patient_details_information->month); ?>m
                                                <?php echo e(@$patient_details_information->day); ?>d
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->guardian_name_realation); ?>

                                                <?php echo e(@$patient_details_information->guardian_name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->blood_group); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5"><?php echo e(@$patient_details_information->phone); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php endif; ?>
                </div>

                <div class="col-lg-7 col-xl-8">
                    <form method="post" action="<?php echo e(route('save-pathology-billing')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 78%">Test Name <span class="text-danger">*</span></th>

                                            <th scope="col" style="width: 20%">Amount <span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 2%">
                                                <button class="btn btn-success btn-sm" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- dynamic row -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="patientId" value="<?php echo e(@$patient_details_information->id); ?>" />
                        <div class="options px-5 pt-5  border-bottom pb-3">
                            <div class="container mt-5">
                                <div class="d-flex justify-content-end">
                                    <span class="biltext">Total</span>
                                    <input type="text" name="total" readonly id="total_am" class="form-control myfld">
                                </div>

                                <div class="d-flex justify-content-end">
                                    <input type="text" name="extra_charges_name" placeholder="Enter Extra Charges Name" class="form-control myfld2">
                                    <input onkeyup="gettotal()" type="text" name="extra_charges_value" value="00" class="form-control myfld1" id="extra_chages">
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <span class="biltext">Discount (% / flat)</span>
                                    <input type="text" name="total_discount" onkeyup="gettotal()" value="0" id="total_discount" class="form-control myfld">
                                    <select name="discount_type" onchange="gettotal()" id="discount_type" class="form-control myfld" style="width: 75px">
                                        <option value="percentage" selected>%</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <span class="biltext">Tax</span>
                                    <input type="text" name="total_tax" onkeyup="gettotal()" value="0" id="total_tax" class="form-control myfld">
                                </div>
                                <div class="d-flex justify-content-end thrdarea">
                                    <span class="biltext">Grand Total</span>
                                    <input type="text" name="grand_total" readonly id="grnd_total" value="00" class="form-control myfld">
                                    <?php $__errorArgs = ['grnd_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <br>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="btn-list p-3">
                            <button class="btn btn-primary btn-sm float-right" type="button" onclick="gettotal()"><i class="fa fa-calculator"></i> Calculate</button>
                            <button class="btn btn-primary btn-sm float-right " type="submit" name="save"><i class="fa fa-file"></i> Save</button>
                            <button class="btn btn-primary btn-sm float-right mr-2" name="save_and_print" type="submit"><i class="fa fa-paste"></i> Save & Print</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    var i = 0;

    function addnewrow() {
        var html = '<tr id="rowid' + i + '"><td><select required  class="form-control select2-show-search" name="test_id[]" id="test_id' + i + '" onchange="getTestAmount(this.value,' + i + ')"><option value="">Select Test Name</option> <?php if(isset($pathology_all_test)): ?> <?php $__currentLoopData = $pathology_all_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value->id); ?>"><?php echo e($value->test_name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></select></td><td><input type="text" required name="amount[]" class="form-control" onkeyup="gettotal()" id="amount' + i + '"></td><td><button class="btn btn-danger btn-sm" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';

        $('#subhendu').append(html);
        i = i + 1;
    }

    function getTestAmount(test_id, i) {
        $.ajax({
            url: "<?php echo e(route('find-test-amount-by-test')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                testId: test_id,
            },
            success: function(response) {
                $('#amount' + i).val(response.total_amount);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
        gettotal();
    }
</script>
<script type="text/javascript">
    function gettotal() {
        var no_of_row = $('#subhendu tr').length;
        console.log('aaa=>', no_of_row);

        var t = 0;
        $("input[name='amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        $('#total_am').val(t);

        var extra = $('#extra_chages').val();
        var total_discount = $('#total_discount').val();
        if ($('#discount_type').val() == 'percentage') {
            var r = parseFloat(t) + parseFloat(extra) + ((parseFloat(t) + parseFloat(extra)) * (parseFloat(total_discount) / 100));
        } else {
            var r = parseFloat(t) + parseFloat(extra) + parseFloat(total_discount);
        }
        var total_tax = $('#total_tax').val();
        if (total_tax != 0) {
            var grnd_total = r + (r * (total_tax / 100));
        } else {
            var grnd_total = r;
        }

        $('#grnd_total').val(grnd_total);

    }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/pathology/pathology-add-billing.blade.php ENDPATH**/ ?>