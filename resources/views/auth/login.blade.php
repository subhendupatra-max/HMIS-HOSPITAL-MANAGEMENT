<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="{{ asset('public/assets/css/dits.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- =============================login code here========================== -->
    <div class="login_outerarea">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 ">

                    {{-- background image --}}

                    <video autoplay muted loop>
                        <source src="{{ asset('public/assets/images/medical.mp4') }}" type="video/mp4">
                    </video>

                    <div class="overlay_backdesign">
                        <div class="wrap-login100">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <span class="login100-form-logo">
                                    <img src="{{ asset('public/hospital_content/hospital_logo.png') }}" class="logoame">
                                </span>
                                <div class="material-textfield">
                                    <input placeholder=" " type="email"name="email" :value="old('email')" required
                                        autofocus>
                                    <label>Enter Your Email</label>
                                    <i class="fas fa-envelope icondesign"></i>


                                </div>
                                <div class="material-textfield">
                                    <input placeholder=" " type="password" name="password" required
                                        autocomplete="current-password" id="id_password">
                                    <label>Enter Your Password</label>
                                    <i class="fas fa-unlock-alt icondesign"></i>
                                    <i class="fas fa-eye icondesign1" id="togglePassword"></i>

                                </div>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <div class="rmbrpswrd_area">
                                    <div class="leftrem_section">
                                        <input class="input-checkbox100" id="remember_me" type="checkbox"
                                            name="remember">
                                        <label class="label-checkbox100 remlbltext" for="remember_me">
                                            Remember me
                                        </label>
                                    </div>
                                    <div class="rightrem_section">
                                        <label class="remlbltext1" for="">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
                                        </label>
                                    </div>
                                </div>


                                <div class="lgnbtn_outerarea">
                                    <button class="another_btndesign">
                                        {{ __('LOG IN') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- </div> -->

        <!-- =============================login code here========================== -->
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#id_password');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
        </script>
</body>

</html>
