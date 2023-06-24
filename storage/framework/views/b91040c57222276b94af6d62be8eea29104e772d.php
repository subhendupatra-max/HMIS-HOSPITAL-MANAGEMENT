
<?php $__env->startSection('content'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Income Report</div>
            </div>
            <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-md-12 border-right">
                                <form method="POST" action="<?php echo e(route('fetch-payment-report')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="payment_mode">Payment Mode <span
                                                        class="text-danger">*</span></label>
                                                <select name="payment_mode" class="form-control select2-show-search"
                                                    id="payment_mode">
                                                    <option value="">Select Payment Mode....</option>
                                                    <?php $__currentLoopData = Config::get('static.payment_mode_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $payment_mode_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($payment_mode_name); ?>"
                                                            <?php echo e(@$payment_mode_name == @$all_search_data['payment_mode'] ? 'selected' : ''); ?>>
                                                            <?php echo e($payment_mode_name); ?>

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
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="section"> Section <span class="text-danger">*</span></label>
                                                <select name="section" class="form-control select2-show-search"
                                                    id="section">
                                                    <option value="">Select Section....</option>
                                                    <option value="IPD"
                                                        <?php echo e(@$all_search_data['payment_mode'] == 'IPD' ? 'selected' : ''); ?>>
                                                        IPD</option>
                                                    <option value="OPD"
                                                        <?php echo e(@$all_search_data['payment_mode'] == 'OPD' ? 'selected' : ''); ?>>
                                                        OPD</option>
                                                    <option value="EMG"
                                                        <?php echo e(@$all_search_data['payment_mode'] == 'EMG' ? 'selected' : ''); ?>>
                                                        EMG</option>
                                                </select>
                                                <?php $__errorArgs = ['section'];
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
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="collected_by">Collected By </label>
                                                <select name="collected_by" class="form-control select2-show-search"
                                                    id="collected_by">
                                                    <option value="">Select Collected By </option>
                                                    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($users->id); ?>"
                                                            <?php echo e(@$all_search_data['collected_by'] == $users->id ? 'selected' : ''); ?>>
                                                            <?php echo e($users->first_name); ?> <?php echo e($users->last_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['collected_by'];
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
                                                <input type="datetime-local" name="from_date"
                                                    value="<?php echo e(date(@$all_search_data['from_date'])); ?>" required />
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
                                                <input type="datetime-local" name="to_date"
                                                    value="<?php echo e(date(@$all_search_data['to_date'])); ?>" required />
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
                                    <th scope="col"> Date</th>
                                    <th scope="col"> Mode</th>
                                    <th scope="col"> Received By</th>
                                    <th scope="col">Section</th>
                                    <th scope="col"> Amount(Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php if(@$payment_report[0]->id != null): ?>
                                    <?php $__currentLoopData = $payment_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i += intval($value->payment_amount); ?>
                                        <tr>
                                            <td><?php echo e(date('d-m-Y h:i A', strtotime(@$value->payment_date))); ?></td>

                                            <td><?php echo e(@$value->payment_mode); ?></td>
                                            <td><?php echo e(@$value->generated_by->first_name); ?>

                                                <?php echo e(@$value->generated_by->last_name); ?></td>
                                            <td>
                                                <?php echo e(@$value->section); ?>

                                            </td>
                                            <td><?php echo e(@$value->payment_amount); ?></td>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/report/payment_report.blade.php ENDPATH**/ ?>