
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">OPD Patient List </h4>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('OPD registation')): ?>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i
                                class="fa fa-plus"></i> OPD Registation</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <table class="table table-bordered text-nowrap" id="example">
                <thead>
                    <tr>
                        <th scope="col">OPD Id</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Gurdian Name</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Case Id</th>
                        <th scope="col">Last Visit Details</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($opd_registaion_list)): ?>
                    <?php $__currentLoopData = $opd_registaion_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a class="textlink"
                                href="<?php echo e(route('opd-profile', ['id' => base64_encode($value->id)])); ?>"><?php echo e(@$value->id); ?></a>
                        </td>
                        <td>
                            <?php echo e(@$value->all_patient_details->prefix); ?>

                            <?php echo e(@$value->all_patient_details->first_name); ?>

                            <?php echo e(@$value->all_patient_details->middle_name); ?>

                            <?php echo e(@$value->all_patient_details->last_name); ?>(<?php echo e(@$value->all_patient_details->id); ?>)<br>
                            <i class="fa fa-venus-mars text-primary"></i>
                            <?php echo e(@$value->all_patient_details->gender); ?> <i
                                class="fa fa-calendar-plus-o text-primary"></i>
                            <?php if(@$value->all_patient_details->year != 0): ?>
                            <?php echo e(@$value->all_patient_details->year); ?>y
                            <?php endif; ?>
                            <?php if(@$value->all_patient_details->month != 0): ?>
                            <?php echo e(@$value->all_patient_details->month); ?>m
                            <?php endif; ?>
                            <?php if(@$value->all_patient_details->day != 0): ?>
                            <?php echo e(@$value->all_patient_details->day); ?>d
                            <?php endif; ?>

                        </td>
                        <td><?php echo e(@$value->all_patient_details->guardian_name); ?></td>
                        <td><?php echo e(@$value->all_patient_details->phone); ?></td>
                        <td><?php echo e(@$value->case_id); ?></td>
                        <td>
                            <?php if(isset($value->latest_opd_visit_details_for_patient->department_id)): ?>
                            <i class="fa fa-cubes text-primary"></i>
                            <?php echo e(@$value->latest_opd_visit_details_for_patient->department_details->department_name); ?>

                            <br>
                            <?php endif; ?>
                            <?php if(isset($value->latest_opd_visit_details_for_patient->cons_doctor)): ?>
                            <i class="fas fa-user-md text-primary"></i>
                            <?php echo e(@$value->latest_opd_visit_details_for_patient->doctor->first_name); ?>

                            <?php echo e(@$value->latest_opd_visit_details_for_patient->doctor->last_name); ?><br>
                            <?php endif; ?>
                            <?php if(isset($value->latest_opd_visit_details_for_patient->appointment_date)): ?>
                            <i class="fa fa-calendar text-primary"></i>
                            <?php echo e(date('d-m-Y h:i A',
                            strtotime($value->latest_opd_visit_details_for_patient->appointment_date))); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <a class="dropdown-item" href=""><i class="fa fa-file"></i> Bill Summary</a>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('opd-profile', ['id' => base64_encode($value->id)])); ?>"><i
                                            class="fa fa-eye"></i> View</a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit opd patient')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('edit-opd-patient', base64_encode($value->id))); ?>">
                                        <i class="fa fa-edit"></i> Edit</a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete opd patient')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('delete-opd-patient', base64_encode(@$value->latest_opd_visit_details_for_patient->id))); ?>"><i class="fa fa-trash"></i>
                                        Delete</a>
                                    <?php endif; ?>
                                  
                                    <a class="dropdown-item" href="<?php echo e(route('print-opd-patient', base64_encode(@$value->latest_opd_visit_details_for_patient->id))); ?>"><i class="fa fa-print"></i>
                                        Print</a>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd billing')): ?>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('add-opd-billing',['id'=> base64_encode($value->id)])); ?>"><i
                                            class="fa fa-money-bill"></i>
                                        Add Billing</a>
                                    <?php endif; ?>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('payment-listing-in-opd', ['id' => base64_encode($value->id)])); ?>"><i
                                            class="fa fa-rupee-sign"></i>Take Payment</a>

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

<div class="modal" id="modaldemo2">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Select New / Old Patient</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?php echo e(route('after-new-old')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="patient_type" value="new_patient">
                        <span class="custom-control-label"
                            Style="color:rgb(7, 73, 1);font-weight: 500;font-size: 14px;">New Patient</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="patient_type" value="old_patient">
                        <span class="custom-control-label" Style="color:brown;font-weight: 500;
                        font-size: 14px;">Old
                            Patient</span>
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/OPD/opd-patient-list.blade.php ENDPATH**/ ?>