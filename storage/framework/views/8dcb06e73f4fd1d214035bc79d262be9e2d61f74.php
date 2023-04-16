
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Requisition List</div>
            <div class="card-body">
                
            </div>
        </div>
        <div class="card-body">

                <div class="">
                <form action="<?php echo e(route('addItemTypeAction')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <label class="form-label">Date To<span class="required"> *</span></label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="date_to" placeholder="Enter Date To">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <label class="form-label">Date From <span class="required"> *</span></label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="date_form" placeholder="Enter Date From">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <label class="form-label">Generated By<span class="required"> *</span></label>
                            <div class="input-group">
                                    <select class="form-control" name="generated_by">
                                    <option>Selet One</option>
                                    <?php if(!empty($user)): ?>
                                    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                       
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <label class="form-label">Workshop<span class="required"> *</span></label>
                            <div class="input-group">
                                <select class="form-control" name="workshop">
                                    <option>Selet One</option>
                                    <?php if(!empty($workshops)): ?>
                                    <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="mt-3 ml-3">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;Search</button>
                    </div>
                </form>
                </div>
               <hr>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Requisition No.</th>
                                <th scope="col">Requisition Date</th>
                                <th scope="col">Generated By</th>
                                <th scope="col">Workshop</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($requisition_details)): ?>
                            <?php $__currentLoopData = $requisition_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->item_type); ?></td>
                                <td><?php echo e(@$item->item_type); ?></td>
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
</div>

<script>
    $(document).ready(function() {
        $("#removeIcon").click(function(e) {
            // e.preventDefault();
            $("#delete").submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/reports/requisition.blade.php ENDPATH**/ ?>