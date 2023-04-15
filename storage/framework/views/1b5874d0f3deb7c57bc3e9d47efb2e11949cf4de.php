
<?php $__env->startSection('content'); ?>




    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
<div class="card-header d-block">
    <div class="row">
        <div class="col-md-4 card-title">
           EMG Challan List
        </div>
        
        <div class="col-md-8 text-right">
            <div class="d-block">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create EMG Challan')): ?>
            
                <a href="<?php echo e(route('create-emg-challan')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>  Create EMG Challan</a>
         
        <?php endif; ?>
        <?php if(Auth::user()->workshop == 0): ?>
            <a href="#"  class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-menu dropdown-menu-right" style="">
                      <a class="dropdown-item" href="<?php echo e(route('emg-challan')); ?>"><i class="fa fa-home"></i>  Full Stock</a>
                        <?php if(isset($workshops)): ?>
                        <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item" href="<?php echo e(url('emg-challan')); ?>/<?php echo e(base64_encode( $value->id)); ?>"><i class="fa fa-home"></i>    <?php echo e($value->name); ?></a>
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
                            <th scope="col">EMG Challan No.</th>
                            <th scope="col">Generated By</th>
                            <th scope="col">Workshop</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($emg_challan_list) && $emg_challan_list != ''): ?>
                        <?php $__currentLoopData = $emg_challan_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(url('emg-challan-details')); ?>/<?php echo e(base64_encode($emg->emg_id)); ?>"  style="color: blue;"><?php echo e($emg->emg_prefix); ?><?php echo e(@$emg->emg_id); ?></a></td>
                                <td><?php echo e($emg->name); ?></td>
                                <td><?php echo e(@$emg->workshop_name); ?></td>
                                <td><?= date('d-m-Y h:i',strtotime($emg->emg_date)); ?></td>
                                <td><?php echo @$emg->status; ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#"  class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                           
                                            <a class="dropdown-item" href="<?php echo e(url('emg-challan-details')); ?>/<?php echo e(base64_encode($emg->emg_id)); ?>"><i class="fa fa-eye"></i>    View</a>

                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i>   Edit</a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Emg Challan Delete')): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('emg-challan-delete')); ?>/<?php echo e(base64_encode($emg->emg_id)); ?>"><i class="fa fa-trash"></i>    Delete</a>
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









<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/emg_challan/emg-challan-list.blade.php ENDPATH**/ ?>