
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Profile
                </div>
                <div class="col-md-8 text-right">

                    <div class="d-block">
                        <a href="<?php echo e(route('print-ipd-addmission-form',['ipd_id' => base64_encode(@$ipd_details->id)] )); ?>" class="btn btn-primary btn-sm"><i class="far fa-calendar-check"></i> Admission Form</a>

                        <?php if($ipd_details->discharged == 'no'): ?>
                        <a href="<?php echo e(route('discharged-patient-in-ipd',['ipd_id' => base64_encode(@$ipd_details->id)] )); ?>" class="btn btn-primary btn-sm"><i class="far fa-calendar-check"></i> Discharged Patient</a>
                        <?php endif; ?>

                        <?php if($ipd_details->discharged == 'yes'): ?>

                        <a href="<?php echo e(route('details-discharged-patient-in-ipd',['ipd_id' => base64_encode($ipd_details->id)] )); ?>" class="btn btn-primary btn-sm"><i class="far fa-file"></i> Discharge Details</a>
                        <?php endif; ?>

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <?php echo $__env->make('Ipd.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('Ipd.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                
                <div class="col-lg-4 col-xl-4 border-right">

                    
                    <!-- <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span class="profileHeding"><?php echo e(@$ipd_details->all_patient_details->first_name); ?>

                                    <?php echo e(@$ipd_details->all_patient_details->middle_name); ?>

                                    <?php echo e(@$ipd_details->all_patient_details->last_name); ?>(<?php echo e(@$ipd_details->all_patient_details->patient_prefix); ?><?php echo e(@$ipd_details->all_patient_details->id); ?>)</span>
                            </div>
                        </div>
                    </div> -->
                    

                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-venus-mars text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Gender :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->all_patient_details->gender); ?>

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
                                        <?php echo e(@$ipd_details->all_patient_details->guardian_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-mobile-alt text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Mobile No :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->all_patient_details->phone); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-calendar text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Age :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->all_patient_details->year); ?>Y
                                        <?php echo e(@$ipd_details->all_patient_details->month); ?>M
                                        <?php echo e(@$ipd_details->all_patient_details->day); ?>D
                                    </td>
                                </tr>
                                <tr colspan="2">
                                    <td class="py-2 px-0"><i class="fa fa-map-pin text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Address :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->all_patient_details->address); ?>,<?php echo e(@$ipd_details->patient_state->name); ?>

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
                                        <span class="font-weight-semibold w-50">IPD Id :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e($ipd_details->ipd_prefix); ?><?php echo e($ipd_details->id); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Department :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->department_details->department_name); ?>( <?php echo e(@$ipd_details->department_details->department_code); ?>)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fas fa-user-md text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Doctor :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->doctor_details->first_name); ?>

                                        <?php echo e(@$ipd_details->doctor_details->last_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-bed text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Bed :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e($ipd_details->bed_details->bed_name); ?> -
                                        <?php echo e($ipd_details->unit_details->bedUnit_name); ?> -
                                        <?php echo e($ipd_details->ward_details->ward_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-users text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Admitted By :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->department_details->admitted_by); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Admitted By Contact No. :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$ipd_details->department_details->admitted_by_contact_no); ?>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <span style="font-weight: bold; font-size: 15px;">Latest Physical Condition</span>
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Height :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$PhysicalDetails->height == null ?'':$PhysicalDetails->height.' cm'); ?>

                                    </td>

                                    <td class="py-2 px-0">
                                        <i class="fa fa-weight text-primary"></i>

                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Weight :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$PhysicalDetails->weight == null ?'':$PhysicalDetails->weight.' kg'); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Pulse :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$PhysicalDetails->pulse == null ?'':$PhysicalDetails->pulse.' bpm'); ?>

                                    </td>

                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">BP :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$PhysicalDetails->bp == null ?'':$PhysicalDetails->bp.' mmHg'); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Temp :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$PhysicalDetails->temperature == null ?'':$PhysicalDetails->temperature.'
                                        °C'); ?>

                                    </td>

                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Resp :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        <?php echo e(@$PhysicalDetails->respiration == null ?'':$PhysicalDetails->respiration.'
                                        b/m'); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span style="font-weight: bold; font-size: 15px;">Total Payment Amount : ₹<?php echo e($payment_amount); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span style="font-weight: bold; font-size: 15px;">Apply Charges Amount : ₹<?php echo e($billing_amount); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                

                
                <div class="col-lg-8 col-xl-8 border-right">
                    
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">

                                <div class="row">
                                    <div class="col-md-6">
                                        <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="myChart" style="width:70%;max-width:400px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Pathology Test</h5>
                                <?php if(@$PathologyTestDetails[0]->id != null): ?>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Test Name</th>
                                                <th class="text-white">Date</th>
                                                
                                                <th class="text-white">Test Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = @$PathologyTestDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(@$item->test_details->test_name); ?></td>
                                                <td><?php echo e(@date('d-m-Y h:i A',strtotime($item->date))); ?></td>
                                                
                                                <td>
                                                    <?php if($item->test_status == '0'): ?>
                                                    <span class="badge badge-warning">Sample Not Collected</span>
                                                    <?php else: ?>
                                                    <span class="badge badge-success">Sample Collected</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <span style="color:brown">** No Pathology Test done **</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Radiology Test</h5>
                                <?php if(@$RadiologyTestDetails[0]->id != null): ?>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Test Name</th>
                                                <th class="text-white">Date</th>
                                                
                                                <th class="text-white">Test Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $RadiologyTestDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(@$item->test_details->test_name); ?></td>
                                                <td><?php echo e(@date('d-m-Y h:i A',strtotime($item->date))); ?></td>
                                                
                                                <td>
                                                    <?php if($item->test_status == '0'): ?>
                                                    <span class="badge badge-warning">Sample Not Collected</span>
                                                    <?php else: ?>
                                                    <span class="badge badge-success">Sample Collected</span>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <span style="color:brown">** No Radiology Test done **</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Blood Bank</h5>
                                <?php if(@$PhysicalDetails[0]->height != null): ?>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-danger">
                                        <thead class="bg-danger text-white">
                                            <tr>
                                                <th class="text-white">Height</th>
                                                <th class="text-white">Weight</th>
                                                <th class="text-white">Pulse</th>
                                                <th class="text-white">BP</th>
                                                <th class="text-white">Temp</th>
                                                <th class="text-white">Resp</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = @$PhysicalDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(@$item->height == null ?'':$item->height.' cm'); ?></td>
                                                <td><?php echo e(@$item->weight == null ?'':$item->weight.' kg'); ?></td>
                                                <td><?php echo e(@$item->pulse == null ?'':$item->pulse.' bpm'); ?></td>
                                                <td><?php echo e(@$item->bp == null ?'':$item->bp.' mmHg'); ?></td>
                                                <td><?php echo e(@$item->temperature == null ?'':$item->temperature.' °C'); ?></td>
                                                <td><?php echo e(@$item->respiration == null ?'':$item->respiration.' b/m'); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <span style="color:brown">** No Blood or Blood Component used **</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Blood Issue Details</h5>
                                <?php if(@$blood_details[0]->id != null): ?>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Blood Group</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Bag</th>
                                                <th class="text-white">Blood Quentity</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $blood_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(@$item->blood_group_details->blood_group_name); ?></td>
                                                <td> <?php echo e(@$item->issue_date); ?></td>
                                                <td> <?php echo e(@$item->bag); ?></td>
                                                <td> <?php echo e(@$item->blood_qty); ?></td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <span style="color:brown">** No Blood Issued **</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Blood Components Issue Details</h5>
                                <?php if(@$blood_details[0]->id != null): ?>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Blood Group</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Bag</th>
                                                <th class="text-white">Blood Components Quentity</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $components_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(@$item->blood_group_details->blood_group_name); ?></td>
                                                <td> <?php echo e(@$item->issue_date); ?></td>
                                                <td> <?php echo e(@$item->bag); ?></td>
                                                <td> <?php echo e(@$item->components_qty); ?></td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <span style="color:brown">** No Blood Components Issued **</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Operaiton Details</h5>
                                <?php if(@$operation_details_fetch[0]->operation_name != null): ?>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="border-bottom-0">Sl. No</th>
                                                <th class="border-bottom-0">Operation Name</th>
                                                <th class="border-bottom-0">Operation Catagory </th>
                                                <th class="border-bottom-0">Consultant Doctor </th>
                                                <th class="border-bottom-0">Operaiton Type</th>
                                                <th class="border-bottom-0">From Date</th>
                                                <th class="border-bottom-0">To Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $operation_details_fetch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($item->operation_name); ?></td>
                                                <td><?php echo e($item->operation_catagory_name); ?></td>
                                                <td><?php echo e($item->doctor_first_name); ?> <?php echo e($item->doctor_last_name); ?></td>
                                                <td><?php echo e($item->operation_type_name); ?></td>
                                                <td><?php echo e($item->operation_date_from); ?></td>
                                                <td><?php echo e($item->operation_date_to); ?></td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <span style="color:brown">** No Operation Done **</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
<script>
    var xValues = ["credit Limit", "Billing"];
    var yValues = ['<?php echo $ipd_details->credit_limit ?>','<?php echo $total_charge_amount ?>'];
    var barColors = [
        "#b91d47",
        "#1e7145"
    ];

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Credit Limit"
            }
        }
    });
</script>

<script>
    var xValues = [<?php echo $p_chart_name ?>];
    var yValues = [<?php echo $p_chart_value ?>];
    var barColors = [
      "#b91d47",
      "#00aba9",
      "#2b5797",
      "#e8c3b9",
      "#1e7145",
      
    ];
    
    new Chart("myChart1", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        title: {
          display: true,
          text: "Expance for different category"
        }
      }
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/ipd-profile.blade.php ENDPATH**/ ?>