
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit pathology test')): ?>
                                <a class="btn btn-primary btn-sm mb-2" href="<?php echo e(route('edit-pathology-test-details',['id'=> base64_encode($pathologyTest->id)])); ?>"><i class="fa fa-edit"></i> Edit</a>
                            <?php endif; ?>                       
                                                    
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete pathology test')): ?>
                                <a class="btn btn-primary btn-sm ml-2 mb-2" href="<?php echo e(route('delete-pathology-test-details',['id'=> base64_encode($pathologyTest->id)])); ?>"><i class="fa fa-trash"></i> Delete</a>
                            <?php endif; ?>
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
                        <span class="head_name">Charge Amount</span> :<br> <span
                            class="value_name"> <?php
                            $charge_with_type = DB::table('charges_with_charges_types')
                            ->join('charge_types','charges_with_charges_types.charge_type_id','=','charge_types.id')
                            ->where('charges_with_charges_types.charge_id',$pathologyTest->charge)
                            ->get();
                            if(@$charge_with_type[0]->charge_type_id != null){
                                foreach($charge_with_type as $value){
                                    echo $value->charge_type_name." : ".$value->standard_charges." Rs<br>";
                                }
                            }
                            ?></span>
                    </div>
           
                </div>
                <hr class="ipd_header_border ">
                <div class="row">
                    <?php echo @$pathologyTest->description; ?>

                </div>
                <hr class="ipd_header_border ">
                <?php if(isset($pathologyParameter[0]->parameter_name)): ?>
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
                                    <td><?php echo e(@$value->parameter_name); ?></td>
                                    <td><?php echo @$value->reference_range; ?></td>
                                    <td><?php echo @$value->unit_name; ?></td>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pathology/test/view.blade.php ENDPATH**/ ?>