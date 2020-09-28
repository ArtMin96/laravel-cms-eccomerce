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

    <div class="container">
        <section class="mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="g-contact-map-box">
                        <div class="g-contact-map-l">
                            <div class="text-center green-color font-weight-bold font-size-1 mb-3">{{ __('Our contacts') }}</div>
                            <ul class="g-footer-list g-footer-list-1">
                                <li class="g-footer-list-item g-footer-list-location">
                                    <a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-footer-list-link">{{ $contacts->address }}</a>
                                </li>
                                <li class="g-footer-list-item g-footer-list-mail"><a href="mailto:info@gaudeamus.com" class="g-footer-list-link">{{ $contacts->email }}</a></li>
                                <li class="g-footer-list-item g-footer-list-phone">
                                    <span class="g-footer-list-phones">
                                        @if(!empty($contacts->phoneNumbers))
                                            @foreach($contacts->phoneNumbers as $numbers)
                                                <a href="tel:+{{ $numbers->phone_number }}" class="g-footer-list-link">{{ $numbers->phone_number }}</a>
                                            @endforeach
                                        @endif
                                    </span>
                                </li>
                                <li class="g-footer-list-item g-footer-list-whatsapp"><a href="https://www.whatsapp.com/" target="_blank" class="g-footer-list-link">{{ $contacts->whatsapp }}</a></li>
                                <li class="g-footer-list-item g-footer-list-viber"><a href="https://www.viber.com/ru/" target="_blank" class="g-footer-list-link">{{ $contacts->viber }}</a></li>
                            </ul>
                        </div>
                        <div class="g-contact-map-r">
                            <div class="google-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d761.997282846017!2d44.51086012923596!3d40.18705532323812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abd1db99c3ce1%3A0x8663c432835d1d5c!2s42%20Tumanyan%20St%2C%20Yerevan%2C%20Armenia!5e0!3m2!1sen!2s!4v1595426747907!5m2!1sen!2s" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection
