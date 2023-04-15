
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Medicines
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a href="<?php echo e(asset('public/import/medicine/import_medicine.csv')); ?>" class="btn btn-primary btn-sm" download="Patients"><i class="fa fa-download"></i>
                            Download Sample Data </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <p>Note: Your CSV data should be in the format below. The first line of your CSV file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems.
                </p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class=" table-responsive">
                        <table class="table table-bordered text-nowrap key-buttons">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Medicine Name<span class="text-danger">*</span></th>
                                    <th class="border-bottom-0">Medicine Company</th>
                                    <th class="border-bottom-0">Medicine Composition <span class="text-danger">*</span></th>
                                    <th class="border-bottom-0">Medicine Group<span class="text-danger">*</span></th>
                                    <th class="border-bottom-0">Unit<span class="text-danger">*</span></th>
                                    <th class="border-bottom-0">Min Level<span class="text-danger">*</span></th>
                                    <th class="border-bottom-0">Re-Order Level<span class="text-danger">*</span></th>
                                    <th class="border-bottom-0">Tax</th>
                                    <th class="border-bottom-0">Unit/Packing</th>
                                    <th class="border-bottom-0">VAT A/C</th>
                                    <th class="border-bottom-0">Note</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <form action="<?php echo e(route('upload-import-patient')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="medicine_catagory">Medicine Catagory <span class="text-danger">*</span></label>
                            <select name="medicine_catagory" class="form-control select2-show-search" id="medicine_catagory">
                                <option value="">Select Medicine Catagory... </option>
                                <?php $__currentLoopData = $medicine_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($items->id); ?>"><?php echo e($items->medicine_catagory_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-danger"><?php echo e($errors->first('medicine_catagory')); ?></small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="medicine_file">File <span class="text-danger">*</span></label>
                            <input type="file" name="medicine_file" class="form-control" required />
                            <small class="text-danger"><?php echo e($errors->first('medicine_file')); ?></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Import Medicine </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/medicine/import-medicine.blade.php ENDPATH**/ ?>