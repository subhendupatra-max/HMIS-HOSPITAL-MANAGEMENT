
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <span class="head_name">Test Name</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->test_name); ?></span>
                    </div>
                    <div class="col-md-2">
                        <div class="row">

                                <a class="btn btn-primary btn-sm mb-2" href=""><i class="fa fa-edit"></i> Edit</a>

                                <a class="btn btn-primary btn-sm ml-2 mb-2" href=""><i class="fa fa-trash"></i> Delete</a>

                        </div>
                    </div>
                </div>
                <hr class="ipd_header_border">
                <div class="row">
                    <div class="col-md-4">
                        <span class="head_name">Test Type</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->test_type); ?></span>
                    </div>

                    <div class="col-md-4">
                        <span class="head_name">Category</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->pathology_catagory->catagory_name); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name"> Sub Catagory</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->sub_catagory); ?></span>
                    </div>



                    <div class="col-md-4">
                        <span class="head_name">Method</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->method); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name">Report Days</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->report_days); ?></span>
                    </div>


                    <div class="col-md-4">
                        <span class="head_name">Charges Catagory </span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->charges_catagory->charges_catagories_name); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name">Charges Sub Catagory</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->charges_sub_catagory->charges_sub_catagories_name); ?></span>
                    </div>


                    <div class="col-md-4">
                        <span class="head_name">Charges</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->charges->charges_name); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name">Tax</span> : <span class="value_name"><?php echo e(@$pathologyTest->tax); ?></span>
                    </div>


                    <div class="col-md-4">
                        <span class="head_name">Charge Amount</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->standard_charges); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name">Total Amount</span> : <span
                            class="value_name"><?php echo e(@$pathologyTest->total_amount); ?></span>
                    </div>
                </div>
                <hr class="ipd_header_border ">
                <div class="row">
                    <?php echo @$pathologyTest->test_details; ?>

                </div>
                <hr class="ipd_header_border ">
                <?php if(isset($value->test_parameter_name[0]->parameter_name)): ?>
                <div class="table-responsive mt-5">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Test Parameter Name</th>
                                <th scope="col">Reference Range</th>
                                <th scope="col">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pathologyParameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$value->test_parameter_name->parameter_name); ?></td>
                                    <td><?php echo @$value->test_parameter_name->reference_range; ?></td>
                                    <td><?php echo @$value->test_parameter_name->unitName->unit_name; ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/pathology/test-master/pathology-test-details.blade.php ENDPATH**/ ?>