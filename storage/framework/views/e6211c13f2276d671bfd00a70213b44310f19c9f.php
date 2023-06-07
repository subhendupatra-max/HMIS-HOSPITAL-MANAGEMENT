
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10 card-title">
                    Prescription Details
                </div>
                <div class="col-md-2">
                    <div class="row">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit prescription opd')): ?>
                        <a class="btn btn-primary btn-sm mb-2" href="<?php echo e(route('edit-prescription-in-opd',['id'=> base64_encode($opdPrescription->id),'opd_id' => base64_encode($opd_id) ])); ?>"><i class="fa fa-edit"></i> Edit</a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete prescription opd')): ?>
                        <a class="btn btn-primary btn-sm ml-2 mb-2" href="<?php echo e(route('delete-prescription-in-opd',['id'=> base64_encode($opdPrescription->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr class="ipd_header_border">
            <div class="row">

                <div class="col-md-4">
                    <span class="head_name">Date</span> : <span class="value_name"><?php echo e(@$opdPrescription->prescription_date); ?></span>
                </div>

                <div class="col-md-4">
                    <span class="head_name">Note</span> : <span class="value_name"><?php echo e(@$opdPrescription->note); ?></span>
                </div>

            </div>

            <hr class="ipd_header_border ">
            <?php if(isset($EPrescriptionMedicine[0]->medicine_id)): ?>
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
                        <?php $__currentLoopData = $EPrescriptionMedicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo e(@$value->catagory_name->medicine_catagory_name); ?></td>
                            <td><?php echo @$value->medicine_details->medicine_name; ?></td>
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
            <div class="row com-md-12">

                <div class="col-md-6">
                    <h5> Pathology Tests:</h5>
                    <?php if(isset($EPresPathologyTest[0]->test_id)): ?>
                    <div class="table-responsive mt-5">
                        <table class="table table-striped card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Test Name</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $EPresPathologyTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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
                    <h5> Radiology Tests: </h5>
                    <?php if(isset($EPresRadiologyTest[0]->test_id)): ?>
                    <div class="table-responsive mt-5">
                        <table class="table table-striped card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Test Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $EPresRadiologyTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/OPD/prescription/prescription-view.blade.php ENDPATH**/ ?>