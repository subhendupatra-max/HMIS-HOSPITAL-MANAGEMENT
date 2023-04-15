
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->

    <div class="card">
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Add Issue Item
                </div>
                <div class="col-md-6 text-right">
                    <div>
                        <a href="<?php echo e(route('addJob')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Job Card</a>
                        <a href="#" onClick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        <form action="">
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 15%">Item Type <span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 60%">Item <span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 23%">Quantity <span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 23%">Unit <span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 2%">
                                                <button type="button" class="btn btn-success add"><i class="fa fa-plus"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- dynamic row -->
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
                                <!-- End Table with stripped rows -->
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Jquery js-->
<script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
       $(".add").click(function (e) { 
        e.preventDefault();
        alert("ok");
       });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ame_inventory\resources\views/appPages/job/issue-item.blade.php ENDPATH**/ ?>