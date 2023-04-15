

<?php $__env->startSection('content'); ?>

<!-- INTERNAL Select2 css -->
<link href="<?php echo e(asset('assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add workshop')): ?>
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add workshop</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('workshopListAction')); ?>">
                <?php echo csrf_field(); ?>
                
                <div class="">
                    <div class="form-group">
                        <label for="workshop_name" class="form-label">Workshop Name</label>
                        <input type="text" class="form-control" id="workshop_name" name="workshop_name" placeholder="Enter workshop" value="<?php echo e(old('workshop_name')); ?>" required>
                        <?php $__errorArgs = ['workshop_name'];
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
                    <div class="form-group">
                        <label class="form-label"> Incharge  </label>
                        <select class="form-control select2-show-search" id="warehouse_incharge" name="warehouse_incharge"   data-placeholder="Choose one (with searchbox)">
                            <optgroup label="Mountain Time Zone">
                                <?php $__currentLoopData = $allUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <div  class="form-group">
                            <label for="workshop_addr" class="form-label">Workshop Address</label>
                            <textarea class="form-control mb-4" id="workshop_addr" name="workshop_addr" placeholder="Workshop Address" rows="3"><?php echo e(old('workshop_addr')); ?></textarea>
                        </div>
                    </div>
                    
                    <div>
                        <div class="form-group">
                            <label for="workshop_desc" class="form-label">Workshop Description</label>
                            <textarea class="form-control mb-4" id="workshop_desc" name="workshop_desc" placeholder="Workshop Description" rows="3"><?php echo e(old('workshop_addr')); ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add workshop</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">workshop List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Workshop Address</th>
                                <th class="border-bottom-0">Workshop Name
                                    
                                </th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete workshop')): ?>
                                    <th class="border-bottom-0">Remove Workshop</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit workshop')): ?>
                                    <th class="border-bottom-0">Edit Workshop</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $allWorkshop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->address); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete workshop')): ?>
                                      <td>
                                        <form action="<?php echo e(route('workshopDelete')); ?>" method="POST" id="delete">
                                          <?php echo csrf_field(); ?>
                                          <button class="btn btn-danger"  data-toggle="tooltip-primary" data-placement="top" title="Remove  workshop" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                          <input type="hidden" name="workshop_id" value="<?php echo e($item->id); ?>">
                                        </form>
                                      </td>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit workshop')): ?>
                                      <td>
                                        <a href="<?php echo e(route('workshopEdit',['id'=>base64_encode($item->id)])); ?>" class="btn btn-warning"  data-toggle="tooltip-primary" data-placement="top" title="Edit workshop"><i class="fa fa-pencil"></i></a>
                                      </td>
                                    <?php endif; ?>
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
<!-- INTERNAL Select2 js -->
<script src="<?php echo e(asset('assets/plugins/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2.js')); ?>"></script>	
<?php $__env->stopSection(); ?>
				

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/master/workshops/workshopAdd.blade.php ENDPATH**/ ?>