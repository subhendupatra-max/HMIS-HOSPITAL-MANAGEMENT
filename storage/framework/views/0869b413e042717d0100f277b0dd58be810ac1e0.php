
<?php $__env->startSection('content'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Referral Commission Report</div>
            </div>
            <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-md-12 border-right">
                                <form method="POST" action="<?php echo e(route('fetch-referral-payment-report')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="payment_mode">Referrar Name <span
                                                        class="text-danger">*</span></label>
                                                <select name="referrar_name" class="form-control select2-show-search"
                                                    id="referrar_name">
                                                    <option value="">Select Referrar Name....</option>
                                                    <?php $__currentLoopData = $referer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($value->id); ?>" <?php echo e(@$all_search_data['referrar_name'] == $value->id ? 'selected':''); ?>>
                                                            <?php echo e($value->referral_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['payment_mode'];
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
                                          
                                            <div class="form-group col-md-4 addopdd">
                                                <label>From Date <span class="text-danger">*</span></label>
                                                <input type="date" value="<?php echo e(date('Y-m-d',strtotime($all_search_data['from_date']))); ?>" name="from_date"
                                                    required />
                                                <?php $__errorArgs = ['from_date'];
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

                                            <div class="form-group col-md-4 addopdd ">
                                                <label>To Date <span class="text-danger">*</span></label>
                                                <input type="date" name="to_date"
                                                    value="<?php echo e(date('Y-m-d',strtotime($all_search_data['to_date']))); ?>" required />
                                                <?php $__errorArgs = ['to_date'];
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
                                    <div class="row">
                                        <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i
                                                class="fa fa-search"></i> Search</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Patient Details</th>
                                    <th scope="col">Bill Id</th>
                                    <th scope="col">Bill Amount</th>
                                    <th scope="col">Commission Amount(Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php if(@$referral_payment_details[0]->id != null): ?>
                                    <?php $__currentLoopData = $referral_payment_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i += intval($value->commission_amount); ?>
                                        <tr>
                                            <td><?php echo e(date('d-m-Y h:i A', strtotime(@$value->date))); ?></td>
                                            <td>
                                                <?php echo e(@$value->all_patient_details->prefix); ?> <?php echo e(@$value->all_patient_details->first_name); ?> <?php echo e(@$value->all_patient_details->middle_name); ?> <?php echo e(@$value->all_patient_details->last_name); ?><br>
                                                <?php echo e(@$value->all_patient_details->patient_prefix); ?><?php echo e(@$value->all_patient_details->id); ?>

                                            </td>
                                            <td><?php echo e(@$value->bill_id); ?></td>
                                            <td><?php echo e(@$value->bill_amount); ?></td>
                                            <td><?php echo e(@$value->commission_amount); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </tbody>
                        </table>

                    </div>
                </div>
           <div class="">
            <div class="container mt-5" style="margin-left: 57px;">
                <div class="d-flex justify-content-end">
                    <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                        </span>
                        <span class="bilpo_name"><?php echo e(@$i); ?></span>
                </div>
              
                

            </div>
           </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/report/referral-report.blade.php ENDPATH**/ ?>