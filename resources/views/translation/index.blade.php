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
        <div class="row">
            <div class="col-12">
                <h2 class="g-title text-center my-5">{{ __('pages.Select A Service') }}</h2>
            </div>
        </div>
        <section class="py-5">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ LaravelLocalization::localizeUrl('/translation') }}" class="g-card-simple g-card-simple-3 g-card-simple-3-active g-card-wrap">
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
                    <a href="{{ LaravelLocalization::localizeUrl('/event') }}" class="g-card-simple g-card-simple-3 g-card-wrap">
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
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="due-date">{{ __('forms.Due Date') }}</label>
                            <input type="date" class="form-control g-form-control @error('due_date') is-invalid @enderror" name="due_date" id="due-date" aria-describedby="dateInterpretationHelp" required>

                            @error('due_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="certification">{{ __('forms.Do you need certification?') }}</label>
                            <select class="form-control g-form-control selectpicker @error('certificate') is-invalid @enderror" name="certificate" id="certification" aria-describedby="certificationHelp" required>
                                <option value="1">{{ __('forms.Notarized') }}</option>
                                <option value="2">{{ __('forms.Translation') }}</option>
                            </select>

                            @error('certificate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="name">{{ __('forms.Name') }}</label>
                            <input type="text" class="form-control g-form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" aria-describedby="surnameHelp" required>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="last_name">{{ __('forms.Surname') }}</label>
                            <input type="text" class="form-control g-form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" aria-describedby="surnameHelp" required>

                            @error('last_name')
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
                    <div class="col-12">
                        <div class="form-group g-form-group">
                            <label for="company">{{ __('forms.Company') }}</label>
                            @if(auth()->user()->person_type == 1)
                                <input type="text" class="form-control g-form-control @error('company') is-invalid @enderror" name="company" id="company" value="{{ old('company',  auth()->user()->company) }}" aria-describedby="companyHelp" required>
                            @else
                                <input type="text" class="form-control g-form-control @error('company') is-invalid @enderror" name="company" id="company" value="{{ old('company') }}" aria-describedby="companyHelp" required>
                            @endif

                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group g-form-group">
                            <label for="note">{{ __('forms.Note') }}</label>
                            <textarea rows="4" class="form-control g-form-control" name="note" id="note" aria-describedby="noteHelp"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group g-form-group">
                            <div class="text-center">
                                <label class="g-type-file g-type-file-2">
                                    <input type="file" name="files">{{ __('forms.Add files') }}
                                    <i class="fas fa-upload"></i>
                                </label>
                            </div>

                            @error('files')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
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
