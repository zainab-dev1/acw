<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- theme meta -->
    <meta name="theme-name" content="avc-office-events" />
    <title>Academic Creativity Week</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="icon" type="image/png" href="{{ asset('theme/images/acw-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('theme/images/acw-logo.png') }}">
    
    <!-- Styles -->
    <link href="{{asset('theme/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/lib/chartist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/lib/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/lib/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/lib/weather-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Unified Modern Design with DIN Next Arabic Font -->
    <link href="{{ asset('css/unified-design.css') }}?v={{ time() }}" rel="stylesheet">
    <style>
        :root {
            /* Logo sizing – can be tuned once and used everywhere */
            --acw-logo-max-width: 220px;
            --utas-logo-max-width: 320px;
            --header-logo-height: 62px; /* used on compact pages */
        }
        .acw-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }
        .acw-header .acw-logo {
            max-width: var(--acw-logo-max-width);
            width: 100%;
            height: auto;
        }
        .acw-header .utas-logo {
            max-width: var(--utas-logo-max-width);
            width: 100%;
            height: auto;
        }
        /* Compact variant (when page needs smaller header) */
        .acw-header.compact .acw-logo,
        .acw-header.compact .utas-logo {
            max-width: none;
            width: auto;
            height: var(--header-logo-height);
        }
        /* Avoid global overrides on Bootstrap's .container (it breaks layout on mobile).
           Keep mobile tweaks scoped to ACW components instead. */
    </style>
    @yield('css')
    @livewireStyles
</head>

<body>
    @include('sweetalert::alert')
    @yield('base')    

    <!-- jquery vendor -->
    <script src="{{asset('theme/js/lib/jquery.min.js')}}"></script>
    <script src="{{asset('theme/js/lib/jquery.nanoscroller.min.js')}}"></script>
    <!-- nano scroller -->
    <script src="{{asset('theme/js/lib/menubar/sidebar.js')}}"></script>
    <script src="{{asset('theme/js/lib/preloader/pace.min.js')}}"></script>
    <!-- sidebar -->

    <script src="{{asset('theme/js/lib/bootstrap.min.js')}}"></script>
    {{-- <script src="js/scripts.js"></script> --}}
    <!-- bootstrap -->

    <script src="{{asset('theme/js/lib/calendar-2/moment.latest.min.js')}}"></script>
    <script src="{{asset('theme/js/lib/calendar-2/pignose.calendar.min.js')}}"></script>
    <script src="{{asset('theme/js/lib/calendar-2/pignose.init.js')}}"></script>

    <!-- Unified Modern Script -->
    <script src="{{asset('js/unified-script.js')}}"></script>

    @yield('jscript')
    @livewireScripts
</body>

</html>
