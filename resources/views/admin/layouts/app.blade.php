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

    @livewireStyles

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
                                {{ __('admin.Account') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                {{ __('admin.Logout') }}

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
                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/dashboard') }}">
                                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                    {{ __('admin.Dashboard') }}
                                </a>

                                <div class="sidenav-menu-heading">{{ __('Shop') }}</div>

                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/catalog') }}">
                                    <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                    {{ __('admin.Catalog') }}
                                </a>

                                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                                    <div class="nav-link-icon"><i data-feather="box"></i></div>
                                    {{ __('admin.Products') }}
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseProducts" data-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav">
                                        @if(!empty(saleType()))
                                            @foreach(saleType() as $saleType)
                                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/product/'. $saleType->id) }}">{{ $saleType->name }}</a>
                                            @endforeach
                                        @endif
                                    </nav>
                                </div>

                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/orders') }}">
                                    <div class="nav-link-icon"><i data-feather="clipboard"></i></div>
                                    {{ __('admin.Orders') }}
                                </a>
                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/users') }}">
                                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                                    {{ __('admin.Customers') }}
                                </a>

                                <div class="sidenav-menu-heading">{{ __('CMS') }}</div>
                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/page') }}">
                                    <div class="nav-link-icon"><i data-feather="grid"></i></div>
                                    {{ __('admin.Pages') }}
                                </a>
                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/blog') }}">
                                    <div class="nav-link-icon"><i data-feather="book"></i></div>
                                    {{ __('admin.Blog') }}
                                </a>

                                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseAboutUs" aria-expanded="false" aria-controls="collapseAboutUs">
                                    <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                                    {{ __('admin.Company') }}
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseAboutUs" data-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav">
                                        <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/our-team') }}">{{ __('admin.Our Team') }}</a>
                                        <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/credentials') }}">{{ __('admin.Credentials') }}</a>
                                        <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/customers') }}">{{ __('admin.Customers') }}</a>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDynamicBlocks" aria-expanded="false" aria-controls="collapseDynamicBlocks">
                                    <div class="nav-link-icon"><i data-feather="box"></i></div>
                                    {{ __('admin.Dynamic blocks') }}
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>

                                <div class="collapse" id="collapseDynamicBlocks" data-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav">
                                        <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/jobs') }}">
                                            <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                                            {{ __('admin.Jobs') }}
                                        </a>
                                        <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/faqs') }}">
                                            <div class="nav-link-icon"><i data-feather="help-circle"></i></div>
                                            {{ __('admin.FAQs') }}
                                        </a>
                                        <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/translation-services') }}">
                                            <div class="nav-link-icon"><i data-feather="columns"></i></div>
                                            {{ __('admin.Translation Services') }}
                                        </a>
                                        <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/company-logos') }}">
                                            <div class="nav-link-icon"><i data-feather="layers"></i></div>
                                            {{ __('admin.Company logos') }}
                                        </a>
                                    </nav>
                                </div>

                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/ratings') }}">
                                    <div class="nav-link-icon"><i data-feather="star"></i></div>
                                    {{ __('admin.Ratings') }}
                                </a>

                                <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/admin/settings') }}">
                                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                                    {{ __('admin.Settings') }}
                                </a>
                            </div>
                        </div>
                        <div class="sidenav-footer">
                            <div class="sidenav-footer-content">
                                <div class="sidenav-footer-subtitle">{{ __('admin.Logged in as:') }}</div>
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

        <livewire:toast />

    </div>

    @livewireScripts

    @stack('script')
</body>
</html>
