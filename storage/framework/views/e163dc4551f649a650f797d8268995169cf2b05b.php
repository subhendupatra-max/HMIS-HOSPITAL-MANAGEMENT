<div class="scrollable">
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-profile', ['id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-home"></i> Profile</a>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'oxygen-monitoring' ? 'active' : ''); ?>" href="<?php echo e(route('add-oxygen-monitoring-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-dna"></i> Oxygen Monitoring</a>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-medication' ? 'active' : ''); ?>" href="<?php echo e(route('show-medicaiton-dose', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-tablets"></i> Medication</a>
    <!-- <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-operation' ? 'active' : ''); ?>" href="<?php echo e(route('show-ipd-operation-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-scissors"></i> Operation</a> -->

    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-nurse-note' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-nurse-note-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-user-nurse"></i> Nurse Note</a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ipd billing')): ?>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-billing' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-billing', ['id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-money-bill"></i> Billing</a>
    <?php endif; ?>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-charges' ? 'active' : ''); ?>" href="<?php echo e(route('charges-list-ipd', ['id' => base64_encode(@$ipd_details->id)])); ?>"><i class="fa fa-file-alt"></i> Add Charges</a>

    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-payment' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-payment-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-rupee-sign"></i> Payment</a>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-bed-history' ? 'active' : ''); ?>" href="<?php echo e(route('bed-transfar-history-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-bed"></i> Bed History</a>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-physical-condition' ? 'active' : ''); ?>" href="<?php echo e(route('physical-condition-in-ipd', ['ipd_id' => base64_encode(@$ipd_details->id)])); ?>"><i class="fa fa-prescription-bottle"></i> Physical Condition </a>

    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-discharged' ? 'active' : ''); ?>" href="<?php echo e(route('discharged-patient-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="far fa-calendar-check"></i> Discharge Patient</a>
    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('IPD Pathology Investigation')): ?>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-pathology-investigation' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-pathology-investigation', ['id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-microscope"></i> Pathology Investigation</a>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('IPD Radiology Investigation')): ?>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-radiology-investigation' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-radiology-investigation', ['id' => base64_encode($ipd_details->id)])); ?>"> <i class="fa fa-x-ray"></i> Radiology Investigation</a>
    <?php endif; ?>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-timeline' ? 'active' : ''); ?>" href="<?php echo e(route('timeline-lisitng-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="far fa-calendar-check"></i> Timeline</a>
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-operation' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-operation-in-ipd', ['id' => base64_encode($ipd_details->id)])); ?>"><i class="far fa-calendar-check"></i> Operation</a>

    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-blood-details' ? 'active' : ''); ?>" href="<?php echo e(route('blood-bank-detials-in-ipd', ['id' => base64_encode($ipd_details->id)])); ?>"><i class="fas fa-tint"></i>Blood Details</a>
 
    <a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-blood-details' ? 'active' : ''); ?>" href="<?php echo e(route('prescription-lisitng-in-ipd', ['id' => base64_encode($ipd_details->id)])); ?>"><i class="fa  fa-file-prescription "></i> Prescription</a>
 


</div><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/include/menu.blade.php ENDPATH**/ ?>