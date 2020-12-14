@extends('layouts.app')

@section('seo')
    @include('partials.Seo', ['seo' => $page->seo])
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">

    <style>
        .dropdown-image.dropdown-image-empty {
            background-size: cover !important;
        }
    </style>
@endpush

@section('content')

    <section class="g-home-banner">
        <div class="g-banner-bg" style="background-image: url({{ asset('storage/banner/'.$page->banners->image)  }});"></div>
        <div class="g-banner-content">
            <div class="g-banner-description">
                <h1 class="g-title">{{ $page->banners->title }}</h1>
                <p class="font-size-2 g-banner-text">{{ $page->banners->description }}</p>
            </div>
            <div class="g-banner-buttons mt-5">
                <a href="{{ LaravelLocalization::localizeUrl('/document-shop') }}" class="g-btn g-btn-green">{{ __('pages.Get your ready translation') }}</a>
                <a href="{{ LaravelLocalization::localizeUrl('/document-template') }}" class="g-btn g-btn-green">{{ __('pages.Translate yourself') }}</a>
            </div>
        </div>

        <div class="g-soc-box">
            <ul class="g-soc-wrap">
                <li class="g-soc-item g-soc-location"><a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-soc-link"><span>42 Tumanyan, 0002 Yerevan, Armenia</span></a></li>
                <li class="g-soc-item g-soc-phone"><a href="tel:+37411561678" class="g-soc-link"><span>+374 11 56 16 78</span></a></li>
                <li class="g-soc-item g-soc-mail"><a href="mailto:info@gaudeamus.com" class="g-soc-link"><span>info@gaudeamus.com</span></a></li>
            </ul>
        </div>
    </section>

    <div class="container">
        <section class="py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="g-title text-center mb-5">{{ __('pages.Select A Service') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/translation') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../images/forms/form-1.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Translator') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/interpretation') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../images/forms/form-2.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Interpreting') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/event') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../images/forms/form-3.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Event') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/localization') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../images/forms/form-4.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Localization') }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <x-five-step-check />

    </div>

    <div class="g-message-btn-box"><button class="g-message-btn"></button></div>

@endsection
