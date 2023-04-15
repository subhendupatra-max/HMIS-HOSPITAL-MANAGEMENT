
<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
          

<div class="card-header d-block">
    <div class="row">
        <div class="col-md-4 card-title">
           Return Item List
        </div>
        
        <div class="col-md-8 text-right">
            <div class="d-block">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Return PO Item')): ?>
            
                <a href="<?php echo e(route('return-create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>  Create Return</a>
         
        <?php endif; ?>
        <?php if(Auth::user()->workshop == 0): ?>
            <a href="#"  class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-menu dropdown-menu-right" style="">
                      <a class="dropdown-item" href="<?php echo e(route('return-list')); ?>"><i class="fa fa-home"></i>  Full Stock</a>
                        <?php if(isset($workshops)): ?>
                        <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item" href="<?php echo e(url('return-list')); ?>/<?php echo e(base64_encode( $value->id)); ?>"><i class="fa fa-home"></i>    <?php echo e($value->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                          
                </div>
            <?php endif; ?>

            </div>
        </div>
        
    </div>
</div>

                <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session()->has('error')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
                <?php endif; ?>
          

            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Return Form No.</th>
                            <th scope="col">Workshop</th>
                            <th scope="col">Rejection Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($return_list) && $return_list != ''): ?>
                        <?php $__currentLoopData = $return_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(url('return-details')); ?>/<?php echo e(base64_encode($value->return_id)); ?>"  style="color: blue;"><?php echo e($value->return_prefix); ?><?php echo e(@$value->return_id); ?></a></td>
                                <td><?php echo e(@$value->workshop_name); ?></td>
                                <td><?= date('d-m-Y h:i',strtotime($value->rejection_date)); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#"  class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                           
                                            <a class="dropdown-item" href="<?php echo e(url('return-details')); ?>/<?php echo e(base64_encode($value->return_id)); ?>"><i class="fa fa-eye"></i>    View</a>

                                            <a class="dropdown-item" href=""><i class="fa fa-pencil"></i>    Edit</a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete Return PO Item')): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('return-delete')); ?>/<?php echo e(base64_encode($value->return_id)); ?>"><i class="fa fa-trash"></i>    Delete</a>
                                        <?php endif; ?>
                                        
                                        </div>
                                    </div>
                                </td>

                               
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









<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/purchase-order/return-item-list.blade.php ENDPATH**/ ?>