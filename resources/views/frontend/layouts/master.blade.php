<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Title  -->
  <title>@yield('title', 'Multi vendor E-commerce website')</title>

  @include('frontend.layouts.header')

</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!-- Header Area -->
  <header class="header_area" id="header_area">
    @include('frontend.layouts.main-menu')
  </header>
  <!-- Header Area End -->

  @yield('contents')

  @include('frontend.layouts.footer')

  <!-- jQuery (Necessary for All JavaScript Plugins) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
    integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/classy-nav.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/scrollup.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jarallax.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jarallax-video.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/active.js') }}"></script>
  @include('frontend.layouts.partials.master-script')
  @yield('scripts')

</body>

</html>
