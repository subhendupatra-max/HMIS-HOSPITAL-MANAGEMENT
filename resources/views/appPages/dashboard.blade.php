@extends('layouts.layout')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<div class="card-design">
  <div class="container-fluid">
    <div class="menubox">
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today OPD Ticket Income</h3>
          <p class="small">{{@$opd_today_ticket_details}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/human-resources.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today OPD New Patient</h3>
          <p class="small">{{@$opd_today_new_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/appointment.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Opd Revisit Patient</h3>
          <p class="small">{{@$opd_today_revisit_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/registration.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Emergency Patient</h3>
          <p class="small">{{@$today_emg_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/opd out patients.png') }}">
            </div>
          </div>
        </a>
      </div>

      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today EMG Income</h3>
          <p class="small">{{@$today_emg_income}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/emergency patient.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Total Ipd Patient</h3>
          <p class="small">{{@$total_ipd_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/emergency patient.png') }}">
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="menubox">
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Ipd Patients</h3>
          <p class="small">{{@$today_total_ipd_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/ipd patients.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today IPD From OPD</h3>
          <p class="small">{{@$today_ipd_from_opd_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/dicount.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today IPD From EMG</h3>
          <p class="small">{{@$today_ipd_from_emg_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/pathology.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Discharged Patient</h3>
          <p class="small">{{@$today_discharged_patient}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/radiology.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>IPD Income</h3>
          <p class="small">{{@$ipd_income}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/pharmacy.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Pharmacy Income</h3>
          <p class="small">{{@$pharmacy_income}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/pharmacy.png') }}">
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="menubox">
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Pathology Income</h3>
          <p class="small">{{@$pathology_income}}</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/inventory.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Birth Record</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/medical-record.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Pathology</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/pathology.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Ambulance</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/ambulance.png') }}">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Font Office</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/medical-record.png') }}">
            </div>
          </div>
        </a>
      </div>

      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Blood Bank</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="{{ asset('public/assets/images/brand/blood-type.png') }}">
            </div>
          </div>
        </a>
      </div>
    </div>

  </div>
</div>

<div class="graph">

    <div class="row">
        <div class="col-lg-6 barbox">
            <div class="bar-graph">
                <div class="wrapper_bar">
                  <canvas id="canvas"></canvas>
                    <div class="label">text</div>
                </div>
            </div>
        </div>
     

    <div class="col-lg-6 piebox">
      <canvas width="500" id="myChart"></canvas>
    </div>
  </div>
  </div>

</div>
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
{{-- --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>


{{-- --}}
{{--  --}}
<script>
 

  var ctx = document.getElementById("myChart").getContext('2d');

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["OPD", "IPD", "EMG", ],
      datasets: [{
        data: [<?php echo $opd_billing_details ?>, <?php echo $ipd_billing_details ?>, <?php echo $emg_billing_details ?>], // Specify the data values array

        borderColor: ['#2196f38c', '#f443368c', '#3f51b570', ], // Add custom color border
        backgroundColor: ['#2196f38c', '#f443368c', '#3f51b570'], // Add custom color background (Points and Fill)
        borderWidth: 1 // Specify bar border width
      }]
    },
    options: {
    responsive: true, // Instruct chart js to respond nicely.
    maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
    }
  });
</script>
   <script>
    var barChartData = {
        labels: [<?php echo $tarik ?>],
        datasets: [{
                label: "Billing Amount",
                backgroundColor: "#2e4f4f",
                borderColor: "#2e4f4f",
                borderWidth: 1,
                data: [<?php echo $value_total ?>]
            },
            {
                label: "Payment Amount",
                backgroundColor: "#5798a3",
                borderColor: "#5798a3",
                borderWidth: 1,
                data: [<?php echo $value_total_p ?>]
            },

        ]
    };

    var chartOptions = {
        responsive: true,
        legend: {
            position: "top"
        },
        title: {
            display: true,
            text: "Last 10 days Total Billing "
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: "bar",
            data: barChartData,
            options: chartOptions
        });
    };
</script>
    @endsection
