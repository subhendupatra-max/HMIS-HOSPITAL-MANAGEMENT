
<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title"> </h4>
                </div>
            </div>
        </div>

        <!-- ================================ Alert Message===================================== -->

        <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover card-table table-vcenter text-nowrap border-left border-right border-bottom">
                <thead class="bg-primary text-white">
                    <tr class="border-left">
                        <th  class="text-white">Staff Name</th>
                        <?php $__currentLoopData = $daterange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th  class="text-white">
                                <?php echo e(date('jS M',strtotime($date))); ?>

                                <input type="hidden" name="duty_date" value="<?php echo e($date); ?>" />
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                    </tr>
                </thead>

                <tbody>
                    <?php if(@$staffDetails[0]->id != null): ?>
                    <?php $__currentLoopData = $staffDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="border-right">
                            <?php echo e(@$value->staff_details->first_name); ?>

                            <?php echo e(@$value->staff_details->middle_name); ?>

                        </td>
                        <?php $__currentLoopData = $daterange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="border-right">
                            <select name="" class="select2-show-search form-control" id="slot<?php echo e($value->id); ?>" >
                                <option value="">Select One.....</option>
                                <?php $__currentLoopData = $working_slot_Details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="">
                                        <span style="color:<?php echo e(@$values->color); ?>"><?php echo e($values->working_slot_name); ?>(<?php echo e(date('h:i A',strtotime($values->from_time))); ?> -  <?php echo e(date('h:i A',strtotime($values->to_time))); ?>)</span>
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">
                            <img src="<?php echo e(asset('public/no_found_data/no_data.png')); ?>" alt="loader" width="400px"
                            height="160px">
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table>
            </div>
        </div>
    </div>
</div>

<script>
    function getChanges(id)
    {


    }
</script>


<script src="<?php echo e(asset('public/assets/js/jquery-3.6.0.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/roster/create-roster.blade.php ENDPATH**/ ?>