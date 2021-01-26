@extends('layouts.app')

@section('seo')
    @include('partials.Seo', ['seo' => $page->seo])
@endsection

@section('content')

    <section class="g-home-banner">
        <div class="g-banner-bg" style="background-image: url({{ asset('storage/banner/'.$page->banners->image)  }});"></div>
        <div class="g-banner-content">
            <div class="g-banner-description">
                <h1 class="g-title">{{ $page->banners->title }}</h1>
                <p class="font-size-2 g-banner-text">{{ $page->banners->description }}</p>
            </div>
            <div class="g-banner-buttons mt-5">
                <a href="../user/document_shop.html" class="g-btn g-btn-green">Get your ready translation</a>
                <a href="../user/document_templates.html" class="g-btn g-btn-green">Translate yourself</a>
            </div>
        </div>

        <div class="g-soc-box">
            <ul class="g-soc-wrap">
                <li class="g-soc-item g-soc-location"><a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-soc-link"><span>{{ settings()->address }}</span></a></li>
                <li class="g-soc-item g-soc-phone"><a href="tel:+{{ settings()->phoneNumbers[0]->phone_number }}" class="g-soc-link"><span>+{{ settings()->phoneNumbers[0]->phone_number }}</span></a></li>
                <li class="g-soc-item g-soc-mail"><a href="mailto:{{ settings()->email }}" class="g-soc-link"><span>{{ settings()->email }}</span></a></li>
            </ul>
        </div>
    </section>

    <div class="container">
        <section class="g-page-description-1">

            @if(!empty($page->pageContent))
                @foreach($page->pageContent as $content)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="g-page-description-text-box">
                                <h2 class="font-size-4 ">{{ $content->title }}</h2>
                                <div class="g-page-description-text">
                                    <p>{{ $content->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="g-page-description-image-box">
                                <img src="{{ asset('storage/page-content/'.$content->image) }}" alt="{{ $content->title }}" class="g-page-description-image">
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="text-center mt-5">
                        <h3 class="g-title">{{ __('pages.request_quote') }}</h3>
                        <p>{{ __('pages.request_quote_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="g-description-btn-box">
                        <a href="{{ LaravelLocalization::localizeUrl('/translate-now') }}" class="g-btn g-btn-green text-uppercase">{{ __('pages.get my free quote') }}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
