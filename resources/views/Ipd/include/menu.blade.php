<div class="scrollable">
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-profile' ? 'active' : '' }}" href="{{ route('ipd-profile', ['id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-home"></i> Profile</a>
    <a class="dropdown-item {{ Request::segment(2) == 'oxygen-monitoring' ? 'active' : '' }}" href="{{ route('add-oxygen-monitoring-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-dna"></i> Oxygen Monitoring</a>
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-medication' ? 'active' : '' }}" href="{{ route('show-medicaiton-dose', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-tablets"></i> Medication</a>
    <!-- <a class="dropdown-item {{ Request::segment(2) == 'ipd-operation' ? 'active' : '' }}" href="{{ route('show-ipd-operation-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-scissors"></i> Operation</a> -->

    <a class="dropdown-item {{ Request::segment(2) == 'ipd-nurse-note' ? 'active' : '' }}" href="{{ route('ipd-nurse-note-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-user-nurse"></i> Nurse Note</a>
    @can('ipd billing')
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-billing' ? 'active' : '' }}" href="{{ route('ipd-billing', ['id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-money-bill"></i> Billing</a>
    @endcan
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-charges' ? 'active' : '' }}" href="{{ route('charges-list-ipd', ['id' => base64_encode(@$ipd_details->id)]) }}"><i class="fa fa-file-alt"></i> Add Charges</a>

    <a class="dropdown-item {{ Request::segment(2) == 'ipd-payment' ? 'active' : '' }}" href="{{ route('ipd-payment-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-rupee-sign"></i> Payment</a>
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-bed-history' ? 'active' : '' }}" href="{{ route('bed-transfar-history-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-bed"></i> Bed History</a>
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-physical-condition' ? 'active' : '' }}" href="{{ route('physical-condition-in-ipd', ['ipd_id' => base64_encode(@$ipd_details->id)]) }}"><i class="fa fa-prescription-bottle"></i> Physical Condition </a>

    <a class="dropdown-item {{ Request::segment(2) == 'ipd-discharged' ? 'active' : '' }}" href="{{ route('discharged-patient-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="far fa-calendar-check"></i> Discharge Patient</a>
    
    @can('IPD Pathology Investigation')
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-pathology-investigation' ? 'active' : '' }}" href="{{ route('ipd-pathology-investigation', ['id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-microscope"></i> Pathology Investigation</a>
    @endcan

    @can('IPD Radiology Investigation')
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-radiology-investigation' ? 'active' : '' }}" href="{{ route('ipd-radiology-investigation', ['id' => base64_encode($ipd_details->id)]) }}"> <i class="fa fa-x-ray"></i> Radiology Investigation</a>
    @endcan
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-timeline' ? 'active' : '' }}" href="{{ route('timeline-lisitng-in-ipd', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="far fa-calendar-check"></i> Timeline</a>
    <a class="dropdown-item {{ Request::segment(2) == 'ipd-operation' ? 'active' : '' }}" href="{{ route('ipd-operation-in-ipd', ['id' => base64_encode($ipd_details->id)]) }}"><i class="far fa-calendar-check"></i> Operation</a>

    <a class="dropdown-item {{ Request::segment(2) == 'ipd-blood-details' ? 'active' : '' }}" href="{{ route('blood-bank-detials-in-ipd', ['id' => base64_encode($ipd_details->id)]) }}"><i class="fas fa-tint"></i>Blood Details</a>
 


</div>