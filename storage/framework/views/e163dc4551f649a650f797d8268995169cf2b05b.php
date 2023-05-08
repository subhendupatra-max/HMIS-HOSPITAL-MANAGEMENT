<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href=""><i class="fa fa-home"></i> Profile</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('add-oxygen-monitoring-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-dna"></i> Oxygen Monitoring</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('show-medicaiton-dose', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-tablets"></i> Medication</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('show-ipd-operation-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-scissors"></i> Operation</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-nurse-note-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-user-nurse"></i> Nurse Note</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href=""><i class="fa fa-file-alt"></i> Charges</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-payment-details', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-rupee-sign"></i> Payment</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('bed-transfar-history-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-bed"></i> Bed History</a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'opd-profile' ? 'active' : ''); ?>" href="<?php echo e(route('physical-condition-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="fa fa-bed"></i> Physical Condition </a>
<a class="dropdown-item <?php echo e(Request::segment(2) == 'ipd-timeline' ? 'active' : ''); ?>" href="<?php echo e(route('timeline-lisitng-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)])); ?>"><i class="far fa-calendar-check"></i> Timeline</a><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/include/menu.blade.php ENDPATH**/ ?>