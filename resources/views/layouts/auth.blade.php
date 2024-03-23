<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>@yield('title', 'UTA SCHOOL')</title>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset("lib/remixicon/fonts/remixicon.css") }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
  </head>
  <body class="page-sign">
      <!-- notification -->
      <div id="notification"></div>
      <!-- end notification -->
    @yield('content')
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset("lib/jquery-validation/jquery.validate.min.js") }}"></script>
    <script src="{{ asset("lib/jquery-validation/localization/messages_fr.min.js") }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
    <script>
      'use script'

      var skinMode = localStorage.getItem('skin-mode');
      if(skinMode) {
        $('html').attr('data-skin', 'dark');
      }
    </script>
     {{-- <script>
      window.laravel_echo_port = '{{ env('LARAVEL_ECHO_SERVER_PORT') }}';
  </script>
  <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script> --}}
  </body>
</html>
