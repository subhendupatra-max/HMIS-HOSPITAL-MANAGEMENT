
<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <span class="requisition_header">Item Name : </span><span class="requisition_text"><?php echo e(@$item_details->item_name); ?>(<?php echo e(@$item_details->item_description); ?>)</span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Brand Name : </span><span class="requisition_text"><?php echo e(@$item_details->brand_name); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Manufacturer Name : </span><span class="requisition_text"><?php echo e(@$item_details->manufacturar_name); ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class="requisition_header">Base Unit : </span><span class="requisition_text"><?php echo e(@$base_unit->units); ?></span>
                    </div>
            
                </div>
            </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Scrap Details')): ?>

           <hr style=" margin: 3px 0px 3px 0px !important;">
           <div class="col-md-12">
            <form method="POST" action="<?php echo e(route('add-scrap-details-item')); ?>">
                <?php echo csrf_field(); ?>
           <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Workshop<span class="required">*</span></label>
                        <select class="form-control" required name="workshop">
                            <option value="">Select One</option>
                            <?php if(isset($workshop)): ?>
                            <?php $__currentLoopData = $workshop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e(@$value->id); ?>"><?php echo e(@$value->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                          
                
                    <?php $__errorArgs = ['workshop'];
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
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Description<span class="required">*</span></label>
                    <textarea name="description" required class="form-control">
                          <?php echo e(@$item_details->item_description); ?>

                    </textarea>
                    <?php $__errorArgs = ['description'];
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
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Quantity<span class="required">*</span></label>
                   <input type="text" required name="quantity" class="form-control">
                    <?php $__errorArgs = ['quantity'];
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
            </div>
            <input type="hidden" name="item_id" value="<?php echo e(@$item_details->item_id); ?>">
            <input type="hidden" name="unit" value="<?php echo e(@$base_unit->units); ?>">
            <div class="col-md-6">
                <div class="form-group">
                   <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>

            </div>
            </form>
            </div>

            <?php endif; ?>

           <hr style=" margin: 3px 0px 3px 0px !important;">
            <div class="card-header">
                <div class="card-title">Scrap Item Details</div>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($scrap_details)): ?>
                            <?php $__currentLoopData = $scrap_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e($value->description); ?></td>
                                <td>
                                    <?php echo e($value->qty); ?> <?php echo e($value->unit); ?>

                                </td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete scrap details')): ?>
                                <td><a href="<?php echo e(url('delete-scrap-details')); ?>/<?php echo e($value->id); ?>"><i class="fa fa-trash"></i></a>
                                </td>
                                <?php endif; ?>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
 </div>
</div>

    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $("#removeIcon").click(function(e) {
                e.preventDefault();
                $("#delete").submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/item/scrap/scrap_item_details.blade.php ENDPATH**/ ?>