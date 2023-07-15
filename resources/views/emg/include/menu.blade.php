<a class="dropdown-item {{ Request::segment(2) == 'emg-profile' ? 'active' : '' }}" href="{{ route('opd-profile', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-home"></i>
    Profile</a>
@can('emg billing')
<!-- <a class="dropdown-item {{ Request::segment(2) == 'opd-billing' ? 'active' : '' }}" href="#"><i class="fa fa-money-bill"></i>
    Billing</a> -->
@endcan

<a class="dropdown-item {{ Request::segment(2) == 'emg-payment' ? 'active' : '' }}" href="{{ route('payment-listing-in-emg', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-rupee-sign"></i> Payment</a>

<a class="dropdown-item {{ Request::segment(2) == 'emg-timeline' ? 'active' : '' }}" href="{{ route('timeline-lisitng-in-emg', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="far fa-calendar-check"></i> Timeline</a>

<a class="dropdown-item {{ Request::segment(2) == 'emg-billing' ? 'active' : '' }}" href="{{ route('emg-billing', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-money-bill"></i>
    Billing</a>
{{-- @can('patient charges')
<a class="dropdown-item {{ Request::segment(2) == 'emg-patient-charge' ? 'active' : '' }}" href="{{ route('charges-list-emg', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-file-invoice-dollar"></i> Add Charges</a>
@endcan --}}

@can('Emg Pathology Investigation')
<a class="dropdown-item {{ Request::segment(2) == 'emg-pathology-investigation' ? 'active' : '' }}" href="{{ route('emg-pathology-investigation', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-microscope"></i> Pathology Investigation</a>
@endcan

@can('Opd Radiology Investigation')
<a class="dropdown-item {{ Request::segment(2) == 'emg-radiology-investigation' ? 'active' : '' }}" href="{{ route('emg-radiology-investigation', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-x-ray"></i> Radiology Investigation</a>
@endcan

<!-- 
<a class="dropdown-item {{ Request::segment(2) == 'opd-timeline' ? 'active' : '' }}" href="{{ route('timeline-lisitng-in-opd', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-file"></i> Bill Summary</a> -->
<a class="dropdown-item {{ Request::segment(2) == 'emg-physical-condition' ? 'active' : '' }}" href="{{ route('physical-condition-in-emg', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa fa-file"></i> Physical Conditions</a>
<a class="dropdown-item {{ Request::segment(2) == 'emg-operation-details' ? 'active' : '' }}" href="{{ route('emg-operation-in-emg', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="far fa-calendar-check"></i> Operation</a>

<a class="dropdown-item {{ Request::segment(2) == 'blood-bank-detials-in-emg' ? 'active' : '' }}" href="{{ route('blood-bank-detials-in-emg', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fas fa-tint"></i> Blood Details</a>

<a class="dropdown-item {{ Request::segment(2) == 'emg-prescription' ? 'active' : '' }}" href="{{ route('prescription-lisitng-in-emg', ['id' => base64_encode($emg_patient_details->id)]) }}"><i class="fa  fa-file-prescription "></i> Prescription</a>