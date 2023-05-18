<div class="scrollable">
<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href=""><i class="fa fa-home"></i> Profile</a>
<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('add-oxygen-monitoring-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-dna"></i> Oxygen Monitoring</a>
<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('show-medicaiton-dose', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-tablets"></i> Medication</a>
<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('show-ipd-operation-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-scissors"></i> Operation</a>

<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('ipd-nurse-note-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-user-nurse"></i> Nurse Note</a>
@can('ipd billing')
<a class="dropdown-item {{ Request::segment(2) == 'ipd-billing' ? 'active' : '' }}" href="{{ route('ipd-billing', ['id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-money-bill"></i> Billing</a>
@endcan
<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('charges-list-ipd', ['id' => base64_encode(@$ipd_details->id)]) }}"><i class="fa fa-file-alt"></i>Add Charges</a>

<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('ipd-payment-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-rupee-sign"></i> Payment</a>
<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('bed-transfar-history-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-bed"></i> Bed History</a>
<a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('physical-condition-in-ipd', ['ipd_id' => base64_encode(@$ipd_details->id)]) }}"><i class="fa fa-bed"></i> Physical Condition </a>
<a class="dropdown-item {{ Request::segment(2) == 'ipd-timeline' ? 'active' : '' }}" href="{{ route('discharged-patient-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="far fa-calendar-check"></i>Discharge Patient</a>
@can('IPD Pathology Investigation')
<a class="dropdown-item {{ Request::segment(2) == 'ipd-pathology-investigation' ? 'active' : '' }}" href="{{ route('ipd-pathology-investigation', ['id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-microscope"></i> Pathology Investigation</a>
@endcan

@can('IPD Radiology Investigation')
<a class="dropdown-item {{ Request::segment(2) == 'ipd-radiology-investigation' ? 'active' : '' }}" href="{{ route('ipd-radiology-investigation', ['id' => base64_encode($ipd_details->id)]) }}"> <i class="fa fa-x-ray"></i> Radiology Investigation</a>
@endcan
<a class="dropdown-item {{ Request::segment(2) == 'ipd-timeline' ? 'active' : '' }}" href="{{ route('discharged-patient-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="far fa-calendar-check"></i> Timeline</a>
</div>