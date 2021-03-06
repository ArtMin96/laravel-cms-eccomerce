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

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="g-title text-center my-5">{{ __('pages.Help Us Improve') }}</h2>
            </div>
            <div class="col-12">
                <div class="w-50 w-md-50 mx-auto mb-5">
                    <p class="text-center">{{ __('pages.help_us_improve_short_description') }}</p>
                </div>
            </div>
        </div>

        <section>

            @if(session()->has('message'))
                <div class="row">
                    <div class="col-md-2 d-none d-md-block"></div>

                    <div class="col-md-8">
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">

                <div class="col-md-2 d-none d-md-block"></div>

                <div class="col-md-8">
                    <form action="{{ route('help-us-improve.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="name">{{ __('forms.Name') }}</label>
                                    <input type="text" class="form-control g-form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group g-form-group">
                                    <label for="email_address">{{ __('forms.E-mail') }}</label>
                                    <input type="text" class="form-control g-form-control @error('email_address') is-invalid @enderror" id="email_address" name="email_address" value="{{ old('email_address') }}">

                                    @error('email_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center font-weight-bold font-size-5 mb-5">{{ __('pages.Please rate our service') }}</p>
                            </div>
                        </div>
                        <div class="row">

                            @if(!empty($rateService))
                                @foreach($rateService as $service)
                                    <div class="col-lg-4">
                                        <div class="g-card-simple g-card-simple-4 g-card-wrap">
                                            <p class="font-size-5 text-center mb-3">{{ $service->title }}</p>
                                            <div class="rating-box">
                                                <div class="star-container">
                                                    <input type="radio" name="{{ str_replace(' ', '_', strtolower($service->translate('en')->title)) }}" class="rating" value="1" />
                                                    <input type="radio" name="{{ str_replace(' ', '_', strtolower($service->translate('en')->title)) }}" class="rating" value="2" />
                                                    <input type="radio" name="{{ str_replace(' ', '_', strtolower($service->translate('en')->title)) }}" class="rating" value="3" />
                                                    <input type="radio" name="{{ str_replace(' ', '_', strtolower($service->translate('en')->title)) }}" class="rating" value="4" />
                                                    <input type="radio" name="{{ str_replace(' ', '_', strtolower($service->translate('en')->title)) }}" class="rating" value="5" />
                                                </div>
                                                <input type="hidden" class="rating-value" name="star[]" value="0">
                                                <input type="hidden" name="service[]" value="{{ $service->id }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @error('star')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center font-weight-bold mb-5">{{ __('pages.help_us_improve_comment') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="comment">{{ __('forms.Comments') }}</label>
                                    <textarea rows="4" class="form-control g-form-control @error('comment') is-invalid @enderror" name="comment" id="comment">{{ old('comment') }}</textarea>

                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    @if (Auth::check())
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round text-capitalize">{{ __('pages.Submit') }}</button>
                                    @else
                                        <a class="g-btn g-btn-blue g-btn-round text-capitalize"
                                           style="cursor: pointer"
                                           data-toggle="modal"
                                           data-target="#loginModal">{{ __('Login') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 d-none d-md-block"></div>
            </div>
        </section>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

    @include('partials.Login')

@endsection
