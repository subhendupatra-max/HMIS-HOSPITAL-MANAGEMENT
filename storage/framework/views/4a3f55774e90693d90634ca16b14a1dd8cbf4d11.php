<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-profile' ? 'active' : ''); ?>" href="<?php echo e(route('opd-profile', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-home"></i>
    Profile</a>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('emg billing')): ?>
<!-- <a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-billing' ? 'active' : ''); ?>" href="#"><i class="fa fa-money-bill"></i>
    Billing</a> -->
<?php endif; ?>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-payment' ? 'active' : ''); ?>" href="<?php echo e(route('payment-listing-in-emg', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-rupee-sign"></i> Payment</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-timeline' ? 'active' : ''); ?>" href="<?php echo e(route('timeline-lisitng-in-emg', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="far fa-calendar-check"></i> Timeline</a>

<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-billing' ? 'active' : ''); ?>" href="<?php echo e(route('emg-billing', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-money-bill"></i>
    Billing</a>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient charges')): ?>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-patient-charge' ? 'active' : ''); ?>" href="<?php echo e(route('charges-list-emg', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-file-invoice-dollar"></i> Add Charges</a>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Emg Pathology Investigation')): ?>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-pathology-investigation' ? 'active' : ''); ?>" href="<?php echo e(route('emg-pathology-investigation', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-microscope"></i> Pathology Investigation</a>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Opd Radiology Investigation')): ?>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-pathology-investigation' ? 'active' : ''); ?>" href="<?php echo e(route('emg-radiology-investigation', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-x-ray"></i> Radiology Investigation</a>
<?php endif; ?>

<!-- 
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-timeline' ? 'active' : ''); ?>" href="<?php echo e(route('timeline-lisitng-in-opd', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-file"></i> Bill Summary</a> -->
<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-timeline' ? 'active' : ''); ?>" href="<?php echo e(route('physical-condition-in-emg', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fa fa-file"></i> Physical Conditions</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-operation' ? 'active' : ''); ?>" href="<?php echo e(route('emg-operation-in-emg', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="far fa-calendar-check"></i> Operation</a>

<a class="dropdown-item <?php echo e(Request::segment(2) == 'emg-pathology-investigation' ? 'active' : ''); ?>" href="<?php echo e(route('blood-bank-detials-in-emg', ['id' => base64_encode($emg_patient_details->id)])); ?>"><i class="fas fa-tint"></i> Blood Details</a>
<?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/emg/include/menu.blade.php ENDPATH**/ ?>