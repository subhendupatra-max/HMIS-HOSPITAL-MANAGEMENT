<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href="{{ route('opd-profile', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-home"></i>
    Profile</a>
@can('opd billing')
<a class="dropdown-item {{ Request::segment(2) == 'opd-billing' ? 'active' : '' }}" href="{{ route('opd-billing', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-money-bill"></i>
    Billing</a>
@endcan

{{-- @can('patient charges')
<a class="dropdown-item {{ Request::segment(2) == 'opd-patient-charge' ? 'active' : '' }}" href="{{ route('charges-list', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-file-invoice-dollar"></i> Add Charges</a>
@endcan --}}

<a class="dropdown-item {{ Request::segment(2) == 'opd-payment' ? 'active' : '' }}" href="{{ route('payment-listing-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-rupee-sign"></i> Payment</a>

<a class="dropdown-item {{ Request::segment(2) == 'opd-timeline' ? 'active' : '' }}" href="{{ route('timeline-lisitng-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="far fa-calendar-check"></i> Timeline</a>

@can('OPD Pathology Investigation')
<a class="dropdown-item {{ Request::segment(2) == 'opd-pathology-investigation' ? 'active' : '' }}" href="{{ route('opd-pathology-investigation', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-microscope"></i> Pathology Investigation</a>
@endcan

@can('OPD Radiology Investigation')
<a class="dropdown-item {{ Request::segment(2) == 'opd-radiology-investigation' ? 'active' : '' }}" href="{{ route('opd-radiology-investigation', ['id' => base64_encode($opd_patient_details->id)]) }}"> <i class="fa fa-x-ray"></i> Radiology Investigation</a>
@endcan

{{-- <a class="dropdown-item {{ Request::segment(2) == 'bill-summary' ? 'active' : '' }}" href="{{ route('create-bill-summary', ['id' => base64_encode($opd_patient_details->id),'case_id'=>base64_encode($opd_patient_details->case_id)]) }}"><i class="fa fa-file"></i> Bill Summary</a> --}}

<a class="dropdown-item {{ Request::segment(2) == 'opd-timeline' ? 'active' : '' }}" href="{{ route('physical-condition-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-receipt"></i> Physical Conditions</a>

<a class="dropdown-item {{ Request::segment(2) == 'opd-operation' ? 'active' : '' }}" href="{{ route('opd-operation-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-receipt"></i> Operation</a>

<a class="dropdown-item {{ Request::segment(2) == 'opd-blood-issue' ? 'active' : '' }}" href="{{ route('blood-bank-detials-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fas fa-tint"></i> Blood Details</a>

<a class="dropdown-item {{ Request::segment(2) == 'opd-blood-issue' ? 'active' : '' }}" href="{{ route('prescription-lisitng-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa  fa-file-prescription "></i> Prescription</a>
