<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href=""><i class="fa fa-home"></i> Profile</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href="{{ route('add-oxygen-monitoring-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-dna"></i> Oxygen Monitoring</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href="{{ route('show-medicaiton-dose', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-tablets"></i> Medication</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href="{{ route('show-ipd-operation-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-scissors"></i> Operation</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href=""><i class="fa fa-user-nurse"></i> Nurse Note</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href=""><i class="fa fa-file-alt"></i> Charges</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href=""><i class="fa fa-rupee-sign"></i> Payment</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href=""><i class="fa fa-bed"></i> Bed History</a>
<a class="dropdown-item {{ Request::segment(2) == 'ipd-timeline' ? 'active' : '' }}" href="{{ route('timeline-lisitng-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="far fa-calendar-check"></i> Timeline</a>