<a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}"
    href="{{ route('opd-profile', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-home"></i>
    Profile</a>
@can('opd billing')
    <a class="dropdown-item {{ Request::segment(2) == 'opd-billing' ? 'active' : '' }}"
        href="{{ route('opd-billing', ['id' => base64_encode($opd_patient_details->id)]) }}"><i class="fa fa-money-bill"></i>
        Billing</a>
@endcan
<a class="dropdown-item {{ Request::segment(2) == 'opd-payment' ? 'active' : '' }}"
    href="{{ route('payment-listing-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i
        class="fa fa-rupee-sign"></i> Payment</a>
<a class="dropdown-item {{ Request::segment(2) == 'opd-timeline' ? 'active' : '' }}"
    href="{{ route('timeline-lisitng-in-opd', ['id' => base64_encode($opd_patient_details->id)]) }}"><i
        class="far fa-calendar-check"></i> Timeline</a>
