
<?php $__env->startSection('content'); ?>

<!-- ================================ vendor quatation details========================= -->
<div class="card">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Tools return form')): ?>
            <div class="card-header">
                <h6 class="card-title">Return Tools</h6>
                
            </div>
            <div class="card-body">
             
                <form method="POST" action="<?php echo e(route('return-tools')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="tools_issue_id" value="<?php echo e($id); ?>">
                    <div class="row">
                        <div class="col-md-6">
                           <label class="form-label">Return User <span class="required">*</span></label>
                            <select name="user_id" required class="form-control">
                                 <option value="">Select User</option>
                                <?php if(isset($user_list)): ?>
                                <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                               
                            </select>
                            <?php $__errorArgs = ['user_id'];
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
                        <div class="col-md-6">
                           <label class="form-label">Select Tools<span class="required">*</span></label>
                            <select name="tools_id" required class="form-control">
                                 <option value="">Select Tools</option>
                                <?php if(isset($issue_item_detail)): ?>
                                <?php $__currentLoopData = $issue_item_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->item); ?>"><?php echo e(@$value->item_name); ?> ( <?php echo e(@$value->item_description); ?> )</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                               
                            </select>
                            <?php $__errorArgs = ['tools_id'];
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
                        <div class="col-md-6">
                           <label class="form-label">Tools Condition<span class="required">*</span></label>
                            <select name="tools_condition" required class="form-control">

                                <option value="">Select Tools Condition</option>
                                <option value="Usable">Usable</option>
                                <option value="Not-Usable">Not-Usable</option>

                            </select>
                            <?php $__errorArgs = ['tools_condition'];
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
                        <div class="col-md-6">
                           <label class="form-label">Tools Quantity<span class="required">*</span></label>
                            <input type="text" required name="tools_quantity" class="form-control">
                            <?php $__errorArgs = ['tools_quantity'];
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
                        <div class="col-md-12">
                           <label class="form-label">Date<span class="required">*</span></label>
                            <input type="date" required name="return_date" class="form-control">
                            <?php $__errorArgs = ['return_date'];
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
                        <div class="col-md-4 mt-3">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-undo"></i> Return</button>
                        </div>
                    </div>
                   
                </form>
            </div>
            <hr>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Tools return list')): ?>
            <div class="card-header">
                <h6 class="card-title">Return Tools</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Return Tools Name</th>
                                <th>Tools Quantity</th>
                                <th>Return User</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($return_tools_deatisl)): ?>
                            <?php $__currentLoopData = $return_tools_deatisl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e(@$value->item_name); ?>(<?php echo e(@$value->item_description); ?>)
                                </td>
                                <td>
                                   <?php echo e(@$value->return_quantity); ?>

                                </td>
                                <td>
                                   <?php echo e(@$value->name); ?>

                                </td>
                                <td>
                                   <?php echo e(date('d-m-Y',strtotime($value->return_date))); ?>

                                </td>
                            </tr>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>
              
            </div>
        <?php endif; ?>
 
</div>
<!-- ================================ vendor quatation details========================= -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/tools-management/return-tools.blade.php ENDPATH**/ ?>