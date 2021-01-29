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

    @if(!empty($page->banners->title))
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
                    <li class="g-soc-item g-soc-location"><a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-soc-link"><span>{{ settings()->address }}</span></a></li>
                    <li class="g-soc-item g-soc-phone"><a href="tel:+{{ settings()->phoneNumbers[0]->phone_number }}" class="g-soc-link"><span>+{{ settings()->phoneNumbers[0]->phone_number }}</span></a></li>
                    <li class="g-soc-item g-soc-mail"><a href="mailto:{{ settings()->email }}" class="g-soc-link"><span>{{ settings()->email }}</span></a></li>
                </ul>
            </div>
        </section>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="g-title text-center my-5">{{ __('pages.Select A Service') }}</h2>
            </div>
        </div>
        <section class="py-5">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/translation') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../../images/forms/form-1.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Translator') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/interpretation') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../../images/forms/form-2.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Interpreting') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/event') }}" class="g-card-simple g-card-simple-3 g-card-simple-3-active g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../../images/forms/form-3.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Event') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/localization') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
                        <span class="g-card-simple-image mx-auto" style="background-image: url(../../images/forms/form-4.png)"></span>
                        <div class="mt-3 font-size-5 font-weight-bold text-center">
                            <span class="blue-color">{{ __('pages.Localization') }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <div class="g-wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="company-name">{{ __('forms.Company name') }}</label>
                            <input type="text" class="form-control g-form-control @error('company_name') is-invalid @enderror" name="company_name" id="company-name" value="{{ old('company_name') }}" aria-describedby="surnameHelp" required>

                            @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="contact-person">{{ __('forms.Contact person') }}</label>
                            <input type="text" class="form-control g-form-control @error('contact_person') is-invalid @enderror" name="contact_person" id="contact-person" value="{{ old('contact_person') }}" aria-describedby="surnameHelp" required>

                            @error('contact_person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="email">{{ __('forms.E-mail') }}</label>
                            <input type="email" class="form-control g-form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" aria-describedby="mailHelp" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="phone">{{ __('forms.Phone Number') }}</label>
                            <input type="tel" class="form-control g-form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" required aria-describedby="phoneHelp">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="start-date">{{ __('forms.Start date') }}</label>
                            <input type="date" class="form-control g-form-control @error('start_date') is-invalid @enderror" name="start_date" id="start-date" aria-describedby="dateInterpretationHelp" required>

                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="end_date">{{ __('forms.End date') }}</label>
                            <input type="date" class="form-control g-form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" aria-describedby="dateInterpretationHelp" required>

                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="number_of_attendees">{{ __('forms.Number of attendees') }}</label>
                            <input type="number" class="form-control g-form-control @error('number_of_attendees') is-invalid @enderror" name="number_of_attendees" id="number_of_attendees" value="{{ old('number_of_attendees') }}" aria-describedby="surnameHelp" required>

                            @error('number_of_attendees')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="event-type">{{ __('forms.Event types') }}</label>
                            <select class="form-control g-form-control selectpicker @error('event_type') is-invalid @enderror" name="event_type" id="event-type" aria-describedby="sourceLanguageHelp" required>
                                @if(!empty($eventTypes))
                                    @foreach($eventTypes as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                @endif
                            </select>

                            @error('event_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label class="g-checkbox form-control g-form-control">
                                <input type="checkbox" class="languages-toggle-check">
                                <span>{{ __('forms.Translation needed') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label class="g-checkbox form-control g-form-control">
                                <input type="checkbox" name="equipment_needed">
                                <span>{{ __('forms.Equipment needed') }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row languages-toggle-col">
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="source-language">{{ __('forms.Source Language') }}</label>
                            <select class="form-control g-form-control selectpicker @error('source_language') is-invalid @enderror" name="source_language" id="source-language" aria-describedby="sourceLanguageHelp" required>
                                @if(!empty($languages))
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            @error('source_language')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="translate-language">{{ __('forms.Target Language') }}</label>
                            <select class="form-control g-form-control selectpicker @error('target_language') is-invalid @enderror" name="target_language" id="translate-language" aria-describedby="translateLanguageHelp" required>
                                @if(!empty($languages))
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            @error('target_language')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group g-form-group mb-0 text-center">
                            <button class="g-btn g-btn-blue g-btn-round text-uppercase">{{ __('pages.Submit') }}</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
