<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css">

    <style>
        .result-set { margin-top: 1em }
        @media (min-width: 768px) {
            .container {
                width: 503px;
            }
        }
        @media (min-width: 992px) {
            .container {
                width: 723px;
            }
        }
        @media (min-width: 1200px) {
            .container {
                width: 923px;
            }
        }
        @media (min-width: 1432px) {
            .container {
                width: 1170px;
            }
        }
        body {
            padding-top: 70px;
        }
        @media (min-width: 768px) {
            body {
                padding-top: 0;
            }
        }
        .navbar-fixed-right,
        .navbar-fixed-left {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
        }
        @media (min-width: 768px) {
            .navbar-fixed-right,
            .navbar-fixed-left {
                width: 232px;
                height: 100vh;
                border-radius: 0;
            }
            .navbar-fixed-right .container,
            .navbar-fixed-left .container,
            .navbar-fixed-right .container-fluid,
            .navbar-fixed-left .container-fluid {
                padding-right: 0;
                padding-left: 0;
                width: auto;
            }
            .navbar-fixed-right .navbar-header,
            .navbar-fixed-left .navbar-header {
                float: none;
                padding-left: 15px;
                padding-right: 15px;
            }
            .navbar-fixed-right .navbar-collapse,
            .navbar-fixed-left .navbar-collapse {
                padding-right: 0;
                padding-left: 0;
                max-height: none;
            }
            .navbar-fixed-right .navbar-collapse .navbar-nav,
            .navbar-fixed-left .navbar-collapse .navbar-nav {
                float: none !important;
            }
            .navbar-fixed-right .navbar-collapse .navbar-nav > li,
            .navbar-fixed-left .navbar-collapse .navbar-nav > li {
                width: 100%;
            }
            .navbar-fixed-right .navbar-collapse .navbar-nav > li.dropdown .dropdown-menu,
            .navbar-fixed-left .navbar-collapse .navbar-nav > li.dropdown .dropdown-menu {
                top: 0;
            }
            .navbar-fixed-right .navbar-collapse .navbar-nav.navbar-right,
            .navbar-fixed-left .navbar-collapse .navbar-nav.navbar-right {
                margin-right: 0;
            }
        }
        @media (min-width: 768px) {
            body {
                margin-left: 232px;
            }
        }
        @media (min-width: 768px) {
            .navbar-fixed-left {
                right: auto !important;
                left: 0 !important;
                border-width: 0 1px 0 0 !important;
            }
            .navbar-fixed-left .dropdown .dropdown-menu {
                left: 100%;
                right: auto;
                border-radius: 0 3px 3px 0;
            }
            .navbar-fixed-left .dropdown .dropdown-toggle .caret {
                border-top: 4px solid transparent;
                border-left: 4px solid;
                border-bottom: 4px solid transparent;
                border-right: none;
            }
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-fixed-left">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                            @can('view_users')
                                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                                    <a href="{{ route('users.index') }}">
                                        <span class="text-info glyphicon glyphicon-user"></span> Users
                                    </a>
                                </li>
                            @endcan

                            @can('view_posts')
                                <li class="{{ Request::is('posts*') ? 'active' : '' }}">
                                    <a href="{{ route('posts.index') }}">
                                        <span class="text-success glyphicon glyphicon-text-background"></span> Posts
                                    </a>
                                </li>
                            @endcan
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else

                            @can('view_roles')
                            <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                                <a href="{{ route('roles.index') }}">
                                    <span class="text-danger glyphicon glyphicon-lock"></span> Roles
                                </a>
                            </li>
                            @endcan

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <span class="label label-success">{{ Auth::user()->roles->pluck('name')->first() }}</span>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-log-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div id="flash-msg">
                @include('flash::message')
            </div>
            @yield('content')
        </div>
    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    <script>
        $(function () {
            // flash auto hide
            $('#flash-msg .alert').not('.alert-danger, .alert-important').delay(6000).slideUp(500);
        })
    </script>
</body>
</html>
