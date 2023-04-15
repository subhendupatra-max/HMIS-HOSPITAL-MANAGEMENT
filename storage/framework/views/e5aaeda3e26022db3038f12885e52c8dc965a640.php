
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-circle" id="tabs_2" role="tablist">
                    
                    <li class="nav-item">
                        <a class="nav-link border py-2 px-2 m-1"  data-toggle="tab" href="#profile"
                            role="tab" aria-selected="false">
                            <span class="nav-link-icon d-block"><i class="fa fa-th"></i> Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border py-2 px-2 m-1"  data-toggle="tab" href="#billing"
                            role="tab" aria-selected="false">
                            <span class="nav-link-icon d-block"><i class="fa fa-file-alt"></i> Billing </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border py-2 px-2 m-1"  data-toggle="tab" href="#payment"
                            role="tab" aria-selected="false">
                            <span class="nav-link-icon d-block"><i class="fa fa-rupee-sign"></i> Payment </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border py-2 px-2 m-1"  data-toggle="tab" href="#timeline"
                            role="tab" aria-selected="false">
                            <span class="nav-link-icon d-block"><i class="far fa-calendar-check"></i> Timeline </span>
                        </a>
                    </li>
                    

                    
                    <li class="nav-item" style="margin-left: auto;">
                        <a class="btn btn-primary btn-sm" data-placement="top" data-toggle="tooltip" title="Admission"
                            href="<?php echo e(route('ipd-registation-from-emg', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i
                                class="fa fa-address-card"></i></a>
                    </li>
                    
                </ul>

                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="profile">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="profileHeding"><?php echo e(@$emg_patient_details->patient_details->first_name); ?>

                                        <?php echo e(@$emg_patient_details->patient_details->middle_name); ?>

                                        <?php echo e(@$emg_patient_details->patient_details->last_name); ?>(<?php echo e(@$emg_patient_details->patient_details->patient_prefix); ?><?php echo e(@$emg_patient_details->patient_details->id); ?>)</span>
                                    <hr class="hr_line">
                                    <div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table_border_none">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0"><i
                                                                    class="fa fa-venus-mars text-primary"></i></td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Gender :- </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <?php echo e(@$emg_patient_details->patient_details->gender); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0"><i class="fa fa-users text-primary"></i>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Gurdian Name :-
                                                                </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <?php echo e(@$emg_patient_details->patient_details->guardian_name); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0"><i
                                                                    class="fa fa-mobile-alt text-primary"></i></td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Mobile No :- </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <?php echo e(@$emg_patient_details->patient_details->phone); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0"><i
                                                                    class="fa fa-calendar text-primary"></i></td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Age :- </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <?php echo e(@$emg_patient_details->patient_details->year); ?>Y
                                                                <?php echo e(@$emg_patient_details->patient_details->month); ?>M
                                                                <?php echo e(@$emg_patient_details->patient_details->day); ?>D</td>
                                                        </tr>
                                                        <tr colspan="2">
                                                            <td class="py-2 px-0"><i class="fa fa-map-pin text-primary"></i>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Address :- </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <?php echo e(@$emg_patient_details->patient_details->address); ?>,<?php echo e(@$emg_patient_details->patient_state->name); ?>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr class="hr_line">
                                                <table class="table table_border_none" >
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <i class="fa fa-rocket text-primary"></i>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Emergency Id :- </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <?php echo e($emg_patient_details->emg_prefix); ?><?php echo e($emg_patient_details->id); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <i class="fa fa-calendar text-primary"></i>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Appointment Date :- </span>
                                                            </td>
                                                            <td class="py-2 px-0">

                                                                <?php echo e(date('d-m-Y h:i A',strtotime($emg_patient_details->all_emg_visit_details->appointment_date))); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <i class="fa fa-user-secret text-primary"></i>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-semibold w-50">Medico Legal Case :-
                                                                </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                <?php echo e(@$emg_patient_details->all_emg_visit_details->medico_legal_case); ?>

                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="hr_line">
                                <div class="col-md-6 vl_line">
                                    <h5>LAB INVESTIGATION</h5>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Joan Powell</td>
                                                        <td>Associate Developer</td>
                                                        <td>$450,870</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Gavin Gibson</td>
                                                        <td>Account manager</td>
                                                        <td>$230,540</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Julian Kerr</td>
                                                        <td>Senior Javascript Developer</td>
                                                        <td>$55,300</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Cedric Kelly</td>
                                                        <td>Accountant</td>
                                                        <td>$234,100</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">5</th>
                                                        <td>Samantha May</td>
                                                        <td>Junior Technical Author</td>
                                                        <td>$43,198</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        
                        <div class="tab-pane" id="billing">
                            billing
                        </div>
                        

                        
                        <div class="tab-pane" id="payment">
                            payment
                        </div>
                        

                        
                        <div class="tab-pane" id="timeline">
                            timeline
                        </div>
                        
                    </div>
                </div>
                <!-- <div class="new"> -->


            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/emg/emg-patient-profile.blade.php ENDPATH**/ ?>