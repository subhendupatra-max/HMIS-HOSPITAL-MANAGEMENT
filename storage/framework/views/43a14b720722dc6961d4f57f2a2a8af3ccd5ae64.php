
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Referral Payment </h4>
        </div>
    <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                action="<?php echo e(route('referral-commission-save')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="reference" class="form-label">Referrel Name</label>
                                    <select name="reference" onchange="getPatientName(this.value)" class="form-control select2-show-search" id="reference">
                                        <option value="">Referrel Name</option>
                                        <?php $__currentLoopData = $referer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($reference->id); ?>"> <?php echo e($reference->referral_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="patient_details" class="form-label">Patient Name</label>
                                    <select name="patient_details" onchange="getBill(this.value)" class="form-control select2-show-search" id="patient_details">
                                        <option value="">Patient Name</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="bill_id" class="form-label">Bill Id</label>
                                    <select name="bill_id" onchange="getBillDetails(this.value)" class="form-control select2-show-search" id="bill_id">
                                        <option value="">Bill Id...</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="bill_amount" class="form-label">Bill Amount</label>
                                    <input type="text" name="bill_amount"  id="bill_amount" />
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="commission_amount" class="form-label">Commission Amount</label>
                                    <input type="text" name="commission_amount"  id="commission_amount" />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Add Referral Payment</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function getPatientName(value){
        $('#patient_details').html('<option value="">Select One...</option>');
        var div_data = '';
        $.ajax({
            url: "<?php echo e(route('get-patient-by-referral')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                referralId: value,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    div_data += `<option value="${value.patient_id}">${value.prefix} ${value.first_name} ${value.middle_name} ${value.last_name} ( UHID : ${value.patient_id} )</option>`;
                });
                $('#patient_details').append(div_data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getBill(value){
        $('#bill_id').html('<option value="">Select One...</option>');
        var div_data = '';
        $.ajax({
            url: "<?php echo e(route('get-bill-by-patient-id')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                p_Id: value,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    div_data += `<option value="${value.id}">${value.id}</option>`;
                });
                $('#bill_id').append(div_data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

     function getBillDetails(bill_id)
    {
        $.ajax({
            url: "<?php echo e(route('get-bill-amount-by-bill-id')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                billId: bill_id,
            },
            success: function(response) {
                console.log(response);
                $('#bill_amount').val(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>



<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/referral/referral-payment-add.blade.php ENDPATH**/ ?>