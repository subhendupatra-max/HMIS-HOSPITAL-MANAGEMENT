
<?php $__env->startSection('content'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Bed Status</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control select2-show-search"
                                value="<?php echo e(old('search_bed_ward')); ?>" id="search_bed_ward" name="search_bed_ward"
                                >
                                <option value="">Select One...</option>
                                <?php $__currentLoopData = $bedWard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->ward_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="col-md-12">
                    <div class="row allBed">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#search_bed_ward').change(function(){
                event.preventDefault();
                let search_bed_ward_id = $(this).val();
                $.ajax({
                    url: "<?php echo e(route('find-bed-by-ward-in-bed-status')); ?>",
                    type: "POST",
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        search_bed_ward: search_bed_ward_id,
                    },
                    success: function(response) {
                        $.each(response, function(key, value) {
                            let colr = (value.is_used =='no' ? 'text-success':'text-danger');
                            $('.allBed').html(`
                            <div class="col-md-2">
                                <a href="#" data-placement="top">
                                <i class="fa fa-bed fa-3x ${colr}"></i>
                                <p style="font-weight: 500">${value.bed_name}</p>
                                </a>
                            </div>
                            `);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });

    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/setup/bed/bed-status.blade.php ENDPATH**/ ?>