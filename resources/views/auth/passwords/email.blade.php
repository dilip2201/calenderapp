<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Forgot Password - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

     <!-- BEGIN: Vendor CSS-->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/vendors/css/vendors.min.css') }}">
      <!-- END: Vendor CSS-->

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
                    <div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center">
                                    <img src="{{ URL::asset('public/app-assets/images/pages/login.png') }}" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2 py-1">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Recover your password</h4>
                                            </div>
                                        </div>
                                        <p class="px-2 mb-0">Please enter your email address and we'll send you instructions on how to reset your password.</p>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('password.email') }}">
                                                    @csrf
                                                    <div class="form-label-group">
                                                        <input type="email"  name="email"  id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                                        <label for="inputEmail">Email</label>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                
                                                    <div class="float-md-left d-block mb-1">
                                                        <a href="{{ url('login') }}" class="btn btn-outline-primary btn-block px-75">Back to Login</a>
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
