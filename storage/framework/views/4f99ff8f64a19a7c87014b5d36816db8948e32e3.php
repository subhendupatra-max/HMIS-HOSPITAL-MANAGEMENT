<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctor Appointments</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="<?php echo e(asset('public/appointment-frontend')); ?>/images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/appointment-frontend')); ?>/css/style.css">
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
                     <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/logo.png" class="site_logo">
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

<!-- ================================department area====================== -->
<div class="container">
     <div class="row">
          <div class="col-lg-12 department_sndoutsection">
            <div id="message">
                <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session()->has('error')): ?>
                <div class="alert alert-success" role="alert"><?php echo e(session('error')); ?></div>
                <?php endif; ?>
            </div>
               <h1 class="search_doctortext">CHOOSE YOUR DEPARTMENT</h1>
               <div class="row">
                    <div class="col-lg-3 col-6">
                         <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>4,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/cardiology.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Cardiology
                                   </h2>
                              </div>
                            </a>  
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                         <div class="single_cardoutsection">
                            <a href="href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>5,'patient_id'=>$patient_id])); ?>"">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/derma.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Dermatology
                                   </h2>
                              </div>
                            </a>  
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                         <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>6,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/ent.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       ENT
                                   </h2>
                              </div>
                            </a>  
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                         <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>7,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/generalmedicne.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       General Medicine
                                   </h2>
                              </div>
                            </a>  
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>8,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/gynecology.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       General Surgery
                                   </h2>
                              </div>
                            </a>  
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                         <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>11,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/ophthalmology.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Ophthalmology
                                   </h2>
                              </div>
                            </a>  
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                         <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>13,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/orthopaedics.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Orthopaedics
                                   </h2>
                              </div>
                            </a>  
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>14,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/peadiatrics.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Peadiatrics
                                   </h2>
                              </div>
                            </a>  
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>18,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/cardiology.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Psychiatry
                                   </h2>
                              </div>
                            </a>  
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                         <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>21,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/derma.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Respiratory Medicine
                                   </h2>
                              </div>
                            </a>  
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>10,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/gynecology.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Gynaecology
                                   </h2>
                              </div>
                            </a>  
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="single_cardoutsection">
                            <a href="<?php echo e(route('appointment-booking.department-doctor-list',['department_id'=>96,'patient_id'=>$patient_id])); ?>">
                              <img src="<?php echo e(asset('public/appointment-frontend')); ?>/images/ophthalmology.jpg" class="department_imgdesign">
                              <div class="department_blackclr">
                                   <h2 class="department_textdesignx">
                                       Urology
                                   </h2>
                              </div>
                            </a>  
                        </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- ================================department area====================== -->
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
<!-- ================================footer area========================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    setTimeout(function(){
      document.getElementById('message').style.display = 'none';
    }, 4000);
</script>
</body>
</html>

<?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/appointment-frontend/departments.blade.php ENDPATH**/ ?>