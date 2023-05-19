

<?php $__env->startSection('content'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add medicine supplier')): ?>
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Supplier</h4>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('save-medicine-supplier-details')); ?>">
                <?php echo csrf_field(); ?>
                <div class="">

                    <div class="form-group">
                        
                        <input type="text"  id="supplier_name" name="supplier_name"value="<?php echo e(old('supplier_name')); ?>" >
                        <label  class="suppilerinput"for="supplier_name">Enter Supplier Name <span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['supplier_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        
                        <input type="text"  id="supplier_contact" name="supplier_contact"value="<?php echo e(old('supplier_contact')); ?>"  >
                        <label  class="suppilerinputone"for="supplier_contact">Enter Supplier Contact <span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['supplier_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        
                        <input type="text"  id="contact_person_name" name="contact_person_name"value="<?php echo e(old('contact_person_name')); ?>"  >
                        <label  class="suppilerinputtwo"for="contact_person_name">Enter Contact Person Name <span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['contact_person_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        
                        <input type="text"  id="contact_person_phone" name="contact_person_phone"value="<?php echo e(old('contact_person_phone')); ?>"   >
                        <label  class="suppilerinputthree"for="contact_person_phone">Enter Contact Person  Phone<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['contact_person_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        
                        <input type="text"  id="drug_license_number" name="drug_license_number"value="<?php echo e(old('drug_license_number')); ?>"  >
                        <label  class="suppilerinputfour"for="drug_license_number">Enter Drug License Number<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['drug_license_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        
                        <input type="text"  id="address" name="address" >
                        <label  class="suppilerinputfive"for="address">Address<span class="text-danger">*</span></label>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Supplier</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Supplier List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Supplier Name</th>
                                <th class="border-bottom-0">Supplier Contact</th>
                                <th class="border-bottom-0">Contact Person Name</th>
                                <th class="border-bottom-0">Contact Person Phone</th>
                                <th class="border-bottom-0">Drug License Number</th>
                                <th class="border-bottom-0">Address</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine supplier','delete medicine supplier')): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->supplier_name); ?></td>
                                <td><?php echo e($item->supplier_contact); ?></td>
                                <td><?php echo e($item->contact_person_name); ?></td>
                                <td><?php echo e($item->contact_person_phone); ?></td>
                                <td><?php echo e($item->drug_license_number); ?></td>
                                <td><?php echo e($item->address); ?></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit medicine supplier')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-medicine-supplier-details',['id'=>$item->id])); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete medicine supplier')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('delete-medicine-supplier-details',['id'=>$item->id])); ?>"><i class="fa fa-trash"></i> Delete</a>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/setup/pharmacy/supplier/medicine-supplier-listing.blade.php ENDPATH**/ ?>