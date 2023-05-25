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

             <div class=" menu-item">
              <div class="icon-new1"><img src="{{ asset('public/assets/images/brand/settings.png') }}" ></div>  <li class="dropdown">

               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Others <span class="caret"></span></a>
                 <ul class="dropdown-menu" role="menu">
                   <li><a href="#">Inventory</a></li>
                   <li class="dropdown-submenu">
                     <a tabindex="-1" href="#">Birth and Death record<i class="fa fa-chevron-right"></i></a>
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
                   <li><a href="#">Blood Bank</a></li>
                   <li><a href="#">Operation</a></li>

              </div>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
