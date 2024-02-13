<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="">
        <meta name="description" content="Edumin - Bootstrap Admin Dashboard">
        <meta property="og:title" content="Edumin - Bootstrap Admin Dashboard">
        <meta property="og:description" content="Edumin - Bootstrap Admin Dashboard">
        <meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">
        <meta name="format-detection" content="telephone=no">
        
        {{-- <link rel="icon" href="{{ asset('/admin/images/favicon.ico') }}" type="image/x-icon"> --}}
        {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/admin/images/favicon.png') }}"> --}}
        
        <title>Manoj Academy - Learning App</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
        <link href="{{ asset('/admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('/admin/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/admin/css/skin.css') }}">
    
    
 </head>
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
        </div>
        </div>
        

    <div id="main-wrapper">
   
        
     @include('admin.inc.header')

     
     <div class="content-body">

     @yield('content')

     </div>

     {{-- footer --}}
    <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="javascript:void(0)" target="_blank">TechieZz</a> 2022</p>
            </div>
        </div>
  

     

    </div>
    <!--/wrapper-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{-- <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}


    <script src="{{ asset('/admin/vendor/global/global.min.js') }}" defer></script>
    <script src="{{ asset('/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('/admin/js/custom.min.js') }}" defer></script>
    
    <script src="{{ asset('/admin/vendor/raphael/raphael.min.js') }}" defer></script>
    <script src="{{ asset('/admin/vendor/morris/morris.min.js') }}" defer></script>
    <script src="{{ asset('/admin/vendor/datatables/js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('/admin/js/plugins-init/datatables.init.js') }}" defer></script>
    <script src="{{ asset('/admin/vendor/peity/jquery.peity.min.js') }}" defer></script>
    
    <script src="{{ asset('/admin/js/dashboard/dashboard-2.js') }}" defer></script>
    
    <script src="{{ asset('/admin/vendor/svganimation/vivus.min.js') }}" defer></script>
    <script src="{{ asset('/admin/vendor/svganimation/svg.animation.js') }}" defer></script>
    {{-- <script src="{{ asset('/admin/js/styleSwitcher.js') }}"></script> --}}
   

</body>

</html>