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

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <style type="text/css">
        body {
            overflow-x: hidden;
        }
        aside {
            background-color: #1F262D;
            height: calc(100vh - 72px);
            font-size: 18px;
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
                               <?php echo auth()->guard('admin')->user()->name ?> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    {{ __('Logout') }}
                                </a>
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
                    <aside>
                        <ul class="nav flex-column py-4">
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::route()->getName() == 'dashboard') ? 'active' : '' }}" href="#">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Departments</a>
                                <i class="fas fa-angle-down"></i>
                                <ul class="children">
                                    <li class="nav-item">
                                        <a href="" class="nav-link">Add new</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">All departments</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Users</a>
                                <i class="fas fa-angle-down"></i>
                                <ul class="children">
                                    <li class="nav-item">
                                        <a href="" class="nav-link">Add new</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">All users</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </aside>
                </div>

                {{-- Content --}}
                <div class="col-md-10 py-4 pl-0">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
