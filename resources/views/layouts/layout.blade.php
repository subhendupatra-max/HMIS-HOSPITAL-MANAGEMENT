<?php $general_details = DB::table('general_settings')->first();
$login_details = DB::table('users')
    ->where('id', Auth::id())
    ->where('is_active', '1')
    ->first();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:28:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Jquery cdn -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>




    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <!-- Title -->
    <title>{{ @$general_details->software_name }}</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('public/assets/images/brand') }}/{{ @$general_details->small_logo }}" type="image/x-icon" />

    <!--Bootstrap css -->
    <link href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/skin-modes.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/wysiwyag/richtext.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('public/assets/css/animated.css') }}" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="{{ asset('public/assets/css/sidemenu.css') }}" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{ asset('public/assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet" />

    <!-- Data table css -->
    <link href="{{ asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <!-- Slect2 css -->
    <link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


    <!-- Simplebar css -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/simplebar/css/simplebar.css') }}">

    <!-- Color Skin css -->
    <link id="theme" href="{{ asset('public/assets/colors/color1.css') }}" rel="stylesheet" type="text/css" />

    <!-- Switcher css -->
    <link rel="stylesheet" href="{{ asset('public/assets/switcher/css/switcher.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/switcher/demo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="app sidebar-mini">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('public/assets/images/svgs/Doctors_symbol.gif') }}" alt="loader" width="100px" height="100px">
    </div>
    <!--- End Global-loader-->
    <div class="new-page">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="{{ asset('public/assets/images/brand/dashlogo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @if (auth()->user()->can('Human Resource'))
                    <li class="nav-item dropdown {{ Request::segment(1) == 'Human-Resource' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}"></div> HR
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->can('User List'))
                            <a class="dropdown-item" href="{{ route('user-list') }}">User List</a>
                            @endif
                            @if (auth()->user()->can('User Add'))
                            <a class="dropdown-item" href="{{ route('UserCreate') }}">Add new user</a>
                            @endif
                        </div>
                    </li>
                    @endif
                    @if (auth()->user()->can('Patient Master'))
                    <li class="nav-item {{ Request::segment(1) == 'Patient' ? 'nav-active' : '' }}">
                        <a class="nav-link" href="{{ route('patient_details') }}">
                            <div class="icon-new"> <img src="{{ asset('public/assets/images/brand/hospitalisation.png') }}"></div>Patient
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('OPD out-patients'))
                    <li class="nav-item {{ Request::segment(1) == 'opd' ? 'nav-active' : '' }}">
                        <a class="nav-link" href="{{ route('OPD-Patient-list') }}">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/patient.png') }}">
                            </div>Opd
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('Emergency Patients'))
                    <li class="nav-item {{ Request::segment(1) == 'emg' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('emg-patient-list') }}">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/hospital-bed.png') }}">
                            </div>EMG
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('IPD ipd-patients'))
                    <li class="nav-item {{ Request::segment(1) == 'IPD' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ipd-patient-listing') }}">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/patient (1).png') }}">
                            </div>IPD
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/invoice.png') }}">
                            </div>Bill
                        </a>
                    </li>
                    @if (auth()->user()->can('discount'))
                    <li class="nav-item {{ Request::segment(1) == 'discount' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('discount-list') }}">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/offer.png') }}"></div>
                            Discount
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('pharmacy main'))
                    <li class="nav-item {{ Request::segment(1) == 'pharmacy' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pharmacy-bill-listing') }}">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}"></div>Pharmacy
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}"></div>
                            Investigation
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->can('pathology main'))
                            <a class="dropdown-item {{ Request::segment(1) == 'radiology' ? 'active' : '' }}" href="{{ route('pathology-test-charge') }}">Pathology</a>
                            @endif
                            @if (auth()->user()->can('radiology main'))
                            <a class="dropdown-item {{ Request::segment(1) == 'radiology' ? 'active' : '' }}" href="{{ route('radiology-test-charge') }}">Radiology</a>
                            @endif
                        </div>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/hospital-bed (1).png') }}"></div>Bed
                        </a>
                    </li> -->
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="icon-new"><img src="{{ asset('public/assets/images/brand/settings.png') }}">
            </div> Set up
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="{{ route('general_setting_details') }}">General
                        Setting</a></li>
                <li><a class="dropdown-item" href="#">Inventory</a></li>
                <li><a class="dropdown-item" href="#">Pharmacy</a></li>
                <li><a class="dropdown-item" href="#">Finding</a></li>
                <li><a class="dropdown-item" href="#">All Header</a></li>
                <li><a class="dropdown-item" href="#">Operation</a></li>
                <li><a class="dropdown-item" href="#">Opd</a></li>
                <li><a class="dropdown-item" href="#">Emg</a></li>
                <li><a class="dropdown-item" href="#">Pathology</a></li>
                <li><a class="dropdown-item" href="#">Radiology</a></li>
                <li><a class="dropdown-item" href="#">Blood Bank</a></li>
                <li><a class="dropdown-item" href="#">Appointment</a></li>
                <li><a class="dropdown-item" href="#">Department</a></li>
                <li><a class="dropdown-item" href="#">Bed Details</a></li>
                <li><a class="dropdown-item" href="#">Symptoms</a></li>
            </ul>
            </li> --}}
            <div class=" menu-item">
                <div class="icon-new1"><img src="{{ asset('public/assets/images/brand/settings.png') }}"></div>
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Setup <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if (auth()->user()->can('General Setting'))
                        <li><a href="{{ route('general_setting_details') }}">General Settings</a></li>
                        @endif

                        @if (auth()->user()->can('Charges Master'))
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">Charges <i class="fa fa-chevron-right"></i></a>
                            <ul class="dropdown-menu">
                                @can('charges')
                                <li><a href="{{ route('charges-details') }}">Charges</a></li>
                                @endcan
                                @can('charges catagory')
                                <li><a href="{{ route('charges-catagory-details') }}">Charges Catagory</a></li>
                                @endcan
                                @can('charges sub catagory')
                                <li><a href="{{ route('charges-sub-catagory-details') }}">Charges sub
                                        catagory</a></li>
                                @endcan
                                {{-- @can('charges unit')
                                <li><a href="{{ route('charges-unit-details') }}">Charges Unit</a>
                        </li>
                        @endcan --}}
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('front office'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Front Office <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('purpose')
                        <li><a href="{{ route('add-purpose-in-front-office') }}">Purpose</a></li>
                        @endcan
                        @can('complain type')
                        <li><a href="{{ route('add-complain-type-in-front-office') }}">Complain Type</a>
                        </li>
                        @endcan
                        @can('source')
                        <li><a href="{{ route('add-source-in-front-office') }}">Source</a></li>
                        @endcan
                        @can('appointment priority')
                        <li><a href="{{ route('add-appointment-priority-in-front-office') }}">Appointment
                                Priority</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('charges package'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Charges Package <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('package name')
                        <li><a href="{{ route('charges-package-name-details') }}">package name</a></li>
                        @endcan
                        @can('package catagory')
                        <li><a href="{{ route('charges-package-catagory-details') }}">package
                                catagory</a></li>
                        @endcan
                        @can('package sub catagory')
                        <li><a href="{{ route('charges-package-sub-catagory-details') }}">package sub
                                catagory</a></li>
                        @endcan
                    </ul>
                </li>
                @endif

                @if (auth()->user()->can('Setup Inventory'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Setup Inventory <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('Inventory Item')
                        <li><a href="{{ route('inventory-item-list') }}">Inventory Item</a></li>
                        @endcan
                        @can('Inventory Item Catagory')
                        <li><a href="{{ route('add-inventory-item-catagory') }}">Inventory Item
                                Catagory</a></li>
                        @endcan
                        @can('Inventory Item Unit')
                        <li><a href="{{ route('add-inventory-item-unit') }}">Inventory Item Unit</a>
                        </li>
                        @endcan
                        @can('Inventory Item Brand')
                        <li><a href="{{ route('add-inventory-item-brand') }}">Inventory Item Brand</a>
                        </li>
                        @endcan
                        @can('Inventory Item Manufacture')
                        <li><a href="{{ route('add-inventory-manufacture') }}">Inventory Item
                                Manufacture</a></li>
                        @endcan
                        @can('Inventory Item Type')
                        <li><a href="{{ route('add-inventory-item-type') }}">Inventory Item Type</a>
                        </li>
                        @endcan
                        @can('Inventory Store Room')
                        <li><a href="{{ route('add-inventory-item-store-room') }}">Inventory Store
                                Room</a></li>
                        @endcan
                        @can('Inventory Item Attribute')
                        <li><a href="{{ route('inventory-item-attribute') }}">Inventory Item
                                Attribute</a></li>
                        @endcan
                        @can('Inventory Vendor')
                        <li><a href="{{ route('inventory-vendor') }}">Inventory Vendor</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('setup pharmacy'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#"> Pharmacy<i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('medicine storeroom')
                        <li><a href="{{ route('medicine-store-room-details') }}">medicine storeroom</a>
                        </li>
                        @endcan
                        @can('medicine store')
                        <li><a href="{{ route('medicine-store-details') }}">medicine store</a></li>
                        @endcan
                        @can('medicine rack')
                        <li><a href="{{ route('medicine-rack-details') }}">medicine rack</a></li>
                        @endcan
                        @can('medicine supplier')
                        <li><a href="{{ route('medicine-supplier-details') }}">medicine supplier</a>
                        </li>
                        @endcan
                        @can('medicine dosage')
                        <li><a href="{{ route('medicine-dosage-details') }}">medicine dosage</a></li>
                        @endcan
                        @can('medicine unit')
                        <li><a href="{{ route('medicine-unit-details') }}">medicine unit</a></li>
                        @endcan
                        @can('dose interval')
                        <li><a href="{{ route('dose-interval-details') }}">dose interval</a></li>
                        @endcan
                        @can('dose duration')
                        <li><a href="{{ route('dose-duration-details') }}">dose duration</a></li>
                        @endcan
                        @can('medicine vendor')
                        <li><a href="{{ route('medicine-vendor-details') }}">medicine vendor</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('Finding'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Finding<i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('Finding')
                        <li><a href="{{ route('finding') }}">Finding</a></li>
                        @endcan
                        @can('finding category')
                        <li><a href="{{ route('finding-category-add') }}">finding category</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('All Header'))
                <li><a href="{{ route('all-header-listing') }}">All Header</a></li>
                @endif
                @if (auth()->user()->can('Master Operation'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Operation <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                        <li><a href="{{ route('operation-details') }}">operation-details</a></li>
                        <li><a href="{{ route('operation-catagory-details') }}">operation-catagory-details</a>
                        </li>
                        @can('operation type')
                        <li><a href="{{ route('operation-type-details') }}">operation-type-details</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('Opd'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Opd <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('opd unit')
                        <li><a href="{{ route('opd-unit-details') }}">opd-unit-details</a></li>
                        @endcan
                        @can('opd setup')
                        <li><a href="{{ route('opd-setup-details') }}">opd-setup-details</a></li>
                        @endcan
                        @can('opd ticket fees')
                        <li><a href="{{ route('opd-ticket-fees-details') }}">opd-ticket-fees-details</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('Emg setUp'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Emg setUp <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Emg setUp</a></li>
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('pathology'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">pathology <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('pathology catagory')
                        <li><a href="{{ route('pathology-catagory-details') }}">pathology catagory</a>
                        </li>
                        @endcan
                        @can('pathology unit')
                        <li><a href="{{ route('pathology-unit-details') }}">pathology unit</a></li>
                        @endcan
                        @can('pathology parameter')
                        <li><a href="{{ route('pathology-parameter-details') }}">pathology parameter</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                @if (auth()->user()->can('radiology'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">radiology <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('radiology catagory')
                        <li><a href="{{ route('radiology-catagory-details') }}">radiology catagory</a>
                        </li>
                        @endcan
                        @can('radiology unit')
                        <li><a href="{{ route('radiology-unit-details') }}">radiology unit</a></li>
                        @endcan
                        @can('radiology parameter')
                        <li><a href="{{ route('radiology-parameter-details') }}">radiology parameter</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                @if (auth()->user()->can('blood bank'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Blood bank <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('blood bank product')
                        <li><a href="{{ route('blood-bank-product-details') }}">blood bank product</a>
                        </li>
                        @endcan
                        @can('Blood unit type')
                        <li><a href="{{ route('add-blood-unit-type') }}">Blood unit type</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('appointment'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Appointment <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('shift')
                        <li><a href="{{ route('shift-details') }}">shift-details</a></li>
                        @endcan
                        @can('slots')
                        <li><a href="{{ route('slots-details') }}">slots-details</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('symptoms'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">symptoms <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('symptoms head')
                        <li><a href="{{ route('symptoms-head-details') }}">symptoms head</a></li>
                        @endcan
                        @can('symptoms type')
                        <li><a href="{{ route('symptoms-type-details') }}">symptoms type</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('Department'))
                <li><a href="{{ route('department-details') }}">Department</a></li>
                @endif
                @if (auth()->user()->can('tpa management'))
                <li><a href="{{ route('tpa-management-details') }}">tpa management</a></li>
                @endif
                @if (auth()->user()->can('diagonasis'))
                <li><a href="{{ route('diagonasis-details') }}">diagonasis</a></li>
                @endif
                @if (auth()->user()->can('prefix'))
                <li><a href="{{ route('prefixList') }}">prefix</a></li>
                @endif
                @if (auth()->user()->can('Bed Master'))
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Bed <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                        @can('bed')
                        <li><a href="{{ route('bed-details') }}">bed</a></li>
                        @endcan
                        @can('bed type')
                        <li><a href="{{ route('bed-type-details') }}">bed type</a></li>
                        @endcan
                        @can('bedUnit')
                        <li><a href="{{ route('bed-unit-details') }}">bedUnit</a></li>
                        @endcan
                        @can('bedgroup')
                        <li><a href="{{ route('bedgroup-details') }}">bedgroup</a></li>
                        @endcan
                        @can('ward')
                        <li><a href="{{ route('ward-details') }}">ward</a></li>
                        @endcan
                        @can('floor')
                        <li><a href="{{ route('floor-details') }}">floor</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                </ul>
                </li>
            </div>

            <div class=" menu-item">
                <div class="icon-new1"><img src="{{ asset('public/assets/images/brand/settings.png') }}"></div>
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Others <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Inventory</a></li>
                        @if (auth()->user()->can('appointment main'))
                        <li><a href="{{ route('all-appointments-details') }}">Appointment</a></li>
                        @endif
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">Birth and Death record<i class="fa fa-chevron-right"></i></a>
                            <ul class="dropdown-menu">

                                <li><a href="#">Birth Record</a></li>
                                <li><a href="{{ route('death-record') }}">Death Record</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">False Generation<i class="fa fa-chevron-right"></i></a>
                            <ul class="dropdown-menu">


                                <li><a href="#">Opd</a></li>
                                <li><a href="#">Ipd</a></li>

                            </ul>
                        </li>
                        @if (auth()->user()->can('referral'))
                        <li><a href="{{ route('referral') }}">Refferal</a></li>
                        @endif
                        <li><a href="#">Font office</a></li>
                        <li><a href="{{ route('all-blood-details') }}">Blood Bank</a></li>
                        <li><a href="{{ route('main-operation') }}">Operation</a></li>
                        @if (auth()->user()->can('ambulance'))
                        <li><a href="{{ route('ambulance-call-details') }}">Ambulance</a></li>
                        @endif
                        @if (auth()->user()->can('front office'))
                        <li><a href="{{ route('all-visit-details') }}">Front Office</a></li>
                        @endif
                        @if (auth()->user()->can('view role') ||
                        auth()->user()->can('asign userBasedPermission') ||
                        auth()->user()->can('view permission') ||
                        auth()->user()->can('asign roleToUser') ||
                        auth()->user()->can('view permission'))
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">Permission<i class="fa fa-chevron-right"></i></a>
                            <ul class="dropdown-menu">

                                <li><a href="{{ route('roleList') }}">Role</a></li>
                                <li><a href="{{ route('PermissionList') }}"> Permission</a></li>

                            </ul>
                        </li>
                        @endif

            </div>

            </ul>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'pharmacy' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('bed-status-list') }}">
                    <div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}"></div>Bed
                </a>
            </li>

            @if (auth()->user()->can('Report'))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}"></div>
                    Reports
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (auth()->user()->can('OPD Patient Report'))
                    <a class="dropdown-item" href="{{ route('opd-patient-report') }}">OPD Patient Report</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('opd-billing-report') }}">OPD Billing Report</a>
                    @if (auth()->user()->can('EMG Patient Report'))
                    <a class="dropdown-item" href="{{ route('emg-patient-report') }}">EMG Patient Report</a>
                    @endif
                    @if (auth()->user()->can('EMG Billing Report'))
                    <a class="dropdown-item" href="{{ route('emg-billing-report') }}">EMG Billing Report</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('ipd-patient-report') }}">IPD Patient Report</a>
                    @if (auth()->user()->can('IPD Billing Report'))
                    <a class="dropdown-item" href="{{ route('ipd-billing-report') }}">IPD Billing Report</a>
                    @endif
                    @if (auth()->user()->can('Payment Report'))
                    <a class="dropdown-item" href="{{ route('payment-report') }}">Payment Report</a>
                    @endif
                    @if (auth()->user()->can('Discharge Patient Report'))
                    <a class="dropdown-item" href="{{ route('discharge-patient-report') }}">Discharge Patient Report</a>
                    @endif
                    @if (auth()->user()->can('Pharmacy Bill Report'))
                    <a class="dropdown-item" href="{{ route('pharmacy-bill-report') }}">Pharmacy Bill Report</a>
                    @endif
                    @if (auth()->user()->can('Operaiton Report'))
                    <a class="dropdown-item" href="{{ route('operation-report') }}">Operaiton Report</a>
                    @endif
                    @if (auth()->user()->can('Blood Issue Report'))
                    <a class="dropdown-item" href="{{ route('blood-issue-report') }}">Blood Issue Report</a>
                    @endif
                    @if (auth()->user()->can('Blood Components Issue Report'))
                    <a class="dropdown-item" href="{{ route('blood-components-issue-report') }}">Blood Components Issue Report</a>
                    @endif
                    @if (auth()->user()->can('Blood Donor Report'))
                    <a class="dropdown-item" href="{{ route('blood-donor-details') }}">Blood Donor Report</a>
                    @endif
                    @if (auth()->user()->can('Death Report'))
                    <a class="dropdown-item" href="{{ route('patient-death-details') }}">Death Report</a>
                    @endif
                </div>
            </li>
            @endif

            </ul>




    </div>

    {{-- <form class="form-inline my-2 my-lg-0"> --}}
    <div class="popup-link">
        <a href="#popup1">
            <div class="dashprofileimg"><img src="{{ asset('public/profile_picture') }}/{{ $login_details->profile_image }}"></div>
    </div>
    <div id="popup1" class="popup-container">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <img src="{{ asset('public/profile_picture') }}/{{ $login_details->profile_image }}" style="width: 50px;
            height: 50px;
            cursor: default;
            margin: 0px 0px 0px 109px;">
            <h3 style="margin: 5px 0px 0px 65px;"> {{ $login_details->first_name }}
                {{ $login_details->last_name }}
            </h3>
            <span class="badge badge-light badge-pill" style="margin:5px 0px 10px 54px;">{{
                            $login_details->role }}</span>

            <a class="btn btn-success btn-sm" href="{{ route('user-profile') }}/{{ base64_encode(Auth::id()) }}"><i class='fas fa-address-card'></i> Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary btn-sm text-center" style="margin: 0px 0px 0px 99px" type="submit"><i class="fa fa-sign-out-alt"></i> Log Out</button>
            </form>
        </div>
    </div>
    {{-- <div class="dash-bellicon">
                    <div class="bell">
                        <div class="popup-link">
                            <a href="#popup1notification">
                                <div class="dashprofileimg"> <img
                                        src="{{ asset('public/assets/images/brand/bell.png') }}"></div>
    </div>
    <div id="popup1notification" class="popup-container">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3> <img src="{{ asset('public/assets/images/brand/user.png') }}">Name</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
        </div>
    </div>
    </div>
    </div> --}}
    {{--
            </form> --}}

    </div>


    <div class="row">
        @yield('content')
    </div>

    <!--Footer-->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-12 footer-text">
                    Copyright © 2022 <a href="#">{{ @$general_details->software_name }}</a>. Designed by <a href="https://devantitsolutions.com/" target="_blank">Devant IT Solutions Pvt. Ltd.</a>
                    All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>


    <!-- Jquery js-->
    <script src="{{ asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>

    <!-- Bootstrap4 js-->
    <script src="{{ asset('public/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--Othercharts js-->
    <script src="{{ asset('public/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Circle-progress js-->
    <script src="{{ asset('public/assets/js/circle-progress.min.js') }}"></script>

    <!-- Jquery-rating js-->
    <script src="{{ asset('public/assets/plugins/rating/jquery.rating-stars.js') }}"></script>

    <!--Sidemenu js-->
    <script src="{{ asset('public/assets/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('public/assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/p-scrollbar/p-scroll.js') }}"></script>


    <!--INTERNAL Peitychart js-->
    <script src="{{ asset('public/assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/peitychart/peitychart.init.js') }}"></script>

    <!--INTERNAL Apexchart js-->
    <script src="{{ asset('public/assets/js/apexcharts.js') }}"></script>

    <!--INTERNAL ECharts js-->
    <script src="{{ asset('public/assets/plugins/echarts/echarts.js') }}"></script>

    <!--INTERNAL Chart js -->
    <script src="{{ asset('public/assets/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{ asset('public/assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/select2.js') }}"></script>

    <!--INTERNAL Moment js-->
    <script src="{{ asset('public/assets/plugins/moment/moment.js') }}"></script>

    <!--INTERNAL Index js-->
    <script src="{{ asset('public/assets/js/index1.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('public/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <!-- Custom js-->
    <script src="{{ asset('public/assets/js/custom.js') }}"></script>

    <!-- INTERNAL Data tables -->
    <script src="{{ asset('public/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/datatables.js') }}"></script>

    <script src="{{ asset('public/assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/assets/js/flot.js') }}"></script>



    <!-- Switcher js-->
    <script src="{{ asset('public/assets/switcher/js/switcher.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="{{ asset('public/assets/plugins/notify/js/notifIt.js') }}"></script>
    <!-- INTERNAL WYSIWYG Editor js -->
    <script src="{{ asset('public/assets/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ asset('public/assets/js/form-editor.js') }}"></script>
    {{-- --}}

    {{-- --}}

</body>

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:29:24 GMT -->

</html>




<script type="text/javascript">
    function get_all_patient_result() {
        $('#search_result_for_patient').empty();
        var patient_search_name = $('#patient_entry_reslt').val();
        if (patient_search_name != '') {
            var div_data_serch_res = '';
            $.ajax({

                url: "{{ route('get-patient-serach') }}",
                type: "post",
                data: {
                    patient__id: patient_search_name,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $.each(res, function(i, obj) {
                        div_data_serch_res +=
                            `<tr><td><a class="dropdown-item" href="#" ><span style="color:blue">Name: </span>${obj.prefix} ${obj.first_name} ${obj.middle_name} ${obj.last_name} <span style="color:red"> // </span><span style="color:blue">G. Name: </span>${obj.guardian_name}<span style="color:red"> // </span><span style="color:blue">Ph.no: </span>${obj.phone}<br> <span style="color:blue">Address: </span> ${obj.address}</a></td></tr>`;

                    });

                    $('#search_result_for_patient').html(div_data_serch_res);

                }
            });
        }
    }
</script>