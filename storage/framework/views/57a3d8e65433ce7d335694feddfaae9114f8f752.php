
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Issue Tools List</div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Tools issue form')): ?>
            <div class="btn-list create_req">
                <a href="<?php echo e(route('issue_form')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Issue Tools</a>
            </div>
        <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Issue Id</th>
                                <th class="border-bottom-0">Issue By</th>
                                <th class="border-bottom-0">Issue To</th>
                                <th class="border-bottom-0">Issue Date</th>
                                <th class="border-bottom-0">Tools</th>
                                <th class="border-bottom-0">Return</th>
                                <th class="border-bottom-0">Workshop</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $issue_form_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->issue_prefix); ?><?php echo e($item->id); ?></td>
                                <?php
                                $issue_by = DB::table('users')->where('id', $item->issue_by)->first();
                                ?>
                                <td><?php echo e($issue_by->name); ?></td>
                                <?php
                                $issue_to = DB::table('users')->where('id', $item->issue_to)->first();
                                ?>
                                <td><?php echo e($issue_to->name); ?></td>
                                <td><?php echo e($item->issue_date); ?></td>
                                <td>

                            <?php
                            $issue_item_detail = DB::table('tools_issues')->select('tools_issues.item','tools_issues.qty','items.item_description','items.item_name','item_units.units','tools_issues.id as tools_issue_id','tools_issues.issue_forms_id')->join('items','items.id','=','tools_issues.item')->join('item_units','item_units.id','=','tools_issues.unit')->where('tools_issues.issue_forms_id', $item->id)->get(); 
                            ?>
                            <?php if($issue_item_detail != null): ?>
                            <?php $__currentLoopData = $issue_item_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue_item_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                           <span style="color:#004ffb;font-weight:bold;"><?php echo e($loop->iteration); ?> : </span>  <?php echo e(@$issue_item_details->item_name); ?> ( <?php echo e(@$issue_item_details->item_description); ?> )<br><span style="color:green;font-weight:bold;">Issue Qty</span> : <?php echo e(@$issue_item_details->qty); ?> <?php echo e(@$issue_item_details->units); ?>

                         
                             <hr style=" margin: 3px 0px 3px 0px !important; border: 1px solid #4b48483d !important;">

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                                    
                                </td>
                                <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('return-tools-form',$item->id)); ?>"><i class="fa fa-undo"></i> Return</a></td>

                                <?php
                                $workshop = DB::table('workshops')->where('id', $item->workshop_name)->first();

                                ?>
                                <td><?php echo e($workshop->name); ?></td>
                                <td>
                                    <div class="text-wrap">
                                        <div>
                                            <div class="btn-list">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-caret-down"></i> Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a>
                                                        <a class="dropdown-item" href="<?php echo e(route('edit_issue_form', $item->id)); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/tools-management/assign-tools-list.blade.php ENDPATH**/ ?>