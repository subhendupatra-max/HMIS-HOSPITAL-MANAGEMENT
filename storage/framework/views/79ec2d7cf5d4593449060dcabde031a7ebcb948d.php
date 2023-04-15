
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Patient List</h4>
          <a href="<?php echo e(route('add_new_patient')); ?>"><button class="btn btn-primary  float-right">Add New Patient</button></a> 
        </div>

    </div>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ame\ameInventory1\resources\views/setup/patient/all_patient_details.blade.php ENDPATH**/ ?>