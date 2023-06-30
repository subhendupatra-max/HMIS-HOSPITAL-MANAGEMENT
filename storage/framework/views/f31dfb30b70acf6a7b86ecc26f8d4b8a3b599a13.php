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
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/appointment-frontend')); ?>/css/style.css">
</head>
<body>
<!-- ====================================book appointments============================ -->
<div class="outside_arealogin">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 user_loginbackarea">
                  <video loop="true" autoplay="autoplay" muted="">
                      <source src="<?php echo e(asset('public/appointment-frontend')); ?>/images/dappointment.mp4" type="video/mp4">
                  </video>
                  <div class="blck_areabacks">
                    
                  </div>
                  <div class="login_section">
              
                      <div class="gmd_toparea">
                        <div class="bapcenter_area">
                        <div id="message">
                        <?php if(session('success')): ?>
                        <div class="alert alert-success" role="alert"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>
                        <?php if(session()->has('error')): ?>
                        <div class="alert alert-success" role="alert"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>
                        </div>
                            <div class="login-wrap">
                                <div class="login-html">
                                <div class="login-form">
                                    <div class="tgap_area">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="aprmnt_mdlfromarea">
                                                
                                                        <div class="">
                                                        <table class="table table-bordered patient_table">
                                                            <tbody>
                                                              <tr>
                                                                <td>Patient Name</td>
                                                                <td><?php echo e(@$patient_details->prefix); ?> <?php echo e(@$patient_details->first_name); ?>

                                                                    <?php echo e(@$patient_details->middle_name); ?> <?php echo e(@$patient_details->last_name); ?></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Guardian Name</td>
                                                                <td><?php echo e(@$patient_details->guardian_name_realation); ?> <?php echo e(@$patient_details->guardian_name); ?></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Gender</td>
                                                                <td><?php echo e(@$patient_details->gender); ?></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Age</td>
                                                                <td><?php echo e(@$patient_details->year); ?>y <?php echo e(@$patient_details->month); ?>m <?php echo e(@$patient_details->day); ?>d</td>
                                                              </tr>
                                                              <tr>
                                                                <td>Phone No</td>
                                                                <td><?php echo e(@$patient_details->phone); ?></td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                    </div>
                                                    
                                                    <form method="POST" action="<?php echo e(route('appointment-booking.verify-otp')); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="patient_id" value="<?php echo e($patient_details->id); ?>" />
                                                        <div class="material-textfield material-textfield1">
                                                            <i class="fas fa-pen materialfldi_icondesign"></i>
                                                            <input type="text" name="otp" >
                                                            <label>Enter your OTP</label>
                                                        </div>
                                                        <button class="baabtn_design"><i class="fas fa-paper-plane fle_icndesign"></i> Submit</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<!-- ====================================book appointments============================ -->
<!-- ====================================form area==================================== -->

<!-- ====================================form area==================================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    setTimeout(function(){
      document.getElementById('message').style.display = 'none';
    }, 4000);
    </script>
</body>
</html>

<?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/appointment-frontend/patient-details.blade.php ENDPATH**/ ?>