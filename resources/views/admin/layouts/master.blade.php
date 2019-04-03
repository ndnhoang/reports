<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="http://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{-- Data Table CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    {{-- Propeller icons --}}
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="http://propeller.in/components/icons/css/google-icons.css">

    {{-- Bootstrap datetimepicker --}}
    <link rel="stylesheet" type="text/css" href="http://propeller.in/components/datetimepicker/css/bootstrap-datetimepicker.css">

    {{-- Propeller datetimepicker --}}
    <link rel="stylesheet" type="text/css" href="http://propeller.in/components/datetimepicker/css/pmd-datetimepicker.css">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{--  Select 2  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
    {{-- Data Table JS --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- Datepicker moment with locales -->
    <script type="text/javascript" language="javascript" src="http://propeller.in/components/datetimepicker/js/moment-with-locales.js"></script>

    <!-- Propeller Bootstrap datetimepicker -->
    <script type="text/javascript" language="javascript" src="http://propeller.in/components/datetimepicker/js/bootstrap-datetimepicker.js"></script>

    {{-- SweetAlert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style type="text/css">
        body {
            overflow-x: hidden;
        }
        aside {
            background-color: #1F262D;
            font-size: 18px;
            position: absolute;
            left: 15px;
            right: 15px;
            height: 100%;
            top: 0;
            min-height: calc(100vh - 73px);
        }
        aside .nav-link {
            color: #fff;
            opacity: 0.7;
            transition: all 0.3s ease-out;
            padding: 1rem;
        }
        aside a:hover, aside a.active {
            color: #fff;
            opacity: 1;
            background: #1e2328;
        }
        aside .fas {
            position: absolute;
            top: 8px;
            right: 0;
            color: #fff;
            opacity: 0.7;
            line-height: 1.5;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease-out;
        }
        aside .fas:hover {
            opacity: 1;
            cursor: pointer;
        }
        aside li {
            position: relative;
        }
        aside .children {
            padding-left: 0;
            font-size: 17px;
            display: none;
        }
        aside .children a {
            padding: 0.5rem 1rem 0.5rem 1.5rem;
        }
        .select2.input-group {
            display: table;
        }
        .select2.input-group .select2-container {
            width: 100% !important;
        }
        .select2.input-group .select2-search__field {
            height: 36px !important;
        }
        .select2.input-group .input-group-append {
            display: table-cell;
            width: 140px;
            vertical-align: middle;
        }
    </style>

    <script type="text/javascript">
        $( document ).ready(function() {
            $('aside .fas').on('click', function() {
                var parent = $(this).parent();
                parent.find('.children').slideToggle(100);
            });
        });
    </script>

</head>
<body>
    <div id="app">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <h1>
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard('admin')->check()): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               <?php echo auth()->guard('admin')->user()->name ?? auth()->guard('admin')->user()->username ?> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                     <?php endif ?>
                </ul>
            </div>
        </nav>

        {{-- Main --}}
        <main>
            <div class="row">
                {{-- Left nav --}}
                <div class="col-md-2">
                    @include('admin.layouts.components.sidebar')
                </div>

                {{-- Content --}}
                <div id="content" class="col-md-10 py-4 pl-0 pr-4">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <script>
        // View mode datepicker [shows only years and month]
        $('.datepicker-view-mode').datetimepicker({
            viewMode: 'years',
            format: 'YYYY'
        });
        $('.datepicker-view-mode-month').datetimepicker({
            viewMode: 'years',
            format: 'MM/YYYY'
        });
    </script>
</body>
</html>
