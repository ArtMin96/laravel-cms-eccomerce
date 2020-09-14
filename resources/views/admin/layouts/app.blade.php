<?php
use Illuminate\Support\Facades\Auth;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('admin/js/feather.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/scripts.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('admin/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet">

    @stack('style')
</head>
<body class="nav-fixed">
    <div id="app">

        @if(Auth::check())
            <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">{{ config('app.name', 'Gaudeamus') }}</a>
                <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>

                <ul class="navbar-nav align-items-center ml-auto">
                    <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <!-- <img class="img-fluid" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"/> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                            <h6 class="dropdown-header d-flex align-items-center">
                                <!-- <img class="dropdown-user-img" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" /> -->
                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-details-name">{{ Auth::user()->name }}</div>
                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                                </div>
                            </h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!">
                                <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                                Account
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                {{ __('Logout') }}

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        @endif

        <div id="layoutSidenav">

            @if(Auth::check())
                <div id="layoutSidenav_nav">
                    <nav class="sidenav shadow-right sidenav-light">
                        <div class="sidenav-menu">
                            <div class="nav accordion" id="accordionSidenav">
                                <div class="sidenav-menu-heading"></div>
                                <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                    {{ __('Dashboard') }}
                                </a>

                                <div class="sidenav-menu-heading">{{ __('Shop') }}</div>

                                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                                    <div class="nav-link-icon"><i data-feather="box"></i></div>
                                    {{ __('Products') }}
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseProducts" data-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav">
                                        <a class="nav-link" href="multi-tenant-select.html">{{ __('Rent Equipment') }}</a>
                                        <a class="nav-link" href="wizard.html">{{ __('Sell Documents') }}</a>
                                        <a class="nav-link" href="wizard.html">{{ __('?') }}</a>
                                    </nav>
                                </div>

                                <a class="nav-link" href="{{ url('/admin/orders') }}">
                                    <div class="nav-link-icon"><i data-feather="clipboard"></i></div>
                                    {{ __('Orders') }}
                                </a>
                                <a class="nav-link" href="{{ url('/admin/customers') }}">
                                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                                    {{ __('Customers') }}
                                </a>

                                <div class="sidenav-menu-heading">{{ __('CMS') }}</div>
                                <a class="nav-link" href="{{ url('/admin/page') }}">
                                    <div class="nav-link-icon"><i data-feather="grid"></i></div>
                                    {{ __('Pages') }}
                                </a>
                                <a class="nav-link" href="{{ url('/admin/blog') }}">
                                    <div class="nav-link-icon"><i data-feather="book"></i></div>
                                    {{ __('Blog') }}
                                </a>

                                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseAboutUs" aria-expanded="false" aria-controls="collapseAboutUs">
                                    <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                                    {{ __('Company') }}
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseAboutUs" data-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav">
                                        <a class="nav-link" href="multi-tenant-select.html">{{ __('About Us') }}</a>
                                        <a class="nav-link" href="wizard.html">{{ __('Credentials') }}</a>
                                        <a class="nav-link" href="wizard.html">{{ __('Customers') }}</a>
                                    </nav>
                                </div>

                                <a class="nav-link" href="{{ url('/admin/jobs') }}">
                                    <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                                    {{ __('Jobs') }}
                                </a>
                                <a class="nav-link" href="{{ url('/admin/faqs') }}">
                                    <div class="nav-link-icon"><i data-feather="help-circle"></i></div>
                                    {{ __('FAQs') }}
                                </a>

                                <a class="nav-link" href="{{ url('/admin/settings') }}">
                                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                                    {{ __('Settings') }}
                                </a>
                            </div>
                        </div>
                        <div class="sidenav-footer">
                            <div class="sidenav-footer-content">
                                <div class="sidenav-footer-subtitle">{{ __('Logged in as') }}:</div>
                                <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
                            </div>
                        </div>
                    </nav>
                </div>
            @endif

            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @stack('script')
</body>
</html>
