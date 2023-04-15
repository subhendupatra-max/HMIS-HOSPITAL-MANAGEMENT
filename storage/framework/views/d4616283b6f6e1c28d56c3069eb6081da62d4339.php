<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:28:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Admitro - Laravel Bootstrap Admin Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="laravel admin dashboard, best laravel admin panel, laravel admin dashboard, php admin panel template, blade template in laravel, laravel dashboard template, laravel template bootstrap, laravel simple admin panel,laravel dashboard template,laravel bootstrap 4 template, best admin panel for laravel,laravel admin panel template, laravel admin dashboard template, laravel bootstrap admin template, laravel admin template bootstrap 4" />

    <!-- Title -->
    <title>A.M Enterprise</title>

    <!--Favicon -->
    <link rel="icon" href="<?php echo e(asset('assets/images/brand/favicon.ico')); ?>" type="image/x-icon" />

    <!--Bootstrap css -->
    <link href="<?php echo e(asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Style css -->
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/css/dark.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/css/skin-modes.css')); ?>" rel="stylesheet" />

    <!-- Animate css -->
    <link href="<?php echo e(asset('assets/css/animated.css')); ?>" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="<?php echo e(asset('assets/css/sidemenu.css')); ?>" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="<?php echo e(asset('assets/plugins/p-scrollbar/p-scrollbar.css')); ?>" rel="stylesheet" />

    <!---Icons css-->
    <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet" />

    <!-- Data table css -->
    <link href="<?php echo e(asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/datatable/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <!-- Slect2 css -->
    <link href="<?php echo e(asset('assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />


    <!-- Simplebar css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/simplebar/css/simplebar.css')); ?>">

    <!-- Color Skin css -->
    <link id="theme" href="<?php echo e(asset('assets/colors/color1.css')); ?>" rel="stylesheet" type="text/css" />

    <!-- Switcher css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/switcher/css/switcher.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/switcher/demo.css')); ?>">

</head>

<body class="app sidebar-mini">

    <!-- Start Switcher -->
    <div class="switcher-wrapper">
        <div class="demo_changer">
            <div class="demo-icon bg_dark"><i class="fa fa-cog fa-spin  text_primary"></i></div>
            <div class="form_holder switcher-sidebar">
                <div class="row">
                    <div class="predefined_styles">
                        <div class="swichermainleft">
                            <h4>Skin Modes</h4>
                            <div class="switch_section">
                                <div class="switch-toggle d-flex">
                                    <span class="mr-auto">Default Mode</span>
                                    <div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch3" class="onoffswitch2-checkbox" checked>
                                        <label for="myonoffswitch3" class="onoffswitch2-label"></label>
                                    </div>
                                </div>
                                <div class="switch-toggle d-flex">
                                    <span class="mr-auto">Dark Mode</span>
                                    <div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch14" class="onoffswitch2-checkbox">
                                        <label for="myonoffswitch14" class="onoffswitch2-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->

    <!---Global-loader-->
    <div id="global-loader">
        <img src="<?php echo e(asset('assets/images/svgs/loader.svg')); ?>" alt="loader">
    </div>
    <!--- End Global-loader-->
    <!-- Page -->
    <div class="page">
        <div class="page-main">
            <aside class="app-sidebar">
                <div class="app-sidebar__logo">
                    <a class="header-brand" href="<?php echo e(route('dashboard')); ?>">
                        <img src="<?php echo e(asset('assets/images/brand/logo.png')); ?>" style="width: 241px;  height: 48px;" class="header-brand-img desktop-lgo" alt="A.M Enterprise">
                        <img src="<?php echo e(asset('assets/images/brand/logo.png')); ?>" class="header-brand-img dark-logo" alt="A.M Enterprise">
                        <img src="<?php echo e(asset('assets/images/brand/favicon.png')); ?>" class="header-brand-img mobile-logo" alt="A.M Enterprise">
                        <img src="<?php echo e(asset('assets/images/brand/favicon1.png')); ?>" class="header-brand-img darkmobile-logo" alt="A.M Enterprise">
                    </a>


                    <ul class="side-menu app-sidebar3">
                        <!-- DASHBOARD -->

                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('dashboard')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                                    <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".9"></path>
                                </svg>
                                <span class="side-menu__label">Dashboard</span>
                                <!--<span class="badge badge-danger side-badge">Hot</span>-->
                            </a>
                        </li>
                        <!-- JOB -->
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('jobList')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z" />
                                </svg>
                                <span class="side-menu__label">Job</span>
                            </a>
                        </li>
                        <!-- JOB END-->

                        <li class="slide">
                            <a class="side-menu__item" href="#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M20 8h-2.81c-.45-.78-1.07-1.45-1.82-1.96L17 4.41 15.59 3l-2.17 2.17C12.96 5.06 12.49 5 12 5c-.49 0-.96.06-1.41.17L8.41 3 7 4.41l1.62 1.63C7.88 6.55 7.26 7.22 6.81 8H4v2h2.09c-.05.33-.09.66-.09 1v1H4v2h2v1c0 .34.04.67.09 1H4v2h2.81c1.04 1.79 2.97 3 5.19 3s4.15-1.21 5.19-3H20v-2h-2.09c.05-.33.09-.66.09-1v-1h2v-2h-2v-1c0-.34-.04-.67-.09-1H20V8zm-6 8h-4v-2h4v2zm0-4h-4v-2h4v2z" />
                                </svg>
                                <span class="side-menu__label">Item Issue</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('item_main_stock')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 18l2 1V3c0-1.1-.9-2-2-2H8.99C7.89 1 7 1.9 7 3h10c1.1 0 2 .9 2 2v13zM15 5H5c-1.1 0-2 .9-2 2v16l7-3 7 3V7c0-1.1-.9-2-2-2z" />
                                </svg>
                                <span class="side-menu__label">Inventory</span>
                            </a>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" href="#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M7.88 3.39L6.6 1.86 2 5.71l1.29 1.53 4.59-3.85zM22 5.72l-4.6-3.86-1.29 1.53 4.6 3.86L22 5.72zM12 4c-4.97 0-9 4.03-9 9s4.02 9 9 9c4.97 0 9-4.03 9-9s-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11h-2v3H8v2h3v3h2v-3h3v-2h-3V9z" />
                                </svg>
                                <span class="side-menu__label">EMG Challen</span><span class="badge badge-danger side-badge"></span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('vehicleList')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 13v-2c-1.54.02-3.09-.75-4.07-1.83l-1.29-1.43c-.17-.19-.38-.34-.61-.45-.01 0-.01-.01-.02-.01H13c-.35-.2-.75-.3-1.19-.26C10.76 7.11 10 8.04 10 9.09V15c0 1.1.9 2 2 2h5v5h2v-5.5c0-1.1-.9-2-2-2h-3v-3.45c1.29 1.07 3.25 1.94 5 1.95zm-6.17 5c-.41 1.16-1.52 2-2.83 2-1.66 0-3-1.34-3-3 0-1.31.84-2.41 2-2.83V12.1c-2.28.46-4 2.48-4 4.9 0 2.76 2.24 5 5 5 2.42 0 4.44-1.72 4.9-4h-2.07z" />
                                </svg>
                                <span class="side-menu__label">Vehical Information</span>
                            </a>
                        </li>

                        <!-- DASHBOARD END-->

                        <!-- USER -->

                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                                </svg>
                                <span class="side-menu__label">Human Resource</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu ">
                                <!-- FOR ADMIN ONLY -->
                                <li><a href="#" class="slide-item"> Create User</a></li>
                                <!-- FOR ADMIN ONLY END -->

                                <!-- FOR USER AND ADMIN ONLY -->
                                <li><a href="#" class="slide-item"> Update Profile</a></li>
                                <!-- FOR USER AND ADMIN ONLY -->
                            </ul>
                        </li>
                        <!-- USER END-->

                        <li class="slide">
                            <a class="side-menu__item" href="#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M20 8h-2.81c-.45-.78-1.07-1.45-1.82-1.96L17 4.41 15.59 3l-2.17 2.17C12.96 5.06 12.49 5 12 5c-.49 0-.96.06-1.41.17L8.41 3 7 4.41l1.62 1.63C7.88 6.55 7.26 7.22 6.81 8H4v2h2.09c-.05.33-.09.66-.09 1v1H4v2h2v1c0 .34.04.67.09 1H4v2h2.81c1.04 1.79 2.97 3 5.19 3s4.15-1.21 5.19-3H20v-2h-2.09c.05-.33.09-.66.09-1v-1h2v-2h-2v-1c0-.34-.04-.67-.09-1H20V8zm-6 8h-4v-2h4v2zm0-4h-4v-2h4v2z" />
                                </svg>
                                <span class="side-menu__label">Scrap Materials</span>
                            </a>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('issue_form')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z" />
                                </svg>
                                <span class="side-menu__label">Tools Management</span>
                            </a>
                        </li>

                        <!-- REPORT -->

                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                                </svg>
                                <span class="side-menu__label">Report</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu ">
                                <!-- FOR ADMIN ONLY -->
                                <li><a href="#" class="slide-item">Requisition</a></li>
                                <!-- FOR ADMIN ONLY END -->

                                <!-- FOR USER AND ADMIN ONLY -->
                                <li><a href="#" class="slide-item">Purchase Order</a></li>
                                <!-- FOR USER AND ADMIN ONLY -->
                            </ul>
                        </li>

                        <!-- REPORT END-->



                        <!-- SYSTEM -->

                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                    <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z" />
                                </svg>
                                <span class="side-menu__label">Settings </span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu ">
                                <li> <a href="<?php echo e(route('itemTypeList')); ?>" class="slide-item">Item Type</a></li>
                                <li> <a href="<?php echo e(route('itemList')); ?>" class="slide-item">Item</a></li>
                                <li> <a href="<?php echo e(route('itemattributeList')); ?>" class="slide-item">Item Attribute</a></li>
                                <li> <a href="<?php echo e(route('unitAdd')); ?>" class="slide-item">Unit</a></li>
                                <li> <a href="<?php echo e(route('brandList')); ?>" class="slide-item">Brand</a></li>
                                <li> <a href="<?php echo e(route('workshopList')); ?>" class="slide-item">Workshop</a></li>
                                <li> <a href="<?php echo e(route('manufactureList')); ?>" class="slide-item">Manufacture</a></li>
                                <li> <a href="<?php echo e(route('vendorList')); ?>" class="slide-item">Vendor</a></li>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view item categories')): ?>
                                <li><a href="<?php echo e(route('prefixList')); ?>" class="slide-item">Prefix Settings</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('view role') || auth()->user()->can('asign userBasedPermission') || auth()->user()->can('view permission')|| auth()->user()->can('asign roleToUser')|| auth()->user()->can('view permission')): ?>

                                <!-- ROLE PERMISSION -->

                                <li class="sub-slide">
                                    <a class="sub-side-menu__item" data-toggle="sub-slide" href="index-2.html#"><span class="sub-side-menu__label">Role & Permission</span><i class="sub-angle fe fe-chevron-down"></i></a>
                                    <ul class="sub-slide-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view role')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('roleList')); ?>">Role</a></li>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->can('revoke roleToUser') || auth()->user()->can('asign roleToUser')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('asignRole')); ?>">User Role management</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view permission')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('PermissionList')); ?>">Permission</a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asign userBasedPermission')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('userPermissionAsignList')); ?>">User Permission</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>


                                <!-- ROLE PERMISSION END-->
                                <?php endif; ?>

                                
                            </ul>
                        </li>
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
                                    <img src="<?php echo e(asset('assets/images/brand/logo.png')); ?>" class="header-brand-img desktop-lgo" alt="Admintro logo">
                                    <img src="<?php echo e(asset('assets/images/brand/logo1.png')); ?>" class="header-brand-img dark-logo" alt="Admintro logo">
                                    <img src="<?php echo e(asset('assets/images/brand/favicon.png')); ?>" class="header-brand-img mobile-logo" alt="Admintro logo">
                                    <img src="<?php echo e(asset('assets/images/brand/favicon1.png')); ?>" class="header-brand-img darkmobile-logo" alt="Admintro logo">
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
                                <div class="mt-1">
                                    <form class="form-inline">
                                        <div class="search-element">
                                            <input type="search" class="form-control header-search"  placeholder="Search" aria-label="Search" tabindex="1">
                                            <button class="btn btn-primary-color" type="submit">
                                                <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- SEARCH -->
                                <div class="d-flex order-lg-2 ml-auto">
                                    <a href="index-2.html#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
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
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create requisition')): ?>
                                    <div class="dropdown   header-fullscreen">
                                        <a class="nav-link icon full-screen-link p-0" href="<?php echo e(route('create-requisition')); ?>" data-placement="bottom" data-toggle="tooltip" title="Create Requisition" id="fullscreen-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24">
                                                <path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="dropdown   header-fullscreen">
                                        <a class="nav-link icon full-screen-link p-0" href="<?php echo e(route('itemList')); ?>" id="fullscreen-button" data-placement="bottom" data-toggle="tooltip" title="Add Item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                            </svg>
                                        </a>
                                    </div>

                                    <!--  <div class="dropdown header-message">
                                        <a class="nav-link icon" data-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon"
                                                width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M20,2H4C2.897,2,2,2.897,2,4v12c0,1.103,0.897,2,2,2h3v3.767L13.277,18H20c1.103,0,2-0.897,2-2V4C22,2.897,21.103,2,20,2z M20,16h-7.277L9,18.233V16H4V4h16V16z" />
                                                <path d="M7 7H17V9H7zM7 11H14V13H7z" />
                                            </svg>
                                            <span class="badge badge-success side-badge">3</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated">
                                            <div class="dropdown-header">
                                                <h6 class="mb-0">Messages</h6>
                                                <span class="badge badge-pill badge-primary ml-auto">View all</span>
                                            </div>
                                            <div class="header-dropdown-list message-menu" id="message-menu">
                                                <a class="dropdown-item border-bottom" href="index-2.html#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <span
                                                                class="avatar avatar-md brround align-self-center cover-image"
                                                                data-image-src="assets/images/users/1.jpg"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="pl-3">
                                                                <h6 class="mb-1">Jack Wright</h6>
                                                                <p class="fs-13 mb-1">All the best your template
                                                                    awesome</p>
                                                                <div class="small text-muted">
                                                                    3 hours ago
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <span
                                                                class="avatar avatar-md brround align-self-center cover-image"
                                                                data-image-src="assets/images/users/2.jpg"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="pl-3">
                                                                <h6 class="mb-1">Lisa Rutherford</h6>
                                                                <p class="fs-13 mb-1">Hey! there I'm available</p>
                                                                <div class="small text-muted">
                                                                    5 hour ago
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <span
                                                                class="avatar avatar-md brround align-self-center cover-image"
                                                                data-image-src="assets/images/users/3.jpg"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="pl-3">
                                                                <h6 class="mb-1">Blake Walker</h6>
                                                                <p class="fs-13 mb-1">Just created a new blog post</p>
                                                                <div class="small text-muted">
                                                                    45 mintues ago
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <span
                                                                class="avatar avatar-md brround align-self-center cover-image"
                                                                data-image-src="assets/images/users/4.jpg"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="pl-3">
                                                                <h6 class="mb-1">Fiona Morrison</h6>
                                                                <p class="fs-13 mb-1">Added new comment on your photo
                                                                </p>
                                                                <div class="small text-muted">
                                                                    2 days ago
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <span
                                                                class="avatar avatar-md brround align-self-center cover-image"
                                                                data-image-src="assets/images/users/6.jpg"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="pl-3">
                                                                <h6 class="mb-1">Stewart Bond</h6>
                                                                <p class="fs-13 mb-1">Your payment invoice is
                                                                    generated</p>
                                                                <div class="small text-muted">
                                                                    3 days ago
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <span
                                                                class="avatar avatar-md brround align-self-center cover-image"
                                                                data-image-src="assets/images/users/7.jpg"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="pl-3">
                                                                <h6 class="mb-1">Faith Dickens</h6>
                                                                <p class="fs-13 mb-1">Please check your mail....</p>
                                                                <div class="small text-muted">
                                                                    4 days ago
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class=" text-center p-2 border-top">
                                                <a href="index-2.html#" class="">See All Messages</a>
                                            </div>
                                        </div>
                                    </div> -->
                       
                                    <div class="dropdown profile-dropdown">
                                        <a href="index-2.html#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                            <span>
                                                <img src="<?php echo e(asset('assets/images/users/2.jpg')); ?>" alt="img" class="avatar avatar-md brround">
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                                            <div class="text-center">
                                                <a href="index-2.html#" class="dropdown-item text-center user pb-0 font-weight-bold">Jessica</a>
                                                <span class="text-center user-semi-title">Web Designer</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <a class="dropdown-item d-flex" href="index-2.html#">
                                                <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z" />
                                                </svg>
                                                <div class="">Profile</div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="index-2.html#">
                                                <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                                                </svg>
                                                <div class="">Settings</div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="index-2.html#">
                                                <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z" />
                                                </svg>
                                                <div class="">Messages</div>
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
                                                <div onclick="document.getElementById('logout_form').submit();">Sign Out</div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/app header-->
                    <!--Page header-->
                    
                    <!--End Page header-->
                    <div class="row">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
            <!-- End app-content-->
        </div>
        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2022 <a href="index-2.html#">AME</a>. Designed by <a href="index-2.html#">Devant IT Solutions Pvt. Ltd.</a> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->
    </div><!-- End Page -->
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>





    <!-- Jquery js-->
    <script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>

    <!-- Bootstrap4 js-->
    <script src="<?php echo e(asset('assets/plugins/bootstrap/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

    <!--Othercharts js-->
    <script src="<?php echo e(asset('assets/plugins/othercharts/jquery.sparkline.min.js')); ?>"></script>

    <!-- Circle-progress js-->
    <script src="<?php echo e(asset('assets/js/circle-progress.min.js')); ?>"></script>

    <!-- Jquery-rating js-->
    <script src="<?php echo e(asset('assets/plugins/rating/jquery.rating-stars.js')); ?>"></script>

    <!--Sidemenu js-->
    <script src="<?php echo e(asset('assets/plugins/sidemenu/sidemenu.js')); ?>"></script>

    <!-- P-scroll js-->
    <script src="<?php echo e(asset('assets/plugins/p-scrollbar/p-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/p-scrollbar/p-scroll1.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/p-scrollbar/p-scroll.js')); ?>"></script>


    <!--INTERNAL Peitychart js-->
    <script src="<?php echo e(asset('assets/plugins/peitychart/jquery.peity.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/peitychart/peitychart.init.js')); ?>"></script>

    <!--INTERNAL Apexchart js-->
    <script src="<?php echo e(asset('assets/js/apexcharts.js')); ?>"></script>

    <!--INTERNAL ECharts js-->
    <script src="<?php echo e(asset('assets/plugins/echarts/echarts.js')); ?>"></script>

    <!--INTERNAL Chart js -->
    <script src="<?php echo e(asset('assets/plugins/chart/chart.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/chart/utils.js')); ?>"></script>

    <!-- INTERNAL Select2 js -->
    <script src="<?php echo e(asset('assets/plugins/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2.js')); ?>"></script>

    <!--INTERNAL Moment js-->
    <script src="<?php echo e(asset('assets/plugins/moment/moment.js')); ?>"></script>

    <!--INTERNAL Index js-->
    <script src="<?php echo e(asset('assets/js/index1.js')); ?>"></script>

    <!-- Simplebar JS -->
    <script src="<?php echo e(asset('assets/plugins/simplebar/js/simplebar.min.js')); ?>"></script>
    <!-- Custom js-->
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>

    <!-- INTERNAL Data tables -->
    <script src="<?php echo e(asset('assets/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatables.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/plugins/flot/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot/jquery.flot.fillbetween.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/flot.js')); ?>"></script>



    <!-- Switcher js-->
    <script src="<?php echo e(asset('assets/switcher/js/switcher.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:29:24 GMT -->

</html><?php /**PATH E:\ame_inventory\resources\views/layouts/layout.blade.php ENDPATH**/ ?>