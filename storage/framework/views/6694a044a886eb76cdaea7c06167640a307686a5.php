
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                   Item Stock
                </div>
                
                <div class="col-md-8 text-right">
                    <div class="d-block">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Requisition')): ?>
                        <a href="<?php echo e(route('requisition-list')); ?>" class="btn btn-primary"><i class="fa fa-file"></i> Requisition</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Purchase Order')): ?>
                        <a href="<?php echo e(route('Purchase-Order-list')); ?>" class="btn btn-primary"><i class="fa fa-envira"></i>  Purchase Order</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('GRN')): ?>
                        <a href="<?php echo e(route('grm-list')); ?>" class="btn btn-primary"><i class="fa fa-list"></i>  GRN</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Return PO Item')): ?>
                        <a href="<?php echo e(route('return-list')); ?>" class="btn btn-primary"><i class="fa fa-undo"></i>  Return</a>
                    <?php endif; ?>
                    <?php if(Auth::user()->workshop == 0): ?>
                    <a href="#"  class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                              <a class="dropdown-item" href="<?php echo e(route('item_main_stock')); ?>"><i class="fa fa-home"></i>  Full Stock</a>
                                <?php if(isset($workshops)): ?>
                                <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item" href="<?php echo e(url('item-main-stock')); ?>/<?php echo e(base64_encode( $value->id)); ?>"><i class="fa fa-home"></i>    <?php echo e($value->name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                  
                        </div>
                    <?php endif; ?>

                    </div>
                </div>
                
            </div>
        </div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Item Stock')): ?>
    <div class="card-body">
        <div class="">
            <div class="table-responsive">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($item_stock_list)): ?>
                        <?php $__currentLoopData = $item_stock_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php

                         $w = $user_workshop;
                         $item_stock = DB::table('item_stocks')
                                                ->where('item_id',$value->id)
                                                ->where(function($query) use ($w)
                                                {
                                                    if($w != 0)
                                                    {
                                                      $query->where('workshop_id',$w); 
                                                    }
                                                })
                                                ->sum('quantity');

                         $item_issue = DB::table('item_issues')
                                                ->where('item_id',$value->id)
                                                ->where(function($query) use ($w)
                                                {
                                                    if($w != 0)
                                                    {
                                                      $query->where('workshop_id',$w);  
                                                    }
                                                })
                                                 ->sum('quantity');

                         $i_unit = DB::table('unit_of_items')->where('item_id',$value->id)->orderBy('id','ASC')->first();

                         if(!empty($i_unit))
                         {
                            $uni = DB::table('item_units')->where('id',$i_unit->unit_id)->first();
                         }

                         $q =($item_stock - $item_issue)." ".$uni->units;
                         if(($item_stock - $item_issue) == 0)
                         {
                            $item_status =  "<span style='color:red'>Out of Stock</span>";
                         }
                         elseif(($item_stock - $item_issue) > $value->loworder_level)
                         {
                            $item_status = $q."<span style='color:#04ee00'> (Low Stock)</span>";
                         }
                         else
                         {
                            $item_status = $q;
                         }

                        ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td><a href="<?php echo e(url('item-stock-details')); ?>/<?php echo e($value->id); ?>/<?php echo e(base64_encode($user_workshop)); ?>" style="color:blue" ><?php echo e($value->item_name); ?>(<?php echo e($value->item_description); ?>)</a></td>
                                <td><?php echo @$item_status; ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
<?php endif; ?>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/main-stock.blade.php ENDPATH**/ ?>