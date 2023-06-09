
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title"> Discharged Patient List </h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?> -->
                        <!-- <a href="<?php echo e(route('all-discharged-patient-in-ipd')); ?>" class="btn btn-primary btn-sm"><i class="fa-sharp fa-light fa-cart-flatbed-suitcase"></i>
                            Discharged Patient</a> -->
                        <!-- <?php endif; ?> -->

                    </div>
                </div>
            </div>

        </div>
        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap" id="example">
                    <thead>
                        <tr>
                            <th scope="col">SL No.</th>
                            <th scope="col">IPD Id</th>
                            <th scope="col">Case Id</th>
                            <th scope="col">Patient Information</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Admission Information</th>
                            <th scope="col">Admission Date</th>
                            <th scope="col">Discharged Date</th>
                            <th scope="col">Discharged Status</th>
                            <th scope="col">Admitted By</th>
                            <th scope="col">Status</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($ipd_patient_list)): ?>
                        <?php $__currentLoopData = $ipd_patient_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $discharged_status = DB::table('discharged_patients')->where('ipd_id',$value->id)->first(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
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
                                <?php echo e(date('d-m-Y h:i A',strtotime($value->appointment_date))); ?>

                            </td>
                            <td>
                                <?php echo e(date('d-m-Y h:i A',strtotime($value->discharged_date))); ?>

                            </td>
                            <td>
                                <?php echo e($discharged_status->discharge_status); ?>

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
                         
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/Ipd/discharge-patient/all-discharge-patient-listing.blade.php ENDPATH**/ ?>