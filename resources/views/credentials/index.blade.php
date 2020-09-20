@extends('layouts.app')

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

    <div class="container mt-5">
        <div class="row">

            @if(!empty($credentials))
                @foreach($credentials as $credential)
                    <div class="col-lg-4 col-md-6">
                        <div class="g-card-simple g-card-simple-1 g-card-wrap">
                            <span class="g-card-simple-image" style="background-image: url({{ asset('storage/credentials/'.$credential->image) }})"></span>
                            <div class="font-weight-bold font-size-5 text-center-title text-center">{{ $credential->name }}</div>
                            <p class="g-card-simple-text">{{ $credential->description }}</p>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <div class="row">
            <div class="col-12">
                <div class="text-center mt-4">
                    <a href="#" class="g-btn g-btn-green text-uppercase">get my free quote</a>
                </div>
            </div>
        </div>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection
