<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('opd-profile', ['id' => base64_encode($opd_patient_details->id)])); ?>"><i class="fa fa-home"></i>
    Profile</a>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd billing')): ?>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-billing' ? 'active' : ''); ?>" href="<?php echo e(route('opd-billing', ['id' => base64_encode($opd_patient_details->id)])); ?>"><i class="fa fa-money-bill"></i>
    Billing</a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient charges')): ?>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'patient-charge' ? 'active' : ''); ?>" href="<?php echo e(route('charges-list', ['id' => base64_encode($opd_patient_details->id)])); ?>"><i class="fa fa-file"></i> Add Charges</a>
<?php endif; ?>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-payment' ? 'active' : ''); ?>" href="<?php echo e(route('payment-listing-in-opd', ['id' => base64_encode($opd_patient_details->id)])); ?>"><i class="fa fa-rupee-sign"></i> Payment</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-timeline' ? 'active' : ''); ?>" href="<?php echo e(route('timeline-lisitng-in-opd', ['id' => base64_encode($opd_patient_details->id)])); ?>"><i class="far fa-calendar-check"></i> Timeline</a>



<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-timeline' ? 'active' : ''); ?>" href="<?php echo e(route('physical-condition-in-opd', ['id' => base64_encode($opd_patient_details->id)])); ?>"><i class="fa fa-file"></i> Physical Conditions</a><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/OPD/include/menu.blade.php ENDPATH**/ ?>