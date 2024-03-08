<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <title>@yield('title', 'UTA SCHOOL')</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="{{ asset('lib/sweealert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fullcalendar/main.min.css') }}">

    @stack('styles')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
</head>

<body class="app-calendar">

    {{-- sidebar --}}
    @if (auth()->user()->isEtudiant())
        <x-shared.student-sidebar />
    @elseif (auth()->user()->isProfesseur())
        <x-shared.profs-sidebar />
    @elseif (auth()->user()->isConsellor())
        <x-shared.consellor-sidebar />
    @elseif (auth()->user()->isComptable())
        <x-shared.comptable-sidebar />
    @elseif (auth()->user()->isParent())
        <x-shared.parent-sidebar />
    @else
        <x-shared.sidebar />
    @endif
    {{-- end sidebar --}}

    {{-- header --}}
    <x-shared.header />
    {{-- end header --}}

    {{-- content --}}
    <div class="main  main-calendar">
        @yield('content')
        {{-- footer --}}
        {{-- end footer --}}
    </div>
    {{-- end content --}}

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/sweealert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('lib/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/lib/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/locales-all.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/locales/fr.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @stack('scripts')
    <script>
        'use script'

        $('#dropdownDemo .dropdown-item').on('click', function(e) {
            e.preventDefault();

            $(this).addClass('active').siblings().removeClass('active');

            var demo = $(this).text();
            $(this).closest('.dropdown').find('.dropdown-link span').text(demo);

            var loc = $(this).attr('data-location');

            $('#viewDemo').attr('href', loc);

        });
    </script>
</body>

</html>
