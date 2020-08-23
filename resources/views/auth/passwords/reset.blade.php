<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <title>Reset Password - Foodism</title>
     
      <link rel="icon" type="image/x-icon" href="{{ URL::asset('public/images/favicon_icon.png') }}">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
      <!-- BEGIN: Vendor CSS-->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/vendors/css/vendors.min.css') }}">
      <!-- END: Vendor CSS-->
      <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/images/favicon_icon.png') }}">
      <!-- BEGIN: Theme CSS-->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/bootstrap.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/bootstrap-extended.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/colors.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/components.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/themes/dark-layout.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/themes/semi-dark-layout.css') }}">
      <!-- BEGIN: Page CSS-->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/core/colors/palette-gradient.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/pages/authentication.css') }}">
      <!-- END: Page CSS-->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/developer.css') }}">
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-5 col-10 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0 w-100">
                            <div class="row m-0">
                                <div class="col-lg-3 d-lg-block d-none text-center align-self-center p-0">
                                   <img src="{{ URL::asset('public/images/logo.png') }}" alt="branding logo"  style="height: 330px; width: auto;">
                                </div>
                                <div class="col-lg-9 col-12 p-0">
                                    <div class="card rounded-0 mb-0 ">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0 text-black">Reset Password</h4>
                                            </div>
                                        </div>
                                        <p class="px-2 text-black">Please enter your new password.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form method="POST" action="{{ route('password.update') }}">
                                                    @csrf

                                                    <input type="hidden" name="token" value="{{ $token }}">
                                                    <fieldset class="form-label-group">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus >
                                                        <label for="user-email" class="text-black">Email</label>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>

                                                    <fieldset class="form-label-group">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="user-password" name="password" placeholder="Password" required autocomplete="new-password">
                                                        <label for="user-password">Password</label>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>

                                                    <fieldset class="form-label-group">
                                                        <input type="password" class="form-control" id="user-confirm-password" placeholder="Confirm Password"  name="password_confirmation" required autocomplete="new-password" required >
                                                        <label for="user-confirm-password">Confirm Password</label>
                                                    </fieldset>
                                                    <div class="row pt-2">
                                                        <div class="col-12 col-md-6 mb-1">
                                                            <a href="{{ url('login') }}" class="btn btn-outline-primary btn-block px-0"> <i class="fa fa-angle-double-left" ></i> Login</a>
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-1">
                                                            <button type="submit" class="btn btn-primary btn-block px-0">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- END: Content-->
      <!-- BEGIN: Vendor JS-->
      <script src="{{ URL::asset('public/app-assets/vendors/js/vendors.min.js') }}"></script>
      <!-- BEGIN Vendor JS-->
      <!-- BEGIN: Page Vendor JS-->
      <script src="{{ URL::asset('public/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
      <!-- END: Page Vendor JS-->
      <!-- BEGIN: Theme JS-->
      <script src="{{ URL::asset('public/app-assets/js/core/app-menu.js') }}"></script>
      <script src="{{ URL::asset('public/app-assets/js/core/app.js') }}"></script>
      <script src="{{ URL::asset('public/app-assets/js/scripts/components.js') }}"></script>
      <!-- END: Theme JS-->
      <!-- BEGIN: Page JS-->
      <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>

