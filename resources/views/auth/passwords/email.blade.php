<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title>Forgot Password - Foodism</title>
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
      <!-- BEGIN: Custom CSS-->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/developer.css') }}">
      <!-- END: Custom CSS-->
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
                    <div class="col-xl-4 col-md-9 col-10 d-flex justify-content-center px-0">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-3 d-lg-block d-none text-center align-self-center">
                                    <img src="{{ URL::asset('public/images/logo.png') }}" alt="branding logo"  style="height: 230px; width: auto;">
                                </div>
                                <div class="col-lg-9 col-12 p-0">
                                    <div class="card rounded-0 mb-0  py-1">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0  text-black">Recover your password</h4>
                                            </div>
                                        </div>
                                        <p class="px-2 mb-0  text-black">Please enter your email address and we'll send you instructions on how to reset your password.</p>
                                        <div class="card-content">
                                            <div class="card-body">
                                              @if (session('status'))
                                               <div class="alert alert-success" role="alert" style="max-width: 410px;
                                                  margin: 0 auto;
                                                  color: #000!important;
                                                  background: no-repeat;
                                                  border: 1px solid #000!important;
                                                  color: #000;
                                                  background: none!important;
                                                  margin-bottom: 10px;
                                                  font-size: 14px;
                                              ">
                                                  Password reset link send to your registered email address!
                                               </div>
                                               @endif
                                                <form method="POST" action="{{ route('password.email') }}">
                                                    @csrf
                                                    <div class="form-label-group">
                                                        <input type="email"  name="email"  id="inputEmail" class="form-control @error('email') is-invalid @enderror  text-black" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                                        <label for="inputEmail">Email</label>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                
                                                    <div class="float-md-left d-block mb-1">
                                                        <a href="{{ url('login') }}" class="btn btn-outline-primary btn-block px-75"><i class="fa fa-angle-double-left" ></i> Back to Login</a>
                                                    </div>
                                                
                                                    <div class="float-md-right d-block mb-1">
                                                        <button type="submit" class="btn btn-primary btn-block px-75" value="Recover Password">Recover Password</button>
                                                    </div>
                                                </form>
                                            </div>
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
