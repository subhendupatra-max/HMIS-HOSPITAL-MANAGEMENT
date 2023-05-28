
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Pathology Test</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('update-pathology-test-details')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e(@$pathology_test->id); ?>" />
                <div class="row">
                    <div class="form-group col-md-4">

                        <input type="text" id="test_name" value="<?php echo e(@$pathology_test->test_name); ?>" name="test_name" required="">
                        <label for="test_name">Test Name <span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['test_name'];
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
         
                        <input type="text" id="short_name"  value="<?php echo e(@$pathology_test->short_name); ?>" name="short_name" required="">
                        <label for="short_name">Short Name</label>
                        <?php $__errorArgs = ['short_name'];
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
                        
                        <input type="text" id="test_type" name="test_type"  value="<?php echo e(@$pathology_test->test_type); ?>" required="">
                        <label for="test_type">Test Type</label>
                        <?php $__errorArgs = ['test_type'];
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

                    <div class="form-group col-md-4 addnew">
                         <label for="catagory_id" >Category<span class="text-danger">*</span></label>
                        <select id="catagory_id" class="form-control" name="catagory_id">
                            <option value=" ">Select Category</option>
                            <?php $__currentLoopData = $catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == @$pathology_test->catagory_id ?'selected':''); ?>><?php echo e($item->catagory_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['catagory_id'];
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

                    <div class="form-group col-md-4 addnewblade">

                        <input type="text"id="sub_catagory" name="sub_catagory" value="<?php echo e(@$pathology_test->sub_catagory); ?>"  required="">
                        <label for="sub_catagory">Sub Catagory</label>
                        <?php $__errorArgs = ['sub_catagory'];
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

                    <div class="form-group col-md-4 addnewblade">
        
                        <input type="text" id="method" name="method"  value="<?php echo e(@$pathology_test->method); ?>" required="">
                        <label for="method">Method</label>
                        <?php $__errorArgs = ['method'];
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

                    <div class="form-group col-md-4 addnewbladee ">

                        <input type="text"  id="report_days" name="report_days"  value="<?php echo e(@$pathology_test->report_days); ?>" required="">
                        <label for="report_days">Report Days </label>
                        <?php $__errorArgs = ['report_days'];
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

                    <div class="form-group col-md-4 addnewde">
                         <label for="charge_category" >Charges Catagory <span class="text-danger">*</span></label>
                        <select id="charge_category" data-charge_name = <?php echo e($pathology_test->charge); ?> data-charge_sub_category="<?php echo e($pathology_test->charge_sub_category); ?>" class="form-control select2-show-search" name="charge_category">
                            <option value=" ">Select Catagory</option>
                            <?php $__currentLoopData = $chargeCatagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == @$pathology_test->charge_category ?'selected':''); ?> ><?php echo e($item->charges_catagories_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['charge_category'];
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

                    <div class="form-group col-md-4 addnewde">
                        <label for="charge_sub_category">Charges Sub Catagory <span class="text-danger">*</span></label>
                        <select name="charge_sub_category" class="form-control select2-show-search" onchange="getChargeName(this.value,<?php echo e($pathology_test->charge); ?>)" id="charge_sub_category" required >
                            <option value="">Select Sub Catagory...</option>
                        </select>
                        <small class="text-danger"><?php echo e($errors->first('charge_sub_category')); ?></small>
                    </div>

                    <div class="form-group col-md-4 addnewblade">
                         <label for="charge">Charge Name <span class="text-danger">*</span></label>
                        <select name="charge" class="form-control select2-show-search" id="charge" onchange="getChargeAmount(this.value)" required>
                            <option value="">Select charge...</option>
                        </select>
                        <small class="text-danger"><?php echo e($errors->first('charge')); ?></small>
                    </div>

                    <div class="form-group col-md-8 addnewde" >
                        <span id="charge_details" style="font-size: 16px;"></span>
                    </div>

                    <div class="form-group col-md-12 addnewblade">
                        <label >Description</label>
                        <textarea class="content" name="description"><?php echo e(@$pathology_test->description); ?></textarea>
                    </div>
                </div>


                <div class="form-group col-md-12 mt-0 ">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 30%"> Test Parameter Name <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 40%">Reference Range <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 28%">Unit <span class="text-danger">*</span>
                                </th>
                                <th scope="col" style="width: 2%">
                                    <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody  id="subhendu">
                            <?php if(@$pathology_test_details[0]->id != null): ?>
                                <?php $__currentLoopData = $pathology_test_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="rowid<?php echo e($key); ?>">
                                    <td><select id="test_parameter_name<?php echo e($key); ?>" onchange="getParameter(<?php echo e($key); ?>)" class="form-control select2-show-search"
                                    name="test_parameter_name[]">
                                    <option value="">Select Parameter Name</option>
                                    <?php $__currentLoopData = $parameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $value->pathology_parameter_id ? 'selected':''); ?>><?php echo e($item->parameter_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </td>
                                    <td>
                                    <span id="reference_range<?php echo e($key); ?>"></span>
                                    </td>
                                    <td>
                                    <span id="unit<?php echo e($key); ?>"></span>
                                    </td>
                                    </tr> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Test</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    var i = 1;

    function addnewrow() {
        var html = `<tr id="rowid${i}">
                        <td><select id="test_parameter_name${i}" onchange="getParameter(${i})" class="form-control select2-show-search"
                        name="test_parameter_name[]">
                        <option value="">Select Parameter Name</option>
                        <?php $__currentLoopData = $parameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->parameter_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </td>
                        <td>
                        <span id="reference_range${i}"></span>
                        </td>
                        <td>
                        <span id="unit${i}"></span>
                        </td>
                        </tr>`;
        $('#subhendu').append(html);
        i = i + 1;
    }
</script>
<script>
    function getParameter(i) {
        var parameter = $('#test_parameter_name' + i).val();
        $.ajax({
            url: "<?php echo e(route('find-range-by-parameter-pathology')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                parameter_id: parameter,
            },

            success: function(response) {
                console.log(response);
                const reference_range = response.range_value.reference_range;
                console.log(reference_range);
                const unit = response.unit_value.unit_name;
                console.log(unit);
                console.log(i);
                $('#reference_range' + i).html(reference_range);
                $('#unit' + i).html(unit);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>




<script>
    $(document).ready(function() {
        $("#charge_category").change(function(event) {
            // alert('ok')
            event.preventDefault();
            let catagory = $(this).val();
            var sub_cat = $(this).attr("data-charge_sub_category")
            var charge_name = $(this).attr("data-charge_name")
            var sel = '';
            // alert(state);
            $('#charge_sub_category').html('<option vaule="" >Select Sub Catagory...</option>');
            $.ajax({
                url: "<?php echo e(route('find-sub-catagory-by-catagory')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    catagory_id: catagory,
                },

                success: function(response) {


                    $.each(response, function(key, value) {
                        if(sub_cat == value.id)
                        {
                            sel = 'selected';
                        }
                        $('#charge_sub_category').append(
                            `<option value="${value.id}" ${sel} >${value.charges_sub_catagories_name}</option>`
                        );
                    });
                    getChargeName(sub_cat,charge_name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>


<script>
    function getChargeName(sub_cat = null,	charge = null){
        $("#charge").html('<option value=" ">Select Charge...</option>');
        var sel = '';
        $.ajax({
                url: "<?php echo e(route('find-charge-by-sub-catagory')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    charge_id: sub_cat,
                },

                success: function(response) {

                    $.each(response, function(key, value) {
                        if(charge == value.id)
                        {
                            sel = 'selected';
                        }
                        $('#charge').append(
                            `<option value="${value.id}" ${sel} >${value.charges_name}</option>`
                        );
                    });
                    getChargeAmount(charge);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>

<script>
    function getChargeAmount(charge = null){
        $('#charge_details').text('');
            var div_data = '';
        $.ajax({
                url: "<?php echo e(route('getcharges-amount')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    charges: charge,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        div_data += `For ${value.charge_type_name} : ${value.standard_charges} Rs , `
                    });
                    console.log(response);
                    $('#charge_details').html(div_data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }

</script>




<script>
    $(document).ready(function() {
        $("#abcd").keyup(function(event) {
            event.preventDefault();
            let charge = $(this).val();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pathology/test/edit.blade.php ENDPATH**/ ?>