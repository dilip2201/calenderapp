@include('admin.includes.head')
<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu 2-columns  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
@include('admin.includes.header')

    <!-- END: Header-->

 
<!-- Horizontal menu content-->
@include('admin.includes.sidebar')

        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
             @yield('content')

        </div>
    </div>
    <!-- END: Content-->
    <!-- BEGIN: Footer-->
@include('admin.includes.footer')
    <!-- END: Footer-->
@include('admin.includes.script')
</body>
<!-- END: Body-->
</html>

@yield('test')