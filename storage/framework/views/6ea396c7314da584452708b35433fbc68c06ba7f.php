
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Visitor </h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('save-visit-details')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="purpose" class="form-label">Purpose<span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" value="<?php echo e(old('purpose')); ?>" name="purpose" id="purpose" required>
                            <option value="">Select Appointment Priority</option>
                            <?php $__currentLoopData = Config::get('static.visit_purpose'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"> <?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['purpose'];
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
                        <!-- <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required> -->
                        <input type="text" id="name" name="name" required="">
                        <label for="name"> Enter Name<span class="text-danger">*</span></label>
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

                    <div class="form-group col-md-4">
                        <!-- <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required> -->
                        <input type="text" id="phone" name="phone" required>
                        <label for="phone"> Enter Phone No<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['phone'];
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
                        <!-- <label for="id_card" class="form-label">ID Card<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="id_card" name="id_card" placeholder="Enter ID Card" > -->
                        <input type="text" id="id_card" name="id_card">
                        <label for="id_card"> Enter ID Card</label>
                        <?php $__errorArgs = ['id_card'];
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
                        <label for="visit_to" class="form-label">Visit To<span class="text-danger">*</span></label>
                        <select id="visit_to" class="form-control" name="visit_to" onchange="visitWith(this.value)">
                            <option value="">Visit To<span class="text-danger">*</span></option>
                            <?php $__currentLoopData = Config::get('static.visit_to'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"> <?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['visit_to'];
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
                        <label for="visit_to_name" class="form-label">IPD/OPD/Staff<span class="text-danger">*</span></label>
                        <select name="visit_to_name" class="form-control select2-show-search" id="visit_to_name">
                            <option value="">Select...</option>
                        </select>
                        <small class="text-danger"><?php echo e($errors->first('visit_to_name')); ?></small>
                    </div>

                    <div class="form-group col-md-4 newaddvisitext">
                        <!-- <label for="number_of_person" class="form-label"> Number Of Person<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="number_of_person" name="number_of_person" > -->
                        <input type="text" id="number_of_person" name="number_of_person">
                        <label for="number_of_person"> Number Of Person</label>
                        <?php $__errorArgs = ['number_of_person'];
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
                        <!-- <label for="date" class="form-label">Date<span class="text-danger">*</span></label> -->
                        <h6>Date<span class="text-danger">*</span></h6>
                        <input type="date" class="form-control" id="date" name="date">
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

                    <div class="form-group col-md-4">
                        <!-- <label for="in_time" class="form-label">In Time<span class="text-danger">*</span></label> -->
                        <h6>In Time</h6>
                        <input type="time" class="form-control" id="in_time" name="in_time" >
                        <?php $__errorArgs = ['in_time'];
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
                        <!-- <label for="out_time" class="form-label">Out Time<span class="text-danger">*</span></label> -->
                        <h6>Out Time</h6>
                        <input type="time" class="form-control" id="out_time" name="out_time">
                        <?php $__errorArgs = ['out_time'];
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

                    <div class="form-group col-md-4 newaddvisitext">
                        <!-- <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"> </textarea> -->
                        <input type="text" id="note" name="note" >
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

                    <div class="form-group col-md-4">
                        <!-- <label for="attach_document" class="form-label">Attach Document</label> -->
                        <h6>Attach Document</h6>
                        <input type="file" id="attach_document" name="attach_document">
                        <?php $__errorArgs = ['attach_document'];
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

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Appointment </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


<script>
    function visitWith(visitor_type) {
        $("#visit_to_name").val('');
        var div_data = 'Select One...';

        $.ajax({
            url: "<?php echo e(route('find-staff-by-visitor')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                visitor: visitor_type,
            },

            success: function(response) {
                if (response.staff != null && response.staff != " ") {
                    $.each(response.staff, function(key, value) {
                        div_data += `<option value="${value.id}">${value.first_name} ${value.last_name}</option>`;

                    });
                    $('#visit_to_name').html(div_data);
                }

                if (response.opd != null && response.opd != " ") {
                    $.each(response.opd, function(key, value) {
                        div_data += `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name} </option>`;

                    });
                    $('#visit_to_name').html(div_data);
                }

                if (response.emg != null && response.emg != " ") {
                    $.each(response.emg, function(key, value) {

                        div_data += `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name} </option>`;

                    });
                    $('#visit_to_name').html(div_data);
                }

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/front-office/visit/add-visit-details.blade.php ENDPATH**/ ?>