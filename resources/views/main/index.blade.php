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

        @if(!empty($page->pageContent->first()))
            @php
                $firstElement = $page->pageContent->first();
            @endphp

            <section class="g-page-description-1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="g-page-description-text-box">
                            <h2 class="font-size-4 ">{{ $firstElement->title }}</h2>
                            <div class="g-page-description-text">
                                <p>{{ $firstElement->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 rectangle-image-box">
                        <div class="g-page-description-image-box">
                            <img src="{{ asset('/storage/page-content/' . $firstElement->image) }}" alt="{{ $firstElement->title }}" class="g-page-description-image">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(!empty($translationServices))
            <section class="py-4">
                <h2 class="font-size-1 blue-color text-center mb-3">{{ __('pages.Professional Translation Services for Any Industry') }}</h2>
                <div class="w-50 w-md-50 mx-auto mb-5">
                    <p class="text-center">{{ __('pages.professional_translation_description') }}</p>
                </div>
                <div class="row">

                    @foreach($translationServices as $translationService)
                        <div class="col-md-6 col-lg-3">
                            <div class="dropdown g-dropdown mb-4">
                                <div class="dropdown-toggle" type="button" id="g-dropdown-{{ $translationService->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="dropdown-image-box">

                                        @if (!empty($translationService->icon))
                                            <span class="dropdown-image" style="background-image: url({{ asset('storage/translation-services/'.$translationService->icon) }})"></span>
                                        @else
                                            <span class="dropdown-image dropdown-image-empty" style="background-image: url({{ asset('/images/svg/service.svg') }})"></span>
                                        @endif

                                    </div>
                                    <span class="dropdown-text">{{ $translationService->title }}</span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="g-dropdown-{{ $translationService->id }}">
                                    <div>{{ $translationService->description }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="w-50 w-md-50 mx-auto mt-5">
                    <p class="text-center">{{ __('pages.Don’t see your industry listed?') }} <button class="g-link g-link-2 green-color">{{ __('pages.Chat now') }}</button> {{ __('pages.to find out which of our professional translation services will reach your target clients.') }}</p>
                </div>
            </section>
        @endif

        <section class="py-4">
            <h2 class="font-size-1 blue-color text-center mb-3">{{ __('pages.All Our Professional Translation Services') }}</h2>
            <div class="w-50 w-md-50 mx-auto mb-5">
                <p class="text-center">{{ __('pages.our_professional_translation_description') }}</p>
            </div>
            <div class="menu-cards">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-5 d-flex flex-sm-row flex-column justify-content-center">
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="translator">{{ __('pages.Translator') }}</button>
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="interpreting">{{ __('pages.Interpreting') }}</button>
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="transcription">{{ __('pages.Transcription') }}</button>
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="localization">{{ __('pages.Localization') }}</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="translator">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-1.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">{{ __('pages.Translation') }}</div>
                            <p class="g-card-simple-text">{{ __('pages.translation_services_description') }}</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="{{ LaravelLocalization::localizeUrl('/translation') }}" class="g-link g-link-2">{{ __('pages.Request a translation') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="interpreting">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-2.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">{{ __('pages.Interpreting') }}</div>
                            <p class="g-card-simple-text">{{ __('pages.interpretation_services_description') }}</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="{{ LaravelLocalization::localizeUrl('/interpretation') }}" class="g-link g-link-2">{{ __('pages.Book an interpreter') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="transcription">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-3.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">{{ __('pages.Transcription') }}</div>
                            <p class="g-card-simple-text">{{ __('pages.transcription_services_description') }}</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="{{ LaravelLocalization::localizeUrl('/event') }}" class="g-link g-link-2">{{ __('pages.Request a transcription') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="localization">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-4.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">{{ __('pages.Localization') }}</div>
                            <p class="g-card-simple-text">{{ __('pages.localization_services_description') }}</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="{{ LaravelLocalization::localizeUrl('/localization') }}" class="g-link g-link-2">{{ __('pages.Get a Quote') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Page contents --}}
        @if(!empty($page->pageContent))
            @foreach($page->pageContent as $key => $content)

                @if($key == 0)
                    @continue
                @endif

                @if(($key % 2) == 0)
                    <section class="g-page-description-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="g-page-description-text-box">
                                    <h2 class="font-size-4 ">{{ $content->title }}</h2>
                                    <div class="g-page-description-text">
                                        <p>{{ $content->description }}</p>
                                    </div>
                                    <div class="g-description-list-btn-box">
                                        <a href="@if($content->url) {{ $content->url }} @else javascript:void(0) @endif" class="g-btn g-btn-green text-uppercase">@if($content->url) {{ $content->link_title }} @else {{ __('pages.event_button_title') }} @endif</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 rectangle-image-box">
                                <div class="g-page-description-image-box">
                                    <img src="{{ asset('/storage/page-content/' . $content->image) }}" alt="{{ $content->title }}" class="g-page-description-image">
                                </div>
                            </div>
                        </div>
                    </section>
                @else
                    <section class="g-page-description-1">
                        <div class="row">
                            <div class="col-md-6 rectangle-image-box">
                                <div class="g-page-description-image-box">
                                    <img src="{{ asset('/storage/page-content/' . $content->image) }}" alt="{{ $content->title }}" class="g-page-description-image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="g-page-description-text-box">
                                    <h2 class="font-size-4 ">{{ $content->title }}</h2>
                                    <div class="g-page-description-text">
                                        <p>{{ $content->description }}</p>
                                    </div>
                                    <div class="g-description-list-btn-box text-left">
                                        <a href="@if($content->url) {{ $content->url }} @else javascript:void(0) @endif" class="g-btn g-btn-green text-uppercase">@if($content->url) {{ $content->link_title }} @else {{ __('pages.odd_button_title') }} @endif</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach
        @endif

        <x-five-step-check class="py-4" />

        <section class="pb-4 pt-0">
            <div class="g-scroll-nums-box g-card-wrap">
                <div class="g-scroll-nums-list">
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="5000">0</span> <span>+</span></div>
                        <div class="g-scroll-text">{{ __('pages.Happy Clients') }}</div>
                    </div>
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="30000">0</span> <span>+</span></div>
                        <div class="g-scroll-text">{{ __('pages.Professional Linguists') }}</div>
                    </div>
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="116">0</span> <span>+</span></div>
                        <div class="g-scroll-text">{{ __('pages.Languages') }}</div>
                    </div>
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="1500000">0</span> <span>Million+</span></div>
                        <div class="g-scroll-text">{{ __('pages.Words Translated') }}</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection

@push('script')
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>

    <script>

        /**
         * show message dialog alert
         */
        function messageDialog(messageText){
            $(`
            <div class="message-dialog g-card-wrap">
                <span>${messageText}</span>
            </div>
        `).appendTo('body').slideToggle('slow');

            setTimeout(()=>{
                $('.message-dialog').fadeOut('slow', function(){ $(this).remove(); });
            }, 4000);
        }

        window.addEventListener('load', function () {

            @if (session('status'))
                messageDialog('{{ session('status') }}');
            @endif

        });
    </script>
@endpush
