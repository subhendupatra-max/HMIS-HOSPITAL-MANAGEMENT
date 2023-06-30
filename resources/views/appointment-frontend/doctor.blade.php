<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctor Appointments</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{ asset('public/appointment-frontend') }}/images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/appointment-frontend') }}/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
<!-- ================================header area========================== -->
<div class="container-fluid">
   <div class="row">
        <div class="col-lg-12 topheader_outsection">
             <div class="row">
                <div class="col-lg-2 col-3">
                  <div class="topheader_inleftsection">
                    <a href="book-appointments.html">
                     <img src="{{ asset('public/appointment-frontend') }}/images/logo.png" class="site_logo">
                    </a> 
                  </div>   
                </div>  
                <div class="col-lg-10 col-9">
                    <div class="tophead_inrightsection">
                      <ul class="phnnumber_area">
                        <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@hospital.com">
                            info@hospital.com
                        </a>
                        </li>
                        <li>
                        <i class="fas fa-phone-volume"></i>
                        <a href="tel:(+91) 9123587496">
                            9123587496
                        </a>
                        </li>
                      </ul>
                    </div>  
                </div>  
             </div>
        </div>
   </div>
</div>
<!-- ================================header area========================== -->

<!-- =================================banner area========================= -->
<div class="container-fluid">
    <div class="row">
         <div class="col-lg-12 banner_outarea">
              
         </div>
    </div>
</div>
<!-- =================================banner area========================= -->

<!-- ================================doctor area========================== -->
<div class="container">
   <div class="row">
      <div class="col-lg-12 sddoctor_outsection">
         <div class="row">
            @if(@$doctor_details[0]->id != null || @$doctor_details[0]->id != '')
            @foreach ($doctor_details as $value)
                 <div class="col-lg-6">
                <div class="doctor_seperateoutsection">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="doctor_imgsection">
                            <img src="{{ asset('public/appointment-frontend') }}/images/doctor.png" class="doctor_imgdesign">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="doctore_detailsection">
                            <h1 class="doctor_namedesign">
                                {{ $value->first_name }} {{ $value->last_name }}
                            </h1>
                            <h2 class="doctor_desedcsection">
                                {{ $value->qualification }} | Reg. No: {{ $value->employee_id }}
                            </h2>
                            <h2 class="doctor_desedcsection">
                                {{ $value->specialist }}
                            </h2>
                            {{-- <img src="{{ asset('public/appointment-frontend') }}/images/rating.png" class="rating_starimgdesign"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dcotor_apmntarea">
                                <div>
                                <ul class="nav nav-tabs doctor_shp_area" role="tablist">
                                    <?php 
                                    $currentDate = date('Y-m-d');
                                    for ($i = 0; $i < 10; $i++) {
                                        $futured = date('Y-m-d', strtotime($i.' days')); 
                                        $futureDate = date('jS M', strtotime($i.' days')); 
                                        ?>
                                        <li class="nav-item doctor_timingarea">
                                        <a class="nav-link gffgfgf" onclick="getSlotDetails('{{ $futured }}',{{ $value->id }})">{{ $futureDate }}</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                </div>
                            <!-- Tab panes -->
                            <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient_id }}" />
                            <div class="">
                                <div id="{{ $futureDate }}" class="container">
                                    <br>
                                    <div id="slot_details">

                                    </div>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @endforeach
            @endif
         </div>
      </div>
   </div>
</div>
<!-- ================================doctor area========================== -->
<!-- ================================footer area========================== -->
<div class="container-fluid">
     <div class="row">
          <div class="col-lg-12 footer_cpyrghtout">
              <h2 class="cpyrght_text">
                  © 2023 Devant Hospital. All Rights Reserved || design &amp; developed by 
                  <a href="https://devantitsolutions.com/" target="_blank">DITS</a>
              </h2>
          </div>
     </div>
</div>

<script>
    function getSlotDetails(date,doctor_id)
    {
    // alert(date); 
    var patient_id = $('#patient_id').val();
        var div_data = '';
            $.ajax({
                url: "{{ route('appointment-booking.get-slot-by-appointment-doctor-and-date') }}",
                type: "post",
                data: {
                    doctorId: doctor_id,
                    appointMentdate: date,
                    _token: '{{ csrf_token() }}',                                                                       
                },
                dataType: 'json',
                success: function(res) {
                    $.each(res, function(key, value) {
                        div_data += `<a href=""><div class="single_panel">
                                        <h2 class="time_zonearea">${value.from_time} - ${value.to_time}</h2>
                                    </div></a>`;
                    });
                   
                    $('#slot_details').html(div_data);
                }
            });
    }
</script>
<!-- ================================footer area========================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

