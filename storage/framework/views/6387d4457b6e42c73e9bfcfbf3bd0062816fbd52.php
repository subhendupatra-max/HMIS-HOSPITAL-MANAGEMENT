
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
    <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold"> Operation Booking Details<i class="fa fa-check-circle text-success"></i></h4>
                </div>

                <div class="col-md-6 text-right">


                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <?php echo $__env->make('OPD.include.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-header">
            <?php echo $__env->make('OPD.include.patient-name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="card-body p-0">
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Operation Booking Details </h5>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operation Name </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo @$operation_details->operation_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operation Department </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo @$operation_details->department_name; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operation Catagory </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$operation_details->operation_catagory_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Consultant Doctor </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$operation_details->doctor_first_name); ?> <?php echo e(@$operation_details->doctor_last_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <?php $nurse1 = DB::table('operation_bookings')->select('users.first_name as nurse_first_name', 'users.last_name as nurse_last_name')->leftjoin('users', 'users.id', '=', 'operation_bookings.ass_consultant_1')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Assistant Consultant 1 </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$nurse1->nurse_first_name); ?> <?php echo e(@$nurse1->nurse_last_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <?php $nurse2 = DB::table('operation_bookings')->select('users.first_name as nurse_first_names', 'users.last_name as nurse_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ass_consultant_2')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Assistant Consultant 2</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$nurse2->nurse_first_names); ?> <?php echo e(@$nurse2->nurse_last_names); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <?php $anesthetist = DB::table('operation_bookings')->select('users.first_name as anesthetist_first_names', 'users.last_name as anesthetist_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ass_consultant_2')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Anesthetist</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$anesthetist->anesthetist_first_names); ?> <?php echo e(@$anesthetist->anesthetist_last_names); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Anaethesia Type </span>
                                        </td>
                                        <td class="py-2 px-5"><?php echo e(@$operation_details->anaethesia_type); ?></td>
                                    </tr>
                                    <tr>
                                        <?php $ot_technician = DB::table('operation_bookings')->select('users.first_name as ot_technician_first_names', 'users.last_name as ot_technician_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ot_technician')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Ot Technician </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$anesthetist->ot_technician_first_names); ?> <?php echo e(@$anesthetist->ot_technician_last_names); ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <?php $ot_assistant = DB::table('operation_bookings')->select('users.first_name as ot_assistant_first_names', 'users.last_name as ot_assistant_last_names')->leftjoin('users', 'users.id', '=', 'operation_bookings.ot_assistant')->first()   ?>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Ot Assistant </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo e(@$anesthetist->ot_assistant_first_names); ?> <?php echo e(@$anesthetist->ot_assistant_last_names); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Operaiton Type</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo @$operation_details->operation_type_name; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">From Date</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo @$operation_details->operation_date_from; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">To Date</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo @$operation_details->operation_date_to; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Case Id</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo @$operation_details->case_id; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Section</span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo @$operation_details->section; ?>

                                            <a class="textlink" href="<?php echo e(route('opd-profile', ['id' => base64_encode($operation_details->opd_id)])); ?>">(<?php echo e(@$operation_details->opd_id); ?>) </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Status </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php if($operation_details->status == 'Pending'): ?>
                                            <span class="badge badge-warning"> <?php echo @$operation_details->status; ?></span>
                                            <?php elseif(@$operation_details->status == 'Complete'): ?>
                                            <span class="badge badge-success"> <?php echo @$operation_details->status; ?></span>
                                            <?php else: ?>
                                            <span class="badge badge-secondary"> <?php echo @$operation_details->status; ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Remark </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            <?php echo @$operation_details->remark; ?>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/OPD/operation/operation-details.blade.php ENDPATH**/ ?>