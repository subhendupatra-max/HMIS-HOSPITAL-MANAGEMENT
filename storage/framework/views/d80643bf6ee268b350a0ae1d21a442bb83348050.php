<?php $general_details = DB::table('settings')->first();
      $login_details = DB::table('users')->where('id',Auth::id())->where('is_active','1')->first(); 
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:28:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
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

    <!-- Start Switcher -->
<!--     <div class="switcher-wrapper">
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
    </div> -->
    <!-- End Switcher -->

    <!---Global-loader-->
    <div id="global-loader">
        <img src="<?php echo e(asset('public/assets/images/svgs/loader.svg')); ?>" alt="loader">
    </div>
    <!--- End Global-loader-->
    <!-- Page -->
    <div class="page">
        <div class="page-main">
            <aside class="app-sidebar">
                <div class="app-sidebar__logo">
                    <a class="header-brand" href="<?php echo e(route('dashboard')); ?>">
                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->logo); ?>" style="width: 241px;  height: 48px;" class="header-brand-img desktop-lgo" alt="<?php echo e(@$general_details->software_name); ?>">
                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->logo); ?>" class="header-brand-img dark-logo" alt="<?php echo e(@$general_details->software_name); ?>">

                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->small_logo); ?>" class="header-brand-img mobile-logo" alt="<?php echo e(@$general_details->software_name); ?>">

                        <img src="<?php echo e(asset('public/assets/images/brand')); ?>/<?php echo e(@$general_details->logo); ?>" class="header-brand-img darkmobile-logo" alt="<?php echo e(@$general_details->software_name); ?>">
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
                        <?php if(auth()->user()->can('Job Section')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('jobList')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z" />
                                </svg>
                                <span class="side-menu__label">Job</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <!-- JOB END-->

                        <?php if(auth()->user()->can('Inventory')  ): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('item_main_stock')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 18l2 1V3c0-1.1-.9-2-2-2H8.99C7.89 1 7 1.9 7 3h10c1.1 0 2 .9 2 2v13zM15 5H5c-1.1 0-2 .9-2 2v16l7-3 7 3V7c0-1.1-.9-2-2-2z" />
                                </svg>
                                <span class="side-menu__label">Inventory</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Emg Challan')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('emg-challan')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M7.88 3.39L6.6 1.86 2 5.71l1.29 1.53 4.59-3.85zM22 5.72l-4.6-3.86-1.29 1.53 4.6 3.86L22 5.72zM12 4c-4.97 0-9 4.03-9 9s4.02 9 9 9c4.97 0 9-4.03 9-9s-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11h-2v3H8v2h3v3h2v-3h3v-2h-3V9z" />
                                </svg>
                                <span class="side-menu__label">EMG Challan</span><span class="badge badge-danger side-badge"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('VEHICLE REGISTRATION')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('vehicleList')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 13v-2c-1.54.02-3.09-.75-4.07-1.83l-1.29-1.43c-.17-.19-.38-.34-.61-.45-.01 0-.01-.01-.02-.01H13c-.35-.2-.75-.3-1.19-.26C10.76 7.11 10 8.04 10 9.09V15c0 1.1.9 2 2 2h5v5h2v-5.5c0-1.1-.9-2-2-2h-3v-3.45c1.29 1.07 3.25 1.94 5 1.95zm-6.17 5c-.41 1.16-1.52 2-2.83 2-1.66 0-3-1.34-3-3 0-1.31.84-2.41 2-2.83V12.1c-2.28.46-4 2.48-4 4.9 0 2.76 2.24 5 5 5 2.42 0 4.44-1.72 4.9-4h-2.07z" />
                                </svg>
                                <span class="side-menu__label">Vehical Information</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('User')): ?>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                                </svg>
                                <span class="side-menu__label">Human Resource</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <?php if(auth()->user()->can('User List')): ?>
                                <li><a href="<?php echo e(route('user-list')); ?>" class="slide-item"> User List</a></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('User Add')): ?>
                                <li><a href="<?php echo e(route('UserCreate')); ?>" class="slide-item"> Add New User</a></li>
                                <?php endif; ?>  
                            </ul>
                        </li>
                        <?php endif; ?>
       
                        <?php if(auth()->user()->can('Scrap Material')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('scrap-details')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M20 8h-2.81c-.45-.78-1.07-1.45-1.82-1.96L17 4.41 15.59 3l-2.17 2.17C12.96 5.06 12.49 5 12 5c-.49 0-.96.06-1.41.17L8.41 3 7 4.41l1.62 1.63C7.88 6.55 7.26 7.22 6.81 8H4v2h2.09c-.05.33-.09.66-.09 1v1H4v2h2v1c0 .34.04.67.09 1H4v2h2.81c1.04 1.79 2.97 3 5.19 3s4.15-1.21 5.19-3H20v-2h-2.09c.05-.33.09-.66.09-1v-1h2v-2h-2v-1c0-.34-.04-.67-.09-1H20V8zm-6 8h-4v-2h4v2zm0-4h-4v-2h4v2z" />
                                </svg>
                                <span class="side-menu__label">Scrap Materials</span>
                            </a>
                        </li>
                        <?php endif; ?>
                         <?php if(auth()->user()->can('TOOLS MANAGEMENT')): ?>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('issue_list')); ?>">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z" />
                                </svg>
                                <span class="side-menu__label">Tools Management</span>
                            </a>
                        </li>
                      <?php endif; ?>

                <!-- REPORT -->
                    <?php if(auth()->user()->can('report')): ?>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="index-2.html#">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                                </svg>
                                <span class="side-menu__label">Report</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu ">
                                <?php if(auth()->user()->can('requisition report')): ?>
                                <li><a href="<?php echo e(route('report.requisition-report-form')); ?>" class="slide-item">Requisition</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('po report')): ?>
                                <li><a href="<?php echo e(route('report.po-report-form')); ?>" class="slide-item">Purchase Order</a></li>
                                <?php endif; ?>

                               
                                
                               
                            </ul>
                        </li>
                    <?php endif; ?>
                <!-- REPORT END-->

                      

                        <!-- SYSTEM -->
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

                                <?php if(auth()->user()->can('ITEM TYPE')): ?>
                                <li> <a href="<?php echo e(route('itemTypeList')); ?>" class="slide-item">Item Type</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('Item')): ?>
                                <li> <a href="<?php echo e(route('itemList')); ?>" class="slide-item">Item</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('item attribute')): ?>
                                <li> <a href="<?php echo e(route('itemattributeList')); ?>" class="slide-item">Item Attribute</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('view item unit')): ?>
                                <li> <a href="<?php echo e(route('unitAdd')); ?>" class="slide-item">Unit</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('brands')): ?>
                                <li> <a href="<?php echo e(route('brandList')); ?>" class="slide-item">Brand</a></li>
                                <?php endif; ?>
                                
                                <?php if(auth()->user()->can('warehouse')): ?>
                                <li> <a href="<?php echo e(route('workshopList')); ?>" class="slide-item">Workshop</a></li>
                                <?php endif; ?>
                                
                               <!--  <?php if(auth()->user()->can('store')): ?>
                                <li> <a href="<?php echo e(route('storeList')); ?>" class="slide-item">Store</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('rack')): ?>
                                <li> <a href="<?php echo e(route('rackList')); ?>" class="slide-item">Rack</a></li>
                                <?php endif; ?> -->

                                <?php if(auth()->user()->can('manufacturer')): ?>
                                <li> <a href="<?php echo e(route('manufactureList')); ?>" class="slide-item">Manufactur</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('vendor')): ?>
                                <li> <a href="<?php echo e(route('vendorList')); ?>" class="slide-item">Vendor</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('prefix')): ?>
                                <li><a href="<?php echo e(route('prefixList')); ?>" class="slide-item">Prefix Settings</a></li>
                                <?php endif; ?>

                                <?php if(auth()->user()->can('view role') || auth()->user()->can('asign userBasedPermission') || auth()->user()->can('view permission')|| auth()->user()->can('asign roleToUser')|| auth()->user()->can('view permission')): ?>

                                <!-- ROLE PERMISSION -->

                                <li class="sub-slide">
                                    <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Role & Permission</span><i class="sub-angle fe fe-chevron-down"></i></a>
                                    <ul class="sub-slide-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view role')): ?>
                                        <li><a class="sub-slide-item" href="<?php echo e(route('roleList')); ?>">Role</a></li>
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
                                <div class="mt-1">
                                    <form class="form-inline">
                                        <div class="search-element">
                                            <input type="search" class="form-control header-search" id="item_entry_reslt" onkeyup="get_all_item_result()"  placeholder="Search With Item Name" aria-label="Search" tabindex="1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu dropdown-menu-center" style="width: 600px !important;margin-top: -64px !important;" id="search_result_for_item">
                      

                   
                          
                </div>
                                            <button class="btn btn-primary-color" type="button">
                                                <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>

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
                                    <div class="dropdown header-notify">
                                       <a class="nav-link icon" data-toggle="dropdown" aria-expanded="false">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24">
                                             <path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707C3.105 15.48 3 15.734 3 16v2c0 .553.447 1 1 1h16c.553 0 1-.447 1-1v-2c0-.266-.105-.52-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707C6.895 14.52 7 14.266 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zM12 22c1.311 0 2.407-.834 2.818-2H9.182C9.593 21.166 10.689 22 12 22z"></path>
                                          </svg>
                                          <span class="pulse "></span> 
                                       </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated" style="">
      <div class="dropdown-header">
         <h6 class="mb-0">Notifications</h6>
         <span class="badge badge-pill badge-primary ml-auto">View all</span> 
      </div>
      <div class="notify-menu ps">
         <a href="#" class="dropdown-item border-bottom d-flex pl-4">
            <div class="notifyimg bg-info-transparent text-info"> <i class="ti-comment-alt"></i> </div>
            <div>
               <div class="font-weight-normal1">Message Sent.</div>
               <div class="small text-muted">3 hours ago</div>
            </div>
         </a>
         <a href="#" class="dropdown-item border-bottom d-flex pl-4">
            <div class="notifyimg bg-primary-transparent text-primary"> <i class="ti-shopping-cart-full"></i> </div>
            <div>
               <div class="font-weight-normal1"> Order Placed</div>
               <div class="small text-muted">5 hour ago</div>
            </div>
         </a>
         <a href="#" class="dropdown-item border-bottom d-flex pl-4">
            <div class="notifyimg bg-warning-transparent text-warning"> <i class="ti-calendar"></i> </div>
            <div>
               <div class="font-weight-normal1"> Event Started</div>
               <div class="small text-muted">45 mintues ago</div>
            </div>
         </a>
         <a href="#" class="dropdown-item border-bottom d-flex pl-4">
            <div class="notifyimg bg-success-transparent text-success"> <i class="ti-desktop"></i> </div>
            <div>
               <div class="font-weight-normal1">Your Admin launched</div>
               <div class="small text-muted">1 daya ago</div>
            </div>
         </a>
         <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
         </div>
         <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
         </div>
      </div>
      <div class=" text-center p-2 border-top"> <a href="#" class="">View All Notifications</a> </div>
                                        </div>
                                        </div>
                              

                                    <div class="dropdown profile-dropdown">
                                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                            <span>
                                                <img src="<?php echo e(asset('public/profile_picture')); ?>/<?php echo e($login_details->profile_image); ?>" alt="My Profile Picture" class="avatar avatar-md brround">
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                                            <div class="text-center">
                                                <a href="#" class="dropdown-item text-center user pb-0 font-weight-bold"><?php echo e($login_details->name); ?></a>
                                                <span class="text-center user-semi-title"><?php echo e($login_details->role_as); ?></span>
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
                                                <div onclick="document.getElementById('logout_form').submit();">Sign Out</div>
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
            </div>
            <!-- End app-content-->
        </div>
        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2022 <a href="#"><?php echo e(@$general_details-> software_name); ?></a>. Designed by <a href="https://devantitsolutions.com/" target="_blank">Devant IT Solutions Pvt. Ltd.</a> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->
    </div><!-- End Page -->
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>

<script type="text/javascript">
    function get_all_item_result()
    {
         $('#search_result_for_item').empty();
        var item_search_name =  $('#item_entry_reslt').val();
        if(item_search_name != '')
        {
        var div_data_serch_res = '';
        console.log(item_search_name);
        $.ajax({
    
            url: "<?php echo e(route('get-item-serach')); ?>",
            type: "post",
            data: {
                item__id: item_search_name,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $.each(res, function(i, obj) {
                    div_data_serch_res += '<a class="dropdown-item" href="<?php echo e(url("item-serach-result")); ?>/'+obj.item_id+'" >'+obj.item_name+'(Brand:'+obj.brand_name+')(Manufacturer:'+obj.manufacturar_name+')('+obj.item_description+')</a>';

                });
    
                $('#search_result_for_item').append(div_data_serch_res);
    
            }
        });
    }
    }

</script>





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


</body>

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:29:24 GMT -->

</html><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/layouts/layout.blade.php ENDPATH**/ ?>