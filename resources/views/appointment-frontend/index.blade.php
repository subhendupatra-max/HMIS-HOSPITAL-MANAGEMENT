<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctor Appointments</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/appointment-frontend') }}/css/style.css">
</head>
<body>
<!-- ====================================book appointments============================ -->
<div class="outside_arealogin">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 user_loginbackarea">
                  <video loop="true" autoplay="autoplay" muted="">
                      <source src="{{ asset('public/appointment-frontend') }}/images/dappointment.mp4" type="video/mp4">
                  </video>
                  <div class="blck_areabacks"></div>
                  <div class="login_section">
                      <a href="#">
                          <img src="{{ asset('public/appointment-frontend') }}/images/logo.png" class="login_pglogo">
                      </a>
                      <div class="bapcenter_area">
                        <button class="bap_btnarea" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="fas fa-file fle_icndesign"></i>
                            Book Appointments
                            <span class="first"></span>
                            <span class="second"></span>
                            <span class="third"></span>
                            <span class="fourth"></span>
                        </button>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<!-- ====================================book appointments============================ -->
<!-- ====================================form area==================================== -->
<div class="modal" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content gmd_toparea">
         <div class="login-wrap">
            <div class="login-html">
               <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Existing patient</label>
               <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">New patient</label>
               <div class="login-form">

                  <form action="{{ route('appointment-booking.search-patient-for-appointment') }}" method="POST">
                     @csrf
                     <div class="sign-in-htm tgap_area">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="aprmnt_mdlfromarea">
                                 <div class="material-textfield">
                                       <i class="fas fa-phone-volume materialfldi_icondesign"></i>
                                       <input name="patient_mobile_no" type="text">
                                       <label>Patient Search by Mobile No.</label>
                                 </div>
                                 <button class="baabtn_design">Search <i class="fa fa-search fle_icndesign"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>

                  <form action="{{ route('appointment-booking.add-new-patient-for-appointment') }}" method="POST">
                     @csrf
                     <div class="sign-up-htm tgap_area">
                        <div class="row">
                              <div class="col-lg-12">
                                 <div class="aprmnt_mdlfromarea">
                                    <div class="material-textfield">
                                       <i class="fas fa-user materialfldi_icondesign"></i>
                                       <input name="patient_name" type="text" required>
                                       <label>Enter Patient Name</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="aprmnt_mdlfromarea">
                                    <div class="material-textfield">
                                       <i class="fas fa-user materialfldi_icondesign"></i>
                                       <input name="guardian_name" type="text" required>
                                       <label>Enter Guardian Name</label>
                                    </div>
                                 </div>
                              </div>
               
                              <div class="col-lg-6">
                                 <div class="aprmnt_mdlfromarea">
                                    <div class="material-textfield">
                                       <i class="fas fa-phone-volume materialfldi_icondesign"></i>
                                       <input name="patient_phone" type="text" required>
                                       <label>Phone No.</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="aprmnt_mdlfromarea">
                                    <div class="material-textfield">
                                       <i class="fa fa-calendar materialfldi_icondesign"></i>
                                       <input name="patient_age" type="text" required>
                                       <label>Age</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="aprmnt_mdlfromarea">
                                    <div class="material-textfield">
                                       <i class="fas fa-user materialfldi_icondesign"></i>
                                       <select name="patient_gender" id="prefix" class="slctd_area">
                                             <option value="">Choose Gender</option>
                                             <option value="Male">Male</option>
                                             <option value="Female">Female</option>
                                             <option value="Others">Others</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <button class="baabtn_design" type="submit">
                            
                                 Submit<i class="fas fa-paper-plane fle_icndesign"></i>
                                 
                              </button>
                        </div>
                     </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ====================================form area==================================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

