<!doctype html>
<html lang="en">

<head>
  @include('backend.layouts.head')
</head>

<body class="theme-blue">

  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="m-t-30"><img src="{{ asset('backend/assets/images/logo.svg') }}" width="48" height="48"
          alt="Lucid"></div>
      <p>Please wait...</p>
    </div>
  </div>
  <!-- Overlay For Sidebars -->

  <div id="wrapper">

    <!-- navbar -->
    @include('backend.layouts.nav')

    <!-- side bar -->
    @include('backend.layouts.sidebar')

    @yield('main-content')

  </div>

  <!-- footer -->
  @include('backend.layouts.footer')
</body>

</html>
