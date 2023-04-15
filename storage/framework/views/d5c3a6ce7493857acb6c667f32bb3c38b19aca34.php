
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <?php if(session('success')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Manufacture</div>
            <div class="card-body">

            </div>
        </div>

        <div class="card-body">
            <div class="">
                <form action="<?php echo e(route('manufactureAdd')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="input-group">
                            <label class="form-label">Manufacture Name<span class="required"> *</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="manufacturar_name" name="manufacturar_name" placeholder="Enter Item Name">
                            </div>
                            <?php $__errorArgs = ['manufacturar_name'];
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
                    <div class="mt-3 ml-3">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                    </div>
                </form>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Manufacture List</div>
            <div class="card-body">

            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Manufacture Name</th>
                                <th scope="col">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit item || delete item')): ?>
                                    Action
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $manufacture; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e(@$list->manufacturar_name); ?></td>
                                <td>
                                        <div class="text-wrap">
                                            <div>
                                                <div class="btn-list">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            Action <i class="fa fa-caret-down"></i> 
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands edit')): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('editManufacture',$list->id)); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands delete')): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('deleteManufacture',$list->id)); ?>"><i class="fa fa-trash"></i> Delete</a>
                                                            <?php endif; ?>
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
                    <!-- End Table with stripped rows -->
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/master/manufacture/manufacture-list.blade.php ENDPATH**/ ?>