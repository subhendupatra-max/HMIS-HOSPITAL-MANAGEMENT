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
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>


    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <!-- Title -->
    <title><?php echo e(@$general_details->software_name); ?></title>

    <!--Favicon -->
    <link rel="icon" href="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->small_logo); ?>"
        type="image/x-icon" />

    <!--Bootstrap css -->
    <link href="<?php echo e(asset('public/assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Style css -->
    <link href="<?php echo e(asset('public/assets/css/style.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/css/dark.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/css/skin-modes.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/plugins/wysiwyag/richtext.css')); ?>" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- Animate css -->
    <link href="<?php echo e(asset('public/assets/css/animated.css')); ?>" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="<?php echo e(asset('public/assets/css/sidemenu.css')); ?>" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="<?php echo e(asset('public/assets/plugins/p-scrollbar/p-scrollbar.css')); ?>" rel="stylesheet" />

    <!---Icons css-->
    <link href="<?php echo e(asset('public/assets/css/icons.css')); ?>" rel="stylesheet" />

    <!-- Data table css -->
    <link href="<?php echo e(asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/assets/plugins/datatable/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <!-- Slect2 css -->
    <link href="<?php echo e(asset('public/assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />


    <!-- Simplebar css -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/plugins/simplebar/css/simplebar.css')); ?>">

    <!-- Color Skin css -->
    <link id="theme" href="<?php echo e(asset('public/assets/colors/color1.css')); ?>" rel="stylesheet" type="text/css" />

    <!-- Switcher css -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/switcher/css/switcher.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/switcher/demo.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="app sidebar-mini">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="<?php echo e(asset('public/assets/images/svgs/Doctors_symbol.gif')); ?>" alt="loader" width="100px"
            height="100px">
    </div>
    <!--- End Global-loader-->
    <div class="new-page">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>"><img
                    src="<?php echo e(asset('public/assets/images/brand/dashlogo.png')); ?>"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if(auth()->user()->can('Human Resource')): ?>
                    <li class="nav-item dropdown <?php echo e(Request::segment(1) == 'Human-Resource' ? 'active' : ''); ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="icon-new"><img
                                    src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>"></div> HR
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if(auth()->user()->can('User List')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('user-list')); ?>">User List</a>
                            <?php endif; ?>
                            <?php if(auth()->user()->can('User Add')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('UserCreate')); ?>">Add new user</a>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('Patient Master')): ?>
                    <li class="nav-item <?php echo e(Request::segment(1) == 'Patient' ? 'nav-active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('patient_details')); ?>">
                            <div class="icon-new"> <img
                                    src="<?php echo e(asset('public/assets/images/brand/hospitalisation.png')); ?>"></div>Patient
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('OPD out-patients')): ?>
                    <li class="nav-item <?php echo e(Request::segment(1) == 'opd' ? 'nav-active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('OPD-Patient-list')); ?>">
                            <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/patient.png')); ?>">
                            </div>Opd
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('Emergency Patients')): ?>
                    <li class="nav-item <?php echo e(Request::segment(1) == 'emg' ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('emg-patient-list')); ?>">
                            <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/hospital-bed.png')); ?>">
                            </div>EMG
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('IPD ipd-patients')): ?>
                    <li class="nav-item <?php echo e(Request::segment(1) == 'IPD' ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('ipd-patient-listing')); ?>">
                            <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/patient (1).png')); ?>">
                            </div>IPD
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/invoice.png')); ?>">
                            </div>Bill
                        </a>
                    </li>
                    <?php if(auth()->user()->can('discount')): ?>
                    <li class="nav-item <?php echo e(Request::segment(1) == 'discount' ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('discount-list')); ?>">
                            <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/offer.png')); ?>"></div>
                            Discount
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('pharmacy main')): ?>
                    <li class="nav-item <?php echo e(Request::segment(1) == 'pharmacy' ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('pharmacy-bill-listing')); ?>">
                            <div class="icon-new"><img
                                    src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>"></div>Pharmacy
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="icon-new"><img
                                    src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>"></div>
                            Investigation
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if(auth()->user()->can('pathology main')): ?>
                            <a class="dropdown-item <?php echo e(Request::segment(1) == 'radiology' ? 'active' : ''); ?>"
                                href="<?php echo e(route('pathology-test-charge')); ?>">Pathology</a>
                            <?php endif; ?>
                            <?php if(auth()->user()->can('radiology main')): ?>
                            <a class="dropdown-item <?php echo e(Request::segment(1) == 'radiology' ? 'active' : ''); ?>"
                                href="<?php echo e(route('radiology-test-charge')); ?>">Radiology</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/hospital-bed (1).png')); ?>"></div>Bed
                        </a>
                    </li> -->
                    
                    <div class=" menu-item">
                        <div class="icon-new1"><img src="<?php echo e(asset('public/assets/images/brand/settings.png')); ?>"></div>
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"> Setup <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if(auth()->user()->can('General Setting')): ?>
                                <li><a href="<?php echo e(route('general_setting_details')); ?>">General Settings</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('Charges Master')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Charges <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('charges')): ?>
                                        <li><a href="<?php echo e(route('charges-details')); ?>">Charges</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('charges catagory')): ?>
                                        <li><a href="<?php echo e(route('charges-catagory-details')); ?>">Charges Catagory</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('charges sub catagory')): ?>
                                        <li><a href="<?php echo e(route('charges-sub-catagory-details')); ?>">Charges sub
                                                catagory</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('charges unit')): ?>
                                        <li><a href="<?php echo e(route('charges-unit-details')); ?>">Charges Unit</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('front office')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Front Office <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purpose')): ?>
                                        <li><a href="<?php echo e(route('add-purpose-in-front-office')); ?>">Purpose</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complain type')): ?>
                                        <li><a href="<?php echo e(route('add-complain-type-in-front-office')); ?>">Complain Type</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('source')): ?>
                                        <li><a href="<?php echo e(route('add-source-in-front-office')); ?>">Source</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('appointment priority')): ?>
                                        <li><a href="<?php echo e(route('add-appointment-priority-in-front-office')); ?>">Appointment
                                                Priority</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('charges package')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Charges Package <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package name')): ?>
                                        <li><a href="<?php echo e(route('charges-package-name-details')); ?>">package name</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package catagory')): ?>
                                        <li><a href="<?php echo e(route('charges-package-catagory-details')); ?>">package
                                                catagory</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package sub catagory')): ?>
                                        <li><a href="<?php echo e(route('charges-package-sub-catagory-details')); ?>">package sub
                                                catagory</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('Setup Inventory')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Setup Inventory <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item')): ?>
                                        <li><a href="<?php echo e(route('inventory-item-list')); ?>">Inventory Item</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Catagory')): ?>
                                        <li><a href="<?php echo e(route('add-inventory-item-catagory')); ?>">Inventory Item
                                                Catagory</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Unit')): ?>
                                        <li><a href="<?php echo e(route('add-inventory-item-unit')); ?>">Inventory Item Unit</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Brand')): ?>
                                        <li><a href="<?php echo e(route('add-inventory-item-brand')); ?>">Inventory Item Brand</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Manufacture')): ?>
                                        <li><a href="<?php echo e(route('add-inventory-manufacture')); ?>">Inventory Item
                                                Manufacture</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Type')): ?>
                                        <li><a href="<?php echo e(route('add-inventory-item-type')); ?>">Inventory Item Type</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Store Room')): ?>
                                        <li><a href="<?php echo e(route('add-inventory-item-store-room')); ?>">Inventory Store
                                                Room</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Attribute')): ?>
                                        <li><a href="<?php echo e(route('inventory-item-attribute')); ?>">Inventory Item
                                                Attribute</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Vendor')): ?>
                                        <li><a href="<?php echo e(route('inventory-vendor')); ?>">Inventory Vendor</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('setup pharmacy')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#"> Pharmacy<i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine storeroom')): ?>
                                        <li><a href="<?php echo e(route('medicine-store-room-details')); ?>">medicine storeroom</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine store')): ?>
                                        <li><a href="<?php echo e(route('medicine-store-details')); ?>">medicine store</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine rack')): ?>
                                        <li><a href="<?php echo e(route('medicine-rack-details')); ?>">medicine rack</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine supplier')): ?>
                                        <li><a href="<?php echo e(route('medicine-supplier-details')); ?>">medicine supplier</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine dosage')): ?>
                                        <li><a href="<?php echo e(route('medicine-dosage-details')); ?>">medicine dosage</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine unit')): ?>
                                        <li><a href="<?php echo e(route('medicine-unit-details')); ?>">medicine unit</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dose interval')): ?>
                                        <li><a href="<?php echo e(route('dose-interval-details')); ?>">dose interval</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dose duration')): ?>
                                        <li><a href="<?php echo e(route('dose-duration-details')); ?>">dose duration</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine vendor')): ?>
                                        <li><a href="<?php echo e(route('medicine-vendor-details')); ?>">medicine vendor</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('Finding')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Finding<i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Finding')): ?>
                                        <li><a href="<?php echo e(route('finding')); ?>">Finding</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('finding category')): ?>
                                        <li><a href="<?php echo e(route('finding-category-add')); ?>">finding category</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('All Header')): ?>
                                <li><a href="<?php echo e(route('all-header-listing')); ?>">All Header</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('Master Operation')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Operation <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">

                                        <li><a href="<?php echo e(route('operation-details')); ?>">operation-details</a></li>
                                        <li><a
                                                href="<?php echo e(route('operation-catagory-details')); ?>">operation-catagory-details</a>
                                        </li>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('operation type')): ?>
                                        <li><a href="<?php echo e(route('operation-type-details')); ?>">operation-type-details</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('Opd')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Opd <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd unit')): ?>
                                        <li><a href="<?php echo e(route('opd-unit-details')); ?>">opd-unit-details</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd setup')): ?>
                                        <li><a href="<?php echo e(route('opd-setup-details')); ?>">opd-setup-details</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd ticket fees')): ?>
                                        <li><a href="<?php echo e(route('opd-ticket-fees-details')); ?>">opd-ticket-fees-details</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('Emg setUp')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Emg setUp <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Emg setUp</a></li>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('pathology')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">pathology <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology catagory')): ?>
                                        <li><a href="<?php echo e(route('pathology-catagory-details')); ?>">pathology catagory</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology unit')): ?>
                                        <li><a href="<?php echo e(route('pathology-unit-details')); ?>">pathology unit</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology parameter')): ?>
                                        <li><a href="<?php echo e(route('pathology-parameter-details')); ?>">pathology parameter</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('radiology')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">radiology <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology catagory')): ?>
                                        <li><a href="<?php echo e(route('radiology-catagory-details')); ?>">radiology catagory</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology unit')): ?>
                                        <li><a href="<?php echo e(route('radiology-unit-details')); ?>">radiology unit</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology parameter')): ?>
                                        <li><a href="<?php echo e(route('radiology-parameter-details')); ?>">radiology parameter</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('blood bank')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Blood bank <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blood bank product')): ?>
                                        <li><a href="<?php echo e(route('blood-bank-product-details')); ?>">blood bank product</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Blood unit type')): ?>
                                        <li><a href="<?php echo e(route('add-blood-unit-type')); ?>">Blood unit type</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('appointment')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Appointment <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shift')): ?>
                                        <li><a href="<?php echo e(route('shift-details')); ?>">shift-details</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slots')): ?>
                                        <li><a href="<?php echo e(route('slots-details')); ?>">slots-details</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('symptoms')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">symptoms <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('symptoms head')): ?>
                                        <li><a href="<?php echo e(route('symptoms-head-details')); ?>">symptoms head</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('symptoms type')): ?>
                                        <li><a href="<?php echo e(route('symptoms-type-details')); ?>">symptoms type</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('Department')): ?>
                                <li><a href="<?php echo e(route('department-details')); ?>">Department</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('tpa management')): ?>
                                <li><a href="<?php echo e(route('tpa-management-details')); ?>">tpa management</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('diagonasis')): ?>
                                <li><a href="<?php echo e(route('diagonasis-details')); ?>">diagonasis</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('prefix')): ?>
                                <li><a href="<?php echo e(route('prefixList')); ?>">prefix</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('Bed Master')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Bed <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bed')): ?>
                                        <li><a href="<?php echo e(route('bed-details')); ?>">bed</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bed type')): ?>
                                        <li><a href="<?php echo e(route('bed-type-details')); ?>">bed type</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bedUnit')): ?>
                                        <li><a href="<?php echo e(route('bed-unit-details')); ?>">bedUnit</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bedgroup')): ?>
                                        <li><a href="<?php echo e(route('bedgroup-details')); ?>">bedgroup</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ward')): ?>
                                        <li><a href="<?php echo e(route('ward-details')); ?>">ward</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('floor')): ?>
                                        <li><a href="<?php echo e(route('floor-details')); ?>">floor</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </div>

                    <div class=" menu-item">
                        <div class="icon-new1"><img src="<?php echo e(asset('public/assets/images/brand/settings.png')); ?>"></div>
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"> Others <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Inventory</a></li>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Birth and Death record<i
                                            class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">

                                        <li><a href="#">Birth Record</a></li>
                                        <li><a href="#">Death Record</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">False Generation<i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">


                                        <li><a href="#">Opd</a></li>
                                        <li><a href="#">Ipd</a></li>

                                    </ul>
                                </li>
                                <li><a href="#">Refferal</a></li>
                                <li><a href="#">Font office</a></li>
                                <li><a href="<?php echo e(route('all-blood-details')); ?>">Blood Bank</a></li>
                                <li><a href="<?php echo e(route('main-operation')); ?>">Operation</a></li>

                                <?php if(auth()->user()->can('view role') ||
                                auth()->user()->can('asign userBasedPermission') ||
                                auth()->user()->can('view permission') ||
                                auth()->user()->can('asign roleToUser') ||
                                auth()->user()->can('view permission')): ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Permission<i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu">

                                        <li><a href="<?php echo e(route('roleList')); ?>">Role</a></li>
                                        <li><a href="#"></a></li>

                                    </ul>
                                </li>
                                <?php endif; ?>

                    </div>

                </ul>
                </li>
                <li class="nav-item <?php echo e(Request::segment(1) == 'pharmacy' ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('bed-status-list')); ?>">
                        <div class="icon-new"><img
                                src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>"></div>Bed
                    </a>
                </li>
          
                <?php if(auth()->user()->can('Report')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>"></div>
                        Reports
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(auth()->user()->can('OPD Patient Report')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('opd-patient-report')); ?>">OPD Patient Report</a>
                        <?php endif; ?>

                        <a class="dropdown-item" href="">OPD Income Report</a>
                        <?php if(auth()->user()->can('EMG Patient Report')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('emg-patient-report')); ?>">EMG Patient Report</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="">EMG Income Report</a>
                        <a class="dropdown-item" href="<?php echo e(route('ipd-patient-report')); ?>">IPD Patient Report</a>
                        <a class="dropdown-item" href="">IPD Income Report</a>
                        <?php if(auth()->user()->can('Payment Report')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('payment-report')); ?>">Payment Report</a>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>
             
                </ul>




            </div>

            
                <div class="popup-link">
                    <a href="#popup1">
                        <div class="dashprofileimg"><img
                                src="<?php echo e(asset('public/profile_picture')); ?>/<?php echo e($login_details->profile_image); ?>"></div>
                </div>
                <div id="popup1" class="popup-container">
                    <div class="popup-content">
                        <a href="#" class="close">&times;</a>
                        <img src="<?php echo e(asset('public/profile_picture')); ?>/<?php echo e($login_details->profile_image); ?>" style="width: 50px;
            height: 50px;
            cursor: default;
            margin: 0px 0px 0px 109px;">
                        <h3 style="margin: 5px 0px 0px 65px;"> <?php echo e($login_details->first_name); ?>

                            <?php echo e($login_details->last_name); ?>

                        </h3>
                        <span class="badge badge-light badge-pill" style="margin:5px 0px 10px 54px;"><?php echo e($login_details->role); ?></span>

                        <a class="btn btn-success btn-sm"
                            href="<?php echo e(route('user-profile')); ?>/<?php echo e(base64_encode(Auth::id())); ?>"><i
                                class='fas fa-address-card'></i> Profile</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-primary btn-sm text-center" style="margin: 0px 0px 0px 99px"
                                type="submit"><i class="fa fa-sign-out-alt"></i> Log Out</button>
                        </form>
                    </div>
                </div>
                
                

    </div>


    <div class="row">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!--Footer-->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 text-center">
                    Copyright © 2022 <a href="#"><?php echo e(@$general_details->software_name); ?></a>. Designed by <a
                        href="https://devantitsolutions.com/" target="_blank">Devant IT Solutions Pvt. Ltd.</a>
                    All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>


    <!-- Jquery js-->
    <script src="<?php echo e(asset('public/assets/js/jquery-3.5.1.min.js')); ?>"></script>

    <!-- Bootstrap4 js-->
    <script src="<?php echo e(asset('public/assets/plugins/bootstrap/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

    <!--Othercharts js-->
    <script src="<?php echo e(asset('public/assets/plugins/othercharts/jquery.sparkline.min.js')); ?>"></script>

    <!-- Circle-progress js-->
    <script src="<?php echo e(asset('public/assets/js/circle-progress.min.js')); ?>"></script>

    <!-- Jquery-rating js-->
    <script src="<?php echo e(asset('public/assets/plugins/rating/jquery.rating-stars.js')); ?>"></script>

    <!--Sidemenu js-->
    <script src="<?php echo e(asset('public/assets/plugins/sidemenu/sidemenu.js')); ?>"></script>

    <!-- P-scroll js-->
    <script src="<?php echo e(asset('public/assets/plugins/p-scrollbar/p-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/p-scrollbar/p-scroll1.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/p-scrollbar/p-scroll.js')); ?>"></script>


    <!--INTERNAL Peitychart js-->
    <script src="<?php echo e(asset('public/assets/plugins/peitychart/jquery.peity.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/peitychart/peitychart.init.js')); ?>"></script>

    <!--INTERNAL Apexchart js-->
    <script src="<?php echo e(asset('public/assets/js/apexcharts.js')); ?>"></script>

    <!--INTERNAL ECharts js-->
    <script src="<?php echo e(asset('public/assets/plugins/echarts/echarts.js')); ?>"></script>

    <!--INTERNAL Chart js -->
    <script src="<?php echo e(asset('public/assets/plugins/chart/chart.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/chart/utils.js')); ?>"></script>

    <!-- INTERNAL Select2 js -->
    <script src="<?php echo e(asset('public/assets/plugins/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/js/select2.js')); ?>"></script>

    <!--INTERNAL Moment js-->
    <script src="<?php echo e(asset('public/assets/plugins/moment/moment.js')); ?>"></script>

    <!--INTERNAL Index js-->
    <script src="<?php echo e(asset('public/assets/js/index1.js')); ?>"></script>

    <!-- Simplebar JS -->
    <script src="<?php echo e(asset('public/assets/plugins/simplebar/js/simplebar.min.js')); ?>"></script>
    <!-- Custom js-->
    <script src="<?php echo e(asset('public/assets/js/custom.js')); ?>"></script>

    <!-- INTERNAL Data tables -->
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatable/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/js/datatables.js')); ?>"></script>

    <script src="<?php echo e(asset('public/assets/plugins/flot/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/flot/jquery.flot.fillbetween.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/flot/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/js/flot.js')); ?>"></script>



    <!-- Switcher js-->
    <script src="<?php echo e(asset('public/assets/switcher/js/switcher.js')); ?>"></script>
    

    
    <script src="<?php echo e(asset('public/assets/plugins/notify/js/notifIt.js')); ?>"></script>
    <!-- INTERNAL WYSIWYG Editor js -->
    <script src="<?php echo e(asset('public/assets/plugins/wysiwyag/jquery.richtext.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/js/form-editor.js')); ?>"></script>
    
    
    
    

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

                url: "<?php echo e(route('get-patient-serach')); ?>",
                type: "post",
                data: {
                    patient__id: patient_search_name,
                    _token: '<?php echo e(csrf_token()); ?>',
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
</script><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/layouts/layout.blade.php ENDPATH**/ ?>