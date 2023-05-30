

<?php $__env->startSection('content'); ?>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Charges List
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add charges')): ?>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a href="<?php echo e(route('charges-add')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Charges</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
      <?php echo $__env->make('message.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Charges name</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Sub Catagory Name</th>
                                <th class="border-bottom-0">Standard Charges </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Description</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete charges','edit charges')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(@$item->charges_name); ?></td>
                                <td><?php echo e(@$item->charges_catagory->charges_catagories_name); ?></td>
                                <td><?php echo e(@$item->charges_sub_catagory->charges_sub_catagories_name); ?></td>
                                <td>
                                    <?php
                                    $charge_with_type = DB::table('charges_with_charges_types')
                                    ->join('charge_types','charges_with_charges_types.charge_type_id','=','charge_types.id')
                                    ->where('charges_with_charges_types.charge_id',$item->id)
                                    ->get();
                                    if(@$charge_with_type[0]->charge_type_id != null){
                                        foreach($charge_with_type as $value){
                                            echo $value->charge_type_name." : ".$value->standard_charges." Rs<br>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php echo e(@$item->date); ?></td>
                                <td><?php echo e(@$item->description); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit charges')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-charges-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete charges')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-charges-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/charges/charges-listing.blade.php ENDPATH**/ ?>