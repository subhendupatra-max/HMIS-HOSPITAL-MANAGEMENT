
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Pathology Test
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-pathology-test-to-a-patient')): ?>
                        <a href="<?php echo e(route('add-pathology-test-to-a-patient')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology test')): ?>
                        <a href="<?php echo e(route('pathology-test-list')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-vials"></i> Pathology Test </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology test master')): ?>
                        <a href="<?php echo e(route('pathology-test-master-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-mortar-pestle"></i> Test Master </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Patient Details</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Test Name</th>
                                <th class="border-bottom-0">Case Id</th>
                                <th class="border-bottom-0">Section</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Billing Status</th>
                                <th class="border-bottom-0">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$pathology_patient_test): ?>
                            <?php $__currentLoopData = $pathology_patient_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            if ($value->section == 'OPD') {
                                $opd_details = DB::table('opd_details')->where('case_id', $value->case_id)->first();
                                $section_id = $opd_details->id;
                            }
                            if ($value->section == 'IPD') {
                                $ipd_details = DB::table('ipd_details')->where('case_id', $value->case_id)->first();
                                $section_id = $ipd_details->id;
                            }
                            if ($value->section == 'EMG') {
                                $opd_details = DB::table('emg_details')->where('case_id', $value->case_id)->first();
                                $section_id = $emg_details->id;
                            }
                            ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>

                                <td><?php echo e(@$value->all_patient_details->prefix); ?> <?php echo e(@$value->all_patient_details->first_name); ?> <?php echo e(@$value->all_patient_details->middle_name); ?> <?php echo e(@$value->all_patient_details->last_name); ?>(<?php echo e(@$value->all_patient_details->id); ?>)</td>

                                <td><?php echo e(@date('d-m-Y h:i A', strtotime($value->date))); ?></td>

                                <td><?php echo e(@$value->test_details->test_name); ?></td>
                                <td><?php echo e(@$value->case_id); ?></td>
                                <td><a class="textlink" href="<?php echo e(route('opd-profile', ['id' => base64_encode($section_id)])); ?>"><?php echo e(@$value->section); ?>(<?php echo e(@$section_id); ?>)</a>
                                </td>
                                <td><?php echo e(@$value->generator_details->first_name); ?> <?php echo e(@$value->generator_details->last_name); ?></td>

                                <td>
                                    <?php if($value->billing_status == '0'): ?>
                                    <span class="badge badge-warning">Billing Not Done</span>
                                    <?php elseif($value->billing_status == '1'): ?>
                                    <span class="badge badge-warning">Billing Done</span>
                                    <?php else: ?>
                                    <span class="badge badge-warning">Charge Added</span>
                                    <?php endif; ?>
                                </td> 
                                <td>
                                    <?php if($value->test_status == '0'): ?>
                                    <span class="badge badge-warning">Sample Not Collected</span>
                                    <?php else: ?>
                                    <span class="badge badge-success">Sample Collected</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="<?php echo e(route('opd-bill-details', ['bill_id' => base64_encode($value->id)])); ?>">
                                                <i class="fa fa-eye"></i> View
                                            </a>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-pathology-test-to-a-patient')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-pathology-test-patient',['id'=>base64_encode($value->id)])); ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-pathology-test-to-a-patient')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-pathology-test-patient',['id'=>base64_encode($value->id)])); ?>">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pathology/patient-test/patient-test-list.blade.php ENDPATH**/ ?>