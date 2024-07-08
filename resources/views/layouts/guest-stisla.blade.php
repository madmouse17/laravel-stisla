<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $site->title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/' . $site->logo) }}" />


    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css"> --}}
    <link rel="stylesheet" href="{{ asset('/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    </link>
    <link rel="stylesheet" href="{{ asset('/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    </link>
    <link rel="stylesheet" href="{{ asset('/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    </link>
    <!--DataTables-->
    {{-- <script src="{{ asset('/assets/modules/datatables/datatables.min.css') }}"></script> --}}
    <link rel="stylesheet"
        href="{{ asset('/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    </link>
    <link rel="stylesheet" href="{{ asset('/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    </link>

    <link rel="stylesheet" href="{{ asset('/assets/modules/summernote/summernote-bs4.css') }}">
    </link>
    <link rel="stylesheet" href="{{ asset('/assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">
    {{-- <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet"> --}}
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/dropify.css') }}">
    {{-- calendar --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <style>
        .left-col {
            float: left;
            margin-top: 1%;

            width: 50%;
        }

        .right-col {
            float: left;
            margin-top: 1%;

            width: 50%;
        }

        @media only screen and (max-width: 600px) {
            .left-col {
                float: left;
                margin-top: 1%;

                width: 100%;
            }

            .right-col {
                float: left;
                margin-top: 1%;

                width: 100%;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts.templates.partials.navbar')
            <div class="main-sidebar">
                @include('layouts.templates.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('section')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }}
                    {{-- <div class="bullet"></div> Design By <a
                        href="https://nauval.in/">Muhamad Nauval Azhar</a> --}}
                </div>
                <div class="footer-right">
                    {{ $site->title }}
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="{{ asset('/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="{{ asset('/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <script src="{{ asset('/assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('/assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/moment.min.js') }}"></script>

    <script src="{{ asset('/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/upload-preview/jquery.uploadPreview.min.js') }}"></script>
    {{-- alert --}}
    <script src="{{ asset('/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('/assets/modules/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('/assets/js/custom.js') }}"></script>
    <script src="{{ asset('/assets/js/dropify.js') }}"></script>
    {{-- datatabless --}}
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}vendor/datatables/buttons.server-side.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.1.0/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
    {{-- <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}

    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>

    <!-- Page Specific JS File -->

    <script src="{{ asset('/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/js/page/index-0.js') }}"></script>
    <script src="{{ asset('/assets/js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('/assets/js/page/forms-advanced-forms.js') }}"></script>
    <script src="{{ asset('/assets/js/page/modules-toastr.js') }}"></script>

    {{-- calendar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
    @stack('scripts')
    <!-- Page Specific JS File -->
</body>

</html>
