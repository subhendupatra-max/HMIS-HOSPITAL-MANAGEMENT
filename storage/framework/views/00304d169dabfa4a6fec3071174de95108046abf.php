
<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Payment List</h4>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('OPD registation')): ?>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i class="fa fa-plus"></i> Add New Payment</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Payment Amount</th>
                            <th scope="col">Payment Mode</th>
                            <th scope="col">Transection Id</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($payment_list)): ?>
                            <?php $__currentLoopData = $payment_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="modaldemo2">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Take Payment</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?php echo e(route('after-new-old')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
fdsfdsfs
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary text-right" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/OPD/payment-list.blade.php ENDPATH**/ ?>