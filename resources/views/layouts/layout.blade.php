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
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

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
        <img src="{{ asset('public/assets/images/svgs/Heart_beat.gif') }}" alt="loader" width="500px" height="200px">
    </div>
    <!--- End Global-loader-->
    <div class="new-page">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="#"><img src="{{ asset('public/assets/images/brand/dashlogo.png') }}" ></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}" ></div>  HR
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="#">User List</a>
                       <a class="dropdown-item" href="#">Add new user</a>
                    </div>
                <li class="nav-item">
                    <a class="nav-link" href="#"><div class="icon-new"> <img src="{{ asset('public/assets/images/brand/hospitalisation.png') }}" ></div>Patient</a>
                  </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="{{ asset('public/assets/images/brand/patient.png') }}" ></div>Opd</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <div class="icon-new"><img src="{{ asset('public/assets/images/brand/hospital-bed.png') }}" ></div>EMG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="{{ asset('public/assets/images/brand/patient (1).png') }}" ></div>IPD</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="{{ asset('public/assets/images/brand/invoice.png') }}" ></div>Bill</a>
              </li>
             <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="{{ asset('public/assets/images/brand/offer.png') }}" ></div>Discount</a>
              </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}" ></div>Pharmacy</a>
              </li>
               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="icon-new"><img src="{{ asset('public/assets/images/brand/investigation.png') }}" ></div>  Investigation
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Pathology</a>
                  <a class="dropdown-item" href="#">Radiology</a>
               </div>
              </li>
              <li class="nav-item">
               <a class="nav-link" href="#"><div class="icon-new"><img src="{{ asset('public/assets/images/brand/hospital-bed (1).png') }}" ></div>Bed</a>
             </li>
             {{--  <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <div class="icon-new"><img src="{{ asset('public/assets/images/brand/settings.png') }}" ></div>  Set up </a>
                 <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <li><a class="dropdown-item" href="#">General Setting</a></li>
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
             </li>  --}}
             <div class=" menu-item">
             <div class="icon-new1"><img src="{{ asset('public/assets/images/brand/settings.png') }}" ></div>  <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Setup <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">General Settings</a></li>
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Charges <i class="fa fa-chevron-right"></i></a>
                    <ul class="dropdown-menu">

                      <li><a href="#">Charges</a>

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
                        <div class="icon-new"><img src="{{ asset('public/assets/images/brand/patient (2).png') }}" ></div> Others</a>
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
                       <a href="#popup1"> <div class="dashprofileimg"><img src="{{ asset('public/assets/images/brand/user.png') }}" ></div>
                      </div>
                   <div id="popup1" class="popup-container">
                       <div class="popup-content">
                         <a href="#" class="close">&times;</a>
                         <h3>   <img src="{{ asset('public/assets/images/brand/user.png') }}" >Name</h3>
                         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                       </div>
                     </div>
               <div class="dash-bellicon">
                   <div class="bell">
                    <div class="popup-link">
                       <a href="#popup1"> <div class="dashprofileimg">  <img src="{{ asset('public/assets/images/brand/bell.png') }}" ></div>
                      </div>
                   <div id="popup1" class="popup-container">
                       <div class="popup-content">
                         <a href="#" class="close">&times;</a>
                         <h3>   <img src="{{ asset('public/assets/images/brand/user.png') }}" >Name</h3>
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
                         <h3>   <img src="{{ asset('public/assets/images/brand/user.png') }}" >Name</h3>
                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                       </div>
                     </div>
               </div>
             </form>

    </div>


    <div class="row">
        @yield('content')
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
{{--    --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{--    --}}

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
