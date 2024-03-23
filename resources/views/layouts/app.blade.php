<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="robots" content="noindex, nofollow">
    <meta name="description"
        content="Logicielle de gestion des écoles, UTA (Université des Technologies d'Abidjan - Côte d'Ivoire) - SCHOOL - GENIUS est une solution de gestion des écoles, universités, centres de formation professionnelle, etc.">
    <meta name="author" content="UTA - SCHOOL - GENIUS">

    <meta property="og:title" content="UTA - SCHOOL - GENIUS">
    <meta property="og:description" content="UTA - SCHOOL - GENIUS">
    <meta property="og:image" content="https://uta-school.eveecorp.link/assets/img/favicon.png">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="UTA - SCHOOL - GENIUS">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:locale:alternate" content="{{ str_replace('_', '-', app()->getLocale()) }}"> <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <title>@yield('title', 'UTA SCHOOL')</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="{{ asset('lib/sweealert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/simple-datatables/style.css') }}">
    <script src="{{ asset('lib/simple-datatables/simple-datatables.js') }}"></script>
    @stack('styles')
    @if (request()->routeIs('etudiant.*'))
        <link rel="stylesheet" href="{{ asset('lib/prismjs/themes/prism.min.css') }}">
    @endif

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

    <style>
        input[type="checkbox"].js-switch {
            cursor: pointer;

        }
    </style>
</head>

<body>

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
    <div class="main  main-app p-3 p-lg-4">
        <!-- notification -->
        <div id="notification"></div>
        <!-- end notification -->

        @yield('content')
        {{-- footer --}}
        <x-shared.footer />
        {{-- end footer --}}
    </div>
    {{-- end content --}}

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lib/jquery-validation/localization/messages_fr.min.js') }}"></script>
    @if (request()->routeIs('etudiant.*'))
        <script src="{{ asset('lib/prismjs/prism.js') }}"></script>
        <script src="{{ asset('lib/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{ asset('lib/jquery-steps/build/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('lib/jqueryui/jquery-ui.min.js') }}"></script>
    @endif

    <script src="{{ asset('lib/sweealert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('assets/js/script.js') }}"></script>
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
   
    {{-- <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
    <script src="{{ asset('assets/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var i = 0;
        window.Echo.channel('user-channel')
            .listen('.UserEvent', (data) => {
                i++;
                $("#notification").append('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    '<strong>' + data.title + '</strong>' + '<p>' + data.message + '</p>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');
            });
    </script> --}}

</body>

</html>

