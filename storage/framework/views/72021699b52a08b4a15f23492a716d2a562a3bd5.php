
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold"> Discharge Details</i></h4>
                </div>

                <div class="col-md-6 text-right">

                    <a href="<?php echo e(route('print-discharged-patient-in-ipd',['ipd_id' => base64_encode($ipd_details->id)] )); ?>" class="btn btn-primary btn-sm"><i class="far fa-file"></i> Print Discharge Patient</a>

                    <a href="<?php echo e(route('edit-discharged-patient-in-ipd',['ipd_id' => base64_encode(@$ipd_details->id),'discharge_id' => base64_encode($discharge_patient_details->id) ] )); ?>" class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Edit Discharge Patient</a>

                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <?php echo $__env->make('ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('ipd.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="card-body p-0">
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Discharge Patient Details </h5>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Doctor Name</span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo $discharge_patient_details->doctor_details->first_name; ?> <?php echo $discharge_patient_details->doctor_details->last_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Discharge Date </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo $discharge_patient_details->discharge_date; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Next Appointment Date </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$discharge_patient_details->next_appointment_date); ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Final Diagnosis at the time of Discharge</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$discharge_patient_details->diagnosis_details->diagonasis_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Advice on Discharge</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$discharge_patient_details->dischage_advice); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Discharge Status</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$discharge_patient_details->discharge_status); ?>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <hr class="ipd_header_border ">
                    <?php if(isset($DischargedMedicine[0]->id)): ?>
                    <div class="table-responsive mt-5">
                        <table class="table table-striped card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Medicine Catagory</th>
                                    <th scope="col">Medicine Name</th>
                                    <th scope="col">Dosage</th>
                                    <th scope="col">Dose Interval</th>
                                    <th scope="col">Dose Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $DischargedMedicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e(@$value->medicine_details->medicine_name); ?></td>
                                    <td><?php echo @$value->medicine_details->catagory_name->medicine_catagory_name; ?></td>
                                    <td><?php echo @$value->dose; ?></td>
                                    <td><?php echo @$value->interval; ?></td>
                                    <td><?php echo @$value->duration; ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>

                    <hr class="ipd_header_border ">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <h5 class="font-weight-bold">Pathology Tests: </h5>
                            <?php if(isset($DischargedPathologyTest[0]->test_id)): ?>
                            <div class="table-responsive mt-5">
                                <table class="table table-striped card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Test Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $DischargedPathologyTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo @$value->test_details->test_name; ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h5 class="font-weight-bold"> Radiology Tests: </h5>
                            <?php if(isset($DischargedRadiologyTest[0]->test_id)): ?>
                            <div class="table-responsive mt-5">
                                <table class="table table-striped card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Test Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $DischargedRadiologyTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo @$value->test_details_radiology->test_name; ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/ipd/discharge-patient/discharge-patient-details.blade.php ENDPATH**/ ?>