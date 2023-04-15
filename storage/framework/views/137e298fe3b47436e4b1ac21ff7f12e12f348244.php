
<?php $__env->startSection('content'); ?>


<!-- ===============================Alert Message======================================= -->
<?php if(session('success')): ?>
<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session()->has('error')): ?>
<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button><?php echo e(session('error')); ?></div>
<?php endif; ?>
<!-- ================================Alert Message====================================== -->


<!-- ================================ vendor quatation details========================= -->

<div class="modal" id="modaldemo3">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Vendor/Quatation</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php if (@$requisition_details->status >= 3 &&  @$requisition_details->status <= 9) { ?>
                    <form method="POST" action="<?php echo e(route('add-vender-for-quatation')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="req_id" value="<?php echo e($requisition_details->id); ?>">
                        <div class="row">
                            <div class="col-md-8">
                                <?php if(isset($vendor_details)): ?>
                                <select name="vendor_name[]" multiple="multiple" class="multi-select select2-show-search">
                                    <option>Select Vendor</option>
                                    <?php $__currentLoopData = $vendor_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->vendor_name); ?>,<?php echo e($value->vendor_address); ?>,<?php echo e($value->vendor_gst); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php endif; ?>
                                <?php $__errorArgs = ['vendor_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-envelope"></i> Send For RFQ</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Vendor Details</th>
                                <th>Quatation</th>
                                <th>Select Quatation</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($sl_vender)): ?>
                            <?php $__currentLoopData = $sl_vender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->sl_vendors_join->vendor_name); ?>

                                    <br>
                                    <?php if($value['status'] == 1): ?>
                                    <a class="btn btn-pill btn-secondary btn-sm" href="#" type="button">Selected</a>
                                    <?php endif; ?>
                                    <?php if($value['status'] == 2): ?>
                                    <a class="btn btn-pill btn-warning btn-sm" href="#" type="button">Hold</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo e(route('add-vendor-quatation')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="vender_name" value="<?php echo e($value->vendor_id); ?>">
                                        <input type="hidden" name="req_id" value="<?php echo e($requisition_details->id); ?>">
                                        <input type="file" <?php if (@$value['status'] == 1) {
                                                                echo "disabled";
                                                            } ?> name="vendor_quatation" required>
                                        <button class="btn btn-indigo btn-sm" <?php if (@$value['status'] == 1) {
                                                                                    echo "disabled";
                                                                                } ?> type="submit"><i class="fa fa-file"></i> Save</button>
                                    </form>
                                    <?php if($value->vendor_quatation != null): ?>
                                    <a style="color:blue" href="<?php echo e(asset('public/quatation/')); ?>/<?php echo e(@$value->vendor_quatation); ?>" target="_blank"><i class="fa fa-eye"></i> View Quatation</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo e(route('vendor-select-for-po')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <textarea name="note" <?php if (@$value['status'] == 1) {
                                                                    echo "readonly";
                                                                } ?> class="form-control"><?php echo e(@$value->comment); ?></textarea>
                                        <br>
                                        <select name="selection" <?php if (@$value['status'] == 1) {
                                                                        echo "disabled";
                                                                    } ?> class="form-control" required>
                                            <option value="">Select One</option>
                                            <option value="1" <?php if ($value['status'] == 1) {
                                                                    echo "Selected";
                                                                } ?>>Selected</option>
                                            <option value="2" <?php if ($value['status'] == 2) {
                                                                    echo "Selected";
                                                                } ?>>Hold</option>
                                        </select>
                                        <br>
                                        <!--       <select name="item_quataion" required class="select2-show-search" class="form-control">
                                            <option value="0" selected>All Item</option>
                                            <?php if(isset($requisition_item) && $requisition_item != ''): ?>
                                            <?php $__currentLoopData = $requisition_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($requisition->requisition_details_id); ?>"><?php echo e(@$requisition->item_name); ?><br>(<?php echo e(@$requisition->item_description); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select> -->

                                        <input type="hidden" name="vendor_id" value="<?php echo e($value->vendor_id); ?>">
                                        <input type="hidden" name="req_no" value="<?php echo e($requisition_details->id); ?>">
                                        <button type="submit" <?php if (@$value['status'] == 1) {
                                                                    echo "disabled";
                                                                } ?> class="btn btn-success btn-sm"><i class="fa fa-check"></i> Select</button>
                                        <br>
                                    </form>
                                </td>
                                <!--             <td>
                                    <a href="<?php echo e(url('/vendor-remove')); ?>/<?php echo e($value->vendor_id); ?>/<?php echo e($requisition_details->req_no); ?>"
                                        class="btn btn-danger btn-sm" data-toggle="tooltip-primary" data-placement="top"
                                        title="Delete"><i
                                        class="fa fa-trash"></i> Delete</a>
                                </td> -->
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================================ vendor quatation details========================= -->
<div class="modal" id="modaldemo2">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Approval</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo e(route('give-approval-vendor')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <select name="permission" class="form-control" required <?php if (@$permisison_status_own_vendor->status == 'Approved' || @$permisison_status_own_vendor->status == 'Rejected') {
                                                                                    echo "disabled";
                                                                                } ?>>
                            <option value="" disabled>Select One</option>
                            <option value="Pending" disabled <?php if (@$permisison_status_own_vendor->status == 'Pending') {
                                                                    echo "selected";
                                                                } ?>>Pending</option>
                            <option value="Approved" <?php if (@$permisison_status_own_vendor->status == 'Approved') {
                                                            echo "selected";
                                                        } ?>>Approved</option>
                            <option value="Need Clarification" <?php if (@$permisison_status_own_vendor->status == 'Need Clarification') {
                                                                    echo "selected";
                                                                } ?>>Need Clarification</option>
                            <option value="Rejected" <?php if (@$permisison_status_own_vendor->status == 'Rejected') {
                                                            echo "selected";
                                                        } ?>>Rejected</option>
                        </select>
                        <input type="hidden" name="requisition_id" value="<?php echo e($requisition_details->id); ?>">
                    </div>
                    <div class="col-md-12">
                        Comment:
                        <textarea name="comment" <?php if (@$permisison_status_own_vendor->status == 'Approved' || @$permisison_status_own_vendor->status == 'Rejected') {
                                                        echo "readonly";
                                                    } ?> class="form-control"><?php echo e(@$permisison_status_own_vendor->comment); ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-indigo" <?php if (@$permisison_status_own_vendor->status == 'Approved' || @$permisison_status_own_vendor->status == 'Rejected') {
                                                            echo "disabled";
                                                        } ?> type="submit"><i class="fa fa-file"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
?>
<!-- =================================Permission For Selected Vendor=================== -->

<div class="modal" id="modaldemoadd_rfq_vendor">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> Quatation Approval</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo e(route('add-vendor-permission')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <label class="form-label">Permission Authority<span class="required"> *</span></label></label>
                        <select name="permission_authority[]" multiple="multiple" class="multi-select select2-show-search" required>
                            <option value="">Select One</option>
                            <?php if($user_list): ?>
                            <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->first_name); ?> <?php echo e($value->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Permission Type<span class="required"> *</span></label>
                        <select name="permission_type" required class="select2-show-search">
                            <option value="" disabled>Select One</option>
                            <option value="Parallal" selected>Parallal</option>
                            <option value="Sequential" disabled>Sequential</option>
                        </select>
                    </div>
                    <input type="hidden" name="req_id" value="<?php echo e(@$requisition_details->id); ?>">
                    <br>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- =================================Permission For Selected Vendor=================== -->
<div class="col-md-12">
    <div class="row">
        <div class="col-lg-8 col-xl-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Requisition Details
                    </div>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print medicine requisition')): ?>
                    <a href="<?php echo e(route('print-requisition',['id'=>$requisition_details->id])); ?>" class="btn btn-primary allbtndemo"><i class="fa fa-print"> Print</i></a>
                    <?php endif; ?>

                    <?php if(!empty($requisition_details->status > 2)): ?>
                    <a class="btn btn-primary allbtndemooo" data-target="#modaldemo3" data-toggle="modal" href="#"><i class="fa fa-list"></i> Vendors/Quatations</a>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <span class="requisition_header">Requisition No : </span><span class="requisition_text"><?php echo e(@$requisition_details->requisition_prefix); ?><?php echo e(@$requisition_details->id); ?>

                                </span>
                            </div>
                            <div class="col-md-4">
                                <span class="requisition_header">Requisition Date : </span><span class="requisition_text"><?= date('d-m-Y h:i', strtotime($requisition_details->date)); ?></span>
                            </div>
                            <div class="col-md-4">
                                <span class="requisition_header">Generated By : </span><span class="requisition_text"><?php echo e(@$requisition_details->generate_by_name->first_name); ?> <?php echo e(@$requisition_details->generate_by_name->last_name); ?></span>
                            </div>
                            <div class="col-md-12">
                                <span class="requisition_text ">
                                    <?php echo @$requisition_details->working_status->status; ?>

                                </span>
                            </div>
                            <hr>
                            <?php if(!empty($vendor_selected_quataion)): ?>
                            <?php $__currentLoopData = $vendor_selected_quataion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <span class="requisition_header">Selected Vendor Details : </span><br><span class="requisition_text"><?php echo e($value->sl_vendors_join->vendor_name); ?>,<?php echo e($value->sl_vendors_join->vendor_address); ?>,<?php echo e($value->sl_vendors_join->vendor_gst); ?></span><br>
                                <?php if(!empty($value->comment)): ?>
                                <span style="color:blue;cursor: pointer;" data-placement="top" data-toggle="tooltip" title="<?php echo e($value->comment); ?>"><i class="fa fa-eye"></i> View Note</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Selected Vendor Quatation : </span><br><span class="requisition_text"><a href="<?php echo e(asset('public/quatation/')); ?>/<?php echo e(@$value->vendor_quatation); ?>" target="_blank"><span style="color:blue;cursor: pointer;" data-placement="top" data-toggle="tooltip" title="View Quatation"><i class="fa fa-eye"></i> View Quatation</span></a></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if($requisition_details->status == 5 || $requisition_details->status == 6): ?>
                            <div class="col-md-6">
                                <span class="requisition_header"> <a class="btn btn-primary" data-target="#modaldemoadd_rfq_vendor" data-toggle="modal" href=""><i class="fa fa-user"></i> Permission For Selected Vendor</a></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Medicine Catagory</th>
                                    <th>Medicine Unit</th>
                                    <th>Medicine Name</th>
                                    <th>Quantity</th>
                                    <th>PO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($requisition_item) && $requisition_item != ''): ?>
                                <?php $__currentLoopData = $requisition_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                    <td><?php echo e(@$requisition->fetch_medicine_catagory->medicine_catagory_name); ?></td>
                                    <td><?php echo e(@$requisition->fetch_medicine_unit->medicine_unit_name); ?></td>
                                    <td><?php echo e(@$requisition->fetch_medicine_name->medicine_name); ?></td>
                                    <td><?php echo e(@$requisition->quantity); ?></td>
                                    <td>
                                        <?php if ($requisition->po_status == 1) {
                                            echo '<a style="color:blue" data-toggle="modal" type="button"><i class="fa fa-check"></i></a>';
                                        }

                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- bd -->
                </div>

            </div>
        </div>
        <!-- ============================Requisition Permission Activity================== -->
        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4">
            <?php if($requisition_details->status == 1): ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Requisition Permission Activity </h3>
                    <div class="card-options">
                    </div>
                </div>
                <div class="card-body">
                    <div class="latest-timeline scrollbar3" id="scrollbar3">
                        <ul class="timeline mb-0">
                            <?php if(isset($permisison_users) && $permisison_users != ''): ?>
                            <?php $__currentLoopData = $permisison_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="mt-0">
                                <div class="d-flex"><span class="time-data"><?php echo e(@$user->permission_user_details->first_name); ?> <?php echo e(@$user->permission_user_details->last_name); ?></span><span class="ml-auto text-muted fs-11"><?php if ($user->date != '' && $user->date != null) {
                                                                                                                                                                                                                            echo date('d-m-Y h:i', strtotime($user->date));
                                                                                                                                                                                                                        } ?></span></div>
                                <p class="text-muted fs-12">
                                    <span class="text-info">
                                        <?php if($user->user_id == Auth::id() && ( $user->permission_type == 'Parallal' || @$show_for_permission->user_id == Auth::id()) ): ?>
                                        <td><a class="btn btn-pill btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal" type="button"><?php echo e($user->status); ?></a></td>
                                        <?php else: ?>
                                        <td><a class="btn btn-pill btn-info btn-sm" type="button"><?php echo e($user->status); ?></a></td>
                                        <?php endif; ?>
                                    </span>
                                </p>
                                <?php if(!empty($user->comment)): ?>
                                <p class="text-muted fs-12"><span style="color:blue;cursor: pointer;" data-placement="top" data-toggle="tooltip" title="<?php echo e($user->comment); ?>"><i class="fa fa-eye"></i> View Note</span></p>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(count($permisison_users_vendor) > 0): ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selected Vendor Permission Activity</h3>
                    <div class="card-options">
                    </div>
                </div>
                <div class="card-body">
                    <div class="latest-timeline scrollbar3" id="scrollbar3">
                        <ul class="timeline mb-0">
                            <?php if(isset($permisison_users_vendor) && $permisison_users_vendor != ''): ?>
                            <?php $__currentLoopData = $permisison_users_vendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="mt-0">
                                <div class="d-flex"><span class="time-data"><?php echo e(@$user->permisison_users_vendor->first_name); ?> <?php echo e(@$user->permisison_users_vendor->last_name); ?></span><span class="ml-auto text-muted fs-11"><?php if ($user->date != '' && $user->date != null) {
                                                                                                                                                                                                                            echo date('d-m-Y h:i', strtotime($user->date));
                                                                                                                                                                                                                        } ?></span></div>
                                <p class="text-muted fs-12">
                                    <span class="text-info">
                                        <?php if($user->user_id == Auth::id() && ( $user->permission_type == 'Parallal' || @$show_for_permission_vendor->user_id == Auth::id())): ?>
                                        <td><a class="btn btn-pill btn-info btn-sm" data-target="#modaldemo2" data-toggle="modal" type="button"><?php echo e($user->status); ?></a></td>
                                        <?php else: ?>
                                        <td><a class="btn btn-pill btn-info btn-sm" type="button"><?php echo e($user->status); ?></a></td>
                                        <?php endif; ?>
                                    </span>
                                </p>
                                <?php if(!empty($user->comment)): ?>
                                <p class="text-muted fs-12"><span style="color:blue;cursor: pointer;" data-placement="top" data-toggle="tooltip" title="<?php echo e($user->comment); ?>"><i class="fa fa-eye"></i> View Note</span></p>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- ================Requisition Permission Activity======================== -->
    </div>
</div>
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Change Status</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="<?php echo e(route('given-approval')); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="col-md-12">
                        <select name="permission" <?php if (@$permisison_status_own->status == 'Approved' || @$permisison_status_own->status == 'Rejected') {
                                                        echo "disabled";
                                                    } ?> class="form-control" required>
                            <option value="" disabled>Select One</option>
                            <option value="Pending" disabled <?php if (@$permisison_status_own->status == 'Pending') {
                                                                    echo "selected";
                                                                } ?>>Pending</option>
                            <option value="Approved" <?php if (@$permisison_status_own->status == 'Approved') {
                                                            echo "selected";
                                                        } ?>>Approved</option>
                            <option value="Need Clarification" <?php if (@$permisison_status_own->status == 'Need Clarification') {
                                                                    echo "selected";
                                                                } ?>>Need Clarification</option>
                            <option value="Rejected" <?php if (@$permisison_status_own->status == 'Rejected') {
                                                            echo "selected";
                                                        } ?>>Rejected</option>
                        </select>
                        <input type="hidden" name="requisition_id" value="<?php echo e(@$requisition_details->id); ?>">
                    </div>
                    <div class="col-md-12">
                        Comment:
                        <textarea name="comment" <?php if (@$permisison_status_own->status == 'Approved' || @$permisison_status_own->status == 'Rejected') {
                                                        echo "readonly";
                                                    } ?> class="form-control"><?php echo e(@$permisison_status_own->comment); ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-indigo" type="submit" <?php if (@$permisison_status_own->status == 'Approved' || @$permisison_status_own->status == 'Rejected') {
                                                                            echo "disabled";
                                                                        } ?>><i class="fa fa-file"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/purchase/requisition/medicine-requisition-details.blade.php ENDPATH**/ ?>