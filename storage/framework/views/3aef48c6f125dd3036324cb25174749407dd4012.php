<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Emg Patient List </h4>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('emg registation')): ?>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i class="fa fa-plus"></i> Emg Registaion</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Emg Id</th>
                            <th scope="col">Patient</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">G. Name/P. Type</th>
                            <th scope="col">Medico Legal Case</th>
                            <th scope="col">Appointment Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($emg_registaion_list)): ?>
                            <?php $__currentLoopData = $emg_registaion_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><a class="textlink" href="<?php echo e(route('emg-patient-profile',['id'=>base64_encode($value->id)])); ?>" ><?php echo e(@$value->emg_prefix); ?><?php echo e(@$value->id); ?></a></td>
                                    <td>
                                        <?php echo e(@$value->all_patient_details->prefix); ?> <?php echo e(@$value->all_patient_details->first_name); ?> <?php echo e(@$value->all_patient_details->middle_name); ?> <?php echo e(@$value->all_patient_details->last_name); ?> (<?php echo e(@$value->all_patient_details->id); ?>)<br>
                                        <i class="fa fa-venus-mars text-primary"></i> <?php echo e(@$value->all_patient_details->gender); ?>   <i class="fa fa-calendar-plus-o text-primary"></i> <?php echo e(@$value->all_patient_details->year); ?>Y <?php echo e(@$value->all_patient_details->month); ?>M <?php echo e(@$value->all_patient_details->day); ?>D
                                    </td>
                                    <td><?php echo e(@$value->all_patient_details->phone); ?></td>
                                    <td>
                                        <i class="fa fa-user-secret text-primary"></i> <?php echo e(@$value->all_patient_details->guardian_name); ?><br>
                                        <i class="fa fa-adjust text-primary"></i> <?php echo e(@$value->all_emg_visit_details->patient_type); ?>

                                    </td>
                                    <td><?php echo e(@$value->all_emg_visit_details->medico_legal_case); ?></td>
                                    <td>
                                        <?php if(isset($value->all_emg_visit_details->appointment_date)): ?>
                                        <?php echo e(date('d-m-Y h:i A',strtotime($value->all_emg_visit_details->appointment_date))); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">

                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('emg-patient-profile',['id'=>base64_encode($value->id)])); ?>"><i class="fa fa-eye"></i> View</a>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                                    <a class="dropdown-item"
                                                        href="">
                                                        <i class="fa fa-edit"></i> Edit</a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete patient')): ?>
                                                    <a class="dropdown-item"
                                                        href=""><i
                                                            class="fa fa-trash"></i> Delete</a>
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

    <div class="modal" id="modaldemo2">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Select New / Old Patient</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?php echo e(route('emg-after-new-old')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="patient_type" value="new_patient">
						<span class="custom-control-label" Style="color:rgb(7, 73, 1);font-weight: 500;font-size: 14px;">New Patient</span>
					</label>
                    <label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="patient_type" value="old_patient">
						<span class="custom-control-label" Style="color:brown;font-weight: 500;
                        font-size: 14px;">Old Patient</span>
					</label>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary text-right" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/emg/emg-patient-list.blade.php ENDPATH**/ ?>