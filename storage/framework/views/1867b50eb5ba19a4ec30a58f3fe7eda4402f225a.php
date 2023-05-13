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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <!-- Title -->
    <title><?php echo e(@$general_details->software_name); ?></title>

    <!--Favicon -->
    <link rel="icon" href="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->small_logo); ?>" type="image/x-icon" />

    <!--Bootstrap css -->
    <link href="<?php echo e(asset('public/assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Style css -->
    <link href="<?php echo e(asset('public/assets/css/style.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/css/dark.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/css/skin-modes.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/plugins/wysiwyag/richtext.css')); ?>" rel="stylesheet" />

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="app sidebar-mini">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="<?php echo e(asset('public/assets/images/svgs/Heart_beat.gif')); ?>" alt="loader" width="500px" height="200px">
    </div>
    <!--- End Global-loader-->
    <!-- Page -->
    <div class="page">
        <div class="page-main">
            <aside class="app-sidebar">
                <div class="app-sidebar__logo">
                    <a class="header-brand" href="<?php echo e(route('dashboard')); ?>">
                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->logo); ?>" class="header-brand-img desktop-lgo" alt="<?php echo e(@$general_details->software_name); ?>">
                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->logo); ?>" class="header-brand-img dark-logo" alt="<?php echo e(@$general_details->software_name); ?>">

                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->small_logo); ?>" class="header-brand-img mobile-logo" alt="<?php echo e(@$general_details->software_name); ?>">
                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->logo); ?>" class="header-brand-img darkmobile-logo" alt="<?php echo e(@$general_details->software_name); ?>">
                    </a>


                    <ul class="side-menu app-sidebar3">
                        <!-- DASHBOARD -->
                        <?php if(auth()->user()->can('OPD out-patients')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('dashboard')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                                    <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".9"></path>
                                </svg>
                                <span class="side-menu__label">Dashboard</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('bill summary')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('bill-summary')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                                    <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".9"></path>
                                </svg>
                                <span class="side-menu__label">Bill Summary</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('Human Resource')): ?>
                        <li class="slide">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'Human-Resource' ? 'active' : ''); ?>" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon <?php echo e(Request::segment(1) == 'Human-Resource' ? 'active' : ''); ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z">
                                    </path>
                                </svg>
                                <span class="side-menu__label">Human Resource</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <?php if(auth()->user()->can('User List')): ?>
                                <li><a href="<?php echo e(route('user-list')); ?>" class="slide-item"> User List</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('User Add')): ?>
                                <li><a href="<?php echo e(route('UserCreate')); ?>" class="slide-item"> Add New User</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('appointment main')): ?>
                        <li class="slide">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'appointment' ? 'active' : ''); ?>" href="<?php echo e(route('all-appointments-details')); ?>">
                                <svg class="side-menu__icon <?php echo e(Request::segment(1) == 'appointment' ? 'active' : ''); ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />

                                </svg>
                                <span class="side-menu__label">Appointment </span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('Patient Master')): ?>
                        <li class="slide">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'Patient' ? 'active' : ''); ?>" href="<?php echo e(route('patient_details')); ?>">

                                <svg class="side-menu__icon <?php echo e(Request::segment(1) == 'Patient' ? 'active' : ''); ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 4c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1.4c0-2 4-3.1 6-3.1s6 1.1 6 3.1V19z" />
                                </svg>
                                <span class="side-menu__label">Patient Registation</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('OPD out-patients')): ?>
                        <li class="slide <?php echo e(Request::segment(1) == 'opd' ? 'active' : ''); ?>">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'opd' ? 'active' : ''); ?>" href="<?php echo e(route('OPD-Patient-list')); ?>">

                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M8 3v2H6v4c0 2.21 1.79 4 4 4s4-1.79 4-4V5h-2V3h3c.552 0 1 .448 1 1v5c0 2.973-2.162 5.44-5 5.917V16.5c0 1.933 1.567 3.5 3.5 3.5 1.497 0 2.775-.94 3.275-2.263C16.728 17.27 16 16.22 16 15c0-1.657 1.343-3 3-3s3 1.343 3 3c0 1.371-.92 2.527-2.176 2.885C19.21 20.252 17.059 22 14.5 22 11.462 22 9 19.538 9 16.5v-1.583C6.162 14.441 4 11.973 4 9V4c0-.552.448-1 1-1h3z" />
                                </svg>
                                <span class="side-menu__label">OPD Out-Patients</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('Emergency Patients')): ?>
                        <li class="slide">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'emg' ? 'active' : ''); ?>" href="<?php echo e(route('emg-patient-list')); ?>">
                                <svg class="side-menu__icon <?php echo e(Request::segment(1) == 'emg' ? 'active' : ''); ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M7.88 3.39L6.6 1.86 2 5.71l1.29 1.53 4.59-3.85zM22 5.72l-4.6-3.86-1.29 1.53 4.6 3.86L22 5.72zM12 4c-4.97 0-9 4.03-9 9s4.02 9 9 9c4.97 0 9-4.03 9-9s-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11h-2v3H8v2h3v3h2v-3h3v-2h-3V9z" />
                                </svg>
                                <span class="side-menu__label">Emergency Patients</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('IPD ipd-patients')): ?>
                        <li class="slide <?php echo e(Request::segment(1) == 'IPD' ? 'active' : ''); ?>">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'IPD' ? 'active' : ''); ?>" href="<?php echo e(route('ipd-patient-listing')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                                    <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".9"></path>
                                </svg>
                                <span class="side-menu__label">Ipd In-Patients</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('discount')): ?>
                        <li class="slide <?php echo e(Request::segment(1) == 'discount' ? 'active' : ''); ?>">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'discount' ? 'active' : ''); ?>" href="<?php echo e(route('discount-list')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                    <path d="M14.25 2.26l-.08-.04-.01.02C13.46 2.09 12.74 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10c0-4.75-3.31-8.72-7.75-9.74zM19.41 9h-7.99l2.71-4.7c2.4.66 4.35 2.42 5.28 4.7zM13.1 4.08L10.27 9l-1.15 2L6.4 6.3C7.84 4.88 9.82 4 12 4c.37 0 .74.03 1.1.08zM5.7 7.09L8.54 12l1.15 2H4.26C4.1 13.36 4 12.69 4 12c0-1.85.64-3.55 1.7-4.91zM4.59 15h7.98l-2.71 4.7c-2.4-.67-4.34-2.42-5.27-4.7zm6.31 4.91L14.89 13l2.72 4.7C16.16 19.12 14.18 20 12 20c-.38 0-.74-.04-1.1-.09zm7.4-3l-4-6.91h5.43c.17.64.27 1.31.27 2 0 1.85-.64 3.55-1.7 4.91z"></path>
                                </svg>
                                <span class="side-menu__label"> Discount</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('pathology main')): ?>
                        <li class="slide <?php echo e(Request::segment(1) == 'pathology' ? 'active' : ''); ?>">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'pathology' ? 'active' : ''); ?>" href="<?php echo e(route('pathology-test-charge')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />

                                </svg>
                                <span class="side-menu__label">Pathology</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('radiology main')): ?>
                        <li class="slide <?php echo e(Request::segment(1) == 'radiology' ? 'active' : ''); ?>">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'radiology' ? 'active' : ''); ?>" href="<?php echo e(route('radiology-test-charge')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />

                                </svg>
                                <span class="side-menu__label">Radiology</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('pharmacy main')): ?>
                        <li class="slide">
                            <a class="side-menu__item <?php echo e(Request::segment(1) == 'pharmacy' ? 'active' : ''); ?>" href="<?php echo e(route('pharmacy-bill-listing')); ?>">

                                <svg class="side-menu__icon <?php echo e(Request::segment(1) == 'pharmacy' ? 'active' : ''); ?>" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M8 3v2H6v4c0 2.21 1.79 4 4 4s4-1.79 4-4V5h-2V3h3c.552 0 1 .448 1 1v5c0 2.973-2.162 5.44-5 5.917V16.5c0 1.933 1.567 3.5 3.5 3.5 1.497 0 2.775-.94 3.275-2.263C16.728 17.27 16 16.22 16 15c0-1.657 1.343-3 3-3s3 1.343 3 3c0 1.371-.92 2.527-2.176 2.885C19.21 20.252 17.059 22 14.5 22 11.462 22 9 19.538 9 16.5v-1.583C6.162 14.441 4 11.973 4 9V4c0-.552.448-1 1-1h3z" />
                                </svg>
                                <span class="side-menu__label">Pharmacy</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Inventory')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('item-stock-listing')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />

                                </svg>
                                <span class="side-menu__label">Inventory </span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Birth and Death Record')): ?>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z">
                                    </path>
                                </svg>
                                <span class="side-menu__label">Birth and Death Record</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <?php if(auth()->user()->can('birth record')): ?>
                                <li><a href="<?php echo e(route('user-list')); ?>" class="slide-item"> Birth Record</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('death record')): ?>
                                <li><a href="<?php echo e(route('UserCreate')); ?>" class="slide-item"> Death Record</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Referral')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('referral')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />

                                </svg>
                                <span class="side-menu__label">Referral</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('ambulance')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('ambulance-call-details')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />

                                </svg>
                                <span class="side-menu__label">Ambulance </span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('front office')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('all-visit-details')); ?>">

                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M8 3v2H6v4c0 2.21 1.79 4 4 4s4-1.79 4-4V5h-2V3h3c.552 0 1 .448 1 1v5c0 2.973-2.162 5.44-5 5.917V16.5c0 1.933 1.567 3.5 3.5 3.5 1.497 0 2.775-.94 3.275-2.263C16.728 17.27 16 16.22 16 15c0-1.657 1.343-3 3-3s3 1.343 3 3c0 1.371-.92 2.527-2.176 2.885C19.21 20.252 17.059 22 14.5 22 11.462 22 9 19.538 9 16.5v-1.583C6.162 14.441 4 11.973 4 9V4c0-.552.448-1 1-1h3z" />
                                </svg>
                                <span class="side-menu__label">Front Office</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('Blood Bank')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('all-blood-details')); ?>">

                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M8 3v2H6v4c0 2.21 1.79 4 4 4s4-1.79 4-4V5h-2V3h3c.552 0 1 .448 1 1v5c0 2.973-2.162 5.44-5 5.917V16.5c0 1.933 1.567 3.5 3.5 3.5 1.497 0 2.775-.94 3.275-2.263C16.728 17.27 16 16.22 16 15c0-1.657 1.343-3 3-3s3 1.343 3 3c0 1.371-.92 2.527-2.176 2.885C19.21 20.252 17.059 22 14.5 22 11.462 22 9 19.538 9 16.5v-1.583C6.162 14.441 4 11.973 4 9V4c0-.552.448-1 1-1h3z" />
                                </svg>
                                <span class="side-menu__label">Blood Bank</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('False Generation')): ?>
                        <li class="slide  <?php echo e(Request::segment(1) == 'false-patient' ? 'active' : ''); ?>">
                            <a class="side-menu__item  <?php echo e(Request::segment(1) == 'false-patient' ? 'active' : ''); ?>" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z">
                                    </path>
                                </svg>
                                <span class="side-menu__label">False Generation</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <?php if(auth()->user()->can('OPD False')): ?>
                                <li><a href="<?php echo e(route('opd-false-generation')); ?>" class="slide-item <?php echo e(Request::segment(2) == 'opd-false' ? 'active' : ''); ?>"> OPD</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('EMG False')): ?>
                                <li><a href="<?php echo e(route('user-list')); ?>" class="slide-item <?php echo e(Request::segment(2) == 'emg-false' ? 'active' : ''); ?>"> EMG</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('IPD False')): ?>
                                <li><a href="<?php echo e(route('user-list')); ?>" class="slide-item <?php echo e(Request::segment(2) == 'ipd-false' ? 'active' : ''); ?>"> IPD</a></li>
                                <?php endif; ?>



                            </ul>
                        </li>
                        <?php endif; ?>



                        <?php if(auth()->user()->can('Set Up')): ?>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                                </svg>
                                <span class="side-menu__label">Setup </span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu ">

                                <?php if(auth()->user()->can('General Setting')): ?>
                                <li> <a href="<?php echo e(route('general_setting_details')); ?>" class="slide-item">General Setting</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('Charges Master')): ?>
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Charges</span><i class="sub-angle fe fe-chevron-down"></i></a>
                                    <ul class="sub-slide-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('charges')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('charges-details')); ?>">Charges</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('charges catagory')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('charges-catagory-details')); ?>">Catagory</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('charges sub catagory')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('charges-sub-catagory-details')); ?>">Sub Catagory</a></li>
                                        <?php endif; ?>
                                        
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('front office')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Front Office</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purpose')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-purpose-in-front-office')); ?>">Purpose</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complain type')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-complain-type-in-front-office')); ?>">Complain Type</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('source')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-source-in-front-office')); ?>">Source</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('appointment priority')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-appointment-priority-in-front-office')); ?>">Appointment Priority</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>



                        <?php if(auth()->user()->can('charges package')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Charges Package</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package name')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('charges-package-name-details')); ?>">Package Name</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package catagory')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('charges-package-catagory-details')); ?>">Package Catagory</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('package sub catagory')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('charges-package-sub-catagory-details')); ?>">Package Sub Catagory</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Setup Inventory')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Inventory</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('inventory-item-list')); ?>">Item</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Catagory')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-inventory-item-catagory')); ?>">Item Catagory</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Unit')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-inventory-item-unit')); ?>">Item Unit</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Brand')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-inventory-item-brand')); ?>">Item Brand</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Manufacture')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-inventory-manufacture')); ?>">Manufacture</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Type')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-inventory-item-type')); ?>">Item Type</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Store Room')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-inventory-item-store-room')); ?>">Item Store Room</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Item Attribute')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('inventory-item-attribute')); ?>">Item Attribute</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inventory Vendor')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('inventory-vendor')); ?>">Vendor</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('setup pharmacy')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Pharmacy</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine storeroom')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('medicine-store-room-details')); ?>">Store Room</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine store')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('medicine-store-details')); ?>">Medicine Store</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine rack')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('medicine-rack-details')); ?>">Medicine Rack</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine supplier')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('medicine-supplier-details')); ?>"> Supplier </a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine dosage')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('medicine-dosage-details')); ?>"> Medicine Dosage </a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine unit')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('medicine-unit-details')); ?>"> Medicine Unit </a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dose interval')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('dose-interval-details')); ?>">Interval </a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dose duration')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('dose-duration-details')); ?>">Duration </a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medicine vendor')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('medicine-vendor-details')); ?>">Vendor</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Finding')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Finding</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Finding')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('finding')); ?>">Finding</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('finding category')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('finding-category-add')); ?>">Catagory</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('All Header')): ?>
                        <li> <a href="<?php echo e(route('all-header-listing')); ?>" class="slide-item">All Header</a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Master Operation')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Operation</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('operation-details')); ?>">Operation</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('operation-catagory-details')); ?>">Catagory</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('operation type')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('operation-type-details')); ?>">Type</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Opd')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Opd</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd unit')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('opd-unit-details')); ?>">Opd Unit</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd setup')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('opd-setup-details')); ?>">Opd Setup</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd ticket fees')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('opd-ticket-fees-details')); ?>">Ticket Fees</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Emg setUp')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Emg</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a class="sub-slide-item" href="<?php echo e(route('emg-set-up')); ?>">Setup</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('pathology')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Pathology</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology catagory')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('pathology-catagory-details')); ?>">Catagory</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology unit')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('pathology-unit-details')); ?>">Unit</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pathology parameter')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('pathology-parameter-details')); ?>">Parameter</a></li>
                                <?php endif; ?>

                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('radiology')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Radiology</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology catagory')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('radiology-catagory-details')); ?>">Catagory</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology unit')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('radiology-unit-details')); ?>">Unit</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('radiology parameter')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('radiology-parameter-details')); ?>">Parameter</a></li>
                                <?php endif; ?>

                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('blood bank')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Blood Bank</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blood bank product')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('blood-bank-product-details')); ?>">Product</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Blood unit type')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('add-blood-unit-type')); ?>">Unit Types</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('appointment')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Appointment</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shift')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('shift-details')); ?>">Shift</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slots')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('slots-details')); ?>">Slot</a></li>
                                <?php endif; ?>

                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('symptoms')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Symptoms</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('symptoms head')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('symptoms-head-details')); ?>">Symptoms Head</a></li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('symptoms type')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('symptoms-type-details')); ?>">Symptoms Type</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Department')): ?>
                        <li> <a href="<?php echo e(route('department-details')); ?>" class="slide-item">Department</a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('tpa management')): ?>
                        <li> <a href="<?php echo e(route('tpa-management-details')); ?>" class="slide-item">Tpa Management</a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('diagonasis')): ?>
                        <li> <a href="<?php echo e(route('diagonasis-details')); ?>" class="slide-item">Diagonasis</a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('prefix')): ?>
                        <li><a href="<?php echo e(route('prefixList')); ?>" class="slide-item">Prefix
                                Settings</a></li>
                        <?php endif; ?>


                        <?php if(auth()->user()->can('Bed Master')): ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Bed Details</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bed')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('bed-details')); ?>">Bed</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bed type')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('bed-type-details')); ?>">Bed Type</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bedUnit')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('bed-unit-details')); ?>">Bed Unit</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bedgroup')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('bedgroup-details')); ?>">Bed Group</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ward')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('ward-details')); ?>">Ward</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('floor')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('floor-details')); ?>">Floor</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('view role') ||
                        auth()->user()->can('asign userBasedPermission') ||
                        auth()->user()->can('view permission') ||
                        auth()->user()->can('asign roleToUser') ||
                        auth()->user()->can('view permission')): ?>
                        <!-- ROLE PERMISSION -->

                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Role &
                                    Permission</span><i class="sub-angle fe fe-chevron-down"></i></a>
                            <ul class="sub-slide-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view role')): ?>
                                <li><a class="sub-slide-item" href="<?php echo e(route('roleList')); ?>">Role</a>
                                </li>
                                <?php endif; ?>
                                

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view permission')): ?>
                        <li><a class="sub-slide-item" href="<?php echo e(route('PermissionList')); ?>">Permission</a></li>
                        <?php endif; ?>

                        
                    </ul>
                    </li>


                    <!-- ROLE PERMISSION END-->
                    <?php endif; ?>

                    
                    </ul>
                    </li>
                    <?php endif; ?>
                    <!-- ORDER END-->

                    </ul>
                </div>
            </aside>
            <!--aside closed-->
            <!-- App-Content -->
            <div class="app-content main-content">
                <div class="side-app">
                    <!--app header-->
                    <div class="app-header header">
                        <div class="container-fluid">
                            <div class="d-flex">
                                <a class="header-brand" href="index.html">
                                    <img src="<?php echo e(asset('public/assets/images/brand/logo.png')); ?>" class="header-brand-img desktop-lgo" alt="Admintro logo">
                                    <img src="<?php echo e(asset('public/assets/images/brand/logo1.png')); ?>" class="header-brand-img dark-logo" alt="Admintro logo">
                                    <img src="<?php echo e(asset('public/assets/images/brand/favicon.png')); ?>" class="header-brand-img mobile-logo" alt="Admintro logo">
                                    <img src="<?php echo e(asset('public/assets/images/brand/favicon1.png')); ?>" class="header-brand-img darkmobile-logo" alt="Admintro logo">
                                </a>
                                <div class="app-sidebar__toggle" data-toggle="sidebar">
                                    <a class="open-toggle" href="index-2.html#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-left header-icon mt-1">
                                            <line x1="17" y1="10" x2="3" y2="10">
                                            </line>
                                            <line x1="21" y1="6" x2="3" y2="6">
                                            </line>
                                            <line x1="21" y1="14" x2="3" y2="14">
                                            </line>
                                            <line x1="17" y1="18" x2="3" y2="18">
                                            </line>
                                        </svg>
                                    </a>
                                </div>
                                <?php if(auth()->user()->can('search patient')): ?>
                                <div class="mt-1">
                                    <form class="form-inline">
                                        <div class="search-element">
                                            <input type="search" class="form-control header-search" id="patient_entry_reslt" onkeyup="get_all_patient_result()" placeholder="Search Patient" aria-label="Search" tabindex="1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            <table id="search_result_for_patient" class="table table-striped dropdown-menu dropdown-menu-center" style="width: 600px !important;margin-top: -64px !important;">

                                            </table>


                                            <button class="btn btn-primary-color" type="button">
                                                <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <?php endif; ?>

                                <div class="d-flex order-lg-2 ml-auto">
                                    <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
                                        <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                        </svg>
                                    </a>


                                    <div class="dropdown   header-fullscreen">
                                        <a class="nav-link icon full-screen-link p-0" id="fullscreen-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24">
                                                <path d="M10 4L8 4 8 8 4 8 4 10 10 10zM8 20L10 20 10 14 4 14 4 16 8 16zM20 14L14 14 14 20 16 20 16 16 20 16zM20 8L16 8 16 4 14 4 14 10 20 10z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <?php if( auth()->user()->can('Bed Status')): ?>
                                    <div class="dropdown profile-dropdown">
                                        <a href="<?php echo e(route('bed_status')); ?>" class="nav-link pr-0 leading-none" data-placement="top" data-toggle="tooltip" title="Bed Status">
                                            <span>
                                                <img src="<?php echo e(asset('public/icon/hospital-bed.png')); ?>" alt="">
                                            </span>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    


                                    <div class="dropdown profile-dropdown">
                                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                            <span>
                                                <img src="<?php echo e(asset('public/profile_picture')); ?>/<?php echo e($login_details->profile_image); ?>" alt="My Profile Picture">
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                                            <div class="text-center">
                                                <a href="#" class="dropdown-item text-center user pb-0 font-weight-bold"><?php echo e($login_details->first_name); ?>

                                                    <?php echo e($login_details->last_name); ?></a>
                                                <span class="text-center user-semi-title"><?php echo e($login_details->role); ?></span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <a class="dropdown-item d-flex" href="<?php echo e(route('user-profile')); ?>/<?php echo e(base64_encode(Auth::id())); ?>">
                                                <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z" />
                                                </svg>
                                                <div class="">Profile</div>
                                            </a>

                                            <a class="dropdown-item d-flex" href="#">
                                                <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z" />
                                                </svg>
                                                <div class="">Change Password</div>
                                            </a>
                                            <form id="logout_form" method="POST" class="dropdown-item d-flex" action="<?php echo e(route('logout')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                                                    <g>
                                                        <rect fill="none" height="24" width="24" />
                                                    </g>
                                                    <g>
                                                        <path d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z" />
                                                    </g>
                                                </svg>
                                                <div onclick="document.getElementById('logout_form').submit();">Sign
                                                    Out</div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/app header-->

                    <div class="row">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>

            </div>
            <!-- End app-content-->
        </div>
        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2022 <a href="#"><?php echo e(@$general_details->software_name); ?></a>. Designed by <a href="https://devantitsolutions.com/" target="_blank">Devant IT Solutions Pvt. Ltd.</a>
                        All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->
    </div><!-- End Page -->
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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