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
                <li class="g-soc-item g-soc-location"><a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-soc-link"><span>42 Tumanyan, 0002 Yerevan, Armenia</span></a></li>
                <li class="g-soc-item g-soc-phone"><a href="tel:+37411561678" class="g-soc-link"><span>+374 11 56 16 78</span></a></li>
                <li class="g-soc-item g-soc-mail"><a href="mailto:info@gaudeamus.com" class="g-soc-link"><span>info@gaudeamus.com</span></a></li>
            </ul>
        </div>
    </section>

    <div class="container">
        <section class="g-page-description-1">

            <div class="row">
                <div class="col-12">
                    <h2 class="g-title text-center my-5">{{ __('pages.Our team') }}</h2>
                </div>

                @if(!empty($ourTeam))
                    @foreach($ourTeam as $team)
                        <div class="col-lg-3 col-md-6">
                            <div class="g-card-round">
                                <span class="g-card-round-image" style="background-image: url({{ asset('storage/member/'.$team->image) }})"></span>
                                <div class="g-card-round-content g-card-wrap">
                                    <div class="g-card-round-content-title">{{ $team->name }} {{ $team->last_name }}</div>
                                    <div class="g-card-round-content-subtitle">{{ $team->position }}</div>
                                    <p class="g-card-round-content-text">{{ $team->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="g-pagination g-pagination-1">
                        <span class="g-pagination-item g-pagination-active"><span></span></span>
                        <span class="g-pagination-item"><span></span></span>
                        <span class="g-pagination-item"><span></span></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-center mt-4">
                        <a href="#" class="g-btn g-btn-green text-uppercase">{{ __('pages.get my free quote') }}</a>
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection
