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
    <div class="dash-bord">
    <div class="new-page">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light ">

              <a class="navbar-brand" href="#"><img src="{{ asset('public/assets/images/brand/dashlogo.png') }}" ></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbar1">
                 <ul class="navbar-nav">
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
                 <li class="nav-item">
                  <a class="nav-link" href="#"><div class="icon-new"><img src="{{ asset('public/assets/images/brand/hospital-bed (1).png') }}" ></div>Bed</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <div class="icon-new"><img src="{{ asset('public/assets/images/brand/settings.png') }}" ></div>  Set up </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">General Setting</a></li>
                          <li><a class="dropdown-item" href="#">Inventory</a>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Second Level Menu ! <i class="fa fa-chevron-right"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a tabindex="-1" href="#">Link 1</a></li>
                                  <li><a href="#">Lik 2</a></li>
                                  <li><a href="#">Link 3</a></li>
                                </ul>
                              </li>
                     </li>
                        <li><a class="dropdown-item" href="#">Pharmacy</a>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Second Level Menu ! <i class="fa fa-chevron-right"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a tabindex="-1" href="#">Link 1</a></li>
                                  <li><a href="#">Lik 2</a></li>
                                  <li><a href="#">Link 3</a></li>
                                </ul>
                              </li>
                        </li>
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
                </li>
                 <li class="nav-item dropdown">
                   <a class="nav-link  href="#">
                       <div class="icon-new"><img src="{{ asset('public/assets/images/brand/patient (2).png') }}" ></div> Others



                   </a>

                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <li><a class="dropdown-item" href="#">HR</a></li>
                     <li><a class="dropdown-item" href="#">Inventory</a></li>
                     <li><a class="dropdown-item" href="#">Birth And Death


                     </a>

                   </li>

                     <li class="nav-item dropdown"><a href="#">False Generation</a>

                   </li>
                     <li><a class="dropdown-item" href="#">ReferraL</a></li>
                     <li><a class="dropdown-item" href="#">Ambulance</a></li>
                     <li><a class="dropdown-item" href="#">Font-Office</a></li>
                     <li><a class="dropdown-item" href="#">Bllod-bank</a></li>

                    </ul>
                 </li>

               </ul>
             </div>


                <div class="dashprofileimg"><img src="{{ asset('public/assets/images/brand/user.png') }}" ></div>
                 {{--  <div class="dash-bellicon"><img src="{{ asset('public/assets/images/brand/bell.png') }}" ></div>
                <div class="dash-bellicontext"><a href="#"><h6>100</h6></a></div>  --}}
                <div class="dash-bellicon"><img src="{{ asset('public/assets/images/brand/bell.png') }}" ></div>
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

         </nav>

       </div>

    </div>
    <div class="row">
        @yield('content')
      </div>
      <div id="contenitore">
        <div class="left">

        <table>
        <caption>Date table</caption>
        <tbody>
        <tr><td>A</td><td>80%</td><td style="background-color:#336699">&nbsp;</td></tr>
        <tr><td>B</td><td>68%</td><td style="background-color:#003366">&nbsp;</td></tr>
        <tr><td>C</td><td>30%</td><td style="background-color:#ff6600">&nbsp;</td></tr>
        <tr><td>D</td><td>20%</td><td style="background-color:#ffcc00">&nbsp;</td></tr>
        </tbody></table>
        <div class="button" onclick="viewGraph()">Rerun</div>
        </div>
        <div class="left">
        <div id="grafico">
        <div class="riga" style="top:25%"><div>75%</div></div>
        <div class="riga" style="top:50%"><div>50%</div></div>
        <div class="riga" style="top:75%"><div>25%</div></div>
        <div class="riga" style="top:75%"><div>25%</div></div>
        <div id="col0" style="left:0; background-color:#336699;" class="column"></div>
        <div id="col1" style="left:25%; background-color:#003366;" class="column"></div>
        <div id="col2" style="left:50%; background-color:#ff6600;" class="column"></div>
        <div id="col3" style="left:75%; background-color:#ffcc00;" class="column"></div>
        <div id="col3" style="left:75%; background-color:#ffcc00;" class="column"></div>
        </div>
        </div>
        <div class="canc"></div>
        <div style="margin: 20px auto; text-align:center;">quellidelcucuzzolo.blogspot.com</div>
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
     <!-- End Footer-->
    </div>
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


</body>

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:29:24 GMT -->

</html>
<script>
    function viewGraph(){
        $('.column').css('height','0');
        $('table tr').each(function(index) {
        var ha = $(this).children('td').eq(1).text();
        $('#col'+index).animate({height: ha}, 1500).html("<div>"+ha+"</div>");
        });
        }
        $(document).ready(function(){
        viewGraph();
        });
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
