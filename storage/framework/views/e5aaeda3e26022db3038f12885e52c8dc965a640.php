
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Profile
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" data-placement="top" data-toggle="tooltip" title="Move to IPD" href="<?php echo e(route('ipd-registation-from-emg', ['id' => base64_encode($emg_patient_details->id), 'patient_source' => 'emg', 'source_id' => '$emg_patient_details->id'])); ?>"><i class="fa fa-address-card"></i> Admission</a>

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('emg.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                
                <div class="col-lg-6 col-xl-6 border-right">

                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span class="profileHeding"><?php echo e(@$emg_patient_details->patient_details->first_name); ?>

                                    <?php echo e(@$emg_patient_details->patient_details->middle_name); ?>

                                    <?php echo e(@$emg_patient_details->patient_details->last_name); ?>(<?php echo e(@$emg_patient_details->patient_details->patient_prefix); ?><?php echo e(@$emg_patient_details->patient_details->id); ?>)</span>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-venus-mars text-primary"></i></td>
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
                                    <td class="py-2 px-0"><i class="fa fa-mobile-alt text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Mobile No :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$emg_patient_details->patient_details->phone); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-calendar text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Age :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$emg_patient_details->patient_details->year); ?>Y
                                        <?php echo e(@$emg_patient_details->patient_details->month); ?>M
                                        <?php echo e(@$emg_patient_details->patient_details->day); ?>D
                                    </td>
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
                    </div>
                    

                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Emg Id :- </span>
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

                                        <?php echo e(date('d-m-Y h:i A',strtotime(@$emg_patient_details->all_emg_visit_details->appointment_date))); ?>

                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    

                </div>
                

                
                <div class="col-lg-6 col-xl-6 border-right">
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/emg/emg-patient-profile.blade.php ENDPATH**/ ?>