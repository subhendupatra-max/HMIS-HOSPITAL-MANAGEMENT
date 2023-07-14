
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">IPD Patient List </h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ipd Admission')): ?>
                        <a href="<?php echo e(route('direct-ipd-admission')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-bed"></i>
                            Admission</a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Discharged Patient List')): ?>
                        <a href="<?php echo e(route('all-discharged-patient-in-ipd')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i>
                            Discharged Patient</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header d-block">
            <form action="<?php echo e(route('ipd-patient-listing')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-3 card-title">
                        <input type="text" name="patient_first_name" value="<?php echo e(@$request_data['patient_first_name']); ?>" placeholder="Search By Patient Name ....." />
                    </div>
                    <div class="col-md-2 card-title">
                        <input type="text" name="patient_uhid"  value="<?php echo e(@$request_data['patient_uhid']); ?>" placeholder="Search By Patient UHID ....." />
                    </div>
                    <div class="col-md-1 card-title">
                        <input type="text" name="patient_phone_no"  value="<?php echo e(@$request_data['patient_phone_no']); ?>" placeholder="Phone No ....." />
                    </div>
                    <div class="col-md-1 card-title">
                        <input type="text" name="ipd_id"  value="<?php echo e(@$request_data['ipd_id']); ?>" placeholder="IPD Id ....." />
                    </div>
                    <div class="col-md-1 card-title">
                        <input type="text" name="case_id"  value="<?php if(@$request_data['case_id'] != null): ?><?php echo e($request_data['case_id']); ?> <?php endif; ?>" placeholder="Case Id ....." />
                    </div>
                    <div class="col-md-2 card-title">
                        <input type="date" style="margin: 6px 0px 0px 0px" name="appointment_date"  value="<?php echo e(@$request_data['appointment_date']); ?>" />
                    </div>
                    <div class="col-md-2 card-title">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> Search</button>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('ipd-patient-listing')); ?>"><i class="fa fa-list"></i> All List</a>
                    </div>
                </div>
            </form>
        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover card-table table-vcenter text-nowrap border-left border-right border-bottom">
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                            <th class="text-white">IPD Id</th>
                            <th class="text-white">Case Id</th>
                            <th class="text-white">Patient Details</th>
                            <th class="text-white">Mobile No.</th>
                            <th class="text-white">Admission Details</th>
                            <th class="text-white">Patient Type</th>
                            <th class="text-white">Admission Date</th>
                            <th class="text-white">Admitted By</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$ipd_patient_list[0]->id != null): ?>
                        <?php $__currentLoopData = $ipd_patient_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a class="textlink" href="<?php echo e(route('ipd-profile',['id'=>base64_encode($value->id)])); ?>"><?php echo e(@$value->id); ?></a></td>
                            <td><?php echo e(@$value->case_id); ?></td>
                            <td>
                                <i class="fa fa-user text-primary"></i> <?php echo e(@$value->all_patient_details->prefix); ?> <?php echo e(@$value->all_patient_details->first_name); ?> <?php echo e(@$value->all_patient_details->middle_name); ?> <?php echo e(@$value->all_patient_details->last_name); ?>(<?php echo e(@$value->all_patient_details->id); ?>)
                                <br>
                                <i class="fa fa-users text-primary"></i>
                                <?php echo e(@$value->all_patient_details->guardian_name); ?>

                                <br>
                                <i class="fa fa-venus-mars text-primary"></i> <?php echo e(@$value->all_patient_details->gender); ?>

                                //
                                <i class="fa fa-calendar-plus-o text-primary"></i> <?php echo e(@$value->all_patient_details->year); ?>Y <?php echo e(@$value->all_patient_details->month); ?>M <?php echo e(@$value->all_patient_details->day); ?>D

                            </td>
                            <td><?php echo e(@$value->all_patient_details->phone); ?></td>
                            <td>
                                <?php if(isset($value->department_id)): ?>
                                <i class="fa fa-cubes text-primary"></i> <?php echo e(@$value->department_details->department_name); ?>( <?php echo e(@$value->department_details->department_code); ?>) <br>
                                <?php endif; ?>
                                <?php if(isset($value->cons_doctor)): ?>
                                <i class="fas fa-user-md text-primary"></i> <?php echo e(@$value->doctor_details->first_name); ?> <?php echo e(@$value->doctor_details->last_name); ?> <br>
                                <?php endif; ?>
                                <?php if(isset($value->bed_ward_id)): ?>
                                <i class="fa fa-bed text-primary"></i> <?php echo e(@$value->bed_details->bed_name); ?> - <?php echo e(@$value->ward_details->ward_name); ?> - <?php echo e(@$value->unit_details->bedUnit_name); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <i class="fa fa-adjust text-primary"></i> <?php echo e(@$value->patient_type); ?>

                                <?php if(@$value->tpa_organization != null): ?>
                                <br>
                                <i class="fa fa-adjust text-primary"></i> <?php echo e(@$value->tpa_details->TPA_name); ?>

                                <?php endif; ?>
                               
                                <?php if(@$value->type_no != null): ?>
                                <br>
                                <i class="fa fa-adjust text-primary"></i> <?php echo e(@$value->type_no); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(date('d-m-Y h:i A',strtotime($value->appointment_date))); ?>

                            </td>
                            <td>
                                <?php echo e(@$value->admitted_by); ?><br>
                                <?php echo e(@$value->admitted_by_contact_no); ?>

                            </td>
                            <td>
                                <?php if($value->status == 'admitted'): ?>
                                <span class="badge badge-success">Admission</span>
                                <?php elseif($value->status == 'discharged_planed'): ?>
                                <span class="badge badge-warning">Discharge Planed</span>
                                <?php else: ?>
                                <span class="badge badge-secondary">Discharged</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href="<?php echo e(route('ipd-profile',['id'=>base64_encode($value->id)])); ?>"><i class="fa fa-eye"></i> View</a>
                                        
                                        
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>

                                        <a class="dropdown-item" href="<?php echo e(route('edit-ipd-registation',['ipd_id'=>base64_encode($value->id) ])); ?>">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ipd delete')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('ipd-patient-delete',['ipd_id'=>base64_encode($value->id) ])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">
                                <img src="<?php echo e(asset('public/no_found_data/no_data.png')); ?>" alt="loader" width="400px"
                                height="160px">
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="mt-2">
                    <?php echo $ipd_patient_list->links(); ?>

                </div> 
            </div>
        </div>

    </div>
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Patient Status Change
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('update-status-ipd')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="ipd_id" id="ipd_id_" />
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select......</option>
                                <option value="discharged_planed">Discharged Planed</option>
                            </select>
                            <?php $__errorArgs = ['status'];
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

                        <div class="form-group col-md-12">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" required>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    function statusButton(ipd_id) {
        $.ajax({
            url: "<?php echo e(route('ipd-patient-status-change')); ?>",
            type: "POST",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                ipdId: ipd_id,
            },
            success: function(response) {
                console.log(response);
                $("#ipd_id_").val(response.id);
                $("#exampleModal").modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Ipd/ipd-patients-details.blade.php ENDPATH**/ ?>