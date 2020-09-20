<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
</head>
<body>
    <div id="app">
        <header id="home" class="g-navbar">
            <div class="g-top-navbar">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name', 'Gaudeamus') }}">
                </a>
                <div class="g-navbar-buttons">
                    <a href="../forms.html" class="g-btn g-btn-green-ol">TRANSLATE NOW</a>

                    <!-- Authentication Links -->
                    @guest
                        <div class="dropdown">
                            <button class="g-btn g-link-2" type="button" id="dropdownUserButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="far fa-user-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right g-navbar-buttons-drop" aria-labelledby="dropdownUsergButton">
                                <li><a class="dropdown-item" href="{{ route('login') }}" data-lang="en"><i class="fas fa-sign-in-alt"></i>{{ __('Login') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}" data-lang="en"><i class="fas fa-user-plus"></i>{{ __('Sign up') }}</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="dropdown">
                            <button class="g-btn g-link-2" type="button" id="dropdownUserButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="far fa-user-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right g-navbar-buttons-drop" aria-labelledby="dropdownUsergButton">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-sign-in-alt"></i> {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-in-alt"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                    <!-- .end Authentication Links -->

                    <a href="../user/basket.html" class="g-btn g-link-2"><i class="fas fa-shopping-cart"></i></a>
                    <div class="dropdown">
                        <button class="g-btn" type="button" id="dropdownLangButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../../images/flag/eng.png" class="g-lang-flag g-lang-flag-show" alt="flag">
                        </button>
                        <ul class="dropdown-menu lang-dropdown-menu dropdown-menu-right g-navbar-buttons-drop" aria-labelledby="dropdownLangButton">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" data-lang="en" rel="alternate">
                                        <img src="../../images/flag/{{ $localeCode }}.png" class="g-lang-flag" alt="flag"> {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav justify-content-center flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link" href="../../index.html">Home</a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-item dropdown-toggle dropdown-item-active">Translation services</a>
                                    <ul class="dropdown-menu">
                                        <div class="d-flex">
                                            <ul class="p-0 list-unstyled">
                                                <li><a class="dropdown-item dropdown-item-active" href="./legal.html">Legal Translation Services</a></li>
                                                <li><a class="dropdown-item" href="./medical.html">Medical Translations</a></li>
                                                <li><a class="dropdown-item" href="./finance.html">Finance</a></li>
                                                <li><a class="dropdown-item" href="./immigration.html">Immigration Services</a></li>
                                                <li><a class="dropdown-item" href="./technical.html">Technical & Scientific</a></li>
                                            </ul>
                                            <ul class="p-0 list-unstyled">
                                                <li><a class="dropdown-item" href="./it.html">IT Translations</a></li>
                                                <li><a class="dropdown-item" href="./business.html">Business Translation</a></li>
                                                <li><a class="dropdown-item" href="./marketing.html">Marketing Translation</a></li>
                                                <li><a class="dropdown-item" href="./website.html">Website Translation</a></li>
                                                <li><a class="dropdown-item" href="./document.html">Document translation</a></li>
                                            </ul>
                                        </div>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-item dropdown-toggle">Certified translation</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./certified.html">Certified translation</a></li>
                                        <li><a class="dropdown-item" href="./notarized.html">Notarized translations</a></li>
                                        <li><a class="dropdown-item" href="./apostille.html">Apostille</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-item dropdown-toggle">Transcription Services</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./video.html">Video Transcription Services</a></li>
                                        <li><a class="dropdown-item" href="./audio.html">Audio Transcription Services</a></li>
                                        <li><a class="dropdown-item" href="./interview.html">Interviews Transcription Services</a></li>
                                        <li><a class="dropdown-item" href="./other.html">Other Transcription</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-item dropdown-toggle">Interpreting Services</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./simultaneous.html">Simultaneous translation</a></li>
                                        <li><a class="dropdown-item" href="./consecutive.html">Consecutive translation</a></li>
                                        <li><a class="dropdown-item" href="./person.html">In-Person Interpreting Services</a></li>
                                        <li><a class="dropdown-item" href="./phone.html">Over The Phone</a></li>
                                        <li><a class="dropdown-item" href="./conference.html">Conference Interpreting</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-item dropdown-toggle">Localization</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./web.html">Websites</a></li>
                                        <li><a class="dropdown-item" href="./software.html">Software</a></li>
                                        <li><a class="dropdown-item" href="./app.html">App localization</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a href="./business_event.html" class="dropdown-item">Business Event Planing</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Industries
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../industries/legal.html">Legal</a></li>
                                <li><a class="dropdown-item" href="../industries/banking.html">Banking and Finance</a></li>
                                <li><a class="dropdown-item" href="../industries/medical.html">Medical</a></li>
                                <li><a class="dropdown-item" href="../industries/business.html">Business</a></li>
                                <li><a class="dropdown-item" href="../industries/tourism.html">Tourism</a></li>
                                <li><a class="dropdown-item" href="../industries/marketing.html">Marketing</a></li>
                                <li><a class="dropdown-item" href="../industries/technology.html">Technology</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Languages
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <div class="d-flex">
                                    <ul class="p-0 list-unstyled">
                                        <li><span class="dropdown-item">Armenian</span></li>
                                        <li><span class="dropdown-item">Arabic</span></li>
                                        <li><span class="dropdown-item">Bulgarian</span></li>
                                        <li><span class="dropdown-item">Chinese</span></li>
                                        <li><span class="dropdown-item">Czech</span></li>
                                        <li><span class="dropdown-item">English</span></li>
                                    </ul>
                                    <ul class="p-0 list-unstyled">
                                        <li><span class="dropdown-item">French</span></li>
                                        <li><span class="dropdown-item">Georgian</span></li>
                                        <li><span class="dropdown-item">German</span></li>
                                        <li><span class="dropdown-item">Greek</span></li>
                                        <li><span class="dropdown-item">Indian</span></li>
                                        <li><span class="dropdown-item">Italian</span></li>
                                    </ul>
                                    <ul class="p-0 list-unstyled">
                                        <li><span class="dropdown-item">Japanese</span></li>
                                        <li><span class="dropdown-item">Lithuanian</span></li>
                                        <li><span class="dropdown-item">Dutch</span></li>
                                        <li><span class="dropdown-item">Polish</span></li>
                                        <li><span class="dropdown-item">Portuguese</span></li>
                                        <li><span class="dropdown-item">Romanian</span></li>
                                    </ul>
                                    <ul class="p-0 list-unstyled">
                                        <li><span class="dropdown-item">Russian</span></li>
                                        <li><span class="dropdown-item">Korean</span></li>
                                        <li><span class="dropdown-item">Spanish</span></li>
                                        <li><span class="dropdown-item">Ukrainian</span></li>
                                    </ul>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Company
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../company/about.html">About Us</a></li>
                                <li><a class="dropdown-item" href="../company/credentials.html">Credentials</a></li>
                                <li><a class="dropdown-item" href="../company/customers.html">Customers</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../blog.html">Blog</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Contact us
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../contact/contacts.html">Get in touch</a>
                                <a class="dropdown-item" href="../contact/help.html">Help Us Improve</a>
                                <a class="dropdown-item" href="../contact/faqs.html">FAQs</a>
                                <a class="dropdown-item" href="../contact/job.html">Join Us</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../user/equipments.html">Rent equipment</a>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
</body>

<script src="{{ asset('js/jquery.js') }}" defer></script>
<script src="{{ asset('js/popper.min.js') }}" defer></script>
<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>
<script src="{{ asset('js/rating.js') }}" defer></script>
<script src="{{ asset('js/index.js') }}" defer></script>

</html>
