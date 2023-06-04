
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Radiology Test
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-radiology-test-to-a-patient')): ?>
                        <a href="<?php echo e(route('add-radiology-test-to-a-patient')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add </a>
                        <?php endif; ?> 

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology test')): ?>
                        <a href="<?php echo e(route('radiology-test-list')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-vials"></i> Radiology Test </a>
                        <?php endif; ?> -->

                        


                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology test master')): ?>
                        <a href="<?php echo e(route('radiology-test-list')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-mortar-pestle"></i> Radiology Test </a>
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
                                
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Report</th>
                                <th class="border-bottom-0">Print</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(@$radiology_patient_test): ?>
                            <?php $__currentLoopData = $radiology_patient_test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                $emg_details = DB::table('emg_details')->where('case_id', $value->case_id)->first();
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
                                    <?php if($value->test_status == '0'): ?>
                                    
                                    <span class="badge badge-warning" onclick="sample_collection(<?php echo e($value->id); ?>)" >Sample Not Collected</span>
                                    <?php elseif($value->test_status == '1'): ?>
                                    <span class="badge badge-success" onclick="sample_collection(<?php echo e($value->id); ?>)">Sample Collected</span>
                                    <?php elseif($value->test_status == '2'): ?>
                                    <span class="badge badge-success" onclick="sample_collection(<?php echo e($value->id); ?>)">Sample Collection inconplete</span>
                                    <?php else: ?>
                                    <span class="badge badge-success" onclick="sample_collection(<?php echo e($value->id); ?>)">Report Done</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($value->test_status == '1' || $value->test_status == '2' || $value->test_status == '3'): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add radiology test result details')): ?>
                                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('add-radiology-test-result-details', ['id' => base64_encode($value->id)])); ?>">
                                        <i class="fa fa-eye"></i> Add Result
                                    </a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($value->test_status == '3'): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print radiology result')): ?>
                                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('print-radiology-result', ['id' => base64_encode($value->id)])); ?>">
                                        <i class="fa fa-print"></i> Print Report
                                    </a>
                                    <?php endif; ?>
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
<div class="modal" id="modaldemo2">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Sample Collection</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?php echo e(route('change-sample-status-radiology')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input name="id" type="hidden" id="p_id" />
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <select name="sample_status" class="form-control select2-show-search">
                                <option value="0">Sample Not Collected</option>
                                <option value="1">Sample Collected</option>
                                <option value="2">Sample Collection incomplete</option>
                                <option value="3">Report Done</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary text-right" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function sample_collection(p_id)
    {
            $('#p_id').val(p_id);
            $('#modaldemo2').modal('show');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/radiology/patient-test/patient-test-list.blade.php ENDPATH**/ ?>