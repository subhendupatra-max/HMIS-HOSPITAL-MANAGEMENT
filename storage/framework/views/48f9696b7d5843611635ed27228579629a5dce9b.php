
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('public/assets/css/dits.css')); ?>" rel="stylesheet" />
</head>
<body>
<!-- =============================login code here========================== -->
    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-12 login_outerarea">

                

                 <div class="overlay_backdesign">
                     <div class="wrap-login100">
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                                <span class="login100-form-logo">
                                  <img src="<?php echo e(asset('public/hospital_content/hospital_logo.png')); ?>" class="logoame">
                                </span>
                                <div class="material-textfield">
                                   <input placeholder=" " type="email"name="email" :value="old('email')" required autofocus>
                                   <label>Enter Your Email</label>
                                   <i class="fas fa-envelope icondesign"></i>
                                </div>
                                <div class="material-textfield">
                                   <input placeholder=" " type="password" name="password"
                                required autocomplete="current-password"  id="id_password">
                                   <label>Enter Your Password</label>
                                   <i class="fas fa-unlock-alt icondesign"></i>
                                   <i class="fas fa-eye icondesign1" id="togglePassword"></i>
                                </div>
                                <div class="rmbrpswrd_area">
                                     <div class="leftrem_section">
                                         <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                                         <label class="label-checkbox100 remlbltext" for="ckb1">
                                                Remember me
                                         </label>
                                     </div>
                                     <div class="rightrem_section">
                                         <label class="remlbltext1" for="">
                                                <?php if(Route::has('password.request')): ?>
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="<?php echo e(route('password.request')); ?>">
                        <?php echo e(__('Forgot your password?')); ?>

                    </a>
                <?php endif; ?>
                                         </label>
                                     </div>
                                </div>

                                <div class="lgnbtn_outerarea">
                                   <button class="another_btndesign" >
                                            <?php echo e(__('LOG IN')); ?>

                                    </button>
                                </div>
                          </form>
                     </div>
                 </div>
             </div>
        </div>
    </div>
<!-- =============================login code here========================== -->
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\DITS-HMIS\hospital_software\resources\views/auth/login.blade.php ENDPATH**/ ?>