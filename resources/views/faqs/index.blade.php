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
                <li class="g-soc-item g-soc-location"><a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-soc-link"><span>{{ settings()->address }}</span></a></li>
                <li class="g-soc-item g-soc-phone"><a href="tel:+{{ settings()->phoneNumbers[0]->phone_number }}" class="g-soc-link"><span>+{{ settings()->phoneNumbers[0]->phone_number }}</span></a></li>
                <li class="g-soc-item g-soc-mail"><a href="mailto:{{ settings()->email }}" class="g-soc-link"><span>{{ settings()->email }}</span></a></li>
            </ul>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="g-title blue-color text-center my-5">{{ __('pages.Have questions about your project?') }}</h2>
            </div>
        </div>
        <div class="row">
            @if(!empty($faqs))
                @foreach($faqs as $faq)
                    <div class="col-12">
                        <div class="g-card-text">
                            <p class="g-card-text-title">{{ $faq->question }}</p>
                            <p class="g-card-text-content">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <div class="g-description-btn-box">
                    <a href="#" class="g-btn g-btn-green text-uppercase">{{ __('pages.get my free quote') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
{{--                {{ $faqs->links() }}--}}
                <div class="g-pagination g-pagination-2">
                    <span class="g-pagination-item g-pagination-active"><span>1</span></span>
                    <span class="g-pagination-item"><span>2</span></span>
                    <span class="g-pagination-item"><span>3</span></span>
                </div>
            </div>
        </div>
    </div>

@endsection
