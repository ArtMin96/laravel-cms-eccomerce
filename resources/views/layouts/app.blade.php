<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(Session::has('download.in.the.next.request'))
        <meta http-equiv="refresh" content="1;url={{ Session::get('download.in.the.next.request') }}">
    @endif

    @yield('seo')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">

    @stack('style')

    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">

    @livewireStyles

</head>
<body>
    <div id="app">

        <x-menu logo="{{ settings()->logo }}" title="{{ settings()->title }}" />

        <main>
            @yield('content')
        </main>

        <footer class="g-footer">
            <a href="#home" class="go-top-btn"><i class="fas fa-chevron-circle-up"></i></a>
            <div class="g-footer-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <h3 class="font-size-1 mb-3">{{ settings()->footer_title }}</h3>
                            <p>{{ settings()->footer_description }}</p>
                        </div>
                        <div class="col-lg-4">
                            <h3 class="font-size-1">{{ __('pages.Get in touch') }}</h3>
                            <ul class="g-footer-list g-footer-list-1">
                                <li class="g-footer-list-item g-footer-list-location">
                                    <a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-footer-list-link">{{ settings()->address }}</a>
                                </li>
                                <li class="g-footer-list-item g-footer-list-mail"><a href="mailto:{{ settings()->email }}" class="g-footer-list-link">{{ settings()->email }}</a></li>
                                <li class="g-footer-list-item g-footer-list-phone">
                                    <span class="g-footer-list-phones">
                                        @foreach(settings()->phoneNumbers as $numbers)
                                            <a href="tel:{{ str_replace(' ', '', $numbers->phone_number) }}" class="g-footer-list-link">{{ $numbers->phone_number }}</a>
                                        @endforeach
                                    </span>
                                </li>
                                <li class="g-footer-list-item g-footer-list-whatsapp">
                                    <a href="https://www.whatsapp.com/" target="_blank" class="g-footer-list-link">{{ settings()->whatsapp }}</a>
                                </li>
                                <li class="g-footer-list-item g-footer-list-viber">
                                    <a href="https://www.viber.com/ru/" target="_blank" class="g-footer-list-link">{{ settings()->viber }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-5">
                            <h3 class="font-size-1">{{ __('pages.Services') }}</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="g-footer-list g-footer-list-2">
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/legal.html">Legal Translation Services</a></li>
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/medical.html">Medical Translations</a></li>
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/finance.html">Finance</a></li>
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/technical.html">Technical & Scientific</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="g-footer-list g-footer-list-2">
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/it.html">IT Translations</a></li>
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/business.html">Business Translation</a></li>
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/marketing.html">Marketing Translation</a></li>
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/website.html">Website Translation</a></li>
                                        <li class="g-footer-list-item"><a class="g-footer-list-link" href="../services/document.html">Document translation</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

{{--        @include('partials.Register')--}}
{{--        <a class="nav-link"--}}
{{--           style="cursor: pointer"--}}
{{--           data-toggle="modal"--}}
{{--           data-target="#registerModal">{{ __('Register') }}</a>--}}

    </div>
</body>

@livewireScripts

<script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>

@stack('script')

<script src="{{ asset('js/rating.js') }}" defer></script>
<script src="{{ asset('js/index.js') }}" defer></script>
<script src="{{ asset('js/requests.js') }}" defer></script>

</html>
