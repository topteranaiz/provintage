<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Elen - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="/template/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/template/css/animate.css">
    
    <link rel="stylesheet" href="/template/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/template/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/template/css/magnific-popup.css">

    <link rel="stylesheet" href="/template/css/aos.css">

    <link rel="stylesheet" href="/template/css/ionicons.min.css">

    <link rel="stylesheet" href="/template/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/template/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="/template/css/flaticon.css">
    <link rel="stylesheet" href="/template/css/icomoon.css">
    <link rel="stylesheet" href="/template/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
  @yield('css')

  </head>
  <body>

	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
        <!-- sidebar -->
        @include('template.partials.sidebar')

		<div id="colorlib-main">
        {{-- @include('template.pages.dashboard') --}}

        
        @yield('content')
		
        <!-- Footer -->
        {{-- @include('template.partials.footer') --}}

		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="/template/js/jquery.min.js"></script>
  <script src="/template/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/template/js/popper.min.js"></script>
  <script src="/template/js/bootstrap.min.js"></script>
  <script src="/template/js/jquery.easing.1.3.js"></script>
  <script src="/template/js/jquery.waypoints.min.js"></script>
  <script src="/template/js/jquery.stellar.min.js"></script>
  <script src="/template/js/owl.carousel.min.js"></script>
  <script src="/template/js/jquery.magnific-popup.min.js"></script>
  <script src="/template/js/aos.js"></script>
  <script src="/template/js/jquery.animateNumber.min.js"></script>
  <script src="/template/js/bootstrap-datepicker.js"></script>
  <script src="/template/js/jquery.timepicker.min.js"></script>
  <script src="/template/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="/template/js/google-map.js"></script>
  <script src="/template/js/main.js"></script>
  @yield('js')
    
  </body>
</html>