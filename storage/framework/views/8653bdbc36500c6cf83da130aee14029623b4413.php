
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-4 card-title">
                        Pathology Billing List
                    </div>
                    <div class="col-md-8 text-right">
                        <div class="d-block">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add pathology bill')): ?>
                                <a href="<?php echo e(route('add-pathology-billing')); ?>" class="btn btn-primary btn-sm"><i
                                        class="fa fa-file"></i>
                                    Generate Bill </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology test')): ?>
                                <a href="<?php echo e(route('pathology-test-list')); ?>" class="btn btn-primary btn-sm"><i
                                        class="fa fa-vials"></i> Pathology Test </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology test master')): ?>
                            <a href="<?php echo e(route('pathology-test-master-details')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-mortar-pestle"></i> Test Master </a>
                            <?php endif; ?>

                            

                            

                            
                        </div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology billing list')): ?>
                <div class="card-body">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap" id="example">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl. No</th>
                                        <th class="border-bottom-0">Bill No.</th>
                                        <th class="border-bottom-0">Patient Details</th>
                                        <th class="border-bottom-0">Test Details</th>
                                        <th class="border-bottom-0">Reference Details</th>
                                        <th class="border-bottom-0">Charges Amount</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>subhendu patra(1)</td>
                                        <td>CVC</td>
                                        <td>Tithi Das</td>
                                        <td>100</td>
                                        <td><a href="#"><span class="badge badge-danger">Accepted</span></a></td>
                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item" href=""><i class="fa fa-eye"></i> View</a>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                                    <a class="dropdown-item" href=""><i class="fa fa-edit"></i> Edit</a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                                    <a class="dropdown-item" href=""><i class="fa fa-trash"></i> Delete</a>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pathology/pathology-billing-list.blade.php ENDPATH**/ ?>