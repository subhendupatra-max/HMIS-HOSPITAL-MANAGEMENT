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
<<<<<<< HEAD
    <div class="new-page">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="#"><img src="<?php echo e(asset('public/assets/images/brand/dashlogo.png')); ?>" ></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>" ></div>  HR
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="#">User List</a>
                       <a class="dropdown-item" href="#">Add new user</a>
                    </div>
                <li class="nav-item">
                    <a class="nav-link" href="#"><div class="icon-new"> <img src="<?php echo e(asset('public/assets/images/brand/hospitalisation.png')); ?>" ></div>Patient</a>
                  </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/patient.png')); ?>" ></div>Opd</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/hospital-bed.png')); ?>" ></div>EMG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/patient (1).png')); ?>" ></div>IPD</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/invoice.png')); ?>" ></div>Bill</a>
              </li>
             <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/offer.png')); ?>" ></div>Discount</a>
              </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>" ></div>Pharmacy</a>
              </li>
               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/investigation.png')); ?>" ></div>  Investigation
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Pathology</a>
                  <a class="dropdown-item" href="#">Radiology</a>
               </div>
              </li>
              <li class="nav-item">
               <a class="nav-link" href="#"><div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/hospital-bed (1).png')); ?>" ></div>Bed</a>
             </li>
             
             <div class=" menu-item">
             <div class="icon-new1"><img src="<?php echo e(asset('public/assets/images/brand/settings.png')); ?>" ></div>  <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Setup <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">General Settings</a></li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Charges <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">Charges</a>

=======
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
                        <?php if(auth()->user()->can('Operation')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('all-blood-details')); ?>">

                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M8 3v2H6v4c0 2.21 1.79 4 4 4s4-1.79 4-4V5h-2V3h3c.552 0 1 .448 1 1v5c0 2.973-2.162 5.44-5 5.917V16.5c0 1.933 1.567 3.5 3.5 3.5 1.497 0 2.775-.94 3.275-2.263C16.728 17.27 16 16.22 16 15c0-1.657 1.343-3 3-3s3 1.343 3 3c0 1.371-.92 2.527-2.176 2.885C19.21 20.252 17.059 22 14.5 22 11.462 22 9 19.538 9 16.5v-1.583C6.162 14.441 4 11.973 4 9V4c0-.552.448-1 1-1h3z" />
                                </svg>
                                <span class="side-menu__label">Operation</span>
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
                                <li><a href="<?php echo e(route('emg-false-generation')); ?>" class="slide-item <?php echo e(Request::segment(2) == 'emg-false' ? 'active' : ''); ?>"> EMG</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('IPD False')): ?>
                                <li><a href="<?php echo e(route('ipd-false-generation')); ?>" class="slide-item <?php echo e(Request::segment(2) == 'ipd-false' ? 'active' : ''); ?>"> IPD</a></li>
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
>>>>>>> 22d70a23d629df5d33548505b9d6705a051c564c
                    </li>
                      <li><a href="#">Charges Catagory</a></li>
                      <li><a href="#">Charges sub catagory</a></li>
                      <li><a href="#">Charges Unit</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Font Office <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">Purpose</a></li>
                      <li><a href="#">Charge</a></li>
                      <li><a href="#">Charges sub catagory</a></li>
                      <li><a href="#">Charges Unit</a></li>
                    </ul>
                  </li>

                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Charges Package <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">package name</a></li>
                      <li><a href="#">package catagory</a></li>
                      <li><a href="#">package sub catagory</a></li>

                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Setup Inventory <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">Inventory Item</a></li>
                      <li><a href="#">Inventory Item Catagory</a></li>
                      <li><a href="#">Inventory Item Unit</a></li>
                      <li><a href="#">Inventory Item Brand</a></li>
                      <li><a href="#">Inventory Item Manufacture</a></li>
                      <li><a href="#">Inventory Item Type</a></li>
                      <li><a href="#">Inventory Store Room</a></li>
                      <li><a href="#">Inventory Item Attribute</a></li>
                      <li><a href="#">Inventory Vendor</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#"> Pharmacy<i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">medicine storeroom</a></li>
                      <li><a href="#">medicine store</a></li>
                      <li><a href="#">medicine rack</a></li>
                      <li><a href="#">medicine supplier</a></li>
                      <li><a href="#">medicine dosage</a></li>
                      <li><a href="#">medicine unit</a></li>
                      <li><a href="#">dose interval</a></li>
                      <li><a href="#">dose duration</a></li>
                      <li><a href="#">medicine vendor</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Finding<i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">Finding</a></li>
                      <li><a href="#">finding category</a></li>

                    </ul>
                  </li>

                  <li><a href="#">All Header</a></li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Operation <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">operation-details</a></li>
                      <li><a href="#">operation-catagory-details</a></li>
                      <li><a href="#">operation-type-details</a></li>

                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Opd <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">opd-unit-details</a></li>
                      <li><a href="#">opd-setup-details</a></li>
                      <li><a href="#">opd-ticket-fees-details</a></li>

                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Emg setUp <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                    <li><a href="#">Emg setUp</a></li>
                   </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">pathology <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">pathology catagory</a></li>
                      <li><a href="#">pathology unit</a></li>
                      <li><a href="#">pathology parameter</a></li>

                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">radiology <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">radiology catagory</a></li>
                      <li><a href="#">radiology unit</a></li>
                      <li><a href="#">radiology parameter</a></li>
                     </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">blood bank <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">blood bank product</a></li>
                      <li><a href="#">Blood unit type</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">appointment <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">shift-details</a></li>
                      <li><a href="#">slots-details</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">symptoms <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">symptoms head</a></li>
                      <li><a href="#">symptoms type</a></li>
                    </ul>
                  </li>

                  <li><a href="#">Department</a></li>
                  <li><a href="#">tpa management</a></li>
                  <li><a href="#">diagonasis</a></li>
                  <li><a href="#">prefix</a></li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Bed  <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">
                    <li><a href="#">bed</a></li>
                    <li><a href="#">bed type</a></li>
                    <li><a href="#">bedUnit</a></li>
                    <li><a href="#">bedgroup</a></li>
                    <li><a href="#">ward</a></li>
                    <li><a href="#">floor</a></li>
                   </ul>
                  </li>
                </ul>
              </li>
             </div>

              <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="icon-new"><img src="<?php echo e(asset('public/assets/images/brand/patient (2).png')); ?>" ></div> Others</a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="#">Inventory</a></li>
                      <li><a class="dropdown-item" href="#">Birth And Death</a></li>
                      <li><a class="dropdown-item" href="#">False Generation</a></li>
                      <li><a class="dropdown-item" href="#">ReferraL</a></li>
                      <li><a class="dropdown-item" href="#">Ambulance</a></li>
                      <li><a class="dropdown-item" href="#">Font-Office</a></li>
                      <li><a class="dropdown-item" href="#">Bllod-bank</a></li>
                     </ul>
                  </li>
                  </ul>
          </li>
        </ul>
      </li>
      </ul>

         </div>

          <form class="form-inline my-2 my-lg-0">
              <div class="popup-link">
                       <a href="#popup1"> <div class="dashprofileimg"><img src="<?php echo e(asset('public/assets/images/brand/user.png')); ?>" ></div>
                      </div>
                   <div id="popup1" class="popup-container">
                       <div class="popup-content">
                         <a href="#" class="close">&times;</a>
                         <h3>   <img src="<?php echo e(asset('public/assets/images/brand/user.png')); ?>" >Name</h3>
                         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                       </div>
                     </div>
               <div class="dash-bellicon">
                   <div class="bell">
                    <div class="popup-link">
                       <a href="#popup1"> <div class="dashprofileimg">  <img src="<?php echo e(asset('public/assets/images/brand/bell.png')); ?>" ></div>
                      </div>
                   <div id="popup1" class="popup-container">
                       <div class="popup-content">
                         <a href="#" class="close">&times;</a>
                         <h3>   <img src="<?php echo e(asset('public/assets/images/brand/user.png')); ?>" >Name</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                       </div>
                     </div>
                   </div>
                     <div class="popup-link">
                       <a href="#popup1"><div class="dash-bellicontext"><h6>100</h6></div></a>
                      </div>
                      <div id="popup1" class="popup-container">
                       <div class="popup-content">
                         <a href="#" class="close">&times;</a>
                         <h3>   <img src="<?php echo e(asset('public/assets/images/brand/user.png')); ?>" >Name</h3>
                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                       </div>
                     </div>
               </div>
             </form>

    </div>


    <div class="row">
        <?php echo $__env->yieldContent('content'); ?>
      </div>
      <div class="graph">

        <div class="row">
            <div class="col-lg-7 barbox">
                <div class="bar-graph">
              <div class="wrapper">
                    <canvas id='c'></canvas>
                    <div class="label">text</div>
                  </div>
                </div>
            </div>
             <div class="col-lg-4 piebox">
             <canvas width="500" id="myChart"></canvas>
             </div>
        </div>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    

</body>

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:29:24 GMT -->

</html>

<script>
    var ctx = document.getElementById("myChart").getContext('2d');

    var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
          labels: ["OPD",	"IPD",	"Pathology",	"Radiology", "Pharmacy","Refferal" ],
        datasets: [{
            data: [500,	50,	1000,100,300 , 400], // Specify the data values array

            borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896','#e27d60','#553d67'], // Add custom color border
            backgroundColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896','#e27d60','#553d67'], // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},

    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
    }
});
</script>

<script>
    var label = document.querySelector(".label");
var c = document.getElementById("c");
var ctx = c.getContext("2d");
var cw = c.width = 700;
var ch = c.height = 350;
var cx = cw / 2,
  cy = ch / 2;
var rad = Math.PI / 180;
var frames = 0;

ctx.lineWidth = 1;
ctx.strokeStyle = "#999";
ctx.fillStyle = "#ccc";
ctx.font = "14px monospace";

var grd = ctx.createLinearGradient(0, 0, 0, cy);
grd.addColorStop(0, "hsla(167,72%,60%,1)");
grd.addColorStop(1, "hsla(167,72%,60%,0)");

var oData = {
  "2008": 10,
  "2009": 39.9,
  "2010": 17,
  "2011": 30.0,
  "2012": 5.3,
  "2013": 38.4,
  "2014": 15.7,
  "2015": 9.0
};

var valuesRy = [];
var propsRy = [];
for (var prop in oData) {

  valuesRy.push(oData[prop]);
  propsRy.push(prop);
}


var vData = 4;
var hData = valuesRy.length;
var offset = 50.5; //offset chart axis
var chartHeight = ch - 2 * offset;
var chartWidth = cw - 2 * offset;
var t = 1 / 7; // curvature : 0 = no curvature
var speed = 2; // for the animation

var A = {
  x: offset,
  y: offset
}
var B = {
  x: offset,
  y: offset + chartHeight
}
var C = {
  x: offset + chartWidth,
  y: offset + chartHeight
}

/*
      A  ^
	    |  |
	    + 25
	    |
	    |
	    |
	    + 25
      |__|_________________________________  C
      B
*/

// CHART AXIS -------------------------
ctx.beginPath();
ctx.moveTo(A.x, A.y);
ctx.lineTo(B.x, B.y);
ctx.lineTo(C.x, C.y);
ctx.stroke();

// vertical ( A - B )
var aStep = (chartHeight - 50) / (vData);

var Max = Math.ceil(arrayMax(valuesRy) / 10) * 10;
var Min = Math.floor(arrayMin(valuesRy) / 10) * 10;
var aStepValue = (Max - Min) / (vData);
console.log("aStepValue: " + aStepValue); //8 units
var verticalUnit = aStep / aStepValue;

var a = [];
ctx.textAlign = "right";
ctx.textBaseline = "middle";
for (var i = 0; i <= vData; i++) {

  if (i == 0) {
    a[i] = {
      x: A.x,
      y: A.y + 25,
      val: Max
    }
  } else {
    a[i] = {}
    a[i].x = a[i - 1].x;
    a[i].y = a[i - 1].y + aStep;
    a[i].val = a[i - 1].val - aStepValue;
  }
  drawCoords(a[i], 3, 0);
}

//horizontal ( B - C )
var b = [];
ctx.textAlign = "center";
ctx.textBaseline = "hanging";
var bStep = chartWidth / (hData + 1);

for (var i = 0; i < hData; i++) {
  if (i == 0) {
    b[i] = {
      x: B.x + bStep,
      y: B.y,
      val: propsRy[0]
    };
  } else {
    b[i] = {}
    b[i].x = b[i - 1].x + bStep;
    b[i].y = b[i - 1].y;
    b[i].val = propsRy[i]
  }
  drawCoords(b[i], 0, 3)
}

function drawCoords(o, offX, offY) {
  ctx.beginPath();
  ctx.moveTo(o.x - offX, o.y - offY);
  ctx.lineTo(o.x + offX, o.y + offY);
  ctx.stroke();

  ctx.fillText(o.val, o.x - 2 * offX, o.y + 2 * offY);
}
//----------------------------------------------------------

// DATA
var oDots = [];
var oFlat = [];
var i = 0;

for (var prop in oData) {
  oDots[i] = {}
  oFlat[i] = {}

  oDots[i].x = b[i].x;
  oFlat[i].x = b[i].x;

  oDots[i].y = b[i].y - oData[prop] * verticalUnit - 25;
  oFlat[i].y = b[i].y - 25;

  oDots[i].val = oData[b[i].val];

  i++
}



///// Animation Chart ///////////////////////////
//var speed = 3;
function animateChart() {
  requestId = window.requestAnimationFrame(animateChart);
  frames += speed; //console.log(frames)
  ctx.clearRect(60, 0, cw, ch - 60);

  for (var i = 0; i < oFlat.length; i++) {
    if (oFlat[i].y > oDots[i].y) {
      oFlat[i].y -= speed;
    }
  }
  drawCurve(oFlat);
  for (var i = 0; i < oFlat.length; i++) {
      ctx.fillText(oDots[i].val, oFlat[i].x, oFlat[i].y - 25);
      ctx.beginPath();
      ctx.arc(oFlat[i].x, oFlat[i].y, 3, 0, 2 * Math.PI);
      ctx.fill();
    }

  if (frames >= Max * verticalUnit) {
    window.cancelAnimationFrame(requestId);

  }
}
requestId = window.requestAnimationFrame(animateChart);

/////// EVENTS //////////////////////
c.addEventListener("mousemove", function(e) {
  label.innerHTML = "";
  label.style.display = "none";
  this.style.cursor = "default";

  var m = oMousePos(this, e);
  for (var i = 0; i < oDots.length; i++) {

    output(m, i);
  }

}, false);

function output(m, i) {
  ctx.beginPath();
  ctx.arc(oDots[i].x, oDots[i].y, 20, 0, 2 * Math.PI);
  if (ctx.isPointInPath(m.x, m.y)) {
    //console.log(i);
    label.style.display = "block";
    label.style.top = (m.y + 10) + "px";
    label.style.left = (m.x + 10) + "px";
    label.innerHTML = "<strong>" + propsRy[i] + "</strong>: " + valuesRy[i] + "%";
    c.style.cursor = "pointer";
  }
}

// CURVATURE
function controlPoints(p) {
  // given the points array p calculate the control points
  var pc = [];
  for (var i = 1; i < p.length - 1; i++) {
    var dx = p[i - 1].x - p[i + 1].x; // difference x
    var dy = p[i - 1].y - p[i + 1].y; // difference y
    // the first control point
    var x1 = p[i].x - dx * t;
    var y1 = p[i].y - dy * t;
    var o1 = {
      x: x1,
      y: y1
    };

    // the second control point
    var x2 = p[i].x + dx * t;
    var y2 = p[i].y + dy * t;
    var o2 = {
      x: x2,
      y: y2
    };

    // building the control points array
    pc[i] = [];
    pc[i].push(o1);
    pc[i].push(o2);
  }
  return pc;
}

function drawCurve(p) {

  var pc = controlPoints(p); // the control points array

  ctx.beginPath();
  //ctx.moveTo(p[0].x, B.y- 25);
  ctx.lineTo(p[0].x, p[0].y);
  // the first & the last curve are quadratic Bezier
  // because I'm using push(), pc[i][1] comes before pc[i][0]
  ctx.quadraticCurveTo(pc[1][1].x, pc[1][1].y, p[1].x, p[1].y);

  if (p.length > 2) {
    // central curves are cubic Bezier
    for (var i = 1; i < p.length - 2; i++) {
      ctx.bezierCurveTo(pc[i][0].x, pc[i][0].y, pc[i + 1][1].x, pc[i + 1][1].y, p[i + 1].x, p[i + 1].y);
    }
    // the first & the last curve are quadratic Bezier
    var n = p.length - 1;
    ctx.quadraticCurveTo(pc[n - 1][0].x, pc[n - 1][0].y, p[n].x, p[n].y);
  }

  //ctx.lineTo(p[p.length-1].x, B.y- 25);
  ctx.stroke();
  ctx.save();
  ctx.fillStyle = grd;
  ctx.fill();
  ctx.restore();
}

function arrayMax(array) {
  return Math.max.apply(Math, array);
};

function arrayMin(array) {
  return Math.min.apply(Math, array);
};

function oMousePos(canvas, evt) {
  var ClientRect = canvas.getBoundingClientRect();
  return { //objeto
    x: Math.round(evt.clientX - ClientRect.left),
    y: Math.round(evt.clientY - ClientRect.top)
  }
}
</script>
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